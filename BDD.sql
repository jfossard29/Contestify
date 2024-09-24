-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 31 mars 2023 à 15:29
-- Version du serveur : 10.5.12-MariaDB-0+deb11u1
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zdl3-zfossarje_1`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`zfossarje`@`%` PROCEDURE `ActualiteDernierConcours` ()   BEGIN
 SET @organisateur = (SELECT cpti_pseudo FROM tab_compteorg_cpto JOIN tab_concours_ccr USING (cpti_pseudo) WHERE ccr_id = dernierconcours());
 SET @titre = (SELECT ccr_titre FROM tab_concours_ccr WHERE ccr_id = dernierconcours());
 SET @date = (SELECT ccr_date FROM tab_concours_ccr WHERE ccr_id = dernierconcours());
 SET @texte = CONCAT("Le concours ",@titre,", commencera le ",DATE_FORMAT(@date, '%d/%m/%Y'), "...","Retrouvez toutes les informations bientôt");
 INSERT INTO tab_actualite_act VALUES(NULL,@organisateur,@titre,@texte,CURDATE(),"C");
END$$

--
-- Fonctions
--
CREATE DEFINER=`zfossarje`@`%` FUNCTION `dernierconcours` () RETURNS INT(11)  BEGIN
 RETURN (SELECT MAX(ccr_id) FROM tab_concours_ccr);
END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `donnercodeinscription` (`id` INT) RETURNS VARCHAR(20) CHARSET utf8  RETURN (SELECT cdt_codeinscription FROM tab_candidature_cdt WHERE cdt_id = id)$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `donneridcandidat` (`codeins` VARCHAR(20), `codeid` VARCHAR(8)) RETURNS INT(11)  BEGIN
RETURN (SELECT cdt_id 
    FROM tab_candidature_cdt
    WHERE cdt_codeinscription = codeins
    AND cdt_codeidentification = codeid);
END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `donnerjury` (`IDC` INT) RETURNS VARCHAR(1000) CHARSET utf8  BEGIN
    DECLARE concatene VARCHAR(1000) DEFAULT '';
    SELECT GROUP_CONCAT(CONCAT( pfl_prenom, ' ', pfl_nom, ' pour la discipline ', pfl_discipline) SEPARATOR '; ')
    INTO concatene
    FROM tab_ccrjury_ccj
    JOIN tab_profil_pfl using (pfl_id)
    WHERE tab_ccrjury_ccj.ccr_id = IDC;
    RETURN concatene;
END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `donnerprenomjury` (`ID` INT) RETURNS TEXT CHARSET utf8  BEGIN
RETURN (SELECT pfl_prenom
FROM tab_concours_ccr 
JOIN tab_ccrjury_ccj USING (ccr_id)
JOIN tab_profil_pfl USING (pfl_id)
       WHERE ccr_id=ID);

END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `EtatCandidat` (`ID` INT) RETURNS TEXT CHARSET utf8  BEGIN
SET @retour = (SELECT 
CASE
	   WHEN cdt_etat = 'E' THEN 'Envoyée'
       WHEN cdt_etat = 'F' THEN 'Refusée'
       WHEN cdt_etat = 'R' THEN 'Acceptée'
END AS etat
FROM tab_candidature_cdt
WHERE cdt_id = ID);

RETURN @retour;
END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `nomphaseconcours` (`ID` INT) RETURNS TEXT CHARSET utf8  BEGIN
SET @retour = (SELECT 
CASE
	   WHEN CURDATE() < ccr_date THEN 'A venir'
       WHEN CURDATE() <= ccr_dteinscription THEN 		'Inscription'
       WHEN CURDATE() <= ccr_dtepreselection THEN 		 'selection'
       WHEN CURDATE() <= ccr_dtefinaliste THEN
       'finale'
       WHEN CURDATE() >= ccr_dtefinaliste THEN 		   'terminée'
END AS phase_actuelle
FROM tab_concours_ccr
WHERE ccr_id = ID);

RETURN @retour;
END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `verificationcandidat` (`inscription` VARCHAR(20)) RETURNS INT(11)  BEGIN
RETURN (SELECT count(*) 
    FROM tab_candidature_cdt
    WHERE cdt_codeinscription = inscription);
END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `verificationcompte` (`pseudo` VARCHAR(20), `mdp` CHAR(64)) RETURNS INT(11)  BEGIN
RETURN (SELECT count(*) FROM tab_compteinfo_cpti WHERE cpti_pseudo =pseudo AND cpti_password = mdp);


END$$

CREATE DEFINER=`zfossarje`@`%` FUNCTION `verifierinformationexistant` (`pseudo` VARCHAR(20), `mail` VARCHAR(300)) RETURNS VARCHAR(10) CHARSET utf8  BEGIN

SET @mailverif = (SELECT count(pfl_mail) FROM tab_profil_pfl WHERE pfl_mail = mail);
SET @pseudoverif = (SELECT count(cpti_pseudo) FROM tab_profil_pfl WHERE cpti_pseudo = pseudo);
IF @mailverif > 0 AND @pseudoverif > 0 THEN
	 SET @retour = ('deux');
ELSEIF @mailverif > 0 THEN
     SET @retour = ('mail');
ELSEIF @pseudoverif > 0 THEN
     SET @retour = ('pseudo');
ELSE
     SET @retour = ('ok');
END IF;

RETURN @retour;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_actualite_act`
--

