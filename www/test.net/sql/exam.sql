-- MySQL dump 10.13  Distrib 5.6.17, for osx10.9 (x86_64)
--
-- Host: localhost    Database: exam
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `choose`
--

DROP TABLE IF EXISTS `choose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `choice` varchar(500) NOT NULL,
  `answer` char(1) NOT NULL,
  `chapter` varchar(200) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `tag` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choose`
--

LOCK TABLES `choose` WRITE;
/*!40000 ALTER TABLE `choose` DISABLE KEYS */;
INSERT INTO `choose` VALUES (2,'32位系统中int占多少个byte？','{\"A\":\"1\",\"B\":\"2\",\"C\":\"4\",\"D\":\"8\"}','C','',0,NULL),(3,'c语言是什么类型语言？','{\"A\":\"u9762u5411u8fc7u7a0bu8bedu8a00\",\"B\":\"u9762u5411u5bf9u8c61u8bedu8a00\",\"C\":\"u9762u5411u4e8bu4ef6u8bedu8a00\",\"D\":\"u673au5668u8bedu8a00\"}','A','',0,NULL),(6,'1+1=?','{\"A\":\"1\",\"B\":\"2\",\"C\":\"3\",\"D\":\"4\"}','C','',0,NULL),(7,'c语言的结构体变量时私有还是公有？','{\"A\":\"u79c1u6709\",\"B\":\"u516cu6709\",\"C\":\"u4e0du533au5206\",\"D\":\"u90fdu4e0du662f\"}','A','',0,NULL),(8,'非人防家乐福','{\"A\":\"u53d1u6765u52b2u513f\",\"B\":\"u96f7u950bu8282\",\"C\":\" u653eu5047u4e86u8f6fu4ef6\",\"D\":\"u8001u8d39u52b2u4e86u745eu98ce\"}','D','',0,NULL),(9,'你叫什么','{\"A\":\"u6731\",\"B\":\"u5149\",\"C\":\"u95ee\",\"D\":\"u6587\"}','A','',0,NULL),(10,'你再干什么','{\"A\":\"u5199u4ee3u7801\",\"B\":\"u559du6c34\",\"C\":\"u770bu7535u5f71\",\"D\":\"u8d70u8def\"}','A','',0,NULL),(11,'你会画画吗','{\"A\":\"u4e0du4f1a\",\"B\":\"u4f1a\",\"C\":\"u5e72u5417u8fd9u4e48u6587\",\"D\":\"u5475u5475\"}','A','',0,NULL),(12,'在分类软件了','{\"A\":\"u8001u8d39u52b2u4e86u745eu98ce\",\"B\":\"u52a0u4e86u5c31\",\"C\":\"u526fu7ecfu7406u5c31\",\"D\":\"u91d1u516du798f \"}','A','',0,NULL),(13,'法你如果会计刚就','{\"A\":\"u5bb6u91ccu9644u8fd1\",\"B\":\"u5ecau574au5c31\",\"C\":\" u5de8u5cf0u8def4u5c31\",\"D\":\"u76d1u7406u8d39u4e86\"}','C','',0,NULL),(15,'发贺卡夹~(≧▽≦)/~啦啦啦夹铁路太急了4讨论 ','{\"A\":\"u5426u51b3u4e864u5c31\",\"B\":\"u5bb6u4e50u798fo(u256fu25a1u2570)o \",\"C\":\"u653eu5047u4e864u5c31\",\"D\":\"u670du4e864u5c31\"}','A','',0,NULL),(16,'what do you think ','{\"A\":\"hehe\",\"B\":\"haha\",\"C\":\"heihei\",\"D\":\"houhou\"}','D','',0,NULL),(17,'what are you','{\"A\":\"cat \",\"B\":\"dog\",\"C\":\"pig\",\"D\":\"monkey\"}','A','',0,NULL),(18,'night at ','{\"A\":\"yellow\",\"B\":\"red\",\"C\":\"pink\",\"D\":\"blue\"}','B','',0,NULL),(19,'who are you','{\"A\":\"aaa\",\"B\":\"bbbb\",\"C\":\"ccc\",\"D\":\"ddd\"}','A','',0,NULL),(20,'fuck','{\"A\":\"f\",\"B\":\"u\",\"C\":\"c\",\"D\":\"k\"}','A','',0,NULL),(21,'jiong','{\"A\":\"j\",\"B\":\"i\",\"C\":\"o\",\"D\":\"n\"}','A','',0,NULL),(22,'what what waht','{\"A\":\"w\",\"B\":\"h\",\"C\":\"a\",\"D\":\"tttttttt\"}','A','',0,NULL),(23,'ferfjerl','{\"A\":\"jfej\",\"B\":\"jflrej\",\"C\":\"jflr\",\"D\":\"jfljr\"}','A','',0,NULL),(24,'nothing at al','{\"A\":\"aaaaaaaaa\",\"B\":\"llllllllll\",\"C\":\"fjelfjlejrglejrl\",\"D\":\"yyyyyy\"}','C','',0,NULL),(27,'你最喜欢什么颜色','{\"A\":\"u7ea2u8272\",\"B\":\"u7effu8272\",\"C\":\"u84ddu8272\",\"D\":\"u7d2bu8272\"}','C','',0,NULL),(28,'what do you like ','{\"A\":\"red\",\"B\":\"green\",\"C\":\"puple\",\"D\":\"black\"}','D','',0,NULL),(29,'宏定义是在什么时候被展开的？','{\"A\":\"\\u7f16\\u8bd1\\u65f6\",\"B\":\"\\u94fe\\u63a5\\u65f6\",\"C\":\"\\u8fd0\\u884c\\u65f6\",\"D\":\"\\u9884\\u5904\\u7406\\u65f6\"}','D','变量',7,'宏  编译');
/*!40000 ALTER TABLE `choose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `begintime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `paper` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (1,0,'2014-05-23 10:00:00','2015-05-23 10:00:00',3);
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill`
--

DROP TABLE IF EXISTS `fill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `chapter` varchar(100) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `tag` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill`
--

LOCK TABLES `fill` WRITE;
/*!40000 ALTER TABLE `fill` DISABLE KEYS */;
INSERT INTO `fill` VALUES (1,'java和javascript什么关系？','{\"A\":\"u6ca1u6709u5173u7cfb\",\"B\":\"nothing\",\"C\":\"\",\"D\":\"\"}','',0,''),(3,'who are you','{\"A\":\"hello\",\"B\":\"\",\"C\":\"\",\"D\":\"\"}','',0,''),(4,'aaa hahah','{\"A\":\"aaa\",\"B\":\"fjlgfl45g\",\"C\":\"flejrl\",\"D\":\"fl3jrf34gf34\"}','',0,''),(5,'1+2=?','{\"A\":\"1\",\"B\":\"2\",\"C\":\"3\",\"D\":\"4\"}','',0,''),(6,'fn3kf5gnln','{\"A\":\"nf34l\",\"B\":\"nlfnlf\",\"C\":\"f3n4l\",\"D\":\"nlf3n4lfn3\"}','',0,''),(7,'f4ngk45ngl4l','{\"A\":\"nfl3n4lnl\",\"B\":\"nlf3n4ln\",\"C\":\"lf3l4n\",\"D\":\"lfnl34n\"}','',0,''),(8,'monkey','{\"A\":\"mmmm\",\"B\":\"\",\"C\":\"\",\"D\":\"\"}','',0,''),(9,'what the fuck ','{\"A\":\"fuck\",\"B\":\"\",\"C\":\"\",\"D\":\"\"}','',0,''),(10,'right ','{\"A\":\"right\",\"B\":\"\",\"C\":\"\",\"D\":\"\"}','',0,''),(11,'MRright','{\"A\":\"right\",\"B\":\"MR\",\"C\":\"\",\"D\":\"\"}','',0,''),(12,'f4ng45gljgl5jl','{\"A\":\"fl\",\"B\":\"lf3j4\",\"C\":\"\",\"D\":\"\"}','',0,''),(16,'这个题目怎么没有答案','{\"A\":\"u5475u5475\",\"B\":\"u563fu563f\",\"C\":\"u539au539a\",\"D\":\"ud83dude04\"}','',0,''),(17,'1+1=？','{\"A\":\"1\",\"B\":\"2\",\"C\":\"3\",\"D\":\"4\"}','分支',1,'运算');
/*!40000 ALTER TABLE `fill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paper`
--

DROP TABLE IF EXISTS `paper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `paper` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper`
--

LOCK TABLES `paper` WRITE;
/*!40000 ALTER TABLE `paper` DISABLE KEYS */;
INSERT INTO `paper` VALUES (3,1,'2014年开学第一场测试',0,'{\"choose\":\"25,24,23,22,21,20,19,18,17,16,15,13,12,11,10,9,8,7,6,3\",\"fill\":\"12,11,10,9,8,7,6,5,4,3\",\"program\":\"5,4,3,2,1\"}');
/*!40000 ALTER TABLE `paper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `answer` text,
  `chapter` varchar(100) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `tag` varchar(500) DEFAULT NULL,
  `testdata` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (1,'编写一个程序输出0-10','#include <stdio.h>\r\nvoid main(){\r\n  int i = 0;\r\n  for (;i < 10;i ++){ \r\n    printf(\"%d\",i);\r\n  }\r\n}','',0,'','{\"iA\":\"1\",\"oA\":\"0 1 2 3 4 5 6 7 8 9 \",\"iB\":\"2\",\"oB\":\"0 1 2 3 4 5 6 7 8 9 \",\"iC\":\"3\",\"oC\":\"0 1 2 3 4 5 6 7 8 9 \",\"iD\":\"4\",\"oD\":\"0 1 2 3 4 5 6 7 8 9 \"}'),(2,'写一个函数将输入的两个数相加得到结果','#include <stdio.h>\r\nvoid main(){\r\n    int a;\r\n    int b;\r\n    scanf(%d, &a);\r\n   scanf(%d, &b);\r\n   printf(\"%d\",a+b );\r\n}','',0,'','{\"iA\":\"1 2 \",\"oA\":\"3\",\"iB\":\"4 5\",\"oB\":\"9\",\"iC\":\"\",\"oC\":\"\",\"iD\":\"\",\"oD\":\"\"}'),(4,'写一个函数将输入的两个数相加得到结果','#include <stdio.h>\r\nvoid main(){\r\n    int a;\r\n    int b;\r\n    scanf(%d, &a);\r\n   scanf(%d, &b);\r\n   printf(\"%d\",a*b );\r\n}','',0,'','{\"iA\":\"1 2\",\"oA\":\"2\",\"iB\":\"2 3\",\"oB\":\"6\",\"iC\":\"3  4\",\"oC\":\"12\",\"iD\":\"\",\"oD\":\"\"}'),(5,'编写一个程序输出0-10','#include <stdio.h>\r\nvoid main(){\r\n  int i = 0;\r\n  for (;i <= 10;i ++){ \r\n    printf(\"%d\",i);\r\n  }\r\n}','',0,'','{\"iA\":\"00\",\"oA\":\"10\",\"iB\":\"\",\"oB\":\"\",\"iC\":\"\",\"oC\":\"\",\"iD\":\"\",\"oD\":\"\"}'),(7,'fnergjlgjl4gjlgjlgj4','jfl3jgl45gl4jg5ljj','',0,'','{\"iA\":\"lf3jrl\",\"oA\":\"lf3j4lj\",\"iB\":\"\",\"oB\":\"\",\"iC\":\"\",\"oC\":\"\",\"iD\":\"\",\"oD\":\"\"}'),(8,'you got a parort','hahaha','',0,'','{\"iA\":\"aaa\",\"oA\":\"bbb\",\"iB\":\"ccc\",\"oB\":\"dddd\",\"iC\":\"\",\"oC\":\"\",\"iD\":\"\",\"oD\":\"\"}');
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `answer` text NOT NULL,
  `score` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result`
--

LOCK TABLES `result` WRITE;
/*!40000 ALTER TABLE `result` DISABLE KEYS */;
INSERT INTO `result` VALUES (1,2,'{\"choose\":[\"A\",\"B\",\"C\",\"D\",\"A\",\"B\",\"C\",\"D\",\"B\",\"A\",\"C\",\"A\",\"C\",\"B\",\"B\",\"B\",\"B\",\"A\",\"C\",\"\"],\"fill\":[\"asdf\",\"b\",\"c\",\"d\",\"e\",\"f\",\"g\",\"h\",\"i\",\"j\"],\"program\":[\"you are my girl\",\"                            b                        \",\"                            c                        \",\"                            d                        \",null]}',2,1);
/*!40000 ALTER TABLE `result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `num` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'朱广文','123456','U201013044'),(2,'summer','123456','U201013045');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-28 14:09:55
