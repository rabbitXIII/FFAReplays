<?php
class Upload_model extends CI_Model {

	var $upload_path;
	function Upload_model() {
		$this->upload_path = realpath(APPPATH . '../replays');

	}
	function do_upload() {
		$config = array(
			'allowed_types' => 'w3g',
			'upload_path' => './replays/',
			'max_size' => 4000
		);
		$this->load->library('upload', $config);
		$this->upload->do_upload();

	}

}

