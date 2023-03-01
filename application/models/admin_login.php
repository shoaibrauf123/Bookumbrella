<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_login extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function admin_logins() {
        $query = $this->db->get('admin_login');
        return $query->result_array();
    }

    function login() {
        $role_id = array('1', '2');
        $result = md5($this->input->post("password"));
        $this->db->select();
        $this->db->from('user');
        $array = array('email' => $this->input->post("email_login"), 'password' => $result);
        $this->db->where($array);
        
        $this->db->where_in('role_id', $role_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_rights($where){
        $rights = array();
        $query = $this->db->select('module_id')->where($where)->get('modules_access_rights');
        if($query->num_rows() > 0){
            $admin_rights = $query->result_array();
            foreach ($admin_rights as $right) {
                $rights[] = $right['module_id'];
            }
        }
        return $rights;
        
    }

    function changePassword($data,$user_id) {
        $this->db->where('user_id',$user_id );
        $this->db->update('user', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        else
            return FALSE;
    }


    function forgotPassword(){
        $this->db->select('user_id, email');
        $this->db->where('email', $this->input->post('forgot_password'));
        $query  = $this->db->get('user');
        //print_r($query);
        return $query->result_array();

    }
    function reset_password($hash){
        $this->db->select();
        $this->db->where('password_reset_hash',$hash );
        $query = $this->db->get('user');
        if ($query->num_rows()>0)
            return $query->result_array();
        else
            return FALSE;
    }
    function change_password($data,$id){
        $this->db->where('user_id',$id);
        $this->db->update('user', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    function activate_hash($where,$set){
        $this->db->update('user',$set,$where);
    }

    function admin_save_profile($data){
        $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->update('user', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function show_profile(){
        $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->select('user_name,image_profile');
        $query = $this->db->get('user');
        if ($query->num_rows()>0)
            return $query->result_array();
        else
            return FALSE;
    }

    function admin_email($data){
        $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->update('user', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    function get_admin_email(){
        $this->db->select('email');
        $this->db->where('role_id', 1);
        $query  = $this->db->get('user');
        //print_r($query);
        return $query->result_array();
    }


    ////////////////////////

    function insert_author($data){
       if($data){
        $this->db->insert("author",$data);
        return $this->db->insert_id();
       }else{
        return false;
       }

    }

    function author_get(){
        $this->db->select("*");
        $query = $this->db->get("author");
        return $query->result();
    }

    function edit_author($id){
        $this->db->select("*");
        $this->db->where("id",$id);
        $query = $this->db->get("author");
         if($query){
                return $query->result();
         }else{
            return false;
         }

    }

    function update_author($data,$id){
        $this->db->where("id",$id);
        $this->db->update('author', $data);
        
            return TRUE;
    }

    function delete_author($id){
       $this->db->where('id', $id);
        $query = $this->db->delete('author');
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function author_publisher(){
        $this->db->select("author,count(author) as total_author");
        $this->db->group_by("author");
        $query = $this->db->get("products");
       //echo "<pre>";print_r($query->result());die;
        return $query->result();

    }
    function author_sorting($where){
        $this->db->select("*");
        $this->db->from("author");
        if($where == "asc"){
            $this->db->order_by("author_name",$where);
            $query = $this->db->get();
            return $query->result();
        }elseif($where == "desc"){
            $this->db->order_by("author_name",$where);
            $query = $this->db->get();
            return $query->result();
        }
    }

}
