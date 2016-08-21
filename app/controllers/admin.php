<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('report_model');
        $this->_setting = $this->general->get_app_setting();
        $this->_priv 	= $this->general->get_privi_list();

    }

	public function initiate($data){
		
		$this->header  			= $this->load->view('fo/header',$data,true);
		$this->panel 				= $this->load->View('bo/panel',array(),true);
		$this->panel_left 	= $this->load->view('bo/panel_left',array('menu'=>'dashboard'),true);
		#$this->footer  		= $this->load->view('fo/footer',array(),true);
		$this->js 					= $this->load->view('fo/js',array(),true);
		$this->load->view('bo/home',$data);
		$this->general->writelog($data['mod'],$data['sub']);
	}

	public function index()
	{  
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));

		$data['menu'] 		= anchor(base_url(), 'Home', 'title="Home"');
		$data['nav']		= 'Admin';
		$data['sub'] 		= 'Dashboard';

		$data['list']	=  $this->mainlist();
		$list[]		=  $this->list1();
		$list[]		=  $this->list2();
	#	$list[]		=  $this->list3();		
	#	$list[]		=  $this->list4();	
	#	$list[]		=  $this->list5();
        $no = 1;
        foreach($list as $l => $r){
            $lis = 'list'.$no;
            if($r){
                 $data[$lis] = $r;
                 $no++;  
            }                                          
        }

		$data['contain']	= $this->load->view('bo/admin/index',$data,true);
		$this->initiate($data);
	}

	function mainlist(){
		$d = array();
		return $this->load->view('bo/admin/list',$d,true);
	}
	function list1(){
		
		$d['data'] 	= $this->report_model->model_penduduk($this->session->userdata('village_code'));
		
		return $this->load->view('bo/admin/list1',$d,true);
	}
	function list2(){
		$d = array();
		return $this->load->view('bo/admin/list2',$d,true);
	}

	function berita(){
		if(!$this->session->userdata('user_islogin')) redirect(base_url('login'));
		
		$data['title']	= 'Informasi Terbaru';
		$data['sql']	= $this->db->where('info_dateto',date('Y-m-d'))
								   ->or_where('info_dateto',NULL)
								   ->order_by('info_addtime DESC')
								   ->limit(4)
								   ->get('m_info');
		
		return $this->load->view('bo/admin/list2',$data,true);
	}
	
	public function info($key){
		$key 				= str_replace('%20', ' ', $key);
		$data['menu']		= anchor(base_url(),'Home','title="Home"');
		$data['nav']		= 'Berita';

		$sql 			= $this->db->select('a.*, b.village_name, c.user_fullname')
								   ->from('m_info a')
								   ->join('m_village b','a.village_code = b.village_code','left')
								   ->join('m_user c','a.info_addby = c.user_id','left')
								   ->like('info_id',$key)
								   ->get()->result();		
		
		foreach($sql as $row){
				foreach($row as $r => $w)
					$data[$r]	= $w;
				
		$data['link_berita']	= $this->db->limit(10)->get('m_info')->result();

		}
		
		$data['sub']	 	= ucwords(strtolower($data['info_title'])); // url human-friendly
		$data['contain']	= $this->load->view('bo/'.strtolower(__CLASS__).'/detail',$data,true);
		
		$this->db->set('info_visited','`info_visited`+1',FALSE)
					 ->where('info_id',$key)
					 ->update('m_info');

		$this->initiate($data);
	}


	function test(){
		
		$str = '<p><strong><img  src="../media/album/2/1434190827-Penyaluran-dan-Penggunaan-Dana-Desa.jpg" alt="" width="620" height="400" />
				</strong></p><p align="left"><font size="10">get me</font></p>
				<p><strong>SUARADESA, JAKARTA- </strong>Anggota Komisi II DPR RI, Diah Pitaloka, meminta pemerintah menyederhanakan proses administrasi dalam penyaluran dan penggunaan dana desa.&nbsp;<br /> <br /> Seperti diketahui, setiap desa dikabarkan akan mendapat dana pembangunan sebesar Rp1,4 miliar per tahun.<br /> <br /> Menurut dia, ada tiga tiga elemen paling penting dalam penyaluran dan penggunaan dana desa, yakni perencanaan, partisipasi, dan akuntabilitas.<br /> <br /> &ldquo;Proses administrasi penyaluran dan penggunaan dana desa harus disederhanakan, seiring berjalannya sistem yang ada. Ini, karena masih banyak kesulitan aparat desa untuk mengikuti," katanya, di gedung DPR RI, Jakarta, Senin 1 Juni 2015.<br /> <br /> Dia menjelaskan, kebingungan disebabkan oleh pola kepala desa yang biasanya hanya menjalankan perintah secara&nbsp;<em>top down</em>.&nbsp;<br /> <br /> Menurutnya, dengan adanya Undang-undang Desa saat ini, kepala daerah harus merencanakan pembangunan daerahnya dengan dana miliaran rupiah.&nbsp;<br /> <br /> "Ini tidak hanya mengagetkan kepala desa. Ini mengubah imajinasi masyarakat mengenai pembangunan desa. Harus ada perencanaan yang inovatif, kami mencari ruang solusi untuk permasalahan desa dalam anggaran desa,&rdquo; katanya.<br /> <br /> Dia menurutkan, pemerintah harus melakukan sosialisai mengenai dana desa, di mana masyarakat berfikir desa mereka akan mendapatkan dana Rp1,4 miliar per tahun.</p>
				<p>Sebelum, adanya UU yang baru desa diposisikan sebagai objek pembangunan. Dalam UU yang baru, desa dipoisisikan sebagai subjek dari pembangunan. Dalam posisi ini, akuntabilitas anggaran sangat dibutuhkan.&nbsp;<br /> <br /> Mengingat, kapasitas birokrasi desa tidak lengkap, seperti yang ada di tingkat kabupaten/kota.&nbsp;<br /> <br /> &ldquo;Sederhana, tetapi bisa dipertanggungjawabkan jangan rumit, sehingga dana desa itu bisa tersalurkan dengan baik,&rdquo; katanya.<br /> <br /> Selain itu, UU Desa dalam realisasinya masih dalam penyesuaian, karena dari 7.000 lebih desa yang ada di Indonesia mempunyai karakteristik.</p>
				<p>"Seperti desa adat di Bali dan banyak wilayah. Mereka sedang menyesuaikan," ujarnya. (asp).(sumber:&nbsp;<a title="Sumber Berita" href="http://suaradesa.timesindonesia.co.id/baca/610/20150614/070000/penyaluran-dan-penggunaan-dana-desa.html" target="_blank">http://suaradesa.timesindonesia.co.id</a> )</p>';
		
		echo $this->getTextBetweenTags($str,'img');
	}

	function getTextBetweenTags($string, $tagname) {
	   	$pattern = '/<img\s*((src|align|border|height|hspace|ismap|longdesc|usemap|vspace|width|class|dir|lang|style|title|id)="[^"]"\s*)*\s*\/?>/';
    	preg_match($pattern, $string, $matches);
    	print_r($matches);
	}
	

}

/* End of file home.php */
/* Location: ./application/controllers/admin.php */