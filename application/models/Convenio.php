<?php
class Convenio extends CI_Model{
    private $table = "convenio as A";
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Retorna os convênios
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
