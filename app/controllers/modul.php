<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul extends CI_Controller {

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
		$data['nav']		= 'Modul';

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
		$view 				= ($this->_priv->MODR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Modul Aplikasi';
		$data['mod']		= 'MODR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function detail($key){		
		(!$this->session->userdata('user_islogin')) ? redirect('login') : '';	
		
		$view = 'bo/temp/no_access';
		if($this->_priv->MODT){
		
			$sql 			= $this->db->get_where('m_modul',array('modul_id'=>$key))->row();
			foreach($sql as $sql => $val)
				$data[$sql]	= $val;

			$data['detail']	= $this->db->select('*')
									   ->from('m_priv_user a')
									   ->join("(SELECT user_id as id, user_fullname as name, 'Custom' as type FROM m_user WHERE user_status = 'active'
												UNION
												SELECT group_id as id, group_name as name, 'Grup' as type FROM m_group WHERE group_status = 'active') b",'a.user_priv_id = b.id')
									   ->join('m_priv c','a.priv_code = c.priv_code')
									   ->where('SUBSTR(a.priv_code,1,3)',$data['modul_id'])
									   #->group_by('a.user_priv_id')
									   ->get()
									   ->result();

			$view 			= strtolower('bo/'.__CLASS__.'/detail');
		}					
		
		$data['sub']		= 'Detail Modul : '.$data['modul_name'];
		$data['mod']		= 'MODT';
		$data['contain']	= $this->load->view($view,$data,true);
		$this->initiate($data);	
	}
	
	public function getdata(){
		(!$this->session->userdata('user_islogin')) ? redirect('home') : '';
			if($this->_priv->MODR){
				#if(!$this->session->userdata('admin'))
					$_GET['columns'][3]['search']['value'] = 'active';
					

				$columns 	= array(
					array( 'db' => 'modul_id', 		'dt' => 0 ),
					array( 'db' => 'modul_name', 	'dt' => 1 ),
					array( 'db' => 'modul_desc', 	'dt' => 2 ),
					array(
						'db'        => 'modul_status',
						'dt'        => 3,
						'formatter' => function( $d, $baris ) {
							return $this->config->item('user_'.$d);
						}
					),	
					array(
						'db'        => 'modul_id',
						'dt'        => 4,
						'formatter' => function( $d, $baris ) {
							$button	= '';						
							$button	.= ($this->_priv->MODT) ? str_replace('#',base_url(strtolower(__CLASS__)).'/detail/'.$d,$this->config->item('detail')) : '';
							$button	.= ($this->_priv->MODU) ? str_replace('#',base_url(strtolower(__CLASS__)).'/form/'.$d,$this->config->item('update')) : '';
							$button	.= ($this->_priv->MODD) ? str_replace('#','JHapus(\''.strtolower(__CLASS__).'/delete/\',\'key='.$d.'\')',$this->config->item('delete')) : '';
							$button .= '';
							return $button;
						}
					)
				);		
				
				$this->load->library('datatable');
				echo json_encode($this->datatable->simple( $_GET, $this->config->item('db'), 'm_modul', 'modul_id', $columns ));	
			}	
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */