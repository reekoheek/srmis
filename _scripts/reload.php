<?php

require_once 'config.php';

$DB_FILE = './_scripts/' . DB_NAME . '.sql';

$output = '';
$cmd = sprintf('mysqladmin -f -h"%s" -u"%s" -p"%s" drop "%s"', DB_HOST, DB_USER, DB_PASS, DB_NAME);
exec($cmd, $output);

$output = '';
$cmd = sprintf('mysqladmin -h"%s" -u"%s" -p"%s" create "%s"', DB_HOST, DB_USER, DB_PASS, DB_NAME);
exec($cmd, $output);

$output = '';
$cmd = sprintf('mysql -h"%s" -u"%s" -p"%s" "%s" < "%s"', DB_HOST, DB_USER, DB_PASS, DB_NAME, $DB_FILE);
exec($cmd, $output);