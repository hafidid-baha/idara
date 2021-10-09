<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classe extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('classe_model');
        $this->load->library('session');
        $this->verifyLogin();
    }

    public function add(){
        if(isset($_POST['addclasse'])){
            $classeName = $this->input->post('classeName');
            $data = array('name' => $classeName);
            if($this->classe_model->add($data)>0){
				$this->session->set_flashdata('addSuccess', '1');
				$this->session->set_flashdata('title', 'نجاح');
				$this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
			}else{
				$this->session->set_flashdata('addError', '1');
				$this->session->set_flashdata('title', 'فشل');
				$this->session->set_flashdata('msg', 'فشلت عملية الاظافة');
            }
            redirect('/admin/classe');
        }
        $data['page'] = 'classes';
        $this->load->view('template/header',$data);
        $this->load->view('admin/addClasse');
        $this->load->view('template/footer');
    }

    public function update($id){
        if(isset($_POST['addclasse'])){
            $classeName = $this->input->post('classeName');
            $data = array('name' => $classeName);
            if($this->classe_model->update($data,$id)>0){
				$this->session->set_flashdata('addSuccess', '1');
				$this->session->set_flashdata('title', 'نجاح');
				$this->session->set_flashdata('msg', 'تمة عملية التحديت بنجاح');
			}else{
				$this->session->set_flashdata('addError', '1');
				$this->session->set_flashdata('title', 'فشل');
				$this->session->set_flashdata('msg', 'فشلت عملية التحديث');
            }
            redirect('/admin/classe');
        }
        $data['page'] = 'classes';
        $data['classe'] = $this->classe_model->getClassById($id);
        // echo '<pre>';
        // echo var_dump($data['classe']);
        // echo '</pre>';
        $this->load->view('template/header',$data);
        $this->load->view('admin/addClasse');
        $this->load->view('template/footer');
    }

    public function remove($id){
        if($this->classe_model->remove($id) > 0){
            $this->session->set_flashdata('addSuccess', '1');
            $this->session->set_flashdata('title', 'نجاح');
            $this->session->set_flashdata('msg', 'تمة عملية الحذف بنجاح');
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'فشلت عملية الحذف');
        }
        redirect('/admin/classe');
    }

    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 
        && $this->session->userdata('userRole') == 1)){
            redirect('/login/index');
        }
    }

    

}