--Creation des tables de la base de donnée

-- DROP TABLE paysinfo;
CREATE TABLE paysinfo (
    id int Primary key AUTO_INCREMENT,
    cca3 CHAR(3) not null unique,
    nompays VARCHAR(255) ,
    continent VARCHAR(30),
    wiki_link VARCHAR(500)
);

-- DROP TABLE users_stats;
CREATE TABLE users_stats (
    username VARCHAR(100) NOT NULL,
    score VARCHAR(5) NOT NULL,
    questionnaire VARCHAR(100) NOT NULL ,
    date_score TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (username, date_score)
);

-- DROP TABLE questionnaires;
CREATE TABLE questionnaires (
    id_q int Primary key AUTO_INCREMENT,
    p1 VARCHAR(3) NOT NULL,
    p2 VARCHAR(3) NOT NULL ,
    p3 VARCHAR(3) NOT NULL ,
    p4 VARCHAR(3) NOT NULL ,
    p5 VARCHAR(3) NOT NULL 
);

-- DROP TABLE users;
CREATE TABLE users (
    id int AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL ,
    d_insc TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
-- Il faudra s'inscrire avec admin/admin car le mot de passe est crypté
INSERT INTO users(username, password) VALUES ('admin', 'admin');*
