<?php
class Abogado extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('abogados');
        return $query->result_array();
    }

    public function agregar($abogado,$abogado_id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('abogados', $abogado); 
        } else {
            $this->db->insert('abogados', $abogado);
        }
        
        return $this->db->insert_id();
    }
}
?>