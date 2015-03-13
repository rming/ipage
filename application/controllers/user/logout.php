<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends MY_Controller {

	public function __construct(){
		parent::__construct(true);
		$this->load->model('user_model');
	}

	public function index(){
    	$cookie = array (
            'name'     => 'user_token',
            'expire'   => 0,
            'value'    => '',
            'domain'   => DOMAIN,
            'path'     => '/',
            //'secure'   => TRUE
        );
        $this->input->set_cookie($cookie);
        redirect(current_url());
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/user/logout.php */
