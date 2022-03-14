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
var bar_ctx = document.getElementById('bar-chart').getContext('2d');
var blue_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
blue_gradient.addColorStop(0, '#3DCEFE');
blue_gradient.addColorStop(1, '#0056c0');
var bar_chart = new Chart(bar_ctx, {
    type: 'bar',
    data: {
        labels: ["","2","","4","","6","","8","","10","","12","","14","","16","","18","","20","","22","","24","","26","","28","","30"],
        datasets: [{
            label: '# of Votes',
            data: [1,2,3,4,5,6,7,8,1,2,3,4,5,6,7,8,1,2,3,4,5,6,7,8,1,2,3,4,5,6],
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


//学習言語のドーナツチャート google.chart
google.charts.load("current", { packages: ["coreChart"] });
google.charts.setOnLoadCallback(drawChart1);
function drawChart1() {
    var data = google.visualization.arrayToDataTable([
        ['language', 'per Day'],
        ['JavaScript', 42],
        ['CSS', 6],
        ['PHP', 18],
        ['HTML', 10],
        ['Laravel', 6],
        ['SQL', 6],
        ['SHELL', 6],
        ['情報システム基礎知識', 6]
    ]);

    var options = {
        pieHole: 0.4,
        window: 10,
        pieSliceBorderColor:'none',

        colors: ["#1855EF",
            "#1170BC",
            "#20BDDE",
            "#3CCEFE",
            "#B39EF3",
            "#6C47EB",
            "#6C47EB",
            "#3004C0",],
        legend: { position:'none' }
    };

    var chart1 = new google.visualization.PieChart(document.getElementById('donutChart1'));
    chart1.draw(data, options);
}

//学習コンテンツのドーナツチャート google.chart
google.charts.load("current", { packages: ["coreChart"] });
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['Contents', 'per Day'],
        ['ドットインストール', 42],
        ['N予備', 18],
        ['POSSE課題', 10],
        
    ]);

    var options = {
        pieHole: 0.4,
        window: 10,
        pieSliceBorderColor:'none',
        colors: [
            "#1855EF",
            "#1170BC",
            "#20BDDE"
            ],
        legend: { position: 'none' }
    };

    var chart2 = new google.visualization.PieChart(document.getElementById('donutChart2'));
    chart2.draw(data, options);
}

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

