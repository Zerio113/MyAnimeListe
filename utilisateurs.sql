create table utilisateurs
(
    id      int auto_increment,
    name    varchar(32)  not null,
    surname varchar(32)  not null,
    email   varchar(100) not null,
    mdp     varchar(32)  not null,
    primary key (id, mdp)
)
    engine = MyISAM
    charset = utf8mb3;

INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (1, '', '', '', '');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (1, 'lakdar', 'lakdar', 'lakdar', 'lakdar');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (2, 'bg', 'bg', 'lakdar.karabadja@gmail.com', '95490dbgt');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (3, 'lakdou', 'lakdou', '', '');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (4, 'allo', 'allo', '', '');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (5, 'allo', '', '', 'allo');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (6, 'allo', '', '', 'allo');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (7, 'allo', '', '', 'allo');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (8, 'edris', 'edris', 'edris', 'edris');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (9, 'edris', 'edris', 'edris', 'edris');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (10, 'edris', 'edris', 'edris', 'edris');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (11, '', '', 'paikanadris@gmail.com', 'France33@');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (12, '', '', 'abdel@gmail.com', 'abdel');
INSERT INTO lakdou_lakdar.utilisateurs (id, name, surname, email, mdp) VALUES (13, '', '', 'test@gmail.com', 'test');
