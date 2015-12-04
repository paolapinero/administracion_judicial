<?php
class MyModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function agregar_model($tabla,$arreglo,$id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update($tabla, $arreglo); 
        } else {
            $this->db->insert($tabla, $arreglo);
        }
        return $this->db->insert_id();
    }

    public function buscar_model($tabla, $conditions){
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }  
        $this->db->from($tabla);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>