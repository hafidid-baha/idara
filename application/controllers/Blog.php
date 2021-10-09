<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('blog_model');
        $this->load->model('teacher_model');
        $this->load->model('postType_model');
    }

    public function index(){
        $this->verifyUsersLogin();
        $role = $this->session->userdata('userRole');
        if($role == 1){
            $data['posts'] = $this->blog_model->getPosts();
        }else{
            $data['posts'] = $this->blog_model->getUserPosts($this->session->userdata('userId'));
        }

        $this->load->view('template/blogHeader',$data);
        $this->load->view('blog/index');
        $this->load->view('template/footer');
    }

    public function posts($slug = ''){
        if($slug == ''){
            $data['page'] = "posts";
            $data['posts'] = $this->blog_model->getPotsWithUsers();
        }else{
            // echo 'i am here '.$slug;
            $data['page'] = $slug;
            $data['posts'] = $this->blog_model->getPotsWithUsersByPostType($slug);
        }
        // echo '<pre>';
        // echo var_dump($data['posts']);
        // echo '</pre>';
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1)){
            $data['loged'] = false;
        }else{
            $data['loged'] = true;
        }
        // echo '<pre>';
        // echo var_dump($data['posts']);
        // echo '</pre>';
        $data['postTypes'] = $this->postType_model->getParentPostType();
        $this->load->view('template/indexHeader',$data);
        $this->load->view('blog/posts');
        $this->load->view('template/footer');
    }


    public function post($id){
        if((int)$id > 0){
            // get the post details
            $data['post'] = $this->blog_model->getPotsWithUsersByid($id);
            if(empty($data['post'])){
                redirect('/blog/posts');
            }
        }else{
            redirect('/blog/posts');
        }

        $data['page'] = "posts";
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1)){
            $data['loged'] = false;
        }else{
            $data['loged'] = true;
        }
        $data['postTypes'] = $this->postType_model->getParentPostType();
        $this->load->view('template/indexHeader',$data);
        $this->load->view('blog/postDetails');
        $this->load->view('template/footer');
    }

    public function addType(){
        $this->verifyUsersLogin();
        if(isset($_POST['addPostType'])){
            $info = array(
                'name'=> $this->input->post('name'),
                'parent'=> $this->input->post('parent'),
            );

            if($this->postType_model->addPostType($info)){
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
                redirect('/blog/index');
            }else{
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'فشلت عملية الاظافة');
                redirect('/blog/index');
            }

        }
        $data['postTypes'] = $this->postType_model->getParentPostType();
        $data['allPostTypes'] = $this->postType_model->getAllPostType();
        $this->load->view('template/blogHeader',$data);
        $this->load->view('blog/addPostType');
        $this->load->view('template/footer');
    }

    public function add(){
        $this->verifyUsersLogin();
        if(isset($_POST['addPost'])){
            $info = array(
                'title'=> $this->input->post('title'),
                'subject'=> $this->input->post('content'),
                'user' => $this->session->userdata('userId'),
                'postType' => $this->input->post('posttype'),
                'date' => date('Y-m-d')
            );

            if($this->blog_model->add($info)){
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
                redirect('/blog/index');
            }else{
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'فشلت عملية الاظافة');
                redirect('/blog/index');
            }
        }
        $data['postTypes'] = $this->postType_model->getAllPostType();
        $this->load->view('template/blogHeader',$data);
        $this->load->view('blog/addPost');
        $this->load->view('template/footer');
    }

    public function updateType($id){
        $this->verifyUsersLogin();
        if(isset($_POST['addPostType'])){
            $info = array(
                'name'=> $this->input->post('name'),
                'parent'=> $this->input->post('parent'),
            );

            if($this->postType_model->update($info,$id)){
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة عملية الاظافة بنجاح');
                redirect('/blog/index');
            }else{
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'فشلت عملية الاظافة');
                redirect('/blog/index');
            }

        }
        $data['postType'] = $this->postType_model->getPostType($id);
        $data['allPostTypes'] = $this->postType_model->getAllPostType();
        $data['postTypes'] = $this->postType_model->getParentPostType();
        $this->load->view('template/blogHeader',$data);
        $this->load->view('blog/addPostType');
        $this->load->view('template/footer');
    }

    public function update($id){
        $this->verifyUsersLogin();
        if(isset($_POST['addPost'])){
            $info = array(
                'title'=> $this->input->post('title'),
                'subject'=> $this->input->post('content'),
                'user' => $this->session->userdata('userId'),
                'postType' => $this->input->post('posttype'),
                'date' => date('Y-m-d')
            );

            if($this->blog_model->update($id,$info)){
                $this->session->set_flashdata('addSuccess', '1');
                $this->session->set_flashdata('title', 'نجاح');
                $this->session->set_flashdata('msg', 'تمة عملية التحديث بنجاح');
                redirect('/blog/index');
            }else{
                $this->session->set_flashdata('addError', '1');
                $this->session->set_flashdata('title', 'فشل');
                $this->session->set_flashdata('msg', 'فشلت عملية التحديث');
                redirect('/blog/index');
            }

        }
        $data['postTypes'] = $this->postType_model->getAllPostType();
        $data['post'] = $this->blog_model->getPostById($id);
        $this->load->view('template/blogHeader',$data);
        $this->load->view('blog/addPost');
        $this->load->view('template/footer');
    }

    public function remove($id){
        $this->verifyUsersLogin();
        if($this->blog_model->remove($id)){
            $this->session->set_flashdata('addSuccess', '1');
            $this->session->set_flashdata('title', 'نجاح');
            $this->session->set_flashdata('msg', 'تمة عملية الحذف بنجاح');
            redirect('/blog/index');
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'فشلت عملية الحذف');
            redirect('/blog/index');
        }
    }

    public function removePostType($id){
        $this->verifyUsersLogin();
        if($this->postType_model->remove($id)){
            $this->session->set_flashdata('addSuccess', '1');
            $this->session->set_flashdata('title', 'نجاح');
            $this->session->set_flashdata('msg', 'تمة عملية الحذف بنجاح');
            redirect('/blog/index');
        }else{
            $this->session->set_flashdata('addError', '1');
            $this->session->set_flashdata('title', 'فشل');
            $this->session->set_flashdata('msg', 'فشلت عملية الحذف');
            redirect('/blog/index');
        }
    }


    public function verifyLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1)){
            redirect('/login/index');
        }
    }

    public function verifyUsersLogin(){
        if(!($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1 &&
         ($this->session->userdata('userRole') == 1 || $this->session->userdata('userRole') == 0))){
            redirect('/login/index');
        }
    }
}