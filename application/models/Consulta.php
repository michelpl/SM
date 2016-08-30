<?php
class Consulta extends CI_Model {
    private $table = "consulta";
    private $id = FALSE;
    private $pacienteId;
    private $anamneseId;
    private $exameFisicoId;
    private $retornoId;
    private $finalizado;
    private $dataFinal;
    private $userId;

    public function getTable() {
        return $this->table;
    }

    public function setId($valor){
        $this->id = $valor;
    }

    public function getId() {
        return $this->id;
    }

    public function getPacienteId() {
        return $this->pacienteId;
    }

    public function setPacienteId($valor) {
        $this->pacienteId = $valor;
    }
    
    public function getAnamneseId() {
        return $this->anamneseId;
    }

    public function setAnamneseId($valor) {
        $this->anamneseId = $valor;
    }
    
    public function getExameFisicoId() {
        return $this->exameFisicoId;
    }

    public function setExameFisicoId($valor) {
        $this->exameFisicoId = $valor;
    }
    
    public function getRetornoId() {
        return $this->retornoId;
    }

    public function setRetornoId($valor) {
        $this->retornoId = $valor;
    }
    
    public function getFinalizado() {
        return $this->finalizado;
    }

    public function setFinalizado($valor) {
        $this->finalizado = $valor;
    }    
    
    public function getDataFinal() {
        return $this->dataFinal;
    }

    public function setDataFinal($valor) {
        $this->dataFinal = date("Y-m-d",  strtotime($valor));
    }  
    
    function getUserId() {
        return $this->userId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }
    
    function __construct() {
        parent::__construct();
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
                "id" => $this->getId()
                ,"paciente_id" => $this->getPacienteId()
                ,"anamnese_id" => $this->getAnamneseId()
                ,"exame_fisico_id" => $this->getExameFisicoId()
                ,"retorno_id" => $this->getRetornoId()
                ,"finalizado" => $this->getFinalizado()
                ,"data_final" => $this->getDataFinal()
                ,"user_id" => $this->getUserId()

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
                "paciente_id" => $this->getPacienteId()
                ,"anamnese_id" => $this->getAnamneseId()
                ,"exame_fisico_id" => $this->getExameFisicoId()
                ,"retorno_id" => $this->getRetornoId()
                ,"finalizado" => $this->getFinalizado()
                ,"data_final" => $this->getDataFinal()

            );
           $this->db->where('id', $this->getId());
           if( $this->db->update($this->getTable(), $data)){
               $this->savequeries->write($this->db->last_query());
               return TRUE;
           }else{
               return FALSE;
           }
            
        }
    }
    
    
    
    public function finalizadas($pacienteId){
        $this->db
                ->select(
                        "
                           A.id
                        , A.data_criacao
                        , A.retorno_id
                        , B.queixa_principal
                        , B.hda
                        , B.historia_patologica_pregressa
                        , C.inspecao
                        , C.toque_retal
                        , C.anuscopia
                        , C.retossigmoidoscopia
                        , C.conduta
                        , C.exames_complementares
                        , D.evolucao
                        , D.exame_complementar
                        , D.conduta as condutaRetorno
                        , D.data_criacao as dataRetorno
                        "
                        )
                ->from($this->table . " as A")
                ->join("anamnese as B", "A.anamnese_id = B.id", "LEFT")
                ->join("exame_fisico as C", "A.exame_fisico_id = C.id", "LEFT")
                ->join("retorno as D", "A.retorno_id = D.id", "LEFT")
                ->order_by("data_criacao", "desc")
                ->where('A.paciente_id', $pacienteId)
                ->where('A.finalizado IS NOT NULL', null, false);

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();

    }
    
    public function naoFinalizada($pacienteId){
        $this->db
                ->select(
                        "
                        A.id
                        ,A.data_criacao
                        ,A.retorno_id
                        ,A.anamnese_id
                        ,A.exame_fisico_id
                        , B.queixa_principal
                        , B.hda
                        , B.historia_patologica_pregressa
                        , C.inspecao
                        , C.toque_retal
                        , C.anuscopia
                        , C.retossigmoidoscopia
                        , C.conduta
                        , C.exames_complementares
                        , D.evolucao
                        , D.exame_complementar
                        , D.conduta as condutaRetorno
                        , D.data_criacao as dataRetorno
                        "
                        )
                ->from($this->table . " as A")
                ->join("anamnese as B", "A.anamnese_id = B.id", "LEFT")
                ->join("exame_fisico as C", "A.exame_fisico_id = C.id", "LEFT")
                ->join("retorno as D", "A.retorno_id = D.id", "LEFT")
                ->order_by("data_criacao", "desc")
                ->where('A.paciente_id', $pacienteId)
                ->where('A.finalizado IS NULL', null, false)
                ->limit(1);

        $query = $this->db->get();
        return $query->result_array();

    }    


}
