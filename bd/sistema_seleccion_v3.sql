-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistema_seleccion
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sistema_seleccion
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sistema_seleccion` DEFAULT CHARACTER SET utf8 ;
USE `sistema_seleccion` ;

-- -----------------------------------------------------
-- Table `mydb`.`departamento_actual`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`departamento_actual` (
  `iddepartamento_actual` INT NOT NULL,
  `departamento` VARCHAR(45) NULL,
  PRIMARY KEY (`iddepartamento_actual`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`provincia_actual`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`provincia_actual` (
  `idprovincia_actual` INT NOT NULL,
  `provincia` VARCHAR(45) NULL,
  `departamento_actual_iddepartamento_actual` INT NOT NULL,
  PRIMARY KEY (`idprovincia_actual`),
  INDEX `fk_provincia_actual_departamento_actual_idx` (`departamento_actual_iddepartamento_actual` ASC) VISIBLE,
  CONSTRAINT `fk_provincia_actual_departamento_actual`
    FOREIGN KEY (`departamento_actual_iddepartamento_actual`)
    REFERENCES `sistema_seleccion`.`departamento_actual` (`iddepartamento_actual`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `sistema_seleccion`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`cargo` (
  `idcargo` INT NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`idcargo`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`equipo_ejec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`equipo_ejec` (
  `idequipo` INT NOT NULL AUTO_INCREMENT,
  `equipo_ejec` VARCHAR(300) NULL DEFAULT NULL,
  PRIMARY KEY (`idequipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`direccion_ejec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`direccion_ejec` (
  `iddireccion` INT NOT NULL AUTO_INCREMENT,
  `direccion_ejec` VARCHAR(200) NULL DEFAULT NULL,
  `equipo_ejec_idequipo` INT NOT NULL,
  PRIMARY KEY (`iddireccion`),
  INDEX `fk_direccion_ejec_equipo_ejec1_idx` (`equipo_ejec_idequipo` ASC) VISIBLE,
  CONSTRAINT `fk_direccion_ejec_equipo_ejec1`
    FOREIGN KEY (`equipo_ejec_idequipo`)
    REFERENCES `sistema_seleccion`.`equipo_ejec` (`idequipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`convocatoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`convocatoria` (
  `idcon` INT NOT NULL AUTO_INCREMENT,
  `num_con` VARCHAR(4) NOT NULL,
  `año_con` INT NOT NULL,
  `tipo_con` VARCHAR(45) NOT NULL,
  `fech_ini` DATE NULL DEFAULT NULL,
  `fech_term` DATE NULL DEFAULT NULL,
  `porcen_eva_cu` INT NOT NULL,
  `porce_entrevista` INT NOT NULL,
  `porce_discapacidad` INT NOT NULL,
  `porce_sermilitar` INT NOT NULL,
  `porce_exa_escrito` INT NOT NULL,
  `direccion_ejec_iddireccion` INT NOT NULL,
  PRIMARY KEY (`idcon`),
  INDEX `fk_convocatoria_direccion_ejec1_idx` (`direccion_ejec_iddireccion` ASC) VISIBLE,
  CONSTRAINT `fk_convocatoria_direccion_ejec1`
    FOREIGN KEY (`direccion_ejec_iddireccion`)
    REFERENCES `sistema_seleccion`.`direccion_ejec` (`iddireccion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`comision`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`comision` (
  `idcomision` INT NOT NULL AUTO_INCREMENT,
  `cargo_funcio` VARCHAR(50) NULL DEFAULT NULL,
  `nombre` VARCHAR(100) NULL DEFAULT NULL,
  `apellidos` VARCHAR(100) NULL DEFAULT NULL,
  `area_user` VARCHAR(100) NULL DEFAULT NULL,
  `convocatoria_idcon` INT NOT NULL,
  PRIMARY KEY (`idcomision`),
  INDEX `fk_comision_convocatoria1_idx` (`convocatoria_idcon` ASC) VISIBLE,
  CONSTRAINT `fk_comision_convocatoria1`
    FOREIGN KEY (`convocatoria_idcon`)
    REFERENCES `sistema_seleccion`.`convocatoria` (`idcon`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`departamento` (
  `iddepartamento` INT NOT NULL AUTO_INCREMENT,
  `departamento` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`iddepartamento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`provincia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`provincia` (
  `idprovincia` INT NOT NULL AUTO_INCREMENT,
  `provincia` VARCHAR(45) NULL DEFAULT NULL,
  `departamento_iddepartamento` INT NOT NULL,
  PRIMARY KEY (`idprovincia`),
  INDEX `fk_provincia_departamento1_idx` (`departamento_iddepartamento` ASC) VISIBLE,
  CONSTRAINT `fk_provincia_departamento1`
    FOREIGN KEY (`departamento_iddepartamento`)
    REFERENCES `sistema_seleccion`.`departamento` (`iddepartamento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`distrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`distrito` (
  `iddistrito` INT NOT NULL AUTO_INCREMENT,
  `distrito` VARCHAR(45) NULL DEFAULT NULL,
  `provincia_idprovincia` INT NOT NULL,
  PRIMARY KEY (`iddistrito`),
  INDEX `fk_distrito_provincia1_idx` (`provincia_idprovincia` ASC) VISIBLE,
  CONSTRAINT `fk_distrito_provincia1`
    FOREIGN KEY (`provincia_idprovincia`)
    REFERENCES `sistema_seleccion`.`provincia` (`idprovincia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`postulante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`postulante` (
  `idpostulante` INT NOT NULL AUTO_INCREMENT,
  `dni` VARCHAR(8) NULL DEFAULT NULL,
  `nombres` VARCHAR(45) NULL DEFAULT NULL,
  `ape_pat` VARCHAR(25) NULL DEFAULT NULL,
  `ape_mat` VARCHAR(25) NULL DEFAULT NULL,
  `estado_civil` VARCHAR(45) NULL DEFAULT NULL,
  `celular` VARCHAR(45) NULL DEFAULT NULL,
  `correo` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(45) NULL DEFAULT NULL,
  `ruc` INT NULL DEFAULT NULL,
  `fech_nac` DATE NULL DEFAULT NULL,
  `direccion` VARCHAR(150) NULL DEFAULT NULL,
  `num_cuenta` INT NULL DEFAULT NULL,
  `seguro` VARCHAR(15) NULL DEFAULT NULL,
  `suspension_cuarta` VARCHAR(15) NULL DEFAULT NULL,
  `celular_emer` VARCHAR(45) NULL DEFAULT NULL,
  `parentesco_emer` VARCHAR(100) NULL DEFAULT NULL,
  `discapacidad` VARCHAR(45) NULL DEFAULT NULL,
  `tipo_discap` VARCHAR(45) NULL DEFAULT NULL,
  `distrito_iddistrito` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idpostulante`),
  INDEX `fk_postulante_distrito1_idx` (`distrito_iddistrito` ASC) VISIBLE,
  CONSTRAINT `fk_postulante_distrito1`
    FOREIGN KEY (`distrito_iddistrito`)
    REFERENCES `sistema_seleccion`.`distrito` (`iddistrito`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`detalle_convocatoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`detalle_convocatoria` (
  `iddetalle_convocatoria` INT NOT NULL AUTO_INCREMENT,
  `convocatoria_idcon` INT NOT NULL,
  `postulante_idpostulante` INT NOT NULL,
  `cargo_idcargo` INT NOT NULL,
  PRIMARY KEY (`iddetalle_convocatoria`),
  INDEX `fk_detalle_convocatoria_convocatoria1_idx` (`convocatoria_idcon` ASC) VISIBLE,
  INDEX `fk_detalle_convocatoria_postulante1_idx` (`postulante_idpostulante` ASC) VISIBLE,
  INDEX `fk_detalle_convocatoria_cargo1_idx` (`cargo_idcargo` ASC) VISIBLE,
  CONSTRAINT `fk_detalle_convocatoria_cargo1`
    FOREIGN KEY (`cargo_idcargo`)
    REFERENCES `sistema_seleccion`.`cargo` (`idcargo`),
  CONSTRAINT `fk_detalle_convocatoria_convocatoria1`
    FOREIGN KEY (`convocatoria_idcon`)
    REFERENCES `sistema_seleccion`.`convocatoria` (`idcon`),
  CONSTRAINT `fk_detalle_convocatoria_postulante1`
    FOREIGN KEY (`postulante_idpostulante`)
    REFERENCES `sistema_seleccion`.`postulante` (`idpostulante`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_aux_admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_aux_admin` (
  `ideva_aux_admin` INT NOT NULL AUTO_INCREMENT,
  `seccion` INT NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_aux_admin`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_otros_prof`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_otros_prof` (
  `ideva_otros_prof` INT NOT NULL AUTO_INCREMENT,
  `seccion` INT NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_otros_prof`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_prof_salud`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_prof_salud` (
  `ideva_prof_salud` INT NOT NULL AUTO_INCREMENT,
  `seccion` VARCHAR(45) NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_prof_salud`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_tec_admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_tec_admin` (
  `ideva_tec_admin` INT NOT NULL,
  `seccion` INT NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_tec_admin`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_tec_enfermeria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_tec_enfermeria` (
  `ideva_tec_enfermeria` INT NOT NULL,
  `seccion` INT NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_tec_enfermeria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_tec_transp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_tec_transp` (
  `ideva_tec_transp` INT NOT NULL AUTO_INCREMENT,
  `seccion` INT NULL DEFAULT NULL,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_tec_transp`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`detalle_evaluacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`detalle_evaluacion` (
  `iddetalle_evalu` INT NOT NULL AUTO_INCREMENT,
  `eva_tec_enfermeria_ideva_tec_enfermeria` INT NOT NULL,
  `eva_tec_transp_ideva_tec_transp` INT NOT NULL,
  `eva_aux_admin_ideva_aux_admin` INT NOT NULL,
  `eva_tec_admin_ideva_tec_admin` INT NOT NULL,
  `eva_otros_prof_ideva_otros_prof` INT NOT NULL,
  `eva_prof_salud_ideva_prof_salud` INT NOT NULL,
  `cargo_idcargo` INT NOT NULL,
  PRIMARY KEY (`iddetalle_evalu`),
  INDEX `fk_detalle_evaluacion_eva_tec_enfermeria1_idx` (`eva_tec_enfermeria_ideva_tec_enfermeria` ASC) VISIBLE,
  INDEX `fk_detalle_evaluacion_eva_tec_transp1_idx` (`eva_tec_transp_ideva_tec_transp` ASC) VISIBLE,
  INDEX `fk_detalle_evaluacion_eva_aux_admin1_idx` (`eva_aux_admin_ideva_aux_admin` ASC) VISIBLE,
  INDEX `fk_detalle_evaluacion_eva_tec_admin1_idx` (`eva_tec_admin_ideva_tec_admin` ASC) VISIBLE,
  INDEX `fk_detalle_evaluacion_eva_otros_prof1_idx` (`eva_otros_prof_ideva_otros_prof` ASC) VISIBLE,
  INDEX `fk_detalle_evaluacion_eva_prof_salud1_idx` (`eva_prof_salud_ideva_prof_salud` ASC) VISIBLE,
  INDEX `fk_detalle_evaluacion_cargo1_idx` (`cargo_idcargo` ASC) VISIBLE,
  CONSTRAINT `fk_detalle_evaluacion_cargo1`
    FOREIGN KEY (`cargo_idcargo`)
    REFERENCES `sistema_seleccion`.`cargo` (`idcargo`),
  CONSTRAINT `fk_detalle_evaluacion_eva_aux_admin1`
    FOREIGN KEY (`eva_aux_admin_ideva_aux_admin`)
    REFERENCES `sistema_seleccion`.`eva_aux_admin` (`ideva_aux_admin`),
  CONSTRAINT `fk_detalle_evaluacion_eva_otros_prof1`
    FOREIGN KEY (`eva_otros_prof_ideva_otros_prof`)
    REFERENCES `sistema_seleccion`.`eva_otros_prof` (`ideva_otros_prof`),
  CONSTRAINT `fk_detalle_evaluacion_eva_prof_salud1`
    FOREIGN KEY (`eva_prof_salud_ideva_prof_salud`)
    REFERENCES `sistema_seleccion`.`eva_prof_salud` (`ideva_prof_salud`),
  CONSTRAINT `fk_detalle_evaluacion_eva_tec_admin1`
    FOREIGN KEY (`eva_tec_admin_ideva_tec_admin`)
    REFERENCES `sistema_seleccion`.`eva_tec_admin` (`ideva_tec_admin`),
  CONSTRAINT `fk_detalle_evaluacion_eva_tec_enfermeria1`
    FOREIGN KEY (`eva_tec_enfermeria_ideva_tec_enfermeria`)
    REFERENCES `sistema_seleccion`.`eva_tec_enfermeria` (`ideva_tec_enfermeria`),
  CONSTRAINT `fk_detalle_evaluacion_eva_tec_transp1`
    FOREIGN KEY (`eva_tec_transp_ideva_tec_transp`)
    REFERENCES `sistema_seleccion`.`eva_tec_transp` (`ideva_tec_transp`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`distrito_actual`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`distrito_actual` (
  `iddistrito` INT NOT NULL,
  `distrito` VARCHAR(45) NULL DEFAULT NULL,
  `provincia_actual_idprovincia_actual` INT NOT NULL,
  PRIMARY KEY (`iddistrito`),
  INDEX `fk_distrito_actual_provincia_actual1_idx` (`provincia_actual_idprovincia_actual` ASC) VISIBLE,
  CONSTRAINT `fk_distrito_actual_provincia_actual1`
    FOREIGN KEY (`provincia_actual_idprovincia_actual`)
    REFERENCES `sistema_seleccion`.`provincia_actual` (`idprovincia_actual`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`domicilio_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`domicilio_post` (
  `iddomicilio` INT NOT NULL AUTO_INCREMENT,
  `tip_via` VARCHAR(45) NULL DEFAULT NULL,
  `nomb_via` VARCHAR(75) NULL DEFAULT NULL,
  `num_via` VARCHAR(45) NULL DEFAULT NULL,
  `tip_zona` VARCHAR(45) NULL DEFAULT NULL,
  `nomb_zona` VARCHAR(45) NULL DEFAULT NULL,
  `num_zona` VARCHAR(45) NULL DEFAULT NULL,
  `referencia` VARCHAR(150) NULL DEFAULT NULL,
  `postulante_idpostulante` INT NOT NULL,
  `distrito_actual_iddistrito` INT NOT NULL,
  PRIMARY KEY (`iddomicilio`),
  INDEX `fk_domicilio_post_postulante_idx` (`postulante_idpostulante` ASC) VISIBLE,
  INDEX `fk_domicilio_post_distrito_actual1_idx` (`distrito_actual_iddistrito` ASC) VISIBLE,
  CONSTRAINT `fk_domicilio_post_postulante`
    FOREIGN KEY (`postulante_idpostulante`)
    REFERENCES `sistema_seleccion`.`postulante` (`idpostulante`),
  CONSTRAINT `fk_domicilio_post_distrito_actual1`
    FOREIGN KEY (`distrito_actual_iddistrito`)
    REFERENCES `sistema_seleccion`.`distrito_actual` (`iddistrito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`eva_entrevista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`eva_entrevista` (
  `ideva_entrevista` INT NOT NULL AUTO_INCREMENT,
  `informacion` VARCHAR(45) NULL DEFAULT NULL,
  `max_puntaje` INT NULL DEFAULT NULL,
  `puntaje` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ideva_entrevista`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`familia_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`familia_post` (
  `idfamilia` INT NOT NULL,
  `nombre` VARCHAR(100) NULL DEFAULT NULL,
  `apellidos` VARCHAR(100) NULL DEFAULT NULL,
  `fech_nac` DATE NULL DEFAULT NULL,
  `dni` VARCHAR(8) NULL DEFAULT NULL,
  `parentesco` VARCHAR(45) NULL DEFAULT NULL,
  `labora` VARCHAR(150) NULL DEFAULT NULL,
  `postulante_idpostulante` INT NOT NULL,
  PRIMARY KEY (`idfamilia`),
  INDEX `fk_familia_post_postulante1_idx` (`postulante_idpostulante` ASC) VISIBLE,
  CONSTRAINT `fk_familia_post_postulante1`
    FOREIGN KEY (`postulante_idpostulante`)
    REFERENCES `sistema_seleccion`.`postulante` (`idpostulante`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`personal_req`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`personal_req` (
  `idpersonal` INT NOT NULL AUTO_INCREMENT,
  `cantidad` INT NULL DEFAULT NULL,
  `remuneracion` INT NULL DEFAULT NULL,
  `fuente_finac` VARCHAR(30) NULL DEFAULT NULL,
  `meta` INT NULL DEFAULT NULL,
  `cargo_idcargo` INT NOT NULL,
  `convocatoria_idcon` INT NOT NULL,
  PRIMARY KEY (`idpersonal`),
  INDEX `fk_personal_req_cargo1_idx` (`cargo_idcargo` ASC) VISIBLE,
  INDEX `fk_personal_req_convocatoria1_idx` (`convocatoria_idcon` ASC) VISIBLE,
  CONSTRAINT `fk_personal_req_cargo1`
    FOREIGN KEY (`cargo_idcargo`)
    REFERENCES `sistema_seleccion`.`cargo` (`idcargo`),
  CONSTRAINT `fk_personal_req_convocatoria1`
    FOREIGN KEY (`convocatoria_idcon`)
    REFERENCES `sistema_seleccion`.`convocatoria` (`idcon`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`resultado_final`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`resultado_final` (
  `idresultado_final` INT NOT NULL AUTO_INCREMENT,
  `detalle_evaluacion_iddetalle_evalu` INT NOT NULL,
  `ponderado_1` INT NULL DEFAULT NULL,
  `eva_entrevista_ideva_entrevista` INT NOT NULL,
  `ponderado_2` INT NULL DEFAULT NULL,
  `total_puntaje_1` INT NULL DEFAULT NULL,
  `quintil` INT NULL DEFAULT NULL,
  `quintil_porcen` INT NULL DEFAULT NULL,
  `valor_quintil` INT NULL DEFAULT NULL,
  `discapacidad` INT NULL DEFAULT NULL,
  `discapacidad_porce` INT NULL DEFAULT NULL,
  `servicio_mili` INT NULL DEFAULT NULL,
  `servicio_mili_porce` INT NULL DEFAULT NULL,
  `puntaje_final_total` INT NULL DEFAULT NULL,
  `postulante_idpostulante` INT NOT NULL,
  PRIMARY KEY (`idresultado_final`),
  INDEX `fk_resultado_final_detalle_evaluacion1_idx` (`detalle_evaluacion_iddetalle_evalu` ASC) VISIBLE,
  INDEX `fk_resultado_final_eva_entrevista1_idx` (`eva_entrevista_ideva_entrevista` ASC) VISIBLE,
  INDEX `fk_resultado_final_postulante1_idx` (`postulante_idpostulante` ASC) VISIBLE,
  CONSTRAINT `fk_resultado_final_detalle_evaluacion1`
    FOREIGN KEY (`detalle_evaluacion_iddetalle_evalu`)
    REFERENCES `sistema_seleccion`.`detalle_evaluacion` (`iddetalle_evalu`),
  CONSTRAINT `fk_resultado_final_eva_entrevista1`
    FOREIGN KEY (`eva_entrevista_ideva_entrevista`)
    REFERENCES `sistema_seleccion`.`eva_entrevista` (`ideva_entrevista`),
  CONSTRAINT `fk_resultado_final_postulante1`
    FOREIGN KEY (`postulante_idpostulante`)
    REFERENCES `sistema_seleccion`.`postulante` (`idpostulante`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`tipo_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`tipo_user` (
  `idtipo` INT NOT NULL AUTO_INCREMENT,
  `tipo_user` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idtipo`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema_seleccion`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `dni` VARCHAR(8) NOT NULL,
  `nombres` VARCHAR(100) NOT NULL,
  `ape_pat` VARCHAR(45) NOT NULL,
  `ape_mat` VARCHAR(45) NOT NULL,
  `celular` INT NOT NULL,
  `correo` VARCHAR(75) NOT NULL,
  `clave` VARCHAR(45) NOT NULL,
  `confi_clave` VARCHAR(45) NOT NULL,
  `tipo_user_idtipo` INT NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC) VISIBLE,
  INDEX `fk_user_tipo_user1_idx` (`tipo_user_idtipo` ASC) VISIBLE,
  CONSTRAINT `fk_user_tipo_user1`
    FOREIGN KEY (`tipo_user_idtipo`)
    REFERENCES `sistema_seleccion`.`tipo_user` (`idtipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `sistema_seleccion` ;

-- -----------------------------------------------------
-- Placeholder table for view `sistema_seleccion`.`full_convocatoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`full_convocatoria` (`idcon` INT, `num_con` INT, `año_con` INT, `tipo_con` INT, `fech_ini` INT, `fech_term` INT, `porce_discapacidad` INT, `porce_entrevista` INT, `porce_exa_escrito` INT, `porce_sermilitar` INT, `porcen_eva_cu` INT, `direccion_ejec` INT, `equipo_ejec` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sistema_seleccion`.`total_personal_req`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`total_personal_req` (`idpersonal` INT, `cantidad` INT, `remuneracion` INT, `fuente_finac` INT, `meta` INT, `cargo_idcargo` INT, `convocatoria_idcon` INT, `idcargo` INT, `cargo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sistema_seleccion`.`ubicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`ubicacion` (`iddireccion` INT, `direccion_ejec` INT, `equipo_ejec` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sistema_seleccion`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sistema_seleccion`.`usuarios` (`iduser` INT, `dni` INT, `nombres` INT, `ape_pat` INT, `ape_mat` INT, `celular` INT, `correo` INT, `clave` INT, `confi_clave` INT, `tipo_user` INT);

-- -----------------------------------------------------
-- View `sistema_seleccion`.`full_convocatoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistema_seleccion`.`full_convocatoria`;
USE `sistema_seleccion`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sistema_seleccion`.`full_convocatoria` AS select `sistema_seleccion`.`convocatoria`.`idcon` AS `idcon`,`sistema_seleccion`.`convocatoria`.`num_con` AS `num_con`,`sistema_seleccion`.`convocatoria`.`año_con` AS `año_con`,`sistema_seleccion`.`convocatoria`.`tipo_con` AS `tipo_con`,`sistema_seleccion`.`convocatoria`.`fech_ini` AS `fech_ini`,`sistema_seleccion`.`convocatoria`.`fech_term` AS `fech_term`,`sistema_seleccion`.`convocatoria`.`porce_discapacidad` AS `porce_discapacidad`,`sistema_seleccion`.`convocatoria`.`porce_entrevista` AS `porce_entrevista`,`sistema_seleccion`.`convocatoria`.`porce_exa_escrito` AS `porce_exa_escrito`,`sistema_seleccion`.`convocatoria`.`porce_sermilitar` AS `porce_sermilitar`,`sistema_seleccion`.`convocatoria`.`porcen_eva_cu` AS `porcen_eva_cu`,`ubicacion`.`direccion_ejec` AS `direccion_ejec`,`ubicacion`.`equipo_ejec` AS `equipo_ejec` from (`sistema_seleccion`.`convocatoria` join `sistema_seleccion`.`ubicacion`) where (`sistema_seleccion`.`convocatoria`.`direccion_ejec_iddireccion` = `ubicacion`.`iddireccion`);

-- -----------------------------------------------------
-- View `sistema_seleccion`.`total_personal_req`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistema_seleccion`.`total_personal_req`;
USE `sistema_seleccion`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sistema_seleccion`.`total_personal_req` AS select `sistema_seleccion`.`personal_req`.`idpersonal` AS `idpersonal`,`sistema_seleccion`.`personal_req`.`cantidad` AS `cantidad`,`sistema_seleccion`.`personal_req`.`remuneracion` AS `remuneracion`,`sistema_seleccion`.`personal_req`.`fuente_finac` AS `fuente_finac`,`sistema_seleccion`.`personal_req`.`meta` AS `meta`,`sistema_seleccion`.`personal_req`.`cargo_idcargo` AS `cargo_idcargo`,`sistema_seleccion`.`personal_req`.`convocatoria_idcon` AS `convocatoria_idcon`,`sistema_seleccion`.`cargo`.`idcargo` AS `idcargo`,`sistema_seleccion`.`cargo`.`cargo` AS `cargo` from (`sistema_seleccion`.`personal_req` join `sistema_seleccion`.`cargo`) where (`sistema_seleccion`.`personal_req`.`cargo_idcargo` = `sistema_seleccion`.`cargo`.`idcargo`);

-- -----------------------------------------------------
-- View `sistema_seleccion`.`ubicacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistema_seleccion`.`ubicacion`;
USE `sistema_seleccion`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sistema_seleccion`.`ubicacion` AS select `sistema_seleccion`.`direccion_ejec`.`iddireccion` AS `iddireccion`,`sistema_seleccion`.`direccion_ejec`.`direccion_ejec` AS `direccion_ejec`,`sistema_seleccion`.`equipo_ejec`.`equipo_ejec` AS `equipo_ejec` from (`sistema_seleccion`.`direccion_ejec` join `sistema_seleccion`.`equipo_ejec`) where (`sistema_seleccion`.`direccion_ejec`.`iddireccion` = `sistema_seleccion`.`equipo_ejec`.`idequipo`);

-- -----------------------------------------------------
-- View `sistema_seleccion`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistema_seleccion`.`usuarios`;
USE `sistema_seleccion`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sistema_seleccion`.`usuarios` AS select `sistema_seleccion`.`user`.`iduser` AS `iduser`,`sistema_seleccion`.`user`.`dni` AS `dni`,`sistema_seleccion`.`user`.`nombres` AS `nombres`,`sistema_seleccion`.`user`.`ape_pat` AS `ape_pat`,`sistema_seleccion`.`user`.`ape_mat` AS `ape_mat`,`sistema_seleccion`.`user`.`celular` AS `celular`,`sistema_seleccion`.`user`.`correo` AS `correo`,`sistema_seleccion`.`user`.`clave` AS `clave`,`sistema_seleccion`.`user`.`confi_clave` AS `confi_clave`,`sistema_seleccion`.`tipo_user`.`tipo_user` AS `tipo_user` from (`sistema_seleccion`.`user` join `sistema_seleccion`.`tipo_user`) where (`sistema_seleccion`.`user`.`tipo_user_idtipo` = `sistema_seleccion`.`tipo_user`.`idtipo`);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
