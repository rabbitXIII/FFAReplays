<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Parse_model extends CI_Model {
	
	# the names of the tables
	var $table 	= array( 'player_info' => 'players',
					'replay_player_info' => 'replay_player',
					'replay_info' => 'replays');
	
	function player_exists($player_name) {
                $this->db->select('1', FALSE);
                $this->db->where('LOWER(name)=', strtolower($player_name));
                $query = $this->db->get($this->table['player_info']);
                return $query->num_rows() == 1;
	}

	function get_player_by_name($player_name) {
		$this->db->where('LOWER(name)=', strtolower($player_name));
		$query = $this->db->get($this->table['player_info']);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	function get_replay_data_for_player_and_game($player_id, $replay_id) {
		$this->db->where('player_id', $player_id);
		$this->db->where('replay_id', $replay_id);
		$this->db->join($this->table['player_info'], $this->table['player_info'].".id = $player_id");
		$q = $this->db->get($this->table['replay_player_info']);
		if($q->num_rows() == 1) return $q->row();
		return NULL;
	}
	
	function create_player($player_name) {
		$data = array('name' => $player_name);
		$player_id = 0;
                if ($this->db->insert($this->table['player_info'], $data)) {
                        $player_id = $this->db->insert_id();
			return array('player_id' => $player_id);
                }
                return NULL;
	}
	
	function add_player_replay_stats($player_name, $replay_name, $data) {
		$player = $this->get_player_by_name($player_name);
		$replay_id = $this->get_replay_id_by_name($replay_name);
		$data['player_id'] = $player['id'];	
		$data['replay_id'] = $replay_id;
		$this->db->insert($this->table['replay_player_info'], $data);
	}

	function replay_exists($replay_name) {
		$this->db->select('1', FALSE);
		$this->where('LOWER(name)=', strtolower($replay_name));
		$q = $this->db->get($this->table['replay_info']);
		return $q->num_rows() == 1;

	}

	function get_replay_id_by_name($replay_name) {
		$this->db->where('LOWER(name)=', strtolower($replay_name));
		$q = $this->db->get($this->table['replay_info']);
		if ($q->num_rows() == 1) return $q->row();
		return NULL;
	}
	
	function create_replay($data) {
	# data is an instance of the replay class as specified by the w3g-julas.php file
			



	}

}