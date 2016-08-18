<?php

class Sincronize extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    private $table = "";
    private $id = FALSE;


    public function getTable() {
        return $this->table;
    }

    public function setId($valor){
        $this->id = $valor;
    }

    public function getId() {
        return $this->id;
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
    
    public function execute() {
        try {
            $this->load->library("savequeries");
            //$online = $this->load->database('sm_teste', TRUE); 
            /*****
             * NÃO ESQUECER DE MUDAR AQUI
             */
            $online = $this->load->database('online', TRUE); 
            $fileContent = $this->savequeries->getFileContent();
            $queries = explode(";", $fileContent);
            $online->trans_begin();
            foreach ($queries as $query){
                if(strlen($query)>3){
                    $online->query($query);
                }
            }
            if ($online->trans_status() === FALSE){
                $online->trans_rollback();
            }else{
                $online->trans_commit();
                $this->savequeries->clearFile();
            }
        } catch (Exception $exc) {
            //implementar controle de crons
            echo $exc->getTraceAsString();
        }
        
    }
}
