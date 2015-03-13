<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domains extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('domain_model');
        $this->load->model('domain_old_model');
        $this->load->model('domain_resolve_model');

        $this->load->library('domain_lib');
    }

	public function index(){
		$condition = array('uid'=>$this->login_user->id);
		$domains   = $this->domain_model->where($condition,'id ASC');
		$data = array(
			'domains' => $domains,
			'title'   => '域名管理',
			'tpl'     => 'admin/tpl_admin_domains',
		);
		$this->load->view('tpl_layout',$data);
	}
	public function create(){
		$this->_edit();
	}
	public function edit($id = 0){
		$condition = array(
			'id'=>$id,
			'uid'=>$this->login_user->id
		);
		$domain = $this->domain_model->where($condition);
		if($domain){
			$this->_edit($id);
		}else{
			$error_message = 'access denied';
			json_output(1,$error_message);
		}
	}
	protected function _edit($id = 0){

		$is_unique = $id?'':'|is_unique[domain.prefix]';

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('prefix',  '域名',    'required|trim|strip_tags|strtolower|max_length[32]|alpha_sub_domain'.$is_unique);
		$this->form_validation->set_rules('cname',   '解析记录',    'required|trim|strip_tags|strtolower');

		if ($this->form_validation->run()){
			$prefix = $this->input->post('prefix');
			$cname  = $this->input->post('cname');

			if (checkdnsrr($cname , "A")&&$cname!='localhost') {
				$domain_resolve_type = DOMAIN_RESOLVE_TYPE_CNAME;
			}elseif($this->form_validation->valid_ip($cname)){
				$domain_resolve_type = DOMAIN_RESOLVE_TYPE_A;
			}elseif(substr($cname, 0, 7) == 'http://'){
				$domain_resolve_type = DOMAIN_RESOLVE_TYPE_URL;
				$cname_url = 'http://'.$this->domain_lib->domain($cname);
			}else{
				$error_message = '请填写可以正常解析的 目标域名 或 IP地址.';
			}
			//解析目标没有问题
			if(!isset($error_message)){
				$domain_data = array(
					'uid'    => $this->login_user->id,
					'type'   => DOMAIN_TYPE_DOMAIN,
					'target' => $cname,
				);

				if(!$id){
					$domain_data['prefix'] = $prefix;
				}else{
					$domain_data['id'] = $id;
				}

				$domain = $this->domain_model->save($domain_data);

				if($domain){
					$resolve_action = $id?DOMAIN_RESOLVE_ACTION_EDIT:DOMAIN_RESOLVE_ACTION_ADD;
					$domain->resolve_type   = $domain_resolve_type;
					$domain->target         = isset($cname_url)?$cname_url:$cname;

					$domain_resolve = $this->set_domain_resolve($domain,$resolve_action);
					if(!$domain_resolve){
						$error_message = '域名解析配置错误，请稍后重试.';
					}
				}
			}

			$error_code    = isset($error_message)?1:0;
			$error_message = isset($error_message)?$error_message:'';
			json_output($error_code,$error_message);
		}else{
			$error_message = validation_errors();
			json_output(1,$error_message);
		}

	}
	function remove($id = 0){
		$condition = array(
			'id'=>$id,
			'uid'=>$this->login_user->id
		);
		$domain = $this->domain_model->where($condition);
		if($domain){
			//保存旧数据
			$domain_data = (array)$domain['0'];
			unset($domain_data['id']);
			$this->domain_old_model->save($domain_data);
			//设置域名操作记录
			$this->set_domain_resolve($domain['0'],DOMAIN_RESOLVE_ACTION_DELETE);
			//删除数据
			$this->domain_model->delete($id);
			json_output(0);
		}else{
			$error_message = 'access denied';
			json_output(1,$error_message);
		}
	}
	protected function set_domain_resolve($domain,$action){
		$resolve_data = array(
			'domain_id'      => $domain->id,
			'prefix'         => $domain->prefix,
			'resolve_action' => $action,
			'resolve_type'   => isset($domain->resolve_type)?$domain->resolve_type:NULL,
			'target'         => $domain->target,
		);
		$domain_resolve = $this->domain_resolve_model->save($resolve_data);
		return $domain_resolve;
	}

}

/* End of file domains.php */
/* Location: ./application/controllers/admin/domains.php */
