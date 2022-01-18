-- Activation de la BD
USE formation_cda_2022;

-- Création de la table
CREATE TABLE IF NOT EXISTS persons (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    last_name VARCHAR(30) NOT NULL,
    first_name VARCHAR(30) NOT NULL
);

-- Insertion de données
INSERT INTO persons (first_name, last_name)
VALUES 
('Ada', 'Lovelace'),
('Sinead', 'O''Connor'),
('Algernon', 'Lovelace');


-- suppression des données
DELETE FROM persons WHERE id=2;

-- modification des données
UPDATE persons SET first_name = 'Siobhan' WHERE id= 3;

-- affichage des données
SELECT * FROM persons WHERE last_name='Lovelace';

CREATE TABLE IF NOT EXISTS addresses (
    id SMALLINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    street VARCHAR(38) NOT NULL,
    zip_code CHAR(5) NOT NULL,
    city VARCHAR(33) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    order_date DATE NOT NULL,
    amount DECIMAL(6,2) NOT NULL
);

INSERT INTO orders (order_date, amount)
VALUES 
('2021-01-20', 45.88),
('2021-06-20', 20),
('2021-09-20', 50),
('2022-01-20', 80)
;

SELECT * FROM orders WHERE amount BETWEEN 20 AND 50;

SELECT * FROM orders WHERE order_date BETWEEN '2021-01-01' AND '2021-12-31';

INSERT INTO persons (first_name, last_name)
VALUES ('Angèle', 'Martin'), ('Isabelle', 'Martin'), ('Sébastien', 'Maloron');

SELECT * FROM persons WHERE first_name LIKE 'a%';

SELECT * FROM persons WHERE last_name IN ('Martin', 'Lovelace');

SELECT * FROM persons WHERE last_name != 'Martin';

DROP TABLE IF EXISTS `livres_simples`;
CREATE TABLE `livres_simples` (
`id` mediumint unsigned NOT NULL AUTO_INCREMENT,
`titre` varchar(80) NOT NULL,
`prix` decimal(5,2) NOT NULL,
`auteur` varchar(50) NOT NULL,
`editeur` varchar(50) NOT NULL,
`genre` varchar(50) NOT NULL,
`date_publication` date DEFAULT NULL,
`nationalite_auteur` varchar(50) DEFAULT NULL,
`langue` varchar(50) DEFAULT NULL,
`auteur_prenom` varchar(50) DEFAULT NULL,
`auteur_nom` varchar(50) DEFAULT NULL,
PRIMARY KEY (`id`)
);


SET foreign_key_checks = 0;
CREATE TABLE IF NOT EXISTS livres(
    `id` mediumint unsigned AUTO_INCREMENT,
    `titre` varchar(80) NOT NULL,
    `prix` decimal(5,2) NOT NULL,
    `date_publication` date DEFAULT NULL,
     id_auteur MEDIUMINT UNSIGNED,
     id_editeur MEDIUMINT UNSIGNED,
     id_genre MEDIUMINT UNSIGNED,
     id_langue MEDIUMINT UNSIGNED,
    PRIMARY KEY (`id`),
    CONSTRAINT livres_to_auteurs
        FOREIGN KEY (id_auteur)
        REFERENCES auteurs(id),
    CONSTRAINT livres_to_editeurs
        FOREIGN KEY (id_editeur)
        REFERENCES editeurs(id),
    CONSTRAINT livres_to_genres
        FOREIGN KEY (id_genre)
        REFERENCES genres(id),
    CONSTRAINT livres_to_langues
        FOREIGN KEY (id_langue)
        REFERENCES langues(id)
);

