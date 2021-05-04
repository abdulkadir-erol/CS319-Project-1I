<?php

//From https://www.php.net/manual/en/intro.pdo.php
//The PHP Data Objects (PDO) extension defines a lightweight,
//consistent interface for accessing databases in PHP.

class db {
    //Properties of database class
    //since we are using phpMyAdmin these are the default values for variables
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'peerreview';

    protected function connect()
    {
      //Setting up the connection to the database
      //DSN = data source name which consists of the info required to
      //connect to the database
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
      $pdo = new PDO($dsn, $this->user,$this->password);
      //Fetch objects as associative arrays
      $pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //  echo "connected successfully";
      return $pdo;
    }



}
