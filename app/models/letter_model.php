<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letter_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();			
	}
	
	function get_resident_val($data){
		$res_no 	= array($data['resident_no1'],$data['resident_no2'],$data['resident_no3'],$data['4']);    
		$ar_input	= array('resident_no','resident_name','resident_bplace','resident_bday','resident_of','resident_religion','resident_job','resident_address');

		$res 		= $this->db->where_in('resident_no',$res_no)
						   ->get('m_resident')
						   ->result();
		foreach($res as $row => $val){
			$res_val[$val->resident_no] = $val;
			$cek_exist[] 	= $val->resident_no;
		}
		
		$no = 1;
		foreach ($res_no as $key => $val) {
			if(in_array($val,$cek_exist)){ // kalo ada di DB
				
			foreach ($res_val[$val] as $row => $value) { 
					if($row == 'resident_name')
						$ret_val = strtoupper($value);
					elseif($row == 'resident_bday')
						$ret_val = ucwords(strtolower(date('d M Y',strtotime($value))));
					elseif($row == 'resident_sex')
						$ret_val = ($value == 'L') ? 'Laki-laki' : 'Perempuan';
					else
						$ret_val = ucwords(strtolower($value));

					$return['[['.strtoupper($row).'_'.$no.']]'] = $ret_val;
					unset($data[$row.$no]);
				}
				
			}else{ // kalo ga ada di DB, so ambil dari inputan
				
			foreach($ar_input as $input => $row){
				
					if($row == 'resident_name')
						$ret_val = strtoupper($data[$row.$no]);
					elseif($row == 'resident_bday')
						$ret_val = ucwords(strtolower(date('d M Y',strtotime($data[$row.$no]))));
					elseif($row == 'resident_sex')
						$ret_val = ($data[$row.$no] == 'L') ? 'Laki-laki' : 'Perempuan';
					else
						$ret_val = ucwords(strtolower($data[$row.$no]));
		
						$return['[['.strtoupper($row).'_'.$no.']]'] = $ret_val;
						unset($data[$row.$no]);
					}		
				
			}

			$no++;
		}
		$return = array_merge($data,$return); 
		return $return;
	}

	function set_temp16($data){

		foreach ($data as $key => $value) {
			$exp 	= current(explode('_',$key));
			$no 	= substr($key, -1,1);
			if($exp == 'resident'){
				$return['[['.strtoupper(substr($key,0,-1)).'_'.$no.']]'] = ucwords(strtolower($value));
			}else
			 	$return[$key]	= $value;
		
		}


		return $return;
	}
	
	
	function set_temp18($data){
			if($data['letter_code'] == 'LET02')
				$array	= array('hari_wafat','tanggal_wafat','jam_wafat','sebab_wafat','tempat_wafat');
			elseif($data['letter_code'] == 'LET20')
				$array 	= array('kategori_usaha','jenis_usaha','alamat_usaha','nomor_spbu','alamat_spbu');
			else
				$array 	= array('nama_usaha','jenis_usaha','alamat_usaha','maksud_surat','status_tanah','jumlah_pegawai','penanggung_jawab');
			
			foreach($array as $key => $val){
				$data['[['.strtoupper($val).']]'] = ($val == 'nama_usaha') ? strtoupper($data[$val]) : $data[$val];
				unset($data[$val]);
			}
			return $data; 
	}
	
	function set_temp_table20($data){
				$total 	= 0;
			foreach($data['konsumsi_bbm'] as $row => $val){
				$total 	= bcadd($total,current(explode(' ',$val)));
			}
			
			$vw 													= $this->load->view('bo/surat/selector_LET20_2',$data,true);
			$data['[[TABEL_VERIFIKASI]]'] = $vw;
			$data['[[TOTAL]]']						= $total;
			return $data;
	}
	
	function set_template($data){	
		$data['[[CSS]]']			= ($data['val'] == 'print') ? '<link href="'.base_url('media/css/bootstrap.css').'" rel="stylesheet" media="">' : '';
		$data['[[URL]]']			= base_url();
		$data['[[HEADER]]'] 		= $this->load->view('bo/temp/header',$data,true);						
		$data['[[JUDUL]]']			= strtoupper($data['letter_name']);	
		$data['[[ID_SURAT]]']		= $data['letter_id'];					
		$data['[[NO_SURAT]]']		= $data['letter_no'];
		$data['[[KODE_DESA]]'] 		= strtoupper($this->session->userdata('village_code'));
		$data['[[NAMA_DESA]]'] 		= ucwords($this->session->userdata('village_name'));
		$data['[[NAMA_DESA_CAP]]'] 	= strtoupper($this->session->userdata('village_name'));
		$data['[[NAMA_KEC]]']		= ucwords($this->session->userdata('subdistrict'));
		$data['[[NAMA_KAB]]']		= ucwords($this->session->userdata('district'));
		$data['[[NAMA_PROV]]']		= ucwords($this->session->userdata('province'));
		$data['[[TAHUN]]']			= date('Y');
		$data['[[TGL_LIMIT]]'] 		= date('d M Y',strtotime($data['tgl_limit']));
		$data['[[TANGGAL]]'] 		= date('d M Y',strtotime($data['letter_date']));
		$data['[[NAMA_SEKDES]]']	= strtoupper($this->session->userdata('village_staff'));
		$data['[[NIP_SEKDES]]']		= $this->session->userdata('village_staff_no');
		$data['[[NAMA_KEPDES]]']	= strtoupper($this->session->userdata('village_head'));
		$data['[[SIGN_BY]]']		= ($data['sign_by'] == 1) ? strtoupper($this->session->userdata('village_head')) : strtoupper($this->session->userdata('village_staff'));
		$data['[[SIGN_NO]]'] 		= ($data['sign_by'] == 1) ? '' : 'NIP : '.$this->session->userdata('village_staff_no');
		$data['[[BY]]']				= ($data['sign_by'] == 1) ? 'Kepala Desa ' : 'Sekretaris Desa ';
		$data['[[STAFF_NO]]']		= $this->session->userdata('village_staff_no');

		if($data['letter_code'] == 'LET16'){
			
			$res_val 				= $this->set_temp16($data);
		
		}elseif($data['letter_code'] == 'LET02' || $data['letter_code'] == 'LET17' || $data['letter_code'] == 'LET18'){
			
			$data					  = $this->set_temp18($data); // temp 02, 17 dan 18 sama
			
			$res_val 				= $this->get_resident_val($data);
		
		}elseif ($data['letter_code'] == 'LET20'){
		
			$data 					= $this->set_temp18($data);
			$data 					= $this->set_temp_table20($data);
			$res_val				= $this->get_resident_val($data);
	
		#}elseif($data['letter_code'] == 'LET12'){
			
		#	$res_val 				= $this->set_temp14($data);
			
		#}elseif($data['letter_code'] == 'LET14'){
		
		#	$res_val 					= $this->set_temp14($data);
		
		}else{
		
			$res_val				= $this->get_resident_val($data);
	
		}
		
		$data 						= array_merge($data,$res_val);

		$data_temp					= read_file(APPPATH.'helpers/surat/'.$data['letter_code'].'.html');
		$msg_content 				= strtr($data_temp,$data);

		return $msg_content;
	}

	function get_letter_no(){

		$sql = $this->db->select_max('letter_no','let_no')
				->where('village_id',$this->session->userdata('village_id'))
				->where('SUBSTR(letter_addtime,1,4)',date('Y'))
				->get('t_letter_log')
				->row();
		$let_no 	= str_pad(bcadd($sql->let_no,1), 3,'0',STR_PAD_LEFT);
		
		return $let_no;
	}

	function insert_letter_log($data){

		$insert 	= array('letter_no'			=> $data['letter_no'],
							'village_id'		=> $this->session->userdata('village_id'),
							'letter_code'		=> $data['letter_code'],
							'resident_no'		=> $data['resident_no1'],
							'letter_body'		=> $data['temp'],
							'letter_status'		=> 'completed',
							'letter_addby'		=> $this->session->userdata('user_id'),
							'letter_addtime'	=> date('Y-m-d H:i:s'));
		$this->db->insert('t_letter_log',$insert);
	}

	function get_selector($data){
		if(in_array($data['letter_code'],array('LET14','LET16'))){
			
			$temp1['selector']	= 'selector_'.$data['letter_code'];
			$temp1['sm']				= 6;
			
		}elseif(in_array($data['letter_code'],array('LET02','LET17','LET18'))){
			
			$temp1['selector']	= 'select_resident1';
			$temp1['sm']				= 6;
			$temp2['selector']	= 'selector_'.$data['letter_code'];
					
		}elseif(in_array($data['letter_code'],array('LET05','LET10','LET11','LET12','LET20'))){
			
				$temp1['title']			= 'Data Anak';
				$temp1['selector'] 	= 'select_resident1';
				$temp1['sm']				= in_array($data['letter_code'],array('LET12')) ? 6 : 4;			
				$temp2['title']			= 'Data Ayah';
				$temp2['selector'] 	= 'select_resident2';
				$temp2['sm']				= in_array($data['letter_code'],array('LET12')) ? 6 : 4;	
				$temp3['title']			= 'Data Ibu';
				$temp3['selector'] 	= 'select_resident3';
				$temp3['sm']				= in_array($data['letter_code'],array('LET12')) ? 6 : 4;
				
			if($data['letter_code'] == 'LET20'){		
				unset($temp1['title']);
				$temp1['sm']				= 6;		
				$temp2['title']			= 'Keterangan Usaha & Penyalur';
				$temp2['selector'] 	= 'selector_LET20_1';
				$temp2['sm']				= 6;	
				$temp3['title']			= 'Verifikasi Kebutuhan BBM';
				$temp3['selector'] 	= 'selector_LET20_2';
				$temp3['sm']				= 12;		
			}elseif($data['letter_code'] == 'LET12'){				
				$temp4['selector'] 	= 'selector_LET12';
				$temp4['sm']				= in_array($data['letter_code'],array('LET12')) ? 6 : 4;
			}
			
			
		}else{
			
			$temp1['title']			= 'Data Penduduk';
			$temp1['selector'] 	= 'select_resident1';
			$temp1['sm']				= 6;
			
		}

		$data['template']		= $this->load->view('bo/surat/select_template',$data,true);
		$data['resident1']		= ($temp1) ? $this->load->view('bo/surat/'.$temp1['selector'],$temp1,true) : '';
		$data['resident2']		= ($temp2) ? $this->load->view('bo/surat/'.$temp2['selector'],$temp2,true) : '';
		$data['resident3']		= ($temp3) ? $this->load->view('bo/surat/'.$temp3['selector'],$temp3,true) : '';
		$data['resident4']		= ($temp4) ? $this->load->view('bo/surat/'.$temp4['selector'],$temp4,true) : '';
		
		return $data;	
	}


	
	
}
