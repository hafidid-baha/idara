<?php
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($data){
        // get the data by the user name
        if($data['loginType'] == 'student'){
            $this->db->where('email',$data['username']);
            $user = $this->db->get('students')->row();
        }else if($data['loginType'] == 'teacher'){
            $this->db->where('username',$data['username']);
            $user = $this->db->get('users')->row();
        }
        if($user == null){
            return null;
        }else{
            // echo var_dump($user);
            // die();
            // verify the password
            if(password_verify($data['password'],$user->password)){
                return $user;
            }
            return null;
        }
    }
}
