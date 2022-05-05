DROP DATABASE IF EXISTS webapp;
CREATE DATABASE webapp;
USE webapp;

DROP TABLE IF EXISTS records;
CREATE TABLE records (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `study_date` DATETIME NOT NULL,
  `study_time` INT NOT NULL,
  `language_id` INT NOT NULL,
  `content_id` INT NOT NULL
);
INSERT INTO records(study_date, study_time, language_id, content_id)
VALUES
  ("2022-3-5", 2, 1, 1),
  ("2022-3-6", 3, 2, 1),
  ("2022-3-7", 4, 3, 1),
  ("2022-3-8", 2, 4, 1),
  ("2022-3-9", 0, 1, 2),
  ("2022-3-10", 4, 2, 2),
  ("2022-3-11", 2, 3, 2),
  ("2022-3-12", 3, 4, 2),
  ("2022-3-13", 3, 1, 3),
  ("2022-3-14", 3, 2, 3),
  ("2022-3-15", 2, 3, 3),
  ("2022-3-16", 3, 4, 3),
  ("2022-5-1", 4, 1, 1),
  ("2022-5-2", 3, 2, 1),
  ("2022-5-3", 2, 3, 2),
  ("2022-5-4", 3, 4, 2),
  ("2022-5-5", 3, 4, 2),
  ("2022-5-6", 4, 1, 3),
  ("2022-5-7", 3, 2, 3),
  ("2022-5-8", 2, 3, 3);

DROP TABLE IF EXISTS webapp.languages;
CREATE TABLE webapp.languages (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    language VARCHAR(255) NOT NULL,
    colour VARCHAR(255) NOT NULL
);

INSERT INTO webapp.languages(language, colour)
VALUES
('HTML', '#0445ec'),
('CSS', '#0f70bd'),
('SQL', '#20bdde'),
('SHELL', '#3ccefe'),
('Javascript', '#b29ef3'),
('PHP', '#4a17ef'),
('Laravel', '#3005c0'),
('その他', '#6c46eb');

DROP TABLE IF EXISTS webapp.contents;
CREATE TABLE webapp.contents (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  content VARCHAR(255) NOT NULL,
  colour VARCHAR(255) NOT NULL
);

INSERT INTO webapp.contents(content, colour)
VALUES
  ('N予備校', '#0445ec'),
  ('課題', '#0f70bd'),
  ('ドットインストール', '#20bdde');