<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dnsapi{

    private $login_email    =   '';
    private $login_password =   '';

    private $CI     = NULL;
    private $error  = '';

    private $api_domain     =   'https://dnsapi.cn/';
    private $api_useragent  =   NULL;
    private $api_lang       =   NULL;

    public function __construct(array $param){

        $this->login_email = $param['login_email'];
        $this->login_password = $param['login_password'];

        $this->CI = & get_instance();
        $this->CI->load->helper('curl');
        $this->CI->load->config('dnsapi');

        $api_config = $this->CI->config->item('dnsapi');
        $this->api_useragent = $api_config['useragent'];
        $this->api_lang = $api_config['lang'];
    }

    /**
     * 调用API获取数据
     * @param string $api   所调用的API
     * @param array $data   需要发送的数据
     * @return mixed        成功则返回获取到的数据;失败则返回false,并抛出异常
     * @throws Exception    API调用失败则抛出异常
     */
    public function get($api, array $data = array()){

        $post_data  = $this->make_post_data($data);
        $res_json   = curl_post($this->api_domain.$api, $post_data);

        if ( ! $res_json) {
            //throw new Exception('获取数据失败！');
            echo '获取数据失败！';
            return false;
        }

        $res = json_decode($res_json, true);

        if ( ! $this->check($res)) {
            //throw new Exception($this->error);
            echo $this->error;
            return false;
        }
//        print_r($res);exit;
        return $res;
    }

    /**
     * 检查从DNSPOD api返回的数据是否请求成功
     * @param array $res
     * @return boolean 是否成功
     */
    private function check(array $res){

        $status = $res['status'];

        if (1 == $status['code']) {
            return true;
        }

        $this->error = $status['message'];
        return false;
    }

    /**
     * 制作接口调用时的POST数据
     * @param array $data   数据
     * @return string       格式化后的数据
     */
    private function make_post_data(array $data = array()){

        $data_str = 'login_email='.$this->login_email.'&login_password='.$this->login_password.'&format=json&lang='.$this->api_lang;

        foreach ($data as $dkey => $dval) {
            $data_str .= '&'.$dkey.'='.$dval;
        }

        return $data_str;
    }

}
