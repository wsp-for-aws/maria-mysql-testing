<?php

function returnEnv($name, $default) {
    $res = getenv($name);
    return( $res === false ? $default : $res );
}
?>

<h1>WSP AWS testing image</h1>
<h1>Test RDS feature:</h1>
<h2>Default RDS environments:</h2>

<ul>
    <li>DB_CONNECTION: <?php echo(returnEnv('DB_CONNECTION', 'absent')) ?></li>
    <li>DB_HOST: <?php echo(returnEnv('DB_HOST', 'absent')) ?></li>
    <li>DB_PORT: <?php echo(returnEnv('DB_PORT', 'absent')) ?></li>
    <li>DB_NAME: <?php echo(returnEnv('DB_NAME', 'absent')) ?></li>
    <li>DB_USER: <?php echo(returnEnv('DB_USER', 'absent')) ?></li>
    <li>DB_PASSWORD: <?php echo(returnEnv('DB_PASSWORD', 'absent')) ?></li>
</ul>

<h2>Try to print DB list using RDS environments to connect to a database server:</h2>
<?php

$dsn = 'mysql:dbname=mysql;host=' . returnEnv('DB_HOST', '');
$user = returnEnv('DB_USER', '');
$password = returnEnv('DB_PASSWORD', '');


try {
    $dbh = new PDO($dsn, $user, $password);
    foreach($dbh->query('show databases') as $row) {
        print_r($row);
        echo '<br>';
    }
} catch (PDOException $e) {
    print "Error!: <br/>" . $e->getMessage() . "<br/>";
    die();
}

?>

<h2>All environment variables:</h2>
<?php
while (list($var,$value) = each ($_ENV)) {
    echo "$var => $value <br />";
}