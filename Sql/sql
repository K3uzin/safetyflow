-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Set-2023 às 01:30
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `desvios`
--

INSERT INTO `desvios` (`user_nome`, `user_matricula`, `data_identificacao`, `turno`, `setor`, `local_desvio`, `descricao_desvio`, `tipo_desvio`, `gravidade`, `foto_desvio`, `area_responsavel`, `id_desvio`) VALUES
('Natan', 0, '2023-09-06', 'Noite', 3, 'AAA', 'SOCORRO DEUS', 'Desvio Ergonômico', 'Moderado', NULL, 4, 1),
('Natan', 0, '2023-08-29', 'Manhã', 6, 'sas', 'sss', 'Desvio Ambiental', 'Moderado', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

CREATE TABLE `setores` (
  `id_setor` int(11) NOT NULL,
  `nome_setor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- AUTO_INCREMENT de tabela `desvios`
--
ALTER TABLE `desvios`
  MODIFY `id_desvio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
