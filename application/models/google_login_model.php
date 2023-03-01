<?php


class Google_login_model extends CI_Model
{
    function Is_already_register($id){
        $this->db->where('login_oauth_uid', $id);
        $query = $this->db->get('google_login');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function Update_user_data($data, $id){
        $this->db->where('login_oauth_uid', $id);
        $this->db->update('google_login', $data);
    }

    function Insert_user_data($data){
        $this->db->insert('google_login', $data);
    }
}
