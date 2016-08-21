<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
        $this->_priv 				= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
		$this->_droplist 		= $this->user_model->drop_list();

    }

	public function initiate($data)
	{
		
		$data['menu'] 			= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']			= 'Kategori';

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
		$view 				= ($this->_priv->CATR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 			= 'Data Kategori';
		$data['mod']			= 'CATR';
		#$data['true']			= true;
		#$data['modal']			= $this->load->view('popup/modal',array(),true);
		$data['contain']		=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));		
		#$this->js 					= $this->load->view('fo/js',array(),true);

		$view 				 = ($this->_priv->CATC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Kategori' : 'Edit Data Kategori';
		$data['mod']		=  empty($key) ? 'CATC' : 'CATU';
		$data['val']		= 'confirm';
		$data['true']		= true;
		if(empty($key)){
			$this->load->view($view,$data);
			$this->general->writelog($data['mod'],$data['sub']);
		}else{
			$sql 	= $this->db->get_where('m_setting',array('auto'=>$key))->result();
			foreach($sql as $row)
				foreach($row as $r => $w)
					$data[$r]= $w;

			$data['key']	= $key;
			$data['val']	= 'update';	
			$view 			= (!$this->_priv->CATU) ? 'bo/temp/no_access' : 'bo/'.strtolower(__CLASS__.'/form');
			$data['contain']		=  $this->load->view($view,$data,true);
			$this->initiate($data);
		}					
					


		
	}

	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
				
		$data 				= $this->input->post(); #$this->session->flashdata('data_album');

		$msg				= $data['sub'];
		$key 				= $data['key'];
		unset($data['key']);
		unset($data['submit']);
		
		$view 				= 'bo/temp/failed';
	#	if(!$data){
	#		$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
	#	}else
		if(!$this->_priv->CATC || !$this->_priv->CATU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();	

					if(empty($key)){
						$max 	= $this->db->select_max('set_id')
										   ->where('set_key','CAT')
										   ->get('m_setting')
										   ->row();
						$data['set_id'] 	= 'CAT'.str_pad(bcadd(1,substr($max->set_id, 3)),2,0,STR_PAD_LEFT);
						$data['set_key']	= 'CAT';
						$this->db->insert('m_setting',$data);	
					}else{
						$this->db->where('auto',$key)->update('m_setting',$data);
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
		$data['mod']		= empty($key) ? 'CATC' : 'CATU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}


	
	public function delete(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
		$key 	 = $this->input->post('key',true);

		$count 	= $this->db->select('b.category')->from('m_setting a')->join('m_info b','a.set_id = b.category','right')->where('a.auto',$key)->get()->num_rows();
		
		if($count > 0)
			$return = array('status'=>'danger','msg'=>'Gagal hapus : Data masih digunakan');
		elseif(!$this->_priv->CATD)
			$return = array('status'=>'danger','msg'=>'Gagal hapus : Anda tidak memiliki hak akses!');
		else{
			$raw 	 = $this->db->where('auto',$key)->get('m_setting')->result();
			$delete  = $this->db->where('auto',$key)->delete('m_setting');			
			$return = ($delete) ? array('status'=>'success','msg'=>'Data berhasil dihapus') :	array('status'=>'danger','msg'=>'Data Gagal dihapus') ; 
								
		}
			$this->general->writelog('CATD',$return['msg'],json_encode($raw));
					
			echo json_encode($return);
			exit;

	}


	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->CATT){
		
			$sql				= $this->db->get_where('m_setting',array('auto'=>$key))->result();
					
			foreach($sql as $row)
				foreach($row as $r => $w){					
						$data[$r]	= $w;
			}
				
			$data['sql']		= $this->db->select('*')
										   ->from('m_setting a')
										   ->join('m_info b','a.set_id = b.category','left')
										   ->where('a.auto',$key)
										   ->get()->result();
		

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}				
		
		$data['sub']		= 'Detail Kategori : '.$data['set_value'];
		$data['mod']		= 'CATT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	

	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->CATR){					

				$columns 	= array(
					array( 'db' => 'set_id', 	'dt' => 0 ),
					array( 'db' => 'set_value', 'dt' => 1 ),
					array( 'db' => 'set_desc', 	'dt' => 2 ),
					array(
						'db'        => 'set_status',
						'dt'        => 3,
						'formatter' => function( $d, $baris ) {
							return $this->config->item('user_'.$d);
						}
					),	
					array(
						'db'        => 'auto',
						'dt'        => 4,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->CATT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->CATU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->CATD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'list_kategori', 'auto', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */