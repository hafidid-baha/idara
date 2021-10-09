<?php
class Student_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        return $this->db->insert('students',$data);
    }

    public function getStudents($seasonId){
        $this->db->where('season',$seasonId);
        return $this->db->get('students')->result();
    }

    public function getStudentById($id){
        $this->db->where('id',$id);
        return $this->db->get('students')->row();
    }

    public function getStudentsByClasse($classeId,$seasonId){
        $this->db->where('season',$seasonId);
        $this->db->where('classe',$classeId);
        return $this->db->get('students')->result();
    }

    public function getStudentsCountInClasse($classeId){
        $this->db->select('count(*) as count');
        $this->db->where('classe',$classeId);
        return $this->db->get('students')->row();
    }

    // used to get students and his points by classid and season and
    public function getStudentsByClassId($classeId,$lastSeasonId,$ids){
        $this->db->select('students.*,points.sc,points.te');
        $this->db->join('classes','students.classe=classes.id','left');
        $this->db->join('points','points.student=students.id','left');
        $this->db->where('students.classe',$classeId);
        $this->db->where('students.season',$lastSeasonId);
        $this->db->where_not_in('points.subject',$ids);
        return $this->db->get('students')->result();
    }

    // used to get students and his points by classid and season and subject id
    // public function getStudentsByClassIdAndSub($classeId,$lastSeasonId,$subject){
    //     $this->db->select('students.*,points.sc,points.te');
    //     $this->db->join('classes','students.classe=classes.id','left');
    //     $this->db->join('points','points.student=students.id');
    //     $this->db->where('students.classe',$classeId);
    //     $this->db->where('students.season',$lastSeasonId);
    //     $this->db->where('points.subject',$subject);
    //     echo $this->db->get_compiled_select('students');
    // }

    // used to get students and his points by classid and season and
    public function getStudentsByClassIdAndSub($lastSeasonId,$sub,$classe){
        $this->db->select('students.*,points.subject,points.sc,points.te');
        $this->db->join('classes','students.classe=classes.id');
        $this->db->join('points','points.student=students.id');
        // $this->db->where('students.classe',$classeId);
        $filter = array(
            'students.season'=>$lastSeasonId,
            'points.subject'=>$sub,
            'classes.id'=>$classe
        );
        $this->db->where($filter);
        // $this->db->where_in('points.subject',$ids);
        return $this->db->get('students')->result();
    }

    // get the students list if the student didn't have a subject point
    public function getStudentsByClassIdAndSubGen($lastSeasonId,$classe){
        // $this->db->select('students.*,points.subject,points.sc,points.te');
        $this->db->select('students.*');
        $this->db->join('classes','students.classe=classes.id');
        // $this->db->join('points','points.student=students.id');
        // $this->db->where('students.classe',$classeId);
        $filter = array(
            'students.season'=>$lastSeasonId,
            'classes.id'=>$classe
            // 'points.subject'=>$sub
        );
        $this->db->where($filter);
        // $this->db->where_in('points.subject',$ids);
        return $this->db->get('students')->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('students',$data);
    }

    public function remove($id){
        $this->db->where('id',$id);
        return $this->db->delete('students');
    }

    public function getStudentsCount(){
        $this->db->select('count(*) as count');
        return $this->db->get('students')->row()->count;
    }

}