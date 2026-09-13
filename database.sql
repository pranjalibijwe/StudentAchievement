CREATE TABLE achievements (
    achievement_id INT AUTO_INCREMENT PRIMARY KEY,
    competition VARCHAR(100) NOT NULL,
    award VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    level VARCHAR(50) NOT NULL
);

INSERT INTO achievements (competition, award, year, level) VALUES
('Science Exhibition', 'First Prize', 2026, 'College'),
('Coding Competition', 'Second Prize', 2025, 'State'),
('Quiz Competition', 'First Prize', 2026, 'District'),
('Debate Competition', 'Best Speaker', 2025, 'College');