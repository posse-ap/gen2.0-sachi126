const headerBtn = document.getElementById('header_button');//ヘッダーの投稿・記録ボタン取得
const overlayBtn = document.getElementById('overlay_post_record_button');//モーダルの投稿・記録ボタン取得
const closeBtn = document.getElementById('overlay_close_button');//モーダルを閉じるボタン取得
const overlay = document.getElementById('overlay');//モーダル取得
const body = document.getElementById('body');//body全体取得
const Filter = document.getElementById('black_filter');//モーダル展開時の背景のフィルター取得
const loading = document.getElementById('loading');//ローディングのモーダル取得
const postRecordCompleted = document.getElementById('post_record_completed');//投稿・記録完了画面のモーダル取得
const postRecordCompletedCloseBtn = document.getElementById('post_record_completed_close_button');//投稿・記録完了画面の閉じるボタン取得
const twitterCheckMarkBtn = document.getElementById('twitter_check_mark_button');//Twitterに投稿するのチェックマーク取得
const TweetTextInput = document.getElementById('tweet_comment_input');//Twitterのコメントをかくinput取得

//モーダルの動き
headerBtn.addEventListener('click', () => {
    overlay.style.display = 'block';
    Filter.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    overlay.style.display = 'none';
    Filter.style.display = 'none';
})

overlayBtn.addEventListener('click', () => {
    loading.style.display = 'block'
    window.setTimeout(function () {
        loading.style.display = 'none'
        postRecordCompleted.style.display = 'block'
    }, 3000);
});

postRecordCompletedCloseBtn.addEventListener('click', () => {
    postRecordCompleted.style.display = 'none'
    loading.style.display = 'none'
    overlay.style.display = 'none';
    Filter.style.display = 'none';
});

twitterCheckMarkBtn.addEventListener('click', () => {
    twitterCheckMarkBtn.classList.toggle('fa-check-circle_clicked')
})

//棒グラフ chart.js



//学習言語のドーナツチャート google.chart


//学習コンテンツのドーナツチャート google.chart
// google.charts.load("current", { packages: ["coreChart"] });
// google.charts.setOnLoadCallback(drawChart2);
// function drawChart2() {
//     var data = google.visualization.arrayToDataTable([
//         ['Contents', 'per Day'],
//         ['ドットインストール', 42],
//         ['N予備', 18],
//         ['POSSE課題', 10],
        
//     ]);

//     var options = {
//         pieHole: 0.4,
//         window: 10,
//         pieSliceBorderColor:'none',
//         colors: [
//             "#1855EF",
//             "#1170BC",
//             "#20BDDE"
//             ],
//         legend: { position: 'none' }
//     };

//     var chart2 = new google.visualization.PieChart(document.getElementById('donutChart2'));
//     chart2.draw(data, options);
// }

//カレンダー
const calendarModal = document.getElementById('calendar_modal');
let calendarInput = document.getElementById('calendar_input');
const determinationBtn = document.getElementById('determination_button');

calendarInput.addEventListener('click', () => {
    calendarModal.style.display = 'block'
});

const week = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
const today = new Date();
// 月末だとずれる可能性があるため、1日固定で取得
var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

// 初期表示
    window.onload = function () {
        showProcess(today, calendar);
       
    };

// 前の月透明で表示
function prev(){
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
}

// 次の月透明で表示
function next(){
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
}

// カレンダー表示
function showProcess(date) {
    var year = date.getFullYear();
    var month = date.getMonth();
    document.querySelector('#calendar_header').innerHTML = year + "年 " + (month + 1) + "月";
    var calendar = createProcess(year, month);
    document.querySelector('#calendar').innerHTML = calendar;
}

