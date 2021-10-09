document.write ('<div class="contentWrapper">' +
'<h1 class="quizTitle boxContainer">ガチで東京の人しか解けない！ #東京の難読地名クイズ</h1>'
);

const quizSet = [
    ["たかなわ","こうわ","たかわ"]
    ["かめいど","かめど","かめと"]
    ["こうじまち","おかとまち","かゆまち"]
    ["ごせいもん","おなりもん","おかどもん"]
    ["とどろき","たたりき","たたら"]
    ["せきこうい","いじい","しゃくじい"]
    ["ざっしょく","ざっしき","ぞうじき"]
    ["みとちょう","おかちまち","ごしろちょう"]
    ["ろっこつ","ししぼね","しこね"]
    ["こぐれ","こばく","こしゃく"]
]

let quizSetLength = Object.keys(quizSet).length;
for (let k = 0; k < quizSetLength; k++) {
    let questionContent =
    '<section class="quiz boxContainer">' +
    '<h2 class="question">' +
    `${k + 1}` +
    '. この地名はなんて読む？</h2>' +
    '<div class="quizImageContainer">' +
    '<div class="quizImageContainer">' +
    '<img class="image" src="https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png" alt="高輪の画像">' +
    '</div>' +
    '</div>' +
    "<ul id='choices'>"
}