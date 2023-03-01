<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $_data;
    private $data;

    public function __construct()
    {
     
	    parent::__construct();

        $this->load->model('user_model');
        
    }

    private function __loadView()
    {
		
		if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin/admin_template', $this->_data);
    }

    function index(){
        
		check_is_login(0);

        $this->_data['view_path'] = 'admin/admin/dashboard';
        $this->_data['page'] = 'dashboard';

        $this->_data['male'] = $this->comman_model->get_total('user',array('gender' => 'male'));
        $this->_data['female'] = $this->comman_model->get_total('user',array('gender' => 'female'));
        $this->_data['active_account'] = $this->comman_model->get_total('user',array('status' => 1));
        $this->_data['all_user'] = $this->comman_model->get_total('user');

        $year = date('Y');

        if ($_POST){
            $this->form_validation->set_rules('year', 'Year', 'trim|required|numeric|exact_length[4]|xss_clean');
            if ($this->form_validation->run()==FALSE)
            {
                $this->_data['errors'] = validation_errors();
            }
            else
            {
                $year = $this->input->post('year');
            }
        }

        $total_users_by_date = $this->user_model->get_users_by_date($year);
        $user_count = array(0,0,0,0,0,0,0,0,0,0,0,0,0);

        if ($total_users_by_date)
        {
            for($i=0;$i<=11;++$i)
            {
                if (isset($total_users_by_date[$i]['ymonth']))
                {
                    $user_count[$total_users_by_date[$i]['ymonth']] = $total_users_by_date[$i]['total'];
                }
            }
        }

        $users_by_date = "";
        $i = 0;

        foreach ($user_count as $total) {
            if($i>0)
                $users_by_date .= $total.",";
            $i = 1;
        }

        $this->_data['year'] = $year;
        $this->_data['users_by_date'] = rtrim($users_by_date, ",");

        $this->__loadView();
    }

    function admin_logout()
    {
        check_is_login(0);

        $this->session->sess_destroy();
        redirect('admin');
    }

    function forgot_password() {

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->load->model('admin_login');

            $msg = '';
            $activation = $this->generate_activation_hash();
            $subject = 'Change Password Email';

            $reset = $this->admin_login->forgotPassword();

            if (!empty($reset[0])) {

                $activationLink = base_url('admin/reset_password') . "/" . $activation;
                $msg = 'To change your password please click on the below link:'. '<br/> <a href='.$activationLink.'>'.$activationLink.'</a>';
                do_email($this->input->post('forgot_password'), getAdminEmail(), $subject, $msg);

                $this->admin_login->activate_hash(
                    array(
                        'email' => $this->input->post('forgot_password')), array(
                        'password_reset_hash' => $activation
                    )
                );

                $this->session->set_flashdata('success', 'Password reset link has been successfully sent to your email box !');
                redirect('admin');

            } else if (empty($reset[0])) {

                $this->data['errors'] = '
                <h1>Invalid User</h1><br/>
                <h2>Please try again.<h2>
                  <p class="page-404">Something is wrong with your user information, please review it and submit again. <a href="' . base_url('admin') . '">Return Home</a></p>';
                $this->load->view('admin/error_occur', $this->data);
                return;

            } else {

                $this->data['errors'] = '
                <h1>Invalid User</h1><br/>
                <h2>Please try again.<h2>
                  <p class="page-404">Something is wrong with your user information, please review it and submit again. <a href="' . base_url('admin') . '">Return Home</a></p>';
                $this->load->view('admin/error_occur', $this->data);
                return;
            }
        }else{
            $this->session->set_flashdata('errors',  validation_errors());
        }

        redirect('admin');
    }

    function generate_activation_hash() {
        $this->load->helper('string');
        return random_string('unique');
    }

    function reset() {

        $this->load->model('admin_login');
        $row = $this->admin_login->reset_password($this->uri->segment(3));

        if (!$row) {
            $this->data['errors'] = '
                <h1>Invalid User</h1><br/>
                <h2>Please try again.<h2>
                  <p class="page-404">Something is wrong with your user information, please review it and submit again. <a href="' . base_url('admin') . '">Return Home</a></p>';
            $this->load->view('admin/error_occur', $this->data);
        } else {
            $this->session->set_userdata('tmp_hash',$row[0]['password_reset_hash']);
            if($this->session->flashdata('errors')!=''){
                $this->data['errors'] = $this->session->flashdata('errors');
            }
            $this->session->set_userdata('tmp_user_id',$row[0]['user_id']);
            $this->load->view('admin/admin/forgot_password',  $this->data);
        }
    }

    function confirm_pass() {

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->load->model('admin_login');
            $update = $this->admin_login->change_password(
                array(
                    'password' => md5($this->input->post('conf_pass')),
                    'date_updated' => date('Y-m-d H:i:s')
                ),
                $this->session->userdata('tmp_user_id')
            );
            if ($update == TRUE) {
                $this->session->set_flashdata('success', 'Your password successfully changed');
                $this->session->unset_userdata(array('tmp_user_id', 'tmp_hash'));
                redirect('admin');
                return;
            }
        }else{
            $this->session->set_flashdata('errors', validation_errors());
        }

        redirect('admin/reset_password/'.$this->session->userdata('tmp_hash').'/');
    }

    ///////////////////////// Author Start Code //////////////////////////////

    public function author(){
        $this->load->model("admin_login");
            $this->_data["author"] = $this->admin_login->author_get();
         $this->_data['view_path'] = 'admin/admin/author';
        $this->_data['page'] = 'author';
        $this->__loadView();
    }
    public function author_add(){

         $this->_data['view_path'] = 'admin/admin/author_add';
        $this->_data['page'] = 'author';
        $this->__loadView();
    }

    public function author_create(){
         $aut_name = $this->input->post("author_name");
         $featured = $this->input->post("featured");
         $description = $this->input->post("author_description");

            $config['upload_path'] = './uploads/author_gallery/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = FALSE;
            $config['remove_spaces'] = TRUE;

        if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
            $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('file_upload')) {
                    echo 'error';
                } else {
                  $data["upload_data"] =  $this->upload->data();
                }
                    //echo "<pre>";
                   $file_path = $data["upload_data"]["raw_name"]."".$data["upload_data"]["file_ext"];
                    
                    

                    $auth_data = [
                        "author_name" => $aut_name,
                        "image" => $file_path,
                        "featured" => $featured,
                        "description" => $description,
                    ];

                $this->load->model('admin_login');
               $data = $this->admin_login->insert_author($auth_data);
               if($data){
                    redirect("admin/author");
               }


    }

    public function edit_auth($id){
        $this->load->model("admin_login");
        $this->_data["response"] = $this->admin_login->edit_author($id);
        $this->_data['view_path'] = 'admin/admin/author_edit';
        $this->_data['page'] = 'author';
        $this->__loadView();

    }

    public function update_auth(){

        $auth_id = $this->input->post("author_id");
        $aut_name = $this->input->post("author_name");
        $featured = $this->input->post("featured");
        $description = $this->input->post("author_description");
        $old_pic = $this->input->post("old_image");

        

            $config['upload_path'] = './uploads/author_gallery/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = FALSE;
            $config['remove_spaces'] = TRUE;

        if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
            $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('file_upload')) {
                    $auth_data = [
                                "author_name" => $aut_name,
                                "image" => $old_pic,
                                "featured" => $featured,
                                "description" => $description,
                            ];
                            
                } else {
                  $res =  $this->upload->data();

                  $auth_data = [
                                "author_name" => $aut_name,
                                "image" => $res["raw_name"]."".$res["file_ext"],
                                "featured" => $featured,
                                "description" => $description,
                            ];
                           
                }
                    $this->load->model('admin_login');
                    $data = $this->admin_login->update_author($auth_data,$auth_id);
                   if($data){
                        redirect("admin/author");
                   }

    }
    function delete_author($id){
         $this->load->model("admin_login");
        $data = $this->admin_login->delete_author($id);
        if($data){
            redirect("admin/author");
        }
    }

    ///////////////////////// Author End Code //////////////////////////////

}