<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Desa_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();			
	}
	
	/*
	function drop_list(){
		$list 					= new stdClass();
		
		if($this->session->userdata('admin') === FALSE) $this->db->where('village_code',$this->session->userdata('village_code'));
		
		$list->list_village		= $this->db->where('village_status','active')
										   ->get('m_village')->result();
										   
		$list->list_group		= $this->db->where('group_status','active')->get('m_group')->result();
		
		return $list;
	}
	*/

	function village_visited($key){
		$this->db->set('village_visited','`village_visited`+1',FALSE)
					 ->where('village_code',$key)
					 ->update('m_village');
	}

	function json_to_single($key){
		
		$json 	= json_decode(file_get_contents(APPPATH.'config/json/'.$key.'.json'));
		return $json;
	}

	function json_to_temp(){
		$json 	= json_decode(file_get_contents(APPPATH.'config/json/temp.json'));
		foreach($json as $row => $val){
			$key 	= current(explode('_', $row));
			$param[$key][$row] 	= $val;
		}
		return $param;
	}

	function array_to_json_view($array){

		foreach($array as $row => $val){
			$key 	= current(explode('_', $row));
			$param[$key][$row] 	= $val;
		}
		return $param;
	}

	function data_proses($data){
		$key 		= $data['profil_kode_desa'];
		$cek 		= $this->db->get_where('m_village',array('village_code'=>$key))->num_rows();

		$raw 		= array('village_code'		=> $data['profil_kode_desa'],
							'village_name'		=> $data['profil_nama_desa'],
							'village_head'		=> $data['profil_kepala_desa'],
							'village_staff'		=> $data['profil_nama_sekdes'],
							'village_staff_no'	=> $data['profil_nip_sekdes'],
							'village_no'		=> $data['profil_no_register'],
							'village_address'	=> $data['profil_alamat']
							);
		if($cek > 0){ // kalo ada, maka update
			$raw['village_updateby']		= $this->session->userdata('user_id');
			$raw['village_updatetime']		= date('Y-m-d H:i:s');
			$sql 		= $this->db->where('village_code',$key)
									->update('m_village',$raw);
			

		}else{ // kalo ga ada maka create new

			$raw['village_addby']		= $this->session->userdata('user_id');
			$raw['village_addtime']		= date('Y-m-d H:i:s');
			$sql 		= $this->db->insert('m_village',$raw);
			
		}

		if($sql){
					$filename 	= str_replace(' ', '', $data['profil_nama_desa']).'.json';
					$json = json_encode($data);

					if ( ! write_file(APPPATH.'config/json/'.$filename, $json))
					     $return =  'Unable to write the file';
					else
					     $return =  'File written!'; 

			}
		return $return; 			
	}

	
	
}
