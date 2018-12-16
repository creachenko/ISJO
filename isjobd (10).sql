-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2018 a las 19:23:55
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `isjobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aniolectivo`
--

CREATE TABLE `aniolectivo` (
  `idAnioLectivo` int(11) NOT NULL,
  `anio` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aniolectivo`
--

INSERT INTO `aniolectivo` (`idAnioLectivo`, `anio`) VALUES
(1, 2019),
(2, 2018);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `idAsignatura` int(11) NOT NULL,
  `nombreAsignatura` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `idModalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`idAsignatura`, `nombreAsignatura`, `descripcion`, `idModalidad`) VALUES
(1, 'Matematicas', '', 2),
(2, 'Ingles', '', 2),
(3, 'Contabilidad', '', 1),
(4, 'Computacion 1', '', 3),
(5, 'Ciencias Naturales', '', 2),
(6, 'Educacion Fisica', '', 2),
(7, 'Educacion Civica', '', 2),
(8, 'Estudios Sociales', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `idCargo` int(11) NOT NULL,
  `nombreCargo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`idCargo`, `nombreCargo`, `descripcion`) VALUES
(1, 'Director', ''),
(2, 'Secretaria', ''),
(3, 'Docente', ''),
(4, 'Consejeria', ''),
(5, 'Orientacion', ''),
(6, 'Sub  Director', ''),
(7, 'Sub Director', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `idClase` int(11) NOT NULL,
  `idAsignatura` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `horaClase` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`idClase`, `idAsignatura`, `idEmpleado`, `idCurso`, `horaClase`) VALUES
(3, 1, 2, 8, '00:00:00'),
(4, 6, 3, 8, '00:00:00'),
(5, 6, 3, 9, '00:00:00'),
(6, 6, 3, 11, '00:00:00'),
(8, 2, 2, 8, '00:00:00'),
(9, 1, 2, 9, '00:00:00'),
(10, 1, 2, 10, '00:00:00'),
(11, 1, 2, 11, '00:00:00'),
(12, 5, 4, 8, '00:00:00'),
(13, 3, 1, 12, '00:00:00'),
(14, 2, 2, 11, '00:00:00'),
(15, 8, 5, 11, '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL,
  `nombreCurso` varchar(50) NOT NULL,
  `seccion` varchar(50) NOT NULL,
  `idModalidad` int(11) NOT NULL,
  `idAnioLectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `nombreCurso`, `seccion`, `idModalidad`, `idAnioLectivo`) VALUES
