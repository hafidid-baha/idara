<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('subject_model');
        $this->verifyLogin();
    }

    public function add(){
        if(isset($_POST['saveSub'])){
            $data = array('name' => $this->input->post('name'));
            if($this->subject_model->add($data) > 0){
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
            }else{
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'فشلت عملية الاظافة');
            }
            redirect('/admin/subject');
        }
        $data['page'] = 'subjects';
        $this->load->view('template/header',$data);
        $this->load->view('admin/addSubject');
        $this->load->view('template/footer');
    }

    public function update($id){
        if(isset($_POST['saveSub'])){
            $data = array('name' => $this->input->post('name'));
            if($this->subject_model->update($id,$data) > 0){
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
            }else{
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'فشلت عملية التحديث');
            }
            redirect('/admin/subject');
        }
        $data['page'] = 'subjects';
        $data['subject'] = $this->subject_model->getSubjectById($id);
        $this->load->view('template/header',$data);
        $this->load->view('admin/addSubject');
        $this->load->view('template/footer');
    }

    public function remove($id){
        if($this->subject_model->remove($id) > 0){
            $this->session->set_flashdata('addSuccess', '1');
            $this->session->set_flashdata('title', 'نجاح');
            $this->session->set_flashdata('msg', 'تمة عملية الحذف بنجاح');
        }else{
            $this->session->set_flashdata('addSuccess', '1');
            $this->session->set_flashdata('title', 'نجاح');
            $this->session->set_flashdata('msg', 'فشلت عملية الخذف');
        }
        redirect('/admin/subject');
    }

    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && $this->session->userdata('userRole') == 1)){
            redirect('/login/index');
        }
    }

}