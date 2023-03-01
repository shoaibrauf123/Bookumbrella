<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminVoucherManagement extends CI_Controller {
    private $_data;
    public function __construct() {
        parent::__construct();
        check_is_login(20);
       $this->load->helper('upload_helper');
       $this->load->library('PHPExcel');

    }
    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');

        $this->load->view('admin/admin_template', $this->_data);
    }

    function index() {
           $where=FALSE;
           
           $this->_data['results'] = $this->comman_model->get('deals',$where);
           $total = $this->comman_model->get_total('deals', $where);
            $per_page = 10;
            $num_links = 4;
            $uri_segment = 3;

        $this->_data['pagination'] = paginate(base_url() . 'admin/vouchers/', $total, $per_page, $num_links, $uri_segment);
        
         if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
            // echo $_FILES['vouchers']['name'];die;
            $this->form_validation->set_rules('vouchers', 'Vouchers', 'trim|required');
              if (isset($_FILES['vouchers']['name']) && trim($_FILES['vouchers']['name']) != "") {
                   /*
                    * import .csv file code
                    */ 
                $imageFileType = pathinfo($_FILES['vouchers']['name'],PATHINFO_EXTENSION);
                if (!in_array($imageFileType, array('csv'))) {
                   $this->session->set_flashdata('errors', 'Wrong format. only <span style="color:green; font-weight:bold;">( csv ) </span> file allowed.');
                 
                   if($contest_id == ''){
                        redirect('admin/vouchers');  
                      }else{
                        redirect('admin/vouchers'); 
                      }
                
                }

                $vouchers_data = array();
                
                
                
                try 
                {
                    $objPHPExcel = PHPExcel_IOFactory::load($_FILES['vouchers']['tmp_name']);
                }
                catch(Exception $e) {
                    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                //print_r($allDataInSheet);die;
         $data =   array();
               for($i=2; $i<= count($allDataInSheet); $i++) {
                   $data[$i] =array(
                   'link_id'=> $allDataInSheet[$i]['A'],
                   'title'=> $allDataInSheet[$i]['B'],
                   'cat_id'=> $allDataInSheet[$i]['C'],
                   'url'=> $allDataInSheet[$i]['D'],
                   'description'=> $allDataInSheet[$i]['E'],
                   'coupon_code'=> $allDataInSheet[$i]['F'],
                   'promotion_type'=> $allDataInSheet[$i]['G'],
                   'promotion_end_date'=> date('Y-m-d H:i:s',  strtotime($allDataInSheet[$i]['H'])),
                   'promotion_start_date'=> date('Y-m-d H:i:s',  strtotime($allDataInSheet[$i]['I'])),
                   'advertiser_id'=> $allDataInSheet[$i]['J'],
                   'advertiser_name'=> $allDataInSheet[$i]['K'],
                   'click_commission'=> $allDataInSheet[$i]['L'],
                   'sale_commission'=> $allDataInSheet[$i]['M']
   
                           );
                       }
                 //print_r($data);die;
                  $is_saved = $this->comman_model->save_batch('deals',$data);  
                  if($is_saved){
                      $this->session->set_flashdata('success','voucher saved successfully');
                  } else {
                       $this->session->set_flashdata('errors','Sorry ! voucher not saved');
                  }
                    redirect('admin/vouchers');
                    /*
                     * end code edit
                     */
                   } else {
                       $this->session->set_flashdata('errors', 'Please select (.csv) file.');
                       redirect('admin/vouchers');
                   }
                
         } else {

        $this->_data['page'] = "index";
        $this->_data['view_path'] = 'admin/deals/index';
         }

        $this->__loadView();
    }
 
    function export_excel() {
    header('Content-Disposition: attachment; filename=vouchere.xls');
    header('Content-type: application/force-download');
    header('Content-Transfer-Encoding: binary');
    header('Pragma: public');
    print "\xEF\xBB\xBF"; // UTF-8 BOM
    $where=FALSE;
    $result = $this->comman_model->get('deals',$where);
    $h = array();
    try {
    foreach($result as $row){
        foreach($row as $key=>$val){
            if(!in_array($key, $h)){
                $h[] = $key;   
            }
        }
    }
    echo '<table><tr>';
    foreach($h as $key) {
        $key = ucwords($key);
        echo '<th>'.$key.'</th>';
    }
    echo '</tr>';

    foreach($result as $row){
        echo '<tr>';
        foreach($row as $val)
            $this->writeRow($val);   
    }
    echo '</tr>';
    echo '</table>';
    } catch(Exception $e) {
         $this->session->set_flashdata('errors','Sorry ! some error occer');
         redirect('admin/vouchers');
       }
    }
function writeRow($val) {
    echo '<td>'.$val.'</td>';              
}
 
function export_excel2() {
    
    $where=FALSE;
    $result = $this->comman_model->get('deals',$where);
         $this->load->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $result;
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
        // Fetching the table data
        $row = 2;
        foreach($result as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
   


function delete()
    {

        $deal_id = decode_uri($this->uri->segment(5));
        $where = array('deal_id' => $deal_id);
        $deleted = $this->comman_model->delete('deals', $where);
        if ($deleted) {
                $this->session->set_flashdata('success', 'Voucher Deleted Successfully.');
            } else {
                $this->session->set_flashdata('errors', 'Requested voucher not found, please try later !');
            }
        redirect('admin/vouchers');
    }


}