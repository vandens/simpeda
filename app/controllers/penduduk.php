<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penduduk extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Govervment App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model');
        $this->load->model('resident_model'); 
        $this->_setting 		= $this->general->get_app_setting();
        $this->_priv 				= $this->general->get_privi_list();
				$this->_master_priv = $this->general->get_master_priv();
				$this->_droplist 		= $this->resident_model->drop_list();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Penduduk';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->panel 		= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'master'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->js_dtable	= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub'],json_encode($data['raw']));
	}

	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->PENR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Penduduk';
		$data['mod']		= 'PENR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->PENC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Penduduk' : 'Edit Data Penduduk';
		$data['mod']		=  empty($key) ? 'PENC' : 'PENU';

		$data['val']		= 'confirm';
		$data['dlist']		= $this->general->droplist_setting(array('PER','GOL','REL','EDU','STK','STT','STP','JOB'));


		if(!empty($key))
		{
			$data['key']		= $key;
			$data['disabled']	= 'disabled';
			if(!$this->session->userdata('admin'))
				$this->db->where('village_code',$this->session->userdata('village_code'));
			$sql 				= $this->db->where('resident_no',$key)->get('list_resident')->row();
			foreach ($sql as $keys => $vals) {
				$data[$keys] = $vals;
			} 
		#	echo '<pre>'; print_r($this->_droplist); 
		#	echo '<Pre>'; print_R($data); die;		
		}
		
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	

		$data['sub']		= 'Konfirmasi Data Penduduk';
		$data['mod']		= empty($post['user_id']) ? 'PENC' : 'PENU';

		$data['val']		= $post['submit'];
		
		#unset($post['key']);
		unset($post['submit']);

		if(!$this->session->userdata('admin'))
			$this->db->where('village_code',$this->session->userdata('village_code'));
		$sql 				= $this->db->where('resident_no',$post['key'])->get('list_resident')->row();
		foreach ($sql as $keys => $vals){
			$data[$keys] = $vals;
		} 

		
		if($this->_priv->PENC || $this->_priv->PENU){
					
			$this->form_validation->set_rules('resident_no', 'No KTP', 'required|max_length[22]|xss_clean');
			$this->form_validation->set_rules('resident_name', 'Nama Penduduk', 'xss_clean|max_length[25]');
			$this->form_validation->set_rules('resident_card_no', 'No Kartu Keluarga', 'xss_clean|max_length[25]');
			$this->form_validation->set_rules('resident_fm_role', 'Peran dlm Keluarga', 'xss_clean|max_length[25]');
						
				if ($this->form_validation->run() == TRUE)
				{				
					if($data['val'] == 'confirm'){
						$data['val']		= 'simpan';										
						
						$data	 			= array_merge($data,$post);	

						$this->session->set_flashdata('data_penduduk',$data);
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
					}
				
				}
				else
				{
					
					$data['disabled']	= 'disabled';
					$data['dlist']		= $this->general->droplist_setting(array('PER','GOL','REL','EDU','STK','STT','STP','JOB'));
					$data = array_merge($data,$post);

					$view = strtolower('bo/'.__CLASS__.'/form');
				}
				
		}else{
			$view 	= 'bo/no_access';
			#$msg 	= 'Mengakses halaman tidak berizin';
		}

		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
				
		$data 				= $this->session->flashdata('data_penduduk');

		$view 				= 'bo/temp/failed';
		if(!$data){
			$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
		}elseif(!$this->_priv->PENC || !$this->_priv->PENU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();			
					$this->resident_model->update_penduduk($data);					
								
					if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();						
							$msg 	= 'Gagal Update Data Penduduk: '.$error_db;
					}else{
							$this->db->trans_commit();
							$view 	= 'bo/temp/success';
							$msg 	= 'Berhasil Update Data Penduduk';
					}				

							
			} catch (Exception $e) {
				$msg 	= $e;
			}		
						
		}
			
		$data['raw']		= $data;	
		$data['sub']		= $msg;
		$data['mod']		= empty($data['user_id']) ? 'PENC' : 'PENU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		
		if(!$this->_priv->PEND){
			$msg = array('status'=>'danger','msg'=>'Gagal : Anda tidak punya akses pada menu ini');
		}else{

			try{
				$this->db->trans_begin();
				$key 		= $this->input->post('key',true);
				$raw 		= json_encode($this->db->where('user_id',$key)->get('m_user')->result());
				$sql 		= $this->db->where('resident_no',$key)->delete('m_resident');
				$sql 		= $this->db->where('resident_no',$key)->delete('m_resident_doc'); 
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
		
		$this->general->writelog('PEND',$msg['msg'],$raw); 
			
		echo json_encode($msg); 
		exit;
	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->PENT){
		
			$data			= $this->resident_model->get_resident_data($key);

			$data['card']	= $this->resident_model->get_resident_card_list($data['resident_card_no']);
			

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					
		
		$data['sub']		= 'Detail Penduduk : '.ucwords(strtolower($data['resident_name']));
		$data['mod']		= 'PENT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	public function cetak($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->PENT){
		

			$data			= $this->resident_model->get_resident_print($key); 
			$header 		= array('NIK','Nama Lengkap','');
			$view 			= strtolower('bo/'.__CLASS__.'/print_personal');
		}					
		
		$data['sub']		= 'Cetak Personal Data Penduduk : '.$data['list']->NIK;
		$data['mod']		= 'PENT';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->load->view($view,$data);	
	}

	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->PENR){
				if(!$this->session->userdata('admin'))
					$_GET['columns'][0]['search']['value'] = $this->session->userdata('village_code');
					

				$columns 	= array(
					array( 'db' => 'village_code', 		'dt' => 0 ),
					array( 'db' => 'resident_no', 		'dt' => 1 ),
					array( 'db' => 'resident_name', 	'dt' => 2 ),
					array(
						'db'        => 'resident_bday',
						'dt'        => 3,
						'formatter' => function( $d, $baris ) {
							return empty($d) ? '' : date('d M Y',strtotime($d));
						}
					),						
					array( 'db' => 'resident_job', 	'dt' => 4 ),
					array(
						'db'        => 'resident_status',
						'dt'        => 5,
						'formatter' => function( $d, $baris ) {
							return $this->config->item('native_'.$d);
						}
					),	
					array(
						'db'        => 'resident_no',
						'dt'        => 6,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->PENT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->PENU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->PEND) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'list_resident', 'resident_no', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */