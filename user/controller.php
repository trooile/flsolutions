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
            $here = 'test';
            print_r($here);
            $this->return();
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>