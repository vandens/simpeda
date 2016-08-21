<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keluarga extends CI_Controller {

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
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
		$this->_droplist 	= $this->resident_model->drop_list();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Keluarga';

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
		$view 				= ($this->_priv->FAMR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Keluarga';
		$data['mod']		= 'FAMR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function form($key)
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->FAMC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Keluarga' : 'Edit Data Keluarga';
		$data['mod']		=  empty($key) ? 'FAMC' : 'FAMU';

		$data['val']		= 'confirm';
		$data['dlist']		= $this->general->droplist_setting(array('PER','GOL','REL','EDU','STK','STT','STP','JOB'));


		if(!empty($key))
		{
			$data['key']	= $key;
			$data['sub'] 	= 'Tambah Anggota Keluarga';
			$data['disabled']= 'disabled';
			$sql 	= $this->resident_model->get_resident_card_list($key,true);
			foreach ($sql as $keys => $vals) {
				$data[$keys] = $vals;
			}

		}
		$data['form2']		= $this->load->view('bo/keluarga/form2',$data,true);
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function confirm()
	{
		(!$this->session->userdata('user_islogin')) ? redirect(base_url('login')) : '';
		$post 				= $this->input->post();	

		$data['sub']		= 'Konfirmasi Data Keluarga';
		$data['mod']		= empty($post['user_id']) ? 'FAMC' : 'FAMU';

		$data['val']		= $post['submit'];
		
		#unset($post['key']);
		unset($post['submit']);
		
		if($this->_priv->FAMC || $this->_priv->FAMU){
					
			empty($post['key']) ? $this->form_validation->set_rules('village_code', 'Desa', 'required|max_length[25]|xss_clean') : '';
			empty($post['key']) ? $this->form_validation->set_rules('resident_no', 'No KTP', 'required|max_length[22]|xss_clean') : '';
			$this->form_validation->set_rules('resident_name', 'Nama Keluarga', 'xss_clean|max_length[25]');
			$this->form_validation->set_rules('resident_card_no', 'No Kartu Keluarga', 'xss_clean|max_length[25]');
			$this->form_validation->set_rules('resident_fm_role', 'Peran dlm Keluarga', 'xss_clean|max_length[25]');
						
				if ($this->form_validation->run() == TRUE)
				{				
					if($data['val'] == 'confirm'){
						$data['val']		= 'simpan';										
						
						if(!empty($post['key'])){

							$sql 	= $this->resident_model->get_village_code($post['key']);
							foreach($sql as $keys => $vals)
								$data[$keys] = $vals;
						}
						$data	 			= array_merge($data,$post);	

						$this->session->set_flashdata('data_keluarga',$data);
						$view 	= strtolower('bo/'.__CLASS__.'/confirm');
					}
				
				}
				else
				{
					$data['dlist']		= $this->general->droplist_setting(array('PER','GOL','REL','EDU','STK','STP','STT','JOB'));
					$data = array_merge($data,$post);
					$data['village_code']	= current(explode('_', $data['village_code']));
					$view = strtolower('bo/'.__CLASS__.'/form');
				}
				
		}else{
			$view 	= 'bo/no_access';
			#$msg 	= 'Mengakses halaman tidak berizin';
		}

		$data['form2']		= $this->load->view('bo/keluarga/form2',$data,true);
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	public function edit($key){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$view 				= ($this->_priv->FAMC) ? strtolower('bo/'.__CLASS__.'/form') : 'bo/temp/no_access'; // cek privi READ
		$data['sub'] 		=  empty($key) ? 'Tambah Data Keluarga' : 'Edit Data Keluarga';
		$data['mod']		=  empty($key) ? 'FAMC' : 'FAMU';

		$data['val']		= 'confirm';
		$data['edit']		= true;
		$data['dlist']		= $this->general->droplist_setting(array('PER','GOL','REL','EDU','STK','STT','STP','JOB'));


		if(!empty($key))
		{
			$data['key']	= $key;

			$sql 	= $this->resident_model->get_resident_card_list($key,true);
			foreach ($sql as $keys => $vals) {
				$data[$keys] = $vals;
			}

		}

		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);
	}


	public function simpan(){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';
				
		$data 				= $this->session->flashdata('data_keluarga');
		
		$view 				= 'bo/temp/failed';
		if(!$data){
			$msg 	= 'Gagal Simpan Data,Terjadi Sessi Timeout atau Re-Post Data';
		}elseif(!$this->_priv->FAMC || !$this->_priv->FAMU){
			$msg 	= 'Mengakses halaman tidak berizin';
			$view 	= 'bo/temp/no_access';
		}else{

			try {
					$this->db->trans_begin();					

					$data['village_code']	= current(explode('_', $data['village_code']));

					if($data['edit'] == 'edit')
						$this->resident_model->edit_family($data);
					else
						$this->resident_model->add_family($data);
					
								
					if ($this->db->trans_status() === FALSE){
							$this->db->trans_rollback();						
							$msg 	= ($data['edit'] == 'edit') ? 'Gagal Update Data : '.$error_db : 'Gagal Simpan Data : '.$error_db;
					}else{
							$this->db->trans_commit();
							$view 	= 'bo/temp/success';
							$msg 	= ($data['edit'] == 'edit') ? 'Berhasil Update Data' : 'Berhasil Simpan Data';
					}				

							
			} catch (Exception $e) {
				$msg 	= $e;
			}		
						
		}
		$data['raw']		= $data;
		$data['sub']		= $msg;
		$data['mod']		= empty($data['user_id']) ? 'FAMC' : 'FAMU';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	
	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->FAMT){
		
			#$data			= $this->resident_model->get_resident_data($key);
			$data['card']	= $this->resident_model->get_resident_card_list($key);
			

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					
		
		$data['sub']		= 'Detail Keluarga : '.ucwords(strtolower($data['card'][0]->resident_name .' ('.$key.')'));
		$data['mod']		= 'FAMT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}

	public function cetak($key){
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->FAMT){
		
			$data['card']	= $this->resident_model->get_resident_card_list($key);

			foreach ($data['card'][0] as $key => $value) {
				$data[$key] = $value;
			}
			$view 			= strtolower('bo/'.__CLASS__.'/print');
		}					
		$data['sub']		= 'Cetak Kartu Keluarga : '.$data['resident_name'];
		$data['mod']		= 'FAMT';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->load->view($view,$data);
		
	}

	public function laporan()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->FAMR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Pengguna';
		$data['mod']		= 'user';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	
	public function getdata(){	
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->FAMR){
				if(!$this->session->userdata('admin'))
					$_GET['columns'][0]['search']['value'] = $this->session->userdata('village_code');
					

				$columns 	= array(
					array( 'db' => 'village_code', 		'dt' => 0 ),
				#	array( 'db' => 'resident_no', 		'dt' => 1 ), 
					array( 'db' => 'resident_card_no', 	'dt' => 1 ),
					array( 'db' => 'resident_name', 	'dt' => 2 ),	
					array( 'db' => 'count_family', 		'dt' => 3 ),
					array(
						'db'        => 'resident_card_status',
						'dt'        => 4,
						'formatter' => function( $d, $baris ) {
							return $this->config->item('user_'.$d);
						}
					),	
					array(
						'db'        => 'resident_card_no',
						'dt'        => 5,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->FAMT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->FAMU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/edit/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->PENC) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('add_family')) : '';
							$button	.= ($this->_priv->FAMD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
							#JTD('<?php echo base_url($this->router->fetch_class().'/form'); ','','modal')
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'list_resident', 'resident_card_no', $columns ));

			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */