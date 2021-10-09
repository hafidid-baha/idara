<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GrantedStudent extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->verifyLogin();

        // $this->load->model('classe_model');
        $this->load->model('subject_model');
        // $this->load->model('student_model');
        // $this->load->model('season_model');
        $this->load->model('point_model');
    }

    public function index(){
        $data['page'] = 'index';
        $data['subjects'] = $this->subject_model->getSubjects();
        $this->load->view('/template/header',$data);
        $this->load->view('/student/index');
        $this->load->view('/template/footer');
    }

    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && $this->session->userdata('userRole') == 2)){
            redirect('/login/index');
        }
    }

}