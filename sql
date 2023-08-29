-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Ago-2023 às 23:08
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
-- Banco de dados: `sflow`
--

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
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(6) NOT NULL,
  `setor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`matricula`, `nome`, `email`, `senha`, `setor_id`) VALUES
(0, 'Natan', 'santos@gmail.com', '123456', 1);

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
-- Estrutura da tabela `tabela_desvio`
--

CREATE TABLE `tabela_desvio` (
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
  `foto_desvio` blob DEFAULT NULL,
  `area_responsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tabela_desvio`
--

INSERT INTO `tabela_desvio` (`id_desvio`, `user_nome`, `user_matricula`, `data_identificacao`, `turno`, `setor`, `local_desvio`, `descricao_desvio`, `tipo_desvio`, `gravidade`, `observacoes`, `foto_desvio`, `area_responsavel`) VALUES
(1, NULL, 0, '0000-00-00', 'Manhã', 2, 'area 1', 'fr22f2', 'fuiop', 'Leve', '', NULL, NULL),
(2, NULL, 0, '0000-00-00', 'Manhã', 2, 'area 1', 'fr22f2', 'fuiop', 'Leve', 'aaa', NULL, NULL),
(3, NULL, 0, '0000-00-00', 'Manhã', 2, 'area 1', 'fr22f2', 'fuiop', 'Leve', 'aaa', NULL, NULL),
(5, NULL, 0, '2023-08-22', 'Noite', 1, 'area', 'oiasfpafp', '1', 'Moderado', '', NULL, NULL),
(6, NULL, 0, '2023-08-22', 'Noite', 1, 'area', 'oiasfpafp', '1', 'Moderado', '', NULL, NULL),
(7, 'Natan', 0, '0000-00-00', 'Manhã', 2, 'estacionamento', 'sgff]s', '2', 'Moderado', '', NULL, NULL),
(10, 'Natan', 0, '2023-08-16', 'Noite', 1, 'fronte', 'barril', '1', 'Leve', '', NULL, NULL),
(11, 'Natan', 0, '2023-08-09', 'Tarde', 2, 'area1 1', '', '2', 'Grave', '', NULL, NULL),
(12, 'Natan', 0, '2023-08-30', 'Tarde', 4, 'area1 1', '', '2', 'Grave', '', NULL, NULL),
(13, 'Natan', 0, '2023-08-30', 'Tarde', 1, 'area1 1', '', '2', 'Grave', '', NULL, NULL),
(14, 'Natan', 0, '2023-08-30', 'Tarde', 1, 'area1 1', '', '2', 'Grave', '', NULL, NULL),
(15, 'Natan', 0, '2023-08-30', 'Tarde', 6, 'area1 1', '', '2', 'Grave', '', NULL, NULL),
(16, 'Natan', 0, '2023-08-13', 'Noite', 6, 'a', 'aa', 'aaa', 'Moderado', '', NULL, NULL),
(17, 'Natan', 0, '2023-08-13', 'Noite', 5, 'a', 'aa', 'aaa', 'Moderado', '', NULL, NULL),
(18, 'Natan', 0, '2023-08-30', 'Tarde', 5, 'area1 1', '', '2', 'Grave', '', NULL, NULL),
(19, 'Natan', 0, '0000-00-00', 'Manhã', 6, 'a', 'a', 'a', 'Gravíssimo', '', NULL, NULL),
(20, 'Natan', 0, '0000-00-00', 'Manhã', 6, 'a', 'a', 'a', 'Gravíssimo', '', NULL, NULL),
(21, 'Natan', 0, '0000-00-00', 'Manhã', 6, 'a', 'a', 'a', 'Gravíssimo', '', NULL, NULL),
(22, 'Natan', 0, '2023-08-02', 'Noite', 6, 'a', 'aaaaaaaaa', 'a', 'Gravíssimo', '', NULL, NULL),
(23, 'Natan', 0, '2023-08-02', 'Noite', 6, 'a', 'aaaaaaaaa', 'a', 'Gravíssimo', '', NULL, NULL),
(24, 'Natan', 0, '2023-08-02', 'Noite', 6, 'a', 'aaaaaaaaa', 'a', 'Gravíssimo', '', NULL, NULL),
(25, 'Natan', 0, '2023-08-02', 'Noite', 6, 'a', 'aaaaaaaaa', 'a', 'Gravíssimo', '', NULL, NULL),
(26, 'Natan', 0, '2023-08-02', 'Noite', 6, 'a', 'aaaaaaaaa', 'a', 'Gravíssimo', '', 0x536e6170696e7374612e6170705f3131373231323238315f323339303931363537373836383534335f35383139393732373938373836333739335f6e5f313038302e6a7067, NULL),
(27, 'Natan', 0, '2023-08-02', 'Noite', 6, 'a', 'aaaaaaaaa', 'a', 'Gravíssimo', NULL, 0x536e6170696e7374612e6170705f3131373231323238315f323339303931363537373836383534335f35383139393732373938373836333739335f6e5f313038302e6a7067, NULL),
(28, 'Natan', 0, '2023-08-06', 'Noite', 2, 'aaa', 'aaa', 'aaa', 'Gravíssimo', NULL, 0x536e6170696e7374612e6170705f3334343632313232395f323735363039363634313139353739385f343736373937323135313337313936373637385f6e5f313038302e6a7067, 6),
(29, 'Natan', 0, '2023-08-06', 'Noite', 2, 'aaa', 'aaa', 'aaa', 'Gravíssimo', NULL, 0x536e6170696e7374612e6170705f3334343632313232395f323735363039363634313139353739385f343736373937323135313337313936373637385f6e5f313038302e6a7067, 0),
(30, 'Natan', 0, '2023-08-06', 'Noite', 2, 'aaa', 'aaa', 'aaa', 'Gravíssimo', NULL, 0x536e6170696e7374612e6170705f3334343632313232395f323735363039363634313139353739385f343736373937323135313337313936373637385f6e5f313038302e6a7067, 0),
(31, 'Natan', 0, '2023-08-06', 'Noite', 2, 'aaa', 'aaasassss', 'aaa', 'Gravíssimo', NULL, 0x536e6170696e7374612e6170705f3334343632313232395f323735363039363634313139353739385f343736373937323135313337313936373637385f6e5f313038302e6a7067, 0),
(32, 'Natan', 0, '2023-08-01', 'Tarde', 1, 'aaa', 'daw 53235', '353', 'Gravíssimo', NULL, NULL, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `setor_id` (`setor_id`);

--
-- Índices para tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id_setor`);

--
-- Índices para tabela `tabela_desvio`
--
ALTER TABLE `tabela_desvio`
  ADD PRIMARY KEY (`id_desvio`),
  ADD KEY `user_matricula` (`user_matricula`),
  ADD KEY `setor` (`setor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tabela_desvio`
--
ALTER TABLE `tabela_desvio`
  MODIFY `id_desvio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id_setor`);

--
-- Limitadores para a tabela `tabela_desvio`
--
ALTER TABLE `tabela_desvio`
  ADD CONSTRAINT `tabela_desvio_ibfk_1` FOREIGN KEY (`user_matricula`) REFERENCES `cadastro` (`matricula`),
  ADD CONSTRAINT `tabela_desvio_ibfk_2` FOREIGN KEY (`setor`) REFERENCES `setores` (`id_setor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
