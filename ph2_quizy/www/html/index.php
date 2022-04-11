<?php
// phpinfo();
require('dbconnect.php');

$sql = 'SELECT * FROM `big_questions`';

// PDOクラスのprepareメソッドを実行していて、その結果を$stmtに代入しています。
$stmt = $pdo->prepare($sql);
// $pdo->prepare()が成功した場合、PDOStatementオブジェクト（=PDOStatementクラスをインスタンス化したもの）を返してくれる

// プリペアドステートメントを実行する
$stmt->execute();

$results = $stmt->fetchAll();

// 結果を出力 print_r($results);
// $stmt = $pdo->query('SELECT * FROM big_questions');
?>

<?php foreach ($results as $result) : ?>
    <p>
        <a href="/quiz.php?id=<?php echo $result['id']; ?>"><?php echo $result['id'] . '：' . $result['name']; ?></a>
    </p>
<?php endforeach; ?>

<?php
// Echo "<a href=http://localhost:8080/quiz.php?id=1> 1だよ</a>" . PHP_EOL;
// Echo "<a href=http://localhost:8080/quiz.php?id=2> 2だよ </a>";