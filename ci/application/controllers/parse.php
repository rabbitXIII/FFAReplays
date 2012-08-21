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
		$this->Parse_model->create_player("test") if (!player_exists("test"));	

	}



}




