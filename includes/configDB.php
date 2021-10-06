<?php
namespace Includes;
use Exception;
use mysqli;
class ConfigDB{
    private $bd;

    function __construct(){
        $dir = __DIR__;

        $this->bd = [   'server'    => 'localhost',
                        'user'      => 'root',
                        //'pass'      => 'FelipeFLSolutions',
                        'pass'      => '',
                        'database'  => 'college_tool'
                    ];
    }
    public function executeQuery($query){
        $servername = $this->getDBServer();
        $user = $this->getDBUser();
        $pass = $this->getDBPass();
        $database = $this->getDBName();
        $conn = new mysqli($servername, $user, $pass, $database);
        if (mysqli_connect_errno()) throw new Exception(mysqli_connect_error());
        $conn->query("SET NAMES 'utf8'");
        $conn->query('SET character_set_connection=utf8');
        $conn->query('SET character_set_client=utf8');
        $conn->query('SET character_set_results=utf8');
        $result = $conn->query($query);
        if (is_bool($result)) {
            return ['error' => !$result, 'query' => $query, 'id' => $conn->insert_id, 'error_description' => $conn->error];
        } else {
            $response = [];
            while ($data = $result->fetch_assoc())
                array_push($response, $data);
            return $response;
        }
        mysqli_close($conn);
    }
    public function getDB(){
        return $this->bd;
    }
    public function getDBServer(){
        return $this->bd['server'];
    }
    public function getDBUser(){
        return $this->bd['user'];
    }
    public function getDBPass(){
        return $this->bd['pass'];
    }
    public function getDBName(){
        return $this->bd['database'];
    }
}
?>