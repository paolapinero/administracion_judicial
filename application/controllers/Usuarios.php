<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('javascript');
    $this->load->library('session');
		$this->load->library('parser');
    $this->load->model('Usuario');
		$this->load->model('Rango');
		
	}

	public function index()
	{	
    //print_r($user_data = $this->session->userdata('usuario'));
		$usuarios = $this->Usuario->getUsuarios();
    $rangos = $this->Rango->getRangos();
		$data['usuarios'] = $usuarios;
    $data['rangos'] = $rangos;
		$this->load->view('Usuarios/index',$data);
	}

	public function agregar(){
		if (!empty($this->input->post('usuario'))) {
			$usuario['rut'] = $this->input->post('usuario');
			$usuario['usuario'] = $this->input->post('usuario');
			$usuario['nombre'] = $this->input->post('nombre');
			$usuario['password'] = md5($this->input->post('password'));
			$usuario['rango_id'] = $this->input->post('rango_id');
			$this->Usuario->agregar($usuario);
		} else {

		}
		redirect('/usuarios/index', 'refresh');
	}

	public function editar() {
		if (!empty($this->input->post('password'))) {
			$usuario['password'] = md5($this->input->post('password'));
		}
		$usuario['rango_id'] = $this->input->post('rango_id');
		$this->Usuario->agregar($usuario,$this->input->post('usuario_id'));
		redirect('/usuarios/index', 'refresh');
	}

	public function eliminar($id) {
		$this->Usuario->eliminar($id);
		redirect('/usuarios/index', 'refresh');
	}

  function login(){
          $username = $this->input->post("usuario");
          $password = $this->input->post("password");

          $this->form_validation->set_rules("usuario", "usuario", "required");
          $this->form_validation->set_rules("password", "password", "required");

          if ($this->form_validation->run() == FALSE)
          {
               $this->load->view('Usuarios/login');
          }
          else
          {
               if (!empty($this->input->post('usuario'))){
                    $usr_result = $this->Usuario->login($username, $password);
                    if ($usr_result > 0){
         
                         $sessiondata = array(
                              'usuario' => $username,
                              'loginuser' => TRUE
                          );
                         $this->session->set_userdata($sessiondata);
                         redirect("usuarios/index");
                    }
                    else
                    {

                      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                      redirect('usuarios/login');
                      $this->load->view('Usuarios/login');

                    }
                }
               else
               {
                  $this->load->view('Usuarios/login');

               }
          }
  }

  function logout(){
      $this->session->sess_destroy();
      $this->index();
     }
}
