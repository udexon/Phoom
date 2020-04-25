<?php

function var_src($b)
{
//    return preg_replace("/\\s+/", " ", var_export($b, true)) . "\n";
    return preg_replace("/\\s+/", " ", var_export($b, true)) . " ";
}
function fgl_g()
{
    fgl_glm();
//    fgl_grep();
}

/*
function fgl_grep()
{
    global $S;
    $S[] = preg_grep(array_pop($S), array_pop($S));
}
*/

function fgl_glm() // preg_grep customized low memory?  OR | pattern does not work!!
{
    global $S;
    $M=array();
    $a=array_pop($S); // keyword regular expression
    $L=strlen($a);
    $a=substr($a,1,$L-2);
    $b=array_pop($S); // array
    
    foreach($b as $bk => $be) {
        if (strpos($be, $a)!==false) $M += [ $bk => $be ];
        // $M[]=array($bk => $be);
        // $data += [ "two" => 2 ];
    
    }

//    $S[] = preg_grep(array_pop($S), array_pop($S));
    $S[]=$M;


}



function fgl_insert()
{

fgl_insert_localhost();
// fgl_insert_epizy();

}

function fgl_insert_epizy()
{
    global $S;
    $a = array_pop($S);
    $t = array_pop($S);
    $ak = array_keys($a);
    $n = count($a);
    $s = "(" . $ak[0];
    $sv = "(?";
    if ($n > 1) {
        $i = 1;
        while ($i < $n) {
            $s = $s . ", " . $ak[$i++];
            $sv = $sv . ",?";
        }
    }
    $s = $s . ")";
    $sv = $sv . ")";
    $v = array();
    foreach ($a as $k => $e) {
        $v[] = $e;
    }
    echo var_src($ak) . " " . $s . " " . $sv . " " . var_src($v) . " ";
    // $dbhost = "localhost";
//    $dbname = array_pop($S);
//    $dbusername = "root";
//    $dbpassword = "0000";
    
    // epizy
    $dbhost = "sql306.epizy.com";
    $dbname = "epiz_22297078_db1";
    $dbusername = "epiz_22297078";
    $dbpassword = "gruui5gl";
    
     $S[]=array($dbhost, $dbname, $dbusername, $dbpassword, $a, $t);
    
   //  /*    
    $link = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbusername, $dbpassword);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $link->prepare("INSERT INTO {$t} {$s}\n        VALUES {$sv}");
    $statement->execute($v);
     

}

function fgl_insert_localhost()
{
    global $S;
    $a = array_pop($S);
    $t = array_pop($S);
    $ak = array_keys($a);
    $n = count($a);
    $s = "(" . $ak[0];
    $sv = "(?";
    if ($n > 1) {
        $i = 1;
        while ($i < $n) {
            $s = $s . ", " . $ak[$i++];
            $sv = $sv . ",?";
        }
    }
    $s = $s . ")";
    $sv = $sv . ")";
    $v = array();
    foreach ($a as $k => $e) {
        $v[] = $e;
    }
    echo var_src($ak) . " " . $s . " " . $sv . " " . var_src($v) . " ";
    $dbhost = "localhost";
    $dbname = array_pop($S);
    $dbusername = "root";
    $dbpassword = "0000";
    
    // epizy
//    $dbname = "epiz_22297078_db1";
//    $dbusername = "epiz_22297078";
//    $dbpassword = "gruui5gl";
        
    $link = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbusername, $dbpassword);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $link->prepare("INSERT INTO {$t} {$s}\n        VALUES {$sv}");
    $statement->execute($v);
}

function fgl_select_0()
{
    global $S;
    // $a = array_pop($S);
    $t = array_pop($S);
    
    /*
    $ak = array_keys($a);
    $n = count($a);
    $s = "(" . $ak[0];
    $sv = "(?";
    if ($n > 1) {
        $i = 1;
        while ($i < $n) {
            $s = $s . ", " . $ak[$i++];
            $sv = $sv . ",?";
        }
    }
    $s = $s . ")";
    $sv = $sv . ")";
    $v = array();
    foreach ($a as $k => $e) {
        $v[] = $e;
    }
    echo var_src($ak) . " " . $s . " " . $sv . " " . var_src($v) . " ";
    */
    
    $dbhost = "localhost";
    $dbname = array_pop($S);
    $dbusername = "root";
    $dbpassword = "0000";
    
    // epizy
//    $dbname = "epiz_22297078_db1";
//    $dbusername = "epiz_22297078";
//    $dbpassword = "gruui5gl";
        
    $link = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbusername, $dbpassword);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $statement = $link->prepare("INSERT INTO {$t} {$s}\n        VALUES {$sv}");
    $statement = $link->prepare("SELECT * FROM {$t}");
    $statement->execute($v);
}

