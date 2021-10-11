<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    
    function select($table) {
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();

        return $query->result();
    }

    function insert($table, $data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
}