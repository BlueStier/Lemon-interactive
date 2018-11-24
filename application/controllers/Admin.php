<?php
class Admin extends CI_Controller {
//Controlleur principal du site
public function __construct()
    {
        parent::__construct();   
        $this->load->helper('form','url');       
        $this->load->library('form_validation','session');        
    }
	public function index()
	{
		$this->load->view('Admin/index');
	}
}