-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jul-2019 às 17:51
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdrootsfinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `idcaixa` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `saldo_inicial` float NOT NULL,
  `saldo_atual` float NOT NULL,
  `datahora_fechamento` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`idcaixa`, `data`, `idusuario`, `saldo_inicial`, `saldo_atual`, `datahora_fechamento`) VALUES
(21, '2019-06-27', 4, 555, 1055, '2019-06-27 13:39:02'),
(22, '2019-06-27', 4, 250, 418.23, '2019-06-27 13:39:02'),
(23, '2019-06-27', 4, 500, 988, '2019-06-27 13:39:02'),
(24, '2019-06-27', 4, 155, 6885.74, NULL),
(25, '2019-06-28', 4, 355, 7097.74, NULL),
(26, '2019-06-29', 4, 120, 2380.85, '2019-06-29 18:31:19'),
(27, '2019-06-29', 4, 580, 3595.9, NULL),
(28, '2019-07-02', 1, 100, 90, '2019-07-02 03:56:50'),
(29, '2019-07-02', 1, 100, 2435.93, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Ativo / I = Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `categoria`, `status`) VALUES
(3, 'Bebida', 'A'),
(4, 'Setup', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cep` int(15) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `numero_casa` int(11) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `uf` char(2) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT '	A = Ativo / I = Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `data_nascimento`, `cpf`, `telefone`, `email`, `cep`, `endereco`, `numero_casa`, `bairro`, `cidade`, `uf`, `status`) VALUES
(1, 'Lucas do Matheus', '0000-00-00', '295.708.560-76', '(44) 8 8797', 'fdfjh@gmail.com', 87503200, 'Avenida Presidente Castelo Branco', 1526, 'djnjdnsnd', 'Umuarama', 'PR', 'A'),
(2, 'Moisés', '2019-06-26', '046.630.489-78', '(44) 8 8797-9797', 'edson.juniin@gmail.com', 87508664, 'Rua Palmyra Delmonico, 5878', 5878, 'Belo Monte', 'Umuarama', 'PR', 'A'),
(5, 'Kider', '0000-00-00', '965.615.510-60', '(44) 4 4444-4444', 'gfg@gmail.com', 0, 'cxc', 12, '151', 'ghg', 'hg', 'A'),
(8, 'Chico', '0000-00-00', '620.508.400-71', '(44) 4 4444-5555', 'nfdjf@gmail.com', 8750844, 'mfdkf', 18, '18', '18', '18', 'A'),
(10, 'Adriano Show', '0000-00-00', '431.635.890-14', '(65) 4 9849-5198', 'knfkdsf@gmail.com', 0, 'df', 0, 'fd', 'fd', 'fd', 'A'),
(16, 'Nei', '0000-00-00', '339.151.520-13', '(65) 4 9859-5194', 'kakaka@gmail.com', 0, 'df', 0, 'fd', 'fd', 'fd', 'A'),
(18, 'jakrja', '0000-00-00', '351.892.690-00', '(16) 8 4984-9849', 'jfhdjf@gmail.com', 4848, '48', 84, '48', '84', 'aa', 'A'),
(24, 'jhjsdhf', '0000-00-00', '055.693.400-84', '(49) 8 4984-9849', 'dfdf@gmail.com', 948498, '48', 48, '48', '48', '84', 'A'),
(27, 'Guines', '0000-00-00', '145.317.500-80', '(54) 9 8981-9819', 'fdjf@gmail.com', 849848, '48', 84, '84', '84', 'ds', 'A'),
(29, 'fdfd', '2001-06-11', '564.667.090-00', '(95) 1 9819-8198', 'fmdkf@gmail.com', 0, 'fd', 0, 'fd', 'fd', 'mk', 'A'),
(30, 'fdfdf', '2019-08-01', '832.909.930-00', '(11) 8 8498-4898', 'fdfd@gmail.com', 87508664, 'Rua Palmyra Delmonico', 18, 'Parque Residencial Belo Monte', 'Umuarama', 'PR', 'A'),
(33, 'kdsod', '1980-01-01', '541.807.920-44', '(84) 8 4848-4484', '84@gmail.com', 87508664, 'Rua Palmyra Delmonico', 55, 'Parque Residencial Belo Monte', 'Umuarama', 'PR', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `iditempedido` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor_unitario` int(11) NOT NULL,
  `valor_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`iditempedido`, `idproduto`, `idpedido`, `qtde`, `valor_unitario`, `valor_total`) VALUES
(8, 1, 27, 1, 226, 226),
(9, 2, 28, 3, 3, 8),
(10, 4, 28, 2, 120, 240),
(11, 1, 29, 1, 226, 226),
(12, 2, 29, 43, 3, 118),
(13, 4, 29, 1, 120, 120),
(14, 1, 30, 3, 226, 678),
(15, 2, 30, 5, 3, 14),
(16, 2, 31, 5, 3, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Ativo / I = Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`idmarca`, `nome`, `status`) VALUES
(1, 'Amazon', 'A'),
(2, 'Smyrna', 'A'),
(3, 'Zomo', 'A'),
(4, 'Nay', 'A'),
(5, 'Zigg', 'A'),
(6, 'Brasuka', 'A'),
(7, 'Skol', 'A'),
(8, 'Budweiser', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesa`
--

CREATE TABLE `mesa` (
  `idmesa` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `status` char(1) NOT NULL COMMENT 'D = Disponivel | O = Ocupada'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mesa`
--

INSERT INTO `mesa` (`idmesa`, `nome`, `status`) VALUES
(1, 'Mesa 01', 'D'),
(2, 'Mesa 02', 'D'),
(3, 'Mesa 03', 'O'),
(5, 'Mesa 04', 'D'),
(6, 'Mesa 05', 'D'),
(7, 'Mesa 06', 'D'),
(8, 'Mesa 07', 'D'),
(9, 'Mesa 08', 'D');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimento_caixa`
--

CREATE TABLE `movimento_caixa` (
  `idmovimento` int(11) NOT NULL,
  `idcaixa` int(11) NOT NULL,
  `valor` float NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` int(11) NOT NULL,
  `tipo_movimento` int(11) NOT NULL COMMENT '1 = entrada | 2 = saida',
  `idoperacao` int(11) NOT NULL,
  `motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `movimento_caixa`
--

INSERT INTO `movimento_caixa` (`idmovimento`, `idcaixa`, `valor`, `datahora`, `idusuario`, `tipo_movimento`, `idoperacao`, `motivo`) VALUES
(40, 28, 12, '2019-07-02 03:56:31', 1, 1, 2, ''),
(41, 28, 22, '2019-07-02 03:56:40', 1, 2, 3, ''),
(42, 29, 225.99, '2019-07-02 04:11:56', 1, 1, 1, ''),
(43, 29, 1, '0000-00-00 00:00:00', 1, 1, 2, 'Teste   \n                            '),
(44, 29, 10, '2019-07-02 04:35:19', 1, 1, 2, 'teste 2'),
(45, 29, 20, '2019-07-02 04:35:41', 1, 2, 3, ' teste\n                               \n                            '),
(46, 29, 7, '2019-07-02 04:37:25', 1, 1, 2, 'teste 42'),
(47, 29, 4, '2019-07-02 04:38:34', 1, 2, 3, 'saida teste'),
(48, 29, 1, '2019-07-02 04:38:58', 1, 1, 2, 'testessste'),
(49, 29, 1.99, '2019-07-02 04:40:20', 1, 2, 3, 'teste saida 123'),
(50, 29, 248.25, '2019-07-02 04:41:35', 1, 1, 1, ''),
(51, 29, 464.24, '2019-07-02 04:45:09', 1, 1, 1, ''),
(52, 29, 691.72, '2019-07-02 15:49:02', 1, 1, 1, ''),
(53, 29, 691.72, '2019-07-02 15:49:02', 1, 1, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacao`
--

CREATE TABLE `operacao` (
  `idoperacao` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `operacao`
--

INSERT INTO `operacao` (`idoperacao`, `nome`) VALUES
(1, 'Venda'),
(2, 'Entrada Manual'),
(3, 'Retirada Manual');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idtipopagamento` int(11) DEFAULT NULL,
  `datahora_inclusao` date DEFAULT NULL,
  `datahora_baixa` date DEFAULT NULL,
  `status` char(1) DEFAULT 'F' COMMENT 'F = FECHADO | B = BAIXADO',
  `total_liquido` float NOT NULL COMMENT 'TOTAL DO PEDIDO MENOS DESCONTO',
  `total_bruto` float NOT NULL COMMENT 'TOTAL PEDIDO\n'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idpedido`, `idcliente`, `idusuario`, `idmesa`, `idtipopagamento`, `datahora_inclusao`, `datahora_baixa`, `status`, `total_liquido`, `total_bruto`) VALUES
(27, 1, 1, 1, 1, '2019-07-02', '2019-07-02', 'B', 225.99, 225.99),
(28, 2, 1, 3, 1, '2019-07-02', '2019-07-02', 'B', 248.25, 248.25),
(29, 1, 1, 1, 2, '2019-07-02', '2019-07-02', 'B', 464.24, 464.24),
(30, 1, 1, 1, 1, '2019-07-02', '2019-07-02', 'B', 691.72, 691.72),
(31, 1, 5, 3, NULL, '2019-07-02', NULL, 'F', 13.75, 13.75);

--
-- Acionadores `pedido`
--
DELIMITER $$
CREATE TRIGGER `tg_pedido_caixa` AFTER UPDATE ON `pedido` FOR EACH ROW UPDATE caixa SET
    saldo_atual = saldo_atual + new.total_liquido
 WHERE idcaixa IN (select max(idcaixa))
 AND datahora_fechamento is null
 and NEW.status = 'B'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idproduto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `preco` float NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Ativo / I = Inativo',
  `idmarca` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idproduto`, `nome`, `descricao`, `preco`, `status`, `idmarca`, `idcategoria`) VALUES
(1, 'Amazon Lord', 'Narguilé completo, Preto.', 225.99, 'A', 1, 4),
(2, 'Cerveja SKOL Puro Malte Lata 269ml', 'Puro Malte', 2.75, 'A', 7, 3),
(4, 'Narguilé Brasuka', 'Narguile Azul', 120, 'A', 6, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pagamento`
--

CREATE TABLE `tipo_pagamento` (
  `idtipopagamento` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_pagamento`
--

INSERT INTO `tipo_pagamento` (`idtipopagamento`, `nome`) VALUES
(1, 'Dinheiro'),
(2, 'Cartão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipousuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipousuario`, `nome`) VALUES
(1, 'Admin'),
(2, 'Funcionário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Ativo | = Inativo',
  `idtipousuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `login`, `senha`, `status`, `idtipousuario`) VALUES
(1, 'Edson Junior', 'admin', '$2y$10$e/.zoCMRvd22tcA3GBJeOOiMgyfMx9L8byhsHQn2bzxhMUSZSNYxK', 'A', 1),
(5, 'Luiz Inácio Lula da Silva', 'lula', '$2y$10$.AxpGJ4cL3j4ts3mgGx6FeDCTVMzODJjpYBlKaHJPnc3jhzN3ndIC', 'A', 2),
(10, 'Charuto do Burnes', 'Chaburnes', 'burnes', 'A', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`idcaixa`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices para tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`iditempedido`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idproduto` (`idproduto`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Índices para tabela `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idmesa`);

--
-- Índices para tabela `movimento_caixa`
--
ALTER TABLE `movimento_caixa`
  ADD PRIMARY KEY (`idmovimento`),
  ADD KEY `idcaixa` (`idcaixa`),
  ADD KEY `idoperacao` (`idoperacao`);

--
-- Índices para tabela `operacao`
--
ALTER TABLE `operacao`
  ADD PRIMARY KEY (`idoperacao`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `fk_pedido_cliente1_idx` (`idcliente`),
  ADD KEY `fk_pedido_usuario1_idx` (`idusuario`),
  ADD KEY `fk_pedido_pagamento1_idx` (`idtipopagamento`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idproduto`),
  ADD KEY `idmarca` (`idmarca`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Índices para tabela `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`idtipopagamento`);

--
-- Índices para tabela `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `idtipousuario` (`idtipousuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `idcaixa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `iditempedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `mesa`
--
ALTER TABLE `mesa`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `movimento_caixa`
--
ALTER TABLE `movimento_caixa`
  MODIFY `idmovimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `operacao`
--
ALTER TABLE `operacao`
  MODIFY `idoperacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  MODIFY `idtipopagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `movimento_caixa`
--
ALTER TABLE `movimento_caixa`
  ADD CONSTRAINT `idcaixa` FOREIGN KEY (`idcaixa`) REFERENCES `caixa` (`idcaixa`),
  ADD CONSTRAINT `idoperacao` FOREIGN KEY (`idoperacao`) REFERENCES `operacao` (`idoperacao`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `idcategoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `idmarca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idtipousuario` FOREIGN KEY (`idtipousuario`) REFERENCES `tipo_usuario` (`idtipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
