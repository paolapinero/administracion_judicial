<?php
class Usuario extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getUsuarios($conditions = null){
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }

    public function agregar($usuario,$id = null) {
        //si el id no es null entonces actualizo
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('usuarios', $usuario); 
        } else {
            $this->db->insert('usuarios', $usuario);
        }
        
        return true;
    }

    public function eliminar($id) {
        $this->db->delete('usuarios',array('id'=>$id));
        return true;
    }

    
  function login($user, $password){
     $this -> db -> select('id, usuario, password');
     $this -> db -> from('usuarios');
     $this -> db -> where('usuario', $user);
     $this -> db -> where('password', MD5($password));
     $this -> db -> limit(1);
 
     $query = $this -> db -> get();
 
      if($query -> num_rows() == 1){
        return $query->result();
      }
      else
      {
       return false;
      }
    }
}
?>