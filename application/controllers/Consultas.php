<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Consultas extends CI_Controller {

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

        if ($this->session->userdata('user') && isset($_REQUEST['pacienteId'])) {
            $this->setPacienteId( $this->input->get('pacienteId'));
            //if($this->session->user['profileId'] == 1 || $this->session->user['profileId'] == 2){
            $this->load->model('paciente');
            $this->load->model('consulta');
            
            
            $this->page['page'] = "consultas";
            $this->page['title'] = "Consultas";
            $session_data = $this->session->userdata('logged_in');
            $this->data['username'] = $session_data['username'];
            $this->data['medico'] = $this->getUsuario($this->session->userdata['user']['id']);

            $this->listar();
            $this->load->view('templates/fullHeader', $this->page);
            $this->load->view('pacientes/consultas', $this->data);
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
        $fields = "
                A.id,
                A.cpf, 
                A.nome, 
                A.email, 
                A.data_nascimento, 
                A.convenio_id, 
                A.marca_otica, 
                A.profissao, 
                A.estado_civil, 
                A.data_primeira_consulta, 
                A.status, 
                A.endereco_id, 
                C.nome as convenio,
                ";
        $result = $this->paciente->getPaciente($this->getPacienteId(), $fields);
        $history = $this->consulta->finalizadas($this->getPacienteId());
        $this->setConsultaAtual($this->consulta->naoFinalizada($this->getPacienteId()));
        $this->data['pacientes'] = $result;
        $this->data['historico'] = $history;
        $this->data['consultaAtual'] = $this->getConsultaAtual();
    }

    public function save() {
        if ($this->session->userdata('user') && isset($_REQUEST['pacienteId']) && isset($_REQUEST['save'])) {
            $this->index();
            switch ($_REQUEST['save']) {
                case "retorno":
                    $this->saveRetorno();
                    break;
                case "consulta":
                    $this->saveConsulta();
                    break;
                default:
                    break;
            }
            redirect('Pacientes?pacienteId='.$_REQUEST['pacienteId']."&msg=".$this->page['msg'], 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    /**
     * Salva a ficha de anamnese do paciente
     * Retorna uma mensagem modal.
     */
    private function saveAnamnese() {
        $this->load->model('anamnese');
        if(isset($_REQUEST['anamneseId'])){
            $this->anamnese->setId($_REQUEST['anamneseId']);
        }
        $this->anamnese->setQueixaPrincipal($this->input->post('queixaPrincipal'));
        $this->anamnese->setHda($this->input->post('hda'));
        $this->anamnese->setHistoriaPatologicaPregressa($this->input->post('historiaPatologicaPregressa'));
        return $this->anamnese->save();
    }
    
    private function saveExameFisico(){
        $this->load->model('examefisico');
        if(isset($_REQUEST['exameFisicoId'])){
            $this->examefisico->setId($_REQUEST['exameFisicoId']);
        }
        $this->examefisico->setInspecao($this->input->post('inspecao'));
        $this->examefisico->setToqueRetal($this->input->post('toqueRetal'));
        $this->examefisico->setAnuscopia($this->input->post('anuscopia'));
        $this->examefisico->setRetossigmoidoscopia($this->input->post('retossigmoidoscopia'));
        $this->examefisico->setConduta($this->input->post('conduta'));
        $this->examefisico->setExamesComplementares($this->input->post('examesComplementares'));
        return $this->examefisico->save();
    }

    /**
     * Salva os dados da consulta
     */
    private function saveConsulta() {
        if(isset($_REQUEST['pacienteId'])){
            $anamneseId = $this->saveAnamnese();
            $exameFisicoId = $this->saveExameFisico();
            if($anamneseId && $exameFisicoId) {
                $this->load->model('consulta');
                if(isset($_REQUEST['consultaId'])){
                    $this->consulta->setId($_REQUEST['consultaId']);
                }
                $this->consulta->setPacienteId($this->input->get('pacienteId'));
                $this->consulta->setAnamneseId($anamneseId);
                $this->consulta->setExameFisicoId($exameFisicoId);
                $this->consulta->setUserId($_REQUEST['medicoId']);
                if($this->consulta->save()){
                   $this->page['msg'] = "Consulta salva com sucesso";
                } else {
                   $this->page['msg'] = "Não foi possível salvar a consulta.";
                }
            }
            
        }else{
            $this->page['msg'] = "Paciente não encontrado.";
        }
    }

    public function saveRetorno() {
        if(isset($_REQUEST['pacienteId'])){
            
            
            
            $this->load->model('consulta');
            $this->setConsultaAtual($this->consulta->naoFinalizada($_REQUEST['pacienteId']));
            $consultaAtual = $this->getConsultaAtual();
            
            $this->load->model('retorno');
            $this->retorno->setEvolucao($this->input->post('evolucao'));
            $this->retorno->setExameComplementar($this->input->post('exameComplementar'));
            $this->retorno->setConduta($this->input->post('conduta'));
            $retornoId = $this->retorno->save();
            if($retornoId){
                $this->consulta->setId($consultaAtual['id']);
                $this->consulta->setPacienteId($_REQUEST['pacienteId']);
                $this->consulta->setRetornoId($retornoId);
                $this->consulta->setFinalizado(1);
                $this->consulta->setDataFinal(date("Y-m-d H:i:s"));
                $anamneseId = $this->saveAnamnese();
                $this->consulta->setAnamneseId($anamneseId);
                $exameFisicoId = $this->saveExameFisico();
                $this->consulta->setExameFisicoId($exameFisicoId);
                if($this->consulta->save()){
                    $this->page['msg'] = "Retorno salvo com sucesso. Consulta finalizada.";
                }else {
                    $this->page['msg'] = "Não foi possível salvar o retorno. Tente novamente";
                }
            }
        }else{
            $this->page['msg'] = "Paciente não encontrado.";
        }
    }
    
    private function getUsuario($id){
        $this->load->model('user');
        return $this->user->getUser($id);
    }

}
