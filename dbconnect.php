<?php

require_once 'env.php';
ini_set('display_errors', true); //display_errorsオプションをtrueに設定し、エラーメッセージを表示するように変更する

function connect() {
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            //エラーを返す
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            //配列をキーとバリューで返す
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        echo '接続失敗です' . $e->getMessage();
        exit();
    }
}