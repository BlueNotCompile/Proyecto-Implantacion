-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: proyecto
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` VALUES (7,'Activo'),(8,'Inactivo');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estatus` int(10) NOT NULL,
  `cedula` int(10) NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `semestre` int(10) NOT NULL,
  `correo` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `genero` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `user` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contraseña` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `id_estatus1` (`estatus`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES (3,7,2534863,'Alvaro ','Pineda',7,'skisbj.com','Maculino','alvaro 199622','blablabla'),(4,7,97643158,'Maria','Magdalena',5,'sdfsdfsf.com','Femenino','ajasi','325544852');
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estatus` int(10) NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estatus` (`estatus`),
  CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (7,7,'Calculo'),(8,7,'Castellano'),(9,7,'Apreciación a Chávez'),(10,7,'Implantación Imposible'),(11,7,'Costura'),(12,7,'Comercio');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estatus` int(10) NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estatus` (`estatus`),
  CONSTRAINT `periodo_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (3,7,'2022-2023'),(4,7,'2023-2077');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estatus` int(10) NOT NULL,
  `cedula` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `especialidad` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `genero` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `user` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contraseña` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `estatus` (`estatus`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (3,7,'65465498','Jose','Arimatea','Calculo','jiuhdrekjdgj.com','Masculino','doymuchasClases','noquierodarclases'),(4,7,'54765768','Juana','de Arco','Castellano','kuufiu.com','Femenino','plaseholder','niidea');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL,
  `id_profesor` int(10) NOT NULL,
  `id_seccion` int(10) NOT NULL,
  `id_estatus` int(10) NOT NULL,
  `id_periodo` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudiante` (`id_estudiante`),
  KEY `id_materia` (`id_materia`),
  KEY `id_profesor` (`id_profesor`),
  KEY `id_seccion` (`id_seccion`),
  KEY `id_estatus` (`id_estatus`),
  KEY `id_periodo` (`id_periodo`),
  CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_3` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_4` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_5` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_6` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
INSERT INTO `registro` VALUES (1,3,8,4,1,7,3),(2,3,9,4,1,7,3);
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` int(10) NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `capacidad` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estatus` (`estatus`),
  CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion`
--

LOCK TABLES `seccion` WRITE;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` VALUES (1,7,'A 2525',0),(2,7,'B2626',0);
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-07 14:05:45
