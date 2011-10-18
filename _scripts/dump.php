<?php

require_once 'config.php';

function _clean_sql($dump_file) {
    copy($dump_file, $dump_file . '.backup-working-' . date('YmdHis'));

    @unlink($dump_file . '.1');
    $f = fopen($dump_file, 'r');
    $f1 = fopen($dump_file . '.1', 'w');

    while ($line = fgets($f)) {
        $line = str_replace('),(', "),\n(", $line);
        $line = str_replace('VALUES (', "VALUES\n(", $line);
        $line = preg_replace('/ AUTO_INCREMENT=(\d+)/e', '', $line);
//        $line = preg_replace('/\(\d+,/i', '(NULL,', $line);
//        $line = preg_replace("/'\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}'/i", 'NOW()', $line);
//        $line = preg_replace("/NOW\\(\\),'\\w+'/i", "NOW(),'sys'", $line);
        fputs($f1, $line, strlen($line));
    }

    fclose($f);
    fclose($f1);

    @unlink($dump_file);
    rename($dump_file . '.1', $dump_file);
    $whoami = str_replace(array('/', '\\'), '_', trim(exec('whoami')));
    copy($dump_file, $dump_file . '.backup-' . $whoami . '-' . date('YmdHis'));
}

$DB_FILE = './_scripts/' . DB_NAME . '.sql';

$cmd = 'mysqldump -u' . DB_USER . ' -p' . DB_PASS . ' -h' . DB_HOST . ' -P' . DB_PORT . ' ' . DB_NAME . ' > '.$DB_FILE;
$output = '';
exec($cmd, $output);
_clean_sql($DB_FILE);
