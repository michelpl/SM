<?php

class Anamnese extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    private $table = "anamnese";
    private $id;
    private $queixaPrincipal;
    private $hda;
    private $historiaPatologicaPregressa;

    public function getTable() {
        return $this->table;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($valor) {
        $this->id = $valor;
    }

    public function getQueixaPrincipal() {
        return $this->queixaPrincipal;
    }

    public function setQueixaPrincipal($valor) {
        $this->queixaPrincipal = $valor;
    }

    public function getHda() {
        return $this->hda;
    }

    public function setHda($valor) {
        $this->hda = $valor;
    }
    
    public function getHistoriaPatologicaPregressa() {
        return $this->historiaPatologicaPregressa;
    }

    public function setHistoriaPatologicaPregressa($valor) {
        $this->historiaPatologicaPregressa = $valor;
    }

    /**
     * Insere ou atualiza um registro na tabela
     * @return boolean
     */
    public function save() {
        $this->load->library('savequeries');
        
        if($this->getId()) {
            $data = array(
                "queixa_principal" => $this->getQueixaPrincipal()
                , "hda" => $this->getHda()
                , "historia_patologica_pregressa" => $this->getHistoriaPatologicaPregressa()
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
                "id" => $this->getId()
                ,"queixa_principal" => $this->getQueixaPrincipal()
                , "hda" => $this->getHda()
                , "historia_patologica_pregressa" => $this->getHistoriaPatologicaPregressa()
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
