-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/11/2023 às 20:43
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetoreservasalas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`id`, `title`) VALUES
(5, 'fffffffffffff'),
(6, 'wwwwwwwwwwwww');

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(220) NOT NULL,
  `color` varchar(45) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'Tutorial 1', '#FFD700', '2023-10-16 10:05:00', '2023-10-16 11:05:00'),
(2, 'Tutorial 2', '#0071c5', '2023-10-18 10:06:00', '2023-10-18 11:06:00'),
(3, 'Tutorial 3', '#40e0d0', '2023-10-20 10:07:00', '2023-10-20 11:07:00'),
(4, 'Tutorial 4', '#FFD700', '2023-10-23 10:08:00', '2023-10-23 11:08:00'),
(5, 'Tutorial 5', '#40e0d0', '2023-10-25 10:09:00', '2023-10-26 11:09:00'),
(6, 'Tutorial 6', '#0071c5', '2023-10-27 10:10:00', '2023-10-27 11:10:00'),
(7, 'Tutorial 7', '#A020F0', '2023-10-30 10:05:00', '2023-10-30 11:05:00'),
(8, 'Tutorial 8', '#8B0000', '2023-11-01 00:00:00', '2023-11-01 00:00:00'),
(9, 'Tutorial 9', '#FF4500', '2023-11-03 10:01:00', '2023-11-03 10:01:00'),
(10, 'Tutorial 10', '#228B22', '2023-11-06 10:01:00', '2023-11-06 10:01:00'),
(11, 'Tutorial 11', '#8B4513', '2023-11-08 10:01:00', '2023-11-08 10:01:00'),
(12, 'Tutorial 12', '#FFD700', '2023-11-10 10:01:00', '2023-11-10 10:01:00'),
(13, 'Tutorial 13', '#40E0D0', '2023-11-13 00:00:00', '2023-11-14 00:00:00'),
(14, 'Tutorial 14', '#436EEE', '2023-11-15 10:00:00', '2023-11-16 10:00:00'),
(15, 'Tutorial 15', '#1C1C1C', '2023-11-17 10:00:00', '2023-11-17 10:00:00'),
(16, 'Tutorial 16', '#228B22', '2023-11-20 10:00:00', '2023-11-20 10:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `periodo`
--

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `periodo`
--

INSERT INTO `periodo` (`id`, `nome`) VALUES
(1, 'Manhã'),
(2, 'Tarde'),
(3, 'Noite');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `sala_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `dia` date NOT NULL,
  `professor_desc` varchar(255) DEFAULT NULL,
  `disciplina_desc` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 reservada, 2 confirmada, 3 cancelada ',
  `observacao` text DEFAULT NULL,
  `data_final` date DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

INSERT INTO `reserva` (`id`, `sala_id`, `periodo_id`, `dia`, `professor_desc`, `disciplina_desc`, `status`, `observacao`, `data_final`) VALUES
(59, 1, 1, '2023-10-02', 'Nairo', 'Informática Fundamental', 1, '40 cadeiras', '0000-00-00'),
(60, 1, 2, '2023-10-02', 'João Muniz ', '', 2, 'Lógica de programação ', NULL),
(61, 1, 2, '2023-10-09', 'João Muniz ', '', 2, 'Lógica de programação ', NULL),
(62, 1, 2, '2023-10-16', 'João Muniz ', '', 2, 'Lógica de programação ', NULL),
(63, 1, 2, '2023-10-23', 'João Muniz ', '', 2, 'Lógica de programação ', NULL),
(64, 1, 2, '2023-10-30', 'João Muniz ', '', 2, 'Lógica de programação ', NULL),
(65, 1, 2, '2023-10-04', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(66, 1, 2, '2023-10-11', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(67, 1, 2, '2023-10-18', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(68, 1, 2, '2023-10-25', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(69, 1, 2, '2023-11-01', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(70, 1, 2, '2023-10-06', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(71, 1, 2, '2023-10-13', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(72, 1, 2, '2023-10-20', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(73, 1, 2, '2023-10-27', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(74, 1, 2, '2023-11-03', 'João Muniz ', 'Lógica de programação 4499', 2, '', NULL),
(80, 12, 1, '2023-10-04', 'd', 'd', 1, 'd', NULL),
(83, 10, 3, '2023-10-31', 'Nairo', 'TI', 1, '', NULL),
(84, 1, 1, '2023-11-07', 'Daniel', 'daniel adventure', 1, 'daniel', '2023-11-07'),
(86, 1, 2, '2023-11-08', 'ef', 'fefe', 1, 'dafsdsafdsa', '2023-11-09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2048 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `sala`
--

INSERT INTO `sala` (`id`, `nome`) VALUES
(1, 'Lab 101'),
(2, 'Sala 102'),
(3, 'Sala 103'),
(4, 'Lab 104'),
(5, 'Sala 203'),
(6, 'Sala 204'),
(10, 'Lab 209'),
(11, 'Lab 209'),
(12, 'Lab 205');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(3, 'Senac', 'senac@gmail.com', '5aa8cd90d7f70cee9eb45c23202c808c'),
(11, 'Daniel Kloh', 'daniel@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_periodo_id` (`id`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_reserva_id` (`id`),
  ADD UNIQUE KEY `UK_reserva` (`sala_id`,`periodo_id`,`dia`),
  ADD KEY `IDX_reserva_dia` (`dia`),
  ADD KEY `IDX_reserva_status` (`status`),
  ADD KEY `FK_reserva_periodo_id` (`periodo_id`);

--
-- Índices de tabela `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_sala_id` (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_usuario_id` (`id`),
  ADD UNIQUE KEY `UK_usuario_email` (`email`(15));

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_reserva_periodo_id` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`),
  ADD CONSTRAINT `FK_reserva_sala_id` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
