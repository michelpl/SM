<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Convenios extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('convenio');
        $this->load->model('grupo');
        $comboConvenios = $this->convenio->getConvenios("A.*");
        $this->data['comboConvenios'] = $comboConvenios;
    }

    private $page;
    private $data;

    function index() {
        if ($this->session->userdata('user')) {
            //if($this->session->user['profileId'] == 1 || $this->session->user['profileId'] == 2){
            
            $this->page['page'] = "convenios";
            $this->page['title'] = "Convênios";

            $session_data = $this->session->userdata('logged_in');
            $this->data['username'] = $session_data['username'];

            $this->listar();
            $this->load->view('templates/fullHeader', $this->page);
            $this->load->view('convenios/convenios', $this->data);
            $this->load->view('templates/footer');
            /* }else{
              $this->session->set_userdata("msg", "Você não tem acesso a essa página");
              redirect('home', 'refresh');
              } */
        } else {
            redirect('login', 'refresh');
        }
    }

    private function listar() {
        if (isset($_REQUEST['search'])  || isset($_REQUEST['convenio'])) {
            if (isset($_REQUEST['convenio'])) {
                $convenioId = $_REQUEST['convenio'];
                $search = FALSE;
            } else {
                $search = $_REQUEST['search'];
                $convenioId = FALSE;
            }

            $result = $this->grupo->search(
                    " 
                        A.id
                        ,A.nome
                        ,A.status
                    ", $search
                    ,NULL
                    , $convenioId
            );
            $this->data['convenios'] = $result;
        } else {
            $this->data['convenios'] = NULL;
        }
    }

    public function cadastrar() {
        if ($this->session->userdata('user')) {
            
            $this->page['page'] = "convenios-cadastrar";
            $this->page['title'] = "Convenios/cadastrar";
            
            
            if (isset($_REQUEST['save'])) {
                //Editar existente
                if(isset($_REQUEST['grupoId'])){
                    if($this->save($_REQUEST['grupoId'])){
                        redirect('Convenios?msg=Registro salvo com sucesso', 'refresh');
                    }
                //Novo    
                }else{
                    $grupoId = $this->save();
                    if ($grupoId) {
                        redirect('Convenios/Cadastrar?msg=Registro salvo com sucesso', 'refresh');
                    } else {
                        $this->page['msg'] = "Não foi possível efetuar o cadastro";
                    }
                }
            }

            $this->load->view('templates/fullHeader', $this->page);
            $this->load->view('convenios/cadastrar', $this->data);
            $this->load->view('templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function editar(){
        if ($this->session->userdata('user')) {
            if(isset($_REQUEST['grupoId']) && $_REQUEST['grupoId'] != 0){
                $this->page['page'] = "cadastrar";
                $this->page['title'] = "Convênios/editar";
                
                $this->data['grupo'] = $this->grupo->search("A.*, B.nome as convenioNome", FALSE, $_REQUEST['grupoId']);
                
                $this->load->view('templates/fullHeader', $this->page);
                $this->load->view('convenios/cadastrar', $this->data);
                $this->load->view('templates/footer');
            }else{
                redirect("home", 'refresh');    
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    
    private function save($grupoId = NULL) {
        $this->grupo->setNome($_REQUEST['nome']);
        $this->grupo->setConvenioId($_REQUEST['convenio']);
        $this->grupo->setStatus($_REQUEST['status']);
        if($grupoId){
            $this->grupo->setId($grupoId);
        }
        $id = $this->grupo->save();
        if($id) {
            $this->page['msg'] = "Registro salvo com sucesso";
            return $id;
        } else {
            $this->page['msg'] = "Ocorreu um problema ao tentar salvar o convênio";
            return false;
        }
    }
}