(1, '   Decimo Grado', 'a', 1, 1),
(2, 'Decimo Grado', 'B', 1, 1),
(3, 'Undecimo Grado', 'U', 1, 1),
(4, 'Septimo Grado', 'A', 2, 1),
(5, 'Septimo Grado', 'B', 2, 1),
(6, 'Octavo Grado', 'U', 2, 1),
(7, 'Noveno Grado', 'U', 2, 1),
(8, 'Septimo Grado', 'U', 2, 2),
(9, 'Octavo Grado ', 'A', 2, 2),
(10, 'Octavo Grado', 'B', 2, 2),
(11, 'Noveno Grado', 'U', 2, 2),
(12, 'Decimo Grado', 'U', 1, 2),
(13, 'Undecimo Grado', 'U', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `nombreEmpleado` varchar(50) NOT NULL,
  `apellidoEmpleado` varchar(50) NOT NULL,
  `identidad` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `genero` text NOT NULL,
  `imprema` varchar(50) NOT NULL,
  `idCargo` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `fechaIniLabor` date NOT NULL,
  `celular` varchar(50) NOT NULL,
  `tituloMedia` varchar(50) NOT NULL,
  `tituloUniversitario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `nombreEmpleado`, `apellidoEmpleado`, `identidad`, `correo`, `fechaNacimiento`, `genero`, `imprema`, `idCargo`, `direccion`, `fechaIniLabor`, `celular`, `tituloMedia`, `tituloUniversitario`) VALUES
(1, 'Karla ', 'Rodriguez Cabrera', 2147483647, 'karlallacro33@gmail.com', '1972-05-19', 'Femenino', '15321478', 1, 'Punuare Olancho', '2001-02-07', '96400781', 'Maestra de Media', 'Aqui va un titulo universitario'),
(2, 'Santiago De Jesus', 'Cruz Cruz', 2147483647, 'santiago@gmail.com', '1966-01-02', 'Masculino', '15789631', 1, 'punuare Olancho', '2003-02-02', '99384608', 'Maestro de educacion media', 'Abogado'),
(3, 'Bessy Lizeth', 'Erazo Amaya', 7896325, '', '1982-02-25', 'Femenino', '123456789', 3, 'Santa Maria del Real', '2002-05-02', '77885544', 'Maestra en algo', 'se graduo de universidad'),
(4, 'Luz Maria', 'Rivera Sanchez', 77885412, '', '1977-03-02', 'Femenino', '258963', 3, 'Catacamas Olancho', '2016-05-02', '', 'Meida', 'Universidad'),
(5, 'Sonia Elena', 'Baca', 5566, 'lols@gmail.com', '1971-06-01', 'Femenino', '9632589632', 3, 'sgsdg', '1996-02-01', '55223366', 'Educacion Media', 'Licentiatrua en hogar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `idEncargado` int(11) NOT NULL,
  `nombreEncargado` varchar(50) NOT NULL,
  `apellidoEncargado` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `identidad` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `profesion` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encargados`
--

INSERT INTO `encargados` (`idEncargado`, `nombreEncargado`, `apellidoEncargado`, `telefono`, `genero`, `identidad`, `correo`, `profesion`, `direccion`) VALUES
(1, 'ffff', 'fff', 'fff', 'Masculino', 'fff', 'fff', 'fff', 'ff'),
(2, 'Jorge Adalberto', 'Salgado Paz', '1596325', 'Masculino', '1122', '', 'tecnico', 'aqui'),
(3, 'Karla Yamileth ', 'Rodriguez Cabrera', '33373852', 'Femenino', '1503197200651', 'karlallacro33@gmail.com', 'Maestra', 'Punuare'),
(4, 'Santiago de Jesus', 'Cruz Cruz', '99384608', 'Masculino', '1501197600196', 'santiago@gmail.com', 'Maestro', 'Punuare,Juticalpa,Olancho'),
(5, 'mama de nolvia ', 'rosales', '55663322', 'Femenino', '8899', '', 'Ama de casa', 'barrio la trinidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadotareas`
--

CREATE TABLE `estadotareas` (
  `idEstadoTarea` int(11) NOT NULL,
  `puntajeObtenido` int(11) NOT NULL,
  `tareaPresentada` tinyint(1) NOT NULL,
  `motivoTareaNoPresentada` varchar(100) NOT NULL,
  `idTarea` int(11) NOT NULL,
  `idEstudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadotareas`
--

INSERT INTO `estadotareas` (`idEstadoTarea`, `puntajeObtenido`, `tareaPresentada`, `motivoTareaNoPresentada`, `idTarea`, `idEstudiante`) VALUES
(1, 10, 1, '', 1, 1),
(3, 5, 1, '', 3, 3),
(5, 3, 0, '', 1, 8),
(6, 10, 0, '', 1, 4),
(7, 9, 0, '', 3, 6),
(8, 9, 0, '', 2, 7),
(9, 8, 0, '', 2, 8),
(10, 5, 0, '', 2, 4),
(11, 12, 0, '', 4, 7),
(12, 4, 0, '', 4, 8),
(13, 7, 0, '', 1, 7),
(14, 2, 0, '', 7, 3),
(15, 9, 0, '', 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `idEstatu` int(11) NOT NULL,
  `estatus` varchar(250) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `idEstudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `idEstudiante` int(11) NOT NULL,
  `nombreEstudiante` varchar(50) NOT NULL,
  `apellidoEstudiante` varchar(50) NOT NULL,
  `identidad` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `genero` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `idEncargado` int(11) NOT NULL,
  `parentescoConEncargado` varchar(30) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`idEstudiante`, `nombreEstudiante`, `apellidoEstudiante`, `identidad`, `correo`, `fechaNacimiento`, `genero`, `direccion`, `idEncargado`, `parentescoConEncargado`, `telefono`) VALUES
(1, 'Luis Santiago', 'Cruz Rodriguez', '1501199800102', 'luissantiagocls@gmail.com', '1998-01-02', 'Masculino', 'Punuare, Olancho', 3, 'Padre', ''),
(2, 'Nolvia Aracely', 'Carcamo Rosales', '7788', '', '1995-12-14', 'Femenino', 'barrio la trinidad', 5, 'Madre', ''),
(3, 'Luis Felipe', 'Funez Palma', '1503198302055', '', '1983-12-20', 'Masculino', 'catacamas', 2, 'Tio', ''),
(4, 'Carlos', 'Matute', '1503199500919', 'carlos@gmail.com', '1995-06-04', 'Masculino', 'El Llano', 2, 'Tio', '98925372'),
(5, 'Yessica Griselda ', 'Gomez Ramirez', '1503199401754', 'yessica@gmail.com', '1994-10-18', 'Femenino', 'las uvas', 2, 'primo', '95465678'),
(6, 'Sury Gabriela', 'Acosta Mena', '150319950789', 'sury@gmail.com', '1995-12-27', 'Femenino', 'barrio ojo de agua', 2, 'tio', '98787654'),
(7, 'Maryuri Adriana', 'Zavala Mesa', '88559966', '', '1998-12-24', 'Femenino', 'Barrio el chafa', 2, 'Tio', ''),
(8, 'Daniel Joseph', 'Cruz Rodriguez', '1501199900023', '', '1999-11-18', 'Masculino', 'punuare', 2, 'nada', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inasistencias`
--

CREATE TABLE `inasistencias` (
  `idInasistencia` int(11) NOT NULL,
  `idEstudiante` int(11) NOT NULL,
  `idClase` int(11) NOT NULL,
  `cantidadInasistencia` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacioncolegio`
--

CREATE TABLE `informacioncolegio` (
  `idColegio` int(11) NOT NULL,
  `nombreColegio` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `codigoCentro` varchar(50) NOT NULL,
  `departCentro` varchar(50) NOT NULL,
  `muniCentro` varchar(50) NOT NULL,
  `prefijoCentro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `idMatricula` int(11) NOT NULL,
  `idEstudiante` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`idMatricula`, `idEstudiante`, `idCurso`) VALUES
(1, 1, 8),
(2, 2, 9),
(3, 3, 11),
(4, 4, 8),
(5, 5, 12),
(6, 6, 11),
(7, 7, 8),
(8, 8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidades`
--

CREATE TABLE `modalidades` (
  `idModalidad` int(11) NOT NULL,
  `nombreModalidad` varchar(50) NOT NULL,
  `jornada` text NOT NULL,
  `parciales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modalidades`
--

INSERT INTO `modalidades` (`idModalidad`, `nombreModalidad`, `jornada`, `parciales`) VALUES
(1, 'Bachillerato en Ciencias y Letras', 'Matutina', 0),
(2, 'Tercero Ciclo Comun', 'Vespertina', 0),
(3, 'Bachillerato Tecnico en Computacion', 'Matutina', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelacceso`
--

CREATE TABLE `nivelacceso` (
  `idNivelAcceso` int(11) NOT NULL,
  `nombreNivel` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nivelacceso`
--

INSERT INTO `nivelacceso` (`idNivelAcceso`, `nombreNivel`, `descripcion`) VALUES
(1, 'nivel 1', 'Acceso unicamente a clases asignadas'),
(2, 'nivel 2', 'Acceso a totales de notas y generar reportes'),
(3, 'nivel 3', 'Acceso total al sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcialactual`
--

CREATE TABLE `parcialactual` (
  `idParcialActual` int(11) NOT NULL,
  `idParcialPorModalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parcialactual`
--

INSERT INTO `parcialactual` (`idParcialActual`, `idParcialPorModalidad`) VALUES
(1, 1),
(2, 3),
(3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcialespormodalidad`
--

CREATE TABLE `parcialespormodalidad` (
  `idParcialPorModalidad` int(11) NOT NULL,
  `nombreParcialPorModalidad` varchar(60) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `idModalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parcialespormodalidad`
--

INSERT INTO `parcialespormodalidad` (`idParcialPorModalidad`, `nombreParcialPorModalidad`, `desde`, `hasta`, `idModalidad`) VALUES
(1, 'Primer Parcial', '0000-01-00', '0000-06-00', 1),
(2, 'Segundo Parcial', '0000-06-00', '0000-11-00', 1),
(3, 'Primer Parcial', '0000-01-00', '0000-03-00', 2),
(4, 'Segundo Parcial', '0000-03-00', '0000-06-00', 2),
(5, 'Tercer Parcial', '0000-06-00', '0000-09-00', 2),
(6, 'Cuarto Parcial', '0000-09-00', '0000-11-00', 2),
(7, 'Primer Parcial', '0000-01-00', '0000-06-00', 3),
(8, 'Segundo Parcial', '0000-07-00', '0000-11-00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sq`
--

CREATE TABLE `sq` (
  `idSq` int(11) NOT NULL,
  `pregunta1` varchar(50) NOT NULL,
  `respuesta1` varchar(50) NOT NULL,
  `pregunta2` varchar(50) NOT NULL,
  `respuesta2` varchar(50) NOT NULL,
  `pregunta3` varchar(50) NOT NULL,
  `respuesta3` varchar(50) NOT NULL,
  `idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sq`
--

INSERT INTO `sq` (`idSq`, `pregunta1`, `respuesta1`, `pregunta2`, `respuesta2`, `pregunta3`, `respuesta3`, `idEmpleado`) VALUES
(1, 'Lugar de nacimiento', 'Catacamas', 'Primera Escuela', 'Evangelica', 'Mes de nacimiento', 'Junio', 1),
(3, 'uno', '1', 'dos', '2', 'tres', '3', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idTarea` int(11) NOT NULL,
  `nombreTarea` varchar(50) NOT NULL,
  `valorTarea` int(11) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `idClase` int(11) NOT NULL,
  `idParcialPorModalidad` int(11) NOT NULL,
  `tipoTarea` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTarea`, `nombreTarea`, `valorTarea`, `fechaEntrega`, `idClase`, `idParcialPorModalidad`, `tipoTarea`) VALUES
(1, 'Productos Notables', 10, '2018-12-06', 3, 3, 'Tarea Clase'),
(2, 'Conjugar Verbo to be', 10, '2018-12-13', 8, 3, ''),
(3, 'Numeros de 1 al 10,000', 10, '2018-12-14', 14, 3, ''),
(4, 'Ejercicios  Trinomio Cuadrado Perfecto', 15, '2018-12-17', 3, 3, ''),
(5, 'Teorema de Pitagoras', 20, '2018-12-20', 3, 3, ''),
(6, 'Expocision 1', 30, '2018-12-13', 13, 1, ''),
(7, 'Guia de Estudio', 10, '2018-12-14', 15, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `idNivelAcceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idEmpleado`, `nombreUsuario`, `contrasena`, `idNivelAcceso`) VALUES
(1, 1, 'karlallacro', 'e961b2ac40aac4cc36a8bf65bca9177e', 3),
(2, 2, 'santi', '68053af2923e00204c3ca7c6a3150cf7', 1),
(3, 4, 'luz', '68053af2923e00204c3ca7c6a3150cf7', 1),
(4, 3, 'besita', '250cf8b51c773f3f8dc8b4be867a9a02', 1),
(5, 5, 'elenita', '68053af2923e00204c3ca7c6a3150cf7', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aniolectivo`
--
ALTER TABLE `aniolectivo`
  ADD PRIMARY KEY (`idAnioLectivo`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`idAsignatura`),
  ADD KEY `idModalidad` (`idModalidad`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`idClase`),
  ADD KEY `idasignatura` (`idAsignatura`),
  ADD KEY `idempleado` (`idEmpleado`),
  ADD KEY `idcurso` (`idCurso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `idModalidad` (`idModalidad`),
  ADD KEY `idAnioLectivo` (`idAnioLectivo`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `idcargo` (`idCargo`);

--
-- Indices de la tabla `encargados`
--
ALTER TABLE `encargados`
  ADD PRIMARY KEY (`idEncargado`),
  ADD UNIQUE KEY `identidad` (`identidad`);

--
-- Indices de la tabla `estadotareas`
--
ALTER TABLE `estadotareas`
  ADD PRIMARY KEY (`idEstadoTarea`),
  ADD KEY `idEstudiante` (`idEstudiante`),
  ADD KEY `idTarea` (`idTarea`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idEstatu`),
  ADD KEY `idestudiante` (`idEstudiante`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`idEstudiante`),
  ADD KEY `idencargado` (`idEncargado`);

--
-- Indices de la tabla `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD PRIMARY KEY (`idInasistencia`),
  ADD KEY `idestudiante` (`idEstudiante`),
  ADD KEY `idclase` (`idClase`);

--
-- Indices de la tabla `informacioncolegio`
--
ALTER TABLE `informacioncolegio`
  ADD PRIMARY KEY (`idColegio`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idMatricula`),
  ADD KEY `idEstudiante` (`idEstudiante`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`idModalidad`);

--
-- Indices de la tabla `nivelacceso`
--
ALTER TABLE `nivelacceso`
  ADD PRIMARY KEY (`idNivelAcceso`);

--
-- Indices de la tabla `parcialactual`
--
ALTER TABLE `parcialactual`
  ADD PRIMARY KEY (`idParcialActual`),
  ADD KEY `idParcialPorModalidad` (`idParcialPorModalidad`);

--
-- Indices de la tabla `parcialespormodalidad`
--
ALTER TABLE `parcialespormodalidad`
  ADD PRIMARY KEY (`idParcialPorModalidad`),
  ADD KEY `parcialespormodalidad_ibfk_1` (`idModalidad`);

--
-- Indices de la tabla `sq`
--
ALTER TABLE `sq`
  ADD PRIMARY KEY (`idSq`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idTarea`),
  ADD KEY `idClase` (`idClase`),
  ADD KEY `idParcial` (`idParcialPorModalidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idempleado` (`idEmpleado`),
  ADD KEY `idnivel_usuario` (`idNivelAcceso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aniolectivo`
--
ALTER TABLE `aniolectivo`
  MODIFY `idAnioLectivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `idAsignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `idEncargado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estadotareas`
--
ALTER TABLE `estadotareas`
  MODIFY `idEstadoTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idEstatu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `idEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inasistencias`
--
ALTER TABLE `inasistencias`
  MODIFY `idInasistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informacioncolegio`
--
ALTER TABLE `informacioncolegio`
  MODIFY `idColegio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `idModalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nivelacceso`
--
ALTER TABLE `nivelacceso`
  MODIFY `idNivelAcceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parcialactual`
--
ALTER TABLE `parcialactual`
  MODIFY `idParcialActual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parcialespormodalidad`
--
ALTER TABLE `parcialespormodalidad`
  MODIFY `idParcialPorModalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sq`
--
ALTER TABLE `sq`
  MODIFY `idSq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`idModalidad`) REFERENCES `modalidades` (`idModalidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clases_ibfk_2` FOREIGN KEY (`idAsignatura`) REFERENCES `asignaturas` (`idAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clases_ibfk_3` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clases_ibfk_4` FOREIGN KEY (`idAsignatura`) REFERENCES `asignaturas` (`idAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clases_ibfk_5` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clases_ibfk_7` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`idModalidad`) REFERENCES `modalidades` (`idModalidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`idAnioLectivo`) REFERENCES `aniolectivo` (`idAnioLectivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idCargo`) REFERENCES `cargos` (`idCargo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`idCargo`) REFERENCES `cargos` (`idCargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estadotareas`
--
ALTER TABLE `estadotareas`
  ADD CONSTRAINT `estadotareas_ibfk_1` FOREIGN KEY (`idTarea`) REFERENCES `tareas` (`idTarea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estadotareas_ibfk_2` FOREIGN KEY (`idEstudiante`) REFERENCES `estudiantes` (`idEstudiante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD CONSTRAINT `estatus_ibfk_1` FOREIGN KEY (`idEstudiante`) REFERENCES `estudiantes` (`idEstudiante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`idEncargado`) REFERENCES `encargados` (`idEncargado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD CONSTRAINT `inasistencias_ibfk_1` FOREIGN KEY (`idEstudiante`) REFERENCES `estudiantes` (`idEstudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inasistencias_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clases` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`idEstudiante`) REFERENCES `estudiantes` (`idEstudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parcialactual`
--
ALTER TABLE `parcialactual`
  ADD CONSTRAINT `parcialactual_ibfk_1` FOREIGN KEY (`idParcialPorModalidad`) REFERENCES `parcialespormodalidad` (`idParcialPorModalidad`);

--
-- Filtros para la tabla `parcialespormodalidad`
--
ALTER TABLE `parcialespormodalidad`
  ADD CONSTRAINT `parcialespormodalidad_ibfk_1` FOREIGN KEY (`idModalidad`) REFERENCES `modalidades` (`idModalidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clases` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`idParcialPorModalidad`) REFERENCES `parcialespormodalidad` (`idParcialPorModalidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idNivelAcceso`) REFERENCES `nivelacceso` (`idNivelAcceso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
