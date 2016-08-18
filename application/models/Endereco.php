<?php
class Endereco extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }
    
    private $table = "endereco";
    private $id;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;
    
    public function getTable() {
        return $this->table;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($valor) {
        $this->id = $valor;
    }
    
    public function getCep() {
        return $this->cep;
    }
    
    public function setCep($valor){
        $this->cep = $valor;
    }
    
    public function getLogradouro() {
        return $this->logradouro;
    }
    
    public function setLogradouro($valor){
        $this->logradouro = $valor;
    }
    
    public function getNumero() {
        return $this->numero;
    }
    
    public function setNumero($valor){
        $this->numero  = $valor;
    }
    
    public function getComplemento() {
        return $this->complemento;
    }
    
    public function setComplemento($valor){
        $this->complemento = $valor;
    }
    
    public function getBairro() {
        return $this->bairro;
    }
    
    public function setBairro($valor){
        $this->bairro = $valor;
    }
    
    public function getCidade() {
        return $this->cidade;
    }
    
    public function setCidade($valor){
        $this->cidade = $valor;
    }
    
    public function getUf() {
        return $this->uf;
    }
    
    public function setUf($valor){
        $this->uf = $valor;
    }
    
    /**
     * Insere um registro na tabela
     * @param int $id Id do registro
     * @return boolean
     */
    public function save($id = NULL){
        //Insere
        $this->load->library('savequeries');
        if (!$this->getId()) {
            $this->setId(date("YmdHis") . rand(99, 999));
            $data = array(
                    'id' => $this->getId()
                    ,"cep" => $this->getCep()
                    ,"logradouro" => $this->getLogradouro()
                    ,"numero" => $this->getNumero()
                    ,"complemento" => $this->getComplemento()
                    ,"bairro" => $this->getBairro()
                    ,"cidade" => $this->getCidade()
                    ,"uf" => $this->getUf()
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
                    "cep" => $this->getCep()
                    ,"logradouro" => $this->getLogradouro()
                    ,"numero" => $this->getNumero()
                    ,"complemento" => $this->getComplemento()
                    ,"bairro" => $this->getBairro()
                    ,"cidade" => $this->getCidade()
                    ,"uf" => $this->getUf()
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