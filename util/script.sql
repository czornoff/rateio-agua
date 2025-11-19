/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS `condominio_geral`;
CREATE DATABASE IF NOT EXISTS `condominio_geral` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `condominio_geral`;

DROP TABLE IF EXISTS `concessionaria`;
CREATE TABLE IF NOT EXISTS `concessionaria` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `concessionaria_nome` varchar(50) NOT NULL,
  `concessionaria_hidrometro` varchar(50) NOT NULL,
  `concessionaria_fornecimento` varchar(50) NOT NULL,
  `observacao` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `condomino`;
CREATE TABLE IF NOT EXISTS `condomino` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `whatsapp` enum('S','N') DEFAULT 'S',
  `telefone_2` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_2` varchar(50) DEFAULT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `morador` enum('S','N') NOT NULL DEFAULT 'N',
  `observacao` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `condomino_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `condomino_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `consumo_global`;
CREATE TABLE IF NOT EXISTS `consumo_global` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data_leitura` date NOT NULL,
  `concessionaria_id` bigint(20) unsigned NOT NULL,
  `concessionaria_leitura` decimal(10,3) NOT NULL DEFAULT 0.000,
  `concessionaria_dias` int(10) unsigned NOT NULL,
  `concessionaria_documento` varchar(50) NOT NULL,
  `concessionaria_arquivo` varchar(50) DEFAULT NULL,
  `concessionaria_valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `concessionaria_consumo` decimal(10,3) NOT NULL DEFAULT 0.000,
  `privativa_consumo` decimal(10,3) NOT NULL DEFAULT 0.000,
  `comum_consumo` decimal(10,3) NOT NULL DEFAULT 0.000,
  `privativa_valor` decimal(10,3) NOT NULL DEFAULT 0.000,
  `comum_valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observacao` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consumo_global_concessionaria_id_foreign` (`concessionaria_id`),
  CONSTRAINT `consumo_global_concessionaria_id_foreign` FOREIGN KEY (`concessionaria_id`) REFERENCES `concessionaria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `consumo_historico`;
CREATE TABLE IF NOT EXISTS `consumo_historico` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unidade_id` bigint(20) unsigned NOT NULL,
  `consumo_global_id` bigint(20) unsigned NOT NULL,
  `privativa_consumo` decimal(10,3) NOT NULL DEFAULT 0.000,
  `privativa_valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `comum_consumo` decimal(10,3) NOT NULL DEFAULT 0.000,
  `comum_valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `observacao` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consumo_historico_consumo_global_id_foreign` (`consumo_global_id`),
  KEY `consumo_historico_unidade_id_foreign` (`unidade_id`),
  CONSTRAINT `consumo_historico_consumo_global_id_foreign` FOREIGN KEY (`consumo_global_id`) REFERENCES `consumo_global` (`id`),
  CONSTRAINT `consumo_historico_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1441 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `consumo_privativo`;
CREATE TABLE IF NOT EXISTS `consumo_privativo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consumo_global_id` bigint(20) unsigned NOT NULL,
  `relogio_id` bigint(20) unsigned NOT NULL,
  `leitura` decimal(10,3) DEFAULT 0.000,
  `leitura_inicial` decimal(10,3) NOT NULL DEFAULT 0.000,
  `leitura_final` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consumo_privativo_relogio_id_foreign` (`relogio_id`),
  KEY `consumo_privativo_consumo_global_id_foreign` (`consumo_global_id`),
  CONSTRAINT `consumo_privativo_consumo_global_id_foreign` FOREIGN KEY (`consumo_global_id`) REFERENCES `consumo_global` (`id`),
  CONSTRAINT `consumo_privativo_relogio_id_foreign` FOREIGN KEY (`relogio_id`) REFERENCES `relogio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8066 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `faixa`;
CREATE TABLE IF NOT EXISTS `faixa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `range_inicial` decimal(10,3) NOT NULL DEFAULT 0.000,
  `range_final` decimal(10,3) NOT NULL DEFAULT 0.000,
  `valor` decimal(10,3) NOT NULL DEFAULT 0.000,
  `descricao` varchar(255) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tabela` varchar(50) NOT NULL,
  `log` text NOT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `relatorio`;
CREATE TABLE IF NOT EXISTS `relatorio` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unidade_id` bigint(20) unsigned NOT NULL,
  `consumo_global_id` bigint(20) unsigned NOT NULL,
  `dados` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `relatorio_unidade_id_foreign` (`unidade_id`) USING BTREE,
  CONSTRAINT `relatorio_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `relogio`;
CREATE TABLE IF NOT EXISTS `relogio` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `radio` varchar(50) NOT NULL,
  `nome` enum('Aquecedor','Banheiro de Serviço','Banheiro Social','Banheiro Suíte','Cozinha','Lavanderia') NOT NULL,
  `unidade_id` bigint(20) unsigned NOT NULL,
  `status` enum('OK','Observação','Manutenção') NOT NULL,
  `observacao` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `relogio_unidade_id_foreign` (`unidade_id`),
  CONSTRAINT `relogio_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bloco` enum('1','2') NOT NULL DEFAULT '1',
  `apto` tinyint(4) NOT NULL,
  `fracao` decimal(20,15) NOT NULL DEFAULT 0.000000000000000,
  `proprietario_id` bigint(20) unsigned DEFAULT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `ocupada` enum('S','N') NOT NULL DEFAULT 'S',
  `observacao` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `unidade_proprietario_id_foreign` (`proprietario_id`),
  KEY `unidade_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `unidade_proprietario_id_foreign` FOREIGN KEY (`proprietario_id`) REFERENCES `condomino` (`id`),
  CONSTRAINT `unidade_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `unidade_condomino`;
CREATE TABLE IF NOT EXISTS `unidade_condomino` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unidade_id` bigint(20) unsigned NOT NULL,
  `condomino_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `unidade_condomino_condomino_id_foreign` (`condomino_id`),
  KEY `unidade_condomino_unidade_id_foreign` (`unidade_id`),
  CONSTRAINT `unidade_condomino_condomino_id_foreign` FOREIGN KEY (`condomino_id`) REFERENCES `condomino` (`id`),
  CONSTRAINT `unidade_condomino_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `senha_confirmacao` varchar(255) NOT NULL,
  `senha_padrao` varchar(255) NOT NULL,
  `senha_hash_recuperacao` varchar(255) DEFAULT NULL,
  `unidade_id` bigint(20) NOT NULL,
  `role` enum('admin','unidade','usuario') NOT NULL DEFAULT 'usuario',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
