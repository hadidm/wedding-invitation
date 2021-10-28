<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    
    function select($table, $options = null) {
        $this->db->select("*");
        $this->db->from($table);

        if (isset($options) && count($options) > 0) {
          if (array_key_exists('orderby', $options)) {
            foreach($options['orderby'] as $ord) {
              $this->db->order_by($ord[0], $ord[1]);
            }
          }
        }
        
        $query = $this->db->get();

        return $query->result();
    }

    function insert($table, $data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }

    function select_raw($sql, $param) {
      return $this->db->query($sql, $param)->result(); 
    }
}