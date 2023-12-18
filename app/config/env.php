<?php

$_ENV['APP_ENV'] = 'development';
$_ENV["DEBUG"] = false;
// Database configuration for MySQL
$_ENV['DB_TYPE'] = 'mysql';
$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_NAME'] = 'mydatabase';
$_ENV['DB_USERNAME'] = 'root';
$_ENV['DB_PASSWORD'] = 'root';
$_ENV['DB_CHARSET'] = 'utf8';

// Uncomment the following lines when using PostgreSQL
/*
$_ENV['DB_TYPE'] = 'pgsql';
$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_NAME'] = 'mydatabase';
$_ENV['DB_USERNAME'] = 'postgres';
$_ENV['DB_PASSWORD'] = 'postgres';
$_ENV['DB_CHARSET'] = 'utf8';
*/
