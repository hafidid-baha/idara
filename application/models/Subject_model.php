<?php
class Subject_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        return $this->db->insert('subjects',$data);
    }

    public function getSubjects(){
        $this->db->where('parent','0');
        return $this->db->get('subjects')->result();
    } 
    
    // get all the subject except the 3 responsble subjects 
    public function getTechSubjects(){
        $names = array('التداريب','البحث','امتحان التخرج');
        $this->db->where('parent','0');
        $this->db->where_not_in('name',$names);
        return $this->db->get('subjects')->result();
    } 

    public function getAvailableSubjects(){
        $names = array('التداريب','البحث','امتحان التخرج');
        $ids = $this->getAvailableSubjectsIds();
        $this->db->where('parent','0');
        $this->db->where_not_in('name',$names);
        $this->db->where_not_in('id',$ids);
        return $this->db->get('subjects')->result();
    }
    
    public function getAvailableSubjectsIds(){
        $this->db->select('subjectId');
        $this->db->distinct();
        $subids = $this->db->get('users')->result_array();
        $data = array();
        foreach($subids as $id){
            $data[] = $id['subjectId'];
        }
        return $data;
    }
    
    public function getResSubjects(){
        $names = array('التداريب','البحث','امتحان التخرج');
        $this->db->where_in('name',$names);
        return $this->db->get('subjects')->result();
    }

    public function getSubSubjects($subId){
        $this->db->where('parent',$subId);
        return $this->db->get('subjects')->result();
    }

    public function getTeacherSubject($teacherId){
        $this->db->select('subjects.id,subjects.name');
        $this->db->join('users','users.subjectId=subjects.id','left');
        $this->db->where('users.id',$teacherId);
        return $this->db->get('subjects')->result();
    }

    public function getSubjectById($id){
        $this->db->where('id',$id);
        return $this->db->get('subjects')->row();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('subjects',$data);
    }

    public function remove($id){
        $this->db->where('id',$id);
        return $this->db->delete('subjects');
    }

    public function getSubjectsCount(){
        $this->db->where('parent','0');
        $this->db->select('count(*) as count');
        return $this->db->get('subjects')->row()->count;
    }

    public function getResSubjectsIds(){
        $names = array('التداريب','البحث','امتحان التخرج');
        $this->db->select('id');
        $this->db->where_in('name',$names);
        return $this->db->get('subjects')->result_array();
    }

}