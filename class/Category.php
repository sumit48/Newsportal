<?php 
    final class Category extends Database{
        use DataTraits;

        public function __construct()
        {
            parent::__construct();
            $this->table = 'categories';
        }


        public function getMenuItems(){
            $args = array(
                'where' => "status = 'active'",
                'order_by' => 'id ASC'
            );

            return $this->select($args);
        }

        
    }