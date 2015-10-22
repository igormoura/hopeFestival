<?php

//$dadosConect = getDadosConnection();

$server="localhost";
$db="db_hope_festival";
$user="root";
$pass="PSN@4g3nc14#";
$version="0.9d";
//$pgport=5432;
$pchartfolder="./class/pchart2";


/*function getDadosConnection() {
    
    $ds = DIRECTORY_SEPARATOR;
    
    $projectDir = getProjectDir();
    
    $autoloadLocal = "{$projectDir}{$ds}config{$ds}autoload{$ds}local.php";
    $autoloadGlobal = "{$projectDir}{$ds}config{$ds}autoload{$ds}global.php";
    
    include_once $autoloadLocal;
    include_once $autoloadGlobal;
    
    $dbUser = $_POST['dados_db']['db']['username'];
    $dbPass = $_POST['dados_db']['db']['password'];

    $arrayDb = $_POST['dados_host']['db'];

    $arrayDns = explode(";", $arrayDb['dsn']);

    $arrayDbName = explode("=", $arrayDns[0]);
    $arrayHost = explode("=", $arrayDns[1]);

    $dbName = $arrayDbName[1];

    $host = $arrayHost[1];

    $conn = null;


    return array('host' => $host,
        'db_name' => $dbName,
        'db_user' => $dbUser,
        'db_pass' => $dbPass);
}

function getProjectDir() {

    $arrayPath = explode(DIRECTORY_SEPARATOR, __DIR__);

    $projectDir = false;
    foreach ($arrayPath as $key => $value) {

        if ($projectDir) {
            unset($arrayPath[$key]);
        }

        if ($value == 'psn') {
            $projectDir = true;
        }
    }


    $projectDir = implode(DIRECTORY_SEPARATOR, $arrayPath);

    return $projectDir;
}*/
