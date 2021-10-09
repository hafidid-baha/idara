<?php
class Season_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getLastSeason(){
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $season = $this->db->get('seasons')->row();
        if($season == null){
            $this->createSeason();
            $this->getLastSeason();
        }
        return $season;
    }

    public function getSeasons(){
        return $this->db->get('seasons')->result();
    }

    public function getSeasonsById($id){
        $this->db->where('id',$id);
        return $this->db->get('seasons')->row();
    }

    public function createSeason(){
        $season = $this->getSeasonCurrentDate();
        $info = array(
            'content' => $season,
            'started_date'=>date('Y-m-d')
        );
        return $this->db->insert('seasons',$info);
    }

    public function getSeasonCurrentDate(){
        $year = date('Y');
        $month = date('n');
        $counter = 1;
        if($month <= 9){
            $counter = -1;
        }else{
            $counter = 1;
        }
        $res = (int)$year+$counter;
        $data = '';
        if($res > $year){
            $data .= $year.'/'.$res;
        }else{
            $data .= $res.'/'.$year;
        }
        return $data;
    }

    public function isCreateSeasAvailable(){
        $data = $this->getLastSeason();
        if($data != null){
            $content = $data->content;
            if($content == $this->getSeasonCurrentDate()){
                return false;
            }else{
                return true;
            }
        }
        return true;
    }

}