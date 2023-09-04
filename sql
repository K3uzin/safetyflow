-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Set-2023 às 05:27
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
  `id_desvio` int(11) NOT NULL,
  `user_nome` varchar(255) DEFAULT NULL,
  `user_matricula` int(11) DEFAULT NULL,
  `data_identificacao` date DEFAULT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `setor` int(11) DEFAULT NULL,
  `local_desvio` varchar(255) DEFAULT NULL,
  `descricao_desvio` text DEFAULT NULL,
  `tipo_desvio` varchar(255) DEFAULT NULL,
  `gravidade` varchar(20) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `foto_desvio` varchar(255) DEFAULT NULL,
  `area_responsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `desvios`
--

INSERT INTO `desvios` (`id_desvio`, `user_nome`, `user_matricula`, `data_identificacao`, `turno`, `setor`, `local_desvio`, `descricao_desvio`, `tipo_desvio`, `gravidade`, `observacoes`, `foto_desvio`, `area_responsavel`) VALUES
(0, 'Natan', 0, '2023-08-29', 'Manhã', 3, 'xs', 'aae', 'ada', 'Moderado', NULL, 'setores/listas_setores/fotos_desvio/Snapinsta.app_318928285_713968859876951_9061158292914759457_n_1080 (1).jpg', 5),
(0, 'Natan', 0, '2023-08-29', 'Manhã', 1, 'xs', 'aae', 'ada', 'Moderado', NULL, 'setores/listas_setores/fotos_desvio/Snapinsta.app_318928285_713968859876951_9061158292914759457_n_1080 (1).jpg', 5);

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
