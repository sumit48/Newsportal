<?php 
    final class Video extends Database{
        use DataTraits;

        public function __construct()
        {
            parent::__construct();
            $this->table = 'videos';
        }
        public function getAllVideos($limit, $start = 0){
            $args = array(
                'where' => " status = 'active'",
                'order_by' => ' id DESC',
                'limit' => $start.' , '.$limit
            );
            return $this->select($args);
        }
        public function getVideoList(){
            $args = array(
                'where' => " status = 'active'",
                'order_by' => ' id DESC'
                
            );
            return $this->select($args);
        }

        
    }