// カレンダー作成
function createProcess(year, month) {
    // 曜日
    var calendar = "<table><tr class='dayOfWeek'>";
    for (var i = 0; i < week.length; i++) {
        calendar += "<th>" + week[i] + "</th>"; //曜日の漢字を配列から取ってくる
    }
    calendar += "</tr>";

    var count = 0;
    var startDayOfWeek = new Date(year, month, 1).getDay();
    var endDate = new Date(year, month + 1, 0).getDate();
    var lastMonthEndDate = new Date(year, month, 0).getDate();
    var row = Math.ceil((startDayOfWeek + endDate) / week.length);
    

    // 1行ずつ設定
    for (var i = 0; i < row; i++) {
        calendar += "<tr>";
        // 1colum単位で設定
        for (var j = 0; j < week.length; j++) {
            if (i == 0 && j < startDayOfWeek) {
                // 1行目で1日まで先月の日付を設定
                calendar += `<td class='invisible' onclick=input(${year},${month+1},${count})>` + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
            } else if (count >= endDate) {
                // 最終行で最終日以降、翌月の日付を設定
                count++;
                calendar += `<td class='invisible' onclick=input(${year},${month+1},${count})>` + (count - endDate) + "</td>";
            } else {
                // 当月の日付を曜日に照らし合わせて設定、青丸つける
                count++;
                if (month == (today.getMonth())
                && count < today.getDate()){
                    calendar += `<td class='disabled' onclick=input(${year},${month+1},${count})>` + count + "</td>";
                }
                if(month != (today.getMonth())
                && count == today.getDate()){
                    calendar += `<td onclick=input(${year},${month+1},${count})>` + count + `</td>`;
                }
                if(year == today.getFullYear()
                  && month == (today.getMonth())
                  && count == today.getDate()){
                    calendar += `<td class='today' onclick=input(${year},${month+1},${count})>` + count + `</td>`;
                } if (count > today.getDate()){
                    calendar += `<td onclick=input(${year},${month+1},${count})>` + count + "</td>";
                } 
            }
        }
        calendar += "</tr>";
    }
    return calendar;
}
//日付をクリックしたらinputに反映させる
function input(year,month,date) {
    calendarInput.value = `${year}年${month}月${date}日`
    console.log(year + "年 " + month + "月" + date + "日")
};

determinationBtn.addEventListener('click', ()=> {
    calendarModal.style.display = "none"
});

const yearMonthDisplayed = document.getElementById('year_month_displayed');
const yearMonthPrevBtn = document.getElementById('year_month_prev_button');
const yearMonthNextBtn = document.getElementById('year_month_next_button');

var year_text = showDate.getFullYear();
var month_text = showDate.getMonth();
var counter = 0;
yearMonthDisplayed.innerHTML = `${year_text}年${month_text+1}月`

yearMonthPrevBtn.addEventListener('click', ()=> {
    counter++;
    yearMonthDisplayed.innerHTML = `${year_text}年${month_text-counter+1}月`
    console.log(`${year_text}年${month_text+1+counter}月`)
})

yearMonthNextBtn.addEventListener('click', () => {
    counter++;
    yearMonthDisplayed.innerHTML = `${year_text}年${month_text+1+counter}月`
    console.log(`${year_text}年${month_text+1+counter}月`)
})

//Twitter投稿機能
// var TweetText = document.forms.tweetForm.tweetCommentInput.value;
$(function(){
    $('#tweet_button').click(function(){
        if($('[name="tweet_button"]').prop('checked')){
            console.log('チェックされてるよ')
            overlayBtn.innerText = "";
            const anchor = document.createElement('a');
            const hrefValue =
              'https://twitter.com/intent/tweet?button_hashtag=あなたのいいところ&ref_src=twsrc%5Etfw';
              
            anchor.setAttribute('href', hrefValue);
            anchor.className = 'twitter-hashtag-button';
            anchor.setAttribute('data-text', 'あああ');
            anchor.innerText = '診断・投稿';
            
            overlayBtn.appendChild(anchor);
        }else{
            console.log('チェックされてないよ')
            var element = overlayBtn.childNodes[0];
            overlayBtn.removeChild(element);
            overlayBtn.innerText = "診断・投稿";
        }
    });
});

