-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 10/02/2017 às 21:33
-- Versão do servidor: 10.1.13-MariaDB
-- Versão do PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojasimples`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `buscas`
--

CREATE TABLE `buscas` (
  `data` date NOT NULL,
  `busca` varchar(64) NOT NULL,
  `usuario` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `buscas`
--

INSERT INTO `buscas` (`data`, `busca`, `usuario`) VALUES
('2017-02-04', 'coelho', 'rafael@email.com'),
('2017-02-04', 'jamanta', ''),
('2017-02-04', 'jaburu', ''),
('2017-02-04', 'mousepad', 'Rafael'),
('2017-02-04', 'mousepad', ''),
('2017-02-04', 'palito', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(32) NOT NULL,
  `id_set` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `id_set`) VALUES
(1, 'Processadores', 1),
(2, 'Placas-Mãe', 1),
(3, 'Memórias RAM', 1),
(4, 'Discos Rígidos (HDD)', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `sobrenome` varchar(64) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cpf` varchar(14) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(128) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `bairro` varchar(128) NOT NULL,
  `cidade` varchar(64) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `clientes`
--

INSERT INTO `clientes` (`id`, `email`, `nome`, `sobrenome`, `senha`, `ativo`, `data`, `cpf`, `celular`, `telefone`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `uf`) VALUES
(2, 'elenildoms@gmail.com', 'Elenildo', 'Santos', 'asd', 0, '2017-01-23 01:30:57', '97314250804', '12 98478-5488', '12 3587-5102', '12235000', 'Avenida Guadalupe', '190', 'Jardim AmÃ©rica', 'SÃ£o JosÃ© dos Campos', 'SP'),
(3, 'maria@email.com', 'Maria', 'Santos', '123', 1, '2017-01-30 23:13:05', '2342342343', '15 987452154', '12 35898899', '13465410', 'Rua Comendador Müller', '28', 'Vila Rehder', 'Americana', 'SP'),
(4, 'pedro@email.com', 'Pedro', 'Santos', 'asd', 1, '2017-01-31 01:00:54', '234342364', '98421-5874', '5874-6301', '57140000', 'Rua Joema Santana', '258', 'Limão', 'São Paulo', 'SP'),
(5, 'marcio@gmail.com', 'Marcio', 'Souza', '123', 1, '2017-01-31 02:55:12', '987989787', '985548750', '58710258', '64230000', 'Rua das serpentes', '22', 'Mourão', 'Buriti dos Lopes', 'PI'),
(6, 'elisa@hotmail.com', 'Elisa', 'Andrade', 'asd', 1, '2017-01-31 03:11:42', '34534543', '987542211', '87542111', '64230-000', 'Melões', '23', 'Santo Zé', 'Buriti dos Lopes', 'PI'),
(7, 'ana@asdasd.com', 'Ana', 'Almeida', 'asd', 1, '2017-02-02 18:20:03', '5645645345', '564321322', '2132132', '12235000', 'Amauri de cAmpos', '879', 'Perdizes', 'Campinas', 'SP'),
(8, 'renato@email.com', 'Renato', 'Duque', 'asd', 1, '2017-02-04 00:31:16', '23445423464', '124455555', '98754555', '12235000', 'Avenida Guadalupe', '662', 'Jardim AmÃ©rica', 'SÃ£o JosÃ© dos Campos', 'SP'),
(9, 'sonia@gmail.com', 'Sonia', 'Cavalcant', '123', 1, '2017-02-04 15:00:13', '54678964233', '952102587', '54871205', '97105140', 'Rua Ernesto Pereira', '239', 'Camobi', 'Santa Maria', 'RS'),
(10, 'rafael@email.com', 'Rafael', 'Camargo', '123', 1, '2017-02-04 15:05:42', '78945609723', '952140210', '39852145', '24804652', 'Avenida Professora Cecília Augusta dos Santos', '392', 'Venda das Pedras', 'ItaboraÃ­', 'RJ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `id_produto` int(11) NOT NULL,
  `produto` varchar(32) NOT NULL,
  `preco_compra` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fornecedor` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `compras`
--

INSERT INTO `compras` (`id`, `data`, `id_produto`, `produto`, `preco_compra`, `quantidade`, `fornecedor`) VALUES
(9, '2017-03-02', 12, 'Camera Digital Nikon F67', 790.75, 20, 'Nakata Importações'),
(10, '2017-03-02', 18, 'Monitor 22 polegadas', 287.9, 10, 'loja da esquina'),
(11, '2017-03-02', 6, 'Placa de vídeo', 525.8, 10, 'loja da esquina'),
(12, '2017-03-02', 37, 'Placa de Rede Ethernet TP-link', 42, 10, 'camelô da 25 de março'),
(13, '2017-03-02', 13, 'Fone de ouvido StormSound. Alter', 35.8, 10, ''),
(14, '2017-03-02', 41, 'Placa de rede 10/100', 42.7, 18, ''),
(16, '2017-03-02', 40, 'WebCam Dadoa', 15.7, 20, 'Art Suprimentos Hi-tec'),
(17, '2017-03-02', 42, 'Câmera Digital Canon', 238.5, 15, 'MegaHard Eletronicos'),
(18, '2017-03-02', 36, 'Multifuncional HP 680', 138.85, 5, 'loja da esquina'),
(19, '2017-03-02', 39, 'Roteador Wireless D-link D400', 48.87, 20, 'Nakata Importações'),
(20, '2017-03-02', 38, 'Estabilizador 100 VA Energizer', 85.29, 10, 'MegaHard Eletronicos'),
(21, '2017-03-02', 35, 'HD Seagate Barracuda 2TB. Altera', 125.8, 30, 'MegaZord Eletrônicos'),
(22, '2017-03-02', 34, 'Gabinete xGamer', 85.9, 10, 'Xian Xiong Importações'),
(23, '2017-03-02', 31, 'Fonte Corsair CX430', 175.9, 10, 'BravoGun Acessórios'),
(24, '2017-03-02', 23, 'SSD Samsung 480 GB', 420.7, 25, 'Xian Xiong Importações'),
(25, '2017-03-02', 22, 'Processador AMD FX 6300', 315.9, 10, 'Nakata Importações'),
(26, '2017-03-02', 21, 'Processador Intel Core2 QUAD ', 215.7, 8, 'BravoGun Acessórios'),
(27, '2017-03-02', 20, 'Processador Intel Core2 DUO E420', 125.7, 12, 'Casa do Hardware'),
(28, '2017-03-02', 16, 'Placa Mãe ASUS Phodástica', 820.7, 5, 'Casa do Hardware'),
(29, '2017-03-02', 1, 'Processador i7 Quad Core', 1100, 8, 'Xian Xiong Importações'),
(30, '2017-03-02', 15, 'Mouse sem fio Logitec', 19.9, 20, 'Nakata Importações'),
(31, '2017-02-03', 5, 'Memória Corsair 4GB DDR4', 85.6, 30, 'Casa das Memórias'),
(32, '2017-02-03', 6, 'Placa de vÃ­deo Geforce GTX 480', 100, 5, 'asdas'),
(33, '2017-02-04', 7, 'Smartphone Galaxy J7', 580, 10, 'Xian Xiong Importações'),
(34, '2017-04-02', 17, 'Iphone 7', 2700, 5, 'Casa do Hardware'),
(35, '2017-04-02', 14, 'Notebook Acer Aspire', 1300, 5, 'Art Suprimentos Hi-tec'),
(36, '2017-02-03', 43, 'Placa de Som Creative Audigy2 ', 650, 5, 'Xian Xiong Importações'),
(37, '2017-02-04', 36, 'Multifuncional HP 680', 85.9, 10, 'BravoGun Acessórios'),
(38, '2017-04-02', 22, 'Processador AMD FX 6300', 230, 10, 'BravoGun Acessórios'),
(39, '2017-05-02', 4, 'Tablet Samsung N34', 653.88, 15, 'Importer SA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco` float NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `item_pedido`
--

INSERT INTO `item_pedido` (`id`, `id_pedido`, `id_produto`, `preco`, `quantidade`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 1, 1543, 1),
(3, 3, 20, 350, 1),
(4, 3, 18, 750, 1),
(5, 4, 13, 138.5, 1),
(6, 4, 23, 680, 1),
(7, 4, 41, 125.9, 1),
(8, 4, 15, 25.58, 1),
(9, 5, 37, 75.8, 2),
(10, 5, 41, 125.9, 5),
(11, 5, 13, 138.5, 1),
(12, 6, 12, 2350, 1),
(13, 7, 41, 125.9, 1),
(14, 8, 6, 1543, 1),
(15, 9, 18, 750, 1),
(16, 10, 20, 350, 1),
(17, 10, 39, 235.85, 1),
(18, 11, 38, 135.58, 1),
(19, 12, 17, 3200, 1),
(20, 13, 1, 1543, 2),
(21, 13, 13, 138.5, 3),
(22, 14, 42, 1350, 3),
(23, 15, 6, 1543, 1),
(24, 16, 34, 200, 1),
(25, 17, 7, 1000, 1),
(26, 17, 21, 450, 1),
(27, 17, 35, 320, 2),
(28, 17, 31, 250, 1),
(29, 18, 18, 750, 1),
(30, 18, 23, 680, 1),
(31, 18, 36, 100, 1),
(32, 19, 36, 100, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal` float NOT NULL,
  `frete` float NOT NULL,
  `desconto` float NOT NULL,
  `total` float NOT NULL,
  `status` varchar(10) NOT NULL,
  `formapg` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `data`, `subtotal`, `frete`, `desconto`, `total`, `status`, `formapg`) VALUES
(1, 2, '2017-01-28 23:44:27', 1543, 59.35, 231.45, 1370.9, 'Pendente', 'boleto'),
(2, 2, '2017-01-29 00:41:43', 1543, 30.65, 231.45, 1342.2, 'Finalizado', 'boleto'),
(3, 2, '2017-01-29 00:57:30', 1100, 91.08, 165, 1026.08, 'Finalizado', 'boleto'),
(4, 3, '2017-01-30 23:15:13', 969.98, 59.35, 145.497, 883.833, 'Finalizado', 'boleto'),
(5, 3, '2017-01-31 00:55:55', 919.6, 38.05, 137.94, 819.71, 'Finalizado', 'boleto'),
(6, 4, '2017-01-31 02:13:02', 2350, 30.65, 352.5, 2028.15, 'Finalizado', 'boleto'),
(7, 4, '2017-01-31 02:49:54', 125.9, 86.25, 18.885, 193.265, 'Cancelado', 'boleto'),
(8, 5, '2017-01-31 03:08:00', 1543, 98.85, 231.45, 1410.4, 'Finalizado', 'boleto'),
(9, 6, '2017-01-31 03:15:17', 750, 98.85, 112.5, 736.35, 'Finalizado', 'boleto'),
(10, 6, '2017-01-31 03:17:52', 585.85, 41.45, 87.8775, 539.422, 'Finalizado', 'boleto'),
(11, 7, '2017-02-02 18:29:19', 135.58, 30.65, 20.337, 145.893, 'Finalizado', 'boleto'),
(12, 2, '2017-02-03 18:31:56', 3200, 59.35, 480, 2779.35, 'Pendente', 'boleto'),
(13, 2, '2017-02-03 21:48:35', 3501.5, 30.65, 525.225, 3006.93, 'Finalizado', 'boleto'),
(14, 8, '2017-02-04 01:02:25', 4050, 30.65, 607.5, 3473.15, 'Finalizado', 'boleto'),
(15, 8, '2017-02-04 01:22:28', 1543, 59.35, 231.45, 1370.9, 'Finalizado', 'boleto'),
(16, 9, '2017-02-04 15:04:22', 200, 25.45, 30, 195.45, 'Finalizado', 'boleto'),
(17, 10, '2017-02-04 15:08:08', 2340, 32.25, 351, 2021.25, 'Finalizado', 'boleto'),
(18, 2, '2017-02-04 16:47:23', 1530, 30.65, 229.5, 1331.15, 'Finalizado', 'boleto'),
(19, 2, '2017-02-04 17:39:40', 300, 30.65, 45, 285.65, 'Finalizado', 'boleto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(32) NOT NULL,
  `descricao` varchar(64) NOT NULL,
  `preco` float NOT NULL,
  `estoque` int(11) NOT NULL,
  `detalhes` text NOT NULL,
  `imagem` varchar(32) NOT NULL,
  `destaque` tinyint(1) NOT NULL,
  `id_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `estoque`, `detalhes`, `imagem`, `destaque`, `id_sub`) VALUES
(1, 'Processador i7 Quad Core', 'Este é um bom processador. Mudei aqui.', 1543, 6, '<p>Processador &eacute; muito bom e caro.</p>\r\n', 'img/2017.01.17-16.14.44.jpg', 1, 2),
(4, 'Tablet Samsung N34', 'Tablet de alta performance', 845.5, 15, 'Este aparelho é muito legal.', 'img/2017.01.17-17.02.23.jpg', 0, 0),
(5, 'Memória Corsair 4GB DDR4', 'Par de memórias para dual channel', 235, 30, '<p>Memória de alto desempenho pra aplica&ccedil;&otilde;es que exigem um bom PC</p>\r\n', 'img/2017.01.17-16.13.17.jpg', 1, 14),
(6, 'Placa de vídeo Geforce GTX 480', 'Placa das boas.<br>Só não é melhor do que a minha.', 1543, 13, '<p>Essa &eacute; pra fan&aacute;ticos por games</p>\r\n', 'img/2017.01.17-19.59.28.jpg', 1, 23),
(7, 'Smartphone Galaxy J7', 'Este é um bom e caro aparelho.<br>Esse é muito bom.', 1000, 9, '<p>Aparelho para entusiastas e pederastas.<br />\r\nEsse &eacute; bom.</p>\r\n', 'img/2017.01.17-17.03.33.jpg', 1, 22),
(12, 'Câmera Digital Nikon F67', 'Câmera de alto custo', 2350, 20, '<p>B&atilde;o</p>\r\n', 'img/2017.01.17-17.04.15.jpg', 1, 9),
(13, 'Fone de ouvido StormSound. Alter', 'O melhor em som de alta definição', 138.5, 5, '<p>asdasd</p>\r\n', 'img/2017.01.17-17.04.28.jpg', 1, 13),
(14, 'Notebook Acer Aspire', 'Notebook para tarefas simples como navegar na internet, trabalha', 1650, 5, '<p>Notebook para tarefas simples como navegar na internet, trabalhar e jogar games online.</p>\r\n', 'img/2017.01.17-18.27.42.jpg', 1, 24),
(15, 'Mouse sem fio Logitec', 'Mouse para entusiastas e jogadores.', 25.58, 19, '<p>asdasdads</p>\r\n', 'img/2017.01.17-17.06.29.jpg', 1, 17),
(16, 'Placa Mãe ASUS Phodástica', 'Placa pra que curte pC do bom. Alterei aqui.', 1200, 5, '<p>asdasd</p>\r\n', 'img/2017.01.17-18.16.05.jpg', 1, 1),
(17, 'Iphone 7', 'Celular pra playboy', 3200, 5, '<p>asdasd</p>\r\n', 'img/2017.01.17-19.50.11.jpg', 1, 1),
(18, 'Monitor 22 polegadas', 'monitor legalzin. alterei de novo.', 750, 7, 'asdasd', 'img/2017.01.17-20.02.19.jpg', 1, 16),
(20, 'Processador Intel Core2 DUO E420', 'Processador para máquinas mais modestas', 350, 12, '<p>sdfsdfsdf</p>\r\n', 'img/2017.01.18-17.29.31.jpg', 1, 1),
(21, 'Processador Intel Core2 QUAD ', 'Processador dos melhores', 450, 7, 'ssadasd', 'img/2017.01.18-17.29.57.jpg', 1, 1),
(22, 'Processador AMD FX 6300', 'Processador para máquinas intermediárias', 480, 20, '<p>dasdasdas</p>\r\n', 'img/2017.01.18-17.30.19.jpg', 1, 1),
(23, 'SSD Samsung 480 GB', 'Disco de alta velocidade', 680, 22, '<p>Disco em estado sólido de alta capacidade e velocidade<br />\r\nIdeal pra que deseja rapidez ao carregar seus programas.</p>\r\n', 'img/2017.01.19-00.16.40.jpg', 1, 5),
(31, 'Fonte Corsair CX430', 'Fonte de 430W para suportar', 250, 9, 'adsda', 'img/2017.01.19-00.53.54.jpg', 1, 6),
(34, 'Gabinete xGamer', 'Gabinete grande para jogadores', 200, 9, '', 'img/2017.01.20-15.44.15.jpg', 1, 8),
(35, 'HD Seagate Barracuda 2TB. Altera', 'Hd de grande capacidade para salvar todos os seus arquivos', 320, 28, '<p><strong>Este HD &eacute; muito bom! Muito bom mesmo</strong></p>\r\n', 'img/2017.01.20-15.43.58.jpg', 1, 4),
(36, 'Multifuncional HP 680', 'Multifuncional', 100, 10, '', 'img/2017.01.20-15.43.43.jpg', 1, 17),
(37, 'Placa de Rede Ethernet TP-link', 'Placa de rede de alto desempenho para voce voar na internet', 75.8, 8, '<p>sdf</p>\r\n', 'img/2017.01.21-21.00.37.jpg', 1, 19),
(38, 'Estabilizador 100 VA Energizer', 'Estabilizador para garantir a proteção do seu equipamento', 135.58, 10, '<p><strong>Caracter&iacute;sticas:</strong></p>\r\n\r\n<p>- Marca: SMS &nbsp;</p>\r\n\r\n<p>- Modelo: 16620 &nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Especifica&ccedil;&otilde;es:</strong></p>\r\n\r\n<p>- Pot&ecirc;ncia:500VA/500W</p>\r\n\r\n<p>- Tens&atilde;o de entrada: 115/127/220V~ Autom.</p>\r\n\r\n<p>- Corrente de entrada: 4,8 / 4 / 2,5 A</p>\r\n\r\n<p>- Tens&atilde;o de sa&iacute;da: 115V</p>\r\n\r\n<p>- Frequ&ecirc;ncia: 60Hz</p>\r\n\r\n<p>- Fus&iacute;vel: 6A</p>\r\n\r\n<p>- Microprocessado: RISC/FLASH de alta velocidade&nbsp;</p>\r\n\r\n<p>- Fun&ccedil;&atilde;o TRUE RMS Tens&atilde;o: Bivolt autom&aacute;tico 500 VA</p>\r\n\r\n<p>- Tomadas: 6 tomadas no padr&atilde;o NBR 14136 para 500 VA Bivolt</p>\r\n\r\n<p>- Filtro de Linha interno&nbsp;</p>\r\n\r\n<p>- Led: indica o modo de opera&ccedil;&atilde;o da rede e funcionamento do estabilizador</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Prote&ccedil;&otilde;es:</strong></p>\r\n\r\n<p>- Curto-circuito</p>\r\n\r\n<p>- Surtos de tens&atilde;o (descarga el&eacute;trica)</p>\r\n\r\n<p>- Sub/sobretens&atilde;o de rede. Nestas ocorr&ecirc;ncias, o estabilizador desliga e restaura as suas atividades automaticamente no retorno da energia el&eacute;trica</p>\r\n\r\n<p>- Sobreaquecimento com desligamento autom&aacute;tico</p>\r\n\r\n<p>- Sobrecarga com desligamento autom&aacute;tico</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Pacote Alerta 24h com os servi&ccedil;os:</strong></p>\r\n\r\n<p>- Monitoramento Remoto de Ambiente</p>\r\n\r\n<p>- V&iacute;deo ao Vivo via celular</p>\r\n\r\n<p>- Localizador GPS via celular</p>\r\n\r\n<p>- Alarme Anti-intrus&atilde;o</p>\r\n\r\n<p>- PC Remoto</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Conte&uacute;do da embalagem:</strong></p>\r\n\r\n<p>- 01 Estabilizador SMS</p>\r\n\r\n<p><br />\r\n<br />\r\n<br />\r\n<strong>Garantia</strong><br />\r\n12 meses de garantia<br />\r\n<br />\r\n<strong>Peso</strong><br />\r\n3405 gramas (bruto com embalagem)</p>\r\n', 'img/2017.01.21-17.31.35.jpg', 1, 13),
(39, 'Roteador Wireless D-link D400', 'Roteador Wireless D-link D400 é o mais barato', 235.85, 20, '<p><strong>Esse roteador &eacute; muito bom!</strong></p>\r\n', 'img/2017.01.21-20.48.49.jpg', 1, 20),
(40, 'WebCam Dadoa', 'Webcam', 100, 20, '', 'img/2017.01.21-21.27.21.jpg', 1, 9),
(41, 'Placa de rede 10/100', 'Placa de rede de alto desempenho para voce voar na internet', 125.9, 12, '', 'img/2017.01.22-18.48.57.jpg', 1, 19),
(42, 'Câmera Digital Canon', 'Câmera compacta para suas viagens', 1350, 12, '', 'img/2017.02.03-17.27.23.jpg', 1, 9),
(43, 'Placa de Som Creative Audigy2 ', 'Placa com alta definição de som para usuários exigentes', 450, 5, '<p>Placa de boa qualidade</p>\r\n\r\n<p><img alt="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Creative_Sound_Blaster_Audigy_SB0090.jpg/300px-Creative_Sound_Blaster_Audigy_SB0090.jpg" style="height:212px; width:300px" /></p>\r\n\r\n<p>Essa vai fazer muito barulho.</p>\r\n', 'img/2017.02.03-23.51.12.jpg', 0, 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `setor`
--

INSERT INTO `setor` (`id`, `nome`) VALUES
(1, 'Hardware'),
(2, 'Smartphones'),
(3, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(32) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `nome`, `id_cat`) VALUES
(1, 'Placas-Mãe', 1),
(2, 'Processadores', 1),
(3, 'Memórias RAM', 1),
(4, 'Discos Rígidos (HDD)', 1),
(5, 'SSD', 1),
(6, 'Fontes', 1),
(7, 'Drives', 1),
(8, 'Gabinetes', 1),
(9, 'Câmeras', 0),
(10, 'Cabos', 0),
(11, 'Caixas de Som', 0),
(12, 'Acessórios', 0),
(13, 'Estabilizadores', 0),
(14, 'Memórias', 0),
(15, 'Tablets', 0),
(16, 'Monitores', 0),
(17, 'Periféricos', 0),
(18, 'Placas de Som', 0),
(19, 'Placas de Rede', 0),
(20, 'Roteadores', 0),
(21, 'Software', 0),
(22, 'Smartphones', 0),
(23, 'Placas de vídeo', 0),
(24, 'Notebooks', 0),
(25, 'TEste', 0),
(26, 'TEste2', 0),
(27, 'Esta é outra categoria', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `email`) VALUES
(1, 'Elenildo', 'elenildo', '123', 'elenildoms@gmail.com');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
