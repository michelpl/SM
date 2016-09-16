<?php
class Grupo extends CI_Model{
    private $table = "grupo";
    private $id = FALSE;
    private $nome;
    private $status;
    private $convenioId;
    
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

    function getConvenioId() {
        return $this->convenioId;
    }

    function setConvenioId($convenioId) {
        $this->convenioId = $convenioId;
    }

    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Busca grupos com base na String passada
     * @param String $select Campos da tabela
     * @param String $search String a ser buscada
     * @return Object
     */
    public function search($select, $search, $grupoId = NULL, $convenio = NULL) {
        $this->db
                ->select($select)
                ->join('convenio as B', 'A.convenio_id = B.id', "LEFT")
                ->from($this->table . " as A");
        if($grupoId){
            $this->db->where("A.id", $grupoId);
        }elseif($convenio){
            $this->db->where("A.convenio_id", $convenio);
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
                , "convenio_id" => $this->getConvenioId()
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
                ,"convenio_id" => $this->getConvenioId()
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
}