function fgl_describe()
{
    global $S;
    //Our MySQL connection details.
    define('MYSQL_SERVER', 'localhost');
    define('MYSQL_DATABASE_NAME', array_pop($S));
    define('MYSQL_USERNAME', 'root');
    define('MYSQL_PASSWORD', '0000');
    //Instantiate the PDO object and connect to MySQL.
    $pdo = new PDO('mysql:host=' . MYSQL_SERVER . ';dbname=' . MYSQL_DATABASE_NAME, MYSQL_USERNAME, MYSQL_PASSWORD);
    //The name of the table that we want the structure of.
    $tableToDescribe = array_pop($S);
    //Query MySQL with the PDO objecy.
    //The SQL statement is: DESCRIBE [INSERT TABLE NAME]
    $statement = $pdo->query('DESCRIBE ' . $tableToDescribe);
    //Fetch our result.
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //The result should be an array of arrays,
    //with each array containing information about the columns
    //that the table has.
    //var_dump($result);
    $S[] = var_src($result);
    //For the sake of this tutorial, I will loop through the result
    //and print out the column names and their types.
    foreach ($result as $column) {
        echo $column['Field'] . ' - ' . $column['Type'], '<br>';
    }
}

function fgl_select()
{
    fgl_select_localhost();
//    fgl_select_epizy();
}


function fgl_select_opt()
{
    global $S;
    //Our MySQL connection details.
    // $tableToDescribe = array_pop($S);
    
    $O = array_pop( $S );
    
    
    
    $tableToDescribe = $O['t'];
    
    define('MYSQL_SERVER', 'localhost');
    // define('MYSQL_DATABASE_NAME', array_pop($S));
    define('MYSQL_DATABASE_NAME', $O['d']);
    define('MYSQL_USERNAME', 'root');
    define('MYSQL_PASSWORD', '0000');
    //Instantiate the PDO object and connect to MySQL.
    $pdo = new PDO('mysql:host=' . MYSQL_SERVER . ';dbname=' . MYSQL_DATABASE_NAME, MYSQL_USERNAME, MYSQL_PASSWORD);
    //The name of the table that we want the structure of.

    //Query MySQL with the PDO objecy.
    //The SQL statement is: DESCRIBE [INSERT TABLE NAME]
    // $statement = $pdo->query('DESCRIBE ' . $tableToDescribe);
    // $statement = $pdo->query('SELECT * FROM ' . $tableToDescribe . ' LIMIT 2');
    
    if ( !isset( $O['w'] ) ) $O['w']='';
    if ( !isset( $O['o'] ) ) $O['o']='';
    if ( !isset( $O['l'] ) ) $O['l']='';
    
    if ( isset($_GET['l']) ) $O['l']='LIMIT '.$_GET['l'];
    if ( isset($_GET['l']) ) $O['o']='order by `'.$_GET['o'].'` desc ';    

    echo var_src($O)."<br><br>";
        
    $statement = $pdo->query('SELECT * FROM ' . $tableToDescribe . ' ' . $O['w'] . ' ' . $O['o'] . ' ' . $O['l'] );
    
    //Fetch our result.
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //The result should be an array of arrays,
    //with each array containing information about the columns
    //that the table has.
    //var_dump($result);
    // $S[] = var_src($result);
    $S[] = ($result);
    //For the sake of this tutorial, I will loop through the result
    //and print out the column names and their types.
    if (0) foreach ($result as $column) {
        echo $column['Field'] . ' - ' . $column['Type'], '<br>';
    }
}


