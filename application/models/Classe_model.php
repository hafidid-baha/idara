<?php
class Classe_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        return $this->db->insert('classes',$data);
    }

    public function getClasses(){
        return $this->db->get('classes')->result();
    }

    public function getTeacherClasses($teacherId){
        $this->db->where('teacher_class.teacher_id',$teacherId);
        $this->db->join('teacher_class','teacher_class.classe_id=classes.id','left');
        return $this->db->get('classes')->result();
    }

    public function getClassById($id){
        $this->db->where('id',$id);
        return $this->db->get('classes')->row();
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('classes',$data);
    }

    public function remove($id){
        $this->db->where('id',$id);
        return $this->db->delete('classes');
    }

    public function getClassesIdsByTeacherId($id){
        $this->db->select('teacher_class.classe_id as id');
        $this->db->where('teacher_id',$id);
        $data = $this->db->get('teacher_class')->result_array();
        if($data != null){
            $newD = array();
            foreach($data as $key=>$val){
                // array_push($newD,$val);
                $newD[] = $val['id'];
            }
            return $newD;
        }
        return null;
    }

    public function removeClassesByTechId($teacherid){
        $this->db->where('teacher_id',$teacherid);
        return $this->db->delete('teacher_class');
    }

    public function getClassesCount(){
        $this->db->select('count(*) as count');
        return $this->db->get('classes')->row()->count;
    }

}