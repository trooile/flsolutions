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
            $name = $_POST['name'];
            $mail = $_POST['email'];
            $passwd = $this->encrypt($_POST['passwd']);
            $confirmpasswd = $this->encrypt($_POST['confirmpasswd']);
            
            $unit = $_POST['unit'];
            $data = [   'id_school_unit'    => $unit,
                        'name'              => $name,
                        'email'             => $mail,
                        'passwd'            => $passwd];
            $this->toUsers->insert($data);
            $this->return();
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>