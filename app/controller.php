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
            $data = [   'id_app_board' => 1,
                        'id_courses' => $params['card']['course'] != '' ? $params['card']['course']:0,
                        'cardscol' => $params['card']['newCard']['id'],
                        'name' => $params['card']['newCard']['title'],
                        'semester' => $params['card']['semester'],
                        'description' => $params['card']['newCard']['description'],
                        'position' => $params['card']['newCard']['position'],
                        'priority' => $params['card']['newCard']['priority']];
                        $this->toCards->insert($data);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }

    public function searchCards($params){
        try{
            $card = [];
            $cards = $this->toCards->getAll();
            foreach($cards as $value){
                $card [] = ['description' => $value['description'],
                            'id' => $value['cardscol'],
                            'position' => $value['position'],
                            'priority' => $value['priority'],
                            'title' => $value['name']];
            }
            $this->back['data']['cards'] = $card;
            $this->back['data']['config'] = $this->toCards->getLastValue()[0];
            $this->return();
        }catch(Exception $e){
            $this->return();
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