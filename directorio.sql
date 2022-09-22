/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : directorio

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 23/08/2022 15:36:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cat_estatus
-- ----------------------------
DROP TABLE IF EXISTS `cat_estatus`;
CREATE TABLE `cat_estatus`  (
  `pk_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_estatus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_estatus
-- ----------------------------
INSERT INTO `cat_estatus` VALUES (1, 'Activo');
INSERT INTO `cat_estatus` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for cat_perfil
-- ----------------------------
DROP TABLE IF EXISTS `cat_perfil`;
CREATE TABLE `cat_perfil`  (
  `pk_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comentarios` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk_perfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_perfil
-- ----------------------------
INSERT INTO `cat_perfil` VALUES (1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA');
INSERT INTO `cat_perfil` VALUES (2, 'CAPTURISTA', 'CAPTURISTA DEL SISTEMA');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `pk_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'Usuario para logueo',
  `contrasena_usuario` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'Contraseña',
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'Nombre completo',
  `apellido1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apellido2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Telefono oficina',
  `correo_usuario` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Correo electrónico',
  `fk_estatus` int(11) NULL DEFAULT 1 COMMENT '1 -> Activo\r\n 2 -> Inactivo',
  `fecha_creacion` date NULL DEFAULT NULL,
  `fk_perfil` int(11) NULL DEFAULT NULL COMMENT 'Para identificar con tbl_sistema_perfiles',
  `fecha_modificacion` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `fechaUltimoAcceso` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`pk_usuario`) USING BTREE,
  INDEX `fk_perfil`(`fk_perfil`) USING BTREE,
  INDEX `fk_estatus`(`fk_estatus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Catalogo con la realación de usuarios que acceden a la plataforma' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'alfredo.carmona', '7c222fb2927d828af22f592134e8932480637c0d', 'Alfredo Gualfre', 'Carmona', 'Irigoyen', '9994119483', 'acarmona@gmail.com', 1, '2022-07-13', 1, '2022-08-23 13:57:48', '2022-08-23 13:57:48');
INSERT INTO `usuario` VALUES (2, 'admin.admin', '7c222fb2927d828af22f592134e8932480637c0d', 'Admin', 'Admin', 'Admin', '', '', 1, '2022-07-14', 2, '2022-07-29 13:37:33', '2022-07-29 13:37:33');
INSERT INTO `usuario` VALUES (7, 'pruebas.pruebas', '7c222fb2927d828af22f592134e8932480637c0d', 'prueba', 'prub', 'pruba', '9994119483', 'acarmona2695@gmail.com', 1, '2022-08-08', 1, NULL, NULL);
INSERT INTO `usuario` VALUES (8, 'acarmona2695', '6cbdff9f68011a8095852d3d9846c94f1b4fbb1c', 'Alfredo Gualfre', 'Carmona', 'Irigoyen', '9994119483', 'acarmona2695@gmail.com', 1, '2022-08-08', 1, '2022-08-08 13:11:41', NULL);
INSERT INTO `usuario` VALUES (9, 'aaaaaaaaaaaaa', '3495ff69d34671d1e15b33a63c1379fdedd3a32a', 'aaa', 'aa', 'aaaa', '99999999', 'acarmona2695@gmail.com', 1, '2022-08-08', 1, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
