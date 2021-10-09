<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->verifyLogin();

        $this->load->model('classe_model');
        $this->load->model('subject_model');
        $this->load->model('student_model');
        $this->load->model('season_model');
        $this->load->model('point_model');
    }

    public function index($update = ''){
        $data['page'] = 'index';
        $data['classes'] = $this->classe_model->getTeacherClasses($this->session->userdata('userId'));
        $data['subject'] = $this->subject_model->getTeacherSubject($this->session->userdata('userId'));
        $season = $this->season_model->getLastSeason(); 
        $resopnible = $this->session->userdata('responsible');

        // echo '<pre>';
        // var_dump($this->session->userdata('userId'));
        // echo '</pre>';
        //set the user data to be used later
        if($update == '' && !empty($data['classes']) && !empty($data['subject'])){
            $this->session->set_userdata('teacher_classe',$data['classes'][0]->classe_id);
            $this->session->set_userdata('teacher_sub',$data['subject'][0]->id);
        }
        // get all the subject ids that controls by the responsible teacher
        $ids = $this->subject_model->getResSubjectsIds();
        $nIds = array();
        foreach($ids as $key=>$val){
            array_push($nIds,$val['id']);
        }
        // echo '<pre>';
        // echo var_dump($this->session->userdata('teacher_sub'));
        // echo '</pre>';
        
        if($resopnible == "1"){
            $data['subject'] = $this->subject_model->getResSubjects();
            if($update == ''){
                // echo 'here';
                $this->session->set_userdata('teacher_sub',$data['subject'][0]->id);
            }
            // echo '<pre>';
            // echo $this->session->userdata('teacher_sub');
            // echo '</pre>';
            $data['students'] = $this->student_model->getStudentsByClassIdAndSub($season->id,$this->session->userdata('teacher_sub'),$this->session->userdata('teacher_classe'));
            // echo '<pre>';
            // echo var_dump($data['students']);
            // echo '</pre>';
            if(empty($data['students'])){
                $data['students'] = $this->student_model->getStudentsByClassIdAndSubGen($season->id,$this->session->userdata('teacher_classe'));
            }
            $data['students'] = array_filter($data['students'],function($v,$k){
                if($v->classe == $this->session->userdata('teacher_classe')){
                    return true;
                }
            },ARRAY_FILTER_USE_BOTH);
        
            $data['subSubjects'] = $this->subject_model->getSubSubjects($this->session->userdata('teacher_sub'));
            
            $this->load->view('/template/header',$data);
            // echo $this->session->userdata('teacher_sub');
            $this->load->view('/teacher/respons');    
        }else{  
            $data['students'] = $this->student_model->getStudentsByClassIdAndSub($season->id,$this->session->userdata('teacher_sub'),$this->session->userdata('teacher_classe'));
            if(empty($data['students'])){
                $data['students'] = $this->student_model->getStudentsByClassIdAndSubGen($season->id,$this->session->userdata('teacher_classe'));
            }
            $data['students'] = array_filter($data['students'],function($v,$k){
                if($v->classe == $this->session->userdata('teacher_classe')){
                    return true;
                }
            },ARRAY_FILTER_USE_BOTH);          
            $this->load->view('/template/header',$data);
            $this->load->view('/teacher/index');    
        }
        $this->load->view('/template/footer');
    }

    public function refresh(){
        $subject = $this->input->post('subject');
        $classe = $this->input->post('classe');
        $this->session->set_userdata('teacher_classe',$classe);
        $this->session->set_userdata('teacher_sub',$subject);
        redirect('/user/index/updated');
    }

    public function addPoints(){
        if(!empty($_POST)){
            $posts = array();
            $info = array(
                'subject'=>$this->session->userdata('teacher_sub')
            );
            $users = array();
            foreach($_POST as $key=>$val){
                $userId = substr($key,3);
                $sc = $_POST['sc_'.$userId];
                $te = $_POST['te_'.$userId];
                if(!in_array($userId,$users)){
                    // echo 'user '.$userId.' sc '.$sc.' te '.$te.'<br />';
                    $info['student'] = $userId;
                    $info['sc'] = $sc;
                    $info['te'] = $te;
                    //insert the userid to the users array
                    array_push($users,$userId);
                    array_push($posts,$info);
                }
            }
            $addeCount = 0;
            foreach($posts as $p){
                $addeCount += $this->save($p);
            }
            if($addeCount == count($posts)){
                // show the success and redirect
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة العملية بنجاح');
                redirect('/user/index');
            }else{
                // show the error and redirect
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'لقد وقعت مشكلة اثناء العملية');
                redirect('/user/index');
            }
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'المرجو التاكد من البيانات المدخلة');
            redirect('/user/index');
        }
    }

    public function save($info){
        $count = 0;
        $point = $this->point_model->checkForPoint($info['student'],$info['subject']);
        if($point != null){
            //update
            if($this->point_model->update($info,$point->id)){
                return 1;
            }else{
                return 0;
            }
        }else{
            // echo 'redy to add <br />';
            // die();  
            // add new recourd
            if($this->point_model->save($info)){
                return 1;
            }else{
                return 0;
            }
        }
    }


    public function addResPoints(){
        if(!empty($_POST)){
            $points = array();
            $studentIds = array();
            $firstSub = explode('_',str_replace('M_','',array_keys($_POST)[0]))[1];
            foreach($_POST as $key=>$val){
                $key = explode('_',str_replace('M_','',$key));
                $student = (int)$key[0];
                $sub = (int)$key[1];
                $subject = $this->session->userdata('teacher_sub');
                if(!in_array($student,$studentIds)){
                    array_push($studentIds,$student);
                }   
            }
            foreach($studentIds as $s){
                // echo 'value for student '.$s.' first '.$_POST['M_'.$s.'_'.$firstSub].' and secound is '.$_POST['M_'.$s.'_'.($firstSub+1)].'<br />';
                $info = array(
                    'subject' => $this->session->userdata('teacher_sub'),
                    'student'=>$s,
                    'sc'=>$_POST['M_'.$s.'_'.$firstSub],
                    'te'=>$_POST['M_'.$s.'_'.($firstSub+1)]
                );
                array_push($points,$info);
            }
            $addeCount = 0;
            foreach($points as $p){
                $addeCount += $this->save($p);
            }
            if($addeCount == count($points)){
                // show the success and redirect
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة العملية بنجاح');
                redirect('/user/index');
            }else{
                // show the error and redirect
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'لقد وقعت مشكلة اثناء العملية');
                redirect('/user/index');
            }
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'المرجو التاكد من البيانات المدخلة');
            redirect('/user/index');
        }
    }

    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && $this->session->userdata('userRole') == 0)){
            redirect('/login/index');
        }
    }
}