<?php
class Moneda extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('moneda');
        return $query->result_array();
    }

    public function agregar($moneda,$moneda_id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('moneda', $moneda); 
        } else {
            $this->db->insert('moneda', $moneda);
        }
        
        return $this->db->insert_id();
    }
}
?>