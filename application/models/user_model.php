<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('email_helper');
    }

    function tableName()
    {
        return 'user';
    }

    function get($table,$where = false,$fields = '*',$order=false)
    {
        $this->db->select($fields)->from($table);

        if($where){
            $this->db->where($where);
        }

        if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }

        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();

        return 0;
    }

    function save($table,$data){
        $this->db->insert($table, $data);
        if ($this->db->insert_id() > 0){
            return $this->db->insert_id();
        } else{
            return FALSE;
        }
    }

    function createUserAccount($data)
    {
        $this->db->insert($this->tableName(), $data);
        if ($this->db->insert_id() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function verify_user($where)
    {
        $this->db->select()->from($this->tableName())->where($where);
        $result = $this->db->get();
        if ($result->num_rows() == 1)
            return $result->result_array();
        else
            return FALSE;
    }

    function updateUserProfile($data, $where)
    {
        $this->db->update($this->tableName(), $data, $where);
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() == 1)
            return 1;
        else if ($this->db->affected_rows() == 0)
            return 0;
        else
            return -1;
    }

    function activate_user_account($where)
    {
        $set = array(
            'activation_hash' => '',
            'status' => 1
        );
        $this->db->update('user', $set, $where);
        if ($this->db->affected_rows() == 1)
            return TRUE;
        return FALSE;
    }

    //==============Admin Functions======
    function create_user($data)
    {
        $this->db->insert('users', $data);
        if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
        return FALSE;
    }

    function get_total()
    {
        $query = $this->db->select('user_id')->from('users')->where(array('user_role !=' => 1, 'is_deleted' => 0))->get();
        if ($query->num_rows() > 0)
            return $query->num_rows();
        return 0;
    }

    function get_all_users($per_page = 10, $start_from = 0, $where)
    {
        $query = $this->db->select()->from('users')->where($where)->limit($per_page, $start_from)->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }

    function update_user_account($data, $where)
    {
        $this->db->update('users', $data, $where);
        if ($this->db->affected_rows() == 1)
            return true;
        return false;
    }

    function get_admin_email()
    {
        $this->db->select('email');
        $this->db->where('user_role', 1);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0)
            $resule = $query->result_array();
        return $resule[0]['email'];
    }

    function get_pending_cashback_value()
    {
        $pendingCashbackValue = $this->get('cashback',array('user_id'=>getCurrentUserId(),'updated_status'=>'Pending'),array('sum(cashback_value) as pendingCashbackValue'));
        $pendingCashbackValue = $pendingCashbackValue ? $pendingCashbackValue[0]['pendingCashbackValue']:0;
        $pendingCashbackValue = $pendingCashbackValue ? $pendingCashbackValue:0;
        return $pendingCashbackValue;
    }

    function get_confirmed_cashback_value()
    {
        $confirmedCashbackValue = $this->get('cashback',array('user_id'=>getCurrentUserId(),'updated_status'=>'Confirmed'),array('sum(cashback_value) as confirmed_cashback_value'));
        $confirmedCashbackValue = $confirmedCashbackValue ? $confirmedCashbackValue[0]['confirmed_cashback_value']:0;
        $confirmedCashbackValue = $confirmedCashbackValue ? $confirmedCashbackValue:0;
        return $confirmedCashbackValue;
    }


    function get_users_by_date($year)
    {
        $where = "year(date_created) = '$year' and (month(date_created) = '1' || month(date_created) = '2' || month(date_created) = '3'
             || month(date_created) = '4' || month(date_created) = '5' || month(date_created) = '6'
             || month(date_created) = '7' || month(date_created) = '8' || month(date_created) = '9'
             || month(date_created) = '10' || month(date_created) = '11' || month(date_created) = '12')";
        $this->db->select('count(*) as total, month(date_created) as ymonth')->from('user')->where($where)
            ->group_by('month(date_created)')->order_by('month(date_created)');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }

    function addConfirmedCashbacksToCashouts(){

        $cashbackIdList = array();
        $totalCashbackAmount = 0;

        $confirmedCashbacks = $this->get('cashback',array('updated_status'=>'Confirmed','user_id' => getCurrentUserId()));

        if($confirmedCashbacks){

            foreach($confirmedCashbacks as $cashback){
                $totalCashbackAmount += intval($cashback['cashback_value']);
                $cashbackIdList[] = $cashback['cashback_id'];
            }

            $saveData = array(
                'cashback_value' => $totalCashbackAmount,
                'user_id' => getCurrentUserId()
            );
            $cashout_id = $this->save('cashout',$saveData);

            foreach($cashbackIdList as $cashback_id){
                // Adding cashout id to each selected cashback
                $where = array('cashback_id' => $cashback_id);
                $settingVal = array('cashout_id' => $cashout_id);
                $this->comman_model->update('cashback',$where,$settingVal);
            }

            return true;
        } else {
            return false;
        }
    }
	
	
    function get_total_value()
    {
        $confirmedCashbackValue = $this->get('cashback',array('user_id'=>getCurrentUserId(),'updated_status'=>'Confirmed'),array('sum(cashback_value) as confirmed_cashback_value'));
        $confirmedCashbackValue = $confirmedCashbackValue ? $confirmedCashbackValue[0]['confirmed_cashback_value']:0;
        $confirmedCashbackValue = $confirmedCashbackValue ? $confirmedCashbackValue:0;
        return $confirmedCashbackValue;
    }
	
	
		

}