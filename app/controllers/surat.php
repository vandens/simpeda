<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat extends CI_Controller {

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
        $this->load->model('letter_model');
        $this->_setting 		= $this->general->get_app_setting();
        $this->_priv 				= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
    }

	public function initiate($data)
	{
		$data['menu'] 			= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']				= 'Surat';

		$this->header  			= $this->load->view('fo/header',$data,true);
		$this->panel 				= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'surat'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->js_dtable	= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index(){
		redirect(base_url('surat/log'));
	}

	public function log()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->SURR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Log Surat';
		$data['mod']		= 'SURR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->SURC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Buat Surat Baru' : 'Edit Surat';
		$data['mod']		=  empty($key) ? 'SURC' : 'SURU';
		#$data['dlist']		= $this->general->droplist_setting(array('LET'));


		if(!empty($key))
		{
			#$data['key']	= $key;
			$sql 	= $this->resident_model->get_resident_data($key);
			$data 	= array_merge($data,$sql);			
		}
		$data['true']		= true;
		$data['mod']		= true;
		$data['template']	= $this->load->view(strtolower('bo/'.__CLASS__.'/select_template'),array(),true);
		$data['modal']		= $this->load->view('popup/modal',array(),true);
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function popup($flag){
		$this->load->view('fo/js',array(),true);

		if($flag == 'template')
			$this->load->view('bo/'.strtolower(__CLASS__).'/popup_template');
		else
			$this->load->view('bo/'.strtolower(__CLASS__).'/popup_resident');
	}

	public function popdata($flag){
		$key 	= $this->input->post('key',true);
		$this->load->view('fo/js',array(),true);

		if($flag == 'template'){
			$this->js 				= $this->load->view('fo/js',array(),true);
			$data['sub']			= 'Buat Surat Baru';
			$data['val']			= 'confirm';

			$set 					= $this->db->get_where('m_setting',array('set_id'=>$key))->row();
			$data['key']			= $set->set_key;
			$data['letter_code']	= $set->set_id;
			$data['letter_name']	= $set->set_value;
			$data['letter_id']		= $set->set_order;

			$data 					= $this->letter_model->get_selector($data);
			$this->load->view('bo/'.strtolower(__CLASS__).'/form',$data);

		}elseif($flag == 'resident'){
			$set 	= $this->db->get_where('m_resident',array('resident_no'=>$key))->row();
			echo json_encode($set);
		}
		
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	

		$data['sub']		= 'Konfirmasi Cetak Surat';
		$data['mod']		= empty($post['user_id']) ? 'SURC' : 'SURU';
		$data['val']		= $post['submit'];
		
		#unset($post['key']);
		unset($post['submit']);
		
		if($this->_priv->SURC || $this->_priv->SURU){
					
			$this->form_validation->set_rules('letter_code', 'Kode Surat', 'required|max_length[25]|xss_clean');
						
				if ($this->form_validation->run() == TRUE)
				{				
					if($data['val'] == 'confirm'){
						$data['val']		= 'simpan';				
						
						$data	 			= array_merge($data,$post);	

						$this->session->set_flashdata('data_surat',$data);
						
						$data['letter_no']	= $this->letter_model->get_letter_no();
						$data['temp']	 	= $this->letter_model->set_template($data); 
		
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
					}
				
				}
				else
				{
					
					$data['modal']		= $this->load->view('popup/modal',array(),true);
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
				
		$data 				= $this->session->flashdata('data_surat');
		
		$view 				= 'bo/temp/failed';
		if(!$data){
			$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
		}elseif(!$this->_priv->SURC){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();
					$data['val']				= 'print';			
					$data['letter_no']			= $this->letter_model->get_letter_no();
					$data['temp']	 			= $this->letter_model->set_template($data);
					$this->letter_model->insert_letter_log($data);
					$wd 								= 950;
					if(in_array($data['letter_code'],array('LET09','LET10','LET11','LET12'))){						
						$wd 							= 500;
					}
					
					echo "<script>window.open('".base_url(strtolower(__CLASS__))."/cetak/".$data['letter_no']."','Cetak Pembayaran','width=".$wd.",height=500,resizable=yes,scrollbars=yes,status=yes').focus()</script>";
					

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
		$data['mod']		= empty($data['user_id']) ? 'SURC' : 'SURU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	public function cetak($key){

		$sql 	= $this->db->get_where('t_letter_log',array('letter_no'=>$key,'village_id'=>$this->session->userdata('village_id')))->row();
		echo '<script>window.print()</script>';
		echo $sql->letter_body;
	}
	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		
		if(!$this->_priv->SURD){
			$msg = array('status'=>'danger','msg'=>'Gagal : Anda tidak punya akses pada menu ini');
		}else{

			try{
				$this->db->trans_begin();
				$key 		= $this->input->post('key',true);
				$raw 		= $this->db->where('auto',$key)->get('t_letter_log')->result();
				$sql 		= $this->db->where('auto',$key)->delete('t_letter_log');
				$error_db 	= (!$sql) ? $this->db->_error_message() : '';
				unset($raw[0]->letter_body);

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
		
		$this->general->writelog('SURD',$msg['msg'],json_encode($raw)); 
			
		echo json_encode($msg); 
		exit;
	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->SURT){

			$data['detail']	= $this->db->get_where('list_letter_log',array('auto'=>$key))->row();
			
			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					

		$data['sub']		= $data['detail']->resident_name.' > '.$data['detail']->letter_name;
		$data['mod']		= 'SURT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata($val){

		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->SURR){
				
				$this->load->library('datatable');
				if($val == 'template'){
					
					$_GET['columns'][0]['search']['value'] = 'LET';
					$_GET['columns'][2]['search']['value'] = 'active';
					$table 		= 'm_setting';
					$key 		= 'set_id';
					$columns 	= array(
						array( 'db' => 'set_id', 		
							   'dt' => 0,
							   'formatter'	=> function ($d, $baris){
								   return '<a href="#" onclick="set_template(\''.$d.'\')" data-dismiss="modal" style="cursor:pointer">'.$d.'</a>';
							   }),
						array( 'db' => 'set_value', 'dt' => 1 ),
						array( 'db' => 'set_status','dt' => 2 ),
						array( 'db' => 'set_desc',	'dt' => 3 )
					);	


				}elseif($val == 'resident'){

					if(!$this->session->userdata('admin'))
					$_GET['columns'][0]['search']['value'] = $this->session->userdata('village_name');

					$this->pos  = $this->uri->segment(4);
					$table 		= 'list_resident';
					$key 		= 'resident_no';
					$columns 	= array(
						array( 'db' => 'village_id'),
						array( 'db' => 'village_name', 'dt' => 0 ),
						array( 'db' => 'resident_no', 		
							   'dt' => 1,
							   'formatter'	=> function ($d, $baris){
								   return '<a href="#" onclick="set_resident(\''.$d.'\',\''.$this->pos.'\')" data-dismiss="modal" style="cursor:pointer">'.$d.'</a>';
							   }),
						array( 'db' => 'resident_name', 'dt' => 2 ),
						array( 'db' => 'resident_address',	'dt' => 3 )
					);	

				}else{

					if(!$this->session->userdata('admin'))
					$_GET['columns'][0]['search']['value'] = $this->session->userdata('village_name');
					#$_GET['search']['value'] 	= $this->session->userdata('village_name');
					#$_GET['search']['regex'] 	= true;
					$table 		= 'list_letter_log';
					$key 		= 'auto';
					$columns 	= array(
						#array( 'db' => 'village_id'),
						array( 'db' => 'village_name', 	'dt' => 0 ),
						array( 'db' => 'letter_no', 	'dt' => 1 ),
						array( 'db' => 'letter_name',	'dt' => 2 ),
						array( 'db' => 'resident_no',	'dt' => 3 ),
						array( 'db' => 'resident_name',	'dt' => 4 ),
						array(
								'db'        => 'letter_status',
								'dt'        => 5,
								'formatter' => function( $d, $baris ) {
									return $this->config->item('surat_'.$d);
								}
							),
						array(
							'db'        => 'auto',
							'dt'        => 6,
							'formatter' => function( $d, $baris ) {
								$button	= '';						
								$button	.= ($this->_priv->SURT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
								$button	.= ($this->_priv->SURU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
								$button	.= ($this->_priv->SURD) ? str_replace('#','JHapus(\''.base_url(strtolower(__CLASS__)).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
								$button .= '';
								return $button;
							}
						)
					);		
				
				}	
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), $table, $key, $columns ));
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */