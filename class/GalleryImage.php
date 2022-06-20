<?php

    final class GalleryImage extends Database{
        use DataTraits;
        public function __construct()
        {
            parent::__construct();
            $this->table = "gallery_images";
        }

        public function getAllImageByGalleryId($gallery_id){
            $args = array(
                'where' => array(
                    'gallery_id' => $gallery_id
                )
            );
            return $this->select($args);
        }

        public function deleteImageByName($del_image_name){
            $args = array(
                'where' => array(
                    'image_name' => $del_image_name
                )
            );
            return $this->delete($args);
        }
    }