-- --------------------------------------------------------
-- Servidor:                     10.211.55.2
-- Versão do servidor:           5.5.38 - Source distribution
-- OS do Servidor:               osx10.6
-- HeidiSQL Versão:              9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para banco
CREATE DATABASE IF NOT EXISTS `banco` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `banco`;


-- Copiando estrutura para tabela banco.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `conta` int(10) unsigned NOT NULL,
  `agencia` int(4) unsigned NOT NULL,
  `senha` varchar(32) NOT NULL,
  `senha_letra` varchar(32) NOT NULL,
  `saldo` double(10,2) unsigned NOT NULL,
  `tentativas` tinyint(1) unsigned NOT NULL,
  `saldo_especial` double(10,2) unsigned NOT NULL,
  `foto` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela banco.clientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nome`, `conta`, `agencia`, `senha`, `senha_letra`, `saldo`, `tentativas`, `saldo_especial`, `foto`) VALUES
	(1, 'JoÃ£o', 1111111, 20202020, 'senha', 'abc', 1000.00, 1, 3000.00, 1),
	(2, 'JoÃ£o', 1111111, 20202020, 'senha', 'abc', 1000.00, 1, 3000.00, 1),
	(4, 'JoÃ£o ABC', 1111111, 20202020, 'AAAAAA', 'abc', 5000.00, 1, 3000.00, 1),
	(5, 'JoÃ£o', 1111111, 20202020, 'senha', 'abc', 1000.00, 1, 3000.00, 1),
	(6, 'qwee', 1, 1, 'abc', 'abc', 10000.00, 0, 1500.00, 0);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Copiando estrutura para tabela banco.extrato
CREATE TABLE IF NOT EXISTS `extrato` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `data` datetime NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` double(10,2) unsigned NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `operacao` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ext_cliente` (`id_cliente`),
  CONSTRAINT `FK_ext_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela banco.extrato: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `extrato` DISABLE KEYS */;
INSERT INTO `extrato` (`id`, `id_cliente`, `data`, `descricao`, `valor`, `tipo`, `operacao`) VALUES
	(1, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(2, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(3, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(4, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(5, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(6, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(7, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(8, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(9, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(10, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(11, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(12, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1'),
	(13, 4, '2015-08-15 00:00:00', 'teste', 10000.00, 'deposito', '1');
/*!40000 ALTER TABLE `extrato` ENABLE KEYS */;


-- Copiando estrutura para tabela banco.funcionarios
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela banco.funcionarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` (`id`, `nome`, `usuario`, `senha`) VALUES
	(2, '()', 'JoÃ£o', '()'),
	(3, 'maria', 'maria', 'maria');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;


-- Copiando estrutura para tabela banco.ib_log
CREATE TABLE IF NOT EXISTS `ib_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ib_log_cliente` (`id_cliente`),
  CONSTRAINT `FK_ib_log_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela banco.ib_log: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ib_log` DISABLE KEYS */;
INSERT INTO `ib_log` (`id`, `id_cliente`, `data`) VALUES
	(1, 4, '2015-08-15 00:00:00'),
	(2, 4, '2015-08-15 00:00:00'),
	(3, 4, '2015-08-15 00:00:00'),
	(4, 4, '2015-08-15 00:00:00'),
	(5, 4, '2015-08-15 00:00:00'),
	(6, 4, '2015-08-15 00:00:00'),
	(7, 4, '2015-08-15 00:00:00'),
	(8, 4, '2015-08-15 00:00:00'),
	(9, 4, '2015-08-15 00:00:00'),
	(10, 6, '2015-08-15 00:00:00'),
	(11, 6, '2015-08-15 00:00:00'),
	(12, 6, '2015-08-15 00:00:00'),
	(13, 6, '2015-08-15 00:00:00'),
	(14, 6, '2015-08-15 00:00:00'),
	(15, 6, '2015-08-15 00:00:00'),
	(16, 6, '2015-08-15 00:00:00'),
	(17, 6, '2015-08-15 00:00:00'),
	(18, 6, '2015-08-15 00:00:00');
/*!40000 ALTER TABLE `ib_log` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
