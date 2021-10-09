<?php
class Blog_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($data){
        return $this->db->insert('posts',$data);
    }

    public function getPosts(){
        return $this->db->get('posts')->result();
    }

    public function getUserPosts($id){
        $this->db->where('user',$id);
        return $this->db->get('posts')->result();
    }

    public function getPostById($id){
        $this->db->where('id',$id);
        return $this->db->get('posts')->row();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('posts',$data);
    }

    public function remove($id){
        $this->db->where('id',$id);
        return $this->db->delete('posts');
    }

    public function getPotsWithUsers(){
        $this->db->select('posts.id as postId,posts.title,posts.subject,posts.user,posts.date,users.id,users.name,users.image');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user');
        return $this->db->get()->result();
    }

    public function getPotsWithUsersByPostType($type){
        $this->db->select('posts.id as postId,posts.title,posts.subject,posts.postType,posts.user,posts.date,users.id,users.name,users.image');
        $this->db->where('posts.postType',$type);
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user');
        return $this->db->get()->result();
    }

    public function getPotsWithUsersByid($postId){
        $this->db->select('posts.id as postId,posts.title,posts.subject,posts.user,posts.date,users.id,users.name,users.image');
        $this->db->where('posts.id',$postId);
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user');
        return $this->db->get()->row();
    }

}