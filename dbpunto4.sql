-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2012 at 12:40 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbpunto4`
--

-- --------------------------------------------------------

--
-- Table structure for table `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `idbanco` int(11) NOT NULL AUTO_INCREMENT,
  `ba_nombre` varchar(50) DEFAULT NULL,
  `ba_direc` varchar(50) DEFAULT NULL,
  `ba_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idbanco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `boleta`
--

CREATE TABLE IF NOT EXISTS `boleta` (
  `idboleta` int(11) NOT NULL AUTO_INCREMENT,
  `bo_nro` bigint(20) DEFAULT NULL,
  `bo_fech` date DEFAULT NULL,
  `bo_importe` decimal(10,2) DEFAULT NULL,
  `bo_emisor` varchar(20) DEFAULT NULL,
  `bo_estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idboleta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `boleta`
--

INSERT INTO `boleta` (`idboleta`, `bo_nro`, `bo_fech`, `bo_importe`, `bo_emisor`, `bo_estado`) VALUES
(1, 3, '2012-10-14', 10.00, 'Herita', 'Activo'),
(2, 2, '2012-10-12', 26.00, 'Hesleither', 'Activo'),
(4, 6, '2012-10-12', 12.00, 'Heraud', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `categoria_gasto`
--

CREATE TABLE IF NOT EXISTS `categoria_gasto` (
  `idcategoria_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `cg_nombre` varchar(50) DEFAULT NULL,
  `cg_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idcategoria_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `cl_docu` varchar(10) DEFAULT NULL,
  `cl_nombre` varchar(50) DEFAULT NULL,
  `cl_direc` varchar(100) DEFAULT NULL,
  `cl_fechingre` date DEFAULT NULL,
  `cl_telf` varchar(20) DEFAULT NULL,
  `cl_email` varchar(30) DEFAULT NULL,
  `cl_estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idcliente`, `cl_docu`, `cl_nombre`, `cl_direc`, `cl_fechingre`, `cl_telf`, `cl_email`, `cl_estado`) VALUES
(1, '11111111', 'Heraud Challco', 'Av. Prado alto', NULL, '983725980', 'hesleither@com.com', 'Activo'),
(2, '22222222', 'Heraud Challco', 'Av. Prado alto', NULL, '983725980', 'hesleither@com.com', 'Activo'),
(3, '33333333', 'Pablo', 'Av. Prado alto', NULL, '234555', 'hesleither@com.com', 'Activo'),
(4, '44444444', 'Simpsom', 'Av. Florida', NULL, '4949494949', 'uno@dos.com', 'Cerrado');

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `co_nrofact` varchar(10) DEFAULT NULL,
  `co_fech` date DEFAULT NULL,
  `co_importe` decimal(10,2) DEFAULT NULL,
  `co_encargado` varchar(50) DEFAULT NULL,
  `co_estado` varchar(20) DEFAULT NULL,
  `idproveedor` int(11) DEFAULT NULL,
  `idpersonal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcompra`),
  KEY `fk_compra_proveedor` (`idproveedor`),
  KEY `fk_compra_personal` (`idpersonal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`idcompra`, `co_nrofact`, `co_fech`, `co_importe`, `co_encargado`, `co_estado`, `idproveedor`, `idpersonal`) VALUES
(1, '1', '2012-09-12', 12.00, 'Usuario', 'Activo', 1, 1),
(2, '1', '2012-09-12', 61.00, 'Usuario', 'Activo', 1, 1),
(3, '1', '2012-09-12', 61.00, 'Usuario', 'Activo', 3, 1),
(8, '1', '2012-09-22', 139.00, 'Heraud', 'Activo', 3, 1),
(9, '1233', '2012-10-11', 389.00, '', 'Activo', 3, 1),
(10, '2', '2012-10-02', 64.00, '', 'Activo', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_compra`
--

CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `iddetalle_compra` int(11) NOT NULL AUTO_INCREMENT,
  `dc_canti` int(11) DEFAULT NULL,
  `dc_punitario` decimal(10,2) DEFAULT NULL,
  `dc_ptotal` decimal(10,2) DEFAULT NULL,
  `dc_estado` varchar(50) DEFAULT NULL,
  `idcompra` int(11) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalle_compra`),
  KEY `fk_detalle_compra_compra` (`idcompra`),
  KEY `fk_detalle_compra_recurso` (`idrecurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `detalle_compra`
--

INSERT INTO `detalle_compra` (`iddetalle_compra`, `dc_canti`, `dc_punitario`, `dc_ptotal`, `dc_estado`, `idcompra`, `idrecurso`) VALUES
(13, 3, 2.00, 6.00, 'Activo', 8, 2),
(14, 5, 5.00, 25.00, 'Activo', 8, 3),
(15, 6, 5.00, 30.00, 'Activo', 8, 5),
(16, 39, 2.00, 78.00, 'Activo', 8, 1),
(17, 60, 5.00, 300.00, 'Activo', 9, 5),
(18, 13, 2.00, 26.00, 'Activo', 9, 2),
(19, 11, 5.00, 63.00, 'Activo', 9, 4),
(20, 4, 5.00, 20.00, 'Activo', 10, 4),
(21, 6, 5.00, 30.00, 'Activo', 10, 3),
(22, 7, 2.00, 14.00, 'Activo', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_gasto`
--

CREATE TABLE IF NOT EXISTS `detalle_gasto` (
  `iddetalle_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `dg_descrip` varchar(120) DEFAULT NULL,
  `dg_canti` int(11) DEFAULT NULL,
  `dg_punitario` decimal(10,2) DEFAULT NULL,
  `dg_ptotal` decimal(10,2) DEFAULT NULL,
  `dg_estado` tinyint(1) DEFAULT NULL,
  `idgasto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalle_gasto`),
  KEY `fk_detalle_gasto_gasto` (`idgasto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `dv_canti` int(11) DEFAULT NULL,
  `dv_punitario` decimal(10,2) DEFAULT NULL,
  `dv_ptotal` decimal(10,2) DEFAULT NULL,
  `dv_estado` tinyint(1) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalle_venta`),
  KEY `fk_detalle_venta_recurso` (`idrecurso`),
  KEY `fk_detalle_venta_venta` (`idventa`),
  KEY `fk_detalle_venta_producto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `fa_nro` bigint(20) DEFAULT NULL,
  `fa_fech` date DEFAULT NULL,
  `fa_subtotal` decimal(10,2) DEFAULT NULL,
  `fa_total` decimal(10,2) DEFAULT NULL,
  `fa_emisor` varchar(20) DEFAULT NULL,
  `fa_estado` varchar(20) DEFAULT NULL,
  `idigv` int(11) DEFAULT NULL,
  PRIMARY KEY (`idfactura`),
  KEY `fk_factura_igv` (`idigv`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`idfactura`, `fa_nro`, `fa_fech`, `fa_subtotal`, `fa_total`, `fa_emisor`, `fa_estado`, `idigv`) VALUES
(1, 1, '2012-10-19', 12.00, 14.00, 'Heraud', 'Activo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gasto`
--

CREATE TABLE IF NOT EXISTS `gasto` (
  `idgasto` int(11) NOT NULL AUTO_INCREMENT,
  `ga_nrofact` varchar(10) DEFAULT NULL,
  `ga_descrip` varchar(100) DEFAULT NULL,
  `ga_fecha` date DEFAULT NULL,
  `ga_importe` decimal(10,2) DEFAULT NULL,
  `ga_estado` tinyint(1) DEFAULT NULL,
  `idcategoria_gasto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idgasto`),
  KEY `fk_gasto_categoria_gasto` (`idcategoria_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `igv`
--

CREATE TABLE IF NOT EXISTS `igv` (
  `idigv` int(11) NOT NULL AUTO_INCREMENT,
  `ig_tasa` decimal(10,2) DEFAULT NULL,
  `ig_estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idigv`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `igv`
--

INSERT INTO `igv` (`idigv`, `ig_tasa`, `ig_estado`) VALUES
(1, 17.00, 'Activo'),
(2, 18.00, 'Activo'),
(3, 20.00, 'Activo'),
(4, 21.00, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `idlink` int(11) NOT NULL AUTO_INCREMENT,
  `li_nombre` varchar(50) DEFAULT NULL,
  `li_link` varchar(50) DEFAULT NULL,
  `li_estado` varchar(20) DEFAULT NULL,
  `idlinkubica` int(11) DEFAULT NULL,
  `li_pri1` int(11) DEFAULT NULL,
  `li_pri2` int(11) DEFAULT NULL,
  `li_pri3` int(11) DEFAULT NULL,
  `li_pri4` int(11) DEFAULT NULL,
  `li_pri5` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlink`),
  KEY `idlinkubica` (`idlinkubica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`idlink`, `li_nombre`, `li_link`, `li_estado`, `idlinkubica`, `li_pri1`, `li_pri2`, `li_pri3`, `li_pri4`, `li_pri5`) VALUES
(1, 'Privilegios', 'privilegio', 'Activo', 1, 0, 0, 0, 0, 0),
(2, 'Gastos', 'gasto', 'Activo', 1, 0, 0, 0, 0, 0),
(3, 'CategorÃ­as de Gastos', 'categoria_gasto', 'Activo', 1, 0, 0, 0, 0, 0),
(4, 'Detalles de Gastos', 'detalle_gasto', 'Activo', 1, 0, 0, 0, 0, 0),
(5, 'Compras Proveedores', 'compra', 'Activo', 1, 4, 0, 0, 0, 0),
(6, 'Detalles de Compras', 'detalle_compra', 'Activo', 1, 0, 0, 0, 0, 0),
(7, 'Ventas', 'venta', 'Activo', 1, 4, 0, 8, 0, 0),
(8, 'Detalles de Ventas', 'detalle_venta', 'Activo', 1, 0, 0, 0, 0, 0),
(9, 'Pago Ventas', 'pago_venta', 'Activo', 1, 0, 0, 0, 0, 0),
(10, 'Facturas', 'factura', 'Activo', 1, 0, 0, 8, 0, 0),
(11, 'Boletas', 'boleta', 'Activo', 1, 4, 5, 0, 9, 0),
(12, 'IGV', 'igv', 'Activo', 1, 0, 0, 0, 0, 0),
(13, 'Bancos', 'banco', 'Activo', 1, 0, 0, 8, 0, 0),
(14, 'Pago a Bancos', 'pago_banco', 'Activo', 1, 0, 0, 8, 0, 0),
(15, 'Prestamos', 'prestamo', 'Activo', 1, 0, 0, 0, 0, 0),
(16, 'Links', 'link', 'Activo', 1, 0, 0, 0, 0, 0),
(17, 'Personales', 'personal', 'Activo', 1, 0, 0, 0, 0, 0),
(18, 'Usuarios', 'usuario', 'Activo', 1, 0, 0, 8, 0, 0),
(19, 'Productos', 'producto', 'Activo', 1, 0, 0, 0, 0, 0),
(20, 'Proveedores', 'proveedor', 'Activo', 1, 0, 0, 8, 0, 0),
(21, 'Recursos', 'recurso', 'Activo', 1, 0, 0, 8, 0, 0),
(22, 'Sucursales', 'sucursal', 'Activo', 1, 0, 0, 8, 9, 0),
(23, 'Cliente', 'cliente', 'Activo', 1, 4, 0, 8, 0, 0),
(24, 'Avisos Importantes', 'aviso', 'Activo', 2, 0, 0, 8, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `linkubica`
--

CREATE TABLE IF NOT EXISTS `linkubica` (
  `idlinkubica` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lu_nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idlinkubica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `linkubica`
--

INSERT INTO `linkubica` (`idlinkubica`, `lu_nombre`) VALUES
(1, 'Por defecto'),
(2, 'Menu de Arriba'),
(3, 'Menu Primario'),
(4, 'Menu Secundario');

-- --------------------------------------------------------

--
-- Table structure for table `pago_banco`
--

CREATE TABLE IF NOT EXISTS `pago_banco` (
  `idpago_banco` int(11) NOT NULL AUTO_INCREMENT,
  `pb_fech` date DEFAULT NULL,
  `pb_sigfech` date DEFAULT NULL,
  `pb_monto` decimal(10,2) DEFAULT NULL,
  `pb_saldo` decimal(10,2) DEFAULT NULL,
  `pb_estado` tinyint(1) DEFAULT NULL,
  `idprestamo` int(11) NOT NULL,
  PRIMARY KEY (`idpago_banco`,`idprestamo`),
  KEY `fk_pago_banco_prestamo` (`idprestamo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pago_venta`
--

CREATE TABLE IF NOT EXISTS `pago_venta` (
  `idpago_venta` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) NOT NULL,
  `pv_fech` date DEFAULT NULL,
  `pv_sigfech` date DEFAULT NULL,
  `pv_monto_pagado` decimal(10,2) DEFAULT NULL,
  `pv_monto_saldo` decimal(10,2) DEFAULT NULL,
  `pv_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpago_venta`,`idventa`),
  KEY `idventa` (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `idpersonal` int(11) NOT NULL AUTO_INCREMENT,
  `per_docu` varchar(15) DEFAULT NULL,
  `per_nombre` varchar(50) DEFAULT NULL,
  `per_fechregistro` date DEFAULT NULL,
  `per_email` varchar(30) DEFAULT NULL,
  `per_telf` varchar(20) DEFAULT NULL,
  `per_direc` varchar(50) DEFAULT NULL,
  `per_estado` varchar(20) DEFAULT NULL,
  `idsucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpersonal`),
  KEY `fk_personal_sucursal` (`idsucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`idpersonal`, `per_docu`, `per_nombre`, `per_fechregistro`, `per_email`, `per_telf`, `per_direc`, `per_estado`, `idsucursal`) VALUES
(1, '11111111', 'Heraud Chalco HumanÃ­', '2012-09-01', 'uno@dos.com', '2420850', 'Av. Arenas 123', 'Activo', 1),
(2, '22222222', 'Heraud Chalco HumanÃ­', '2012-09-03', 'uno@dos.com', '2420850', 'Av. Arenas 123', 'Activo', 1),
(5, '12345678', 'Pablo moraless', '2012-08-09', 'uno@dos.com', '234444', 'Av. Arenas 123', 'Activo', 1),
(6, '59593434', 'Antonio Montalvo Pinares', '2012-09-19', 'uno@dos.com', '2420850', 'Av. Arenas 123', 'Activo', 1),
(7, '43456004', 'Heraud Chalco HumanÃ­', '2012-09-09', 'uno@dos.com', '2420850', 'Av. Arenas 123', 'Activo', 1),
(8, '43456002', 'Antonio Montalvo Pinares', '2012-09-09', 'uno@dos.com', '2420850', 'Av. Arenas 123', 'Activo', 1),
(9, '111111112', 'Hesleither', '2012-09-19', 'uno@dos.com', '2345333', 'Av. Los angles', 'Activo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE IF NOT EXISTS `prestamo` (
  `idprestamo` int(11) NOT NULL AUTO_INCREMENT,
  `pre_fech` date DEFAULT NULL,
  `pre_monto` decimal(10,2) DEFAULT NULL,
  `pre_cuota` decimal(10,2) DEFAULT NULL,
  `pre_nrocuota` int(11) DEFAULT NULL,
  `pre_estado` tinyint(1) DEFAULT NULL,
  `idbanco` int(11) DEFAULT NULL,
  PRIMARY KEY (`idprestamo`),
  KEY `fk_prestamo_banco` (`idbanco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privilegio`
--

CREATE TABLE IF NOT EXISTS `privilegio` (
  `idprivilegio` int(11) NOT NULL AUTO_INCREMENT,
  `pri_nombre` varchar(50) DEFAULT NULL,
  `pri_estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idprivilegio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `privilegio`
--

INSERT INTO `privilegio` (`idprivilegio`, `pri_nombre`, `pri_estado`) VALUES
(1, 'Plomero', 'Cerrado'),
(2, 'Administrador', 'Cerrado'),
(3, 'Cajeros', 'Cerrado'),
(4, 'DiseÃ±ador', 'Activo'),
(5, 'Esposa', 'Activo'),
(6, 'Camita', 'Cerrado'),
(7, 'Cajeros', 'Cerrado'),
(8, 'Camarera', 'Activo'),
(9, 'Cocinera', 'Activo'),
(10, 'Portero', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `pro_nombre` varchar(50) DEFAULT NULL,
  `pro_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `pro_docu` varchar(15) DEFAULT NULL,
  `pro_nombre` varchar(50) DEFAULT NULL,
  `pro_ciudad` varchar(30) DEFAULT NULL,
  `pro_direc` varchar(50) DEFAULT NULL,
  `pro_telf` varchar(20) DEFAULT NULL,
  `pro_email` varchar(30) DEFAULT NULL,
  `pro_fechingre` date DEFAULT NULL,
  `pro_estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `pro_docu`, `pro_nombre`, `pro_ciudad`, `pro_direc`, `pro_telf`, `pro_email`, `pro_fechingre`, `pro_estado`) VALUES
(1, '11111111', 'Chalco HuamanÃ­', 'Lima', 'Av. Angelesa', '6676767', 'uno@go.com', '2012-09-19', 'Activo'),
(2, '11111113', 'Chalco HuamanÃ­', 'Lima', 'Av. Angelesa', '6676767', 'uno@go.com', '2012-09-19', 'Activo'),
(3, '11111113', 'Romanin Roanin', 'Abancay', 'Av. Angelesa', '67898090890890898', 'uno@go.com', '2012-09-19', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `recurso`
--

CREATE TABLE IF NOT EXISTS `recurso` (
  `idrecurso` int(11) NOT NULL AUTO_INCREMENT,
  `re_nombre` varchar(50) DEFAULT NULL,
  `re_sku` varchar(50) DEFAULT NULL,
  `re_marca` varchar(50) DEFAULT NULL,
  `re_stock` int(11) DEFAULT NULL,
  `re_presenta` varchar(20) DEFAULT NULL,
  `re_umedida` varchar(20) DEFAULT NULL,
  `re_pcompra` decimal(10,2) DEFAULT NULL,
  `re_pventa` decimal(10,2) DEFAULT NULL,
  `re_stockmin` int(11) DEFAULT NULL,
  `re_stockmax` int(11) DEFAULT NULL,
  `re_estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idrecurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `recurso`
--

INSERT INTO `recurso` (`idrecurso`, `re_nombre`, `re_sku`, `re_marca`, `re_stock`, `re_presenta`, `re_umedida`, `re_pcompra`, `re_pventa`, `re_stockmin`, `re_stockmax`, `re_estado`) VALUES
(1, 'hera', '123', 'hera', 2, 'bote', 'Lt', 2.00, 3.00, 5, 10, 'Activo'),
(2, 'hera', '123', 'hes', 3, 'valde', 'kg', 2.00, 5.00, 2, 10, 'Activo'),
(3, 'Focos Philps', '123', 'Marcas', 50, 'Valde', 'Litros', 5.00, 7.00, 10, 50, 'Activo'),
(4, 'Vinillos', '123', 'Marcas', 50, 'Valde', 'Metros', 5.00, 7.00, 10, 50, 'Activo'),
(5, 'Focos Philpss', '', '', 50, 'Bote', 'Litros', 5.00, 7.00, 10, 50, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `sucursal`
--

CREATE TABLE IF NOT EXISTS `sucursal` (
  `idsucursal` int(11) NOT NULL AUTO_INCREMENT,
  `su_nombre` varchar(50) DEFAULT NULL,
  `su_estado` varchar(20) DEFAULT NULL,
  `su_direc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idsucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `su_nombre`, `su_estado`, `su_direc`) VALUES
(1, 'Abancay', 'Activo', 'Av. BÃ¡rsenas 111'),
(2, 'Andahuaylas', 'Activo', 'Av. Barrios altos'),
(3, 'Curahuasi', 'Activo', 'Av. Barrios altos'),
(4, 'Antabamba', 'Activo', 'Av. Elias Segovias');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `us_user` varchar(20) DEFAULT NULL,
  `us_pass` varchar(150) DEFAULT NULL,
  `us_fech` date DEFAULT NULL,
  `us_estado` varchar(20) DEFAULT NULL,
  `idprivilegio` int(11) DEFAULT NULL,
  `idpersonal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_usuario_personal` (`idpersonal`),
  KEY `idprivilegio` (`idprivilegio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `us_user`, `us_pass`, `us_fech`, `us_estado`, `idprivilegio`, `idpersonal`) VALUES
(1, 'Heraud', 'c19ca95dc1dc1acac33670acf40175a9ff30d39b', '2012-09-19', 'Activo', 4, 8),
(2, 'Hesleither', 'c19ca95dc1dc1acac336', '2012-09-19', 'Activo', 4, 9),
(3, 'Heraud1', 'c19ca95dc1dc1acac336', '2012-09-19', 'Activo', 4, 8),
(4, 'Herita', 'c19ca95dc1dc1acac33670acf40175a9ff30d39b', '2012-10-01', 'Activo', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `ve_fech` date DEFAULT NULL,
  `ve_tipo` varchar(20) DEFAULT NULL,
  `ve_nrocuota` int(11) DEFAULT NULL,
  `ve_importe` decimal(10,2) DEFAULT NULL,
  `ve_estado` tinyint(1) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idpersonal` int(11) DEFAULT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idboleta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_cliente` (`idcliente`),
  KEY `fk_venta_personal` (`idpersonal`),
  KEY `fk_venta_factura` (`idfactura`),
  KEY `fk_venta_boleta` (`idboleta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_personal` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_proveedor` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`idrecurso`) REFERENCES `recurso` (`idrecurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detalle_gasto`
--
ALTER TABLE `detalle_gasto`
  ADD CONSTRAINT `detalle_gasto_ibfk_1` FOREIGN KEY (`idgasto`) REFERENCES `gasto` (`idgasto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_recurso` FOREIGN KEY (`idrecurso`) REFERENCES `recurso` (`idrecurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_igv` FOREIGN KEY (`idigv`) REFERENCES `igv` (`idigv`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `fk_gasto_categoria_gasto` FOREIGN KEY (`idcategoria_gasto`) REFERENCES `categoria_gasto` (`idcategoria_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pago_banco`
--
ALTER TABLE `pago_banco`
  ADD CONSTRAINT `fk_pago_banco_prestamo` FOREIGN KEY (`idprestamo`) REFERENCES `prestamo` (`idprestamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pago_venta`
--
ALTER TABLE `pago_venta`
  ADD CONSTRAINT `pago_venta_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_personal_sucursal` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_banco` FOREIGN KEY (`idbanco`) REFERENCES `banco` (`idbanco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_personal` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idprivilegio`) REFERENCES `privilegio` (`idprivilegio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_boleta` FOREIGN KEY (`idboleta`) REFERENCES `boleta` (`idboleta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_factura` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_personal` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
