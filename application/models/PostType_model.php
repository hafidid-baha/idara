<?php
class PostType_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function addPostType($data){
        return $this->db->insert('PostTypes',$data);
    }

    public function getParentPostType(){
        $this->db->where('parent',0);
        return $this->db->get('PostTypes')->result();
    }

    public function getPostType($id){
        $this->db->where('id',$id);
        return $this->db->get('PostTypes')->row();
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('PostTypes',$data);
    }

    public function getAllPostType(){
        // $this->db->where('parent',0);
        return $this->db->get('PostTypes')->result();
    }

    public function getAllSubPostType($id){
        $this->db->where('parent',$id);
        return $this->db->get('PostTypes')->result();
    }

    public function remove($id){
        $posttype = $this->getPostType($id);
        if($posttype->parent == 0){
            $subPostType = $this->getAllSubPostType($id);
            foreach($subPostType as $sub){
                $this->db->where('id',$sub->id);
                $this->db->delete('PostTypes');
            }
        }
        $this->db->where('id',$id);
        return $this->db->delete('PostTypes');
    }

}