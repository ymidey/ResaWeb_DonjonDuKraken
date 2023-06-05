-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 juin 2023 à 20:58
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae203`
--

-- --------------------------------------------------------

--
-- Structure de la table `sae203_categories`
--

DROP TABLE IF EXISTS `sae203_categories`;
CREATE TABLE IF NOT EXISTS `sae203_categories` (
  `ID_Categorie` int NOT NULL AUTO_INCREMENT,
  `Nom_categorie` varchar(255) NOT NULL,
  `Image_Categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sae203_categories`
--

INSERT INTO `sae203_categories` (`ID_Categorie`, `Nom_categorie`, `Image_Categorie`) VALUES
(1, 'Jeux d\'ambiance', 'Cat_Ambiance'),
(2, 'Escape Game', 'Cat_EscapeGame'),
(3, 'Stratégie', 'Cat_JeuCarte'),
(4, 'Jeux de cartes', 'Cat_JeuRole'),
(5, 'Jeux de rôle', 'Cat_Strategie');

-- --------------------------------------------------------

--
-- Structure de la table `sae203_evenements`
--

DROP TABLE IF EXISTS `sae203_evenements`;
CREATE TABLE IF NOT EXISTS `sae203_evenements` (
  `ID_Evenement` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Nb_Place` int NOT NULL,
  `Date_Creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Heure_Evenement` time NOT NULL,
  `Date_Evenement` date NOT NULL,
  `Prix_Evenement` int NOT NULL,
  `ID_Jeu` int NOT NULL,
  PRIMARY KEY (`ID_Evenement`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sae203_evenements`
--

INSERT INTO `sae203_evenements` (`ID_Evenement`, `Titre`, `Description`, `Nb_Place`, `Date_Creation`, `Heure_Evenement`, `Date_Evenement`, `Prix_Evenement`, `ID_Jeu`) VALUES
(1, 'Après-midi Monopoly', 'Venez jouer au jeu Monopoly pour une après-midi dans une ambiance chaleureuse et détendue.', 6, '2023-04-23 15:39:37', '14:30:00', '2023-06-19', 5, 4),
(2, 'Avant-Première - Ecarlate et Violet Évolutions à Paldea', 'Découvrez en avant-première la nouvelle série Pokemon : Evolution à Paldea. \n\nVous repartirez chez vous avec vos cartes.', 8, '2023-04-23 15:51:35', '17:30:00', '2023-07-06', 25, 3),
(3, 'Matinée La Bonne Paye', 'Venez découvrir le jeu La Bonne Paye, économisez et investissez !', 6, '2023-04-23 16:04:21', '10:00:00', '2023-07-08', 3, 1),
(4, 'Soirée Escape-Game - Le destin de londre', 'Jouez les détectives dans un Londre menacer par l\'explosion de quatre bombes. Communiquer et enquêter pour les désamorcer avant minuit ', 6, '2023-04-23 20:19:08', '17:30:00', '2023-06-12', 3, 5),
(5, 'Soirée Loup-Garous ', 'Venez participer à notre soirée jeu de rôle où nous allons jouer aux Loups-Garous de Thiercelieux.', 12, '2023-04-23 20:25:18', '21:00:00', '2023-06-14', 4, 6),
(6, 'Cluedo - Classique', 'Venez découvrir ou redécouvrir le jeu de société Cluedo. Allez-vous trouver qui a tué le docteur Samuel Lenoir, parmi les six suspects. ', 6, '2023-04-23 20:32:42', '20:30:00', '2023-07-13', 5, 9),
(7, 'Pandemic - Jouez les scientifiques', 'Venez jouer les scientifiques en équipe afin de sauver le monde d\'une terrible pandémie.', 4, '2023-04-24 08:05:55', '14:00:00', '2023-06-21', 6, 10),
(8, 'Avant-Première Yu-Gi-Oh Cyberstorm Access', 'Venez découvrir la nouvelle extension Yu-Gi-Oh : Cyberstorm Access.\n\nVous repartirez chez vous, avec vos cartes.', 8, '2023-04-24 08:17:53', '15:30:00', '2023-07-03', 25, 12),
(9, 'Flesh And Blood : OutSiders', 'Venez découvrir le TCG Flesh And Blood en langue française en jouant avec la nouvelle extension OutSiders.\n\nVous repartirez avec vos cartes.', 8, '2023-04-24 08:26:39', '17:00:00', '2023-07-27', 23, 13),
(10, 'Gestion et exploration : Catan', 'Venez découvrir lors d\'une après-midi le célèbre jeu Catan. Explorer des terres inconnues et fonder votre colonie.', 4, '2023-04-24 08:32:16', '15:00:00', '2023-06-27', 4, 14),
(11, 'Escape Game : Le cadavre de l\'Orient-Express', 'Venez jouer les détectives dans l\'Orient-Express. Arriverez-vous à trouver qui est le coupable ?', 6, '2023-04-24 08:37:12', '17:30:00', '2023-07-11', 3, 15),
(12, 'Matinée Skyjo', 'Venez découvrir lors d\'une matinée le jeu de société Skyjo.', 8, '2023-04-24 08:38:45', '09:00:00', '2023-06-27', 2, 17),
(13, 'La bibliothèque enchantée : Obscurio', 'Plongez dans l\'univers magique et mystérieux d\'Obscurio lors d\'une soirée.', 8, '2023-04-24 08:46:05', '19:30:00', '2023-07-02', 6, 18),
(14, 'FrostPunk le jeu de plateau', 'Venez découvrir le célèbre jeu vidéo FrostPunk en format jeu de société.', 4, '2023-04-24 08:48:14', '14:30:00', '2023-06-24', 7, 20),
(15, 'La maison de la poupée maudite', 'Venez découvrir l\'escape game : La maison de la poupée maudite.', 4, '2023-04-24 08:49:44', '17:00:00', '2023-06-29', 4, 16),
(16, 'Dieux de l\'Olympe : Hybris Disordered Cosmos', 'Venez découvrir ou redécouvrir le jeu de société Hybris : Disordered Cosmos.', 4, '2023-04-24 08:51:55', '17:00:00', '2023-07-14', 7, 19),
(17, 'Soirée Jungle Speed', 'Découvrez le jeu de société Jungle Speed lors d\'une après-midi détente et convivialité.', 6, '2023-04-24 08:56:55', '15:30:00', '2023-07-09', 2, 21),
(18, 'Escape-Game : Le destin de Londre', 'Jouez les détectives dans un Londre menacé par l\'explosion de quatre bombes. Communiquer et enquêter pour les désamorcer avant minuit.', 6, '2023-04-24 09:03:00', '10:30:00', '2023-06-26', 3, 5),
(19, 'Soirée Loups-Garous', 'Venez participer à notre soirée jeu de rôle où nous allons jouer aux Loups-Garous de Thiercelieux.', 12, '2023-04-24 09:05:27', '20:00:00', '2023-07-01', 4, 6),
(20, 'Après-midi Cluedo', 'Venez découvrir le célèbre jeu de société Cluedo dans sa version classique.', 6, '2023-04-24 09:13:00', '16:30:00', '2023-06-30', 5, 9);

-- --------------------------------------------------------

--
-- Structure de la table `sae203_jeux`
--

DROP TABLE IF EXISTS `sae203_jeux`;
CREATE TABLE IF NOT EXISTS `sae203_jeux` (
  `ID_Jeu` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(250) NOT NULL,
  `Image_Jeu` varchar(250) NOT NULL,
  `Age_Recommande` int NOT NULL,
  `Description_jeu` varchar(600) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`ID_Jeu`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sae203_jeux`
--

INSERT INTO `sae203_jeux` (`ID_Jeu`, `Nom`, `Image_Jeu`, `Age_Recommande`, `Description_jeu`) VALUES
(1, 'La bonne Paye', 'Jeu_LaBonnePaye', 8, 'La Bonne Paye est un jeu de société amusant et éducatif qui vous permettra de développer vos compétences financières tout en passant un bon moment en famille ou entre amis. Gagner votre salaire, payer vos impôts et vos factures, et acheter votre château en Espagne ! Alors n\'hésitez plus, lancez les dés et découvrez qui deviendra le plus riche de la partie !'),
(3, 'Pokemon ', 'Jeu_Pokemon', 10, 'Vous cherchez un jeu de cartes amusant et stratégique pour petits et grands ? Alors les cartes à jouer Pokémon sont faites pour vous ! Jouez avec des cartes à l\'effigie de vos créatures préférées tels que le célèbre Dracaufeu ou l\'incontournable Rayquaza ! Chaque carte à ses propres compétences et ses propres pouvoirs, la victoire ne dépendra pas de la chance mais de votre tactique et de votre créativité ! Avec des milliers de cartes différentes, chaque partie est une aventure unique qui vous emmènera dans un monde fantastique rempli de défis et de surprises !'),
(4, 'Monopoly', 'Jeu_Monopoly', 10, 'Plongez dans le monde du Monopoly et devenez un magnat de l\'immobilier ! Achetez des propriétés, construisez des hôtels et amassez une fortune. Jouez avec vos amis et votre famille pour des heures de divertissement assurées !'),
(5, 'DECKSCAPE – Le destin de Londres', 'Jeu_DeckScape_LeDestinDeLondre', 12, 'Une terrible menace plane sur Londres et la Couronne a besoin de votre aide ! Votre mission est de retrouver les quatre bombes cachées dans des endroits secrets de la ville et de les désamorcer avant minuit.\n \nVos amis et vous avez une mission top secrète : désamorcer les bombes avant qu\'elles n\'explosent ! \n\nEssayez de résoudre les énigmes originales de cette aventure et trouvez un moyen d\'en réchapper avant d\'être à court de temps.'),
(6, 'Les loups-garous de Thiercelieux', 'Jeu_LoupsGarous', 10, 'Les loups-garous de Thiercelieux est un jeu de société d\'ambiance mêlant bluff et déduction dans lequel chaque joueur incarne un rôle du camp du village ou du camp des loups-garous. Si vous faite parti du village, votre but sera de démasquer et de tuer tous les loups-garous à l\'aide de vos pouvoirs. Si vous êtes loup-garou votre but est d\'éliminer tous les villageois et ne pas se faire démasquer.'),
(9, 'Cluedo', 'Jeu_Cluedo', 8, 'Mener l\'enquête dans le jeu Cluedo, la patience et la déduction seront vos meilleurs alliés. Découvrez qui a tué le docteur Samuel Lenoir, parmi six suspects. Était-ce  Mlle Rose, la star de cinéma ? Ou bien Violet, le génie des mathématiques ? Dans quel pièce ? Et avec quelle arme ? Pour le découvrir, parcourez le pièces du manoir à la recherche d\'indices, posez les bonnes questions, au bon moments et élucider le mystère !'),
(10, 'Pandemic', 'Jeu_Pandemic', 14, 'Dans le jeu de société Pandemic vous ferez équipe avec les autres joueurs entant que spécialistes afin de sauver la planète de pandémies mortelles, avant qu\'il ne soit trop tard. Vous ne voudriez pas que votre chien Pilou décède, non ?'),
(11, 'Sherlock Holmes - Détective Conseil : Carlton House & Queen\'s Park', 'Jeu_SherlockHolmes_DetectiveConseil', 14, 'Devenez un véritable détective et plongez dans l\'univers captivant de Sherlock Holmes avec le jeu de société Détective Conseil : Carlton House & Queen\'s Park. Explorez les rues de Londres victorienne avec vos amis et résolvez des enquêtes complexes qui vous mettront à l\'épreuve. Avec des scénarios riches en rebondissements, ce jeu vous offrira une expérience immersive et inoubliable.'),
(12, 'Yu-Gi-Oh', 'Jeu_YuGiOh', 8, 'Avec des cartes qui représentent des créatures mythiques, des héros et des sorts magiques, Yu-Gi-Oh est un jeu de cartes qui vous fera plonger dans un monde de fantastique et d\'aventure. Partez à l\'aventure et triomphez de vos adversaires ! C\'est l\'heure du DU-DU-DU-DU-DUEL!'),
(13, 'Flesh & Blood', 'Jeu_FleshAndBlood', 16, 'Flesh and Blood est un jeu de cartes dans lequel vous et votre adversaire jouez deux Héros équipés d\'armes et de techniques propres à leur style de combat. Pour gagner, il vous faudra réduire les points de vie de votre adversaire à 0.\r\n\r\nPour parvenir à vos fins vous disposez d’un deck de 60 cartes. Un certain nombre de ces cartes sont spécifiquement restreintes à votre classe.\r\n\r\nEn plus de ces cartes, vous pouvez également renforcer votre héros avec des équipements à révéler en début de partie.\r\n\r\nVous disposez également de cartes d’actions, de réactions, de sorts et bien plus encore !'),
(14, 'Catan', 'Jeu_Catan', 8, 'Explorez des terres inconnues, fondez des colonies et bâtissez des villes prospères dans le jeu de société Catan. Affrontez vos amis et votre famille dans une course pour la domination de l\'île et utilisez votre ingéniosité pour collecter des ressources, négocier et échanger pour devenir le plus grand colonisateur de tous les temps !\n\nLe premier joueur à atteindre 10 points de victoire remporte la partie. Les points de victoire sont attribués pour la construction de colonies et de villes, pour la possession de la plus longue route et pour l\'achat de cartes de développement spéciales.'),
(15, 'EXIT : LE CADAVRE DE L’ORIENT-EXPRESS', 'Jeu_Exit_LeCadavre', 12, 'Embarquez dans l\'Orient-Express pour une expérience de jeu unique. Plongez dans une enquête complexe où chaque indice compte et où votre esprit d\'équipe sera mis à l\'épreuve. Ce jeu de société immersif offre une expérience de jeu palpitante où chaque choix peut faire la différence entre la réussite et l\'échec. Un meurtre, huit potentiels agresseurs mais aucun témoins, serez-vous capable de résoudre l\'enquête avec les indices laissés par le meurtrier avant que le train n\'arrive à Constantinople ?'),
(16, 'Escape the Room - La maison de poupée maudite', 'Jeu_Escape_TheRoom', 13, 'Préparez-vous à affronter vos plus grandes peurs en explorant la maison de poupée maudite. Cette imposante demeure semble avoir été figée dans le temps, mais ne vous y trompez pas : elle regorge d\'horribles secrets qu\'aucune être humain ne souhaiterais voir. Vous devrez user de votre courage et de votre intelligence pour déchiffrer les énigmes macabres disséminées dans chaque pièce. Mais attention, chaque pas que vous ferez pourrait être le dernier. Serez-vous assez courageux pour braver les ténèbres et découvrir les secrets de cette maison hantée ?'),
(17, 'Skyjo', 'Jeu_Skyjo', 8, 'Skyjo est un jeu amusant et facile à comprendre pour jouer en famille ou entre amis.\r\nLe but de Skyjo est de marquer le moins de points possible. Chaque joueur a une grille de 12 cartes cachées, dont deux sont révélées au début. À chaque tour, le joueur peut échanger une carte pour réduire son score ou révéler une carte de sa grille. Si une colonne de cartes de même valeur est créée, un Skyjo est réalisé, et la colonne est retirée de la grille. La partie prend fin lorsqu\'un des joueurs a révélé toutes ses cartes, les autres joueurs comptent alors leurs points restants. '),
(18, 'Obscurio', 'Jeu_Obscurio', 10, 'Plongez dans l\'univers magique et mystérieux d\'Obscurio, un jeu de société coopératif qui vous transporte dans une bibliothèque enchantée. Vous devrez collaborer pour retrouver votre chemin parmi 6 salles labyrinthique entièrement identique, tout en déjouant les pièges tendus par un traître parmi vous. Parviendrez-vous à trouver la sorti avant qu\'il ne soit trop tard ? Pas si sûr, surtout si un traître agissant pour le compte du sorcier commence à semer le trouble.'),
(19, 'Hybris : Disordered Cosmos', 'Jeu_HybrisDisorderedCosmos', 14, 'Dans Hybris : Disordered Cosmos chaque joueur incarne un des dieux en devenir d\'Olympe, encore méconnu des mortels et doté encore de pouvoirs limités. Pour remporter la partie, le joueur devra débloquer tout toutes ses pouvoirs (appelés améliorations) pour assoir directement sa divinité et donc remporté la partie, ou le plus de points de victoire pour prouver son autorité sur le monde des mortels. La carte du monde des mortels est représentée par six lieux emblématiques, à savoir le mont Olympe, la Forge, l\'Oracle, les Enfers, le Colisée et les Moires.'),
(20, 'Frostpunk: le Jeu de Plateau', 'Jeu_Frostpunk', 14, 'Dans Frostpunk : le Jeu de Plateau, vous jouerez les rôle de rôle de gouverneurs, à l\'aide de vos coéquipier, vous devrez gérer une ville en plein hiver apocalyptique en prenant des choix difficiles pour assurer la survie de vos citoyens.\nChaque action à ses conséquences. Que vous soyez un amateur de jeux de stratégie ou un novice en la matière, ce jeu de société captivant vous tiendra en haleine du début à la fin. Alors, prêt à relever le défi de Frostpunk ?'),
(21, 'Jungle Speed', 'Jeu_JungleSpeed', 7, 'Jungle Speed est un jeu de société amusant en famille ou entre ami où vitesse, réflexes et observation sont de mise. Observez les cartes posées et soyez le (ou la) plus rapide à attraper le totem quand les formes ou les couleurs correspondent. Mais attention, les cartes se ressemblent souvent, ce qui vous mettra rapidement les nerfs à vif ! Pour gagner, récupérez toutes les cartes de vos adversaires! ');

-- --------------------------------------------------------

--
-- Structure de la table `sae203_lien_evenementsreservations`
--

DROP TABLE IF EXISTS `sae203_lien_evenementsreservations`;
CREATE TABLE IF NOT EXISTS `sae203_lien_evenementsreservations` (
  `ID_Evenement` int NOT NULL,
  `Nb_participant` int NOT NULL,
  `ID_Reservation` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sae203_lien_jeuxcategories`
--

DROP TABLE IF EXISTS `sae203_lien_jeuxcategories`;
CREATE TABLE IF NOT EXISTS `sae203_lien_jeuxcategories` (
  `ID_Jeu` int NOT NULL,
  `ID_Categorie` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `sae203_lien_jeuxcategories`
--

INSERT INTO `sae203_lien_jeuxcategories` (`ID_Jeu`, `ID_Categorie`) VALUES
(1, 1),
(3, 3),
(3, 4),
(4, 3),
(5, 2),
(5, 5),
(6, 1),
(6, 3),
(6, 5),
(9, 5),
(10, 3),
(11, 2),
(11, 5),
(12, 3),
(12, 4),
(13, 3),
(13, 4),
(14, 3),
(15, 2),
(15, 5),
(16, 2),
(17, 1),
(17, 4),
(18, 1),
(18, 2),
(18, 6),
(18, 7),
(18, 9),
(19, 3),
(19, 5),
(19, 6),
(19, 8),
(20, 3),
(20, 6),
(20, 8),
(20, 9),
(21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sae203_reservations`
--

DROP TABLE IF EXISTS `sae203_reservations`;
CREATE TABLE IF NOT EXISTS `sae203_reservations` (
  `ID_Reservation` int NOT NULL AUTO_INCREMENT,
  `Nom_Client` varchar(255) NOT NULL,
  `Prenom_Client` varchar(255) NOT NULL,
  `Adressemail_Client` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `PrixTotal` int NOT NULL,
  `Date_Reservation` date NOT NULL,
  PRIMARY KEY (`ID_Reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
