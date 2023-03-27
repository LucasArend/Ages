-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Out-2021 às 00:00
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ages`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `militares`
--

CREATE TABLE `militares` (
  `ID` int(11) NOT NULL,
  `companhia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `nomeguerra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situacao` int(255) DEFAULT NULL,
  `folgap` int(11) NOT NULL,
  `folgav` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

CREATE TABLE `situacao` (
  `ID` int(11) NOT NULL,
  `IDmilitar` int(11) DEFAULT NULL,
  `motivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dispensa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nivel` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nivel`, `login`, `senha`) VALUES
(0000000017, 1, '1', 'c4ca4238a0b923820dcc509a6f75849b'),
(0000000018, 2, '20', '98f13708210194c475687be6106a3b84'),
(0000000019, 3, 'TESTE', '698dc19d489c4e4db73e28a713eab07b'),
(0000000020, 1, 'adm', 'b09c600fddc573f117449b3723f23d64');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `militares`
--
ALTER TABLE `militares`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `situacao` (`situacao`);

--
-- Índices para tabela `situacao`
--
ALTER TABLE `situacao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDmilitar` (`IDmilitar`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `situacao`
--
ALTER TABLE `situacao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `militares`
--
ALTER TABLE `militares`
  ADD CONSTRAINT `militares_ibfk_1` FOREIGN KEY (`situacao`) REFERENCES `situacao` (`ID`);

--
-- Limitadores para a tabela `situacao`
--
ALTER TABLE `situacao`
  ADD CONSTRAINT `situacao_ibfk_1` FOREIGN KEY (`IDmilitar`) REFERENCES `militares` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
