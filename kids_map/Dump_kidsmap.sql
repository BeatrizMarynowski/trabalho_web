CREATE DATABASE  IF NOT EXISTS `db_kidsmap` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_kidsmap`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_kidsmap
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `acompanhamento`
--

DROP TABLE IF EXISTS `acompanhamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acompanhamento` (
  `profissional_email` varchar(100) NOT NULL,
  `paciente_cpf` char(11) NOT NULL,
  PRIMARY KEY (`profissional_email`,`paciente_cpf`),
  KEY `fk_profissional_paciente_paciente1_idx` (`paciente_cpf`),
  KEY `fk_profissional_paciente_profissional1_idx` (`profissional_email`),
  CONSTRAINT `fk_profissional_paciente_paciente1` FOREIGN KEY (`paciente_cpf`) REFERENCES `paciente` (`cpf`),
  CONSTRAINT `fk_profissional_paciente_profissional1` FOREIGN KEY (`profissional_email`) REFERENCES `profissional` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acompanhamento`
--

LOCK TABLES `acompanhamento` WRITE;
/*!40000 ALTER TABLE `acompanhamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `acompanhamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividade`
--

DROP TABLE IF EXISTS `atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atividade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teste` varchar(50) NOT NULL,
  `habilidade` varchar(100) NOT NULL,
  `idade_minima_meses` int NOT NULL,
  `idade_maxima_meses` int NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `instrucoes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_atividade_habilidade1_idx` (`teste`,`habilidade`),
  CONSTRAINT `fk_atividade_habilidade1` FOREIGN KEY (`teste`, `habilidade`) REFERENCES `habilidade` (`teste`, `habilidade`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividade`
--

LOCK TABLES `atividade` WRITE;
/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
INSERT INTO `atividade` VALUES (1,'EDM','Motricidade Fina',24,35,'construçao de uma torre','construir uma torre de 4 blocos'),(2,'EDM','Motricidade Fina',36,47,'construçao de uma ponte','construir uma ponte com cubos'),(3,'EDM','Motricidade Fina',48,59,'enfiar a linha em uma agulha','enfiar uma linha dentro do buraco da agulha'),(4,'EDM','Motricidade Fina',60,71,'fazer um nó','com um cordao e um lapis, fazer um no em volta do lapis'),(5,'EDM','Motricidade Fina',72,83,'labirinto','traçar o caminho do labirinto com um lapis'),(6,'EDM','Motricidade Fina',84,95,'bolinha de papel','fazer uma bolinha de papel com uma mao'),(7,'EDM','Motricidade Fina',96,107,'ponta do polegar','com a ponta do polegar enconstar em outro dedo da mao'),(8,'EDM','Motricidade Fina',108,119,'lançamento de bola','arremessar uma bola em um alvo'),(9,'EDM','Motricidade Fina',120,131,'circulo com o polegar','girar a mao sobre o polegar'),(10,'EDM','Motricidade Fina',132,143,'agarrar uma bola','sera arremessada uma bola e a crianca tem que pegar a bola no ar'),(11,'EDM','Motricidade global',24,35,'subir sobre um banco','subir e descer de um banco com apoio'),(12,'EDM','Motricidade global',36,47,'saltar sobre uma corda','com os pes justos saltar sobre uma corda estendida no solo'),(13,'EDM','Motricidade global',48,59,'saltar sobre o mesmo lugar','saltar parado no local'),(14,'EDM','Motricidade global',60,71,'saltar uma altura de 20cm','com os pes justos saltar sem impulso uma altura de 20cm'),(15,'EDM','Motricidade global',72,83,'caminhar em linha reta','percorrer 2m em linha reta'),(16,'EDM','Motricidade global',84,95,'pe manco','saltar ao longo de uma distanca so com um pe'),(17,'EDM','Motricidade global',96,107,'saltar uma altura de 40cm','com os pes justos saltar sem impulso uma altura de 40cm'),(18,'EDM','Motricidade global',108,119,'saltar sobre o ar','flexionar os joelhos para encostar os calcanhares com as maos'),(19,'EDM','Motricidade global',120,131,'pe manco com uma caixa de fosforos','saltar com um pe so chutando uma caixa de fosforo por 5m'),(20,'EDM','Motricidade global',132,143,'saltar sobre uma cadeira','saltar em cima de uma cadeira'),(21,'EDM','equilibrio',24,35,'equilibrio sobre um banco','ficar parado em cima de um banco'),(22,'EDM','equilibrio',36,47,'equilibrio sobre um joelho','ficar com um joelho no chao e um pe no chao'),(23,'EDM','equilibrio',48,59,'equilibrio com o tronco flexicionado','ficar parado com as costas inclinada para frente'),(24,'EDM','equilibrio',60,71,'equilibrio na ponta dos pes','se equilibrar na pontas dos pes'),(25,'EDM','equilibrio',72,83,'pe manco estatico','manter sobre uma perna com a outra flexicionada'),(26,'EDM','equilibrio',84,95,'fazer um 4','ficar apoiado sobre um pe com a planta do outro pe apoiada no joelho'),(27,'EDM','equilibrio',96,107,'equilibrio de cocoras','ficar nas pontas do pe e sentar no calcanhar'),(28,'EDM','equilibrio',108,119,'equilibrio com o tronco flexicioando ','elevar sobre as pontas do pe e colocar o tronco em angulo reto'),(29,'EDM','equilibrio',120,131,'equilibrio na ponta dos pes de olhos fechados','se equilibra na pontas dos pes com os olhos fechados'),(30,'EDM','equilibrio',132,143,'pe manco estatico olhos fechados','manter sobre uma perna com a outra flexicionada com os olhos fechados'),(31,'EDM','esquema corporal',24,35,'fazer gestos simples com a mao','copiar os gestros mostrados com a mao'),(32,'EDM','esquema corporal',36,47,'fazer gestos simples com os braços','copiar os gestros mostrados com a braço'),(33,'EDM','esquema corporal',24,35,'fazer gestos simples com a mao','copiar os gestros mostrados com a mao'),(34,'EDM','esquema corporal',36,47,'fazer gestos simples com os braços','copiar os gestros mostrados com a braço'),(35,'EDM','esquema corporal',24,35,'fazer gestos simples com a mao','copiar os gestros mostrados com a mao'),(36,'EDM','esquema corporal',36,47,'fazer gestos simples com os braços','copiar os gestros mostrados com a braço'),(37,'EDM','esquema corporal',24,35,'fazer gestos simples com a mao','copiar os gestros mostrados com a mao'),(38,'EDM','esquema corporal',36,47,'fazer gestos simples com os braços','copiar os gestros mostrados com a braço'),(39,'EDM','esquema corporal',24,35,'fazer gestos simples com a mao','copiar os gestros mostrados com a mao'),(40,'EDM','esquema corporal',36,47,'fazer gestos simples com os braços','copiar os gestros mostrados com a braço'),(41,'EDM','organizaçao espacial',24,35,'tabuleiro posicao normal','um tabuleiro com formas geometricas e encaixar as peças correspondentes'),(42,'EDM','organizaçao espacial',36,47,'tabuleiro posicao invertida','um tabuleiro com formas geometricas e encaixar as peças correspondentes, com as peças longe do seu local de destinacao'),(43,'EDM','organizaçao espacial',48,59,'prova dos palitos','possuindo dois palitos, coloque o dedo no palito indicado'),(44,'EDM','organizaçao espacial',60,71,'jogo de paciencia','colocar dois triangulos congruentes a um retangulo exemplo'),(45,'EDM','organizaçao espacial',72,83,'direita esquerda','indentificar em si mesmo o que seria direita e esquerda'),(46,'EDM','organizaçao espacial',84,95,'execucao de movimentos','relaizar o movimento solicitado'),(47,'EDM','organizaçao espacial',96,107,'direita esquerda sobre o outro','indentificar em outra pessoa o que seria direita e esquerda'),(48,'EDM','organizaçao espacial',108,119,'reproducao de movimentios ','reproduzir o movimento solicitado'),(49,'EDM','organizaçao espacial',120,131,'reproducao de movimentos na figura humana','reproduzir o movimento solicitado de figuras'),(50,'EDM','organizaçao espacial',132,143,'reconhecimento da posicao de objetos','perguntas sobre objetos a frente'),(51,'EDM','organizaçao temporal',24,35,'linguagens e estrura temporal de frases','montar frases solicitadas'),(52,'EDM','organizaçao temporal',36,47,'estruturas temporais de ritmo','reproduzir estruturas temporais'),(53,'EDM','organizaçao temporal',24,35,'linguagens e estrura temporal de frases','montar frases solicitadas'),(54,'EDM','organizaçao temporal',36,47,'estruturas temporais de ritmo','reproduzir estruturas temporais'),(55,'EDM','organizaçao temporal',24,35,'linguagens e estrura temporal de frases','montar frases solicitadas'),(56,'EDM','organizaçao temporal',36,47,'estruturas temporais de ritmo','reproduzir estruturas temporais'),(57,'EDM','organizaçao temporal',24,35,'linguagens e estrura temporal de frases','montar frases solicitadas'),(58,'EDM','organizaçao temporal',36,47,'estruturas temporais de ritmo','reproduzir estruturas temporais'),(59,'EDM','organizaçao temporal',24,35,'linguagens e estrura temporal de frases','montar frases solicitadas'),(60,'EDM','organizaçao temporal',36,47,'estruturas temporais de ritmo','reproduzir estruturas temporais');
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliaçao`
--

DROP TABLE IF EXISTS `avaliaçao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliaçao` (
  `idavaliaçao` int NOT NULL AUTO_INCREMENT,
  `classificacao` tinyint NOT NULL,
  PRIMARY KEY (`idavaliaçao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliaçao`
--

LOCK TABLES `avaliaçao` WRITE;
/*!40000 ALTER TABLE `avaliaçao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliaçao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame`
--

DROP TABLE IF EXISTS `exame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame` (
  `profissional_email` varchar(100) NOT NULL,
  `paciente_cpf` char(11) NOT NULL,
  `atividade_id` int NOT NULL,
  `data` date NOT NULL,
  `resultado` tinyint NOT NULL,
  `avaliaçao_id` int NOT NULL,
  PRIMARY KEY (`profissional_email`,`paciente_cpf`,`atividade_id`,`data`,`avaliaçao_id`),
  KEY `fk_acompanhamento_atividade_atividade1_idx` (`atividade_id`),
  KEY `fk_acompanhamento_atividade_acompanhamento1_idx` (`profissional_email`,`paciente_cpf`),
  KEY `fk_exame_avaliaçao1_idx` (`avaliaçao_id`),
  CONSTRAINT `fk_acompanhamento_atividade_acompanhamento1` FOREIGN KEY (`profissional_email`, `paciente_cpf`) REFERENCES `acompanhamento` (`profissional_email`, `paciente_cpf`),
  CONSTRAINT `fk_acompanhamento_atividade_atividade1` FOREIGN KEY (`atividade_id`) REFERENCES `atividade` (`id`),
  CONSTRAINT `fk_exame_avaliaçao1` FOREIGN KEY (`avaliaçao_id`) REFERENCES `avaliaçao` (`idavaliaçao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame`
--

LOCK TABLES `exame` WRITE;
/*!40000 ALTER TABLE `exame` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habilidade`
--

DROP TABLE IF EXISTS `habilidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habilidade` (
  `teste` varchar(50) NOT NULL,
  `habilidade` varchar(100) NOT NULL,
  `ordem` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`teste`,`habilidade`),
  KEY `fk_habilidade_teste_idx` (`teste`),
  CONSTRAINT `fk_habilidade_teste` FOREIGN KEY (`teste`) REFERENCES `teste` (`teste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habilidade`
--

LOCK TABLES `habilidade` WRITE;
/*!40000 ALTER TABLE `habilidade` DISABLE KEYS */;
INSERT INTO `habilidade` VALUES ('EDM','Equilíbrio',3,'Controle postural e equilíbrio.'),('EDM','Esquema Corporal',4,'Percepção e conhecimento do próprio corpo.'),('EDM','Motricidade Fina',1,'Coordenação de movimentos finos.'),('EDM','Motricidade Global',2,'Coordenação de movimentos amplos.'),('EDM','Organização Espacial',5,'Percepção e orientação no espaço.'),('EDM','Organização Temporal',6,'Percepção de sequências e ritmos.');
/*!40000 ALTER TABLE `habilidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `cpf` char(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `nascimento` date NOT NULL,
  `observacoes` text,
  `nome_pai` varchar(45) NOT NULL,
  `cpf_pai` char(11) NOT NULL,
  `telefone_pai` char(15) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `cpf_pai_UNIQUE` (`cpf_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissional`
--

DROP TABLE IF EXISTS `profissional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profissional` (
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `crefito` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissional`
--

LOCK TABLES `profissional` WRITE;
/*!40000 ALTER TABLE `profissional` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teste`
--

DROP TABLE IF EXISTS `teste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teste` (
  `teste` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`teste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teste`
--

LOCK TABLES `teste` WRITE;
/*!40000 ALTER TABLE `teste` DISABLE KEYS */;
INSERT INTO `teste` VALUES ('EDM','Escala de Desenvolvimento Motor');
/*!40000 ALTER TABLE `teste` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-20 22:32:44
