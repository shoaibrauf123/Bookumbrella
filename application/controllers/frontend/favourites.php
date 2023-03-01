<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favourites extends CI_Controller {
  private $_data;

  public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in')!=TRUE)
            redirect('login');

		if($this->session->userdata('admin_role_id')){
			redirect('admin');
			}
            $this->load->model('favourite_model');       
    }

    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }
    function table_name(){
        return 'favorites';
    }
    function index() {
        
    }
  public function add_favourites()
    {
      if($this->uri->segment(2) && $this->uri->segment(2) !=''){
            $id = decode_uri($this->uri->segment(2));
            $found = $this->favourite_model->is_store_exist($id);
            if($found){
            $where = array('store_id'=>$id,
                            'user_id'=>  $this->session->userdata('user_id'));
            $count = $this->comman_model->get_total($this->table_name(), $where);    
            if($count == 1){ 
                $this->session->set_flashdata('errors','This store already in favourites.'); 
                redirect('stores');
            }else { 
            $this->comman_model->save($this->table_name(),$where);
            $this->session->set_flashdata('success','Store has been added to your favourites list. If you want to remove from favourites then just click on Remove button.'); 
              redirect('favourites');
            }
             } else {
                $this->session->set_flashdata('errors','Store not found! Try again');
                redirect('stores');
            }
        }
      
        $per_page = $this->input->get('count');
        if (!is_numeric($per_page))
            $per_page = 15;
        
        $start_from = $this->input->get('per_page');
        if (!is_numeric($start_from))
            $start_from = 0;
        
        if ($this->input->get('sort_by') != '') {
            $sort_by = $this->input->get('sort_by');
            if ($sort_by == 'name_desc') {
                $order = array('s.name' => 'DESC');
            } else if ($sort_by == 'name_asc') {

                $order = array('s.name' => 'ASC');
            }
        } else {
            $order = FALSE;
        }
        /*
         * pagination
         */
         $get = $_GET;
        unset($get['per_page']);
        //$start_from = 0;

        $suffix = '&' . http_build_query($get, '', "&");
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url('favourites') . '?';
        $config['suffix'] = $suffix;
        $config['first_url'] = base_url('favourites') . '?' . $suffix;
        $config['total_rows'] = $this->comman_model->get_total($this->table_name(),array('user_id'=>  $this->session->userdata('user_id')));

        $this->_data['total'] = $config['total_rows'];
        $config['per_page'] = $per_page;
        $config['num_links'] = 6;
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';

        $this->pagination->initialize($config);

        $this->_data['pagination'] = $this->pagination->create_links();

        $this->_data['result'] = $this->favourite_model->get_my_favourites($per_page,$start_from,$order );
       
        $this->_data['main_content'] = 'frontend/stores/my_favourites';
        $this->__loadView();
    }
    
  public function remove_favourites()
    {
        if($this->uri->segment(2)){
            $id = decode_uri($this->uri->segment(2));
            $where = array('favorite_id'=>$id);
            $is_del = $this->comman_model->delete($this->table_name(),$where);
            if($is_del){
                $this->session->set_flashdata('success','Favourite removed successfully.'); 
                redirect('favourites');
            } else {
                $this->session->set_flashdata('errors','Sorry ! Favourite not removed try again.'); 
                redirect('favourites');
            }
        } else {
           redirect('favourites');
        }
    }




	
	
	


		
function add_skus(){
	
	
	
	//echo 'dfdfdfd';exit;
	
	
		
		
		if($this->uri->segment(2)=='delete' && $this->uri->segment(4)!=''){
			
				$paypal_accounts = $this->comman_model->delete($this->uri->segment(3),array("id"=>$this->uri->segment(4)));		
				$this->session->set_flashdata('success', "Record has been deleted successfully.");
				//redirect(base_url("payment_method"));
			
			}
		
        $user_id = getCurrentUserId();
		
		 
		/*$paypal_accounts = $this->comman_model->get("pm_paypal",array("user_id"=>$user_id));
		$this->_data['paypal_accounts'] = $paypal_accounts;

		$bank_accounts = $this->comman_model->get("pm_bank",array("user_id"=>$user_id));
		$this->_data['bank_accounts'] = $bank_accounts;


*/


      //  $redirect_url = base_url('add_pricing');

       
		
        $user_data = $this->comman_model->get('user',array('user_id' => $user_id));
		
        if($user_data){

            if ($this->input->server('REQUEST_METHOD') === 'POST'){

              
				
                    $this->form_validation->set_rules('name', 'Name', 'trim|required');
                    $this->form_validation->set_rules('pricing_actions_id', 'Pricing Action', 'trim|required');
                    $this->form_validation->set_rules('pricing_amount_type', 'Pricing Amount Type', 'trim|required');
					$this->form_validation->set_rules('min_price', 'Min Price', 'trim|required');
					$this->form_validation->set_rules('max_price', 'Max Price', 'trim|required');
					
					
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
					//echo 'df';exit;

                if ($this->form_validation->run() !== FALSE) {
				
                    $saved = $this->comman_model->save('pricing_rules',
                        array(
                            'name' => $this->input->post('name'),
                            'pricing_actions_id' => $this->input->post('pricing_actions_id'),
							'pricing_amount_type' => $this->input->post('pricing_amount_type'),
							'amount' => $this->input->post('amount'),
							'min_price' => $this->input->post('min_price'),
							'max_price' => $this->input->post('max_price'),
							'date_created' => date("Y-m-Y H:i:s"),
							'status' => 'In-Active',
                            'user_id' => $user_id
                        )
                    );

                    if ($saved) {
						$this->_data['success'] = 'Pricing rule is saved successfully !';
						} else {
                        $this->_data['errors'] = 'Unable to save payment method information. Please review your input data !';
                    }

                } else {
                    $this->_data['errors'] = validation_errors();
                }
            }
			
			
			
			
			
			
			
			$pricing_actions = $this->comman_model->get('pricing_actions',false);
//print_r($pricing_actions);exit;
$this->_data['pricing_actions'] =  $pricing_actions ;



$pricing_rules = $this->comman_model->get('pricing_rules',array('user_id'=>$user_id));

$this->_data['pricing_rules'] =  $pricing_rules ;




		$this->_data['main_content'] = "frontend/users/add_pricing";
        $this->_data['page'] = "add_pricing";
		
		
		
		

            $this->__loadView();

        } else {
            redirect();
        }


    
	
	}	
		

}