<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';
include_once '../includes/models/toUsers.php';

Class Controller extends DefaultControllers{

    function __construct(){
        try{
            parent::__construct();
            $this->toSchoolUnit = new ToSchoolUnit($this->masterMysqli);
            $this->toUsers = new ToUsers($this->masterMysqli);
        }catch(Exception $e){
            throw $e;
        }
    }

    public function submitNewUser($params){
        try{
            $passwd = $this->encrypt($params['passwd']);
            $params['id_school_unit'] = $params['unit'];
            unset($params['unit']);
            unset($params['confirmpasswd']);
            unset($params['passwd']);
            $params['passwd'] = $passwd;
            $this->toUsers->insert($params);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }
}
?>