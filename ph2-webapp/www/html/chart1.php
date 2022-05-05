<?php
require('./dbconnect.php');

$db = new PDO($dsn, $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 学習時間
// $db->query("SELECT study_time FROM records where 今月");
// 今月の学習時間のリスト宣言文 = $db->query("SELECT ~~~"); 
// 今月の条件 -> WHERE DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')")
//   ("2022-3-5") -> 3/2022 = 5/2022
// $total = $total_stmt->fetchAll(); // 1件じゃなくて指定の条件にあてはまるのが全て欲しいのでfetchAll使ってる
// $a = ？？ $currentMonthStudyTimeListSTMT
$currentMonthStudyTimeSTMT = $db->query("SELECT study_time FROM records WHERE DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')");
$currentMonthStudyTime = $currentMonthStudyTimeSTMT->fetchAll();
// php側 
// $currentMonthStudyTimeを連想配列(配列の中に配列があるやつ)ではなくて単純な配列にする
// $currentMonthStudyTime[0]['study_time']の中身を取り出してあげる
$dataToFront = [];
// 配列の中に値を入れる方法 $dataToFront[] = 1; -> [1] -> $dataToFront[] = 2; -> [1,2]
// foreach ($currentMonthStudyTime as $$currentMonthStudyTime[0 ~ 8]) {}
foreach ($currentMonthStudyTime as $value) {
    $dataToFront[] = (int)$value['study_time'];
    // なんかやる
}

// 単純な配列の中身は [1,11,1,1,1,1,1,1] こんなかんじ
// phpの配列をjavascriptに渡すためにはjson形式にして渡す必要があるのでphpのメソッドを使って配列→jsonにする
// json_encodeメソッドを使うとjsonになる
$dataToFrontJSON = json_encode($dataToFront);
?>
<pre>
<pre>
<script>
    // こいつをグラフのdataとしてあつかう
    const currentMonthData = <?= $dataToFrontJSON; ?>;
//学習時間棒グラフ
// data = [4,3,2,3,3,4,3,2];
var bar_ctx = document.getElementById('bar-chart').getContext('2d');
var blue_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
blue_gradient.addColorStop(0, '#3DCEFE');
blue_gradient.addColorStop(1, '#0056c0');
var bar_chart = new Chart(bar_ctx, {
    type: 'bar',
    data: {
        labels: ["","2","","4","","6","","8","","10","","12","","14","","16","","18","","20","","22","","24","","26","","28","","30"],
        datasets: [{
            label: '学習時間',
            data: currentMonthData,
						backgroundColor: blue_gradient,
						hoverBackgroundColor: blue_gradient,
						hoverBorderWidth: 2,
						hoverBorderColor: 'purple'
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            xAxes: [                           // Ｘ軸設定
                {
                    scaleLabel: {                 // 軸ラベル非表示
                        display: false,               
                    },
                    gridLines: {                   // 補助線透明化
                        color: "rgba(0, 0, 0, 0)",
                        zeroLineColor: "rgba(0, 0, 0, 0)"  
                    },
                    ticks: {                     
                        fontColor: "#99BBD2",             
                        fontSize: 14                  
                    }
                }
            ],
            yAxes: [                           // Ｙ軸設定
                {
                    scaleLabel: {                  // 軸ラベル非表示
                        display: false,                 
                    },
                    gridLines: {                   // 補助線非表示
                        color: "rgba(0, 0, 0, 0)", 
                        zeroLineColor: "rgba(0, 0, 0, 0)"        
                    },
                    ticks: {                       // 目盛り
                        min: 0,                        // 最小値
                        max: 8,                       // 最大値
                        stepSize: 2,                   // 軸間隔
                        fontColor: "#99BBD2",            
                        fontSize: 14   , 
                        callback: function(tick) {
                            return tick.toString() + 'h';
                          }
                    }
                }
            ]
        }
    }
});
</script>