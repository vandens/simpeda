<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Government App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('visitor_model');
        $this->load->library('user_agent');
        $this->_setting = $this->general->get_app_setting();
    }

	private function initiate($data,$unset = array()){
		$unset 				= array_flip($unset);
		
		$data['link_berita']= $this->db->limit(10)->get('m_info')->result();
		$data['desa']		= $this->db->get('m_village')->result_array();
		$data['visitor']	= $this->visitor_model->getData();

		$data['category'] 	= $this->general->droplist_setting(array('CAT'));

		$this->header  		= isset($unset['header'])		? '' : $this->load->view('fo/header',$data,true);
		$this->panel 		= isset($unset['panel']) 		? '' : $this->load->View('fo/panel',$data,true);
		$this->panel_right 	= isset($unset['panel_right']) 	? '' : $this->load->View('fo/panel_right',$data,true);
		$this->footer  		= isset($unset['footer']) 		? '' : $this->load->view('fo/footer',$data,true);
		$this->js 			= isset($unset['js']) 			? '' : $this->load->view('fo/js',array(),true);
		

		$this->load->view('fo/home',$data);
	}
	
	public function index()
	{
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Halaman Beranda';
		
		$data['album']	= $this->db->limit(10)->get('m_album_detail')->result();

		$data['contain']	= $this->load->View('fo/album/index',$data,true);
		$this->initiate($data);
	}

	public function statistik(){
		$data['menu']		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Statistik Penduduk';
		$data['contain']	= $this->load->view('sample/statistik',$data,true);
		$this->initiate($data);
	}

	public function info(){
		$key 				= str_replace('-', ' ', $this->uri->segment(2));
		
		$data['menu']		= anchor(base_url(),'Home','title="Home"');
		$data['nav']		= 'Berita';
		$data['sub']	 	= ucwords(strtolower($key)); // url human-friendly

		$sql 			= $this->db->select('a.*, b.village_name, c.user_fullname')
								   ->from('m_info a')
								   ->join('m_village b','a.village_code = b.village_code','left')
								   ->join('m_user c','a.info_addby = c.user_id','left')
								   ->like('info_title',$key)
								   ->get()->result();
		
		foreach($sql as $row){
				foreach($row as $r => $w)
					$data[$r]	= $w;
		}
		$data['desc'] 		= substr(strip_tags(preg_replace(array("/<img[^>]+\>/i",'/\s\s+/'), "", $data['info_content'])),0,500).'...';
		
		$data['contain']	= $this->load->view('fo/info/detail',$data,true);
		
		$this->db->set('info_visited','`info_visited`+1',FALSE)
					 ->where('info_title',$key)
					 ->update('m_info');

		$this->initiate($data);
	}

	public function kontak(){
		$data['menu'] 		= anchor(base_url(),'Home','title="Home"');
		$data['nav']		= 'Kontak Kami';
		$data['contain']	= $this->load->view('sample/kontak',$data,true);
		$this->initiate($data);
	}

	public function desa(){
		$key 				= end(explode('-',$this->uri->segment(1)));
		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Desa';
		#$data['data'] 		= json_decode(file_get_contents(APPPATH.'config/json/'.$key.'.json'));	

		$this->load->model('desa_model');
		$json_to_single_array	= $this->desa_model->json_to_single($key);
		$data['confirm']		= $this->desa_model->array_to_json_view($json_to_single_array);
		
		#$data['contain']	= $this->load->view($view,$data,true);
		$data['sub']		= ucwords(strtolower(str_replace('%20',' ',str_replace('-', ' ', $json_to_single_array->profil_nama_desa)) )); // url human-friendly		
		$data['contain']	= $this->load->view('fo/monografi',$data,true);
		$this->desa_model->village_visited($json_to_single_array->profil_kode_desa);
		$this->initiate($data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */