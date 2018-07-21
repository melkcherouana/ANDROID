SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nomclasse` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `criteres` (
  `id` int(11) NOT NULL,
  `matiere` varchar(200) NOT NULL,
  `critere` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `eleves` (
  `ideleve` int(11) NOT NULL,
  `nomeleve` varchar(200) NOT NULL,
  `classe` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `eval` (
  `id` int(11) NOT NULL,
  `critere` varchar(200) NOT NULL,
  `eval` varchar(200) NOT NULL,
  `date` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `matiere` varchar(25) NOT NULL,
  `classe` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `matieres` (
  `id` int(11) NOT NULL,
  `matiere` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `periodes` (
  `id` int(11) NOT NULL,
  `date1` varchar(200) NOT NULL,
  `date2` varchar(200) NOT NULL,
  `classe` varchar(200) NOT NULL,
  `periode` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomclasse` (`nomclasse`);

ALTER TABLE `criteres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `critere` (`critere`);

ALTER TABLE `eleves`
  ADD PRIMARY KEY (`ideleve`),
  ADD UNIQUE KEY `nomeleve` (`nomeleve`);

ALTER TABLE `eval`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matiere` (`matiere`);


ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;


ALTER TABLE `criteres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

ALTER TABLE `eleves`
  MODIFY `ideleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

ALTER TABLE `eval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

ALTER TABLE `matieres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

ALTER TABLE `periodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

