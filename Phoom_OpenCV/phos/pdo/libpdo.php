<?php

function var_src($b)
{
    return preg_replace("/\\s+/", " ", var_export($b, true)) . "\n";
}
function fgl_g()
{
    global $S;
    $S[] = preg_grep(array_pop($S), array_pop($S));
}

function fgl_insert()
{

// fgl_insert_localhost();
fgl_insert_epizy();

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
    $dbhost = "localhost";
//    $dbname = array_pop($S);
//    $dbusername = "root";
//    $dbpassword = "0000";
    
    // epizy
    $dbname = "epiz_22297078_db1";
    $dbusername = "epiz_22297078";
    $dbpassword = "gruui5gl";
        
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
