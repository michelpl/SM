<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
    }

    private $userName;
    private $password;
    private $firstName;
    private $lastName;
    private $image;
    private $profileId;

    public function setUserName($var) {
        $this->userName = $var;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setPassword($var) {
        $this->password = $var;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setFirstName($var) {
        $this->firstName = $var;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($var) {
        $this->lastName = $var;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setImage($var) {
        $this->image = $var;
    }

    public function getImage() {
        return $this->image;
    }

    public function setProfileId($var) {
        $this->profileId = $var;
    }

    public function getProfileId() {
        return $this->profileId;
    }

    function index() {

        $this->load->helper(array('form', 'url'));
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->setUserName($this->input->post('username'));
        $this->setPassword($this->input->post('password'));
        
        if ($this->form_validation->run() && $this->login($this->getUserName(), $this->getPassword())) {
            redirect('Home', 'refresh');
        } else {
            redirect('Login', 'refresh');
        }
    }

    function login($username, $password) {
        //query the database
        $result = $this->user->login($username, $password);
        
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'firstName' => $row->firstname,
                    'lastName' => $row->lastname,
                    'image' => $row->image,
                    'profileId' => $row->profile_id,
                    'profileName' => $row->profileName
                );
                $this->session->set_userdata('user', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

}