CREATE TABLE `tab_actualite_act` (
  `act_id` int(11) NOT NULL,
  `cpti_pseudo` varchar(20) NOT NULL,
  `act_titre` varchar(200) NOT NULL,
  `act_texte` varchar(500) NOT NULL,
  `act_date` date NOT NULL,
  `act_etat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_actualite_act`
--

INSERT INTO `tab_actualite_act` (`act_id`, `cpti_pseudo`, `act_titre`, `act_texte`, `act_date`, `act_etat`) VALUES
(21, 'LucieV', 'On fête nos 3 ans !', 'Aujourd hui nous fêtons l anniversaire de Contestify !...', '2023-01-26', 'P'),
(22, 'LucieV', 'Venez nous voir à Paris !', 'Journée dédicace pour les gagnants...', '2022-01-17', 'P'),
(23, 'NicolasR', 'Comment ça marche ?', 'Pourquoi participer aux concours ? Et bien...', '2021-06-14', 'C'),
(24, 'RozennD', 'c\'est l\'occasion à ne pas manquer !', 'Un grand évènement est en approche ! Venez nous rejoindre !', '2022-04-20', 'P'),
(25, 'organisateur', 'Les inscriptions sont là !', 'Le concours Test Inscription, commencera le 19/03/2023...Retrouvez toutes les informations bientôt', '2023-03-21', 'C'),
(26, 'RozennD', 'Rêve', 'Le concours Rêve, commencera le 19/03/2025...Retrouvez toutes les informations bientôt', '2023-03-21', 'C'),
(27, 'StephenK', 'La finalité', 'Le concours La finalité, commencera le 20/04/2023...Retrouvez toutes les informations bientôt', '2023-03-27', 'C');

-- --------------------------------------------------------

--
-- Structure de la table `tab_candidature_cdt`
--

CREATE TABLE `tab_candidature_cdt` (
  `cdt_id` int(11) NOT NULL,
  `cat_nom` varchar(200) NOT NULL,
  `ccr_id` int(11) NOT NULL,
  `cdt_nom` varchar(80) NOT NULL,
  `cdt_prenom` varchar(80) NOT NULL,
  `cdt_mail` varchar(300) NOT NULL,
  `cdt_codeinscription` varchar(20) NOT NULL,
  `cdt_codeidentification` varchar(8) NOT NULL,
  `cdt_etat` char(1) NOT NULL,
  `ccr_concours` varchar(45) NOT NULL,
  `cdt_blio` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_candidature_cdt`
--

INSERT INTO `tab_candidature_cdt` (`cdt_id`, `cat_nom`, `ccr_id`, `cdt_nom`, `cdt_prenom`, `cdt_mail`, `cdt_codeinscription`, `cdt_codeidentification`, `cdt_etat`, `ccr_concours`, `cdt_blio`) VALUES
(3, 'Major (+18)', 1, 'Vererie', 'John', 'JoV@hotmail.fr', 'fzjGH9dWjVe9LBgIjesZ', 'yhFy5FLE', 'F', 'A vos marques ?', 'Je n ai rien écris'),
(4, 'écrit', 1, 'Fossard', 'Valentin', 'ValentinF@hotmail.com', 'CecZt8mx5134JrbH84Fs', 'ARlgY5dY', 'F', 'A vos marques ?', NULL),
(5, 'Libre', 1, 'Luc', 'Bertelot', 'LBertelot@hotmail.fr', 'NouGbPks84eNw8sF0xhH', 'mLEsTWwe', 'R', 'A vos marques ?', 'Je suis l auteur de trois livres actuellement toujours sur le marché'),
(6, 'écrit', 1, 'Hervieux', 'Titouan', 'Titouan.Hervieux@hotmail.fr', '3m2gn3qYt6LbUAdyfWND', 'nPgPa2ld', 'R', 'A vos marques ?', 'J écris pour me faire plaisir'),
(7, 'Junior (-18)', 2, 'Rique', 'Killian', 'LeBatracien@hotmail.fr', 'YV5zBmRtNlGCiQIXJq3y', '59Rgb7ME', 'E', 'Concours Junior', 'Je n ai pas écris de livres, mais...'),
(8, 'Junior (-18)', 2, 'Michel', 'Jean', 'JeanMichel21@hotmail.fr', 'YADKFWpvKlmKCXlQQJaY', 'XsFXJf18', 'R', 'Concours Junior', NULL),
(9, 'Junior (-18)', 2, 'Renavo', 'sullyvan', 'DarkVador@hotmail.com', 'bhDAHnTUk3wQB6g4OsFw', 'M1H7QWUf', 'R', 'Concours Junior', 'Je connais quelqu un'),
(10, 'Junior (-18)', 2, 'Triche', 'Emma', 'EmmaT@hotmail.com', 'peFhm3DhS8wMKoD6QtbU', '1h4tqeE7', 'R', 'Concours Junior', 'Je voudrais devenir...'),
(11, 'Junior (-18)', 2, 'Caheur', 'Mike', 'Truxie@hotmail.com', 'Nx09T7vZh0h8ILGJlf3L', '3A3x7ROu', 'F', 'Concours Junior', NULL),
(12, 'Junior (-18)', 2, 'Abdel', 'Mohammed', 'Liza1234@hotmail.fr', '4oyvpwt4NFOjUWOMM0V4', 'PT7SvSrz', 'F', 'Concours Junior', 'J ai pour rêve de...'),
(15, 'Réaliste', 13, 'Smith', 'Alice', 'alice.smith@example.com', 'Z2xN8cH7mR1tF9bV5pJ', 'S5gT8xW2', 'R', 'Fin du monde', NULL),
(17, 'Réaliste', 17, 'Garcia', 'Maria', 'maria.garcia@example.com', 'R3fG1hT8kU2jD9nS6zP', 'P3kT6rF5', 'E', 'Fin du monde', NULL),
(19, 'Réaliste', 13, 'Wang', 'Sophia', 'sophia.wang@example.com', 'Q8dP7sZ3xN6cT2fR1v', 'K6pB9fX8', 'F', 'Fin du monde', NULL),
(21, 'Réaliste', 13, 'Kim', 'Sarah', 'sarah.kim@example.com', 'A1qS5eR8wF6hT4mG3y', 'R4hK6mE9', 'R', 'Fin du monde', NULL),
(23, 'Réaliste', 13, 'Liu', 'Eric', 'eric.liu@example.com', 'B8vN7fT6gJ5hK4pM1c', 'G4jS7pN8', 'E', 'Fin du monde', NULL),
(25, 'Digital', 3, 'Martin', 'Pierre', 'pierre.martin@email.com', 'Z3nF9vX1mR5hK7lP2qW', 'aBcD4eF6', 'R', 'I m a Steampunk', 'Le guide de la Science-Fiction'),
(26, 'Steampunk', 3, 'Dupont', 'Julie', 'julie.dupont@email.com', 'H6bW8sF1xV7dR2zN5kY', 'gHiJ9kL3', 'R', 'I m a Steampunk', NULL),
(27, 'Steampunk', 3, 'Lefebvre', 'Luc', 'luc.lefebvre@email.com', 'L3pA1vC9nM7rT6gB5sX', 'iJkL2mN4', 'R', 'I m a Steampunk', 'Les voyages extraordinaires'),
(28, 'Digital', 3, 'Dubois', 'Sophie', 'sophie.dubois@email.com', 'V2hT3cL7jP4dF8sR1qA', 'eFgH5iJ9', 'R', 'I m a Steampunk', NULL),
(29, 'Steampunk', 3, 'Leclerc', 'François', 'francois.leclerc@email.com', 'Q1wE5rT8yH2mK3nD7a', 'oPqR4sT6', 'R', 'I m a Steampunk', NULL),
(30, 'Digital', 17, 'Moreau', 'Thomas', 'thomas.moreau@email.com', 'B2zV5nM8xS7aT4hJ1f', 'uVwX3yZ4', 'R', 'I m a Steampunk', NULL),
(31, 'Steampunk', 3, 'Roux', 'Aurélie', 'aurelie.roux@email.com', 'N4yV7sT3pK9fR1xL6h', 'bCdE2fG5', 'R', 'I m a Steampunk', 'Le guide de la culture steampunk'),
(32, 'Digital', 3, 'Girard', 'Jean', 'jean.girard@email.com', 'F5xJ9rP6tN7hA2bZ1v', 'iJkL2mN4', 'R', 'I m a Steampunk', NULL),
(33, 'Futuriste', 15, 'Dupont', 'Anne', 'anne.dupont@gmail.com', '1DfiKLwYj3qJ3RRZpkp9', 'XjPf8G2H', 'E', 'Objectif Mars', NULL),
(35, 'écrit', 15, 'Nguyen', 'Thierry', 'thierry.nguyen@gmail.com', 'mqGVWEnY8DsiHzuBXbPo', 'v5A5A5qP', 'E', 'Objectif Mars', NULL),
(37, 'écrit', 15, 'Lefevre', 'Guillaume', 'guillaume.lefevre@gmail.com', '0Jz6BoGQ6jyfd3Dq9hEn', 'rt8Zn6dM', 'E', 'Objectif Mars', NULL),
(38, 'Futuriste', 15, 'Girard', 'Hugo', 'hugo.girard@hotmail.com', 'A7tTKu15tKbX9gO1KKZm', 'EIVmuc19', 'E', 'Objectif Mars', NULL),
(39, 'écrit', 17, 'Roussel', 'Elodie', 'elodie.roussel@yahoo.fr', 'tAx8kpLaDYI2lFlrH1lT', 'ZBvJaEoe', 'E', 'Objectif Mars', NULL),
(40, 'Futuriste', 15, 'Martin', 'Jean', 'jean.martin@gmail.com', 'NTk2U6iDWl6fXGq3OH0A', 'N6oZvNpN', 'E', 'Objectif Mars', NULL),
(41, 'écrit', 15, 'Simon', 'Morgane', 'morgane.simon@hotmail.com', '5FL8g5aA6XH5S5Ch5ceJ', 'jvG08E4Q', 'E', 'Objectif Mars', NULL),
(42, 'Futuriste', 15, 'Lambert', 'Sophie', 'sophie.lambert@yahoo.fr', 'Iu28XN9sCk0J39Q0l1us', 'Ro3bq0lG', 'E', 'Objectif Mars', NULL),
(43, 'Libre', 17, 'Fossard', 'Jérémy', 'Jeremyfossard@hotmail.fr', 'AoV4ErTuE7grao7Kl4sZ', 'EpL4axwZ', 'R', 'la Finalité', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tab_categorie_cat`
--

CREATE TABLE `tab_categorie_cat` (
  `cat_nom` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_categorie_cat`
--

INSERT INTO `tab_categorie_cat` (`cat_nom`) VALUES
('Digital'),
('écrit'),
('Futuriste'),
('Horreur'),
('Junior (-18)'),
('Libre'),
('Major (+18)'),
('Medieval'),
('Original'),
('Réaliste'),
('Steampunk');

-- --------------------------------------------------------

--
-- Structure de la table `tab_ccrcategorie_ccc`
--

CREATE TABLE `tab_ccrcategorie_ccc` (
  `cat_nom` varchar(200) NOT NULL,
  `ccr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_ccrcategorie_ccc`
--

INSERT INTO `tab_ccrcategorie_ccc` (`cat_nom`, `ccr_id`) VALUES
('Digital', 3),
('écrit', 1),
('écrit', 15),
('Futuriste', 13),
('Futuriste', 15),
('Junior (-18)', 1),
('Junior (-18)', 2),
('Libre', 1),
('Libre', 17),
('Major (+18)', 1),
('Original', 1),
('Réaliste', 13),
('Steampunk', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tab_ccrjury_ccj`
--

CREATE TABLE `tab_ccrjury_ccj` (
  `ccr_id` int(11) NOT NULL,
  `pfl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_ccrjury_ccj`
--

INSERT INTO `tab_ccrjury_ccj` (`ccr_id`, `pfl_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 4),
(12, 7),
(15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tab_compteinfo_cpti`
--

CREATE TABLE `tab_compteinfo_cpti` (
  `cpti_pseudo` varchar(20) NOT NULL,
  `cpti_password` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_compteinfo_cpti`
--

INSERT INTO `tab_compteinfo_cpti` (`cpti_pseudo`, `cpti_password`) VALUES
('CharlesH', '329b7701e590e8f301b87f189b47203bdc76908a9a29fb8829b51f65fafd32a7'),
('connoJ', '22fbfb64a60e388035a4736a8af654fe3dbd499521ffe90ce3d805fb0e72d82e'),
('jackE', '9a48f4c439c535d7e1b78e194e2f9f481512aaccb8262f2db5c12e52c7a0f454'),
('JosephA', '07babfa451e6d0656e6b71dbdf190300141af29f9a162027b8de6d067d82333b'),
('JustineM', 'a40edf68e6c480add625000b8738596f5d6049617280e6b157b0e7daa8828e7e'),
('LucieV', '6d9f38bf079a971df208c9174aa07c077f1f30e625dc040127f1c320dfb1c398'),
('NicolasR', '40897b02df4571055835f08c4272a7921e8021ed88fe06a436fea98c3d42a84b'),
('organisateur', '493c514c69c93238b7fc46923314cfa34a8e08ad9430628bb7497292962f2fe4'),
('Pharris', '606a6a6088884596e29938d1c8911a9cd1aeaf29ecd26f986ed31e3f7821b3ad'),
('RozennD', '0ab83b19076cf80776297391c932f88ce6b4435ff6be6fc6916311283488c887'),
('SashaG', '6c04a8aa88fa4b4e06e324a325fb5dbeb902cb19a671123c9145aae034281b66'),
('StephenK', 'f48a06f306e0db19a70765cc939b79c58b089d05b12b772e3f9110083630c57e'),
('TitouanG', 'e31c6872a187164341d9d4340e3ed08a1a3887390f66bf0ba213dd9c87de262c');

-- --------------------------------------------------------

--
-- Structure de la table `tab_compteorg_cpto`
--

CREATE TABLE `tab_compteorg_cpto` (
  `cpti_pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_compteorg_cpto`
--

INSERT INTO `tab_compteorg_cpto` (`cpti_pseudo`) VALUES
('LucieV'),
('NicolasR'),
('organisateur'),
('RozennD'),
('StephenK');

-- --------------------------------------------------------

--
-- Structure de la table `tab_concours_ccr`
--

CREATE TABLE `tab_concours_ccr` (
  `ccr_id` int(11) NOT NULL,
  `cpti_pseudo` varchar(20) NOT NULL,
  `ccr_date` date NOT NULL,
  `ccr_titre` varchar(200) NOT NULL,
  `ccr_texte` varchar(500) NOT NULL,
  `ccr_dteinscription` date NOT NULL,
  `ccr_dtepreselection` date NOT NULL,
  `ccr_dtefinaliste` date NOT NULL,
  `ccr_etat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_concours_ccr`
--

INSERT INTO `tab_concours_ccr` (`ccr_id`, `cpti_pseudo`, `ccr_date`, `ccr_titre`, `ccr_texte`, `ccr_dteinscription`, `ccr_dtepreselection`, `ccr_dtefinaliste`, `ccr_etat`) VALUES
(1, 'rozennD', '2020-01-10', 'A vos marques ?', 'Dans ce concours, vous choisissez...', '2021-03-10', '2021-03-11', '2021-03-12', 'R'),
(2, 'organisateur', '2020-03-01', 'Concours Junior', 'Pour les moins de 18 ans seulement', '2020-03-02', '2020-03-10', '2020-03-15', 'R'),
(3, 'NicolasR', '2023-03-01', 'I m a Steampunk', 'Ici, laissez libre cours...', '2023-03-02', '2023-03-03', '2024-05-08', 'F'),
(4, 'LucieV', '2023-08-25', 'Imaginez si...', 'Que se passerait-il si l histoire que nous connaissions...', '2023-08-28', '2023-09-08', '2023-09-09', 'R'),
(12, 'NicolasR', '2023-01-16', 'L\'idée des rêves', 'Avez-vous déjà rêvée de quelque chose d\'inexplicable ? De géant ? Partagez-nous vos aventures secrètes', '2023-02-22', '2023-04-23', '2023-05-24', 'P'),
(13, 'organisateur', '2023-03-12', 'Fin du monde', 'Comment imaginez-vous la fin de vôtre monde ? Serait-il chaotique, expéditif, inespéré ? Faites-le nous savoir !', '2023-03-14', '2024-02-23', '2024-02-24', 'P'),
(14, 'LucieV', '2023-02-16', 'Le futur...', 'Le futur est un concept intriguant Quelle est vôtre vision des choses ?', '2023-04-20', '2025-02-23', '2025-02-24', 'P'),
(15, 'organisateur', '2023-03-19', 'Objectif Mars', 'Test pour l\'affichage d\'un concours en phase d\'inscription', '2023-04-29', '2029-03-07', '2034-03-24', 'P'),
(16, 'RozennD', '2025-03-19', 'Rêve', 'Quand-est-ce la dernière fois que vous avez rêvés ?', '2025-03-20', '2029-03-07', '2034-03-24', 'P'),
(17, 'StephenK', '2023-02-20', 'La finalité', 'La finalité, qque vous inspire-t-elle ?', '2023-03-15', '2023-03-16', '2023-05-17', 'P');

--
-- Déclencheurs `tab_concours_ccr`
--
DELIMITER $$
CREATE TRIGGER `dernieractu` AFTER INSERT ON `tab_concours_ccr` FOR EACH ROW CALL ActualiteDernierConcours()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tab_document_doc`
--

CREATE TABLE `tab_document_doc` (
  `doc_id` int(11) NOT NULL,
  `cdt_id` int(11) NOT NULL,
  `doc_chemin` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_document_doc`
--

INSERT INTO `tab_document_doc` (`doc_id`, `cdt_id`, `doc_chemin`) VALUES
(30, 5, 'carteNouGbPks84eNw8sF0xhH.jpg'),
(31, 5, 'AttestationNouGbPks84eNw8sF0xhH.png'),
(32, 6, 'identite3m2gn3qYt6LbUAdyfWND.png'),
(33, 6, 'Maison3m2gn3qYt6LbUAdyfWND.png'),
(36, 9, 'cartedidentiteebhDAHnTUk3wQB6g4OsFw.png'),
(37, 9, 'attestationdedomicilebhDAHnTUk3wQB6g4OsFw.png'),
(38, 10, 'cartedidentiteepeFhm3DhS8wMKoD6QtbU.png'),
(39, 10, 'attestationdedomicilepeFhm3DhS8wMKoD6QtbU.png'),
(42, 3, 'cartefzjGH9dWjVe9LBgIjesZ.png'),
(43, 4, '1CecZt8mx5134JrbH84Fs.png'),
(44, 4, '2CecZt8mx5134JrbH84Fs.png'),
(45, 11, 'telechargementNx09T7vZh0h8ILGJlf3L.png'),
(46, 11, 'carte (1)Nx09T7vZh0h8ILGJlf3L.png'),
(51, 7, 'cartedidentiteeYV5zBmRtNlGCiQIXJq3y.png'),
(52, 7, 'cartedidentiteeYV5zBmRtNlGCiQIXJq3y.png'),
(60, 21, 'mp4A1qS5eR8wF6hT4mG3y.mp4'),
(62, 21, 'pngA1qS5eR8wF6hT4mG3y.png'),
(63, 21, 'jpegA1qS5eR8wF6hT4mG3y.jpeg'),
(67, 25, 'jpgZ3nF9vX1mR5hK7lP2qW.jpg'),
(68, 25, 'pngZ3nF9vX1mR5hK7lP2qW.png'),
(69, 43, 'pngAoV4ErTuE7grao7Kl4sZ.png'),
(70, 43, 'jpgAoV4ErTuE7grao7Kl4sZ.jpg'),
(71, 43, 'pdfAoV4ErTuE7grao7Kl4sZ.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `tab_fil_fil`
--

CREATE TABLE `tab_fil_fil` (
  `fil_id` int(11) NOT NULL,
  `cpti_pseudo` varchar(20) NOT NULL,
  `ccr_id` int(11) NOT NULL,
  `fil_titre` varchar(200) NOT NULL,
  `fil_description` varchar(200) DEFAULT NULL,
  `fil_etat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_fil_fil`
--

INSERT INTO `tab_fil_fil` (`fil_id`, `cpti_pseudo`, `ccr_id`, `fil_titre`, `fil_description`, `fil_etat`) VALUES
(1, 'SashaG', 1, 'Concours \"A vos marques !\"', 'Discussion', 'F'),
(2, 'LucieV', 4, 'Concernant les dates du prochain concours', NULL, 'O'),
(3, 'RozennD', 4, 'Liste des candidatures intéressantes pour \"Imaginez si...\"', 'Discussion', 'O');

-- --------------------------------------------------------

--
-- Structure de la table `tab_message_mes`
--

CREATE TABLE `tab_message_mes` (
  `mes_id` int(11) NOT NULL,
  `fil_id` int(11) NOT NULL,
  `mes_texte` varchar(100) NOT NULL,
  `mes_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_message_mes`
--

INSERT INTO `tab_message_mes` (`mes_id`, `fil_id`, `mes_texte`, `mes_date`) VALUES
(1, 3, 'Bonjour, cette discussion est dedié pour les candidatures de...', '2020-10-01 00:00:00'),
(2, 3, 'Bonsoir, cette candidature semble intéressante pour le concours, qu\'en dites-vous ?', '2020-10-02 00:00:00'),
(3, 1, 'Bonjour, Bonsoir. Le concours débutera dans quelques jours, je vous invite...', '2021-04-20 00:00:00'),
(4, 1, 'Pour plus de précisions, vous pouvez m\'appeller', '2021-04-20 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `tab_note_nte`
--

CREATE TABLE `tab_note_nte` (
  `pfl_id` int(11) NOT NULL,
  `cdt_id` int(11) NOT NULL,
  `note_nte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_note_nte`
--

INSERT INTO `tab_note_nte` (`pfl_id`, `cdt_id`, `note_nte`) VALUES
(1, 5, 14),
(1, 6, 10),
(2, 5, 13),
(2, 6, 11),
(2, 8, 14),
(2, 9, 15),
(2, 10, 18),
(2, 12, 14),
(4, 5, 16),
(4, 6, 8),
(4, 8, 16),
(4, 9, 10),
(4, 10, 13),
(4, 12, 19);

-- --------------------------------------------------------

--
-- Structure de la table `tab_profil_pfl`
--

CREATE TABLE `tab_profil_pfl` (
  `pfl_id` int(11) NOT NULL,
  `cpti_pseudo` varchar(20) NOT NULL,
  `pfl_nom` varchar(80) NOT NULL,
  `pfl_prenom` varchar(80) NOT NULL,
  `pfl_mail` varchar(300) NOT NULL,
  `pfl_discipline` varchar(200) NOT NULL,
  `pfl_blio` varchar(500) DEFAULT NULL,
  `pfl_URL` varchar(300) DEFAULT NULL,
  `pfl_statut` char(1) NOT NULL,
  `pfl_etat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tab_profil_pfl`
--

INSERT INTO `tab_profil_pfl` (`pfl_id`, `cpti_pseudo`, `pfl_nom`, `pfl_prenom`, `pfl_mail`, `pfl_discipline`, `pfl_blio`, `pfl_URL`, `pfl_statut`, `pfl_etat`) VALUES
(1, 'TitouanG', 'Gallou', 'Titouan', 'TitouanG@pro.fr', 'Horreur', 'Je suis l auteur de Games of Chair', 'https://monsite1.fr', 'J', 'A'),
(2, 'JustineM', 'Miley', 'Justine', 'MileyJustine@hotmail.fr', 'Moderne', 'Auteur du livre : La route', 'https://Justine.fr', 'J', 'A'),
(3, 'CharlesH', 'Henry', 'Charles', 'Henry.Charles@hotmail.fr', 'Futuriste', 'J ai écris le livre : Au coeur des tempêtes', NULL, 'J', 'F'),
(4, 'SashaG', 'Gatineau', 'Sasha', 'SashaGatineau@hotmail.com', 'Senior (+18)', 'Je n ai rien écris durant ma carrière, mais...', NULL, 'J', 'F'),
(5, 'organisateur', 'Marc', 'Valerie', 'VApro@hotmail.fr', '', NULL, NULL, 'A', 'P'),
(6, 'NicolasR', 'Rivollier', 'Nicolas', 'NicolasRivollier@hotmail.fr', '', NULL, NULL, 'A', 'A'),
(7, 'LucieV', 'Vint', 'Lucie', 'Lucie.Vint.Pro@hotmail.fr', '', NULL, NULL, 'A', 'F'),
(8, 'RozennD', 'Dolivet', 'Rozenn', 'RozennD@hotmail.fr', '', NULL, NULL, 'A', 'F'),
(11, 'Pharris', 'Harris', 'Paing', 'harris@harris.com', 'Nouvelles', 'le fabriquant du pain Harris', 'http://www.harris.com', 'J', 'A'),
(12, 'StephenK', 'King', 'Stephen', 'Adresse@mail.fr', '', '', NULL, 'A', 'A'),
(13, 'jackE', 'Elvis', 'Jack', 'JackE@pro.fr', 'Senior (+18)', '', '', 'J', 'A'),
(19, 'JosephA', 'Alise', 'Joseph', 'JA@hotmail.fr', 'Futuriste', 'Aucun livre', '', 'J', 'A'),
(20, 'connoJ', 'O\'connor', 'James', 'Connor@hotmail.fr', 'Futuriste', '', '', 'J', 'A');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tab_actualite_act`
--
ALTER TABLE `tab_actualite_act`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `fk_tab_Actualite_act_tab_Compteorg_cpto1_idx` (`cpti_pseudo`);

--
-- Index pour la table `tab_candidature_cdt`
--
ALTER TABLE `tab_candidature_cdt`
  ADD PRIMARY KEY (`cdt_id`),
  ADD UNIQUE KEY `cdt_mail_UNIQUE` (`cdt_mail`),
  ADD KEY `fk_tab_candidature_cdt_tab_categorie_cat1_idx` (`cat_nom`),
  ADD KEY `fk_tab_candidature_cdt_tab_concours_ccr1_idx` (`ccr_id`);

--
-- Index pour la table `tab_categorie_cat`
--
ALTER TABLE `tab_categorie_cat`
  ADD PRIMARY KEY (`cat_nom`);

--
-- Index pour la table `tab_ccrcategorie_ccc`
--
ALTER TABLE `tab_ccrcategorie_ccc`
  ADD PRIMARY KEY (`cat_nom`,`ccr_id`),
  ADD KEY `fk_tab_categorie_cat_has_tab_concours_ccr_tab_categorie_cat_idx` (`cat_nom`),
  ADD KEY `fk_tab_ccrcategorie_ccc_tab_concours_ccr1_idx` (`ccr_id`);

--
-- Index pour la table `tab_ccrjury_ccj`
--
ALTER TABLE `tab_ccrjury_ccj`
  ADD PRIMARY KEY (`ccr_id`,`pfl_id`),
  ADD KEY `fk_tab_concours_ccr_has_tab_profil_pfl_tab_profil_pfl1_idx` (`pfl_id`),
  ADD KEY `fk_tab_concours_ccr_has_tab_profil_pfl_tab_concours_ccr1_idx` (`ccr_id`);

--
-- Index pour la table `tab_compteinfo_cpti`
--
ALTER TABLE `tab_compteinfo_cpti`
  ADD PRIMARY KEY (`cpti_pseudo`);

--
-- Index pour la table `tab_compteorg_cpto`
--
ALTER TABLE `tab_compteorg_cpto`
  ADD PRIMARY KEY (`cpti_pseudo`);

--
-- Index pour la table `tab_concours_ccr`
--
ALTER TABLE `tab_concours_ccr`
  ADD PRIMARY KEY (`ccr_id`),
  ADD KEY `fk_tab_concours_ccr_tab_compteorg_cpto1_idx` (`cpti_pseudo`);

--
-- Index pour la table `tab_document_doc`
--
ALTER TABLE `tab_document_doc`
  ADD PRIMARY KEY (`doc_id`,`cdt_id`),
  ADD KEY `fk_tab_document_doc_tab_candidature_cdt1_idx` (`cdt_id`);

--
-- Index pour la table `tab_fil_fil`
--
ALTER TABLE `tab_fil_fil`
  ADD PRIMARY KEY (`fil_id`),
  ADD KEY `fk_tab_fil_fil_tab_Compteinfo_cpti1_idx` (`cpti_pseudo`),
  ADD KEY `fk_tab_fil_fil_tab_concours_ccr1_idx` (`ccr_id`);

--
-- Index pour la table `tab_message_mes`
--
ALTER TABLE `tab_message_mes`
  ADD PRIMARY KEY (`mes_id`),
  ADD KEY `fk_tab_message_mes_tab_fil_fil1_idx` (`fil_id`);

--
-- Index pour la table `tab_note_nte`
--
ALTER TABLE `tab_note_nte`
  ADD PRIMARY KEY (`pfl_id`,`cdt_id`),
  ADD KEY `fk_tab_profil_pfl_has_tab_candidature_cdt_tab_candidature_c_idx` (`cdt_id`),
  ADD KEY `fk_tab_profil_pfl_has_tab_candidature_cdt_tab_profil_pfl1_idx` (`pfl_id`);

--
-- Index pour la table `tab_profil_pfl`
--
ALTER TABLE `tab_profil_pfl`
  ADD PRIMARY KEY (`pfl_id`),
  ADD UNIQUE KEY `tab_Compteinfo_cpti_cpti_pseudo_UNIQUE` (`cpti_pseudo`),
  ADD UNIQUE KEY `pfl_mail_UNIQUE` (`pfl_mail`),
  ADD KEY `fk_tab_Profil_pfl_tab_Compteinfo_cpti1_idx` (`cpti_pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tab_actualite_act`
--
ALTER TABLE `tab_actualite_act`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `tab_candidature_cdt`
--
ALTER TABLE `tab_candidature_cdt`
  MODIFY `cdt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `tab_concours_ccr`
--
ALTER TABLE `tab_concours_ccr`
  MODIFY `ccr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `tab_document_doc`
--
ALTER TABLE `tab_document_doc`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `tab_fil_fil`
--
ALTER TABLE `tab_fil_fil`
  MODIFY `fil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tab_message_mes`
--
ALTER TABLE `tab_message_mes`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tab_profil_pfl`
--
ALTER TABLE `tab_profil_pfl`
  MODIFY `pfl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tab_actualite_act`
--
ALTER TABLE `tab_actualite_act`
  ADD CONSTRAINT `fk_tab_Actualite_act_tab_Compteorg_cpto1` FOREIGN KEY (`cpti_pseudo`) REFERENCES `tab_compteorg_cpto` (`cpti_pseudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_candidature_cdt`
--
ALTER TABLE `tab_candidature_cdt`
  ADD CONSTRAINT `fk_tab_candidature_cdt_tab_categorie_cat1` FOREIGN KEY (`cat_nom`) REFERENCES `tab_categorie_cat` (`cat_nom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_candidature_cdt_tab_concours_ccr1` FOREIGN KEY (`ccr_id`) REFERENCES `tab_concours_ccr` (`ccr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_ccrcategorie_ccc`
--
ALTER TABLE `tab_ccrcategorie_ccc`
  ADD CONSTRAINT `fk_tab_categorie_cat_has_tab_concours_ccr_tab_categorie_cat1` FOREIGN KEY (`cat_nom`) REFERENCES `tab_categorie_cat` (`cat_nom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_ccrcategorie_ccc_tab_concours_ccr1` FOREIGN KEY (`ccr_id`) REFERENCES `tab_concours_ccr` (`ccr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_ccrjury_ccj`
--
ALTER TABLE `tab_ccrjury_ccj`
  ADD CONSTRAINT `fk_tab_concours_ccr_has_tab_profil_pfl_tab_concours_ccr1` FOREIGN KEY (`ccr_id`) REFERENCES `tab_concours_ccr` (`ccr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_concours_ccr_has_tab_profil_pfl_tab_profil_pfl1` FOREIGN KEY (`pfl_id`) REFERENCES `tab_profil_pfl` (`pfl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_compteorg_cpto`
--
ALTER TABLE `tab_compteorg_cpto`
  ADD CONSTRAINT `fk_tab_Compteorg_cpto_tab_Profil_pfl1` FOREIGN KEY (`cpti_pseudo`) REFERENCES `tab_profil_pfl` (`cpti_pseudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_concours_ccr`
--
ALTER TABLE `tab_concours_ccr`
  ADD CONSTRAINT `fk_tab_concours_ccr_tab_compteorg_cpto1` FOREIGN KEY (`cpti_pseudo`) REFERENCES `tab_compteorg_cpto` (`cpti_pseudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_document_doc`
--
ALTER TABLE `tab_document_doc`
  ADD CONSTRAINT `fk_tab_document_doc_tab_candidature_cdt1` FOREIGN KEY (`cdt_id`) REFERENCES `tab_candidature_cdt` (`cdt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_fil_fil`
--
ALTER TABLE `tab_fil_fil`
  ADD CONSTRAINT `fk_tab_fil_fil_tab_Compteinfo_cpti1` FOREIGN KEY (`cpti_pseudo`) REFERENCES `tab_compteinfo_cpti` (`cpti_pseudo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_fil_fil_tab_concours_ccr1` FOREIGN KEY (`ccr_id`) REFERENCES `tab_concours_ccr` (`ccr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_message_mes`
--
ALTER TABLE `tab_message_mes`
  ADD CONSTRAINT `fk_tab_message_mes_tab_fil_fil1` FOREIGN KEY (`fil_id`) REFERENCES `tab_fil_fil` (`fil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_note_nte`
--
ALTER TABLE `tab_note_nte`
  ADD CONSTRAINT `fk_tab_profil_pfl_has_tab_candidature_cdt_tab_candidature_cdt1` FOREIGN KEY (`cdt_id`) REFERENCES `tab_candidature_cdt` (`cdt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tab_profil_pfl_has_tab_candidature_cdt_tab_profil_pfl1` FOREIGN KEY (`pfl_id`) REFERENCES `tab_profil_pfl` (`pfl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tab_profil_pfl`
--
ALTER TABLE `tab_profil_pfl`
  ADD CONSTRAINT `fk_tab_Profil_pfl_tab_Compteinfo_cpti1` FOREIGN KEY (`cpti_pseudo`) REFERENCES `tab_compteinfo_cpti` (`cpti_pseudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
