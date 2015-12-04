<?php
class TipoDocumento extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar($conditions = null){
        if (!empty($conditions)) {
          $this->db->where($conditions);
        }
        $query = $this->db->get('tipo_documentos');
        return $query->result_array();
    }

    public function agregar($tipo_documento,$tipo_documento_id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('tipo_documentos', $tipo_documento); 
        } else {
            $this->db->insert('tipo_documentos', $tipo_documento);
        }
        
        return $this->db->insert_id();
    }
}
?>