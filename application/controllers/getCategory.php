<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class GetCategory extends CI_Controller
{
	
	public  function __construct()
	{
		parent::__construct();
		$this->load->model("Api_model");
	}
	public function index(){
		echo "hello";
	}
	public function getCategory_record(){
		$category_record = $this->Api_model->getCategory();
		if ($category_record) {
            echo json_encode(Array('status'=> true, 'message' => 'Success', 'Categories' => $category_record));
        }else{
           echo json_encode(Array('status'=> false, 'message' => 'Categories Not Found'));
        }
	}

}
	
?>