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
		
	}

	public function index()
	{
		$this->load->view('Index/index');
		$key = $this->input->post('key');
		if (!empty($key)) {
			print_r($key);die();
		}
	}
}
