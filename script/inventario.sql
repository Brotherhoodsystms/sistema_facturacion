CREATE DATABASE  IF NOT EXISTS `db_inventario` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `db_inventario`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_inventario
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_acceso`
--

DROP TABLE IF EXISTS `tbl_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_acceso` (
  `acceso_id` int(11) NOT NULL AUTO_INCREMENT,
  `acceso_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `acesoo_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`acceso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_acceso`
--

LOCK TABLES `tbl_acceso` WRITE;
/*!40000 ALTER TABLE `tbl_acceso` DISABLE KEYS */;
INSERT INTO `tbl_acceso` VALUES (1,'ADMINISTRADOR','2022-09-08 13:48:59'),(2,'SUPERVISOR','2022-09-08 13:48:59'),(3,'ASOPERATIVO','2022-09-08 13:48:59'),(4,'BODEGA','2022-09-08 13:48:59');
/*!40000 ALTER TABLE `tbl_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bodega`
--

DROP TABLE IF EXISTS `tbl_bodega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_bodega` (
  `bodega_id` int(11) NOT NULL AUTO_INCREMENT,
  `bodega_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `bodega_capacidad` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `bodega_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bodega_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`bodega_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bodega`
--

LOCK TABLES `tbl_bodega` WRITE;
/*!40000 ALTER TABLE `tbl_bodega` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bodega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_razonsocial` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_ruc` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_contacto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cliente_direccion` text COLLATE utf8_spanish_ci,
  `cliente_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_fecha_u` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cliente_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,'tia s.a','5005005005005','tia@tia.com.ec','022145145','victor perez','av solanda','2022-09-08 13:50:21','2022-09-08 14:54:56','A'),(2,'manzuera s.a','9009009009009','manzuera@net.com','022568568','manuel manzuera','av carcelen','2022-09-08 14:53:53','2022-09-08 14:53:53','A'),(3,'rodiguez s.a.','0030030030033','rodriguez@gmail.com','023896589','jorge rodriguez','av. moran','2022-09-08 14:54:43','2022-09-08 14:55:16','A'),(4,'perezmorales company','1002003004005','pmcompany@net.ch','0997855625','pm company','av gonzales suarez','2022-09-08 14:57:35','2022-09-08 14:57:35','A');
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lote`
--

DROP TABLE IF EXISTS `tbl_lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_lote` (
  `lote_id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_numero` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `lote_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lote_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`lote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lote`
--

LOCK TABLES `tbl_lote` WRITE;
/*!40000 ALTER TABLE `tbl_lote` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mercaderia`
--

DROP TABLE IF EXISTS `tbl_mercaderia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_mercaderia` (
  `mercaderia_id` int(11) NOT NULL AUTO_INCREMENT,
  `mercaderia_fechaelaboracion` date NOT NULL,
  `mercaderia_fechaexpiracion` date NOT NULL,
  `mercaderia_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mercaderia_fecha_u` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mercaderia_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `bodega_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`mercaderia_id`),
  KEY `IX_Relationship6` (`bodega_id`),
  KEY `IX_Relationship7` (`producto_id`),
  CONSTRAINT `Relationship6` FOREIGN KEY (`bodega_id`) REFERENCES `tbl_bodega` (`bodega_id`),
  CONSTRAINT `Relationship7` FOREIGN KEY (`producto_id`) REFERENCES `tbl_producto` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mercaderia`
--

LOCK TABLES `tbl_mercaderia` WRITE;
/*!40000 ALTER TABLE `tbl_mercaderia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mercaderia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_producto`
--

DROP TABLE IF EXISTS `tbl_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_producto` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_codigoserial` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `producto_descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `producto_precio` decimal(10,2) NOT NULL,
  `producto_cantidad` int(11) NOT NULL,
  `producto_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `producto_fecha_u` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `producto_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `categoria_id` int(11) DEFAULT NULL,
  `lote_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `IX_Relationship3` (`categoria_id`),
  KEY `IX_Relationship4` (`lote_id`),
  CONSTRAINT `Relationship3` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categoria` (`categoria_id`),
  CONSTRAINT `Relationship4` FOREIGN KEY (`lote_id`) REFERENCES `tbl_lote` (`lote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_producto`
--

LOCK TABLES `tbl_producto` WRITE;
/*!40000 ALTER TABLE `tbl_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_proveedor`
--

DROP TABLE IF EXISTS `tbl_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_proveedor` (
  `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_razonsocial` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_ruc` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_contacto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor_direccion` text COLLATE utf8_spanish_ci,
  `proveedor_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proveedor_fecha_u` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `proveedor_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proveedor`
--

LOCK TABLES `tbl_proveedor` WRITE;
/*!40000 ALTER TABLE `tbl_proveedor` DISABLE KEYS */;
INSERT INTO `tbl_proveedor` VALUES (1,'almacen jahr','7007007007007','jahr@jahr.com.ec','022123156','jahr sootel','av sangolqui','2022-09-08 14:23:25','2022-09-08 14:23:25','A'),(3,'almacenes mercadey s.a.','1201201201202','mercadery@gmail.com','022896896','toto morales','av maldonado','2022-09-08 14:37:45','2022-09-08 14:38:31','A'),(4,'mercadolibre s.a.','9009009009009','merca@merca.com','022145145','mercado libre','av santiago','2022-09-08 15:17:43','2022-09-08 15:17:43','A');
/*!40000 ALTER TABLE `tbl_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ubicacion`
--

DROP TABLE IF EXISTS `tbl_ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ubicacion` (
  `ubicacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion_descripcion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ubicacion_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `bodega_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ubicacion_id`),
  KEY `IX_Relationship5` (`bodega_id`),
  CONSTRAINT `Relationship5` FOREIGN KEY (`bodega_id`) REFERENCES `tbl_bodega` (`bodega_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ubicacion`
--

LOCK TABLES `tbl_ubicacion` WRITE;
/*!40000 ALTER TABLE `tbl_ubicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_dni` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_nombres` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_direccion` text COLLATE utf8_spanish_ci,
  `usuario_email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_fecha_i` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_fecha_u` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_estado` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'A',
  `acceso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `IX_Relationship1` (`acceso_id`),
  CONSTRAINT `Relationship1` FOREIGN KEY (`acceso_id`) REFERENCES `tbl_acceso` (`acceso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'1001001001','ADMIN','022563563','av inca','admin@admin.com','bVptL3gwMmxKT3FBa0taMytvdkdHUT09','2022-09-08 13:49:43','2022-09-08 13:49:43','A',1),(4,'2002002002','bodega','022121212','av pifo','bodega@bodega.com','SWhQU3hYWURVVWlVRDh2UTRVZkVlZz09','2022-09-08 14:51:14','2022-09-08 14:52:30','A',4),(5,'4040404044','supervisor','022100100','av fonseca','supervisor@supervisor.com','bGZIOEdzbGVndWRvYXRCaFplNFJDdz09','2022-09-08 15:19:32','2022-09-08 15:19:39','I',2);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-08 15:25:35
