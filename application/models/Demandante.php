<?php
class Demandante extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function buscar_select(){
        $query = $this->db->get('demandantes');
        $result= $query->result_array();
        $options = array();
        foreach ($result as $value) {
           $options[$value['id']] = $value['demandante'];
        }
        return $options;
    }
}
?>