<?php
class Garantia extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('garantias');
        return $query->result_array();
    }

    public function agregar($garantia,$garantia_id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('garantias', $garantia); 
        } else {
            $this->db->insert('garantias', $garantia);
        }
        
        return $this->db->insert_id();
    }
}
?>