<?php
// phpinfo();
require('dbconnect.php');


$db = new PDO($dsn, $user, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//総合学習時間
$total_stmt = $db->query("SELECT SUM(study_time) FROM records");
$total = $total_stmt->fetch() ?: 0;

//月の学習時間
$month_stmt = $db->query("SELECT SUM(study_time) FROM records WHERE DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')");
$month = $month_stmt->fetch() ?: 0;

//今日の学習時間
$today_stmt = $db->query("SELECT study_time FROM records WHERE study_date = CURDATE()");
$today = $today_stmt->fetch() ?: 0;
echo $today['study_time'];




?>




<?php

// $total_stmt = $db->prepare("SELECT sum(study_time) FROM study_reports");
// $total_stmt->execute();
// $total = $total_stmt->fetch();

// $month_stmt = $db->prepare("SELECT sum(study_time) FROM study_reports WHERE DATE_FORMAT(study_date, '%Y%m')=DATE_FORMAT(NOW(), '%Y%m')");
// $month_stmt->execute();
// $month = $month_stmt->fetch();

// $today_stmt = $db->prepare("SELECT sum(study_time) FROM study_reports WHERE DATE_FORMAT(study_date, '%Y%m%D')=DATE_FORMAT(NOW(), '%Y%m%D')");
// $today_stmt->execute();
// $today = $today_stmt->fetch();

?>




<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./ph2-webapp.css">
</head>

<body id="body">
    <header class="header">
        <div class="header_inner">
            <div class="header_left">
                <div class="header_logo">
                    <img src="https://posse.anti-pattern.co.jp/img/posseLogo.png" alt="" class="header_logo_img">
                </div>
                <div class="header_text">4th week
                </div>
            </div>
        </div>
    </header>

    <button class="header_button" id="header_button">
        <span class="header_button_text">投稿・記録
        </span>
    </button>
    <div class="body_wrapper">
        <div class="bar_graph_page">
            <ul class="learning_time_ul">
                <li class="learning_time_li">
                    <span>Today</span>
                    <time><?php echo $today['study_time'];?></time>
                    <hour>hour</hour>
                </li>
                <li class="learning_time_li">
                    <span>Month</span>
                    <time><?php echo $month["SUM(study_time)"];?> </time>
                    <hour>hour</hour>
                </li>
                <li class="learning_time_li">
                    <span>Total</span>
                    <time> <?php echo $total["SUM(study_time)"];?></time>
                    <hour>hour</hour>
                </li>
            </ul>

            <!-- グラフ -->
            <div class="bar_graph_wrapper">
                <canvas class="bar_graph_style" id="bar-chart" height="215"></canvas>
            </div>
        </div>
        <div class="pie_chart_page">
            <ul class="pie_chart_ul">
                <li class="pie_chart_li">
                    <span>学習言語</span>
                    <div id="donutChart1" class="donutChart1"></div>
                    <ul class="pie_chart_component_ul">
                        <li class="pie_chart_component_li">
                            <i class="fas fa-circle fas1"></i><span>JavaScript　</span>
                            <i class="fas fa-circle fas2"></i><span>CSS　</span>
                            <i class="fas fa-circle fas3"></i><span>PHP　</span>
                        </li>
                        <li class="pie_chart_component_li">
                            <i class="fas fa-circle fas4"></i><span>HTML　</span>
                            <i class="fas fa-circle fas5"></i><span>Laravel　</span>
                            <i class="fas fa-circle fas6"></i><span>SQL　</span>
                        </li>
                        <li class="pie_chart_component_li">
                            <i class="fas fa-circle fas7"></i><span>SHELL</span>
                        </li>
                        <li class="pie_chart_component_li">
                            <i class="fas fa-circle fas8"></i><span>情報システム基礎知識（その他）</span>
                        </li>

                    </ul>

                </li>
                <li class="pie_chart_li">
                    <span>学習コンテンツ</span>
                    <div id="donutChart2" class="donutChart2"></div>

                    <ul class="pie_chart_component_ul">
                        <li class="pie_chart_component_li"><i class="fas fa-circle fas1"></i><span>ドットインストール</span></li>
                        <li class="pie_chart_component_li"><i class="fas fa-circle fas2"></i><span>N予備校</span></li>
                        <li class="pie_chart_component_li"><i class="fas fa-circle fas3"></i><span>POSSE課題</span></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

<!-- もーだる -->
    <div class="black_filter" id="black_filter"></div>
    <div class="overlay" id="overlay">
        <div class="overlay_wrapper">

            <div class="left_wrapper">
                <div class="learning_date">
                    <span class="overlay_each_tittle">学習日</span>

                    <input type="text" id="calendar_input">

                    <div class="calendar_modal" id="calendar_modal">
                        <div class="calendar_wrapper">
                            <!-- xxxx年xx月を表示 -->
                            <h1 id="calendar_header">
                            </h1>

                            <!-- ボタンクリックで月移動 -->
                            <div class="calendar_next_prev_button" id="next-prev-button">
                                <button class="prev_button" id="prev" onclick="prev()">＜</button>
                                <button class="next_button" id="next" onclick="next()">＞</button>
                            </div>

                            <!-- カレンダー -->
                            <div id="calendar"></div>
                            <button class="determination_button" id="determination_button">
                                <span class="determination_button_text">決定</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="learning_content">
                    <span class="overlay_each_tittle">学習コンテンツ（複数選択可）</span>
                    <div class="overlay_leaning_contents_wrapper">
                        <div class="overlay_input_horizontal">
                            <input type="checkbox" class="overlay_input" id="Nyobi">
                            <label class="overlay_input_element" for="Nyobi"><i
                                    class="fas fa-check-circle"></i>N予備</label>
                            <input type="checkbox" class="overlay_input" id="dotinstall">
                            <label class="overlay_input_element" for="dotinstall"><i
                                    class="fas fa-check-circle"></i>ドットインストール</label>
                        </div>
                        <input type="checkbox" class="overlay_input" id="posse">
                        <label class="overlay_input_element" for="posse"><i
                                class="fas fa-check-circle"></i>POSSE課題</label>
                    </div>
                    <div class="learning_language">
                        <span class="overlay_each_tittle">学習言語（複数選択可）</span>
                        <div class="overlay_leaning_contents_wrapper">
                            <div class="overlay_input_horizontal">
                                <input type="checkbox" class="overlay_input" id="html">
                                <label class="overlay_input_element" for="html"><i
                                        class="fas fa-check-circle"></i>HTML</label>
                                <input type="checkbox" class="overlay_input" id="css">
                                <label class="overlay_input_element" for="css"><i
                                        class="fas fa-check-circle"></i>CSS</label>
                                <input type="checkbox" class="overlay_input" id="js">
                                <label class="overlay_input_element" for="js"><i
                                        class="fas fa-check-circle"></i>JavaScript</label>

                            </div>
                            <div class="overlay_input_horizontal">
                                <input type="checkbox" class="overlay_input" id="php">
                                <label class="overlay_input_element" for="php"><i
                                        class="fas fa-check-circle"></i>PHP</label>
                                <input type="checkbox" class="overlay_input" id="laravel">
                                <label class="overlay_input_element" for="laravel"><i
                                        class="fas fa-check-circle"></i>Laravel</label>

                                <input type="checkbox" class="overlay_input" id="sql">
                                <label class="overlay_input_element" for="sql"><i
                                        class="fas fa-check-circle"></i>SQL</label>
                                <input type="checkbox" class="overlay_input" id="shell">
                                <label class="overlay_input_element" for="shell"><i
                                        class="fas fa-check-circle"></i>SHELL</label>

                            </div>
                            <div class="overlay_input_horizontal">
                                <input type="checkbox" class="overlay_input" id="informationsystem">
                                <label div class="overlay_input_element" for="informationsystem"><i
                                        class="fas fa-check-circle"></i>情報システム基礎知識（その他）</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right_wrapper">
                <i class="fas fa-times" id="overlay_close_button"></i>
                <div class="learning_hour">
                    <span class="overlay_each_tittle ">学習時間</span>
                    <input type="text" class="learning_hour_imput">
                </div>
                <div class="twitter_comment">
                    <span class="overlay_each_tittle">Twitter用コメント</span>
                    <input type="text" class="twitter_input" id="tweet_comment_input">
                    <input type="checkbox" id="tweet_button" name="tweet_button">
                    <label class="share_twitter" for="tweet_button">
                        <i class="fas fa-check-circle fa-2x" id="twitter_check_mark_button"></i><span>Twitterにシェアする</span>
                    </label>
                </div>
            </div>
        </div>

        <button class="overlay_post_record_button" id="overlay_post_record_button">
            <span class="overlay_post_record_button_text">投稿・記録
            </span>
        </button>
        
<!-- loading overlay-->
        <div class="loading_wrapper" id="loading">
            <i class="fas fa-times loading_close_button" id="close_button"></i>
            <div class="loader"></div>
        </div>
        <!-- 
            
            awesome 
        
        -->
        <div class="post_record_completed_whole_wrapper" id="post_record_completed">
            <div class="post_record_completed">
                <i class="fas fa-times post_record_completed_close_button" id="post_record_completed_close_button"></i>
                <div class="post_record_completed_wrapper">
                    <span class="awesome">AWESOME!</span>
                    <i class="fas fa-check-circle awesome_check fa-3x"></i>
                    <span>記録・投稿<br>完了しました</span>
                </div>
            </div>
        </div>
    </div>
    <!-- modalの中身終了 -->
    <div class="year_month_change_part">
        <i class="fas fa-chevron-left" id="year_month_prev_button"></i>
        <span id="year_month_displayed" class="year_month_displayed">

        </span>
        <i class="fas fa-chevron-right" id="year_month_next_button"></i>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <!-- <script src="./ph2-webapp.js"></script> -->
    <script src="./ph2-webapp.js"></script>
    <!-- <php require('chart1.php); ?> -->
<?php require('chart1.php');?>
<?php require('chart2.php');?>
<?php require('chart3.php');?>

</body>

</html>

