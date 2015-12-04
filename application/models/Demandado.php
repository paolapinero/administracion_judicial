<?php
class Demandado extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('demandados');
        return $query->result_array();
    }

    public function agregar($demandado,$id = null) {
        //print_r($demandado);die();
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('demandados', $demandado); 
        } else {
            $this->db->insert('demandados', $demandado);
        }
        
        return $this->db->insert_id();
    }
}
?>