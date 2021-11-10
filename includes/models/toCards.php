<?php
include_once __DIR__.'/../defaultModels.php';
class ToCards extends DefaultModels{
    public $table = 'cards';

    public function getLastValue(){
        try {
    		$query = "SELECT MAX(cardscol) as maxid
                        FROM cards";
    		$response = $this->executeQuery($query);
            return $response;
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
}
?>  