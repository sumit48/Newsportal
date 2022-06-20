<?php 
    final class Gallery extends Database{
        use DataTraits;
        
        public function __construct()
        {
            parent::__construct();
            $this->table = "galleries";
        }
        public function getAllGallery($limit, $start = 0){
            $args = array(
                'where' => " status = 'active'",
                'order_by' => ' id DESC',
                'limit' => $start.' , '.$limit
            );
            return $this->select($args);
        }
        public function getGalleryList(){
            $args = array(
                'where' => " status = 'active'",
                'order_by' => ' id DESC'
                
            );
            return $this->select($args);
        }
    }