/*
 Navicat Premium Data Transfer

 Source Server         : votacion_PE
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : directorio

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 29/09/2022 11:30:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for atleta
-- ----------------------------
DROP TABLE IF EXISTS `atleta`;
CREATE TABLE `atleta`  (
  `pk_atleta` int NOT NULL AUTO_INCREMENT,
  `nombre_atleta` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_asociacion` int NULL DEFAULT NULL,
  `fk_disciplina` int NULL DEFAULT NULL,
  PRIMARY KEY (`pk_atleta`) USING BTREE,
  INDEX `fk_asociacion`(`fk_asociacion` ASC) USING BTREE,
  INDEX `fk_disciplina`(`fk_disciplina` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of atleta
-- ----------------------------

-- ----------------------------
-- Table structure for cat_asociacion
-- ----------------------------
DROP TABLE IF EXISTS `cat_asociacion`;
CREATE TABLE `cat_asociacion`  (
  `pk_asociacion` int NOT NULL AUTO_INCREMENT,
  `nombre_asociacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pk_asociacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_asociacion
-- ----------------------------

-- ----------------------------
-- Table structure for cat_disciplina
-- ----------------------------
DROP TABLE IF EXISTS `cat_disciplina`;
CREATE TABLE `cat_disciplina`  (
  `pk_disciplina` int NOT NULL AUTO_INCREMENT,
  `nombre_disciplina` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pk_disciplina`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_disciplina
-- ----------------------------

-- ----------------------------
-- Table structure for cat_estatus
-- ----------------------------
DROP TABLE IF EXISTS `cat_estatus`;
CREATE TABLE `cat_estatus`  (
  `pk_estatus` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_estatus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_estatus
-- ----------------------------
INSERT INTO `cat_estatus` VALUES (1, 'Activo');
INSERT INTO `cat_estatus` VALUES (2, 'Inactivo');
INSERT INTO `cat_estatus` VALUES (3, 'desabilitar');
INSERT INTO `cat_estatus` VALUES (4, 'desbili');

-- ----------------------------
-- Table structure for cat_modalidad
-- ----------------------------
DROP TABLE IF EXISTS `cat_modalidad`;
CREATE TABLE `cat_modalidad`  (
  `pk_modalidad` int NOT NULL AUTO_INCREMENT,
  `nombre_modalidad` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pk_modalidad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_modalidad
-- ----------------------------
INSERT INTO `cat_modalidad` VALUES (1, 'Deportista o Atleta');
INSERT INTO `cat_modalidad` VALUES (2, 'Entrenador');
INSERT INTO `cat_modalidad` VALUES (3, 'Fomento');

-- ----------------------------
-- Table structure for cat_perfil
-- ----------------------------
DROP TABLE IF EXISTS `cat_perfil`;
CREATE TABLE `cat_perfil`  (
  `pk_perfil` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comentarios` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_perfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_perfil
-- ----------------------------
INSERT INTO `cat_perfil` VALUES (1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA');
INSERT INTO `cat_perfil` VALUES (2, 'CAPTURISTA', 'CAPTURISTA DEL SISTEMA');

-- ----------------------------
-- Table structure for entrenador
-- ----------------------------
DROP TABLE IF EXISTS `entrenador`;
CREATE TABLE `entrenador`  (
  `pk_entrenador` int NOT NULL AUTO_INCREMENT,
  `nombre_entrenador` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_asociacion` int NULL DEFAULT NULL,
  `fk_disciplina` int NULL DEFAULT NULL,
  PRIMARY KEY (`pk_entrenador`) USING BTREE,
  UNIQUE INDEX `fk_asociacion`(`fk_asociacion` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of entrenador
-- ----------------------------

-- ----------------------------
-- Table structure for fomento
-- ----------------------------
DROP TABLE IF EXISTS `fomento`;
CREATE TABLE `fomento`  (
  `pk_fomento` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_asociacion` int NULL DEFAULT NULL,
  `fk_disciplina` int NULL DEFAULT NULL,
  PRIMARY KEY (`pk_fomento`) USING BTREE,
  INDEX `fk_asociacion`(`fk_asociacion` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fomento
-- ----------------------------

-- ----------------------------
-- Table structure for nominado
-- ----------------------------
DROP TABLE IF EXISTS `nominado`;
CREATE TABLE `nominado`  (
  `pk_nominado` int NOT NULL AUTO_INCREMENT,
  `Nombre_nominado` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_asociacion` int NULL DEFAULT NULL,
  `fk_modalidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`pk_nominado`) USING BTREE,
  INDEX `fk_asociacion`(`fk_asociacion` ASC) USING BTREE,
  INDEX `fk_modalidad`(`fk_modalidad` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nominado
-- ----------------------------

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
  INDEX `fk_perfil`(`fk_perfil` ASC) USING BTREE,
  INDEX `fk_estatus`(`fk_estatus` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Catalogo con la realación de usuarios que acceden a la plataforma' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'alfredo.carmona', '7c222fb2927d828af22f592134e8932480637c0d', 'Alfredo Gualfre', 'Carmona', 'Irigoyen', '9994119483', 'acarmona@gmail.com', 1, '2022-07-13', 1, '2022-09-29 07:40:49', '2022-09-29 07:40:49');
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
  `puntos` decimal(10, 2) NOT NULL,
  `fk_usuario` int NULL DEFAULT NULL,
  `fk_alteta` int NULL DEFAULT NULL,
  `fk_entrenador` int NULL DEFAULT NULL,
  `fk_fomento` int NULL DEFAULT NULL,
  `fk_nominado` int NULL DEFAULT NULL,
  PRIMARY KEY (`pk_voto`) USING BTREE,
  INDEX `fk_usuario`(`fk_usuario` ASC) USING BTREE,
  INDEX `fk_alteta`(`fk_alteta` ASC) USING BTREE,
  INDEX `fk_entrenador`(`fk_entrenador` ASC) USING BTREE,
  INDEX `fk_fomento`(`fk_fomento` ASC) USING BTREE,
  INDEX `fk_nominado`(`fk_nominado` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of voto
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
