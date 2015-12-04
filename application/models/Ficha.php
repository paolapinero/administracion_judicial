<?php
class Ficha extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getFichas(){
        $this->db->select('fichas.id,demandados.nombre,demandados.rut,estados.estado,subestados.subestado');
        $this->db->from('fichas');
        $this->db->join('demandados', 'demandados.id = fichas.demandado_id');
        $this->db->join('demandantes', 'demandantes.id = fichas.demandante_id');
        $this->db->join('subestados', 'subestados.id = fichas.subestado_id');
        $this->db->join('estados', 'estados.id = subestados.estado_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertar_fichas($fichas) {
        foreach ($fichas as $ficha) {
            $this->db->start_cache();
            $this->db->from('fichas');
            //print_r($ficha);
           // $this->db->where('num_ficha_cliente',$ficha['num_ficha_cliente']);
            $this->db->where('demandante_id', $ficha['demandante_id']);
            $this->db->where('demandado_id', $ficha['demandado_id']);
            $this->db->where('numero_operacion', $ficha['numero_operacion']);
            $busco_si_existe = $this->db->get();
            $busco_si_existe = $busco_si_existe->result_array();
            $this->db->stop_cache();
            $this->db->flush_cache();
            //print_r($busco_si_existe);die();
            if (!empty($busco_si_existe)) {
                $this->db->where('id',$busco_si_existe[0]['id']);
                $this->db->update('fichas',$ficha);
            } else {
                $this->db->insert('fichas', $ficha);
            } 
        }
        return true;
    }

    public function buscar_ficha($conditions = null) {
        $this->db->select('fichas.*');
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }  
        $this->db->from('fichas');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update($ficha,$id = null) {
        //si el id no es null entonces actualizo
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('fichas', $ficha); 
        } else {
            $this->db->insert('fichas', $ficha);
        }
        
        return true;
    }

    public function buscar_imprimir($conditions = null) {
        $etapas = array(1,8);
        $this->db->where_in('etapa_id', $etapas);
        $this->db->from('fichas');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>