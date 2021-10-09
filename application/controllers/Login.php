<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('season_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->verifyLogin();
        $this->load->view('template/stripeHeader');
        $this->load->view('login');
        $this->load->view('template/stripeFooter');
    }

    public function login(){
        $this->verifyLogin();
        if(isset($_POST['login'])){
            $remember = $this->input->post('remember');
            $loginType = $this->input->post('loginType');
            
            $info = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'loginType' => $loginType
            );
            $user = $this->user_model->login($info);

            if($user != null){
                // get the last season
                $season = $this->season_model->getLastSeason();
                // echo '<pre>';
                // echo var_dump($season);
                // echo '</pre>';
                // create your session and redirect the user to the admin area
                $userData = array(
                    'username' =>$user->name,
                    'userImage' => $user->image,
                    'userId'=> $user->id,
                    'season'=> $season->content,
                    'seasonid'=> $season->id,
                    'loggedIn'=> 1
                );

                if(isset($user->isAdmin)){
                    $userData['userRole'] = $user->isAdmin;
                }else{
                    $userData['userRole'] = 2; // 2 means the user is student
                }
                if(isset($user->isRisponsible)){
                    $userData['responsible'] = $user->isRisponsible;
                }else{
                    $userData['responsible'] = 0;
                }
                if(isset($user->addStudentPer)){
                    $userData['addStudentPerm'] = $user->addStudentPer;
                }else{
                    $userData['addStudentPer'] = 0;
                }
                

                $this->session->set_userdata($userData);
                if($remember != null && $remember == 'on'){
                    $this->session->mark_as_temp(array_keys($userData),2592000);
                }
                redirect('/admin/index');
            }else{
                redirect('/login/index');
            }
        }else{
            redirect('/login/index');
        }
    }

    public function verifyLogin(){
        if($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1
        && $this->session->userdata('userRole') == 1){
            redirect('/admin/index');
        }else if($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1
        && $this->session->userdata('userRole') == 0){
            redirect('/user/index');
        }else if($this->session->has_userdata('loggedIn') && $this->session->userdata('loggedIn') == 1
        && $this->session->userdata('userRole') == 2){
            redirect('/grantedStudent/index');
        }
    }

    public function logout(){
        $userData = array('username','userImage','userRole','userId','season','seasonid','responsible','loggedIn');
        $this->session->unset_userdata($userData);
        $this->session->sess_destroy();
        redirect('/blog/posts');
    }
}