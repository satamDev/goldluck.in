<?php defined("BASEPATH") or exit("No direct script access allowed");

	class Login_model extends CI_Model{

		public function loginMe($email, $password){
			$password = md5($password);
	        $this->db->select('Admin.uid, Admin.password, Admin.name, Admin.roleId, Roles.role');
	        $this->db->from('admin as Admin');
	        $this->db->join('admin_roles as Roles','Roles.roleId = Admin.roleId');
	        $this->db->where('Admin.email', $email);
	        $this->db->where('Admin.isDeleted', 0);
	        $query = $this->db->get();
	        
	        $user = $query->row();
	        
	        if(!empty($user)){
	            if($password == $user->password){
	                return $user;
	            } else {
	                return array();
	            }
	        } else {
	            return array();
	        }
	    }

	    public function lastLoginInfo($uid){
	        $this->db->select('createdDtm');
	        $this->db->where('admin_id', $uid);
	        $this->db->order_by('id', 'DESC');
	        $this->db->limit(1);
	        $query = $this->db->get('admin_last_login');

	        return $query->row();
	    }

	    function lastLogin($loginInfo){
	        $this->db->trans_start();
	        $this->db->insert('admin_last_login', $loginInfo);
	        $this->db->trans_complete();
	    }    


	}
?>