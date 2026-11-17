<?php
$_DB['server'] = '127.0.0.1';
$_DB['user'] = 'root';
$_DB['password'] = 'VPzinmdm@000';
$_DB['database'] = 'db_kidsmap';
$_DB['port'] = 3307;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
$mysqli = new mysqli($_DB['server'], $_DB['user'], $_DB['password'], $_DB['database']);
$mysqli->set_charset("utf8mb4");
} catch (Exception $e) {
error_log($e->getMessage());
exit('Alguma coisa estranha aconteceu...');
}
?>