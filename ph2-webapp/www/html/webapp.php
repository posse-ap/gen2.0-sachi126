<?php
// phpinfo();
require('dbconnect.php');


?>

<?php
require("dbconnect.php");
?>



<?php

$total_stmt = $db->prepare("SELECT sum(study_time) FROM study_reports");
$total_stmt->execute();
$total = $total_stmt->fetch();

$month_stmt = $db->prepare("SELECT sum(study_time) FROM study_reports WHERE DATE_FORMAT(study_date, '%Y%m')=DATE_FORMAT(NOW(), '%Y%m')");
$month_stmt->execute();
$month = $month_stmt->fetch();

$today_stmt = $db->prepare("SELECT sum(study_time) FROM study_reports WHERE DATE_FORMAT(study_date, '%Y%m%D')=DATE_FORMAT(NOW(), '%Y%m%D')");
$today_stmt->execute();
$today = $today_stmt->fetch();

?>




<!DOCTYPE html>
<html lang='ja'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>POSSEAPP</title>
  <link rel='stylesheet' href='./css/index.css'>
  <!-- <link rel="stylesheet" href="./css/index.scss"> -->
  <link rel='stylesheet' href='./css/reset.css'>
  <link rel='stylesheet' href='./css/responsive.css'>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/77dc7f4ff2.js" crossorigin="anonymous"></script>
  <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>

</head>

