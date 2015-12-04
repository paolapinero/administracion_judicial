<?php
class Etapa extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null) {
        $this->db->select('etapas.*');
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }  
        $this->db->from('etapas');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>