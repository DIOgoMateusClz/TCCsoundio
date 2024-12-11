-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/10/2024 às 21:53
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


CREATE TABLE IF NOT EXISTS `bandas` (
  `idBanda` int(11) NOT NULL AUTO_INCREMENT,
  `fotoBanda` varchar(300) NOT NULL,
  `nomeBanda` varchar(300) NOT NULL,
  `descricaoBanda` varchar(1000) NOT NULL,
  `cidadeBanda` varchar(100) NOT NULL,
  `estadoBanda` varchar(100) NOT NULL,
  `telefoneBanda` varchar(11) NOT NULL,
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
  `galeriaBanda` varchar(300) NOT NULL,
  `emailBanda` varchar(200) NOT NULL,
  `senhaBanda` varchar(400) NOT NULL,
  PRIMARY KEY (`idBanda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `bandas` 
(`fotoBanda`, `nomeBanda`, `descricaoBanda`, `cidadeBanda`, `estadoBanda`, `telefoneBanda`, `rock`, `heavyMetal`, `punk`, `hardcore`, `sertanejo`, `pagode`, `samba`, `gospel`, `rap`, `funk`, `MPB`, `emailBanda`, `senhaBanda`) 
VALUES
('img/bunkerLogo.png', 'Bunker Beer', 'balabasldasdha', 'Telemaco Borba', 'PR', '11111111111', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'bunker@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/logoKartus.png', 'KARTUS', 'sdasd', 'Telemaco Borba', 'PR', '1231231231123', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'kartus@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/logoVolters.png', 'The Volters', 'asdasdasdasd', 'Telemaco Borba', 'PR', '22222222222', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'thevolters@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/logoGroselha.png', 'Groselha Cry', 'sdasdasdad', 'Ponta Grossa', 'PR', '33333333333', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'groselha@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/logoEufoniks.png', 'Eufoniks', 'asdasdad', 'Florianópolis', 'SC', '44444444444', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eufoniks@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/killers.jpg', 'Iron Maiden', 'dasdasdasdas', 'Xique-Xique', 'BA', '55555555555', 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'ironmaiden@gmail.com', '202cb962ac59075b964b07152d234b70');



CREATE TABLE IF NOT EXISTS `empresas` (
  `idEmpresa` int(11) NOT NULL,
  `fotoEmpresa` varchar(300) NOT NULL,
  `nomeEmpresa` varchar(100) NOT NULL,
  `cnpjEmpresa` varchar(14) NOT NULL,
  `cepEmpresa` varchar(8) NOT NULL,
  `cidadeEmpresa` varchar(100) NOT NULL,
  `estadoEmpresa` char(2) NOT NULL,
  `telefoneEmpresa` varchar(14) NOT NULL,
  `descricaoEmpresa` varchar(1000) NOT NULL,
  `bar` tinyint(1) NOT NULL,
  `lanchonete` tinyint(1) NOT NULL,
  `restaurante` tinyint(1) NOT NULL,
  `casadeShows` tinyint(1) NOT NULL,
  `pizzaria` tinyint(1) NOT NULL,
  `centrodeEventos` tinyint(1) NOT NULL,
  `galeriaEmpresa` varchar(300) NOT NULL,
  `emailEmpresa` varchar(200) NOT NULL,
  `senhaEmpresa` varchar(400) NOT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `empresas` (`fotoEmpresa`, `nomeEmpresa`, `cnpjEmpresa`, `cepEmpresa`, `cidadeEmpresa`, `estadoEmpresa`, `telefoneEmpresa`, `descricaoEmpresa`, `bar`, `lanchonete`, `restaurante`, `casadeShows`, `pizzaria`, `centrodeEventos`, `emailEmpresa`, `senhaEmpresa`) VALUES
('img/bunkerLogo.png', 'Bunker Beer', '12311111111111', '12312312', 'Telêmaco Borba', 'PR', '54532232231', 'cdfdfdfdfdfdfdfdfd', 1, 1, 0, 0, 0, 0, 'bunker@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/quintsLogo.png', 'Quints', '11111111111111', '123123', 'Porto Alegre', 'MS', '123123122', 'asdasdas', 1, 0, 0, 0, 0, 0, 'quints@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/tecsLogo.png', 'Tecs', '22222222222222', '12312313', 'Brasilia', 'DF', '123123213', 'cdfdfdfdfdf', 0, 0, 1, 0, 1, 0, 'tecs@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/texas.jpg', 'Texas', '33333333333333', '12312312', 'Telêmaco Borba', 'PR', '123123123123', 'cdfdfdfdfdfdfdfdfd', 0, 1, 0, 1, 0, 1, 'texas@gmail.com', '202cb962ac59075b964b07152d234b70'),
('img/liminha.jpg', 'Liminha Bar', '44444444444444', '4343434', 'Rio de Janeiro', 'RJ', '12312312312', 'bonononono', 1, 0, 0, 1, 0, 0, 'liminha@gmail.com', '202cb962ac59075b964b07152d234b70');



CREATE TABLE IF NOT EXISTS `estados` (
  `siglaEstado` char(2) NOT NULL,
  `nomeEstado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO IF NOT EXISTS `estados` (`siglaEstado`, `nomeEstado`) VALUES
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
CREATE TABLE IF NOT EXISTS `soundio2`. `cidades`(
  `nomeCidade` char(50) NOT NULL,
  `idCidade` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--

INSERT INTO IF NOT EXISTS `cidades` (`nomeCidade`, `id`) VALUES
('Rio Branco', 1),
('Cruzeiro do Sul', 2),
('Senador Guiomard', 3),
('Plácido de Castro', 4),
('Tarauacá', 5),
('Xapuri', 6),
('Feijó', 7),
('Brasiléia', 8),
('Epitaciolândia', 9),
('Rio Branco', 10),
('Maceió', 11),
('Arapiraca', 12),
('Palmeira dos Índios', 13),
('Rio Largo', 14),
('Delmiro Gouveia', 15),
('Penedo', 16),
('União dos Palmares', 17),
('Pilar', 18),
('São Miguel dos Campos', 19),
('Coruripe', 20),
('Manaus', 21),
('Parintins', 22),
('Itacoatiara', 23),
('Maués', 24),
('Manacapuru', 25),
('Tefé', 26),
('Coari', 27),
('Tabatinga', 28),
('Humaitá', 29),
('São Gabriel da Cachoeira', 30),
('Macapá', 31),
('Santana', 32),
('Laranjal do Jari', 33),
('Oiapoque', 34),
('Pedra Branca do Amapá', 35),
('Vitória do Jari', 36),
('Tartarugalzinho', 37),
('Porto Grande', 38),
('Mazagão', 39),
('Amapá', 40),
('Salvador', 41),
('Feira de Santana', 42),
('Vitória da Conquista', 43),
('Camaçari', 44),
('Ilhéus', 45),
('Juazeiro', 46),
('Lauro de Freitas', 47),
('Itabuna', 48),
('Jequié', 49),
('Porto Seguro', 50),
('Fortaleza', 51),
('Caucaia', 52),
('Juazeiro do Norte', 53),
('Maracanaú', 54),
('Sobral', 55),
('Crato', 56),
('Aquiraz', 57),
('Iguatu', 58),
('Russas', 59),
('Quixadá', 60),
('Brasília', 61),
('Gama', 62),
('Taguatinga', 63),
('Ceilândia', 64),
('Águas Claras', 65),
('Samambaia', 66),
('Planaltina', 67),
('Santa Maria', 68),
('Guará', 69),
('Sobradinho', 70),
('Vitória', 71),
('Serra', 72),
('Cachoeiro de Itapemirim', 73),
('Vila Velha', 74),
('Linhares', 75),
('Cariacica', 76),
('Colatina', 77),
('Guarapari', 78),
('São Mateus', 79),
('Aracruz', 80),
('Goiânia', 81),
('Aparecida de Goiânia', 82),
('Anápolis', 83),
('Rio Verde', 84),
('Luziânia', 85),
('Goiatuba', 86),
('Catalão', 87),
('Jataí', 88),
('Caldas Novas', 89),
('Itumbiara', 90),
('São Luís', 91),
('Imperatriz', 92),
('Caxias', 93),
('Timon', 94),
('Codó', 95),
('Açailândia', 96),
('Bacabal', 97),
('Chapadinha', 98),
('Barreirinhas', 99),
('Pinheiro', 100),
('Belo Horizonte', 101),
('Uberlândia', 102),
('Contagem', 103),
('Juiz de Fora', 104),
('Betim', 105),
('Montes Claros', 106),
('Uberaba', 107),
('Governador Valadares', 108),
('Nova Lima', 109),
('Ipatinga', 110),
('Campo Grande', 111),
('Dourados', 112),
('Três Lagoas', 113),
('Corumbá', 114),
('Ponta Porã', 115),
('Paranaíba', 116),
('Naviraí', 117),
('Coxim', 118),
('Aquidauana', 119),
('Itaquiraí', 120),
('Cuiabá', 121),
('Várzea Grande', 122),
('Rondonópolis', 123),
('Sinop', 124),
('Lucas do Rio Verde', 125),
('Tangará da Serra', 126),
('Cáceres', 127),
('Sorriso', 128),
('Barra do Garças', 129),
('Alta Floresta', 130),
('Belém', 131),
('Ananindeua', 132),
('Santarém', 133),
('Marabá', 134),
('Castanhal', 135),
('Parauapebas', 136),
('Benevides', 137),
('São Félix do Xingu', 138),
('Bragança', 139),
('Altamira', 140),
('João Pessoa', 141),
('Campina Grande', 142),
('Santa Rita', 143),
('Patos', 144),
('Bayeux', 145),
('Cajazeiras', 146),
('Sousa', 147),
('Cabedelo', 148),
('Monteiro', 149),
('Esperança', 150),
('Recife', 151),
('Olinda', 152),
('Jaboatão dos Guararapes', 153),
('Caruaru', 154),
('Petrolina', 155),
('Garanhuns', 156),
('Camaragibe', 157),
('Igarassu', 158),
('Vitória de Santo Antão', 159),
('Paudalho', 160),
('Teresina', 161),
('Parnaíba', 162),
('Picos', 163),
('Campo Maior', 164),
('Piripiri', 165),
('Floriano', 166),
('Altos', 167),
('São Raimundo Nonato', 168),
('Oeiras', 169),
('Bom Jesus', 170),
('Curitiba', 171),
('Maringá', 172),
('Londrina', 173),
('Ponta Grossa', 174),
('Cascavel', 175),
('Foz do Iguaçu', 176),
('São José dos Pinhais', 177),
('Colombo', 178),
('Araucária', 179),
('Guarapuava', 180),
('Rio de Janeiro', 181),
('Niterói', 182),
('Nova Iguaçu', 183),
('Duque de Caxias', 184),
('Cabo Frio', 185),
('São Gonçalo', 186),
('Belford Roxo', 187),
('Magé', 188),
('Natal', 189),
('Mossoró', 190),
('Parnamirim', 191),
('Caicó', 192),
('Currais Novos', 193),
('Açu', 194),
('São Gonçalo do Amarante', 195),
('João Câmara', 196),
('Pau dos Ferros', 197),
('São José de Mipibu', 198),
('Porto Velho', 199),
('Ji-Paraná', 200),
('Ariquemes', 201),
('Vilhena', 202),
('Cacoal', 203),
('Rolim de Moura', 204),
('Jaru', 205),
('Guajará-Mirim', 206),
('Pimenta Bueno', 207),
('Machadinho do Oeste', 208),
('Boa Vista', 209),
('Rorainópolis', 210),
('Caroebe', 211),
('Serrinha', 212),
('São João da Baliza', 213),
('Mucajaí', 214),
('Normandia', 215),
('Iracema', 216),
('Cantá', 217),
('Pacaraima', 218),
('Porto Alegre', 219),
('Caxias do Sul', 220),
('Pelotas', 221),
('Santa Maria', 222),
('Gravataí', 223),
('Canoas', 224),
('Novo Hamburgo', 225),
('São Leopoldo', 226),
('Bagé', 227),
('Passo Fundo', 228),
('Florianópolis', 229),
('Joinville', 230),
('Blumenau', 231),
('Chapecó', 232),
('São José', 233),
('Itajaí', 234),
('Lages', 235),
('Criciúma', 236),
('Laguna', 237),
('Mafra', 238),
('Aracaju', 239),
('Lagarto', 240),
('Nossa Senhora do Socorro', 241),
('Itabaiana', 242),
('Estância', 243),
('São Cristóvão', 244),
('Propriá', 245),
('Tobias Barreto', 246),
('Barra dos Coqueiros', 247),
('Simão Dias', 248),
('São Paulo', 249),
('Guarulhos', 250),
('Campinas', 251),
('São Bernardo do Campo', 252),
('Santo André', 253),
('Osasco', 254),
('Ribeirão Preto', 255),
('Sorocaba', 256),
('Mauá', 257),
('São José dos Campos', 258),
('Palmas', 259),
('Araguaína', 260),
('Gurupi', 261),
('Paraíso do Tocantins', 262),
('Porto Nacional', 263),
('Tocantinópolis', 264),
('Miracema do Tocantins', 265),
('Araguatins', 266),
('Dianópolis', 267),
('Xambioá', 268);




CREATE TABLE IF NOT EXISTS `soundio2`.`eventos` (
  `idEvento` INT NOT NULL AUTO_INCREMENT,
  `nomeEvento` VARCHAR(300) NOT NULL,
  `horaEvento` VARCHAR(5) NOT NULL,
  `dataEvento` DATE NOT NULL,
  `descricaoEvento` TEXT,
  `precoEvento` DECIMAL(10,2) NOT NULL,
  `fotoEvento` VARCHAR(300),
  `localEvento` TEXT,
  `idEmpresa` INT NOT NULL,
  `idBanda` INT NOT NULL,
  PRIMARY KEY (`idEvento`),
  INDEX `fk_eventos_empresas1_idx` (`idEmpresa` ASC),
  INDEX `fk_eventos_bandas1_idx` (`idBanda` ASC),
  CONSTRAINT `fk_eventos_empresas1`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `soundio2`.`empresas` (`idEmpresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_bandas1`
    FOREIGN KEY (`idBanda`)
    REFERENCES `soundio2`.`bandas` (`idBanda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


ALTER TABLE `bandas`
ADD `tipoUsuario` VARCHAR(10) NOT NULL DEFAULT 'banda';


ALTER TABLE `empresas`
ADD `tipoUsuario` VARCHAR(10) NOT NULL DEFAULT 'empresa';

ALTER TABLE `bandas`
  ADD PRIMARY KEY (`idBanda`);


ALTER TABLE `empresas`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `fk_estado_empresa` (`estadoEmpresa`);


ALTER TABLE `estados`
  ADD PRIMARY KEY (`siglaEstado`);


ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`);


ALTER TABLE `bandas`
  MODIFY `idBanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `empresas`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;


ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `cidades` ADD `id` INT AUTO_INCREMENT PRIMARY KEY;

ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_estado_empresa` FOREIGN KEY (`estadoEmpresa`) REFERENCES `estados` (`siglaEstado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
