<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';

Class Controller extends DefaultControllers{

    function __construct(){
        try{
            parent::__construct();
            $this->toSchoolUnit = new ToSchoolUnit($this->masterMysqli);
        }catch(Exception $e){
            throw $e;
        }
    }

    public function submitNewUser($params){
        try{
            print_r($params);
            $this->return();
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>