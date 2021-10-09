<?php
class Teacher_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        if($data['isRisponsible'] == 1){
            $this->db->update('users',array('isRisponsible'=>0));
        }
        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }

    public function addTeacherClasses($data,$teacherId)
    {
        foreach($data as $d=>$val){
            $newData = array('teacher_id'=>$teacherId,'classe_id'=>$val);
            $this->db->insert('teacher_class',$newData);       
        }
    }

    public function getTeachers(){
        $this->db->select("users.*,subjects.name as sname");
        $this->db->join('subjects','users.subjectId = subjects.id','left');
        $this->db->where('users.isAdmin',0);
        return $this->db->get('users')->result();
    }

    public function getTeacherById($id){
        $data = array(
            'isAdmin'=>0,
            'id'=>$id
        );
        $this->db->where($data);
        return $this->db->get('users')->row();
    }

    public function getUserById($id){
        $data = array(
            'id'=>$id
        );
        $this->db->where($data);
        return $this->db->get('users')->row();
    }

    public function getTeacher($id){
        $data = array(
            'id'=>$id
        );
        $this->db->where($data);
        return $this->db->get('users')->row();
    }

    public function update($id,$data){
        if($data['isRisponsible'] == 1){
            $this->db->update('users',array('isRisponsible'=>0));
        }
        $this->db->where('id',$id);
        return $this->db->update('users',$data);
    }

    public function remove($id){
        $this->db->where('id',$id);
        return $this->db->delete('users');
    }

    public function getTeacherCount(){
        $this->db->where('isAdmin',0);
        $this->db->select('count(*) as count');
        return $this->db->get('users')->row()->count;
    }

}