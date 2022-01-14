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

SELECT * FROM livres_simples