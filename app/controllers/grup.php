<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grup extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Govervment App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Grup';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->panel 		= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'akses'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->js_dtable	= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->GROR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Grup';
		$data['mod']		= 'grup';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->GROC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Grup' : 'Edit Data Grup';
		$data['mod']		=  empty($key) ? 'GROC' : 'GROU';

		$data['val']		= 'confirm';
		$data['dlist']		= $this->general->droplist_setting(array('STA'));

		$data['privlist'] 	= array();

		if($this->uri->segment(3,true)){

			$sql 	= $this->db->get_where('m_group',array('group_id'=>$key))->result();
			foreach($sql as $row)
				foreach($row as $r => $w)
					$data[$r] = $w;

			$data['privlist'] 		= $this->user_model->get_exist_priv($key);			
			
			$data['confirm_priv']	= $this->user_model->confirm_priv($this->_master_priv,$data['privlist']);

		}

		
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	

		$data['sub']		= 'Konfirmasi Data Grup';
		$data['mod']		= empty($post['group_id']) ? 'GROC' : 'GROU';

		$post 				= $this->input->post();
					
		if(isset($post['priv'])){
			foreach($post['priv'] as $p => $val)
				$post['privlist'][] = $p;
		}
					
		$failed			= array();
					
		$data['key'] 	= $post['key'];
		$data['val']	= $post['submit'];
		$data['sql']	= $this->db->where('modul_status','active')
								   ->order_by('modul_name ASC')
								   ->get('m_modul')
								   ->result();
		
		unset($post['key']);
		unset($post['submit']);
			
		if($this->_priv->GROC || $this->_priv->GROU){
					
			$this->form_validation->set_rules('group_id', 'Kode Grup', 'required|max_length[5]|xss_clean');
			$this->form_validation->set_rules('group_name', 'Nama Grup', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('group_desc', 'Deskripsi', 'required|xss_clean');
			$this->form_validation->set_rules('group_status', 'Status Grup', 'required|xss_clean');
			
				if ($this->form_validation->run() == TRUE)
				{
					
					if($data['val'] == 'confirm'){
						$data['val']		= 'simpan';	
						$data['confirm_priv']	= $this->user_model->confirm_priv($this->_master_priv,$post['privlist']);						
						$data	 = array_merge($data,$post);
						$this->session->set_flashdata('data_grup',$data);
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
						$msg 	= 'Konfirmasi Grup '.$post['group_name'];
					}
				
				}
				else
				{
						
					$data['privlist'] = array();
					$data = array_merge($data,$post);
					$view = strtolower('bo/'.__CLASS__.'/form');
				}
		}else{
			$view = 'bo/temp/no_access';
			$msg 	= 'Mengakses halaman tidak berizin';
		}

		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
				
		$data 				= $this->session->flashdata('data_grup');

		$view 				= 'bo/temp/failed';
		if(!$data){
			$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
		}elseif(!$this->_priv->GROC || !$this->_priv->GROU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
				
					$this->db->trans_begin();
					$key 		= $data['key'];
									
					$grup 		= array('group_id'			=> $data['group_id'],
										'group_name'		=> $data['group_name'],
										'group_desc'		=> $data['group_desc'],
										'group_status'		=> strtolower($data['group_status']));
					$priv 		= array();
					$priv[]		= array('user_priv_id'=>$data['group_id'],'priv_code'=>'HELR');
					$priv[]		= array('user_priv_id'=>$data['group_id'],'priv_code'=>'KAMR');
																	
					if(empty($key)){
							$pri 					= 'GROC';							
							$grup['group_addby']	= $this->session->userdata('user_id');
							$grup['group_addtime']	= date('Y-m-d H:i:s');
												
							$sql 		= $this->db->insert('m_group',$grup);
							$error_db 	= (!$sql) ? $this->db->_error_message() : '';
								
							foreach($data['privlist'] as $keys => $val){
										$priv[]	= array('user_priv_id'		=> $data['group_id'],
														'priv_code'			=> $val);
									}
									
										
							$sql2 		= $this->db->insert_batch('m_priv_user',$priv);
							$error_db 	.= (!$sql2) ? $this->db->_error_message() : '';			
					}else{		
							$pri 						= 'GROU';				
							$grup['group_updateby']		= $this->session->userdata('user_id');
							$grup['group_updatetime']	= date('Y-m-d H:i:s');
								
							$sql 		= $this->db->where('group_id',$key)->update('m_group',$grup);					
							$error_db 	= (!$sql) ? $this->db->_error_message() : '';	
							
							$this->db->where('user_priv_id',$key)->delete('m_priv_user');
							foreach($data['privlist'] as $keys => $val){
										$priv[]	= array('user_priv_id'		=> $key,
														'priv_code'			=> $val);
									}		
							$sql2		 = $this->db->insert_batch('m_priv_user',$priv);
							$error_db 	.= (!$sql2) ? $this->db->_error_message() : '';	
				
					}
								
					if ($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();						
						$msg 	= 'Gagal Simpan Data : '.$error_db;
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
		$data['mod']		= empty($data['user_id']) ? 'GROC' : 'GROU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		
		if(!$this->_priv->GROD){
			$msg = array('status'=>'danger','msg'=>'Gagal : Anda tidak punya akses pada menu ini');
		}else{

			try{
				$this->db->trans_begin();
				$key 	 = $this->input->post('key',true);
							
				$user = $this->db->where('group_id',$key)
								 ->where('user_status','active')->get('m_user')->num_rows();
				if($user > 0)
					$msg 		= array('status'=>'danger','msg'=>'Gagal : Grup masih digunakan');
				else{

					$raw 		= json_encode($this->db->where('group_id',$key)->get('m_group')->result());

					$sql 		= $this->db->where('group_id',$key)->delete('m_group');
					$sql1		= $this->db->where('user_priv_id',$key)->delete('m_priv_user');
					$error_db 	= (!$sql || !$sql1) ? $this->db->_error_message() : '';
											
					if ($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();					
						$msg 	= array('status'=>'danger','msg'=>'Data gagal dihapus : '.$error_db);
					}else{
						$this->db->trans_commit();
						$msg 	= array('status'=>'success','msg'=>'Data berhasil dihapus');
					}
					
				}
			     												
			} catch (Exception $msg) {
				$msg['msg']	= $msg;						
			}
			
		}
		
		$this->general->writelog('GROD',$msg['msg'],$raw); 
			
		echo json_encode($msg); 
		exit;
	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->GROT){
		
			$sql			= $this->db->where('group_id',$key)->get('m_group')->result();

			foreach($sql as $row){
				foreach($row as $r => $w)
					$data[$r]	= $w;
			}

			$data['privlist'] 		= $this->user_model->get_exist_priv($key);

			$data['confirm_priv']	= $this->user_model->confirm_priv($this->_master_priv,$data['privlist']);
			
					echo '<pre>'; print_r($this->_master_priv);
					echo '<pre>'; print_R($data['privlist']); 
					echo '<pre>'; print_r($data['confirm_priv']); die;

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}		
	
		
		$data['sub']		= 'Detail Grup : '.$data['group_name'];
		$data['mod']		= 'GROT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->GROR){
			#	if(!$this->session->userdata('admin'))
			#		$_GET['columns'][3]['search']['value'] = $this->session->userdata('village_code');
					

				$columns 	= array(
									array( 'db' => 'group_id', 			'dt' => 0 ),
									array( 'db' => 'group_name', 		'dt' => 1 ),
									array( 'db' => 'group_status', 		'dt' => 2, 'formatter'	=> function($d,$baris){ return $this->config->item('user_'.$d); } ),
									array( 'db' => 'group_addby', 		'dt' => 3 ),
									array(
										'db'        => 'group_addtime',
										'dt'        => 4,
										'formatter' => function( $d, $baris ) {
											return date('d M Y H:i:s',strtotime($d));
										}
									),	
									array(
										'db'        => 'group_id',
										'dt'        => 5,
										'formatter' => function( $d, $baris ) {
											$button	= '';						
											$button	.= ($this->_priv->GROT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
											$button	.= ($this->_priv->GROU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
											$button	.= ($this->_priv->GROD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
											$button .= '';
											return $button;
										}
									),
								);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'm_group', 'group_id', $columns ));	
			}	
	}


}

/* End of file Grup.php */
/* Location: ./application/controllers/home.php */