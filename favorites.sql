create table favorites
(
    id       bigint unsigned auto_increment
        primary key,
    title    text     not null,
    image    text     not null,
    anime_id int      not null,
    email    tinytext not null,
    constraint id
        unique (id)
)
    engine = MyISAM
    charset = utf8mb3;

INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (184, 'Kaguya-sama wa Kokurasetai? Tensai-tachi no Renai Zunousen', 'https://cdn.myanimelist.net/images/anime/1764/106659l.jpg', 40591, 'lakdar');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (182, 'Isekai Shoukan wa Nidome desu', 'https://cdn.myanimelist.net/images/anime/1387/134151l.jpg', 50220, 'lakdar');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (186, 'Dr. Stone: New World', 'https://cdn.myanimelist.net/images/anime/1785/131775l.jpg', 48549, 'lakdar.karabadja@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (177, 'Ousama Ranking: Yuuki no Takarabako', 'https://cdn.myanimelist.net/images/anime/1897/131615l.jpg', 52657, 'lakdar');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (185, 'Juubee-chan 2: Siberia Yagyuu no Gyakushuu', 'https://cdn.myanimelist.net/images/anime/7/20768l.jpg', 636, 'lakdar');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (178, '"Oshi no Ko"', 'https://cdn.myanimelist.net/images/anime/1812/134736l.jpg', 52034, 'lakdar.karabadja@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (179, 'Isekai Shoukan wa Nidome desu', 'https://cdn.myanimelist.net/images/anime/1387/134151l.jpg', 50220, 'lakdar.karabadja@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (195, 'Ousama Ranking: Yuuki no Takarabako', 'https://cdn.myanimelist.net/images/anime/1897/131615l.jpg', 52657, 'test@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (188, 'Kimetsu no Yaiba: Katanakaji no Sato-hen', 'https://cdn.myanimelist.net/images/anime/1297/133915l.jpg', 51019, 'allo');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (189, '"Oshi no Ko"', 'https://cdn.myanimelist.net/images/anime/1812/134736l.jpg', 52034, 'allo');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (190, 'Kimetsu no Yaiba: Katanakaji no Sato-hen', 'https://cdn.myanimelist.net/images/anime/1297/133915l.jpg', 51019, 'abdel@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (191, 'Jijou wo Shiranai Tenkousei ga Guigui Kuru.', 'https://cdn.myanimelist.net/images/anime/1350/133642l.jpg', 53621, 'abdel@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (192, 'Kimetsu no Yaiba: Katanakaji no Sato-hen', 'https://cdn.myanimelist.net/images/anime/1297/133915l.jpg', 51019, 'test@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (193, 'Kaguya-sama wa Kokurasetai? Tensai-tachi no Renai Zunousen', 'https://cdn.myanimelist.net/images/anime/1764/106659l.jpg', 40591, 'test@gmail.com');
INSERT INTO lakdou_lakdar.favorites (id, title, image, anime_id, email) VALUES (194, 'Tengoku Daimakyou', 'https://cdn.myanimelist.net/images/anime/1121/133132l.jpg', 53393, 'lakdar');