function fgl_select_localhost()
{
    global $S;
    //Our MySQL connection details.
    $tableToDescribe = array_pop($S);
    define('MYSQL_SERVER', 'localhost');
    define('MYSQL_DATABASE_NAME', array_pop($S));
    define('MYSQL_USERNAME', 'root');
    define('MYSQL_PASSWORD', '0000');
    //Instantiate the PDO object and connect to MySQL.
    $pdo = new PDO('mysql:host=' . MYSQL_SERVER . ';dbname=' . MYSQL_DATABASE_NAME, MYSQL_USERNAME, MYSQL_PASSWORD);
    //The name of the table that we want the structure of.

    //Query MySQL with the PDO objecy.
    //The SQL statement is: DESCRIBE [INSERT TABLE NAME]
    // $statement = $pdo->query('DESCRIBE ' . $tableToDescribe);
    $statement = $pdo->query('SELECT * FROM ' . $tableToDescribe . ' LIMIT 2');
    //Fetch our result.
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //The result should be an array of arrays,
    //with each array containing information about the columns
    //that the table has.
    //var_dump($result);
    // $S[] = var_src($result);
    $S[] = ($result);
    //For the sake of this tutorial, I will loop through the result
    //and print out the column names and their types.
    if (0) foreach ($result as $column) {
        echo $column['Field'] . ' - ' . $column['Type'], '<br>';
    }
}

function fgl_select_epizy()
{
    global $S;
    //Our MySQL connection details.
    $tableToDescribe = array_pop($S);
    
    $dbhost = "sql306.epizy.com";
    $dbname = "epiz_22297078_db1";
    $dbusername = "epiz_22297078";
    $dbpassword = "gruui5gl";

    /*
    define('MYSQL_SERVER', 'localhost');
    define('MYSQL_DATABASE_NAME', array_pop($S));
    define('MYSQL_USERNAME', 'root');
    define('MYSQL_PASSWORD', '0000');
    */
    
    define('MYSQL_SERVER', $dbhost);  // $dbhost   = "sql306.epizy.com";
    define('MYSQL_DATABASE_NAME', $dbname); // $dbname = "epiz_22297078_db1";
    define('MYSQL_USERNAME', $dbusername);   //  $dbusername = "epiz_22297078";
    define('MYSQL_PASSWORD', $dbpassword); //     $dbpassword = "gruui5gl";
    
    //Instantiate the PDO object and connect to MySQL.
    $pdo = new PDO('mysql:host=' . MYSQL_SERVER . ';dbname=' . MYSQL_DATABASE_NAME, MYSQL_USERNAME, MYSQL_PASSWORD);
    //The name of the table that we want the structure of.

    //Query MySQL with the PDO objecy.
    //The SQL statement is: DESCRIBE [INSERT TABLE NAME]
    // $statement = $pdo->query('DESCRIBE ' . $tableToDescribe);
    $statement = $pdo->query('SELECT * FROM ' . $tableToDescribe . ' LIMIT 2');
    //Fetch our result.
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //The result should be an array of arrays,
    //with each array containing information about the columns
    //that the table has.
    //var_dump($result);
    // $S[] = var_src($result);
    $S[] = ($result);
    //For the sake of this tutorial, I will loop through the result
    //and print out the column names and their types.
    if (0) foreach ($result as $column) {
        echo $column['Field'] . ' - ' . $column['Type'], '<br>';
    }
}



function fgl_table() // html table
{
    global $S;
    $s=array_pop($S); if ($s==NULL) $s='NULL';

    if (isset($D)) echo " td :".$s.": ";

    $S[]="<table>".$s."</table>";

}

function fgl_body() // html body
{
    global $S;
    $s=array_pop($S); if ($s==NULL) $s='NULL';

    if (isset($D)) echo " td :".$s.": ";

    $S[]="<body>".$s."</body>";

}


function fgl_html() // html
{
    global $S;
    $s=array_pop($S); if ($s==NULL) $s='NULL';

    if (isset($D)) echo " td :".$s.": ";

    $S[]="<html>".$s."</html>";

}


function fgl_td() // html td
{
global $S;
$s=array_pop($S); if ($s==NULL) $s='NULL';

if (isset($D)) echo " td :".$s.": ";

$S[]="<td>".$s."</td>";
// $S[]="<td>".array_pop($S)."</td>";

// fgl_s();

}


function fgl_array()
{
    global $S;
    $S[] = array();
}
function fgl_createdb()
{
    global $S;
    $host = "localhost";
    $root = "root";
    $root_password = "0000";
    $user = 'newuser';
    $pass = 'newpass';
    $db = "newdb";
    try {
        $dbh = new PDO("mysql:host={$host}", $root, $root_password);
        $dbh->exec("CREATE DATABASE `{$db}`;\n                CREATE USER '{$user}'@'localhost' IDENTIFIED BY '{$pass}';\n                GRANT ALL ON `{$db}`.* TO '{$user}'@'localhost';\n                FLUSH PRIVILEGES;") or die(print_r($dbh->errorInfo(), true));
    } catch (PDOException $e) {
        die("DB ERROR: " . $e->getMessage());
    }
}
