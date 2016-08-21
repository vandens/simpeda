<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akses extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Govervment App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;

	public function __construct()
    {
        parent::__construct();
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
		$this->_master_priv = $this->general->get_master_priv();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Akses';

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
		$data['mod']		= 'PRIR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->PRIT){
		
			$sql			= $this->user_model->get_user_detail($key);

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					
		
		$data['sub']		= 'Detail Pengguna : '.$data['user_fullname'];
		$data['mod']		= 'USET';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->PRIR){
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