-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/07/2024 às 19:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `coleta`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `impressoras`
--

CREATE TABLE `impressoras` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `c_anterior` int(11) NOT NULL,
  `cota` int(11) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `secao` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `impressoras`
--

INSERT INTO `impressoras` (`id`, `ip`, `c_anterior`, `cota`, `responsavel`, `secao`, `status`) VALUES
(2, '192.168.43.122', 0, 0, '', '', 0),
(3, '192.168.43.101', 543, 250, 'Sgt Pereira Santos', 'SIO', 0),
(4, '192.168.43.106', 0, 0, '', '', 0),
(5, '192.168.43.103', 0, 0, '', '', 0),
(6, '192.168.43.105', 0, 0, '', '', 0),
(7, '192.168.43.103', 0, 0, '', '', 0),
(8, '192.168.43.200', 0, 0, '', '', 0),
(9, '192.168.43.121', 0, 0, '', '', 0),
(10, '192.168.43.104', 0, 0, '', '', 0),
(11, '192.168.43.118', 0, 0, '', '', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `impressoras`
--
ALTER TABLE `impressoras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `impressoras`
--
ALTER TABLE `impressoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
