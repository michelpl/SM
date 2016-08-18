<?php

class Retorno extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    private $table = "retorno";
    private $id;
    private $evolucao;
    private $exameComplementar;
    private $conduta;

    public function getTable() {
        return $this->table;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($valor) {
        $this->id = $valor;
    }

    public function getEvolucao() {
        return $this->evolucao;
    }

    public function setEvolucao($valor) {
        $this->evolucao = $valor;
    }
    
    public function getExameComplementar() {
        return $this->exameComplementar;
    }

    public function setExameComplementar($valor) {
        $this->exameComplementar = $valor;
    }
    
    public function getConduta() {
        return $this->conduta;
    }

    public function setConduta($valor) {
        $this->conduta = $valor;
    }    


    /**
     * Insere ou atualiza um registro na tabela
     * @return boolean
     */
    public function save($id = NULL){
        if(!$id){
            $this->load->library('savequeries');
            $this->setId(date("YmdHis") . rand(99, 999));
            $data = array(
                "id" => $this->getId()
                ,"evolucao" => $this->getEvolucao()
                , "exame_complementar" => $this->getExameComplementar()
                , "conduta" => $this->getConduta()
            );
            if($this->db->insert($this->getTable(), $data)){
                $this->savequeries->write($this->db->last_query());
                return $this->getId();
            }else{
                return FALSE;
            }
        }
    }
}
