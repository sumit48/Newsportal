<?php
    trait DataTraits{
        final public function getRowById($id){
            $args = array(
                'where' => array(
                    'id' => $id
                )
            );
            return $this->select($args);
        }

        final public function selectAllrows(){
            if($_SESSION['role'] == 'admin'){
                $args = array(
                );
            } else {
                $args = array(
                    'where' => " created_by = ".$_SESSION['user_id']
                );
            }
            return $this->select($args);
        }

        final public function selectAllrowsByUser($user_id){
            if($_SESSION['role'] == 'admin'){
                $args = array(
                );
            } else {
                $args = array(
                    'where' => array(
                        'created_by' => $user_id
                    )
                );
    
            }
            return $this->select($args);
        }

        final public function deleteRowById($id){
            if($_SESSION['role'] == 'admin'){
                $args = array(
                    'where' => 'id = '.$id
                );
            } else {
                $args = array(
                    'where' => " created_by = ".$_SESSION['user_id']." AND id = ".$id
                );
    
            }
            return $this->delete($args);
        }

        final public function updateData($data, $row_id){
            // update table set column_name = :key, column_name = :key WHERE id = $row_id
            $args = array(
                'where' => array(
                    'id' => $row_id
                )
            );

            $status = $this->update($data, $args);
            if($status){
                return $row_id;
            } else {
                return false;
            }
        }

        public function insertData($data){
            return $this->insert($data);
        }

        final public function getAllRows(){
            return $this->select();
        }
    }