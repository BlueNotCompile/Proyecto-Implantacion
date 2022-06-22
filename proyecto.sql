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
-- Temporary table structure for view `alvaro_no_sabia`
--

DROP TABLE IF EXISTS `alvaro_no_sabia`;
/*!50001 DROP VIEW IF EXISTS `alvaro_no_sabia`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `alvaro_no_sabia` (
  `id_estudiante` tinyint NOT NULL,
  `estatus_estudiante` tinyint NOT NULL,
  `cedula_estudiante` tinyint NOT NULL,
  `nombre_estudiante` tinyint NOT NULL,
  `apellido_estudiante` tinyint NOT NULL,
  `semestre_estudiante` tinyint NOT NULL,
  `correo_estudiante` tinyint NOT NULL,
  `genero_estudiante` tinyint NOT NULL,
  `usuario_estudiante` tinyint NOT NULL,
  `pass_estudiante` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus` (
  `id_estatus` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_estatus` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` VALUES (7,'Activo'),(8,'Inactivo'),(9,'Suspendido');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `id_estudiante` int(10) NOT NULL AUTO_INCREMENT,
  `estatus_estudiante` int(10) NOT NULL,
  `cedula_estudiante` int(10) NOT NULL,
  `nombre_estudiante` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido_estudiante` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `semestre_estudiante` int(10) NOT NULL,
  `correo_estudiante` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `genero_estudiante` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_estudiante` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pass_estudiante` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_estudiante`),
  UNIQUE KEY `cedula` (`cedula_estudiante`),
  KEY `id_estatus1` (`estatus_estudiante`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`estatus_estudiante`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES (3,7,25348863,'Alvaro ','Pineda',7,'skisbj.com','Maculino','alvaro199622','blablabla'),(4,7,644551,'Maria','Magdalena',5,'sdfsdfsf.com','Femenino','ajasi','325544852'),(5,7,44964665,'werwer','dsfsdfsfd',9,'sdfsdfsdf','sfdfsfsdf','sdfsdfsdfsf','werwrwerwr'),(11,7,97979731,'Monica','Castañeda',8,'monica@gmail.com','Femenino','m','m'),(12,8,29880037,'Alvaro JOse','Pineda Alvarado',1,'iuhakjhaskdjhasduhk','jriujrehiuhirhgurgrg','caraota','caraotata'),(13,8,666666666,'Carlos','Cstañeda',1,'blablablabla@gmail.com','Masculino','carles','lescar'),(14,8,2147483647,'Maria','del Barrio',7,'marias@gmail.com','Femenino','ma','am');
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id_materia` int(10) NOT NULL AUTO_INCREMENT,
  `estatus_materia` int(10) NOT NULL,
  `nombre_materia` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `id_estatus` (`estatus_materia`),
  CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`estatus_materia`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (7,7,'Calculo'),(8,7,'Castellano'),(10,8,'Implantación Imposible'),(11,7,'Costura Artesanal'),(12,7,'Comercio'),(18,7,'Lectura Grecorromana'),(19,8,'Estudio del Cosmos');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `id_periodo` int(10) NOT NULL AUTO_INCREMENT,
  `estatus_periodo` int(10) NOT NULL,
  `nombre_periodo` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_periodo`),
  KEY `estatus` (`estatus_periodo`),
  CONSTRAINT `periodo_ibfk_1` FOREIGN KEY (`estatus_periodo`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `id_profesor` int(10) NOT NULL AUTO_INCREMENT,
  `estatus_profesor` int(10) NOT NULL,
  `cedula_profesor` int(20) NOT NULL,
  `nombre_profesor` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido_profesor` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `especialidad_profesor` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo_profesor` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `genero_profesor` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_profesor` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pass_profesor` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_profesor`),
  UNIQUE KEY `cedula` (`cedula_profesor`),
  KEY `estatus` (`estatus_profesor`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`estatus_profesor`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (3,8,65465498,'Jose','Arimatea','Calculo','jiuhdrekjdgj.com','Masculino','doymuchasClases','noquierodarclases'),(4,7,54765768,'Juana','de Arco','Castellano','kuufiu.com','Femenino','h','h'),(5,7,33333333,'Mariana','Carmona','Dibujo Tecnico','marianacar@gmail.com','Femenino','macar','carmar'),(6,9,2147483647,'Romeo','Andateta','Musica','ronron@gmail.com','Masculino','ron','nor');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro` (
  `id_registro` int(10) NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL,
  `id_profesor` int(10) NOT NULL,
  `id_seccion` int(10) NOT NULL,
  `id_estatus` int(10) NOT NULL,
  `id_periodo` int(10) NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `id_estudiante` (`id_estudiante`),
  KEY `id_materia` (`id_materia`),
  KEY `id_profesor` (`id_profesor`),
  KEY `id_seccion` (`id_seccion`),
  KEY `id_estatus` (`id_estatus`),
  KEY `id_periodo` (`id_periodo`),
  CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_3` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_4` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id_profesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_5` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registro_ibfk_6` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
INSERT INTO `registro` VALUES (1,3,8,4,1,7,3),(3,12,11,3,2,7,3),(4,3,18,6,1,7,3),(5,11,7,5,1,7,3),(6,11,11,4,3,7,3),(7,3,12,4,1,7,3);
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_seccion` int(10) NOT NULL,
  `nombre_seccion` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `capacidad_seccion` int(10) NOT NULL,
  PRIMARY KEY (`id_seccion`),
  KEY `estatus` (`estatus_seccion`),
  CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`estatus_seccion`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion`
--

LOCK TABLES `seccion` WRITE;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` VALUES (1,7,'A 2525',100),(2,8,'B 2630',110),(3,7,'C 1234',60),(4,7,'D 1674',200);
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `alvaro_no_sabia`
--

/*!50001 DROP TABLE IF EXISTS `alvaro_no_sabia`*/;
/*!50001 DROP VIEW IF EXISTS `alvaro_no_sabia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `alvaro_no_sabia` AS select `estudiante`.`id_estudiante` AS `id_estudiante`,`estudiante`.`estatus_estudiante` AS `estatus_estudiante`,`estudiante`.`cedula_estudiante` AS `cedula_estudiante`,`estudiante`.`nombre_estudiante` AS `nombre_estudiante`,`estudiante`.`apellido_estudiante` AS `apellido_estudiante`,`estudiante`.`semestre_estudiante` AS `semestre_estudiante`,`estudiante`.`correo_estudiante` AS `correo_estudiante`,`estudiante`.`genero_estudiante` AS `genero_estudiante`,`estudiante`.`usuario_estudiante` AS `usuario_estudiante`,`estudiante`.`pass_estudiante` AS `pass_estudiante` from `estudiante` where `estudiante`.`estatus_estudiante` = 7 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-22 13:12:23
