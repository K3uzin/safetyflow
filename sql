-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Set-2023 às 23:09
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
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `matricula_admin` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `setor_id` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`matricula_admin`, `nome`, `setor_id`, `isAdmin`, `senha`, `email`) VALUES
(1, 'Natan Lima Santos', 1, 1, '123456', 'santosnatan085@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `areas_responsaveis`
--

CREATE TABLE `areas_responsaveis` (
  `id_area` int(11) NOT NULL,
  `nome_area` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `areas_responsaveis`
--

INSERT INTO `areas_responsaveis` (`id_area`, `nome_area`) VALUES
(1, 'Manutenção'),
(2, 'Engenharia'),
(3, 'Produção'),
(4, 'Qualidade'),
(5, 'Recursos Humanos'),
(6, 'Segurança do Trabalho'),
(7, 'Meio Ambiente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `desvios`
--

CREATE TABLE `desvios` (
  `user_nome` varchar(255) NOT NULL,
  `user_matricula` int(11) NOT NULL,
  `data_identificacao` date NOT NULL,
  `turno` varchar(20) NOT NULL,
  `setor` int(11) NOT NULL,
  `local_desvio` varchar(255) NOT NULL,
  `descricao_desvio` text NOT NULL,
  `tipo_desvio` varchar(20) DEFAULT NULL,
  `gravidade` varchar(20) NOT NULL,
  `foto_desvio` varchar(255) DEFAULT NULL,
  `area_responsavel` int(11) NOT NULL,
  `id_desvio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `desvios`
--

INSERT INTO `desvios` (`user_nome`, `user_matricula`, `data_identificacao`, `turno`, `setor`, `local_desvio`, `descricao_desvio`, `tipo_desvio`, `gravidade`, `foto_desvio`, `area_responsavel`, `id_desvio`) VALUES
('Natan', 0, '2023-08-30', 'Noite', 1, 'a', 'aaa', 'Desvio de Qualidade', 'Moderado', 'setores/listas_setores/fotos_desvio/1693860480.jpg', 5, 0),
('Natan', 0, '2023-08-29', 'Manhã', 3, 'xs', 'aae', '0', 'Moderado', 'setores/listas_setores/fotos_desvio/Snapinsta.app_318928285_713968859876951_9061158292914759457_n_1080 (1).jpg', 5, 1),
('Natan', 0, '2023-08-29', 'Manhã', 1, 'xs', 'aae', '0', 'Moderado', 'setores/listas_setores/fotos_desvio/Snapinsta.app_318928285_713968859876951_9061158292914759457_n_1080 (1).jpg', 5, 2),
('Natan', 0, '0000-00-00', 'Manhã', 4, 'aaa', 's', '0', 'Moderado', NULL, 1, 3),
('Natan', 0, '0000-00-00', 'Noite', 1, 'aa', 'aaa', '0', 'Moderado', NULL, 1, 4),
('Natan', 0, '0000-00-00', 'Noite', 1, 'aa', 'aaa', 'Desvio de Segurança', 'Moderado', NULL, 1, 5),
('Natan', 0, '2023-09-11', 'Noite', 4, 'a', 'aa', 'Desvio de Segurança', 'Gravíssimo', 'setores/listas_setores/fotos_desvio/Snapinsta.app_120138998_189769495939898_664015494098558591_n_1080.jpg', 1, 6),
('Natan', 0, '0000-00-00', 'Tarde', 4, 'aaa', 'aaa', 'Desvio Ergonômico', 'Moderado', 'setores/listas_setores/fotos_desvio/129719633_919117488829759_4706500427372535772_n.jpg', 7, 7),
('Natan', 0, '2023-08-30', 'Noite', 1, 'a', 'aaa', 'Desvio de Qualidade', 'Moderado', 'setores/listas_setores/fotos_desvio/1693858361.jpg', 5, 8),
('Natan', 0, '2023-08-30', 'Noite', 1, 'a', 'aaa', 'Desvio de Qualidade', 'Moderado', 'setores/listas_setores/fotos_desvio/1693859055.jfif', 5, 9),
('Natan', 0, '2023-08-30', 'Noite', 1, 'a', 'aaa', 'Desvio de Qualidade', 'Moderado', NULL, 5, 10),
('Natan', 0, '2023-08-30', 'Noite', 1, 'a', 'aaa', 'Desvio de Qualidade', 'Moderado', 'setores/listas_setores/fotos_desvio/1693860221.jpg', 5, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

CREATE TABLE `setores` (
  `id_setor` int(11) NOT NULL,
  `nome_setor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `setores`
--

INSERT INTO `setores` (`id_setor`, `nome_setor`) VALUES
(1, 'Administrativa'),
(2, 'Hidro'),
(3, 'Cremes'),
(4, 'Estojo'),
(5, 'Qualidade'),
(6, 'Logistica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(6) NOT NULL,
  `setor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`matricula`, `nome`, `email`, `senha`, `setor_id`) VALUES
(0, 'Natan', 'santos@gmail.com', '123456', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`matricula_admin`),
  ADD KEY `setor_id` (`setor_id`);

--
-- Índices para tabela `desvios`
--
ALTER TABLE `desvios`
  ADD PRIMARY KEY (`id_desvio`);

--
-- Índices para tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id_setor`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `setor_id` (`setor_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `matricula_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id_setor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
