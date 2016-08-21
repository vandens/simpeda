<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitor_model extends CI_Model{
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	public function getData(){
		$this->setHits();
		$return	= new stdClass();
		$return->total_hits 		= $this->getTotalHits();
		$return->total_visitor		= $this->getTotalVisitor();
		$return->today_visitor		= $this->getTodayVisitor();
		$return->today_hits			= $this->getTodayHits();
		$return->user_online		= $this->getOnlineUser();
		
		return $return;
	}
	
	private function setHits(){
		if ($this->agent->is_browser()){   $agent = $this->agent->browser().' '.$this->agent->version(); }
		elseif ($this->agent->is_robot())	{   $agent = $this->agent->robot();	}
		elseif ($this->agent->is_mobile())	{   $agent = $this->agent->mobile(); }
		else{ $agent = 'User Agent tidak dikenal'; }

		$ip 	= $this->input->ip_address();		
		$date 	= date('Y-m-d');

		if ( ! $this->input->valid_ip($ip))
		{
		     log_message('error', 'IP : '.$ip.' is INVALID IP Address'.$date);
		}
		else
		{  

			$today_record 	= $this->db->where(array('stat_ip'=>$ip,'stat_date'=>$date))
									   ->get('t_visitor')
									   ->num_rows();
			if($today_record==0){
				$this->db->insert('t_visitor',
												array('stat_ip' 	=>	$ip, 
													  'stat_agent'	=>	$agent, 
													  'stat_date'	=>	$date, 
													  'stat_hits'	=>	'1'
												)
								);
			}else{
				
				$this->db->set	 ( 'stat_hits' 	, '`stat_hits`+1' , FALSE )
						 ->where ( 'stat_ip' 	, $ip )
						 ->where ( 'stat_date'	, $date )
						 ->update( 't_visitor');
			}
		}
	}
	
	private function getTotalHits(){		
		$sql 	= $this->db->select_sum('stat_hits')
						   ->get('t_visitor')
						   ->result();		
		return $sql[0]->stat_hits;		
	}
	
	private function getTotalVisitor(){
		$sql 	= $this->db->group_by('stat_ip')->get('t_visitor')->num_rows();
		
		return $sql;
	}
	
	private function getTodayVisitor(){
		$sql 	= $this->db->group_by('stat_ip')
						   ->where('stat_date',date('Y-m-d'))
						   ->get('t_visitor')
						   ->num_rows();
		return $sql;
	}
	
	private function getTodayHits(){
	 	$sql 	= $this->db->select_sum('stat_hits')
						   ->where('stat_date',date('Y-m-d'))
						   ->group_by('stat_date')
						   ->get('t_visitor')
						   ->result();
		return $sql[0]->stat_hits;	
	}
	
	private function getOnlineUser(){
		$sql 	= $this->db->get_where('m_user',array('user_islogin'=>1))->num_rows();
		return $sql;
	}
	
	
}