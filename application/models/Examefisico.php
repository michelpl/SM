<?php

class Examefisico extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    private $table = "exame_fisico";
    private $id;
    private $inspecao;
    private $toqueRetal;
    private $anuscopia;
    private $retossigmoidoscopia;
    private $conduta;
    private $examesComplementares;

    public function getTable() {
        return $this->table;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($valor) {
        $this->id = $valor;
    }
    
    public function getInspecao(){
        return $this->inspecao;
    }
    
    public function setInspecao($valor){
        $this->inspecao = $valor;
    }

    public function getToqueRetal(){
        return $this->toqueRetal;
    }
    
    public function setToqueRetal($valor){
        $this->toqueRetal = $valor;
    }
    
    public function getAnuscopia(){
        return $this->anuscopia;
    }
    
    public function setAnuscopia($valor){
        $this->anuscopia = $valor;
    }
    
    public function getRetossigmoidoscopia(){
        return $this->retossigmoidoscopia;
    }
    
    public function setRetossigmoidoscopia($valor){
        $this->retossigmoidoscopia = $valor;
    }
    
    public function getConduta(){
        return $this->conduta;
    }
    
    public function setConduta($valor){
        $this->conduta = $valor;
    }

    public function getExamesComplementares(){
        return $this->examesComplementares;
    }
    
    public function setExamesComplementares($valor){
        $this->examesComplementares = $valor;
    }    

    /**
     * Insere ou atualiza um registro na tabela
     * @return boolean
     */
    public function save() {
        $this->load->library('savequeries');
        
        if($this->getId()) {
            $data = array(
                "inspecao" => $this->getInspecao()
                , "toque_retal" => $this->getToqueRetal()
                , "anuscopia" => $this->getAnuscopia()
                , "retossigmoidoscopia" => $this->getRetossigmoidoscopia()
                , "conduta" => $this->getConduta()
                , "exames_complementares" => $this->getExamesComplementares()
            );
            $this->db->where('id', $this->getId());
           if( $this->db->update($this->getTable(), $data)){
               //
           }else{
               return FALSE;
           }
        }else{
            $this->setId(date("YmdHis") . rand(99, 999));
            $data = array(
                "id" =>  $this->getId()
                ,"inspecao" => $this->getInspecao()
                , "toque_retal" => $this->getToqueRetal()
                , "anuscopia" => $this->getAnuscopia()
                , "retossigmoidoscopia" => $this->getRetossigmoidoscopia()
                , "conduta" => $this->getConduta()
                , "exames_complementares" => $this->getExamesComplementares()
            );
            if ($this->db->insert($this->getTable(), $data)) {
                
            }else{
                return FALSE;
            }
        }
        $this->savequeries->write($this->db->last_query());
        return $this->getId();
    }
}
