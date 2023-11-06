-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Nov-2023 às 19:56
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `safetyflow`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `area_responsavel`
--

CREATE TABLE `area_responsavel` (
  `id_area` int(11) NOT NULL,
  `nome_area` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `area_responsavel`
--

INSERT INTO `area_responsavel` (`id_area`, `nome_area`) VALUES
(0, 'Não especificado]'),
(1, 'manutenção'),
(2, 'engenharia'),
(3, 'produção'),
(4, 'qualidade'),
(5, 'recursos humanos'),
(6, 'segurança do trabalho'),
(7, 'meio ambiente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `desvio`
--

CREATE TABLE `desvio` (
  `id_desvio` int(11) NOT NULL,
  `data_identificacao` date NOT NULL,
  `turno` varchar(20) NOT NULL,
  `local_desvio` varchar(255) NOT NULL,
  `descricao_desvio` text NOT NULL,
  `foto_desvio` varchar(255) DEFAULT NULL,
  `tipo_desvio` int(11) NOT NULL,
  `gravidade` int(11) NOT NULL,
  `area_responsavel` int(11) NOT NULL,
  `setor` int(11) NOT NULL,
  `usuario_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `desvio`
--

INSERT INTO `desvio` (`id_desvio`, `data_identificacao`, `turno`, `local_desvio`, `descricao_desvio`, `foto_desvio`, `tipo_desvio`, `gravidade`, `area_responsavel`, `setor`, `usuario_matricula`) VALUES
(1, '2023-11-05', 'Manhã', 'a', 'a', '../Desvio/1699210136.jpg', 3, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `feedback`
--

CREATE TABLE `feedback` (
  `nota` int(11) NOT NULL,
  `comentario` longtext DEFAULT NULL,
  `usuario_matricula` int(11) NOT NULL,
  `data_postagem` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gravidade`
--

CREATE TABLE `gravidade` (
  `idgravidade` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `gravidade`
--

INSERT INTO `gravidade` (`idgravidade`, `descricao`) VALUES
(1, 'leve'),
(2, 'moderado'),
(3, 'grave'),
(4, 'gravissimo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `resolucao`
--

CREATE TABLE `resolucao` (
  `idresolucao` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `acoes` varchar(255) DEFAULT NULL,
  `data_resolucao` date NOT NULL,
  `usuario_matricula` int(11) NOT NULL,
  `id_desvio` int(11) NOT NULL,
  `id_area_r` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- acionadores 'resolucao'
DELIMITER // 	
CREATE trigger anti_duplicacao_resolucao
before insert on resolucao
for each row
begin
	declare checkD int;
    set checkD = (SELECT count(id_desvio) from resolucao where id_desvio = NEW.id_desvio);
    if checkD <> 0 
		then SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'não é permitido ter duas resoluçoes para o mesmo desvio';
    end if;
end;//
DELIMITER ;

DELIMITER //
create trigger set_data_resolucao
before update on resolucao
for each row
begin
	if new.status = 3
		then set new.data_resolucao = curdate();
	end if;
end;//
DELIMITER ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `nome_setor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id_setor`, `nome_setor`) VALUES
(1, 'administrarivo'),
(2, 'hidro'),
(3, 'creme'),
(4, 'estojo'),
(5, 'qualidade'),
(6, 'logistica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_desvio`
--

CREATE TABLE `tipo_desvio` (
  `idtipo_desvio` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `tipo_desvio`
--

INSERT INTO `tipo_desvio` (`idtipo_desvio`, `descricao`) VALUES
(1, 'desvio comportamental'),
(2, 'desvio ergonômico'),
(3, 'Desvio de Segurança'),
(4, 'Desvio de Qualidade'),
(5, 'Desvio de Processo'),
(6, 'Desvio Ambiental'),
(7, 'Desvio de Manutenção');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(6) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `setor` int(11) NOT NULL,
  `area_responsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`matricula`, `nome`, `email`, `senha`, `isAdmin`, `setor`, `area_responsavel`) VALUES
(1, 'Natan', 'santosnatan085@gmail.com', '123456', 0, 1, 0);

--
-- Acionadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `restricao_direct_insert_adm` BEFORE INSERT ON `usuario` FOR EACH ROW begin 
	if NEW.isAdmin > 0 
		then SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'não é permitido inserção direta de administradores';
	end if;
	if NEW.area_responsavel > 0
		then SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'não é permitido alocação de reponsabildade de area para não administradores';
	end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restricoes_admin` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
DECLARE area_limit_check int;
set area_limit_check = (SELECT count(matricula) from  usuario where area_responsavel = NEW.area_responsavel and area_responsavel != 0);
    CASE
        WHEN NEW.isAdmin = 1 AND (NEW.area_responsavel IS NULL OR NEW.area_responsavel = 0) 
			THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'necessario atribuir area ao administrador';
        WHEN NEW.isAdmin = 0 AND NEW.area_responsavel != 0 
			THEN SET NEW.area_responsavel = 0;
		ELSE
			if area_limit_check > 0 
				THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'numero de administradores da area selecionada já esta lotada';
			end if;
    END CASE;
END
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `area_responsavel`
--
ALTER TABLE `area_responsavel`
  ADD PRIMARY KEY (`id_area`);

--
-- Índices para tabela `desvio`
--
ALTER TABLE `desvio`
  ADD PRIMARY KEY (`id_desvio`,`tipo_desvio`,`gravidade`,`area_responsavel`,`setor`,`usuario_matricula`),
  ADD KEY `fk_desvio_tipo_desvio1_idx` (`tipo_desvio`),
  ADD KEY `fk_desvio_gravidade1_idx` (`gravidade`),
  ADD KEY `fk_desvio_area_responsavel1_idx` (`area_responsavel`),
  ADD KEY `fk_desvio_setor1_idx` (`setor`),
  ADD KEY `fk_desvio_usuario1_idx` (`usuario_matricula`);

--
-- Índices para tabela `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`usuario_matricula`);

--
-- Índices para tabela `gravidade`
--
ALTER TABLE `gravidade`
  ADD PRIMARY KEY (`idgravidade`);

--
-- Índices para tabela `resolucao`
--
ALTER TABLE `resolucao`
  ADD PRIMARY KEY (`idresolucao`,`usuario_matricula`,`id_desvio`,`id_area_r`),
  ADD KEY `fk_resolucao_usuario1_idx` (`usuario_matricula`),
  ADD KEY `fk_resolucao_desvio1_idx` (`id_desvio`),
  ADD KEY `fk_resolucao_area_responsavel1_idx` (`id_area_r`);

--
-- Índices para tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Índices para tabela `tipo_desvio`
--
ALTER TABLE `tipo_desvio`
  ADD PRIMARY KEY (`idtipo_desvio`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matricula`,`setor`),
  ADD KEY `fk_usuario_setor1_idx` (`setor`),
  ADD KEY `fk_usuario_area_responsavel1` (`area_responsavel`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `desvio`
--
ALTER TABLE `desvio`
  MODIFY `id_desvio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `resolucao`
--
ALTER TABLE `resolucao`
  MODIFY `idresolucao` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `desvio`
--
ALTER TABLE `desvio`
  ADD CONSTRAINT `fk_desvio_area_responsavel1` FOREIGN KEY (`area_responsavel`) REFERENCES `area_responsavel` (`id_area`),
  ADD CONSTRAINT `fk_desvio_gravidade1` FOREIGN KEY (`gravidade`) REFERENCES `gravidade` (`idgravidade`),
  ADD CONSTRAINT `fk_desvio_setor1` FOREIGN KEY (`setor`) REFERENCES `setor` (`id_setor`),
  ADD CONSTRAINT `fk_desvio_tipo_desvio1` FOREIGN KEY (`tipo_desvio`) REFERENCES `tipo_desvio` (`idtipo_desvio`),
  ADD CONSTRAINT `fk_desvio_usuario1` FOREIGN KEY (`usuario_matricula`) REFERENCES `usuario` (`matricula`);

--
-- Limitadores para a tabela `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_usuario1` FOREIGN KEY (`usuario_matricula`) REFERENCES `usuario` (`matricula`);

--
-- Limitadores para a tabela `resolucao`
--
ALTER TABLE `resolucao`
  ADD CONSTRAINT `fk_resolucao_area_responsavel1` FOREIGN KEY (`id_area_r`) REFERENCES `area_responsavel` (`id_area`),
  ADD CONSTRAINT `fk_resolucao_desvio1` FOREIGN KEY (`id_desvio`) REFERENCES `desvio` (`id_desvio`),
  ADD CONSTRAINT `fk_resolucao_usuario1` FOREIGN KEY (`usuario_matricula`) REFERENCES `usuario` (`matricula`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_area_responsavel1` FOREIGN KEY (`area_responsavel`) REFERENCES `area_responsavel` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_setor1` FOREIGN KEY (`setor`) REFERENCES `setor` (`id_setor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
