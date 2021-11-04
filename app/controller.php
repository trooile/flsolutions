<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';
include_once '../includes/models/toUsers.php';
include_once '../includes/models/toCourses.php';
include_once '../includes/models/toCards.php';
include_once '../includes/models/toUserXBoard.php';
include_once '../includes/models/toAppBoard.php';

Class Controller extends DefaultControllers{

    function __construct(){
        try{
            parent::__construct();
            $this->toSchoolUnit = new ToSchoolUnit($this->masterMysqli);
            $this->toUsers = new ToUsers($this->masterMysqli);
            $this->toCourses = new ToCourses($this->masterMysqli);
            $this->toCards = new ToCards($this->masterMysqli);
            $this->toUserXBoard = new ToUserXBoard($this->masterMysqli);
            $this->toAppBoard = new ToAppBoard($this->masterMysqli);
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

    public function addBoard($params){
        try{
            if($params['formdata'][1]['value'] != ''){
                $data = [   'id_school_unit' => $params['formdata'][0]['value'],
                            'name' => $params['formdata'][1]['value']];
                $this->toAppBoard->insert($data);
            }else{
                $this->back['error'] = true;
                $this->back['message'] = 'Name';
            }
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }
}
?>