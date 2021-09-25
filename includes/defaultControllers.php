<?php
include_once __DIR__.'/configDB.php';
include_once __DIR__.'/mySQL.php';
Class DefaultControllers{
    public $masterMysqli;
    function __construct(){
        try{
            global $_DB_PROFILER;
            $_DB_PROFILER = [];
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $config = new Includes\ConfigDB();
            $this->masterMysqli = new mysqli($config->getDBServer(),$config->getDBUser(),$config->getDBPass(),$config->getDBName());
            $this->masterMysqli->set_charset("utf8");
	        if (mysqli_connect_errno()) throw new Exception(mysqli_connect_error());
        }catch(Exception $e){
            throw $e;
        }
    }
    public function randomString($qtd = 12) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = []; 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < $quantidade_caracteres; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); 
    }
}
?>
