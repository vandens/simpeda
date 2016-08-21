<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Controller {

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
        $this->_setting 		= $this->general->get_app_setting();
        $this->_priv 			= $this->general->get_privi_list();
		$this->_master_priv 	= $this->general->get_master_priv();
		$this->_droplist 		= $this->user_model->drop_list();

    }

	public function initiate($data)
	{
		
		$data['menu'] 			= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']			= 'Album';

		$this->header  			= $this->load->view('fo/header',$data,true);
		$this->panel 			= $this->load->View('bo/panel',array(),true);
		$this->panel_left 		= $this->load->view('bo/panel_left',array('menu'=>'cms'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 				= $this->load->view('fo/js',array(),true);
		$this->js_dtable		= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->ALBR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 			= 'Data Album';
		$data['mod']			= 'ALBR';
	#	$data['true']			= true;
	#	$data['modal']			= $this->load->view('popup/modal',array(),true);
		$data['contain']		=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));		
		#$this->js 					= $this->load->view('fo/js',array(),true);

		$view 				 = ($this->_priv->ALBC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Album' : 'Edit Data Album';
		$data['mod']		=  empty($key) ? 'ALBC' : 'ALBU';
		$data['val']		= 'confirm';
		$data['true']		= true;
		if(empty($key)){
			$this->load->view($view,$data);
			$this->general->writelog($data['mod'],$data['sub']);
		}else{
			$sql 	= $this->db->get_where('m_album',array('alb_id'=>$key))->result();
			foreach($sql as $row)
				foreach($row as $r => $w)
					$data[$r]= $w;
			$data['sql']	= $this->db->where('alb_id',$key)->get('m_album_detail')->result();

			$data['key']	= $key;
			$data['val']	= 'update';	
			$view 			= (!$this->_priv->ALBU) ? 'bo/temp/no_access' : 'bo/'.strtolower(__CLASS__.'/form');
			$data['contain']		=  $this->load->view($view,$data,true);
			$this->initiate($data);
		}					
					
	}

	/* take out confirm
	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$get 				= $this->input->get();
		
		$data['sub']		= 'Konfirmasi Data Album';
		$data['mod']		= empty($get['alb_id']) ? 'ALBC' : 'ALBU';

		$data['val']		= $get['submit'];
		
		#unset($post['key']);
		unset($post['submit']);
		$data 				 = array_merge($data,$get);
		if($this->_priv->ALBC || $this->_priv->ALBU){
					
						$this->session->set_flashdata('data_album',$data);
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
				
		}else{
			$view 	= 'bo/temp/no_access';
			#$msg 	= 'Mengakses halaman tidak berizin';
		}
		$this->load->view($view,$data);

	}
	*/


	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
				
		$data 				= $this->input->post(); #$this->session->flashdata('data_album');

		$msg				= $data['sub'];
		$key 				= $data['key'];
		unset($data['sub']);
		unset($data['val']);
		unset($data['mod']);
		unset($data['key']);
		unset($data['submit']);
		
		$view 				= 'bo/temp/failed';
	#	if(!$data){
	#		$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
	#	}else
		if(!$this->_priv->ALBC || !$this->_priv->ALBU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();	
					
					$data['village_code']	= current(explode('_',$data['village_code']));
					if(empty($data['alb_taken_date']))
						unset($data['alb_taken_date']);
					if(empty($key)){
						$this->db->insert('m_album',$data);	
					}else{
						$this->db->where('alb_id',$key)->update('m_album',$data);
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
		$data['mod']		= empty($key) ? 'ALBC' : 'ALBU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	public function simpanfoto(){
			(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
			(!$this->_priv->ALBU) ? redirect('login') : '';

			$this->load->helper('directory');
			$map = directory_map('./media/album/');
			
			$post = $this->input->post();
			
			$path 			= FCPATH.'/media/album/'.$post['alb_id'];
			if(!isset($map[$post['alb_id']])){
				mkdir(FCPATH.'/media/album/'.$post['alb_id']);
			}
			$true 			= false;
			
	 		if($_FILES['alb_filename']['name'] !=''){ 
				
		#		$config['upload_path'] 		= $map.$post['alb_id'];
		#		$config['allowed_types'] 	= 'gif|jpg|png';
		#		$config['max_size']			= '100';
		#		$config['max_width']  		= '1024';
		#		$config['max_height']  		= '768';

		#		$this->load->library('upload', $config);

		#		if ( ! $this->upload->do_upload()
		#		{
		#			$error = $this->upload->display_errors();

		#		}
		#		else
		#		{

		#			$this->upload->data($_FILES['alb_filename']['name']);
				$move = move_uploaded_file($_FILES["alb_filename"]["tmp_name"],$path.'/'.$_FILES['alb_filename']['name']);
				
				if($move){
					$config['image_library'] = 'gd2';
					$config['source_image']	= $path.'/'.$_FILES['alb_filename']['name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	= 256;
					$config['height']	= 256;				
					$this->load->library('image_lib', $config); 				
					$this->image_lib->resize();
					$true 	= true;				
				}
				
					$insert 	= array('alb_filename'	=> $_FILES['alb_filename']['name'],
		    							'alb_desc'		=> $this->input->post('alb_desc',true),
		    							'alb_id'		=> $this->input->post('alb_id',true),
		    							'alb_addby'		=> $this->session->userdata('user_id'),
		    							'alb_addtime'	=> date('Y-m-d H:i:s'));
			    	$sql 		= $this->db->insert('m_album_detail',$insert);
			    	if(!$sql)
			    		$true 	= false;
		#		}

		    }
	       
			$msg 		= ($true) ? 'Berhasil Upload Foto' : 'Gagal Upload Foto : '.$error;
		    $this->general->writelog('ALBU',$msg);
		    if($true)
				$this->session->set_flashdata('error', array('msg'=>$msg));
				redirect(base_url('album/form/'.$this->input->post('alb_id')));
				
	}

	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';		
		if($this->_priv->ALBD){
			$key 	 = $this->input->post('key',true);
			$true 	 = false;
				
			$delete  = $this->db->where('alb_id',$key)->delete('m_album');
			$true 	 = ($delete) ? true : false;
			$sql 	 = $this->db->where('alb_id',$key)->get('m_album_detail')->result();
			
			$sukses  = 0;
			$gagal 	 = 0;
					
			foreach($sql as $row){
				$this->delete_foto($row);
				$del	= $this->db->where('auto',$row->auto)->delete('m_album_detail');
				if($del){
					$sukses++;
					$true = true;
				}else{ 
					$gagal++;
					$true = false;
				}
			}
						
			$msg 	= 'Foto berhasil dihapus : '.$sukses.'<br>
					   Foto gagal dihapus : '.$gagal;
			
			$this->general->writelog('ALBD',$msg);
			$return = ($true) ? array('status'=>'success','msg'=>'Data berhasil dihapus') :	array('status'=>'danger','msg'=>'Data Gagal dihapus') ; 
								
			}else redirect('bo/'.strtolower(__CLASS__).'/no_access');
					
			echo json_encode($return);
			exit;

	}


	public function deletefoto($key){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
			
		$sql 	= $this->db->where('auto',$key)
						   ->get('m_album_detail')
						   ->result();
		$sukses 		= false;
		
		foreach($sql as $row){				
			$this->delete_foto($row);
							
			$sql2 	= $this->db->where('auto',$key)
							   ->delete('m_album_detail');
			if($sql2)
				$sukses = true;
		}
		
		$msg 		= ($sukses) ? 'Berhasil Hapus Foto' : 'Gagal Hapus Foto';
		$this->general->writelog('ALBD',$msg);
		if($sukses)
			#$this->session->set_flashdata('error', $msg);
			$this->session->set_flashdata('error', array('msg'=>$msg));
		
		redirect(base_url('album/form/'.$row->alb_id));
		
	}

	private function delete_foto($row){
		$path 			= FCPATH.'/media/album/';
		$file 	= $this->general_model->getFileName($row->alb_filename);
			
		if(file_exists($path.$row->alb_id.'/'.$row->alb_filename))
			unlink($path.$row->alb_id.'/'.$row->alb_filename);
									
		if(file_exists($path.$row->alb_id.'/'.$file['thumbnail']))
			unlink($path.$row->alb_id.'/'.$file['thumbnail']);
	}



	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->ALBT){
		
			$sql				= $this->db->get_where('m_album',array('alb_id'=>$key))->result();
					
			foreach($sql as $row)
				foreach($row as $r => $w){					
						$data[$r]	= $w;
			}
				
			$data['sql']		= $this->db->where('alb_id',$key)
										   ->get('m_album_detail')
										   ->result();

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}				
		
		$data['sub']		= 'Detail Album : '.$data['alb_name'];
		$data['mod']		= 'ALBT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	

	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->ALBR){
				
				if(!$this->session->userdata('admin'))
					$_GET['columns'][0]['search']['value'] = $this->session->userdata('village_code');
					
					
				$columns 	= array(
					array( 'db' => 'village_code',		'dt' => 0 ),
					array( 'db' => 'alb_name', 				'dt' => 1 ),
					array( 'db' => 'alb_taken', 			'dt' => 2 ),
					array(
						'db'        => 'alb_taken_date',
						'dt'        => 3,
						'formatter' => function( $d, $baris ) {
							return empty($d) ? '' : date('d M Y',strtotime($d));
						}
					),	
					array( 'db' => 'alb_ispublish', 	'dt' => 4 ),
					array( 'db' => 'total', 	'dt' => 5 ),
					array(
						'db'        => 'alb_status',
						'dt'        => 6,
						'formatter' => function( $d, $baris ) {
							return $this->config->item('user_'.$d);
						}
					),	
					array(
						'db'        => 'alb_id',
						'dt'        => 7,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->ALBT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->ALBU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->ALBD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'list_album', 'alb_id', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */