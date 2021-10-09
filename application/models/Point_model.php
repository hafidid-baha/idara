<?php
class Point_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save($data){
        return $this->db->insert('points',$data);
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('points',$data);
    }

    public function getPointById($id){
        $this->db->where('id',$id);
        return $this->db->get('points')->row();
    }

    public function getPointsByStudent($studentId,$subjectId){
        $this->db->where('student',$studentId);
        $this->db->where('subject',$subjectId);
        return $this->db->get('points')->row();
    }

    public function checkForPoint($studentId,$subjectId){
        $this->db->where('student',$studentId);
        $this->db->where('subject',$subjectId);
        return $this->db->get('points')->row();
    }

    public function checkSubjectPointsExists($subjectId){
        $this->db->where('subject',$subjectId);
        $points =  $this->db->get('points')->result();
        if($points == null){
            return false;
        }else{
            return true;
        }
    }
}