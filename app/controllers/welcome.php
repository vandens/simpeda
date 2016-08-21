<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$_data = new StdClass();
		$this->load->view('welcome_message',$_data);
	}

	public function nothing(){

		$desa = new StdClass();

		$desa->profil->kode_desa 			= 'CSK';
		$desa->profil->nama_desa 			= 'Cisoka';
		$desa->profil->kecamatan 			= 'Cisoka';
		$desa->profil->kota_administratif 	= 'Ya';
		$desa->profil->kabupaten 			= 'Tangerang';
		$desa->profil->provinsi 			= 'Banten';

		$desa->wilayah->luas 				= '65,9003 Ha';
		$desa->wilayah->batas->utara 		= 'Kelurahan KarangWaru, Kec. Tegalrejo';
		$desa->wilayah->batas->selatan		= 'Kelurahan Gowongan, Kecamatan Jetis';
		$desa->wilayah->batas->timur 		= 'Kelurahan Bumijo, Kecamatan Jetis';
		$desa->wilayah->batas->barat 		= 'Kelurahan Terban, Kecamatan Gondokusuman';

		$desa->geografis->ketinggian_tanah_dari_permukaan_laut 	= '114 m';
		$desa->geografis->curah_hujan_pertahun 					= '0-758 mm/thn';
		$desa->geografis->topografi 							= 'Dataran Rendah';
		$desa->geografis->suhu_udara 							= '34°';

		$desa->pertanahan->status->sertifikat_hak_milik 		= '';
		$desa->pertanahan->status->sertifikat_hak_guna_usaha 	= '';
		$desa->pertanahan->status->sertifikat_hak_guna_bangunan = '';
		$desa->pertanahan->status->sertifikat_hak_pakai 		= '';
		$desa->pertanahan->status->bersertifikat 				= '';
		$desa->pertanahan->status->bersertifikat_prona 		= '';
		$desa->pertanahan->status->belum_bersertifikat = '';
		$desa->pertanahan->peruntukan->jalan = '';
		$desa->pertanahan->peruntukan->sawah_dan_ladang = '';
		$desa->pertanahan->peruntukan->bangunan_umum = '';
		$desa->pertanahan->peruntukan->empang = '';
		$desa->pertanahan->peruntukan->pemukiman = '';
		$desa->pertanahan->peruntukan->pemakaman = '';
		$desa->pertanahan->peruntukan->jalur_hijau = '';

		$desa->pertanahan->penggunaan->industri = '';
		$desa->pertanahan->penggunaan->pertokoan = '';
		$desa->pertanahan->penggunaan->perkantoran = '';
		$desa->pertanahan->penggunaan->pasar_desa = '';
		$desa->pertanahan->penggunaan->tanah_wakaf = '';

		$desa->bangunan->keagamaan->masjid = '';
		$desa->bangunan->keagamaan->mushola = '';
		$desa->bangunan->keagamaan->gereja = '';
		$desa->bangunan->keagamaan->vihara = '';
		$desa->bangunan->keagamaan->pura = '';

		$desa->bangunan->pendidikan->TK = '';
		$desa->bangunan->pendidikan->SD = '';
		$desa->bangunan->pendidikan->SMP = '';
		$desa->bangunan->pendidikan->SMA = '';
		$desa->bangunan->pendidikan->akademi = '';
		$desa->bangunan->pendidikan->institut = '';
		echo json_encode($desa);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */