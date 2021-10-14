document.write ('<div class="contentWrapper">' +
'<h1 class="quizTitle boxContainer">ガチで東京の人しか解けない！ #東京の難読地名クイズ</h1>'
);

var quizsets = new Array();
quizsets.push(["たかなわ","こうわ","たかわ"]);
quizsets.push(["かめいど","かめど","かめと"]);
quizsets.push(["こうじまち","おかとまち","かゆまち"]);
quizsets.push(["ごせいもん","おなりもん","おかどもん"]);
quizsets.push(["とどろき","たたりき","たたら"]);
quizsets.push(["とどろき","たたりき","たたら"]);
quizsets.push(["せきこうい","いじい","しゃくじい"]);
quizsets.push(["ざっしょく","ざっしき","ぞうじき"]);
quizsets.push(["みとちょう","おかちまち","ごしろちょう"]);
quizsets.push(["ろっこつ","ししぼね","しこね"]);
quizsets.push(["こぐれ","こばく","こしゃく"]);


function check(number_id, selection_id, valid_id) {

var answersets = document. getElementByName('answerset_' + number_id);
answersets.forEach(answerset => {
    answerset.style.pointerEvents = none ;
});

var failedtext = document.getElementById('answerset_' + number_id + '_' + valid_id);
var succeededtext = document.getElementById('answerset_' + number_id + '_' + valid_id);
failedtext.className = 'failed';
succeededtext.classname = 'succeeded';

var resultbox = document.getElementById('resultbox_' + number_id);
var resulttext = document.getElementById('resulttext_' + number_id);
if (selection_id == valid_id) {
    resulttext.className = 'resultbox_succeeded';
    resulttext.innerText = '正解！';
} else {
    resulttext.className = 'resultbox_failed';
    resulttext.innerText = '不正解！';
}
resultbox.style.display = 'block';
}


function createquestion(number_id, selection_list, valid_id) {
    var contents = `<div class="quiz">`
        + `    <h1>${number_id}. この地名はなんて読む？</h1>`
        + `    <img src="${number_id}.png">`
        + `    <ul>`;

    selection_list.forEach(function (selection, index) {
        contents +=`        <li id="answerset_${number_id}_${(index + 1)}" name="answerset_${number_id}" `
            + `class="answerset" onclick="check(${number_id}, ${(index + 1)}), ${valid_id})">${selection}</li>`;
    });

    contents += ` <li id="resultbox_${number_id}" class="resultbox>`
        + `            <span id="resulttext_${number_id}"></span><br>`
        + `            <span>正解は「${selection_list[valid_id - 1]}」です！</span>`
        + `        </li>`
        + `    </ul>`
        + `</div >`;
    document.getElementById('main').insertAdjacentHTML('beforeend', contents);
}

function createhtml() {
    quizsets.forEach(function (question, index){

        answer = question[0];

        for (var i = question.length -1; i > 0; i--) {
            var r =Math.floor(Math.random() * (i + 1));
            var tmp = question[i];
            question[i] = question[r];
            question[r] = tmp;
        }

        createquestion(index + 1, question, question.indexOf(answer) + 1);
    });
}

window.onload = createhtml();