<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model{
	

	public function __construct()
	{
		parent::__construct();
	}

	public function set_user_login($data){
			$admin 		= ($data->user_isadmin == 'Yes') ? TRUE : FALSE;
			$data 		= array('village_id'		=> $data->village_id,
								'village_code'		=> $data->village_code,
								'village_head'		=> $data->village_head,
								'village_name'		=> $data->village_name,
								'village_staff'		=> $data->village_staff,
								'village_staff_no'	=> $data->village_staff_no,
								'province'			=> $data->province,
								'district'			=> $data->district,
								'subdistrict'		=> $data->subdistrict,
								'village_address'	=> $data->village_address,
								'user_id'			=> $data->user_id,
								'user_fullname'		=> $data->user_fullname,
								'user_grup'			=> $data->group_id,
								'user_isgroup'		=> $data->user_isgroup,
								'user_email'		=> $data->user_email,
								'admin' 			=> $admin,
								'user_islogin'		=> TRUE);
			$this->session->set_userdata($data);

			$this->db->set('user_islogin',1)
					 ->set('user_visited','`user_visited`+1',FALSE)
					 ->set('user_lastin',date('Y-m-d H:i:s'))
					 ->where('user_id',$this->_userid)
					 ->update('m_user');

	}

	public function set_priv_login($data){
		// get privilege
		$user_priv 	= ($data->user_isgroup == 'No') ? $data->user_id : $data->group_id;
		$priv 		= $this->db->get_where('m_priv_user',array('user_priv_id'=>$user_priv))->result();

		foreach($priv as $priv){
			$privilege[$priv->priv_code] 	= TRUE; #$priv->priv_code;

		}
		$this->session->set_userdata($privilege);
	}

	public function getFileName($filename){		
		$file		= explode(".", $filename);
		$ext 	 	= end($file);		
		$image 		= array('filename'	=>	$filename,
							'thumbnail'	=>	$file[0].'_thumb.'.$ext,
							'ext'		=> 	$ext);
		return $image;
	}

	public function get_old_pass($data){
		$sql 	= $this->db->where('user_id',$this->session->userdata('user_id'))
						   ->where('village_id',$this->session->userdata('village_id'))
						   ->get('m_user');
		return $sql->row();
	}

	
}