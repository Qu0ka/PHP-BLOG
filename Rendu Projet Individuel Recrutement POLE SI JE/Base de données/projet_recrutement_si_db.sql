-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2021 at 04:31 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_recrutement_si_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaireContenu` text NOT NULL,
  `utilisateur_ID` int(11) NOT NULL,
  `publication_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaireContenu`, `utilisateur_ID`, `publication_ID`) VALUES
(1, 'Je veux jouer nunu & willump !!!', 6, 1),
(2, '-CE COMMENTAIRE NEST PAS PRIS EN COMPTE---\r\n', 3, 2),
(3, 'Je trouve ce sort trop bien !', 6, 2),
(4, '---Ce Commentaire n\'est pas pris en compte----', 3, 3),
(5, 'AAAAAAAAAAAAAAAAAA', 6, 3),
(6, 'Ca l\'air cool, signé Marc', 2, 4),
(7, 'ça a l\'air sympa, signé marc', 2, 4),
(8, 'Coucou', 2, 3),
(9, 'Je kiff le php', 2, 1),
(10, 'test', 2, 4),
(11, 'Bonjour', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `titre`, `contenu`) VALUES
(1, 'L\'ulti de Nunu & Willump', 'L\'ulti de nunu est très fort                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    '),
(2, 'Le sort Q de Nunu & Willump', 'Le sort Q heal                                                                                                 '),
(3, 'Le sort E de Nunu & Willump', 'Le sort E stun                                      '),
(4, 'Le passif de Nunu & Willump', 'Le passif donne un stéroïde d\'attaque speed');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `dateOfBirth`, `email`, `password`) VALUES
(1, 'Dupond', 'Nicolas', '2021-09-01', 'nicolas.dupond@gmail.com', 'nicolasdupond'),
(2, 'Dubois', 'Marc', '2021-09-15', 'marc.dubois@gmail.com', 'marcdubois'),
(3, 'Pallard', 'Hugo', '2001-11-24', 'admin@admin.com', 'admin'),
(5, 'Banane', 'Albert', '1967-06-14', 'albert.banane@gmail.com', 'albertbanane'),
(6, 'Pallard', 'Hugo', '2001-11-24', 'hugopallard2@yahoo.fr', '24Doudou');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
