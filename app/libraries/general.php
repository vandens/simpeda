<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General {


	public function __construct()
    {
    	#parent::__construct();
        $CI  =& get_instance();
    }

    public function get_app_setting()
    {
    	$setting = json_decode(file_get_contents(APPPATH.'config/json/app.json'));
			if(!$setting->app_enable)
				redirect(base_url('maintenance'));
			else
				return $setting;
    }

    public function get_privi_list($return_array = ''){
    	$CI 	=& get_instance();
    	$priv 	=  $CI->session->all_userdata();

        $return         = new StdClass();
    	foreach ($priv as $key => $value) {
    		if(strlen($key) == 4 && empty($return_array)){
    			$return->{$key} = TRUE;
            }elseif(strlen($key) == 4 && $return_array == TRUE){

                $return2[]   = $key;
            }
    	}
    	return !empty($return_array) ? $return2 : $return;
    }

    function get_master_priv(){
        $CI     =& get_instance();
        if(!$CI->session->userdata('admin'))
            $CI->db->where('b.modul_owner != ',1);

        $sql = $CI->db->select('a.*,b.modul_id,b.modul_name')
                        ->from('m_priv a, m_modul b')
                        ->where('SUBSTR(a.priv_code,1,3) = b.modul_id')
                        ->where('b.modul_status','active')
                        ->where('b.modul_id !=','KAM')
                        ->where('b.modul_id !=','HEL')
                        ->order_by('b.modul_name ASC')
                        ->get()->result();

        $return     = array();
        foreach($sql as $row){
            $modul_name     = $row->modul_name;
            //unset($row->modul_name);
            $return[$modul_name][] = $row;
        }
        
        return $return;
    }

    public function writelog($modul,$activity,$rawdata = NULL){
    	$CI =& get_instance();
    	$sql = $CI->db->insert('t_activity',array(
											  'user_id'			=> $CI->session->userdata('user_id'),
											  'modul_id'		=> strtoupper($modul),
											  'act_last'		=> $activity,
											  'act_rawdata'		=> $rawdata,
											  'act_ip'			=> $_SERVER['REMOTE_ADDR'],
											  'act_agent'		=> $CI->session->userdata('user_agent'),
											  'act_addtime'		=> date('Y-m-d H:i:s')
											)
								);
		return $sql;
    }

    function droplist_setting($set_key){
        $_ = '';
        $CI =& get_instance();
        $sql                = $CI->db->where_in('set_key',$set_key)
                                       ->where('set_status','active')
                                       ->order_by('set_order','ASC')
                                       ->get('m_setting')
                                       ->result();
        
        foreach($sql as $row){
            $vals               = new stdClass();
            $vals->set_id       = $row->set_id;
            $vals->set_value    = $row->set_value;
            foreach($set_key as $ls)
            {
                ($ls == $row->set_key) ? $data[$_.$ls][] = $vals : '';
            }
        }
        return $data;
    }

}

/* End of file Someclass.php */