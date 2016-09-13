<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Convenios extends CI_Controller {

    function __construct() {

        parent::__construct();
    }

    private $page;
    private $data;
    private $msg;
    private $estadoCivil = array(
        "0" => "Selecione"
        ,"S" => "Solteiro(a)"
        ,"C" => "Casado(a)"
        ,"D" => "Divorciado(a)"
        ,"V" => "Viúvo(a)"
    );

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
        if (isset($_REQUEST['search']) && strlen($_REQUEST['search']) > 2 || isset($_REQUEST['convenioId'])) {
            $this->load->model('convenio');
            if (isset($_REQUEST['convenioId'])) {
                $convenioId = $_REQUEST['convenioId'];
                $search = FALSE;
            } else {
                $search = $_REQUEST['search'];
                $convenioId = FALSE;
            }

            $result = $this->convenio->search(
                    " 
                        A.id
                        ,A.nome
                        ,A.status
                    ", $search
                    , $convenioId
            );
            $this->data['convenios'] = $result;
        } else {
            $this->data['convenios'] = NULL;
        }
    }

    public function cadastrar() {
        if ($this->session->userdata('convenio')) {
            $this->load->model('convenio');
            $this->page['page'] = "cadastrar";
            $this->page['title'] = "Convenios/cadastrar";

            if (isset($_REQUEST['save'])) {
                //Editar existente
                if(isset($_REQUEST['convenioId'])){
                    if($this->save($_REQUEST['convenioId'])){
                        redirect('Convenios?msg=Convênio salvo com sucesso', 'refresh');
                    }
                //Novo    
                }else{
                    $convenioId = $this->save();
                    if ($convenioId) {
                        redirect('Convenios/Cadastrar?msg=Convênio cadastrado com sucesso', 'refresh');
                    } else {
                        $this->page['msg'] = "Não foi possível cadastrar o convênio";
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
            if(isset($_REQUEST['convenioId']) && $_REQUEST['convenioId'] != 0){
                $this->page['page'] = "cadastrar";
                $this->page['title'] = "Convênios/editar";
                
                $this->listar();
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
    
    private function save($convenioId = NULL) {
        $this->convenio->setNome($_REQUEST['nome']);
        $this->convenio->setStatus(1);
        if($convenioId){
            $this->convenio->setId($convenioId);
        }
        $id = $this->convenio->save();
        if($id) {
            $this->page['msg'] = "Convênio salvo com sucesso";
            return $id;
        } else {
            $this->page['msg'] = "Ocorreu um problema ao tentar salvar o convênio";
            return false;
        }
    }
}
