/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : votacion_estatal

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 01/10/2022 13:15:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cat_asociacion
-- ----------------------------
DROP TABLE IF EXISTS `cat_asociacion`;
CREATE TABLE `cat_asociacion`  (
  `pk_asociacion` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estatus` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`pk_asociacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_asociacion
-- ----------------------------
INSERT INTO `cat_asociacion` VALUES (1, 'AJEDREZ', 0);
INSERT INTO `cat_asociacion` VALUES (2, 'ATLETISMO', 1);
INSERT INTO `cat_asociacion` VALUES (3, 'BASQUETBOL', 0);
INSERT INTO `cat_asociacion` VALUES (4, 'BEISBOL', 1);
INSERT INTO `cat_asociacion` VALUES (5, 'BOLICHE', 1);
INSERT INTO `cat_asociacion` VALUES (6, 'BOXEO', 1);
INSERT INTO `cat_asociacion` VALUES (7, 'CANOTAJE', 1);
INSERT INTO `cat_asociacion` VALUES (8, 'CICLISMO', 1);
INSERT INTO `cat_asociacion` VALUES (9, 'DEPORTISTAS CON DISCAPACIDAD VISUAL', 1);
INSERT INTO `cat_asociacion` VALUES (10, 'DEPORTE SOBRE SILLA DE RUEDAS', 1);
INSERT INTO `cat_asociacion` VALUES (11, 'DEPORTISTAS CON DISCAPACIDAD AUDITIVA', 1);
INSERT INTO `cat_asociacion` VALUES (12, 'DEPORTISTAS CON DISCAPACIDAD INTELECTUAL', 1);
INSERT INTO `cat_asociacion` VALUES (13, 'DEPORTISTAS CON PARALISIS CEREBRAL', 1);
INSERT INTO `cat_asociacion` VALUES (14, 'DISCO VOLADOR ', 1);
INSERT INTO `cat_asociacion` VALUES (15, 'ESGRIMA', 1);
INSERT INTO `cat_asociacion` VALUES (16, 'FISICOCONSTRUCTIVISMO', 1);
INSERT INTO `cat_asociacion` VALUES (17, 'FUTBOL', 1);
INSERT INTO `cat_asociacion` VALUES (18, 'FUTBOL AMERICANO', 1);
INSERT INTO `cat_asociacion` VALUES (19, 'GIMNASIA', 1);
INSERT INTO `cat_asociacion` VALUES (20, 'HANDBALL', 1);
INSERT INTO `cat_asociacion` VALUES (21, 'HOCKEY', 1);
INSERT INTO `cat_asociacion` VALUES (22, 'JUDO', 1);
INSERT INTO `cat_asociacion` VALUES (23, 'JUEGOS Y DEPORTES AUTOCTONOS', 1);
INSERT INTO `cat_asociacion` VALUES (24, 'KARATE DO', 1);
INSERT INTO `cat_asociacion` VALUES (25, 'LEVANTAMIENTO DE PESAS', 1);
INSERT INTO `cat_asociacion` VALUES (26, 'LUCHAS ASOCIADAS', 1);
INSERT INTO `cat_asociacion` VALUES (27, 'NATACIÓN', 1);
INSERT INTO `cat_asociacion` VALUES (28, 'PATINES SOBRE RUEDAS', 1);
INSERT INTO `cat_asociacion` VALUES (29, 'PENTATLÓN', 1);
INSERT INTO `cat_asociacion` VALUES (30, 'REMO', 1);
INSERT INTO `cat_asociacion` VALUES (31, 'SOFTBOL', 1);
INSERT INTO `cat_asociacion` VALUES (32, 'TAE KWON DO', 1);
INSERT INTO `cat_asociacion` VALUES (33, 'TENIS', 0);
INSERT INTO `cat_asociacion` VALUES (34, 'TENIS DE MESA', 1);
INSERT INTO `cat_asociacion` VALUES (35, 'TIRO CON ARCO', 1);
INSERT INTO `cat_asociacion` VALUES (36, 'TIRO DEPORTIVO', 1);
INSERT INTO `cat_asociacion` VALUES (37, 'TRIATLON', 0);

-- ----------------------------
-- Table structure for cat_estatus
-- ----------------------------
DROP TABLE IF EXISTS `cat_estatus`;
CREATE TABLE `cat_estatus`  (
  `pk_estatus` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_estatus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_estatus
-- ----------------------------
INSERT INTO `cat_estatus` VALUES (1, 'Activo');
INSERT INTO `cat_estatus` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for cat_modalidad
-- ----------------------------
DROP TABLE IF EXISTS `cat_modalidad`;
CREATE TABLE `cat_modalidad`  (
  `pk_modalidad` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pk_modalidad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_modalidad
-- ----------------------------
INSERT INTO `cat_modalidad` VALUES (1, 'DEPORTISTA O ATLETA', 1);
INSERT INTO `cat_modalidad` VALUES (2, 'ENTRENADOR', 1);
INSERT INTO `cat_modalidad` VALUES (3, 'FOMENTO', 1);

-- ----------------------------
-- Table structure for cat_perfil
-- ----------------------------
DROP TABLE IF EXISTS `cat_perfil`;
CREATE TABLE `cat_perfil`  (
  `pk_perfil` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comentarios` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_perfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_perfil
-- ----------------------------
INSERT INTO `cat_perfil` VALUES (1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA');
INSERT INTO `cat_perfil` VALUES (2, 'CAPTURISTA', 'CAPTURISTA DEL SISTEMA');
INSERT INTO `cat_perfil` VALUES (5, 'VOTANTE', 'ACCESO SOLO A VOTACIONES');

-- ----------------------------
-- Table structure for nominado
-- ----------------------------
DROP TABLE IF EXISTS `nominado`;
CREATE TABLE `nominado`  (
  `pk_nominado` int NOT NULL AUTO_INCREMENT,
  `nombre_nominado` varchar(130) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_asociacion` int NULL DEFAULT NULL,
  `fk_modalidad` int NULL DEFAULT NULL,
  `fk_usuario` int NULL DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` date NULL DEFAULT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_nominado`) USING BTREE,
  INDEX `fk_asociacion`(`fk_asociacion`) USING BTREE,
  INDEX `fk_modalidad`(`fk_modalidad`) USING BTREE,
  INDEX `fk_usuario`(`fk_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of nominado
-- ----------------------------
INSERT INTO `nominado` VALUES (1, 'DAVID AGUILAR PACHECO', 16, 2, 2, 1, '2022-10-01', '2022-10-01 13:03:10');
INSERT INTO `nominado` VALUES (2, 'ANA CAAMAL MAY', 13, 3, 2, 1, '2022-10-01', '2022-10-01 13:03:10');
INSERT INTO `nominado` VALUES (3, 'ROBERTO BAAS CHAN', 6, 2, 1, 1, '2022-10-01', '2022-10-01 13:03:11');
INSERT INTO `nominado` VALUES (4, 'ZOILA MARIA DE LOS ANGELES CASTILLO DOMINGUEZ', 9, 2, 1, 0, '2022-10-01', '2022-10-01 13:06:28');
INSERT INTO `nominado` VALUES (5, 'GABRIEL MANRIQUE PECH', 3, 1, 1, 1, '2022-10-01', '2022-10-01 13:03:13');
INSERT INTO `nominado` VALUES (7, 'sdfsdfsdf', 4, 2, 1, 1, '2022-10-01', NULL);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `pk_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'Usuario para logueo',
  `contrasena_usuario` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'Contraseña',
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'Nombre completo',
  `apellido1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apellido2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Telefono oficina',
  `correo_usuario` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Correo electrónico',
  `fk_estatus` int NULL DEFAULT 1 COMMENT '1 -> Activo\r\n 2 -> Inactivo',
  `fecha_creacion` date NULL DEFAULT NULL,
  `fk_perfil` int NULL DEFAULT NULL COMMENT 'Para identificar con tbl_sistema_perfiles',
  `fecha_modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `fechaUltimoAcceso` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pk_usuario`) USING BTREE,
  INDEX `fk_perfil`(`fk_perfil`) USING BTREE,
  INDEX `fk_estatus`(`fk_estatus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Catalogo con la realación de usuarios que acceden a la plataforma' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'alfredo.carmona', '7c222fb2927d828af22f592134e8932480637c0d', 'Alfredo Gualfre', 'Carmona', 'Irigoyen', '9994119483', 'acarmona@gmail.com', 1, '2022-07-13', 1, '2022-10-01 12:21:12', '2022-10-01 12:21:12');
INSERT INTO `usuario` VALUES (2, 'admin.admin', '7c222fb2927d828af22f592134e8932480637c0d', 'Admin', 'Admin', 'Admin', '', '', 1, '2022-07-14', 2, '2022-07-29 13:37:33', '2022-07-29 13:37:33');
INSERT INTO `usuario` VALUES (7, 'pruebas.pruebas', '7c222fb2927d828af22f592134e8932480637c0d', 'prueba', 'prub', 'pruba', '9994119483', 'acarmona2695@gmail.com', 2, '2022-08-08', 2, '2022-09-29 08:02:26', NULL);
INSERT INTO `usuario` VALUES (8, 'acarmona2695', '6cbdff9f68011a8095852d3d9846c94f1b4fbb1c', 'Alfredo Gualfre', 'Carmona', 'Irigoyen', '9994119483', 'acarmona2695@gmail.com', 1, '2022-08-08', 1, '2022-08-08 13:11:41', NULL);
INSERT INTO `usuario` VALUES (9, 'aaaaaaaaaaaaa', '3495ff69d34671d1e15b33a63c1379fdedd3a32a', 'aaa', 'aa', 'aaaa', '99999999', 'acarmona2695@gmail.com', 1, '2022-08-08', 1, NULL, NULL);
INSERT INTO `usuario` VALUES (10, 'prueba.prueba', '7c222fb2927d828af22f592134e8932480637c0d', 'prueba1', 'prub', 'prub1', '99112313', 'prueba@gmail.com', 1, '2022-09-28', 2, NULL, NULL);

-- ----------------------------
-- Table structure for voto
-- ----------------------------
DROP TABLE IF EXISTS `voto`;
CREATE TABLE `voto`  (
  `pk_voto` int NOT NULL AUTO_INCREMENT,
  `fk_usuario` int NULL DEFAULT NULL,
  `fk_nominado` int NULL DEFAULT NULL,
  `fk_modalidad` int NULL DEFAULT NULL,
  `fecha_creacion` date NULL DEFAULT NULL,
  `punto` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_voto`) USING BTREE,
  INDEX `fk_usuario`(`fk_usuario`) USING BTREE,
  INDEX `fk_nominado`(`fk_nominado`) USING BTREE,
  INDEX `fk_modalidad`(`fk_modalidad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of voto
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
