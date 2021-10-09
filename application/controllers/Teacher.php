<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

    public function __construct(){
        parent::__construct();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $this->load->helper('url');
        $this->load->model('classe_model');
        $this->load->model('subject_model');
        $this->load->model('teacher_model');
        $this->load->library('session');
    }

    public function add(){
        $this->verifyLogin();
        // echo '<pre>';
        // echo var_dump($this->subject_model->getAvailableSubjects());
        // echo '</pre>';
        if(isset($_POST['addTeacher'])){
            $filename = time();
            $res = 0;
            $addStedentPerm = 0;
            if($this->input->post('responsible') != null && $this->input->post('responsible') == '1'){
                $res = 1;
            }
            if($this->input->post('addStudent') != null && $this->input->post('addStudent') == '1'){
                $addStedentPerm = 1;
            }
            $classes = $this->input->post('classes');
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => $filename.'.jpg',
                'tel' => $this->input->post('phone'),
                'username' => $this->input->post('username'),                
                'isRisponsible' => $res,
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'addStudentPer'=> $addStedentPerm,
                'isAdmin'=> 0
            );
            if(!empty($this->input->post('subject'))){
                $data['subjectId'] = $this->input->post('subject');
            }else{
                $data['subjectId'] = "0";
            }

            if($data['subjectId']== 0 && $data['isRisponsible'] == 0){
                // show the error and redirect to the image
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'المرجو التحقق من المادة المنوطة للاستاذ');
                redirect('/admin/teacher');
            }

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'jpg';
            $config['file_name']            = $filename.'.jpg';
            $config['max_size']             = 2000;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;

            $this->load->library('upload', $config);

            // echo '<pre>';
            // echo var_dump($_POST);
            // echo '</pre>';

            if ( !$this->upload->do_upload('image'))
            {
                // show the error and redirect to the image
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'المرجو التحقق من الصورة');
                redirect('/admin/teacher');
            }
            else
            {
                $lastId = $this->teacher_model->add($data);
                if($lastId > 0){
                    // add the teacher classes
                    $this->teacher_model->addTeacherClasses($classes,$lastId);
                    $this->session->set_flashdata('addSuccess', '1');
                    $this->session->set_flashdata('title', 'نجاح');
                    $this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
                    redirect('/admin/teacher');
                }
            }
        }
        $data['page'] = 'teachers';
        $data['classes'] = $this->classe_model->getClasses();
        $data['subjects'] = $this->subject_model->getAvailableSubjects();
        // echo '<pre>';
        // var_dump($data['subjects']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/addTeacher');
        $this->load->view('template/footer');
    }

    public function update($id){
        $this->verifyUsersLogin();
        $data['userRole'] = $this->session->userdata('userRole'); // 1 means the user is admin
        // echo $data['userRole'];
        $data['teacher'] = $this->teacher_model->getTeacher($id);
        // echo $data['teacher']->isAdmin;
        if(isset($_POST['addTeacher'])){
            // echo '<pre>';
            // echo var_dump($_POST);
            // echo '</pre>';
            // die();
            $filename = $data['teacher']->image;
            $classes = $this->input->post('classes');
            $res = 0;
            $addStedentPerm = 0;
            if($this->input->post('responsible') != null && $this->input->post('responsible') == '1'){
                $res = 1;
            }
            if($this->input->post('addStudent') != null && $this->input->post('addStudent') == '1'){
                $addStedentPerm = 1;
            }
            $info = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => $filename,//
                'tel' => $this->input->post('phone'),
                'username' => $this->input->post('username'),
                'isRisponsible' => $res,
                'addStudentPer'=> $addStedentPerm,
                'isAdmin'=> 0
            );
            if(!empty($this->input->post('password'))){
                $info['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            }
            if(!empty($this->input->post('subject'))){
                $info['subjectId'] = $this->input->post('subject');
            }else{
                $info['subjectId'] = "0";
            }

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

                        // echo '<pre>';
                        // echo var_dump($_POST);
                        // echo '</pre>';

                        if ( !$this->upload->do_upload('image'))
                        {
                            // show the error and redirect to the image
                            $this->session->set_flashdata('addError', '1');
                            $this->session->set_flashdata('title', 'فشل');
                            $this->session->set_flashdata('msg', 'المرجو التحقق من الصورة');
                            redirect('/admin/teacher');
                        }
                        else
                        {
                            if($this->teacher_model->update($id,$info) > 0){
                                // check if the classes exists first in case of updating teacher info the form sends an empty array
                                // because the teacher can not change his classes
                                if(isset($classes) && !empty($classes)){
                                    // update the classes and redirect
                                    $this->classe_model->removeClassesByTechId($id);
                                    // show successs and redirect
                                    $this->teacher_model->addTeacherClasses($classes,$id);
                                }
                                $this->session->set_flashdata('addSuccess', '1');
                                $this->session->set_flashdata('title', 'نجاح');
                                $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
                                redirect('/admin/teacher');
                            }else{
                                $this->session->set_flashdata('addError', '1');
                                $this->session->set_flashdata('title', 'فشل');
                                $this->session->set_flashdata('msg', 'فشلت عمبية التحديث');
                                redirect('/admin/teacher');
                            }
                        }
                    }
                }
            }else{
                // update all the info exept the image
                if($this->teacher_model->update($id,$info) > 0){
                    if(isset($classes) && !empty($classes)){
                        // update the classes and redirect
                        $this->classe_model->removeClassesByTechId($id);
                        // show successs and redirect
                        $this->teacher_model->addTeacherClasses($classes,$id);
                    }
                    $this->session->set_flashdata('addSuccess', '1');
                    $this->session->set_flashdata('title', 'نجاح');
                    $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
                    redirect('/admin/teacher');
                }else{
                    $this->session->set_flashdata('addError', '1');
                    $this->session->set_flashdata('title', 'فشل');
                    $this->session->set_flashdata('msg', 'فشلت عمبية التحديث');
                    redirect('/admin/teacher');
                }
            }
        }
        $data['page'] = 'teachers';
        $data['classes'] = $this->classe_model->getClasses();
        $data['subjects'] = $this->subject_model->getTechSubjects();
        $data['teacherClass'] = $this->classe_model->getClassesIdsByTeacherId($id);
        // echo '<pre>';
        // var_dump($data['teacherClass']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/addTeacher');
        $this->load->view('template/footer');
    }  

    public function remove($id){
        $this->verifyLogin();
        $teacher = $this->teacher_model->getTeacherById($id);
        if($this->teacher_model->remove($id)>0){
            // unlink the image
            if(file_exists('./uploads/'.$teacher->image)){
                unlink('./uploads/'.$teacher->image);
            }
            //remove the teacher classes
            $this->classe_model->removeClassesByTechId($id);
            $this->session->set_flashdata('addSuccess', '1');
            $this->session->set_flashdata('title', 'نجاح');
            $this->session->set_flashdata('msg', 'تمة عملية الحذف بنجاح');
            redirect('/admin/teacher');
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'فشلت عمبية الحذف');
            redirect('/admin/teacher');   
        }
    }

    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && $this->session->userdata('userRole') == 1)){
            redirect('/login/index');
        }
    }

    public function verifyUsersLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1)){
            redirect('/login/index');
        }
    }

}