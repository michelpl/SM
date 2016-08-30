<?php

Class User extends CI_Model {

    private $table = "user";
    private $id = FALSE;
    private $password;


    public function getTable() {
        return $this->table;
    }

    public function setId($valor){
        $this->id = $valor;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($valor){
        $this->password = md5($valor);
    }

    
    function login($username, $password) {
        $this->db->select('user.id, username, password, firstname, lastname, profile_id, image, profile.name as profileName');
        $this->db->from($this->table);
        $this->db->join('profile', 'profile.id = user.profile_id');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    /**
    * Insere ou atualiza um registro na tabela
    * @return boolean
    */
    public function save() {
        $data = array(
            "password" => $this->getPassword()
        );
        if ($this->getId()) {
            $this->db->where('id', $this->getId());
           if( $this->db->update($this->getTable(), $data)){
               return $this->getId();
           }
        } else {
            if ($this->db->insert($this->getTable(), $data)) {
                $this->setId($this->db->insert_id());
                return $this->getId();
            } 
        }
        return FALSE;
    }

    /**
     * Verifica se o password passado é igual ao do banco
     * @return boolean
     */
    public function comparePassword($oldPassword){
        $this->db->select('password');
        $this->db->from($this->table);
        $this->db->where('id', $this->getId());
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $old = $query->result();
            if($old[0]->password === md5($oldPassword)){
                return TRUE;
            }
        } else {
            return false;
        }
    }
    
    /**
     * Retorna os dados do usuário
     * @param int $id
     */
    public function getUser($id) {
        $fields = [
          'id'
          ,'username'
          ,'firstname'
          ,'lastname'
          ,'profile_id'
          ,'image'
          ,'crm'
        ];
        $this->db->select($fields);
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        }else{
            return FALSE;
        }
    }

}
