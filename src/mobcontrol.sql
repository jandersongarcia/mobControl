-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela eldorado.mb_user_account
DROP TABLE IF EXISTS `mb_user_account`;
CREATE TABLE IF NOT EXISTS `mb_user_account` (
  `SEQ_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `SURNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `BIRTH` date DEFAULT NULL,
  `AVATAR` varchar(255) DEFAULT NULL,
  `RECOVER_PASS` varchar(255) DEFAULT NULL,
  `RECOVER_VALIDATE` timestamp NULL DEFAULT NULL,
  `CHANGE_PASSWORD` tinyint(1) NOT NULL DEFAULT 0,
  `TYPE_USER` int(11) NOT NULL DEFAULT 3,
  `STATUS` tinyint(4) NOT NULL DEFAULT 0,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`SEQ_ID`) USING BTREE,
  KEY `FK_mb_user_account_mb_user_type` (`TYPE_USER`),
  CONSTRAINT `FK_mb_user_account_mb_user_type` FOREIGN KEY (`TYPE_USER`) REFERENCES `mb_user_type` (`SEQ_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela eldorado.mb_user_account: ~1 rows (aproximadamente)
INSERT INTO `mb_user_account` (`SEQ_ID`, `NAME`, `SURNAME`, `EMAIL`, `USERNAME`, `PASSWORD`, `BIRTH`, `AVATAR`, `RECOVER_PASS`, `RECOVER_VALIDATE`, `CHANGE_PASSWORD`, `TYPE_USER`, `STATUS`, `CREATED_AT`) VALUES
	(1, 'Administrator', '', 'user@mob.com', 'master.admin', '$2y$10$m9ZqhL7Ms7lJ851TshliyuPX/FrQjAqlJmMiAEXOWszDNMp3N.99m', NULL, NULL, NULL, NULL, 0, 1, 0, '2024-01-28 01:27:08');

-- Copiando estrutura para tabela eldorado.mb_user_logs
DROP TABLE IF EXISTS `mb_user_logs`;
CREATE TABLE IF NOT EXISTS `mb_user_logs` (
  `SEQ_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) DEFAULT NULL,
  `IP_ACCESS` varchar(45) DEFAULT NULL,
  `USER_AGENT` text DEFAULT NULL,
  `LEVEL` varchar(10) DEFAULT NULL,
  `ACTION` varchar(255) DEFAULT NULL,
  `LOG_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`SEQ_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela eldorado.mb_user_logs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela eldorado.mb_user_type
DROP TABLE IF EXISTS `mb_user_type`;
CREATE TABLE IF NOT EXISTS `mb_user_type` (
  `SEQ_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL DEFAULT '0',
  `CATEGORY` varchar(50) NOT NULL DEFAULT '0',
  `SITUATION` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`SEQ_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela eldorado.mb_user_type: ~4 rows (aproximadamente)
INSERT INTO `mb_user_type` (`SEQ_ID`, `NAME`, `CATEGORY`, `SITUATION`) VALUES
	(1, 'Administrator', 'admin', 1),
	(2, 'User', 'user', 1),
	(3, 'Restricted User', 'read_only', 1),
	(4, 'Manager', 'manager', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
