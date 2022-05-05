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
$studyLanguagesSTMT = $db->query("SELECT language, colour, sum(study_time) as study_sum FROM languages LEFT JOIN records on languages.id = records.language_id group by language, colour");
$studyLanguages = $studyLanguagesSTMT->fetchAll();

$languageToFront = [];
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
foreach ($studyLanguages as $value) {
    $colourToFront[] = $value['colour'];
    $languageToFront[] = [$value['language'], (int)$value['study_sum'] ?? 0];
}

$languageToFrontJSON = json_encode($languageToFront);
$colourToFrontJSON = json_encode($colourToFront);


?>
<pre>
</pre>
<script>

// ex.) [['HTML', 10], ['CSS', 20]] 
const studyLanguagesData = <?= $languageToFrontJSON; ?>;
// ex.) ['#003030', '#555555']
const studyLanguagesColourData = <?= $colourToFrontJSON; ?>;

google.charts.load("current", { packages: ["coreChart"] });
google.charts.setOnLoadCallback(drawChart1);
function drawChart1() {
    // studyLanguagesDataをぶち込みたいが[language, per Day] も必要
    // この場合はArray.prototype.concat() を使う配列の合成？が可能になります
    // スプレッド演算子 ...変数 で 配列の中身を展開できる
    console.log([
        ['language', 'per Day'],
        ...studyLanguagesData,
    ]);
    console.log(studyLanguagesColourData);
    var data = google.visualization.arrayToDataTable([
        ['language', 'per Day'],
        ...studyLanguagesData,
    ]);

    var options = {
        pieHole: 0.4,
        window: 10,
        pieSliceBorderColor:'none',

        colors: studyLanguagesColourData,
        legend: { position:'none' }
    };

    var chart1 = new google.visualization.PieChart(document.getElementById('donutChart1'));
    chart1.draw(data, options);
}
</script>

