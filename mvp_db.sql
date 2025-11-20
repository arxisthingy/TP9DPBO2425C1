CREATE DATABASE IF NOT EXISTS mvp_db;
USE mvp_db;

DROP TABLE IF EXISTS pembalap;
DROP TABLE IF EXISTS tim;

CREATE TABLE tim (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tim VARCHAR(255) NOT NULL,
    mesin VARCHAR(255) NOT NULL,
    sasis VARCHAR(255) NOT NULL
);

CREATE TABLE pembalap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tim_id INT,
    negara VARCHAR(255) NOT NULL,
    poinMusim INT DEFAULT 0,
    jumlahMenang INT DEFAULT 0,
    FOREIGN KEY (tim_id) REFERENCES tim(id) ON DELETE SET NULL
);

INSERT INTO tim (nama_tim, mesin, sasis) VALUES 
('Mercedes', 'Mercedes', 'W14'),
('Red Bull', 'Honda RBPT', 'RB19'),
('Ferrari', 'Ferrari', 'SF-23'),
('McLaren', 'Mercedes', 'MCL60'),
('AlphaTauri', 'Honda RBPT', 'AT04'),
('Alpine', 'Renault', 'A523');

INSERT INTO pembalap (nama, tim_id, negara, poinMusim, jumlahMenang) VALUES
('Lewis Hamilton', 1, 'United Kingdom', 347, 11),
('Max Verstappen', 2, 'Netherlands', 335, 10),
('Valtteri Bottas', 1, 'Finland', 203, 2),
('Sergio Perez', 2, 'Mexico', 190, 1),
('Carlos Sainz', 3, 'Spain', 150, 0),
('Daniel Ricciardo', 4, 'Australia', 115, 1),
('Charles Leclerc', 3, 'Monaco', 95, 0),
('Lando Norris', 4, 'United Kingdom', 88, 0),
('Pierre Gasly', 5, 'France', 75, 0),
('Fernando Alonso', 6, 'Spain', 65, 0);