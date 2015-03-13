<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class password extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function fogot(){

		$this->form_validation->set_rules('email',  '电子邮箱',    'required|trim|strip_tags|strtolower|valid_email');
		$this->form_validation->set_rules('vcode',  '验证码',      'required|trim|strtoupper|callback_vcode_check');

		if ($this->form_validation->run()){
			$data = array(
				'email' => $this->input->post('email'),
			);
			$user = $this->user_model->where_one($data);
			if(!$user){
				$error['email'] = '电子邮箱不存在。';
			}elseif(substr(md5($user->id.$password),0,30) != $user->password){
				$error['password'] = '密码输入不正确。';
			}else{
				$error = array();
			}
			$error_code = count($error)?1:0;
			json_ret($error_code,$error);
		}else{
			$error = array(
				'email' => form_error('email'),
				'vcode' => form_error('vcode'),
			);
			$error = array_filter($error);
			json_ret('1',$error);
		}


		$data = array(
			'title' => '忘记密码',
			'tpl'   => 'tpl_password_fogot',
		);
		$this->load->view('tpl_layout',$data);
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

/* End of file password.php */
/* Location: ./application/controllers/user/password.php */
