//TODO 最後にi<11に変更
for(let i = 1; i<2; i++){
const askQuiz = document.getElementById('quizAsk');

const numberQues = document.createElement('h2');
numberQues.innerText = `${i}.この地名はなんて読む？`;
askQuiz.appendChild(numberQues);
numberQues.classList.add('question');


//TODO 写真を番号によって変える機能を追加
const imgArea = document.createElement('img');
imgArea.src = 'https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png';
askQuiz.appendChild(imgArea);
imgArea.classList.add('quizImage');
imgArea.id = `quizImage${i}`;


const btnArea1 = document.createElement('button');
const btnArea2 = document.createElement('button');
const btnArea3 = document.createElement('button');

//TODO ボタンの中の文字を番号によって変える機能を追加
btnArea1.innerText = 'こうわ';
btnArea2.innerText = 'たかなわ';
btnArea3.innerText = 'たかわ';

askQuiz.appendChild(btnArea1);
askQuiz.appendChild(btnArea2);
askQuiz.appendChild(btnArea3);

btnArea1.classList.add('basicButton');
btnArea2.classList.add('basicButton');
btnArea3.classList.add('basicButton');

btnArea1.id = `wrongMove${i}`;
btnArea2.id = `rightMove${i}`;
btnArea3.id = `wrongMove${i}`;

let btn1 = document.getElementById(`wrongMove${i}`);
let btn2 = document.getElementById(`rightMove${i}`);
let btn3 = document.getElementById(`wrongMove${i}`);
//let answerArea = document.getElementById(`answerArea${i}`);

btn1.addEventListener('click',wrongChange1);
btn2.addEventListener('click',rightChange);
btn3.addEventListener('click',wrongChange2);

//答えが表示される箱
const divArea = document.createElement('div');
divArea.classList.add('quizResult');
divArea.classList.add('appear');
divArea.id = `answerArea${i}`;
askQuiz.appendChild(divArea);

//TODO"1" ボタンを押したら色が変わり答えが現れる機能追加
function wrongChange1(){
    btn1.classList.add('failed');
    answerArea.classList.remove('disappear');
}

function rightChange(){
    btn2.classList.add('succeeded');
    answerArea.classList.remove('disappear');
}

function wrongChange2(){
    btn2.classList.add('failed');
    answerArea.classList.remove('disappear');
}



}