<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct($check=TRUE) {
        parent::__construct();

        //$this->output->enable_profiler(TRUE);

        $this->domain_for = $this->data_for();

        if ($check) {
            $ci             = & get_instance();
            $ci->login_user = $this->check_login();
        }
    }


    protected function check_login() {

        $user = $this->get_login_user();
        if ($user == null) {
            redirect('user/login');
        }

        return $user;
    }

    public function get_login_user() {
        $user_token = $this->input->cookie('user_token');

        $user_array = preg_split('/\./', $user_token);

        if (count($user_array) != 4) {
            return null;
        }

        list($format_version, $type, $info_data, $verify_code) = $user_array;
        if ($format_version == '1') {
            $code = substr(md5($info_data), 8, 16);
            if ($verify_code == $code) {
                $user_array = json_decode(base64_decode($info_data));
                $user_id = $user_array->id;

                $user = $this->db->get_where($type, array('id' => $user_id))->row();

                return $user;
            }
        }

        return null;
    }

    public function data_for(){
        $domain     = $this->domain_lib->domain();

        $domain_pos    = stripos($domain, DOMAIN);
        $is_sub_domain = $domain_pos!==FALSE;

        //本站域名
        if($is_sub_domain){
            $domain_sub   = substr($domain, 0 ,$domain_pos-1);
            $data_for_all = in_array($domain_sub,array('','www'));
            if($data_for_all){
                return NULL;
            }else{

                $domain_sub_arr = explode('.',$domain_sub);
                $domain_sub     = end($domain_sub_arr);
                //查询数据库，问问到底是谁的域名
                return $domain_sub;
            }
        }
        //绑定域名
        if(!$is_sub_domain){
            //查询数据库问是谁绑定的;
            return $user;
        }
    }



}
