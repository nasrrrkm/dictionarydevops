CREATE DATABASE IF NOT EXISTS dictionary_db;
USE dictionary_db;

CREATE TABLE IF NOT EXISTS words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(50) NOT NULL UNIQUE,
    meaning VARCHAR(100) NOT NULL
);

INSERT IGNORE INTO words (word, meaning) VALUES 
('apple', 'تفاحة'),
('book', 'كتاب'),
('computer', 'حاسوب'),
('server', 'خادم / سيرفر');
