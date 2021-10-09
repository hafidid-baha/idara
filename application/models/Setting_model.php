<?php
class Setting_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getLastStudentId()
    {
        $this->db->select('last_student_id');
        $data = $this->db->get('settings')->row();
        if($data != null){
            return $data->last_student_id;
        }else{
            return null;
        }
    }

    public function updateLastStudentId($lastId = null){
        if($lastId == null){
            // create the new one starting from number one
            $id = $this->getLastStudentId();
            if($id == null){
                $info = array(
                    'last_student_id' => '1'
                );
                $this->db->insert('settings',$info);
            }elseif($id == '0'){
                $info = array(
                    'last_student_id' => '1'
                );
                $this->db->update('settings',$info);
            }
        }else{
            // update the existing student last number
            $lastId = str_replace('S','',$lastId);
            $lastId = (int)$lastId;
            $info = array(
                'last_student_id' => $lastId
            );
            return $this->db->update('settings',$info);
        }
    }

    public function getLastCertNumber(){
        $this->db->select('certNumber');
        $cert = $this->db->get('settings')->row()->certNumber;
        if($cert == null){
            return 0;
        }else{
            return $cert;
        }
    }

    public function updateLastCertNumber(){
        $certNumber = $this->getLastCertNumber();
        $certNumber = ((int)$certNumber)+1;
        $info = array(
            'certNumber'=>$certNumber
        );
        return $this->db->update('settings',$info);
    }
}