<?php 
    final class News extends Database{
        use DataTraits;

        public function __construct()
        {
            parent::__construct();
            $this->table = 'news';
        }

        public function getAllNews(){
            if($_SESSION['role'] == 'admin'){
                $args = array(
                );
            } else {
                $args = array(
                    'where' => " reporter_id = ".$_SESSION['user_id']." OR created_by = ".$_SESSION['user_id']
                );
    
            }
            return $this->select($args);
        }

        public function getNewsById($id){
            if($_SESSION['role'] == 'admin'){
                $args = array(
                    'where' => 'id = '.$id
                );
            } else {
                $args = array(
                    'where' => " (reporter_id = ".$_SESSION['user_id']." OR created_by = ".$_SESSION['user_id'].") AND id = ".$id
                );
    
            }
            return $this->select($args);
        }


        public function getFeaturedNews($limit, $start = 0){
            $args = array(
                'where' => " status = 'active' AND is_featured = 1",
                'order_by' => ' id DESC',
                'limit' => $start.' , '.$limit
            );
            return $this->select($args);
        }

        public function getNewsByCatId($cat_id, $start,$limit){
            $args = array(
                'where' => " status = 'active' AND cat_id = ".$cat_id,
                'order_by' => ' id DESC',
                'limit' => $start.' , '.$limit
            );
            return $this->select($args);
        }

        public function getStateWiseNews($state_name){
            $args = array(
                'where' => " status = 'active' AND state = '".$state_name."'",
                'order_by' => ' id DESC',
                'limit' => "0, 5"
            );
            return $this->select($args);
        }

        public function getTrendingNews(){
            $today = date("Y-m-d", strtotime(date("Y-m-d")." -3 days"));
            $args = array(
                // 'where' => " status = 'active' AND is_trending = 1",
                'where' => "status = 'active' AND DATE(created_at) >= '".$today."'",
                'order_by' => ' view_count DESC, id DESC',
                'limit' => "0, 5"
            );

            return $this->select($args);
        }

        public function getRelatedNews($cat_id, $current_id){
            $args = array(
                'where' => " status = 'active' AND cat_id = ".$cat_id." AND id != ".$current_id,
                'order_by' => ' id DESC',
                'limit' => '0 ,8 '
            );
            return $this->select($args);
        }

        public function getSearchResult($q){
            $args = array(
                'where' => " status = 'active' AND (title LIKE '%".$q."%' OR summary LIKE '%".$q."%' OR description LIKE '%".$q."%')",
                'order_by' => 'id DESC',
                'limit'=>"0,20"
            );

            return $this->select($args);
        }
        
    }