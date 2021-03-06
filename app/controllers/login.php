<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->_setting = $this->general->get_app_setting();

    }

    

	public function index()
	{  
		if($this->session->userdata('user_islogin')) redirect(base_url('admin'));

		$this->load->helper('captcha');
				
				$vals = array('word'	=> strtoupper(random_string('alnum',4)),
							  'img_path'	=> './media/captcha/',
							  'img_url'	=> base_url().'media/captcha/',
							  'img_width'	=> '150',
							  'img_height' => 35,
							  'expiration' => 720);		

				$data = create_captcha($vals);

				if($this->input->post()){
						
					$post = $this->input->post();
					#echo sha1($post['user_id'].md5($post['user_id'].$post['user_pass'])); die;
					$this->_userid 	= $post['user_id'];
					$this->_userpass= $post['user_pass'];
					
					$this->form_validation->set_rules('captcha', 'Captcha', 'required');
					$this->form_validation->set_rules('user_id', 'User Id', 'trim|required|min_length[5]|max_length[8]|xss_clean');
					$this->form_validation->set_rules('user_pass', 'Password', 'required|callback_signin_check|xss_clean');
						
						if ($this->form_validation->run('Login') != false)
						{
							$this->general->writelog('LOGR','Berhasil Login');
							redirect(base_url('admin'));
						}
				}

				$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
				$data['nav']		= 'Admin';
				$data['sub'] 		= 'Dashboard';
				$data['contain']	= $this->load->View('sample/blank',$data,true);
				$this->header  		= $this->load->view('fo/header',$data,true);
				$this->js 			= $this->load->view('fo/js',array(),true);
				$this->load->view('bo/login/index',$data);

		
	}

	public function out(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('admin'));

		$this->general->writelog('LOGU','Berhasil Logout');
		$this->db->where('user_id',$this->session->userdata('user_id'))
				 ->update('m_user',array('user_islogin'	=> 0,
					 					 'user_lastout'	=> date('Y-m-d H:i:s')));
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	
	public function signin_check($str){
		$post 	= $this->input->post();
		$sql 	= $this->user_model->get_user_detail($post['user_id']); #$this->db->get_where('m_user',array('user_id'=>$this->input->post('user_id'),'user_status'=>'active'))->result();
		foreach($sql as $data);
		#echo sha1($data->user_id.md5($data->user_id.$post['user_pass'])); die;
	
		if($post['word'] != $post['captcha']){
			$this->form_validation->set_message('signin_check', 'Captcha tidak sesuai, Coba lagi!');
			return false;
		}elseif(!file_exists(FCPATH.'media/captcha/'.$post['time'].'.jpg')){
			$this->form_validation->set_message('signin_check', 'Captcha kadaluarsa, Coba lagi!');
			return false;			
		}elseif(count($data) == 0){
			$this->form_validation->set_message('signin_check', 'User Id tidak terdaftar!');
			return false;
		}elseif($data->user_pass != sha1($data->user_id.md5($data->user_id.$post['user_pass']))){
			$this->form_validation->set_message('signin_check', 'Password Salah!');
			return false;
		}else{
			
			$this->general_model->set_user_login($data);
			$this->general_model->set_priv_login($data);		
			return true;
		}
	}

	public function reset(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));		
		
	#	$view 				 = ($this->_priv->) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  'Form Ganti Kata Sandi'; # empty($key) ? 'Tambah Data Album' : 'Edit Data Album';
	#	$data['mod']		=  empty($key) ? 'ALBC' : 'ALBU';
	#	$data['val']		= 'confirm';
	#	$data['true']		= true;
		if(!$this->input->post()){
			$this->load->view('bo/login/form',$data);
			$this->general->writelog('LOGR',$data['sub']);
		}else{
			
			$return 	= $this->validate();
			if(!isset($return['msg'])){
				$newpass = sha1($this->session->userdata('user_id').md5($this->session->userdata('user_id').$this->input->post('pass2')));

				$update['user_pass']		= $newpass;
				$update['user_updateby']	= $this->session->userdata('user_id');
				$update['user_updatetime']	= date('Y-m-d H:i:s');

				$update = $this->db->where('village_id',$this->session->userdata('village_id'))
						 			->where('user_id',$this->session->userdata('user_id'))
						 			->update('m_user',$update);
				if($update){
					$return['status']	= 'success';
					$return['msg']		= 'Kata sandi berhasil diganti';
				}else{
					$return['msg']		= 'Terjadi Kesalahan';
				}
				
			}

			echo json_encode($return);
			
		}	
	}

	private function validate(){
		#sha1($data->user_id.md5($data->user_id.$post['user_pass']))
		$post 	= $this->input->post();
		$old_pass = $this->general_model->get_old_pass();

		$ret['status']	= 'danger';
		if(empty($post['pass1']))
			$ret['msg'] 	= 'Sandi Lama tidak boleh kosong';
		elseif(empty($post['pass2']) || empty($post['pass2']))
			$ret['msg'] 	= 'Sandi Baru tidak boleh kosong';
		elseif($post['pass2'] != $post['pass3'])
			$ret['msg'] 	= 'Konfirmasi Sandi tidak sama';
		elseif($old_pass->user_pass != sha1($this->session->userdata('user_id').md5($this->session->userdata('user_id').$post['pass1'])))
			$ret['msg']		= 'Sandi Lama Salah!';

		return $ret;

	}


}