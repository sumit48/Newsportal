<?php 
    final class Advertisement extends Database{
        use DataTraits;
        public function __construct()
        {
            parent::__construct();
            $this->table = "advertisements";
        }

        public function getAdsByPosition($position){
            // select * from advertisements 
                // WHERE position = $position AND 
                // DATE(start_date) <= 'date('Y-m-d')' AND 
                // end_date >= 'date('Y-m-d')' AND 
                // status = 'active' 
                // ORDER BY id 
                //  LIMIT 0,1
            $args = array(
                'where' => " position = '".$position."' AND status = 'active'",
                'order_by' => 'id DESC',
                'limit' => '0,1',
                // 'where' => " position = '".$position."' AND status = 'active' AND DATE(start_date) <= '".date('Y-m-d')."' AND  DATE(end_date) >= '".date('Y-m-d')."'"
                // 
            );
            return $this->select($args);
         }
    }