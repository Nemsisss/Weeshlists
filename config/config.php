<?php

// define('DB_HOST', '303.itpwebdev.com');
// define('DB_USER', 'nemsisss_db_user');
// define('DB_PASS', 'uscitp2022');
// define('DB_NAME', 'nemsisss_wishlists_db');
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
define('DB_HOST', $cleardb_url['host']);
define('DB_USER', $cleardb_url['user']);
define('DB_PASS', $cleardb_url['pass']);
define('DB_NAME', substr($cleardb_url['path'],1));
session_start();

?>