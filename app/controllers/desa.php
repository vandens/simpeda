<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Desa extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Govervment App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('desa_model');
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Desa';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->panel 		= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'master'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->js_dtable	= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->DESR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		#echo '<pre>'; print_r($this->session->all_userdata()); die;

		$data['sub'] 		= 'Data Desa';
		$data['mod']		= 'DESR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	private function get_temp($data,$key =''){

		if(! empty($key)){
			$sql 	= $this->db->get_where('m_village',array('village_code'=>$key))->result();
			foreach($sql as $row)
				foreach($row as $r => $w)
					$data[$r] = $w;

			$json_data		= $this->desa_model->json_to_single(strtolower(str_replace(' ', '', $data['village_name'])));	
			foreach($json_data as $json => $val)
				$data['data'][$json] 	= $val;
		}

		$data['temp']		= $this->desa_model->json_to_temp();

		$data['tab_profil']	= $this->load->view('bo/desa/tab_profil',$data,true);	
		$data['tab_wilayah']= $this->load->view('bo/desa/tab_wilayah',$data,true);
		$data['tab_pertanahan']= $this->load->view('bo/desa/tab_pertanahan',$data,true);
		$data['tab_bangunan']= $this->load->view('bo/desa/tab_bangunan',$data,true);
		return $data;
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ((!$this->session->userdata('admin') AND !empty($key) AND $this->_priv->DESC || $this->_priv->DESU AND $this->session->userdata('village_code') == $key) || ($this->session->userdata('admin') AND $this->_priv->DESC || $this->_priv->DESU)) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ

		$data['sub'] 		=  empty($key) ? 'Tambah Data Desa' : 'Edit Data Desa';
		$data['mod']		=  empty($key) ? 'DESC' : 'DESU';

		$data['val']		= 'confirm';
		$data['dlist']		= $this->general->droplist_setting(array('STA'));

		$temp 				= $this->get_temp($data,$key);
		$data 				= array_merge($data,$temp);

				
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	
		$data['data']		= $post;

		$data['sub']		= 'Konfirmasi Data Desa';
		$data['mod']		= empty($post['key']) ? 'DESC' : 'DESU';
		
		#$data['key'] 		= $post['key'];
		$data['val']		= $post['submit'];
		
		#unset($post['key']);
		unset($post);
		
		if($this->_priv->DESC || $this->_priv->DESU){
					
			$this->form_validation->set_rules('profil_kode_desa', 'Kode Desa', 'required|max_length[35]|xss_clean');
			$this->form_validation->set_rules('profil_nama_desa', 'Nama Desa', 'required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('profil_kepala_desa', 'Kepala Desa', 'required|max_length[100]|xss_clean');			
			$this->form_validation->set_rules('profil_nama_sekdes', 'Nama Sekretaris Desa', 'required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('profil_nip_sekdes', 'NIP Sekretaris Desa', 'required|max_length[100]|xss_clean');
			
						
				if ($this->form_validation->run() == TRUE)
				{				
					if($data['val'] == 'confirm'){
						$data['val']		= 'simpan';								
						
						$this->session->set_flashdata('data_desa',$data);
						$data['confirm']	= $this->desa_model->array_to_json_view($data['data']);
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
					}
				
				}
				else
				{
					$data 				= array_merge($data,$post);
					$temp 				= $this->get_temp($data);
					$data 				= array_merge($data,$temp);

					$data['dlist']		= $this->general->droplist_setting(array('STA'));
					$view = strtolower('bo/'.__CLASS__.'/form');
				}
				
		}else{
			$view 	= 'bo/temp/no_access';
			#$msg 	= 'Mengakses halaman tidak berizin';
		}

		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
				
		$data 				= $this->session->flashdata('data_desa');

		$view 				= 'bo/temp/failed';
		if(!$data){
			$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
		}elseif(!$this->_priv->DESC || !$this->_priv->DESU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();
					
					unset($data['data']['key']);
					unset($data['data']['submit']);
					$ret = $this->desa_model->data_proses($data['data']);

					if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();						
							$msg 	= 'Gagal Simpan Data '.$ret.' : '.$error_db;
					}else{
							$this->db->trans_commit();
							$view 	= 'bo/temp/success';
							$msg 	= 'Berhasil Simpan Data';
							
					}
												
			} catch (Exception $e) {
				$msg 	= $e;
			}		
						
		}
				
		$data['sub']		= $msg;
		$data['mod']		= empty($data['user_id']) ? 'DESC' : 'DESU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		
		if(!$this->_priv->DESD){
			$msg = array('status'=>'danger','msg'=>'Gagal : Anda tidak punya akses pada menu ini');
		}else{

			try{
				$this->db->trans_begin();
				$key 		= $this->input->post('key',true);
				$raw 		= json_encode($this->db->where('village_code',$key)->get('m_village')->result());
				$sql 		= $this->db->where('village_code',$key)->delete('m_village');
				$error_db 	= (!$sql) ? $this->db->_error_message() : '';
										
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();					
					$msg 	= array('status'=>'danger','msg'=>'Data gagal dihapus : '.$error_db);
				}else{
					$this->db->trans_commit();
					$msg 	= array('status'=>'success','msg'=>'Data berhasil dihapus');
				}
															
			} catch (Exception $msg) {
				$msg['msg']	= $msg;				
			}
			
		}
		
		$this->general->writelog('DESD',$msg['msg'],$raw); 
			
		echo json_encode($msg); 
		exit;
	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->DEST){

			$sql 	= $this->db->get_where('m_village',array('village_code'=>$key))->row();
			$name 	= strtolower(str_replace(' ', '', $sql->village_name));

			$json_to_single_array	= $this->desa_model->json_to_single($name);

			$data['confirm']		= $this->desa_model->array_to_json_view($json_to_single_array);
			$view 			= strtolower('bo/'.__CLASS__.'/confirm');
		}					
		
		$data['sub']		= 'Detail Desa : '.ucwords($sql->village_name);
		$data['mod']		= 'DEST';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->DESR){
				if(!$this->session->userdata('admin'))
					$_GET['columns'][0]['search']['value'] = $this->session->userdata('village_code');	

					$columns 	= array(
						array( 'db' => 'village_code', 	'dt' => 0 ),
						array( 'db' => 'village_name', 	'dt' => 1 ),
						array( 'db' => 'village_head', 	'dt' => 2 ),
						array( 'db' => 'village_no', 	'dt' => 3 ),
						array(
							'db'        => 'village_status',
							'dt'        => 4,
							'formatter' => function( $d, $baris ) {
								return $this->config->item('user_'.$d);
							}
						),	
						array(
							'db'        => 'village_code',
							'dt'        => 5,
							'formatter' => function( $d, $baris ) {
								$button	= '';						
								$button	.= ($this->_priv->DEST) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
								$button	.= ($this->_priv->DESU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
								$button	.= ($this->_priv->DESD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
								$button .= '';
								return $button;
							}
						)
					);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'm_village', 'village_code', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */