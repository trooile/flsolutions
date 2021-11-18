<?php
include_once __DIR__.'/../defaultModels.php';
class ToCards extends DefaultModels{
    public $table = 'cards';

    public function getLastValue($where = null){
        try {
    		$query = "SELECT MAX(cardscol) as maxid
                        FROM cards";
            if(!empty($where)){
                $query .= ' WHERE ' . $where;
            }
    		$response = $this->executeQuery($query);
            return $response;
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
}
?>  