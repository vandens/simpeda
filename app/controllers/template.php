<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends CI_Controller {

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
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Surat';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->panel 		= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'surat'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->js_dtable	= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->TEMR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Template Surat';
		$data['mod']		= 'TEMR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->X) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Template Surat';
		$data['mod']		= 'TEMR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	

		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
			
				
		$data['sub']		= $msg;
		$data['mod']		= empty($data['user_id']) ? 'TEMC' : 'TEMU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		
		if(!$this->_priv->X){
			$msg = array('status'=>'danger','msg'=>'Gagal : Anda tidak punya akses pada menu ini');
		}else{
			/*
			try{
				$this->db->trans_begin();
				$key 		= $this->input->post('key',true);
				$raw 		= json_encode($this->db->where('user_id',$key)->get('m_user')->result());
				$sql 		= $this->db->where('resident_no',$key)->delete('m_resident');
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
			*/
			
		}
		
		$this->general->writelog('TEMD',$msg['msg'],$raw); 
			
		echo json_encode($msg); 
		exit;
	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->TEMT){

			$sql			= $this->db->get_where('m_setting',array('set_id'=>$key))->result();
			foreach($sql as $row){
				foreach($row as $k => $v)
					$data[$k] = $v;
			}
			$sql  			= $this->db->where('village_id',$this->session->userdata('village_id'))->get('m_village')->result();
			foreach($sql as $row){
				foreach($row as $k => $v)
					$data[$k] = $v;
			}
			$data['[[CSS]]'] 			= '';
			$data['[[HEADER]]'] 		= $this->load->view('bo/temp/header',$data,true);
			
			$data['[[JUDUL]]']			= strtoupper($data['set_value']);
			
			$data_temp					= read_file(APPPATH.'helpers/surat/'.$key.'.html');
			$msg_content 				= strtr($data_temp,$data);

			$data['temp']	 			= $msg_content; 

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					


		$data['sub']		= 'Detail Surat : '.$data['set_value'];
		$data['mod']		= 'TEMT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->TEMR){
					$_GET['columns'][0]['search']['value'] = 'LET'; #$this->session->userdata('village_code');
					

				$columns 	= array(
					array( 'db' => 'set_id', 	'dt' => 0 ),
					array( 'db' => 'set_value', 'dt' => 1 ),
					array( 'db' => 'set_desc','dt' => 2 ),
					array(
							'db'        => 'set_status',
							'dt'        => 3,
							'formatter' => function( $d, $baris ) {
								return $this->config->item('user_'.$d);
							}
						),
					array(
						'db'        => 'set_id',
						'dt'        => 4,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->TEMT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->TEMU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->TEMD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'm_setting', 'set_key', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */