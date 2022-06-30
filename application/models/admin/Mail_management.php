<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Mail_management extends CI_Model {
		public function getMailSettings(){
			$query = $this->db->get('mail_service');
			return $query->result_array();
		}

		public function getMailContent($mail_service_id, $mail_for){
			$subject_field = $mail_for . "_subject";
			$subject_field = 'm.'.$subject_field;

			$message_field = $mail_for . "_message";
			$message_field = 'm.'.$message_field;

			$this->db->select($subject_field.','.$message_field);
			$this->db->where('m.uid', $mail_service_id);
			$query = $this->db->get('mail_service m');
			
			return $query->result_array();
		}
	}
?>