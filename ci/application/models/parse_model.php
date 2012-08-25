<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Parse_model extends CI_Model {
	
	# the names of the tables
	var $table 	= array( 'player_info' => 'players',
					'replay_player_info' => 'replay_player',
					'replay_info' => 'replays');
	function __construct() {
		$this->load->library('tank_auth');
	}
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
	
	function create_replay($name) {
		$this->load->library('replay'); // these are to parse the replay as soon as we've uploaded
		// populate the data to be entered into database
		$game_data = $this->replay->replay("/var/www/replays/".$name);
		$data = array("upload_user_id"=>$this->tank_auth->get_user_id(),"filepath"=>"/var/www/replays/".$name,"name"=>"$name","speed"=>$game_data->game['speed']);
		$data['map'] = $game_data->game['map'];
		$data['observers'] = $game_data->game['observers'];
		$data['version']  = "1.".$game_data->header['major_v']." ".$game_data->header['ident'];
		$data['players_count'] = $game_data->game['player_count'];
		$data['game_type'] = $game_data->game['type'];
		$data['length'] = sprintf('%02d', intval($game_data->header['length']/60000)).':'.sprintf('%02d', intval($game_data->header['length']%60000/1000));
			
		// add a chat database
		
		if($this->db->insert($this->table['replay_info'], $data)) {
			$replay_id = $this->db->insert_id();
			return array('replay_id' => $replay_id);
		}
		return NULL;
		
	}

	function save_chat($chat_array){
		foreach($chat_array as $c){
			$player_id;
			if(!player_exists($c['player_name'])) {
				$player_id = create_player($c['player_name']);
			}
			$player_id = get_player_by_name($c['player_name'])['id'];
			

			if($this->db->insert(table['chat_info'], $line)){
				$chat_id = $this->db->insert_id();
			}

		}
		
	}
/*
format of the chat log
  ["player_id"]=>
  int(2)
  ["length"]=>
  int(47)
  ["flags"]=>
  int(32)
  ["mode"]=>
  int(3)
  ["text"]=>
  string(41) "Blue has entire bottom by himself, truce?"
  ["time"]=>
  int(208890)
  ["player_name"]=>
  string(15) "dkistheirleader"

*/


}
