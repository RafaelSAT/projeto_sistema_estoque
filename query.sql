CREATE DATABASE sistema_estoque;
USE sistema_estoque;

CREATE TABLE `produtos` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`nome_produto` VARCHAR(60) NULL DEFAULT NULL,
	`tipo_produto` VARCHAR(20) NULL DEFAULT NULL,
	`valor` VARCHAR(5) NULL DEFAULT NULL,
	`descricao` VARCHAR(100) NULL DEFAULT NULL,
	`ativo` TINYINT(1) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
CREATE TABLE `senha_token` (
	`id` INT(3) NOT NULL AUTO_INCREMENT,
	`id_usuario` INT(2) NULL DEFAULT NULL,
	`hash` VARCHAR(32) NULL DEFAULT NULL,
	`usado` TINYINT(1) NULL DEFAULT '1',
	`expirado_em` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
CREATE TABLE `usuarios` (
	`id` INT(2) NOT NULL AUTO_INCREMENT,
	`nome_usuario` VARCHAR(30) NULL DEFAULT NULL,
	`senha` VARCHAR(32) NULL DEFAULT NULL,
	`email` VARCHAR(100) NULL DEFAULT NULL,
	`ativo` TINYINT(1) NULL DEFAULT '1',
	`permissoes` TEXT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
INSERT INTO usuarios (nome_usuario, senha, email, ativo, permissoes) VALUES ('estoque01', md5('teste'), 'teste@hotmail.com', '1', 'CONTROL');