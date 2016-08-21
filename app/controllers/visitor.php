<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitor extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Govervment App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;

	public function __construct()
    {
        parent::__construct();
        #$this->load->model('desa_model');
        $this->_setting 	= $this->general->get_app_setting();
        $this->_priv 		= $this->general->get_privi_list();
    }

	public function initiate($data)
	{
		
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Laporan';

		$this->header  		= $this->load->view('fo/header',$data,true);
		$this->panel 		= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'laporan'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 			= $this->load->view('fo/js',array(),true);
		$this->js_dtable	= $this->load->view('bo/js_dtable',array(),true);
		$this->load->view('bo/home',$data);
		#$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index()
	{  
		#if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= strtolower('bo/'.__CLASS__.'/index'); #($this->_priv->DESR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Log Visitor';
		$data['mod']		= 'ACTR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}
	

	public function getdata(){
		#(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
		#	if($this->_priv->DESR){

					$columns 	= array(
						array( 'db' => 'auto', 	'dt' => 0 ),
						array( 'db' => 'stat_ip', 	'dt' => 1 ),
						array( 'db' => 'stat_agent', 	'dt' => 2 ),
						array(
							'db'        => 'stat_date',
							'dt'        => 3,
							'formatter' => function( $d, $baris ) {
								return (!empty($d)) ? date('d M Y',strtotime($d)) : '';
							}
						),
						array( 'db' => 'stat_hits', 'dt' => 4 ),
						array(
							'db'        => 'auto',
							'dt'        => 5,
							'formatter' => function( $d, $baris ) {
								$button	= '';						
							#	$button	.= ($this->_priv->ACTT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							#	$button	.= ($this->_priv->DESU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							#	$button	.= ($this->_priv->ACT) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
								$button .= '';
								return $button;
							}
						)
					);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 't_visitor', 'auto', $columns ));	
		#	}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */