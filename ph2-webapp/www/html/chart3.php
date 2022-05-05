<?php
//学習言語
require('./dbconnect.php');

$db = new PDO($dsn, $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 学習言語, 言語毎の学習時間, 言語の色 3つは同じテーブルに存在しない
// 同じテーブルにない場合はテーブルとテーブルをくっつける
// 特に条件指定なしでlanguagesテーブルから情報を取得する
// テーブルの結合をjoin 「left join」 「inner join」 「right join」 が有名所であります
// 基本的にはleft, inner をよく使います
// left は 後からくっつけるテーブルの情報を必ずもつ (条件に合致しなくても)
// inner は 条件に合致する情報だけをもつ
// joinするテーブルは共通項が必要
// languages と records を結合する場合は、languages.id と records.language_idが共通項
// 情報は取得できたが学習言語毎に時間がほしい -> group by を使う
// group by すると単一カラムではない情報はselectできないのでsumで合計値を計算する
$studyContentsSTMT = $db->query("SELECT content, colour, sum(study_time) as study_sum FROM contents LEFT JOIN records on content_id = records.content_id group by content, colour");
$studyContents = $studyContentsSTMT->fetchAll();

$contentToFront = [];
$colourToFront = [];
/**
 * [
 *  [
 *   'language' => 'HTML',
 *   'colour' => '#003030',
 *   'study_sum' => '10',
 *  ],
 *  ...
 * ]
 *  */ 
// 上の配列を 1個目が [['HTML', 10]] と [#003030]
// 2個目が [['HTML', 10], ['CSS', 20]] と [#003030, #555555]
// NULL合体演算子 ??  ex.) $b = $sample ?? 0; $sampleがnullであれば0を代入する
foreach ($studyContents as $value) {
    $colourToFront[] = $value['colour'];
    $contentToFront[] = [$value['content'], (int)$value['study_sum'] ?? 0];
}

$contentToFrontJSON = json_encode($contentToFront);
$colourToFrontJSON = json_encode($colourToFront);


?>
<pre>
</pre>
<script>

// ex.) [['HTML', 10], ['CSS', 20]] 
const studyContentsData = <?= $contentToFrontJSON; ?>;
// ex.) ['#003030', '#555555']
const studyContentsColourData = <?= $colourToFrontJSON; ?>;

google.charts.load("current", { packages: ["coreChart"] });
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
    console.log([
        ['Contents', 'per Day'],
        ...studyContentsData,
    ]);
    console.log(studyContentsColourData);
    var data = google.visualization.arrayToDataTable([
        ['Contents', 'per Day'],
        ...studyContentsData,
    ]);

    var options = {
        pieHole: 0.4,
        window: 10,
        pieSliceBorderColor:'none',
        colors: studyContentsColourData,
        legend: { position: 'none' }
    };

    var chart2 = new google.visualization.PieChart(document.getElementById('donutChart2'));
    chart2.draw(data, options);
}


</script>

