<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	/**
	 * @author 		: Vandens Mc Maddens
	 * @credit 		: Govervment App
	 * @created 	: Nov 19, 2015
	 */

	public $_setting;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
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
		$this->general->writelog($data['mod'],$data['sub']);
	}

	/*
	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->DESR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		
		$data['sub'] 		= 'Data Desa';
		$data['mod']		= 'user';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}
	*/

	public function desa(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->DESR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ
		

		$tmp1['_id']		= 'temp1';
		$tmp1['_label']		= array('Kode Desa','Jumlah Posting','Jumlah Surat');
		$tmp1['_sql']		= $this->report_model->model_desa();
		
		$data['temp'][]		= $this->load->view(strtolower('bo/'.__CLASS__.'/tmp_desa'),$tmp1,true);
		
		$data['sub'] 		= 'Laporan Data Desa';
		$data['mod']		= 'DESR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function penduduk(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->PENR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ		

		$tmp1['_id']		= 'temp1';
		$tmp1['_label']		= array('Kode Desa','Jumlah KK','Laki-laki','Perempuan','Jumlah Penduduk');
		$tmp1['_sql']		= $this->report_model->model_penduduk();

		# by job
		$stat_by_job		= $this->report_model->model_penduduk_by_job();

		foreach($stat_by_job as $all){
			foreach ($all as $key => $val) {
				$tmp1[$key][] 	= $val;
			}
		}

		# by kelahiran & kematian		
		$born				= $this->report_model->model_penduduk_by_born();
		$tmp1['kelahiran']	= str_replace('"',"",json_encode($born['kelahiran']));


		# by religion
		$tmp1['agama']		= $this->report_model->model_penduduk_by_religi();

		# by status
		$tmp1['status']		= $this->report_model->model_penduduk_by_status();

		#echo '<pre>'; print_R($tmp1['status']); die;

		$data['temp'][]		= $this->load->view(strtolower('bo/'.__CLASS__.'/tmp_penduduk'),$tmp1,true);
		
		$data['sub'] 		= 'Laporan Data Penduduk';
		$data['mod']		= 'PENR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	public function pengguna(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->USER) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ		

		$tmp1['_id']		= 'temp1';
		$tmp1['_label']		= array('Kode Desa','Id Pengguna','Kunjungan','Penduduk','Posting','Surat','Galeri');
		$tmp1['_sql']		= $this->report_model->model_user();
		
		$data['temp'][]		= $this->load->view(strtolower('bo/'.__CLASS__.'/tmp_pengguna'),$tmp1,true);
		
		$data['sub'] 		= 'Laporan Data Pengguna';
		$data['mod']		= 'user';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}

	
	public function surat(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		$view 				= ($this->_priv->SURR) ? strtolower('bo/'.__CLASS__.'/index') : 'bo/temp/no_access'; // cek privi READ		

		$tmp1['_id']		= 'temp1';
		$tmp1['_label']		= array('Nama Surat','Total Record');
		$tmp1['_sql']		= $this->report_model->model_surat($this->session->userdata('village_code'));
		
		$alldata 				= $this->report_model->model_surat();
		foreach($alldata as $all){
			foreach ($all as $key => $val) {
				$tmp1[$key][] 	= $val;
			}
		}

		$data['temp'][]		= $this->load->view(strtolower('bo/'.__CLASS__.'/tmp_surat'),$tmp1,true);
		
		$data['sub'] 		= 'Laporan Data Penduduk';
		$data['mod']		= 'PENR';
		$data['contain']	=  $this->load->view($view,$data,true);
		$this->initiate($data);
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */