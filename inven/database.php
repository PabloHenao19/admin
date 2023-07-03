<?php

function connectToDatabase() {
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'php_login_database';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    return $conn;
  } catch (PDOException $e) {
    die('ERROR DE CONEXIÓN: ' . $e->getMessage());
  }
}

?>


