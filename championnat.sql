CREATE DATABASE championnat;

USE championnat;

CREATE TABLE Teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team1_id INT,
    team2_id INT,
    score_team1 INT,
    score_team2 INT,
    match_date DATETIME,
    FOREIGN KEY (team1_id) REFERENCES Teams(id),
    FOREIGN KEY (team2_id) REFERENCES Teams(id)
);
