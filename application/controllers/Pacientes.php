<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pacientes extends CI_Controller {

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
    private $estados = array("0" => "Selecione", "AC"=>"Acre", "AL"=>"Alagoas", "AM"=>"Amazonas", "AP"=>"Amapá","BA"=>"Bahia","CE"=>"Ceará","DF"=>"Distrito Federal","ES"=>"Espírito Santo","GO"=>"Goiás","MA"=>"Maranhão","MT"=>"Mato Grosso","MS"=>"Mato Grosso do Sul","MG"=>"Minas Gerais","PA"=>"Pará","PB"=>"Paraíba","PR"=>"Paraná","PE"=>"Pernambuco","PI"=>"Piauí","RJ"=>"Rio de Janeiro","RN"=>"Rio Grande do Norte","RO"=>"Rondônia","RS"=>"Rio Grande do Sul","RR"=>"Roraima","SC"=>"Santa Catarina","SE"=>"Sergipe","SP"=>"São Paulo","TO"=>"Tocantins");

    function index() {
        if ($this->session->userdata('user')) {
            //if($this->session->user['profileId'] == 1 || $this->session->user['profileId'] == 2){
            
            $this->page['page'] = "pacientes";
            $this->page['title'] = "Pacientes";

            $session_data = $this->session->userdata('logged_in');
            $this->data['username'] = $session_data['username'];

            $this->listar();
            $this->load->view('templates/fullHeader', $this->page);
            $this->load->view('pacientes/pacientes', $this->data);
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
        if (isset($_REQUEST['search']) && strlen($_REQUEST['search']) > 2 || isset($_REQUEST['pacienteId'])) {
            $this->load->model('paciente');
            if (isset($_REQUEST['pacienteId'])) {
                $pacienteId = $_REQUEST['pacienteId'];
                $search = FALSE;
            } else {
                $search = $_REQUEST['search'];
                $pacienteId = FALSE;
            }

            $result = $this->paciente->search(
                    " 
                        A.id
                        ,A.nome
                        ,A.email
                        ,A.cpf
                        ,A.data_nascimento
                        ,A.status
                        ,A.convenio_id
                        ,A.marca_otica
                        ,A.profissao
                        ,A.estado_civil
                        ,A.endereco_id
                        ,C.nome as convenio
                        ,D.cep
                        ,D.logradouro
                        ,D.numero
                        ,D.complemento
                        ,D.bairro
                        ,D.cidade
                        ,D.uf
                    ", $search
                    , $pacienteId
            );
            
            $this->load->model('consulta');
            $pacientes = "";
            foreach ($result as $key => $paciente) {
                $pacientes[$key] = $paciente;
                $pacientes[$key]['consultaNaoFinalizada'] = $this->consulta->naoFinalizada($paciente['id']);
            }
            $this->data['pacientes'] = $pacientes;
        } else {
            $this->data['pacientes'] = NULL;
        }
    }

    public function cadastrar() {
        if ($this->session->userdata('user')) {
            $this->load->model('paciente');
            $this->page['page'] = "cadastrar";
            $this->page['title'] = "Pacientes/cadastrar";
            $this->data['estadoCivil'] = $this->estadoCivil;
            $this->data['estados'] = $this->estados;

            $this->load->model('convenio');
            //Combo de convênios
            $this->data['convenios'] = $this->convenio->getConvenios("A.id, A.nome");

            if (isset($_REQUEST['save'])) {
                //Editar existente
                if(isset($_REQUEST['pacienteId'])){
                    if($this->save($_REQUEST['pacienteId'])){
                        redirect('Pacientes?msg=Ficha de paciente salva com sucesso', 'refresh');
                    }
                //Novo    
                }else{
                    $this->paciente->setCpf(preg_replace('#[^0-9]#', '', $_REQUEST['cpf']));
                    //Se o paciente não existir
                    if (!$this->paciente->pacienteExists($this->paciente->getCpf())) {
                        $pacienteID = $this->save();
                        if ($pacienteID) {
                            redirect('Pacientes/Cadastrar?msg=Paciente cadastrado com sucesso', 'refresh');
                        } else {
                            $this->page['msg'] = "Não foi possível cadastrar o paciente";
                        }
                    } else {
                        $this->page['msg'] = "CPF já cadastrado no sistema";
                    }
                }
            }

            $this->load->view('templates/fullHeader', $this->page);
            $this->load->view('pacientes/cadastrar', $this->data);
            $this->load->view('templates/footer');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function editar(){
        if ($this->session->userdata('user')) {
            if(isset($_REQUEST['pacienteId']) && $_REQUEST['pacienteId'] != 0){
                $this->page['page'] = "cadastrar";
                $this->page['title'] = "Pacientes/editar";
                $this->data['estadoCivil'] = $this->estadoCivil;
                $this->data['estados'] = $this->estados;
                
                $this->load->model('convenio');
                //Combo de convênios
                $this->data['convenios'] = $this->convenio->getConvenios("A.id, A.nome");
                
                $this->listar();
                $this->load->view('templates/fullHeader', $this->page);
                $this->load->view('pacientes/cadastrar', $this->data);
                $this->load->view('templates/footer');
            }else{
                redirect("home", 'refresh');    
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    private function saveEndereco($enderecoId = NULL) {
        $this->load->model('endereco');
        if($enderecoId){
            $this->endereco->setId($enderecoId);
        }
        $this->endereco->setCep(preg_replace('#[^0-9]#', '', $_REQUEST['cep']));
        $this->endereco->setLogradouro($_REQUEST['logradouro']);
        $this->endereco->setNumero($_REQUEST['numero']);
        $this->endereco->setComplemento($_REQUEST['complemento']);
        $this->endereco->setBairro($_REQUEST['bairro']);
        $this->endereco->setCidade($_REQUEST['cidade']);
        $this->endereco->setUf($_REQUEST['uf']);
        return $this->endereco->save();
    }
    
    private function save($pacienteId = NULL) {
        $this->paciente->setNome($_REQUEST['nome']);
        $this->paciente->setDataNascimento(date("Y-m-d",  strtotime($_REQUEST['dataNascimento'])));
        $this->paciente->setEmail($_REQUEST['email']);
        $this->paciente->setConvenioId($_REQUEST['convenio']);
        $this->paciente->setProfissao($_REQUEST['profissao']);
        $this->paciente->setEstadoCivil($_REQUEST['estadoCivil']);
        $this->paciente->setMarcaOtica($_REQUEST['marcaOtica']);
        $this->paciente->setStatus(1);
        if($pacienteId){
            $this->paciente->setId($pacienteId);
            $enderecoId = $this->saveEndereco($_REQUEST['enderecoId']);
        }else{
            $enderecoId = $this->saveEndereco();
        }
        $this->paciente->setEnderecoId($enderecoId);
        $id = $this->paciente->save();
        if ($id) {
            $this->page['msg'] = "Paciente salvo com sucesso";
            return $id;
        } else {
            $this->page['msg'] = "Ocorreu um problema ao tentar salvar o cadastro do paciente";
            return false;
        }
    }
}
