<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->helper('date');
        $this->load->model('classe_model');
        $this->load->model('subject_model');
        $this->load->model('teacher_model');
        $this->load->model('student_model');
        $this->load->model('season_model');
        $this->load->model('point_model');
        $this->load->model('setting_model');
    }

    public function index(){
        // echo '<pre>';
        // echo var_dump($_SESSION);
        // echo '</pre>';
        $this->verifyLogin();
        if(isset($_POST['updateSeason'])){
            $selecedSeasonId = $this->input->post('season');
            $season = $this->season_model->getSeasonsById($selecedSeasonId);
            $this->session->set_userdata('season',$season->content);
            $this->session->set_userdata('seasonid',$season->id);
        }
        $data['page'] = 'index';
        $data['studentsCount'] = $this->student_model->getStudentsCount();
        $data['classesCount'] = $this->classe_model->getClassesCount();
        $data['subjectsCount'] = $this->subject_model->getSubjectsCount();
        $data['teachersCount'] = $this->teacher_model->getTeacherCount();
        $data['currentSeason'] = $this->season_model->getSeasonCurrentDate();
        $data['sessionSeason'] = $this->session->userdata('season');
        $data['createSeasAvailable'] = $this->season_model->isCreateSeasAvailable();
        $data['seasons'] = $this->season_model->getSeasons();
        
        $this->load->view('template/header',$data);
        $this->load->view('admin/index');
        $this->load->view('template/footer');
    }

    public function teacher(){
        $this->verifyLogin();
        $data['page'] = 'teachers';
        $data['teachers'] = $this->teacher_model->getTeachers();
        // echo '<pre>';
        // echo var_dump($data['teachers']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/teacher');
        $this->load->view('template/footer');
    }

    public function classe(){
        $this->verifyLogin();
        $data['page'] = 'classes';
        $data['classes'] = $this->classe_model->getClasses();
        // echo '<pre>';
        // var_dump($data['classes']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/classe');
        $this->load->view('template/footer');
    }

    public function classeStudents($classeId){
        $this->verifyLogin();
        $data['page'] = 'classes';
        $data['classes'] = $this->classe_model->getClasses();
        $data['subjects'] = $this->subject_model->getTechSubjects();
        $data['resSubjects'] = $this->subject_model->getResSubjects();
        $seasonId = $this->season_model->getLastSeason()->id;
        $data['students'] = $this->student_model->getStudentsByClasse($classeId,$seasonId);
        // echo '<pre>';
        // var_dump($data['studnets']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/classeStudents');
        $this->load->view('template/footer');
    }

    public function subject(){
        $this->verifyLogin();
        $data['page'] = 'subjects';
        $data['subjects'] = $this->subject_model->getTechSubjects();
        // echo '<pre>';
        // echo var_dump($data['subjects']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/subject');
        $this->load->view('template/footer');
    }

    public function student(){
        $this->verifyResTeacherLogin();
        $data['page'] = 'students';
        $data['students'] = $this->student_model->getStudents($this->session->userdata('seasonid'));
        $data['classes'] = $this->classe_model->getClasses();
        $data['seasons'] = $this->season_model->getSeasons();
        // get the student by selected class
        
        
        if(isset($_POST['filterStudents'])){
            // echo '<pre>';
            // echo var_dump($this->input->post('season'),$this->input->post('classe'));
            // echo '</pre>';
            if($this->input->post('season') != null){
                $seasonId = $this->input->post('season');
            }else{
                $seasonId = $this->session->userdata('seasonid');
            }
            if($this->input->post('classe') == ''){
                $data['students'] = $this->student_model->getStudents($this->session->userdata('seasonid'));
            }else{
                $data['students'] = $this->student_model-> getStudentsByClasse($this->input->post('classe'),$seasonId);
            }
        }

        $this->load->view('template/header',$data);
        $this->load->view('admin/student');
        $this->load->view('template/footer');
    }

    public function studentCert($id){
        $this->verifyLogin();
        $data['page'] = 'students';
        $data['id'] = $id;
        $this->load->view('template/header',$data);
        $this->load->view('admin/studentCert');
        $this->load->view('template/footer');
    }

    public function studentPoints($id){
        $this->verifyLogin();
        $data['page'] = 'students';
        $data['subjects'] = $this->subject_model->getSubjects();
        $data['student'] = $this->student_model->getStudentById($id);
        $data['season'] = $this->season_model->getSeasonsById($data['student']->season);
        $this->load->view('template/stripeHeader',$data);
        $this->load->view('admin/studentPoints');
        $this->load->view('template/stripeFooter');
    }

    public function studentCont($id){
        $this->verifyLogin();
        // $data['page'] = 'students';
        // $data['subjects'] = $this->subject_model->getSubjects();
        $data['student'] = $this->student_model->getStudentById($id);
        $data['season'] = $this->season_model->getSeasonsById($data['student']->season);
        $data['certNumber'] = $this->setting_model->getLastCertNumber()+1;
        $this->load->view('template/stripeHeader',$data);
        $this->load->view('admin/studentContCer');
        $this->load->view('template/stripeFooter');
    }

    public function studentSuccessCert($id){
        $this->verifyLogin();
        // $data['page'] = 'students';
        // $data['subjects'] = $this->subject_model->getSubjects();
        $data['student'] = $this->student_model->getStudentById($id);
        $data['season'] = $this->season_model->getSeasonsById($data['student']->season);
        $data['certNumber'] = $this->setting_model->getLastCertNumber()+1;
        $this->load->view('template/stripeHeader',$data);
        $this->load->view('admin/studentSuccessCert');
        $this->load->view('template/stripeFooter');
    }

    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && $this->session->userdata('userRole') == 1)){
            redirect('/login/index');
        }
    }

    public function verifyResTeacherLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && ($this->session->userdata('userRole') == 1 || $this->session->userdata('userRole') == 0) && ($this->session->userdata('addStudentPerm') == 1 || $this->session->userdata('userRole') == 1 ) )){
            redirect('/login/index');
        }
    }

    public function updateLastCertNumber(){
        $this->setting_model->updateLastCertNumber();
    }
    
    public function createSeason(){
        $this->season_model->createSeason();
        redirect('/admin/index');
    }
}