<?php
class Convenio extends CI_Model{
    private $table = "convenio";
    private $id = FALSE;
    private $nome;
    private $status;
    
    public function getTable() {
        return $this->table;
    }

    public function setId($valor){
        $this->id = $valor;
    }

    public function getId() {
        return $this->id;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getStatus() {
        return $this->status;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setStatus($status) {
        $this->status = $status;
    }

        
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Busca convenios com base na String passada
     * @param String $select Campos da tabela
     * @param String $search String a ser buscada
     * @return Object
     */
    public function search($select, $search, $convenioId = NULL) {
        $this->db
                ->select($select)
                ->from($this->table . " as A");
        if($convenioId){
            $this->db->where("A.id", $convenioId);
        }else{
            $this->db
                ->like('A.nome', $search);
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
                , "nome" => $this->getNome()
                , "status" => $this->getStatus()
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
                , "status" => $this->getStatus()
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
    
    /**
     * Retorna todos os convênios
     * @param String $select campos da consulta
     * @return object
     */
    public function getConvenios($select) {
            $this->db
                ->select($select)
                ->from($this->table)
                ->where("A.status", 1);
            $query = $this->db->get();
            return $query->result();
    }
}
