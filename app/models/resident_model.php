<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resident_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();			
	}
	
	function drop_list(){
		$list 					= new stdClass();
		
		if($this->session->userdata('admin') === FALSE) $this->db->where('village_code',$this->session->userdata('village_code'));
		
		$list->list_village		= $this->db->where('village_status','active')
										   ->get('m_village')->result();
		
		return $list;
	}

	function get_resident_data($key){
		$sql 	= $this->db->select('c.*, b.village_name, a.resident_card_village, a.resident_card_village_no')
							->from ('m_resident_card a')
							->join ('m_village b','a.village_code = b.village_code','left')
							->join ('m_resident c','a.resident_card_no = c.resident_card_no','left')
							->where('c.resident_no',$key)
							->get();

		if($sql->num_rows() > 0){
			foreach($sql->result() as $row)
				foreach($row as $key => $val)
					$return[$key] = $val;
		}else $return = array();

		return $return;

	}

	function get_resident_print($key){
		$sql['list'] = $this->db->select(
							array("a.resident_no as 		'NIK'",
								  "a.resident_name as 		'Nama Lengkap'",
								  "a.resident_bplace as 	'Tempat Lahir'",
								  "a.resident_bday as 		'Tanggal Lahir'",
								  "a.resident_sex as 		'Jenis Kelamin'",
								  "a.resident_bloodtype as 	'Golongan Darah'",
								  "a.resident_religion as 	'Agama'",
								  "a.resident_education as 	'Pendidikan Terakhir'",
								  "a.resident_job as 		'Pekerjaan'",
								  "a.resident_marriage as 	'Status Perkawinan'",
								  "a.resident_of as 		'warganegara'",
								  "a.resident_fm_role as 	'Status Hubungan dalam Keluarga'",
								  "a.resident_m_name as 	'Nama Lengkap Ibu'",
								  "a.resident_f_name as 	'Nama Lengkap Ayah'",
								  "a.resident_address as 	'Alamat'",
								  "substr(b.resident_card_village_no, 1,2) as 'RT'",
								  "substr(b.resident_card_village_no, 4,5) as 'RW'",
								  "b.resident_card_village as 'Dusun'",
								  "c.village_name as 		'Desa/Kelurahan'",

								  )
						)
						->from('m_resident a')
						->join('m_resident_card b','a.resident_card_no = b.resident_card_no')
						->join('m_village c','b.village_code = c.village_code')
						->where('a.resident_no',$key)
						->get()->row();

		$sql['doc']	= $this->db->select('*')
							   ->from('m_resident_doc')
							   ->where('resident_no',$key)
							   ->get()->result();
		return $sql;
	}


	function get_resident_card_list($key, $single = false){
		$fields = ($single) ? 'a.*' : 'b.resident_no, a.resident_card_no, b.resident_fm_role, a.resident_card_village, a.resident_card_village_no, b.*, d.village_name';
		$sql	= $this->db->select($fields)
						   ->from('m_resident_card a')
						   ->join('m_resident b','a.resident_card_no = b.resident_card_no','left')
						   ->join('m_setting c','b.resident_fm_role = c.set_value')
						   ->join('m_village d','a.village_code = d.village_code')
						   ->where('a.resident_card_no',$key)
						   ->order_by('c.set_order ASC')
						   ->get();

		return ($single) ? $sql->row() : $sql->result();
	}

	function get_village_code($key){
		$sql 	= $this->db->query('SELECT CONCAT(a.village_code,"_",b.village_name) as village_code, a.resident_card_no, a.resident_card_village, a.resident_card_village_no 
									 FROM m_resident_card a 
									 LEFT JOIN m_village b ON a.village_code = b.village_code
									 WHERE a.resident_card_no = ?',$key)->row();
		return $sql;
	}


	function add_family($data){
		$key 			 				 = $data['key'];
		$data['resident_card_no'] 		 = !isset($data['is_card_no']) 		? $data['resident_card_no'] : 'C'.date('Ymd').strtotime(date('Y-m-d H:i:s'));
		$data['resident_no']     	 	 = !isset($data['is_resident_no']) 	? $data['resident_no'] : 'R'.date('Ymd').strtotime(date('Y-m-d H:i:s'));
		
		if(empty($key)){
			$this->db->insert('m_resident_card',array('village_code'			=> $data['village_code'],
													  'resident_card_no'		=> $data['resident_card_no'],
												  	  'resident_card_village'	=> $data['resident_card_village'],
												  	  'resident_card_village_no'=> $data['resident_card_village_no'],
												      'resident_card_addby'		=> $this->session->userdata('user_id'),
												      'resident_card_addtime'	=> date('Y-m-d H:i:s')));

		}

		unset($data['key']);
		unset($data['sub']);
		unset($data['val']);
		unset($data['mod']);
		unset($data['village_code']);
		unset($data['resident_card_village']);
		unset($data['resident_card_village_no']);
		unset($data['is_card_no']);
		unset($data['is_resident_no']);
		unset($data['edit']);

		$data['resident_addby']		= $this->session->userdata('user_id');
		$data['resident_addtime']	= date('Y-m-d H:i:s');
		$this->db->insert('m_resident',$data);
	}

	function edit_family($data){

		$update['resident_card_no']			= $data['resident_card_no'];
		$update['resident_card_village']	= $data['resident_card_village'];
		$update['resident_card_village_no']	= $data['resident_card_village_no'];
		$update['resident_card_updateby']	= $this->session->userdata('user_id');
		$update['resident_card_updatetime']	= date('Y-m-d H:i:s');

		if($this->session->userdata('admin'))
			$update['village_code']			= $data['village_code'];

		$this->db->where('resident_card_no',$data['key'])
				 ->update('m_resident_card',$update);

		$this->db->where('resident_card_no',$data['key'])
				 ->update('m_resident',array('resident_card_no'		=>$data['resident_card_no'],
				 							 'resident_updateby'	=> $this->session->userdata('user_id'),
				 							 'resident_updatetime'	=> date('Y-m-d H:i:s')));

	}

	function update_penduduk($data){
		$key 	= $data['key'];

		unset($data['key']);
		unset($data['sub']);
		unset($data['val']);
		unset($data['mod']);
		unset($data['edit']);
		unset($data['auto']);

		unset($data['village_code']);
		unset($data['count_family']);
		unset($data['resident_card_status']);
		unset($data['resident_card_village']);
		unset($data['resident_card_village_no']);
		unset($data['village_name']);

		$updateby 			= $this->session->userdata('user_id');
		$updatetime 		= date('Y-m-d H:i:s');

		$data['resident_updateby']	= $updateby;
		$data['resident_updatetime']= $updatetime;
		$this->db->where('resident_no',$key)->update('m_resident',$data);
		$this->db->where('resident_no',$key)->update('m_resident_doc',array('resident_no'=>$data['resident_no']));
	}

	/*

	function master_process($data){
		$key 		= $data['key'];
		$card_no 	= $data['resident_card_no'];
		$fm_role	= $data['resident_fm_role'];
		
		unset($data['key']);
		unset($data['sub']);
		unset($data['val']);
		unset($data['mod']);
		unset($data['resident_card_no']);
		unset($data['resident_fm_role']);

		$data['resident_status']		= 'active';
		if(!empty($key)){ // kalo ada, maka update
			$data['resident_updateby']	= $this->session->userdata('user_id');
			$data['resident_updatetime']= date('Y-m-d H:i:s');
			$this->db->where('resident_no',$key)->update('m_resident',$data);

			$this->db->where(array('resident_no'		=>$key,
								   'resident_card_no'	=>$card_no))
					 ->update('m_resident_card',array('resident_fm_role'		=> $fm_role,
					 								  'resident_card_updateby'	=> $this->session->userdata('user_id'),
					 								  'resident_card_updatetime'=> date('Y-m-d H:i:s')));

		}else{ // kalo ga ada maka create new
			
			$data['resident_addby']		= $this->session->userdata('user_id');
			$data['resident_addtime']	= date('Y-m-d H:i:s');
			$this->db->insert('m_resident',$data);
			$this->db->insert('m_resident_card',array('resident_no'				=> $data['resident_no'],
													  'resident_card_no'		=> $card_no,
													  'resident_fm_role'		=> $fm_role,
													  'resident_card_addby'		=> $this->session->userdata('user_id'),
													  'resident_card_addtime'	=> date('Y-m-d H:i:s')));
		}
	}

	*/

	
	
}
