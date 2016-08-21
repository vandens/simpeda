<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model{
		
	public function __construct(){
		parent::__construct();			
	}


	function model_penduduk($key = false){
		if($key)
		$where 	= " WHERE X.village_code = '".$key."'";
		$sql 	= "SELECT village_code, SUM(total_kk) AS 'total_kk', SUM(L) as 'L', SUM(P) as 'P', SUM(total_penduduk) as 'total_penduduk' FROM (
					SELECT b.village_code, '0' AS 'total_kk', count(resident_sex) as 'L', '0' AS 'P', '0' as total_penduduk FROM m_resident a JOIN m_resident_card b ON a.resident_card_no = b.resident_card_no WHERE a.resident_sex = 'L' GROUP BY village_code, resident_sex
					UNION
					SELECT b.village_code, '0' AS 'total_kk', '0' AS 'L', count(resident_sex) as 'P', '0' as total_penduduk FROM m_resident a JOIN m_resident_card b ON a.resident_card_no = b.resident_card_no WHERE a.resident_sex = 'P' GROUP BY village_code, resident_sex
					UNION 
					SELECT b.village_code, '0' AS 'total_kk', '0' AS 'L', '0' AS 'P', count(a.auto) as total_penduduk FROM m_resident a JOIN m_resident_card b ON a.resident_card_no = b.resident_card_no GROUP BY village_code
					UNION
					SELECT village_code, count(resident_card_no) AS 'total_kk', '0' AS 'L', '0' AS 'P', '0' AS total_penduduk FROM m_resident_card GROUP BY village_code
					) AS X 
					".$where." 
					GROUP BY X.village_code";

		$sql = $this->db->query($sql);
		return ($key) ? $sql->row() : $sql->result();
	}

	function model_penduduk_by_job(){
		$sql 	= "SELECT a.resident_job, count(*) as total 
				   FROM m_resident a
				   JOIN m_resident_card b ON a.resident_card_no = b.resident_card_no
				   WHERE b.village_code = '".$this->session->userdata('village_code')."'
				   GROUP BY resident_job";

		return $this->db->query($sql)->result();
	}

	function model_penduduk_by_born(){
		$kelahiran 	= $this->db->query("SELECT count(*) as total, SUBSTR(resident_bday,1,4) as tahun FROM m_resident GROUP BY SUBSTR(resident_bday,1,4)")->result();

		foreach ($kelahiran as $lahir) 
			$x[$lahir->tahun] = $lahir->total;
				
		$var_tahun 			= 1990;
		for ($i=$var_tahun; $i <= date('Y'); $i++) { 
			$return['kelahiran'][] = isset($x[$i]) ? $x[$i] : NULL;
		}
		#$sql['kematian']	= ????
		return $return;
	}

	function model_penduduk_by_religi(){
		$sql 	= $this->db->query("SELECT a.resident_religion as agama, COUNT(a.resident_religion) as total 
									FROM m_resident a JOIN m_resident_card b ON a.resident_card_no = b.resident_card_no
									WHERE b.village_code = '".$this->session->userdata('village_code')."'
									GROUP BY resident_religion")->result();
		$total = 0;
		foreach($sql as $sum)
			$total 	= bcadd($sum->total,$total);

		foreach($sql as $row){
				$persen 	= ($row->total * 100) / $total;
				$return[$row->agama] = number_format($persen,2,'.',',');

		}
			
		return $return;
	}

	function model_penduduk_by_status(){
		$sql 		= "SELECT a.set_value, SUM(x.total) as total
						FROM m_setting a
						LEFT JOIN (
						SELECT b.resident_status as resident_status, COUNT(b.resident_status) as total 
						FROM m_resident b JOIN m_resident_card c ON b.resident_card_no = c.resident_card_no
						WHERE c.village_code = '".$this->session->userdata('village_code')."'
						GROUP BY resident_status 
						) as x ON a.set_value = x.resident_status
						WHERE a.set_key = 'STP'
						GROUP BY set_value";
		$sql 	= $this->db->query($sql)->result();

		return $sql;

	}

	function model_desa(){
		$sql 	= "SELECT village_code, SUM(posting_total) as posting_total, SUM(letter_total) as letter_total  -- SUM(user_total) as user_total, SUM(user_current) as user_current, 
					FROM (
						SELECT village_code, count(*) as user_total, '' as user_current, '' as posting_total, '' as letter_total from m_user WHERE user_isadmin = 'No' GROUP BY village_code 
						UNION
						SELECT village_code, '' as user_total, count(*) as user_current, '' as posting_total, '' as letter_total from m_user WHERE user_islogin = 1 AND user_isadmin = 'No' GROUP BY village_code 
						UNION
						SELECT village_code, '' as user_total, '' as user_current, count(*) as posting_total, '' as letter_total from m_info GROUP BY village_code 
						UNION
						SELECT village_code, '' as user_total, '' as user_current, '' as posting_total, count(*) as letter_total from t_letter_log GROUP BY village_code
					) as x
					GROUP BY village_code";
		$sql = $this->db->query($sql)->result();
		return $sql;
	}

	function model_user(){
		$sql 	= "SELECT village_code, user_id, user_visited, SUM(resident) as resident_total, SUM(posting) as posting_total, SUM(letter) as letter_total, SUM(album) as album_total 
					FROM (
						SELECT village_code, user_id, user_visited, '' as resident, '' as posting, '' as letter, '' as album FROM m_user WHERE user_isadmin = 'No' 
						UNION
						SELECT b.village_code, a.resident_addby, '' as user_visited, COUNT(a.resident_addby) as resident, '' as posting, '' as letter, '' as album FROM m_resident a JOIN m_resident_card b ON a.resident_card_no = b.resident_card_no GROUP BY village_code, resident_addby 
						UNION
						SELECT village_code, info_addby, '' as user_visited, '' as resident, COUNT(info_addby) as posting, '' as letter, '' as album FROM m_info GROUP BY village_code, info_addby 
						UNION
						SELECT village_code, letter_addby, '' as user_visited, '' as resident, '' as posting, COUNT(letter_addby) as letter, '' as album FROM t_letter_log GROUP BY village_code, letter_addby 
						UNION
						SELECT a.village_code, b.alb_addby, '' as user_visited, '' as resident, '' as posting, '' as letter, COUNT(*) as album FROM m_album a INNER JOIN m_album_detail b ON a.alb_id = b.alb_id GROUP BY village_code, alb_addby
					) as x
					GROUP BY village_code, user_id";
		$sql = $this->db->query($sql)->result();
		return $sql;
	}

	function model_surat($key = ''){
		$where = !empty($key) ? 'where a.village_code = "'.$key.'"' : '';

		$sql 	= "SELECT b.set_value as letter_name, count(a.letter_code) as total 
					FROM t_letter_log a
					LEFT JOIN m_setting b ON a.letter_code = b.set_id
					".$where."
					GROUP BY village_code, letter_code
					ORDER BY set_value ASC";

		$sql = $this->db->query($sql)->result();
		return $sql;
	}
	
	
}
