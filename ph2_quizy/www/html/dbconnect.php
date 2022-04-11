<?php

$dsn = 'mysql:dbname=quizy;charset=utf8;host=db';
$user = 'sachi';
$password = 'password';

try {

    // PDOStatementクラスのインスタンスを生成します。
    $pdo = new PDO(
        $dsn,
        $user,
        $password,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // PDO::FETCH_ASSOCは、対応するカラム名にふられているものと同じキーを付けた 連想配列として取得します。
            // (PDO::FETCH_ASSOC);
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );

    echo "接続成功";

    // $sql = 'SELECT * FROM big_questions';

    // PDOStatementクラスのインスタンスを生成します。
    // $prepare = $dbh->prepare($sql);

    // プリペアドステートメントを実行する
    // $prepare->execute();
    
    // $result = $prepare->fetchAll();
    // PDO::FETCH_ASSOCは、対応するカラム名にふられているものと同じキーを付けた 連想配列として取得します。
    // (PDO::FETCH_ASSOC);
    
    // 結果を出力
    // print_r($result);

} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}