<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class signup extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index(){

		$this->form_validation->set_rules('username',  '用户名',    'required|trim|strip_tags|min_length[4]|max_length[32]|strtolower|is_unique[user.username]');
		$this->form_validation->set_rules('password',  '密码',      'required|trim|strip_tags');
		$this->form_validation->set_rules('email',     '电子邮箱',   'required|trim|valid_email|strtolower|is_unique[user.email]');
		$this->form_validation->set_rules('vcode',     '验证码',     'required|trim|strtoupper|callback_vcode_check');

		if ($this->form_validation->run()){
			$password = $this->input->post('password');
			$data = array(
				'username' => $this->input->post('username'),
				'email'    => $this->input->post('email'),
			);
			$user = $this->user_model->save($data);
			$password = substr(md5($user->id.$password),0,30);
			$data = array(
				'id'       => $user->id,
				'password' => $password,
			);
			$user = $this->user_model->save($data);
			json_ret('0',array());
		}else{
			$error = array(
				'username' => form_error('username'),
				'password' => form_error('password'),
				'email'    => form_error('email'),
				'vcode'    => form_error('vcode'),
			);
			$error = array_filter($error);
			json_ret('1',$error);
		}


		$data = array();
		$this->load->view('tpl_user_signup',$data);
	}

	function vcode_check($str){
		$auth_code = $this->session->userdata('auth_code');
		$this->session->unset_userdata('auth_code');
		if ($str!==$auth_code){
			$this->form_validation->set_message('vcode_check', '验证码不正确。');
			return false;
		}else {
			return $str;
		}
	}

}

/* End of file  signup.php */
/* Location: ./application/controllers/user/signup.php */
