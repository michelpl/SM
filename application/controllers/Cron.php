<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends CI_Controller {

    function __construct() {

        parent::__construct();
    }


    function index() {
        $this->load->model("sincronize");
        $this->sincronize->execute();
    }

    

}
