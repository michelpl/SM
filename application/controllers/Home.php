<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        
        parent::__construct();
    }

    function index() {
        
        if ($this->session->userdata('user')) {
            $page['page'] = "home";
            $page['title'] = "Início";
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['debug'] = $this->session;
            $this->load->view('templates/fullHeader', $page);
            $this->load->view('home', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }
}
