<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parse extends CI_Controller {
	
	function __construct() {
		parent::__construct();	

		$this->load->library('tank_auth');
	}
	
	function index() {


	}

	function test_replay () {
		# test the parse model to insert and create new data
		$this->load->model('Parse_model');
		$test_name = $this->rand_string(10);
		if(!$this->Parse_model->player_exists($test_name)) {
			$this->Parse_model->create_player($test_name);
		}
		redirect('');
	}
	
	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}



}




