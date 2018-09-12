<?php // function.php

// conexao com o DB
$dbhost = 'localhost'; 
$dbname = 'chatbase';
$dbuser = 'egonstep';
$dbpass = 'senha';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) 
    die("Fatal Error");

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Falta Error");
    return $result;
}
function destroySession()
{
    $_SESSION = array();
    if(session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-259200, '/');

    session_destroy();
}
function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
        $var = stripslashes($var);
    return $connection->real_escape_string($var);
}
function showProfile($user)
{
    if (file_exists("$user.jpg"))
        echo "<img src='img/$user.jpg' style='float:left;'>";

    if ($result->num_rows){
        $row = $result->Fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text'])."<br style='clearleft;'><br>";
    }
    else echo "<p>Nothing to see here, yet</p><br>";
}

?>