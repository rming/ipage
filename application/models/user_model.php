<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends MY_Model {

    public function __construct() {
        parent::__construct('user');
    }

    public function gen_token($user) {
        $params = array(
            'id'    => $user->id,
            'name'  => $user->username,
            'ts'    => time(),
        );


        ksort($params);
        $s = json_encode($params);
        $s = base64_encode($s);
        $checking_code = md5($s);

        $checking_code = substr($checking_code, 8, 16);

        $s = "1.user." . $s . "." . $checking_code;

        return $s;
    }


}
