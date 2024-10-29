-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/10/2024 às 21:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `soundio2`
--

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estrutura para tabela `bandas`
--

CREATE TABLE `bandas` (
  `idBanda` int(11) NOT NULL,
  `fotoBanda` varchar(300) NOT NULL,
  `nomeBanda` varchar(300) NOT NULL,
  `descricaoBanda` varchar(300) NOT NULL,
  `cidadeBanda` varchar(100) NOT NULL,
  `estadoBanda` varchar(100) NOT NULL,
  `telefoneBanda` varchar(14) NOT NULL,
  `rock` tinyint(1) NOT NULL,
  `heavyMetal` tinyint(1) NOT NULL,
  `punk` tinyint(1) NOT NULL,
  `hardcore` tinyint(1) NOT NULL,
  `sertanejo` tinyint(1) NOT NULL,
  `pagode` tinyint(1) NOT NULL,
  `samba` tinyint(1) NOT NULL,
  `gospel` tinyint(1) NOT NULL,
  `rap` tinyint(1) NOT NULL,
  `funk` tinyint(1) NOT NULL,
  `MPB` tinyint(1) NOT NULL,
  `emailBanda` varchar(200) NOT NULL,
  `senhaBanda` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bandas` (`idBanda`, `fotoBanda`, `nomeBanda`, `descricaoBanda`, `cidadeBanda`, `estadoBanda`,
`telefoneBanda`, `rock`, `heavyMetal`, `punk`, `hardcore`, `sertanejo`, `pagode`, `samba`, `gospel`, `rap`, `funk`, `MPB`,`emailBanda`, `senhaBanda`) VALUES
(1, 'img/bunkerLogo.png', 'Bunker Beer', 'balabasldasdha', 'Telemaco Borba', 'PR', '12312312123', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'bunker@gmail.com', '202cb962ac59075b964b07152d234b70');


-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `idEmpresa` int(11) NOT NULL,
  `fotoEmpresa` varchar(300) NOT NULL,
  `nomeEmpresa` varchar(100) NOT NULL,
  `cnpjEmpresa` varchar(18) NOT NULL,
  `cepEmpresa` varchar(8) NOT NULL,
  `cidadeEmpresa` varchar(100) NOT NULL,
  `estadoEmpresa` char(2) NOT NULL,
  `telefoneEmpresa` varchar(14) NOT NULL,
  `descricaoEmpresa` varchar(300) NOT NULL,
  `bar` tinyint(1) NOT NULL,
  `lanchonete` tinyint(1) NOT NULL,
  `restaurante` tinyint(1) NOT NULL,
  `casadeShows` tinyint(1) NOT NULL,
  `pizzaria` tinyint(1) NOT NULL,
  `centrodeEventos` tinyint(1) NOT NULL,
  `emailEmpresa` varchar(200) NOT NULL,
  `senhaEmpresa` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`idEmpresa`, `fotoEmpresa`, `nomeEmpresa`, `cnpjEmpresa`, `cepEmpresa`, `cidadeEmpresa`, `estadoEmpresa`,
`telefoneEmpresa`, `descricaoEmpresa`, `bar`, `lanchonete`, `restaurante`, `casadeShows`, `pizzaria`, `centrodeEventos`, `emailEmpresa`, `senhaEmpresa`) VALUES
(1, 'img/bunkerLogo.png', 'Bunker Beer', '12.123.123/0001-12', '23123120', 'Telemaco Borba', 'PR', '(42) 99999-999', 'BAR DE ROCK', 1, 1, 0, 0, 0, 0, 'bunker@gmail.com', '202cb962ac59075b964b07152d234b70');


-- --------------------------------------------------------

--
-- Estrutura para tabela `estados`
--

CREATE TABLE `estados` (
  `siglaEstado` char(2) NOT NULL,
  `nomeEstado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estados`
--

INSERT INTO `estados` (`siglaEstado`, `nomeEstado`) VALUES
('AC', 'Acre'),
('AL', 'Alagoas'),
('AM', 'Amazonas'),
('AP', 'Amapá'),
('BA', 'Bahia'),
('CE', 'Ceará'),
('DF', 'Distrito Federal'),
('ES', 'Espírito Santo'),
('GO', 'Goiás'),
('MA', 'Maranhão'),
('MG', 'Minas Gerais'),
('MS', 'Mato Grosso do Sul'),
('MT', 'Mato Grosso'),
('PA', 'Pará'),
('PB', 'Paraíba'),
('PE', 'Pernambuco'),
('PI', 'Piauí'),
('PR', 'Paraná'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RO', 'Rondônia'),
('RR', 'Roraima'),
('RS', 'Rio Grande do Sul'),
('SC', 'Santa Catarina'),
('SE', 'Sergipe'),
('SP', 'São Paulo'),
('TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL,
  `nomeEvento` varchar(300) NOT NULL,
  `horaEvento` varchar(5) NOT NULL,
  `dataEvento` varchar(8) NOT NULL,
  `descricaoEvento` varchar(300) NOT NULL,
  `cidadeEvento` varchar(100) NOT NULL,
  `estadoEvento` varchar(100) NOT NULL,
  `precoEvento` varchar(8) NOT NULL,
  `contatoEvento` varchar(14) NOT NULL,
  `fotoEvento` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--

-- Índices de tabela `bandas`
--
ALTER TABLE `bandas`
  ADD PRIMARY KEY (`idBanda`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `fk_estado_empresa` (`estadoEmpresa`);

--
-- Índices de tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`siglaEstado`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--

-- AUTO_INCREMENT de tabela `bandas`
--
ALTER TABLE `bandas`
  MODIFY `idBanda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--

-- Restrições para tabelas `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_estado_empresa` FOREIGN KEY (`estadoEmpresa`) REFERENCES `estados` (`siglaEstado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
