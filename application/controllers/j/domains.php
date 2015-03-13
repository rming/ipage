<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domains extends MY_Controller {

	private $domain_id = 707911;

	public function __construct() {
        parent::__construct(FALSE);
        $this->load->model('domain_resolve_model');

    }
    public function resolve_domains(){
    	$config = array(
			'login_email'    => 'xxxxx@qq.com',
			'login_password' => ':password',
    	);
    	$this->load->library('dnsapi',$config);

    	$condition = array(
    		'status' => DOMAIN_RESOLVE_STATUS_PENDING,
    	);
    	$pending_resolves = $this->domain_resolve_model->where($condition);

    	foreach ($pending_resolves as $resolve) {

			$data         = array();
			$record       = NULL;
			$resolve_type = '';
    		switch ($resolve->resolve_action) {
    			case DOMAIN_RESOLVE_ACTION_DELETE:
    				$data = array(
						'domain_id'  => $this->domain_id,
						'sub_domain' => $resolve->prefix,
    				);
    				$record = $this->dnsapi->get('Record.List',$data);
    				if(!$record){
    					continue;
    				}
    				$data = array(
    					'domain_id' => $this->domain_id,
    					'record_id' => $record['records'][0]['id'],
    				);
    				$res = $this->dnsapi->get('Record.Remove',$data);
    				if(!$res){
    					continue;
    				}
    				if($res['status']['code']==1){
    					$data = array(
							'id'         => $resolve->id,
							'status'     => DOMAIN_RESOLVE_STATUS_DONE,
							'resolve_at' => $res['status']['created_at'],
    					);
    					$this->domain_resolve_model->save($data);
    				}

    				break;
    			case DOMAIN_RESOLVE_ACTION_ADD:
                    //先查一下有没有这个记录
                    $data = array(
                        'domain_id'  => $this->domain_id,
                        'sub_domain' => $resolve->prefix,
                    );
                    $record = $this->dnsapi->get('Record.List',$data);
                    //如果已经有这条记录,则跳过添加
                    if(!$record){
                        if($resolve->resolve_type == DOMAIN_RESOLVE_TYPE_A){
                            $resolve_type = 'A';
                        }elseif($resolve->resolve_type == DOMAIN_RESOLVE_TYPE_CNAME){
                            $resolve_type = 'CNAME';
                        }elseif($resolve->resolve_type == DOMAIN_RESOLVE_TYPE_URL){
                            $resolve_type = '显性URL';
                        }else{
                            continue;
                        }
                        $data = array(
                            'domain_id'   => $this->domain_id,
                            'sub_domain'  => $resolve->prefix,
                            'record_type' => $resolve_type,
                            'value'       => $resolve->target,
                            'record_line' => '默认',
                        );
                        $res = $this->dnsapi->get('Record.Create',$data);
                        if(isset($res['record']['id'])){
                            $data = array(
                                'id'         => $resolve->id,
                                'status'     => DOMAIN_RESOLVE_STATUS_DONE,
                                'resolve_at' => $res['status']['created_at'],
                            );
                            $this->domain_resolve_model->save($data);
                        }
                    }else{
                        $data = array(
                            'id'         => $resolve->id,
                            'status'     => DOMAIN_RESOLVE_STATUS_DONE,
                            'resolve_at' => date('Y-m-d H:i:s'),
                        );
                        $this->domain_resolve_model->save($data);
                    }
    				break;
    			case DOMAIN_RESOLVE_ACTION_EDIT:
    				$data = array(
						'domain_id'  => $this->domain_id,
						'sub_domain' => $resolve->prefix,
    				);
    				$record = $this->dnsapi->get('Record.List',$data);
    				if(!$record){
    					continue;
    				}

    				if($resolve->resolve_type == DOMAIN_RESOLVE_TYPE_A){
    					$resolve_type = 'A';
    				}elseif($resolve->resolve_type == DOMAIN_RESOLVE_TYPE_CNAME){
    					$resolve_type = 'CNAME';
    				}elseif($resolve->resolve_type == DOMAIN_RESOLVE_TYPE_URL){
    					$resolve_type = '显性URL';
    				}else{
    					continue;
    				}

    				$data = array(
						'domain_id'   => $this->domain_id,
						'record_id'   => $record['records'][0]['id'],
						'sub_domain'  => $resolve->prefix,
						'record_type' => $resolve_type,
						'value'       => $resolve->target,
						'record_line' => '默认',
    				);
    				$res = $this->dnsapi->get('Record.Modify',$data);
    				if(!$res){
    					continue;
    				}
    				if($res['status']['code']==1){
    					$data = array(
							'id'         => $resolve->id,
							'status'     => DOMAIN_RESOLVE_STATUS_DONE,
							'resolve_at' => $res['status']['created_at'],
    					);
    					$this->domain_resolve_model->save($data);
    				}
    				break;
    			default:
    				continue;
    				break;
    		}

    	}
    }
}
