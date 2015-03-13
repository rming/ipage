<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
	public function __construct() {
        parent::__construct();
    }

	public function index(){
		redirect('admin/home');
	}

}

/* End of file index.php */
/* Location: ./application/controllers/admin/index.php */
