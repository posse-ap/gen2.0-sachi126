
DROP DATABASE IF EXISTS quizy;
CREATE DATABASE quizy;
USE quizy;
DROP TABLE IF EXISTS big_questions;
 
CREATE TABLE big_questions (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name TEXT NOT NULL
)DEFAULT CHARACTER SET=utf8;
 
INSERT INTO big_questions (name) VALUES ("東京の難読地名クイズ"),("広島の難読地名クイズ");
 

DROP TABLE IF EXISTS choices;
CREATE TABLE choices (
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
img VARCHAR(225) NOT NULL,
big_question_id INT NOT NULL,
question_id INT NOT NULL,
option_1 VARCHAR(225) NOT NULL,
option_2 VARCHAR(225) NOT NULL,
option_3 VARCHAR(225) NOT NULL
);

INSERT INTO choices (img, big_question_id, question_id, option_1, option_2, option_3) VALUES 
('https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png',1, 1, 'たかなわ', 'たかわ', 'こうわ'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/512b8146e7661821c45dbb8fefedf731.png', 1, 2, 'かめいど', 'かめと', 'かめど'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/ad4f8badd896f1a9b527c530ebf8ac7f.png', 1, 3, 'こうじまち', 'かゆまち', 'おかとまち'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/ee645c9f43be1ab3992d121ee9e780fb.png', 1, 4, 'おなりもん', 'おかどもん', 'ごせいもん'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/6a235aaa10f0bd3ca57871f76907797b.png', 1, 5, 'とどろき', 'たたらき', 'たたら'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/0b6789cf496fb75191edf1e3a6e05039.png', 1, 6, 'しゃくじい', 'せきこうい', 'いじい'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/23e698eec548ff20a4f7969ca8823c53.png', 1, 7, 'ぞうしき', 'ざっしき', 'ざっしょく'), 
('https://d1khcm40x1j0f.cloudfront.net/quiz/50a753d151d35f8602d2c3e2790ea6e4.png', 1, 8, 'おかちまち', 'みとちょ', 'ごしろちょう'),
('https://d1khcm40x1j0f.cloudfront.net/words/8cad76c39c43e2b651041c6d812ea26e.png', 1, 9, 'ししぼね', 'ろっこつ', 'しこね'),
('https://d1khcm40x1j0f.cloudfront.net/words/34508ddb0789ee73471b9f17977e7c9c.png', 1, 10, 'こぐれ', 'こばく', 'こしゃく'),
('https://d1khcm40x1j0f.cloudfront.net/quiz/d876208414d51791af9700a0389b988b.png', 2, 1, 'むかいなだ', 'むおうひら', 'むきひら');