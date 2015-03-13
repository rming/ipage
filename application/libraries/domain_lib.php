<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class domain_lib{

  	protected 	$ci;

	public function __construct(){
        $this->ci =& get_instance();
	}

	function domain($url = null){
		if(!$url){
			$url = current_url();
		}

		$arr    = parse_url($url);
		$domain = $arr['host'];
		return $domain;
	}

	function domain_ext($url = null){
		if(!$url){
			$url = current_url();
		}

		$arr        = parse_url($url);
		$domain     = $arr['host'];
		$domain_ext = substr($domain,strpos($domain,".")+1);
		return $domain_ext;
	}

	function domain_sub($url = null){
		if(!$url){
			$url = current_url();
		}

		$arr        = parse_url($url);
		$domain     = $arr['host'];
		$domain_sub = substr($domain,0,strpos($domain,"."));
		return $domain_sub;
	}

}

/* End of file domain_lib.php */
/* Location: ./application/libraries/domain_lib.php */