<body>



  <!-- ヘッダー -->
  <div class='header'>
    <div class='header__inner'>
      <div class='header__inner__logo'>
        <img src='https://posse.anti-pattern.co.jp/img/posseLogo.png' alt='POSSEのロゴ'>
      </div>
      <div class='header__inner__time'>
        <h2>4th week</h2>
      </div>
    </div>
    <button id='openModal' class='header__inner__button'>記録・投稿</button>
  </div>
  <!-- 大枠 -->

  <!-- 大枠の中身 -->
  <section class='main__inner'>
    <!-- 時間と棒グラフ -->
    <section class='main__inner__1'>
      <!-- 3つの時間ボックス -->
      <ul class='main__inner__1__time'>
        <li class='main__inner__1__time__box section__box'>
          <p class='main__inner__1__time__box__time__title'>Today</p>
          <p class='main__inner__1__time__box__time__result'><?php echo $today[0] === NULL ? 0 : $today[0] ?></p>
          <p class='main__inner__1__time__box__time__unit'>hour</p>
        </li>
        <li class='main__inner__1__time__box section__box'>
          <p class='main__inner__1__time__box__time__title'>Month</p>
          <p class='main__inner__1__time__box__time__result'><?php echo $month[0] === NULL ? 0 : $month[0] ?></p>
          <p class='main__inner__1__time__box__time__unit'>hour</p>
        </li>
        <li class='main__inner__1__time__box section__box'>
          <p class='main__inner__1__time__box__time__title'>Total</p>
          <p class='main__inner__1__time__box__time__result'><?php echo $total[0] === NULL ? 0 : $total[0] ?></p>
          <p class='main__inner__1__time__box__time__unit'>hour</p>
        </li>
      </ul>
      <!-- 棒グラフ -->
      <div class='main__inner__1__timeGraph section__box'>
        <canvas id='bargraph-area' name='barGraph-area'></canvas>
      </div>
    </section>
    <!-- 学習言語と学習コンテンツ -->
    <section class='main__inner__2'>
      <!-- 学習言語 -->
      <div class='main__inner__2__box section__box'>
        <h2 class='float'>学習言語</h2>
        <div class='main__inner__2__box__graph'>
          <div id='languageGraph' style="width: 80%; height: 400px;"></div>
        </div>

      </div>

      <!-- 学習コンテンツ -->
      <div class='main__inner__2__box section__box'>
        <h2 class='float'>学習コンテンツ</h2>
        <div class='main__inner__2__box__graph'>
          <div id='contentGraph'></div>
        </div>
      </div>
    </section>
  </section>

  <footer>
    <div class='foot-wrapper'>
      <div class='foot-nav'>
        <i class='fas fa-chevron-left' style='color: #026CBA;'></i>
        <h1>2020年4月</h1>
        <i class='fas fa-chevron-right' style='color: #A3C1D6'></i>
        <button id='openModalResponsive' class='responsive__inner__button'>記録・投稿</button>
        <!-- <a id='responsive_record_button' class='responsive__inner__button'>記録・投稿</a> -->
      </div>
    </div>
  </footer>



  <!-- モーダルエリアここから -->
  <section id='modalArea' class='modalArea'>
    <div id='modalBg' class='modalBg'></div>
    <div class='modalWrapper' id="modalWrapper">
      <div class='modalContents' id="modalContents">
        <div class="flex">
          <div class='modal-content-1'>
            <!-- 学習日 -->
            <div class='grid' id="appendTo">
              <label for="studyDate">
                <h3 class='modal-content-title float'>学習日</h3>
              </label>
              <input type="text" name="study-date" id="studyDate" autocomplete='date' class='modal-study-date'>
            </div>
            <!-- 学習コンテンツ -->
            <div class='grid'>
              <h3 class='modal-content-title float'>学習コンテンツ（複数選択可）</h3>
              <div class='float'>
                <label for="nYobi" class="modal-checkbox" id="content_1">
                  <input id="nYobi" type="checkbox" name="studyContent" value="N予備校" class="checkbox" onclick="chbg1('nYobi')">
                  <i class='fa-solid fa-circle-check checkmark' id="contentCheck_0"></i>
                  N予備校
                </label>
                <label for="dotInstall" class="modal-checkbox" id="content_2">
                  <input id="dotInstall" type="checkbox" name="studyContent" value="ドットインストール" onclick="chbg1('dotInstall')">
                  <i class='fa-solid fa-circle-check checkmark' id="contentCheck_1"></i>
                  ドットインストール
                </label>
                <label for="posseHw" class="modal-checkbox" id="content_3">
                  <input id='posseHw' type="checkbox" name="studyContent" value="POSSE課題" onclick="chbg1('posseHw')">
                  <i class='fa-solid fa-circle-check checkmark' id="contentCheck_2"></i>
                  POSSE課題
                </label>
              </div>
            </div>










            <!-- 学習言語 -->
            <div class='grid'>
              <h3 class='modal-content-title float'>学習言語（複数選択可）</h3>
              <div class='float'>
                <label for="html" class="modal-checkbox" id="lang_1">
                  <input id="html" type="checkbox" name="studyLanguage" value="HTML">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  HTML
                </label>
                <label for="css" class="modal-checkbox" id="lang_2">
                  <input id="css" type="checkbox" name="studyLanguage" value="CSS" onclick="chbg2('css')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  CSS
                </label>
                <label for="js" class="modal-checkbox" id="lang_3">
                  <input id="js" type="checkbox" name="studyLanguage" value="JavaScript" onclick="chbg2('js')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  JavaScript
                </label>
                <label for="php" class="modal-checkbox" id="lang_4">
                  <input id="php" type="checkbox" name="studyLanguage" value="php" onclick="chbg2('php')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  PHP
                </label>
                <label for="laravel" class="modal-checkbox" id="lang_5">
                  <input id="laravel" type="checkbox" name="studyLanguage" value="Laravel" onclick="chbg2('laravel')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  Laravel
                </label>
                <label for="sql" class="modal-checkbox" id="lang_6">
                  <input id="sql" type="checkbox" name="studyLanguage" value="SQL" onclick="chbg2('sql')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  SQL
                </label>
                <label for="shell" class="modal-checkbox" id="lang_7">
                  <input id="shell" type="checkbox" name="studyLanguage" value="SHELL" onclick="chbg2('shell')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  SHELL
                </label>
                <label for="basicKnowledge" class="modal-checkbox" id="lang_8">
                  <input id="basicKnowledge" type="checkbox" name="studyLanguage" value="情報システム基礎知識（その他）" onclick="chbg2('basicKnowledge')">
                  <i class='fa-solid fa-circle-check checkmark'></i>
                  情報システム基礎知識（その他）
                </label>
              </div>
            </div>
          </div>
          <div class='modal-content-2'>
            <div class='grid'>
              <h3 class='modal-content-title float'> 学習時間</h3>
              <label for='time'>
                <input type='number' onkeyup='value = value.length > 5 ? value.slice(0,5): value;' max='99999' name='study-time' autocomplete='time' class='modal-study-time' id='time'>
              </label>
            </div>
            <div class='grid'>
              <h3 class='modal-content-title float'>Twitter用コメント</h3>
              <textarea id='twitter_com' name='content'>
              </textarea>
              <div class='flex'>
                <label for='tweet'>
                  <input type='checkbox' name='share-box' value='true' id='tweet' class='stretched-link'>
                  <i class='fa-solid fa-circle-check checkmark' id='tweetCheckmark'></i>
                </label>
                Twitterにシェアする
              </div>
            </div>
          </div>
        </div>
          <button id='modal-inner-button' class='modal-inner-button' onclick="func1();func2()">記録・投稿</button>
          <!-- カレンダー画面の中に表示される決定ボタン 下一行-->
          <button id="determination__button" class="calender__modal__determination__button"><a href="#modalArea">決定</a></button>
      </div>
      <div id='closeModal' class='closeModal'>
        ×
      </div>
    </div>
  </section>
  <!-- モーダルエリアここまで -->


  <!-- ローディング画面ここから -->
  <section id='loading' class='modalArea'>
    <div class='modalBg'></div>
    <div class='modalWrapper'>
      <div class='loader-wrap'>
        <div class='loader'>Loading...</div>
      </div>
    </div>
  </section>




  <!-- 完了画面ここから -->
  <section id='modalDone' class='modalArea'>
    <div class='modalBg'></div>
    <div class='modalWrapper'>
      <div class='modalContentsDone'>
        <span class='circle'>
          <div class='check'></div>
        </span>
        <div class='modal-done-text'>
          <h4> AWESOME!</h4>
          <h3>記録・投稿<br>完了しました</h3>
        </div>
      </div>
      <div id='closeModalDone' class='closeModal'>
        ×
      </div>
    </div>
  </section>
  <!-- 完了画面ここまで -->


  <!-- カレンダー -->
  <div id="calendar"></div>





  <script src='./js/index.js' type='text/javascript'></script>
</body>

<?php
require("chart.php");
?>

</html>