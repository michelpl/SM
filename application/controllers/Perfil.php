<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Perfil extends CI_Controller {

    function __construct() {

        parent::__construct();
    }

    private $page;
    private $data;
    private $pacienteId;
    private $consultaAtual;

    public function setPacienteId($valor) {
        $this->pacienteId = $valor;
    }

    public function getPacienteId() {
        return $this->pacienteId;
    }
    
    public function setConsultaAtual($valor) {
        $this->consultaAtual = $valor;
    }

    public function getConsultaAtual() {
        if(isset($this->consultaAtual[0])){
            return $this->consultaAtual[0];
        }else{
            return FALSE;
        }
    }

    public function index() {

            if ($this->session->userdata('user')) {
            $this->page['page'] = "consultas";
            $this->page['title'] = "Consultas";
            $session_data = $this->session->userdata('logged_in');
            
            $this->data['username'] = $session_data['username'];
            
            $this->data['profile'] = "";
            
            
            if (isset($_REQUEST['save']) && isset($_REQUEST['userId'])) {
                $this->load->model("user");
                $this->user->setId($_REQUEST['userId']);
                $this->user->setPassword($_REQUEST['newPassword']);
                if($this->user->comparePassword($_REQUEST['oldPassword'])){
                    if($this->user->save()){
                        $this->page['msg'] = "Senha salva com sucesso.";
                    }else{
                        $this->page['msg'] = "Não foi possível salvar a nova senha.";
                    }
                }else{
                    $this->page['msg'] = "A senha antiga não está correta.";
                }
            }
            
            
            $this->load->view('templates/fullHeader', $this->page);
            $this->load->view('perfil', $this->data);
            $this->load->view('templates/footer');
            } else {
                redirect('login', 'refresh');
            }
            /* }else{
              $this->session->set_userdata("msg", "Você não tem acesso a essa página");
              redirect('home', 'refresh');
              } */
    }




}
