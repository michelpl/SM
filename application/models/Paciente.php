<?php

class Paciente extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    private $table = "paciente";
    private $id = FALSE;
    private $cpf;
    private $nome;
    private $email;
    private $dataNascimento;
    private $convenioId;
    private $marcaOtica;
    private $profissao;
    private $estadoCivil;
    private $dataPrimeiraConsulta;
    private $status;
    private $enderecoId;

    public function getTable() {
        return $this->table;
    }

    public function setId($valor){
        $this->id = $valor;
    }

    public function getId() {
        return $this->id;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($valor) {
        $this->cpf = $valor;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($valor) {
        $this->nome = $valor;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($valor) {
        $this->email = $valor;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($valor) {
        $this->dataNascimento = $valor;
    }

    public function getConvenioId() {
        return $this->convenioId;
    }

    public function setConvenioId($valor) {
        $this->convenioId = $valor;
    }

    public function getMarcaOtica() {
        return $this->marcaOtica;
    }

    public function setMarcaOtica($valor) {
        $this->marcaOtica = $valor;
    }

    public function getProfissao() {
        return $this->profissao;
    }

    public function setProfissao($valor) {
        $this->profissao = $valor;
    }

    public function getEstadoCivil() {
        return $this->estadoCivil;
    }

    public function setEstadoCivil($valor) {
        $this->estadoCivil = $valor;
    }

    public function getDataPrimeiraConsulta() {
        return $this->dataPrimeiraConsulta;
    }

    public function setDataPrimeiraConsulta($valor) {
        $this->dataPrimeiraConsulta = $valor;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($valor) {
        $this->status = $valor;
    }

    public function getEnderecoId() {
        return $this->enderecoId;
    }

    public function setEnderecoId($valor) {
        $this->enderecoId = $valor;
    }

    public function pacienteExists($cpf, $email = NULL) {
        $this->db
                ->select("id")
                ->from($this->table)
                ->where("cpf", $cpf);
        $query = $this->db->get();
        $result = $query->first_row();
        if(isset($result->id)){
            return $result->id;
        }else{
            return FALSE;
        }
        
    }

    /**
     * Busca pacientes com base na String passada
     * @param String $select Campos da tabela
     * @param String $search String a ser buscada
     * @return Object
     */
    public function search($select, $search, $pacienteId = NULL) {
        $this->db
                ->select($select)
                ->from($this->table . " as A")
                ->join("convenio as C", "A.convenio_id = C.id", "LEFT")
                ->join("endereco as D", "A.endereco_id = D.id", "LEFT");
        if($pacienteId){
            
            $this->db->where("A.id", $pacienteId);
        }else{
            $this->db
                ->like('A.cpf', $search)
                ->or_like('A.nome', $search)
                ->or_like('A.marca_otica', $search);    
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Insere ou atualiza um registro na tabela
     * @return boolean
     */
    public function save() {
        //Insere
        $this->load->library('savequeries');
        if (!$this->getId()) {
            $this->setId(date("YmdHis") . rand(99, 999));
            $data = array(
                'id' => $this->getId()
                ,"cpf" => $this->getCpf()
                , "nome" => $this->getNome()
                , "email" => $this->getEmail()
                , "data_nascimento" => $this->getDataNascimento()
                , "convenio_id" => $this->getConvenioId()
                , "marca_otica" => $this->getMarcaOtica()
                , "profissao" => $this->getProfissao()
                , "estado_civil" => $this->getEstadoCivil()
                , "data_primeira_consulta" => $this->getDataPrimeiraConsulta()
                , "status" => $this->getStatus()
                , "endereco_id" => $this->getEnderecoId()
            );
            if ($this->db->insert($this->getTable(), $data)) {
                $this->savequeries->write($this->db->last_query());
                return $this->getId();
            } else {
                return FALSE;
            }
        //Atualiza
        }else{ 
            $data = array(
                "nome" => $this->getNome()
                , "email" => $this->getEmail()
                , "data_nascimento" => $this->getDataNascimento()
                , "convenio_id" => $this->getConvenioId()
                , "marca_otica" => $this->getMarcaOtica()
                , "profissao" => $this->getProfissao()
                , "estado_civil" => $this->getEstadoCivil()
                , "data_primeira_consulta" => $this->getDataPrimeiraConsulta()
                , "status" => $this->getStatus()
                , "endereco_id" => $this->getEnderecoId()
            );
            $this->db->where('id', $this->getId());
            if( $this->db->update($this->getTable(), $data)){
               $this->savequeries->write($this->db->last_query());
               return $this->getId();
           }else{
               return FALSE;
           }
        }
    }
    
    public function getPaciente($pacienteId, $fields) {
        $this->db
                ->select($fields)
                ->from($this->table . " as A")
                ->join("convenio as C", "A.convenio_id = C.id", "LEFT")
                ->where('A.id', $pacienteId);

        $query = $this->db->get();
        return $query->result();
    }
}
