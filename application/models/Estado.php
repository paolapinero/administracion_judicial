<?php
class Estado extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('estados');
        return $query->result_array();
    }

    public function agregar($estado,$estado_id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('estados', $estado); 
        } else {
            $this->db->insert('estados', $estado);
        }
        
        return $this->db->insert_id();
    }
}
?>