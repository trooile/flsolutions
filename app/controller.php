<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';
include_once '../includes/models/toUsers.php';
include_once '../includes/models/toCourses.php';
include_once '../includes/models/toCards.php';
include_once '../includes/models/toUserXBoard.php';
include_once '../includes/models/toAppBoard.php';
include '../includes/email.php';

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
            $data = [   'id_app_board'  => $params['card'][0]['value'],
                        'id_courses'    => $params['card'][1]['value'] != '' ? $params['card'][0]['value']:86,
                        'cardscol'      => $params['card'][0]['value'],
                        'name'          => $params['card'][3]['value'],
                        'semester'      => $params['card'][2]['value'],
                        'description'   => $params['card'][4]['value'],
                        'position'      => 'red',
                        'priority'      => 0];
                        $add = $this->toCards->insert($data);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }

    public function updatePosition($params){
        try{
            $this->toCards->update(['position' => $params['position']], 'id_cards='.$params['id_cards']);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }

    public function searchCards($params){
        try{
            $cards = $this->toCards->getAll('id_app_board ='.$params['id_app_board']);
            $this->back['data'] = $cards;
            $this->return();
        }catch(Exception $e){
            $this->return();
        }
    }

    public function searchCard($params){
        try{
            $card = $this->toCards->getAll('id_cards ='.$params['id_cards'])[0];
            $this->back['data'] = $card;
            $this->return();
        }catch(Exception $e){
            $this->return();
        }
    }

    public function deleteCard($params){
        try{
            $this->toCards->delete('id_cards ='.$params['id_cards']);
            $this->return();
        }catch(Exception $e){
            $this->return();
        }
    }


    public function addBoard($params){
        try{
            if($params['formdata'][2]['value'] != ''){
                $id_app_board = $params['formdata'][2]['value'];
                $data = [   'id_school_unit'    => $params['formdata'][0]['value'],
                            'name'              => $params['formdata'][1]['value']];
                    $this->toAppBoard->update($data, 'id_app_board ='.$id_app_board);
                    unset($params['formdata'][0]);
                    unset($params['formdata'][1]);
                    unset($params['formdata'][2]);
                    $this->toUserXBoard->delete('id_app_board ='.$id_app_board);
                    foreach($params['formdata'] as $value){
                        $dataUsers = [  'id_app_board'  => $id_app_board,
                                        'id_users'      => $value['value']
                                    ];
                        $this->toUserXBoard->insert($dataUsers);
                    }
            }else{
                if($params['formdata'][1]['value'] != ''){
                    $data = [   'id_school_unit'    => $params['formdata'][0]['value'],
                                'name'              => $params['formdata'][1]['value']];
                    $id_app_board = $this->toAppBoard->insert($data);
                    unset($params['formdata'][0]);
                    unset($params['formdata'][1]);
                    unset($params['formdata'][2]);
                    foreach($params['formdata'] as $value){
                        $dataUsers = [  'id_app_board'  => $id_app_board,
                                        'id_users'      => $value['value']
                                    ];
                        $this->toUserXBoard->insert($dataUsers);
                    }
                }else{
                    $this->back['error'] = true;
                    $this->back['message'] = 'Name';
                }
            }
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }

    public function searchBoard($params){
        try{
            $this->back['data']['board'] = $this->toAppBoard->getAll('id_app_board ='.$params['id_app_board'])[0];
            $this->back['data']['users']  = $this->toUserXBoard->getAll('id_app_board ='.$params['id_app_board']);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }
}
?>