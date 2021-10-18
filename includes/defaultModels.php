<?php
class DefaultModels{
    public $table;
    public $masterMysqli;
    function __construct($masterMysqli){
        try {
           $this->masterMysqli = $masterMysqli;
	        if (mysqli_connect_errno()) throw new Exception(mysqli_connect_error());
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function executeQuery($query){
        try{
            array_push($GLOBALS['_DB_PROFILER'],$query);
            $response = [];
            $result = $this->masterMysqli->query($query);
            if(gettype($result) =='object'){
                while ($data = $result->fetch_assoc()){
                    array_push($response, $data);
                }
            }
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll($where = null){
        try{
            $query = "SELECT * FROM ".$this->table;
            if(!empty($force_index)){
                $query .= " FORCE INDEX($force_index)";
            }
            $where != '' ? $query .= ' WHERE '. $where : $query ;
            $response = $this->executeQuery($query);
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert($params){
        try{
            $query = $this->prepareInsert($params);
            $response = $this->executeQuery($query);
            return $this->getLastIdInserted();
        } catch (Exception $e) {
            throw $e;
        }
    }

    function prepareInsert($params){
        try{
            $params =  $this->prepareParams($params);
            $field = implode('`,`',array_keys($params));
            $values = implode(',',$params);
            return "INSERT INTO ".$this->table." (`".$field."`)"." VALUES (".$values.")";
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($params, $where = null){
        try{
            if(empty($where)){
                throw new Exception('UPDATE without WHERE in DB',-1);
            }
            $query =  $this->prepareUpdate($params, $where);
            $response = $this->executeQuery($query);
            return [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    function prepareUpdate($params,$where = null){
        try{
            $params =  $this->prepareParams($params);
            $arrayParams = [];
            foreach($params as $key=>$value){
                array_push($arrayParams,'`'.$key."` = ".$value);
            }
            if(!empty($where)){
                $where = " WHERE ".$where;
            }
            return "UPDATE ".$this->table." SET ".implode(',',$arrayParams).$where;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($where = null){                                              
        try{
            if(empty($where)){
                throw new Exception('DELETE without WHERE in DB',-1);
            }
            $query =  "DELETE FROM ".$this->table." WHERE ".$where;
            $response = $this->executeQuery($query);
            return [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    function prepareParams($params){
        try{            
            foreach($params as $key=>$value){
                if(is_object($value)){
                    $params[$key] = $value->getSql();
                }else{
                    if(is_null($value)){
                        $params[$key] = "null";
                    }else{
                        if (!is_numeric($value)){
                            $value = str_replace(['\r','\n'],PHP_EOL,$value);
                            $value = str_replace(['\\r','\\n'],PHP_EOL,$value);
                            $value = str_replace(['\\\r','\\\n'],PHP_EOL,$value);
                            $value = str_replace('\\','',$value);
                            $params[$key] = "'".$this->convertDate($this->masterMysqli->real_escape_string($value))."'"; 
                        }else{
                            $params[$key] = "'".$value."'"; 
                        }
                    }     
                }            
            }           
            return $params;
        } catch (Exception $e) { 
            throw $e;
        }
    }

    function convertDate($value){
        try{
            $dateParser = DateTime::createFromFormat("d/m/Y", $value);;
            if($dateParser){
                $value = $dateParser->format('Y-m-d'); 
            }
            return $value;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getLastIdInserted(){
        try{
            return $this->masterMysqli->insert_id;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

?>
