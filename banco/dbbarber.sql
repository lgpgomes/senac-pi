-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Nov-2021 às 15:51
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbbarber`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `ID` int(11) NOT NULL,
  `ID_SERV` int(11) NOT NULL,
  `DATA_HORA` datetime NOT NULL,
  `STATUS` tinyint(1) NOT NULL COMMENT '1 - Pendente 2 - Cancelado 3 - Concluido',
  `ID_FUNCIONARIO` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  `IMAGEM` varchar(150) NOT NULL,
  `ICONE` varchar(150) NOT NULL,
  `STATUS` tinyint(1) NOT NULL COMMENT '0 - Inativo 1 -Ativo '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `SENHA` varchar(300) NOT NULL,
  `EMAIL` varchar(256) NOT NULL,
  `TIPO` int(11) NOT NULL COMMENT 'Tipo de usuario 0-Adm 1- Funcionario 2- Cliente',
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `NOME`, `SENHA`, `EMAIL`, `TIPO`, `STATUS`) VALUES
(1, 'Admin', '123', 'admin@gmail.com', 0, 1),
(2, 'Cliente', '123', 'cliente@gmail.com', 2, 1),
(3, 'Funcionario', '123', 'funcionario@gmail.com', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_SERV` (`ID_SERV`),
  ADD KEY `ID_FUNCIONARIO` (`ID_FUNCIONARIO`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`) USING BTREE;

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`ID_FUNCIONARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `agendamento_ibfk_3` FOREIGN KEY (`ID_SERV`) REFERENCES `servico` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
