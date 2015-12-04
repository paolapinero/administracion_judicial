<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('javascript');
    	$this->load->library('session');
		$this->load->library('parser');
		$this->load->model('Ficha');
		$this->load->model('Etapa');
		
	}

	public function index()
	{
		$this->load->view('Index/index');
		$key = $this->input->post('key');
		if (!empty($key)) {
			print_r($key);die();
		}
	}

	public function actualizar_estado(){
		$this->load->view('Index/index');
		$key = $this->input->post('key');
		//$key = '19190641+2147483647';
		$data = array();
		//print_r($this->Ficha->buscar_ficha(array('clave' => '19190641+2147483647')));
		if (!empty($key)) {
			//Busco la ficha con el key devuelto por la pistola
			$ficha = $this->Ficha->buscar_ficha(array('clave' => $key));
			//$this->Ficha->buscar_ficha(array('clave' => '19190641+2147483647'))
			//Busco la siguiente etapa
			$etapa = $this->Etapa->buscar(array('id' => $ficha[0]['etapa_id']));
			//Si el paso es el ultimo entonces la demanda no puede ser escaneada
			if ($etapa[0]['siguiente'] > 0) {
				$mensaje = 'Estado actualizo demanda en estado: '.$nuevo_paso[0]['etapa'];
				// Actualizo el estado 
				$actualizar['etapa_id'] = $etapa[0]['siguiente'];
				$this->Ficha->update($actualizar,$ficha[0]['id']); 
			} else {
				$mensaje = 'El estado no ha podido ser actualizado ya que la demandada ya fue despachada';
			}
			$data['mensaje'] = $mensaje;
		}
	}
}
