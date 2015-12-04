<?php
class Subestado extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('subestados');
        return $query->result_array();
    }

    public function agregar($subestado,$subestado_id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('subestados', $subestado); 
        } else {
            $this->db->insert('subestados', $subestado);
        }
        
        return $this->db->insert_id();
    }
}
?>