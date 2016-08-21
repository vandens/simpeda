<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('user_model');
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
		$this->_droplist 	= $this->user_model->drop_list();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'User';

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
		$view 				= ($this->_priv->USER) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Pengguna';
		$data['mod']		= 'user';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->USEC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Pengguna' : 'Edit Data Pengguna';
		$data['mod']		=  empty($key) ? 'USEC' : 'USEU';

		$data['val']		= 'confirm';
		$data['dlist']		= $this->general->droplist_setting(array('STA'));

		if($this->uri->segment(3)){
			#$data['privlist']= $this->general->get_privi_list(true);
			$sql 	= $this->db->get_where('m_user',array('user_id'=>$key))->result();
			foreach($sql as $row)
				foreach($row as $r => $w)
					$data[$r] = $w;

			$user_priv_id = ($data['user_isgroup'] == 'Yes') ? $data['group_id'] : $data['user_id'];
			$data['privlist'] 		= $this->user_model->get_exist_priv($user_priv_id);	
		}

		
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	

		$data['sub']		= 'Konfirmasi Data Pengguna';
		$data['mod']		= empty($post['user_id']) ? 'USEC' : 'USEU';

		if(isset($post['priv']) && $post['user_isgroup'] == 'No')
			foreach($post['priv'] as $p => $val) $post['privlist'][] = $p;
		
		#$data['key'] 		= $post['key'];
		$data['val']		= $post['submit'];
		
		#unset($post['key']);
		unset($post['submit']);
		
		if($this->_priv->USEC || $this->_priv->USEU){
					
			$this->form_validation->set_rules('user_fullname', 'Nama Pengguna', 'required|max_length[50]|xss_clean');
			($post['user_isgroup'] == 'Yes') ? $this->form_validation->set_rules('group_id', 'Group Akses', 'required|xss_clean|max_length[12]') : '';
			$this->form_validation->set_rules('user_phone', 'No Telepon', 'xss_clean|max_length[12]');
			$this->form_validation->set_rules('user_email', 'Email', 'required|max_length[50]|xss_clean');
			
						
				if ($this->form_validation->run() == TRUE)
				{				
					if($data['val'] == 'confirm'){
						$data['val']		= 'simpan';										
						if(empty($post['user_id'])){
							$data['new_id'] 	= strtoupper(substr(str_replace(' ','',$post['user_fullname']),0,5)).str_pad(rand(10,1000),3,'0',STR_PAD_LEFT);
						}
						
						$data['confirm_priv']	= $this->user_model->confirm_priv($this->_master_priv,$post['privlist']);
						
						$data	 				= array_merge($data,$post);	

						$this->session->set_flashdata('data_user',$data);
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
					}
				
				}
				else
				{
					
					$data['dlist']			= $this->general->droplist_setting(array('STA'));
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
				
		$data 				= $this->session->flashdata('data_user');

		$view 				= 'bo/temp/failed';
		if(!$data){
			$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
		}elseif(!$this->_priv->USEC || !$this->_priv->USEU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();					
					$data['key']	= empty($data['user_id']) ? $data['new_id'] : $data['user_id'];
					#$this->model_user->insert_user_shop($data);
					$this->user_model->master_process($data);
					$this->user_model->insert_priv($data);
					
								
					if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();						
							$msg 	= 'Gagal Simpan Data : '.$error_db;
					}else{
							$this->db->trans_commit();
							$view 	= 'bo/temp/success';
							$msg 	= 'Berhasil Simpan Data';
							
						if($data['pass_ismail'] != 0)
							echo "<script>window.open('".base_url('user/mailpass/'.$data['key'].'/'.$data['pass_ismail'])."','Informasi Kata Sandi','width=750,height=626,resizable=yes,scrollbars=yes,status=yes')</script>";
						
					}
					

							
			} catch (Exception $e) {
				$msg 	= $e;
			}		
						
		}
				
		$data['sub']		= $msg;
		$data['mod']		= empty($data['user_id']) ? 'USEC' : 'USEU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}



	public function mailpass(){
		$key 			= $this->uri->segment(3,true);
		$ismail 		= $this->uri->segment(4,true);
		
		$sql 			= $this->db->get_where('m_user',array('user_id'=>$key));
		if($sql->num_rows() > 0){
			foreach($sql->result() as $row);
			$group 			= ($row->user_isgroup == 'Yes') ? $row->group_id : 'Custom User';
			$data 			= array('[[HEADER]]'		=> $this->load->view('popup/header',array(),true),
									'[[ACTOR]]'			=> $this->session->userdata('user_fullname'),
									'[[USER_FULLNAME]]'	=> $row->user_fullname,
									'[[USER_ID]]'		=> $row->user_id,
									'[[GROUP_ID]]'		=> $group,
									'[[USER_PASS]]'		=> $row->user_clrtext,
									'[[APP_NAME]]'		=> $this->_setting->app_name,
									'[[EMAIL]]'			=> $this->_setting->app_email,
									'[[BASE_URL]]'		=> base_url());

			$temp				= ($ismail == 1) ? 'pass_postalmail.html' : 'pass_email.html';
			$data_temp			= file_get_contents(APPPATH.'helpers/email/'.$temp);
			$msg_content 		= strtr($data_temp,$data);
				
			if($ismail == 1){ // kalo postal mail
				echo $msg_content;	exit();					
			}elseif($ismail == 2){ // kalo send email
				
				$this->load->library('email');
				$config['useragent']	= $this->_setting->app_name;
				$config['mailtype']		= 'html';
				$this->email->initialize($config);					
				$this->email->from($this->_setting->app_noreply,$this->_setting->app_name);
				$this->email->to($row->user_email);
				$this->email->subject('Informasi Akun Pengguna');
				$this->email->message($msg_content);
				$kirim = $this->email->send();
				echo '<h2>Proses kirim email...</h2>';
				if($kirim)
					echo 'berhasil';
				else
					print_r($this->email->print_debugger());	
				sleep(10);
				echo '<script>window.close()</script>';					
			}
		
		}
	}
	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		
		if(!$this->_priv->USED){
			$msg = array('status'=>'danger','msg'=>'Gagal : Anda tidak punya akses pada menu ini');
		}else{

			try{
				$this->db->trans_begin();
				$key 		= $this->input->post('key',true);
				$raw 		= json_encode($this->db->where('user_id',$key)->get('m_user')->result());
				$sql 		= $this->db->where('user_id',$key)->delete('m_user');
				$sql1 		= $this->db->where('user_priv_id',$key)->delete('m_priv_user');
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
		
		$this->general->writelog('USED',$msg['msg'],$raw); 
			
		echo json_encode($msg); 
		exit;
	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->USET){
		
			$sql			= $this->user_model->get_user_detail($key);

			foreach($sql as $row){
				foreach($row as $r => $w)
					$data[$r]	= $w;
			}
			$user_priv_id = ($data['user_isgroup'] == 'Yes') ? $data['group_id'] : $data['user_id'];
			$data['privlist'] 		= $this->user_model->get_exist_priv($user_priv_id);			
			
			$data['confirm_priv']	= $this->user_model->confirm_priv($this->_master_priv,$data['privlist']);

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					
		
		$data['sub']		= 'Detail Pengguna : '.$data['user_fullname'];
		$data['mod']		= 'USET';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->USER){
				if(!$this->session->userdata('admin'))
					$_GET['columns'][3]['search']['value'] = $this->session->userdata('village_code');
					

				$columns 	= array(
					array( 'db' => 'user_id', 		'dt' => 0 ),
					array( 'db' => 'user_fullname', 'dt' => 1 ),
					array( 'db' => 'user_email', 	'dt' => 2 ),
					array( 'db' => 'village_code', 	'dt' => 3 ),
					array( 'db' => 'user_isgroup', 	'dt' => 4 ),
					array( 'db' => 'user_visited', 	'dt' => 5 ),
					array(
						'db'        => 'user_lastin',
						'dt'        => 6,
						'formatter' => function( $d, $baris ) {
							return empty($d) ? '' : date('d M Y H:i:s',strtotime($d));
						}
					),	
					array(
						'db'        => 'user_status',
						'dt'        => 7,
						'formatter' => function( $d, $baris ) {
							return $this->config->item('user_'.$d);
						}
					),	
					array(
						'db'        => 'user_id',
						'dt'        => 8,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->USET) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->USEU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->USED) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'm_user', 'user_id', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */