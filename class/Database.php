<?php
abstract class Database
{
    protected $conn = null;
    protected $sql = null;
    protected $stmt = null;
    protected $table = null;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";", DB_USER, DB_PWD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->sql = "SET NAMES utf8";
            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            $msg = date("Y-m-d H:i:s") . ", Connection(PDO): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        } catch (Exception $e) {
            $msg = date("Y-m-d H:i:s") . ", Connection(General): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        }
    }

    final protected function select($args = array(), $is_debug=false){
        try{
            /**
             * SELECT fields FROM table
             * LEFT/RIGHT JOIN operation
             * WHERE clause
             * GROUP BY clause
             * ORDER BY clause
             * LIMIT start, count
             * 
             * SELECT * FROM users WHERE email = '".$email."'
             */

            $this->sql = "SELECT ";
            
            if(isset($args, $args['fields']) && !empty($args['fields'])){
                if(is_string($args['fields'])){
                    $this->sql .= $args['fields'];
                } else {
                    $this->sql .= implode(", ", $args['fields']);
                }
            } else {
                $this->sql .= " * ";
            }


            if(!$this->table){
                throw new Exception('Table not set');
            }
            $this->sql .= " FROM ".$this->table;

            // Join 

            // WHERE clause
            if(isset($args, $args['where']) && !empty($args['where'])){
                if(is_string($args['where'])){
                    $this->sql .= " WHERE ".$args['where'];
                } else {
                    $temp = array();
                    foreach($args['where'] as $column_name => $value){
                        $str = $column_name." = :".$column_name;
                        $temp[] = $str; 
                    }

                    $this->sql .= " WHERE ".implode(" AND ",$temp);
                }
            }

            if(isset($args['order_by']) && !empty($args['order_by'])){
                $this->sql .= " ORDER BY ".$args['order_by'];
            }


            if(isset($args['limit']) && !empty($args['limit'])){
                $this->sql .= " LIMIT ".$args['limit'];
            }
            

            if($is_debug){
                debug($args);
                debug($this->sql, true);
            }

            $this->stmt = $this->conn->prepare($this->sql);

            if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
                foreach($args['where'] as $column_name => $value){
                    if(is_int($value)){
                        $param = PDO::PARAM_INT;
                    } elseif(is_bool($value)){
                        $param = PDO::PARAM_BOOL;
                    } elseif(is_null($value)){
                        $param = PDO::PARAM_NULL;
                    } else {
                        $param = PDO::PARAM_STR;
                    }

                    if($param){
                        $this->stmt->bindValue(":".$column_name,$value,$param);
                    }
                }
            }

            $this->stmt->execute();
            $data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (PDOException $e) {
            $msg = date("Y-m-d H:i:s") . ", Select (PDO): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        } catch (Exception $e) {
            $msg = date("Y-m-d H:i:s") . ", Select (General): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        }
    }


    final protected function update($data= array(), $args = array(), $is_debug=false){
        try{
            /**
             * UPDATE table SET 
             * column_name_1 = :key_1,
             * column_name_2 = :key_2,
             * column_name_3 = :key_3
             * WHERE clause
             */

            $this->sql = "UPDATE ";

            if(!$this->table){
                throw new Exception('Table not set');
            }
            $this->sql .= $this->table." SET ";

            // data append
            if(isset($data) && !empty($data)){
                if(is_string($data)){
                    $this->sql .= $data;
                }else {
                    $temp = array();
                    foreach($data as $column_name => $value){
                        $str = $column_name." = :_".$column_name;
                        $temp[] = $str; 
                    }

                    $this->sql .= implode(" , ",$temp);
                }
            } else{
                throw new Exception('Data not set');
            }



            // WHERE clause
            if(isset($args, $args['where']) && !empty($args['where'])){
                if(is_string($args['where'])){
                    $this->sql .= " WHERE ".$args['where'];
                } else {
                    $temp = array();
                    foreach($args['where'] as $column_name => $value){
                        $str = $column_name." = :".$column_name;
                        $temp[] = $str; 
                    }

                    $this->sql .= " WHERE ".implode(" AND ",$temp);
                }
            }

            if($is_debug){
                debug($args);
                debug($this->sql, true);
            }

            $this->stmt = $this->conn->prepare($this->sql);
            if(isset($data) && !empty($data) && is_array($data)){
                foreach($data as $column_name => $value){
                    if(is_int($value)){
                        $param = PDO::PARAM_INT;
                    } elseif(is_bool($value)){
                        $param = PDO::PARAM_BOOL;
                    } elseif(is_null($value)){
                        $param = PDO::PARAM_NULL;
                    } else {
                        $param = PDO::PARAM_STR;
                    }

                    if($param){
                        $this->stmt->bindValue(":_".$column_name,$value,$param);
                    }
                }
            }



            if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
                foreach($args['where'] as $column_name => $value){
                    if(is_int($value)){
                        $param = PDO::PARAM_INT;
                    } elseif(is_bool($value)){
                        $param = PDO::PARAM_BOOL;
                    } elseif(is_null($value)){
                        $param = PDO::PARAM_NULL;
                    } else {
                        $param = PDO::PARAM_STR;
                    }

                    if($param){
                        $this->stmt->bindValue(":".$column_name,$value,$param);
                    }
                }
            }

            return $this->stmt->execute();

        } catch (PDOException $e) {
            $msg = date("Y-m-d H:i:s") . ", UPDATE (PDO): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        } catch (Exception $e) {
            $msg = date("Y-m-d H:i:s") . ", UPDATE (General): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        }
    }



    final protected function insert($data= array(),$is_debug=false){
        try{
            /**
             * INSERT INTO table SET 
             * column_name_1 = :key_1,
             * column_name_2 = :key_2,
             * column_name_3 = :key_3
             */

            $this->sql = "INSERT INTO ";

            if(!$this->table){
                throw new Exception('Table not set');
            }
            $this->sql .= $this->table." SET ";

            // data append
            if(isset($data) && !empty($data)){
                if(is_string($data)){
                    $this->sql .= $data;
                }else {
                    $temp = array();
                    foreach($data as $column_name => $value){
                        $str = $column_name." = :_".$column_name;
                        $temp[] = $str; 
                    }

                    $this->sql .= implode(" , ",$temp);
                }
            } else{
                throw new Exception('Data not set');
            }


            if($is_debug){
                debug($this->sql, true);
            }

            $this->stmt = $this->conn->prepare($this->sql);
            if(isset($data) && !empty($data) && is_array($data)){
                foreach($data as $column_name => $value){
                    if(is_int($value)){
                        $param = PDO::PARAM_INT;
                    } elseif(is_bool($value)){
                        $param = PDO::PARAM_BOOL;
                    } elseif(is_null($value)){
                        $param = PDO::PARAM_NULL;
                    } else {
                        $param = PDO::PARAM_STR;
                    }

                    if($param){
                        $this->stmt->bindValue(":_".$column_name,$value,$param);
                    }
                }
            }


            $this->stmt->execute();
            return $this->conn->lastInsertId();

        } catch (PDOException $e) {
            $msg = date("Y-m-d H:i:s") . ", Insert (PDO): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        } catch (Exception $e) {
            $msg = date("Y-m-d H:i:s") . ", Insert (General): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        }
    }

    final protected function delete($args = array(), $is_debug=false){
        try{
            /**
             * DELETE FROM table
             * WHERE clause
             */

            $this->sql = "DELETE ";
            
            if(!$this->table){
                throw new Exception('Table not set');
            }
            $this->sql .= " FROM ".$this->table;


            // WHERE clause
            if(isset($args, $args['where']) && !empty($args['where'])){
                if(is_string($args['where'])){
                    $this->sql .= " WHERE ".$args['where'];
                } else {
                    $temp = array();
                    foreach($args['where'] as $column_name => $value){
                        $str = $column_name." = :".$column_name;
                        $temp[] = $str; 
                    }

                    $this->sql .= " WHERE ".implode(" AND ",$temp);
                }
            }

            if($is_debug){
                debug($args);
                debug($this->sql, true);
            }

            $this->stmt = $this->conn->prepare($this->sql);

            if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
                foreach($args['where'] as $column_name => $value){
                    if(is_int($value)){
                        $param = PDO::PARAM_INT;
                    } elseif(is_bool($value)){
                        $param = PDO::PARAM_BOOL;
                    } elseif(is_null($value)){
                        $param = PDO::PARAM_NULL;
                    } else {
                        $param = PDO::PARAM_STR;
                    }

                    if($param){
                        $this->stmt->bindValue(":".$column_name,$value,$param);
                    }
                }
            }

            return $this->stmt->execute();

        } catch (PDOException $e) {
            $msg = date("Y-m-d H:i:s") . ", Delete (PDO): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        } catch (Exception $e) {
            $msg = date("Y-m-d H:i:s") . ", Delete (General): " . $e->getMessage() . "\r\n";
            error_log($msg, 3, ERROR_LOG);
        }
    }
}
