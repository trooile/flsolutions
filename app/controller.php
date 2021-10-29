<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';
include_once '../includes/models/toUsers.php';
include_once '../includes/models/toCourses.php';
include_once '../includes/models/toCards.php';
include_once '../includes/models/toUserXBoard.php';

Class Controller extends DefaultControllers{

    function __construct(){
        try{
            parent::__construct();
            $this->toSchoolUnit = new ToSchoolUnit($this->masterMysqli);
            $this->toUsers = new ToUsers($this->masterMysqli);
            $this->toCourses = new ToCourses($this->masterMysqli);
            $this->toCards = new ToCards($this->masterMysqli);
            $this->toUserXBoard = new ToUserXBoard($this->masterMysqli);
            $this->back = ['error'=> false, 'data'=> [], 'message'=>''];
        }catch(Exception $e){
            throw $e;
        }
    }

    public function saveCard($params){
        try{
            var_dump($params);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }
}
?>