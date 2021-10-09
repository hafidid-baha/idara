<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct(){
        parent::__construct();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $this->load->helper('url');
        $this->load->library('session');
        
        $this->load->model('setting_model');
        $this->load->model('classe_model');
        $this->load->model('subject_model');
        $this->load->model('student_model');
    }

    public function add(){
        $this->verifyResTeacherLogin();
        if(isset($_POST['addStudent'])){
            $filename = time();
            $code = $this->input->post('code');
            $password = $this->randomPassword();
            $to = $this->input->post('email');
            if(!$this->sendEmail($to,$password)){
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'المرجوا التحقق من البريد الالكتروني');
                redirect('/admin/student');
            }
            // die($password);
            $info = array(
                'name'=> $this->input->post('name'),
                'email'=> $to,
                'phone'=> $this->input->post('tel'),
                'code'=> $code,
                'dot'=> $this->input->post('dot'),
                'cin'=> $this->input->post('cin'),
                'classe'=> $this->input->post('classe'),
                'cadre'=> $this->input->post('cadre'),
                'image'=> $filename.'.jpg',
                'pwd'=> password_hash($password,PASSWORD_DEFAULT),
                'season' => $this->session->userdata('seasonid')
            );

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'jpg';
            $config['file_name']            = $filename.'.jpg';
            $config['max_size']             = 2000;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;

            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload('image'))
            {
                // show the error and redirect to the image
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'المرجو التحقق من الصورة');
                redirect('/admin/student');
            }
            else
            {
                if($this->student_model->add($info)){
                    $this->setting_model->updateLastStudentId($code);
                    // add the teacher classes
                    $this->session->set_flashdata('addSuccess', '1');
                    $this->session->set_flashdata('title', 'نجاح');
                    $this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
                    redirect('/admin/student');
                }
            }
        }
        $data['page'] = 'students'; 
        $data['lastId'] = $this->setLastId();
        $data['classes'] = $this->classe_model->getClasses();
        $data['subjects'] = $this->subject_model->getSubjects();
        // die('i am here');
        $this->load->view('template/header',$data);
        $this->load->view('admin/addStudent');
        $this->load->view('template/footer');
    }

    private function setLastId(){
        // $this->verifyLogin();
        $lastId = $this->setting_model->getLastStudentId();
        if($lastId == null){
            $this->setting_model->updateLastStudentId(null); // creating the last id
            $lastId = $this->setting_model->getLastStudentId();
        }
        // $lastId = str_replace('S','',$lastId);
        // $lastId = (int)$lastId;
        $length = 4;
        $numberOfDeg = strlen((string)$lastId);
        
        if((int)$numberOfDeg > $length){
            $length = 2;
        }
        $lastId = ((int)$lastId)+1;
        // echo '<pre>';
        // echo var_dump($lastId);
        // echo '<pre>';
        $lastId = str_pad($lastId,$length,'0',STR_PAD_LEFT);
        $lastId = 'S'.$lastId;
        return $lastId;
    }

    public function update($id){
        $this->verifyLogin();
        if(isset($_POST['addStudent'])){
            $student = $this->student_model->getStudentById($id);
            $filename = $student->image;
            $info = array(
                'name'=> $this->input->post('name'),
                'email'=> $this->input->post('email'),
                'phone'=> $this->input->post('tel'),
                'code'=> $this->input->post('code'),
                'dot'=> $this->input->post('dot'),
                'cin'=> $this->input->post('cin'),
                'classe'=> $this->input->post('classe'),
                'cadre'=> $this->input->post('cadre'),
                'image'=> $filename
            );
            
            if(!empty($_FILES['image']['name'])){
                // delete the old image and upload the new one
                if(file_exists('./uploads/'.$filename)){
                    if(unlink('./uploads/'.$filename)){
                        $config['upload_path']          = './uploads/';
                        $config['allowed_types']        = 'jpg';
                        $config['file_name']            = $filename;
                        $config['max_size']             = 2000;
                        $config['max_width']            = 1024;
                        $config['max_height']           = 1024;

                        $this->load->library('upload', $config);

                        if ( !$this->upload->do_upload('image'))
                        {
                            // show the error and redirect to the image
                            $this->session->set_flashdata('addError', '1');
                            $this->session->set_flashdata('title', 'فشل');
                            $this->session->set_flashdata('msg', 'المرجو التحقق من الصورة');
                            redirect('/admin/student');
                        }
                        else
                        {
                            if($this->student_model->update($id,$info) > 0){
                                $this->session->set_flashdata('addSuccess', '1');
                                $this->session->set_flashdata('title', 'نجاح');
                                $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
                                redirect('/admin/student');
                            }else{
                                $this->session->set_flashdata('addError', '1');
                                $this->session->set_flashdata('title', 'فشل');
                                $this->session->set_flashdata('msg', 'فشلت عمبية التحديث');
                                redirect('/admin/student');
                            }
                        }
                    }
                }
            }else{
                if($this->student_model->update($id,$info) > 0){
                    $this->session->set_flashdata('addSuccess', '1');
                    $this->session->set_flashdata('title', 'نجاح');
                    $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
                    redirect('/admin/student');
                }else{
                    $this->session->set_flashdata('addError', '1');
                    $this->session->set_flashdata('title', 'فشل');
                    $this->session->set_flashdata('msg', 'فشلت عمبية التحديث');
                    redirect('/admin/student');
                }
            }
        }

        $data['page'] = 'students';
        $data['lastId'] = $this->setLastId();
        $data['classes'] = $this->classe_model->getClasses();
        $data['subjects'] = $this->subject_model->getSubjects();
        $data['student'] = $this->student_model->getStudentById($id);
        $this->load->view('template/header',$data);
        $this->load->view('admin/addStudent');
        $this->load->view('template/footer');

    }

    public function remove($id){
        $this->verifyLogin();
        $student = $this->student_model->getStudentById($id);
        if($this->student_model->remove($id)){
            if(file_exists('./uploads/'.$student->image)){
                if(unlink('./uploads/'.$student->image)){
                    $this->session->set_flashdata('addSuccess', '1');
                    $this->session->set_flashdata('title', 'نجاح');
                    $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
                }
            }
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'فشلت عمبية الحذف');
            redirect('/admin/student');
        }
        redirect('/admin/student');
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

    // send email conatin the stdent loggin password
    public function sendEmail($to,$pwd){
        $this->load->library('email');
        $this->load->helper('email');

        if (!valid_email($to))
        {   
            return false;
        }
        
        $config = array('mailType'=>'html');
            
        $this->email->initialize($config);
        
		$this->email->from('hafid@crmef.website', 'Crfem.website');
		$this->email->to($to);
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');

		$this->email->subject('Account Login Password');
		$this->email->message('Your Login Password is '.$pwd);

		if($this->email->send()){
			return true;
		}else{
			return false;
		}
    }

    // generate random passowrd (8 charachters)
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@?';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

}