CREATE TABLE IF NOT EXISTS auteurs(
    `id` mediumint unsigned AUTO_INCREMENT,
    `prenom` varchar(50) DEFAULT NULL,
    `nom` varchar(50) DEFAULT NULL,
    `nationalite_auteur` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS editeurs(
    `id` mediumint unsigned AUTO_INCREMENT,
    `nom` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS genres(
    `id` mediumint unsigned AUTO_INCREMENT,
    `genre` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS langues(
    `id` mediumint unsigned AUTO_INCREMENT,
    `langue` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

TRUNCATE langues;
INSERT INTO langues (langue)  
(SELECT distinct langue FROM livres_simples);

TRUNCATE genres;
INSERT INTO genres (genre)  
(SELECT distinct genre FROM livres_simples);

TRUNCATE editeurs;
INSERT INTO editeurs (nom)  
(SELECT distinct editeur FROM livres_simples);

TRUNCATE auteurs;
INSERT INTO auteurs (nom, prenom, nationalite_auteur)  
(SELECT distinct auteur_nom, auteur_prenom, nationalite_auteur FROM livres_simples);

TRUNCATE livres;
INSERT INTO livres 
(titre, prix, date_publication, id_auteur, id_editeur, id_genre, id_langue)
(
    SELECT 
    titre, 
    prix, 
    date_publication, 
    a.id as auteur_id,
    e.id as editeur_id,
    g.id as genre_id,
    l.id as langue_id
    FROM livres_simples as ls
    JOIN auteurs as a ON a.nom = ls.auteur_noms
    JOIN editeurs as e ON e.nom = ls.editeur
    JOIN genres as g ON g.genre = ls.genre
    JOIN langues as l ON l.langue = ls.langue
);

SET foreign_key_checks = 1;

-- Requête avec jointures qui affiche toutes les infos des livres
CREATE OR REPLACE VIEW vue_livres AS
SELECT 
l.id, titre, prix, 
DATE_FORMAT(date_publication, '%d/%m/%Y') as date_edition,
FLOOR(DATEDIFF(NOW(), date_publication)/365.25) as age_du_livre,
a.nom, a.prenom, 
CONCAT_WS(' ', a.prenom, a.nom) as auteur,
a.nationalite_auteur,
e.nom as editeur,
g.genre, lg.langue
FROM livres as l
JOIN auteurs as a ON a.id = l.id_auteur
JOIN editeurs as e ON e.id = l.id_editeur
JOIN genres as g ON g.id = l.id_genre
JOIN langues as lg ON lg.id = l.id_langue;

SELECT * FROM vue_livres ORDER BY RAND() LIMIT 1;

-- compte du nombre de livres par année de publication
SELECT YEAR(date_publication) as annee, COUNT(*) as nb
FROM livres
GROUP BY annee;

-- Les livres édités pas Hachette
SELECT * FROM livres_simples WHERE editeur = 'Hachette';

-- les livres de Joe celko
SELECT * FROM livres_simples WHERE auteur = 'Joe Celko';

SELECT * FROM livres_simples
WHERE
auteur_prenom IS NULL;

SELECT * FROM livres_simples WHERE genre = 'Informatique' AND langue = 'Français';

SELECT * FROM livres_simples WHERE langue = 'Italien' OR langue = 'Castillan';

SELECT * FROM livres_simples WHERE langue IN ('Italien', 'Castillan');

SELECT * FROM livres_simples WHERE langue != 'Anglais' AND prix < 12
ORDER BY langue, genre LIMIT 3 OFFSET 6;

SELECT * FROM livres_simples;

-- ******************************
-- Agrégations
-- ******************************

SELECT count(*) FROM persons;

SELECT  
        editeur,
        sum(prix) as 'total', 
        avg(prix) 'moyenne', 
        min(prix) as 'min', 
        max(prix) as 'max',
        count(*) as nb,
        std(prix) as 'ecart_type'
FROM livres_simples
GROUP BY editeur
HAVING nb > 3;

SELECT genre, count(*) as nb
FROM livres_simples 
GROUP BY genre;

SELECT DISTINCT editeur FROM livres_simples
ORDER BY editeur;

SELECT count(distinct langue) FROM livres_simples;

SELECT editeur, count(distinct genre) as nb 
FROM livres_simples
GROUP BY editeur
HAVING nb > 2;

SELECT editeur, count(distinct langue) as nb 
FROM livres_simples
GROUP BY editeur
HAVING nb > 1;

SELECT last_name, first_name, count(*) as nb, max(id) as id FROM persons
GROUP BY last_name, first_name
HAVING nb > 1;

SELECT genre, count(*) as nb,
GROUP_CONCAT(distinct auteur ORDER BY auteur SEPARATOR ' : ') as 'auteurs'
FROM livres_simples 
GROUP BY genre;

-- ***********************
-- Liaison entre tables
-- ************************

-- Ajout de la clef étrangère
ALTER TABLE persons
ADD COLUMN address_id SMALLINT UNSIGNED;

INSERT INTO addresses (street, zip_code, city)
VALUES ('5 rue Orfila', '75020', 'Paris'),
('3 rue des granges', '25000', 'Besançon'),
('12 rue de Picpus', '75012', 'Paris');

SELECT persons.id as id_personne, first_name, last_name, city, addresses.id 
FROM persons, addresses 
WHERE persons.address_id = addresses.id;

SELECT 
p.id as id_personne, first_name, 
last_name, city, a.id as id_adresse
FROM persons as p 
LEFT JOIN addresses as a
ON p.address_id = a.id;
-- WHERE city = 'Paris';

-- Intégrité référentielle
ALTER TABLE persons ADD CONSTRAINT
persons_to_addresses
FOREIGN KEY (address_id)
REFERENCES addresses(id);


ALTER TABLE orders ADD COLUMN client_id INT UNSIGNED NOT NULL;

SELECT o.order_date, o.amount, p.first_name, p.last_name, a.city 
FROM orders as o
JOIN persons as p ON o.client_id = p.id
JOIN addresses as a ON p.address_id = a.id;

-- **************************
-- * Relations de plusieurs à plusieurs
-- **************************

CREATE TABLE IF NOT EXISTS teams (
    id SMALLINT UNSIGNED PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS team_members(
    team_id SMALLINT UNSIGNED,
    person_id INT UNSIGNED,
    role VARCHAR(30) NOT NULL,
    PRIMARY KEY (team_id, person_id)
);

INSERT INTO teams (name) VALUES ('CDA');

INSERT INTO team_members (team_id, person_id, role) VALUES
(1, 3, 'membre'),
(1, 9, 'membre'),
(1, 12, 'membre'),
(1, 15, 'Chef');