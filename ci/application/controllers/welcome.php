<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
	}
	function index(){
		$data['base'] = $this->config->item('base_url');
		$data['css'] = 'styles.css';
		$data['loginout'] = 'login';
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['loginout'] = 'logout';
		}
		/*$this->load->model('Upload_model');
		if($this->input->post('upload')) {
			$this->Upload_model->do_upload();
		}*/
		$this->load->view('main', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
