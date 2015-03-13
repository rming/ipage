<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct() {
        parent::__construct();
    }

	public function index(){
		redirect('admin/domains');
		$data = array(
			'title' => '管理概要',
			'tpl'   => 'admin/tpl_admin_home',
		);
		$this->load->view('tpl_layout',$data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
