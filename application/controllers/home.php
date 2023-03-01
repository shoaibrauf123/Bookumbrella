<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $_data;


    public function __construct()
    {
        parent::__construct();
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');
        $this->session->unset_userdata('set_filter');
		if($this->session->userdata('admin_role_id')){
			redirect('admin');
			}
			$this->load->model('product_model');
    }

    private function __loadView()
    {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }

    public function index()
    {
        $this->_data['products_data'] = $this->comman_model->get_all_limited('products', 21, 0, array('status' => 1), array('views' => 'desc'));
        $this->_data['category_data'] = $this->comman_model->get_all_limited('category', 21, 0, array('status' => 1), array('category_id' => 'desc'));
       /* echo "<pre>";
        print_r($this->_data['products_data']);
        die;*/
        $this->load->model("admin_login");
        $this->_data["author"] = $this->admin_login->author_get();		
        $this->_data["author_published"] = $this->admin_login->author_publisher();
        $this->_data['most_sold'] = $this->product_model->get_most_sold();
        $this->_data['main_content'] = 'frontend/pages/home';
        $this->__loadView();
    }
    public function author(){
        if($this->input->get("sort_by") == 1){
            $where = "asc";
            $this->load->model("admin_login");
            $this->_data["author"] = $this->admin_login->author_sorting($where);
            $this->_data['main_content'] = 'frontend/pages/author';
            $this->__loadView();

       }elseif($this->input->get("sort_by") == 0){
            $where = "desc";
            $this->load->model("admin_login");
            $this->_data["author"] = $this->admin_login->author_sorting($where);
            $this->_data['main_content'] = 'frontend/pages/author';
            $this->__loadView();
       }
    }
    function contact_us()
    {
        $data = array();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'required|trim|min_length[15]|max_length[1000]|xss_clean');
            $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->_data['errors'] = validation_errors();
                $this->_data['main_content'] = 'frontend/pages/contact_us';
                $this->__loadView();

            } else {
                $message = '<html>
                    <body bgcolor="#EDEDEE">
                    <p><strong> Dear Admin!</strong></p>
                     <p>Below is the message sent by a user</p>
                     <p>' . $this->input->post('message') . '</p>
                     <p>Regards<p>
                     <p><strong>' . $this->input->post('name') . '</strong><p>
                  </body>
                  </html>';
                $headers = "From: admin@admin.com" . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $send = mail(getAdminEmail(), $this->input->post('subject'), $message, $headers);
                $data_array = array(
                    'sender_email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),
                    'message' => $this->input->post('message'),
                    'created_on' => date('Y-m-d H:i:s')
                );
                $this->comman_model->save('contect_messages', $data_array);

                $this->session->set_flashdata('success', 'Email sent successfully.');
                redirect('contact_us');
//         if($send){
//                //if (do_email('muhammadbilalhsp@gmail.com', $this->input->post('email'), $this->input->post('subject'), $message))
//               // {
//                    $this->session->set_flashdata('success', 'Email sent successfully.');
//                    redirect('contact_us');
//                }
//                else
//                {
//                    $this->session->set_flashdata ('errors','An error occurred, try later.');
//                     redirect('contact_us');
//                    
//                }
            }
        } else {
            $this->_data['main_content'] = 'frontend/pages/contact_us';
            $this->__loadView();
        }

    }

    public function pages_description()
    {
        $slug = $this->uri->segment(2);
        $this->_data['result'] = $this->comman_model->get('static_page', array('slug' => $slug));
        $this->_data['main_content'] = 'frontend/pages/dynamic_pages_detail';
        $this->__loadView();
    }

    public function upload_products(){
        $fileName = isset($_GET['file']) ? $_GET['file']:'';

        if($fileName){
            $file = "import-data/$fileName.txt";// Your Temp Uploaded file

            $handle = fopen($file, "r"); // Make all conditions to avoid errors
            $read = file_get_contents($file); //read
            $lines = explode("\n", $read);//get
            $i= 0;//initialize

            foreach($lines as $key => $value){
                $cols[$i] = explode("\t", $value);
                if($i<=1000){
                    $sub_cols = implode(",",$cols[$i]);
                    $arr_sub_cols[] = explode(",",$sub_cols);
                }
                $i++;
            }

//        debug($arr_sub_cols,1);

            for ($i=1; $i < count($arr_sub_cols); $i++) {
//            if(count($arr_sub_cols[$i]) == 40){
                $record = array(
                    'user_id' => 1,
                    'program_name' => $arr_sub_cols[$i][0],
                    'program_url' => $arr_sub_cols[$i][1],
                    'catalog_name' => $arr_sub_cols[$i][2],
                    'last_updated' => $arr_sub_cols[$i][3],
                    'title' => $arr_sub_cols[$i][4],
                    'keywords' => $arr_sub_cols[$i][5],
                    'description' => $arr_sub_cols[$i][6],
                    'sku' => $arr_sub_cols[$i][7],
                    'manufacturer_name' => $arr_sub_cols[$i][8],
                    'manufacturer_id' => $arr_sub_cols[$i][9],
                    'upc' => $arr_sub_cols[$i][10],
                    'isbn' => $arr_sub_cols[$i][11],
                    'currency' => $arr_sub_cols[$i][12],
                    'sale_price' => $arr_sub_cols[$i][13],
                    'price' => $arr_sub_cols[$i][14],
                    'retail_price' => $arr_sub_cols[$i][15],
                    'from_price' => $arr_sub_cols[$i][16],
                    'buy_url' => $arr_sub_cols[$i][17],
                    'impression_url' => $arr_sub_cols[$i][18],
                    'image' => $arr_sub_cols[$i][19],
                    'advertiser_category' => $arr_sub_cols[$i][20],
                    'thirdparty_id' => $arr_sub_cols[$i][21],
                    'thirdparty_category' => $arr_sub_cols[$i][22],
                    'author' => $arr_sub_cols[$i][23],
                    'artist' => $arr_sub_cols[$i][24],
                    'name' => $arr_sub_cols[$i][25],
                    'publisher' => $arr_sub_cols[$i][26],
                    'label' => $arr_sub_cols[$i][27],
                    'format' => $arr_sub_cols[$i][28],
                    'special' => $arr_sub_cols[$i][29],
                    'gift' => $arr_sub_cols[$i][30],
                    'promotional_text' => $arr_sub_cols[$i][31],
                    'start_date' => $arr_sub_cols[$i][32],
                    'end_date' => $arr_sub_cols[$i][33],
                    'offline' => $arr_sub_cols[$i][34],
                    'online' => $arr_sub_cols[$i][35],
                    'instock' => $arr_sub_cols[$i][36],
                    'condition' => $arr_sub_cols[$i][37],
                    'warranty' => $arr_sub_cols[$i][38],
                    'standard_shipping_cost' => $arr_sub_cols[$i][39],
                );
                $this->comman_model->save('products',$record);
                //echo '<pre>'; print_r($record); echo '</pre>';
//            }

            }
            echo 'done';
        } else {
            echo "please enter file name in url";
        }

        exit();
    }

    public function import_products(){
        $selectedAdv = isset($_GET['adv']) ? $_GET['adv']:'';
        $availableAdv = array('6pm','forzieri','timex','shoesxl');

        if(in_array($selectedAdv,$availableAdv)){
            $fileName = 'filename.txt';
            $file = "import-data/$selectedAdv/$fileName";// Your Temp Uploaded file

            $handle = fopen($file, "r"); // Make all conditions to avoid errors
            $read = file_get_contents($file); //read
            $lines = explode("\n", $read);//get
            $i= 0;//initialize

            foreach($lines as $key => $value){
                $cols[$i] = explode("\t", $value);
                if($i<=1000){
                    $sub_cols = implode(",",$cols[$i]);
                    $arr_sub_cols[] = explode(",",$sub_cols);
                }
                $i++;
            }

//        debug($arr_sub_cols,1);

            for ($i=1; $i < count($arr_sub_cols); $i++) {
//            if(count($arr_sub_cols[$i]) == 40){
                $record = array(
                    'user_id' => 1,
                    'program_name' => $arr_sub_cols[$i][0],
                    'program_url' => $arr_sub_cols[$i][1],
                    'catalog_name' => $arr_sub_cols[$i][2],
                    'last_updated' => $arr_sub_cols[$i][3],
                    'title' => $arr_sub_cols[$i][4],
                    'keywords' => $arr_sub_cols[$i][5],
                    'description' => $arr_sub_cols[$i][6],
                    'sku' => $arr_sub_cols[$i][7],
                    'manufacturer_name' => $arr_sub_cols[$i][8],
                    'manufacturer_id' => $arr_sub_cols[$i][9],
                    'upc' => $arr_sub_cols[$i][10],
                    'isbn' => $arr_sub_cols[$i][11],
                    'currency' => $arr_sub_cols[$i][12],
                    'sale_price' => $arr_sub_cols[$i][13],
                    'price' => $arr_sub_cols[$i][14],
                    'retail_price' => $arr_sub_cols[$i][15],
                    'from_price' => $arr_sub_cols[$i][16],
                    'buy_url' => $arr_sub_cols[$i][17],
                    'impression_url' => $arr_sub_cols[$i][18],
                    'image' => $arr_sub_cols[$i][19],
                    'advertiser_category' => $arr_sub_cols[$i][20],
                    'thirdparty_id' => $arr_sub_cols[$i][21],
                    'thirdparty_category' => $arr_sub_cols[$i][22],
                    'author' => $arr_sub_cols[$i][23],
                    'artist' => $arr_sub_cols[$i][24],
                    'name' => $arr_sub_cols[$i][25],
                    'publisher' => $arr_sub_cols[$i][26],
                    'label' => $arr_sub_cols[$i][27],
                    'format' => $arr_sub_cols[$i][28],
                    'special' => $arr_sub_cols[$i][29],
                    'gift' => $arr_sub_cols[$i][30],
                    'promotional_text' => $arr_sub_cols[$i][31],
                    'start_date' => $arr_sub_cols[$i][32],
                    'end_date' => $arr_sub_cols[$i][33],
                    'offline' => $arr_sub_cols[$i][34],
                    'online' => $arr_sub_cols[$i][35],
                    'instock' => $arr_sub_cols[$i][36],
                    'condition' => $arr_sub_cols[$i][37],
                    'warranty' => $arr_sub_cols[$i][38],
                    'standard_shipping_cost' => $arr_sub_cols[$i][39],
                );
                $this->comman_model->save('products',$record);
                //echo '<pre>'; print_r($record); echo '</pre>';
//            }

            }
            echo 'done';
        } else {
            echo "please enter file name in url";
        }

        exit();
    }

//////////////////////////// author sorting Start /////////////////

    /*public function sort_record(){
       
    }*/


}