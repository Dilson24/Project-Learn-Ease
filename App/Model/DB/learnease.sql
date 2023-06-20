-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2023 a las 05:37:44
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `learnease`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Role_ID` int(255) NOT NULL,
  `Role_Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Role_ID`, `Role_Name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_type`
--

CREATE TABLE `student_type` (
  `Student_Type_ID` int(255) NOT NULL,
  `Student_Type_Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student_type`
--

INSERT INTO `student_type` (`Student_Type_ID`, `Student_Type_Name`) VALUES
(1, 'University Student'),
(2, 'High School Student'),
(3, 'Technical or Technological Student'),
(4, 'Undefined');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `User_ID` int(200) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Last_Name` varchar(200) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Phone_Number` varchar(200) NOT NULL,
  `Student_Type_ID` int(200) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Profile_Image` text NOT NULL,
  `Role_ID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`User_ID`, `Name`, `Last_Name`, `Date_of_Birth`, `Phone_Number`, `Student_Type_ID`, `Country`, `City`, `Email`, `Password`, `Profile_Image`, `Role_ID`) VALUES
(1, 'Alex', 'Cruz', '1997-09-24', '3115002062', 4, 'co', 'Bogota  D.C.', 'alx0924@gmail.com', '$2y$10$3ZGT4j6ItT8Q2mQWdH5o4O3BucKmEk3u.DtdA.mJJGboy05iUelzy', 'Public/Assets/Img/User-Profile.png', 1),
(2, 'Juan', 'Pérez', '1990-01-10', '555-1234', 1, 'ar', 'Departamento de Lago Argentino', 'juan.perez@gmail.com', '$2y$10$MGmWg/gjCAz0V36d.Z.pKuT7szQBqDPiNvDZCXoLdbRtdkpQQie0C', 'Public/Assets/Img/User-Profile.png', 2),
(3, 'María', 'Rodríguez', '1985-03-05', '555-5678', 2, 'cl', 'Provincia de Magallanes', 'maria.rodriguez@hotmail.com', '$2y$10$ttClLx8RMqXHE0NTqnYAkOGsqLJ5ARh7q8sMpn/pD2X4t5sjYzO1u', 'Public/Assets/Img/User-Profile.png', 2),
(4, 'Andres', 'Lopez', '1992-04-20', '555-9876', 2, 'al', 'Bashkia Has', 'andres.lopez@outlook.com', '$2y$10$dwVjw04Yvd9S5wzzJIyz.OotDv/FaqaabkESby56th0gU.FQY.h0q', 'Public/Assets/Img/User-Profile.png', 2),
(5, 'Laura', 'Garcia', '1988-07-15', ' 555-4321', 2, 'de', 'Regierungsbezirk Detmold', 'laura.garcia@gmail.com', '$2y$10$unK5YUW4XtID2YJHhAXndOXaXpJVWFWsFOTZaRJ4tve0ntDL6uAB6', 'Public/Assets/Img/User-Profile.png', 2),
(6, 'Carlos', 'Martinez', '1995-09-25', '555-8765', 2, 'ar', 'Departamento de Pehuenches', 'carlos.martinez@hotmail.com', '$2y$10$eYqHK1NwycY0jZXVmnEXduclgcBo2uzwnTh9rGHr9/CCYX7tIidbC', 'Public/Assets/Img/User-Profile.png', 2),
(7, 'Ana', 'Sanchez', '1993-05-12', '555-2345', 1, 'br', 'Bagre', 'ana.sanchez@gmail.com', '$2y$10$IXN8vwck7hOWZZhzc.uVH.DsAdaKJiFF5FTfrU/LFqUHbhqFzQqki', 'Public/Assets/Img/User-Profile.png', 2),
(8, 'Pedro', ' ramirez', '1991-02-08', '555-7654', 2, 'ec', 'Canton Ventanas', 'pedro.ramirez@outlook.com', '$2y$10$4ajWkoLhmuyelCnk0UdsZOtJzdg7WV0MLEyzD2f6jIcsMyKxhJ.Dq', 'Public/Assets/Img/User-Profile.png', 2),
(9, ' gabriela', ' torres', '1987-12-30', '555-3456', 1, 'gt', 'Municipio de Santa Catarina Mita', 'gabriela.torres@gmail.com', '$2y$10$ObJlU6VSWUGdkYniHDUfDuwoXZBLNuCWSTKfiz0OPY2XuSoeDXk2q', 'Public/Assets/Img/User-Profile.png', 2),
(10, 'Alejandro', ' gomez', '1994-03-17', '555-6543', 2, 've', 'Municipio Libertador', 'alejandro.gomez@hotmail.com', '$2y$10$78jQOkJaZ3izhsp1lygR9OWzTP6EQrZB0GMIg39W/C3rK7UnyiBB.', 'Public/Assets/Img/User-Profile.png', 2),
(11, 'Valeria', 'Navarro', '1998-08-22', '555-8765', 2, 'hn', 'San Juan Guarita', 'valeria.navarro@gmail.com', '$2y$10$aeQuV4br.kijnHmLQxYxReKvXnSXoP26voNNdvBS.7uWTS6GkNVC.', 'Public/Assets/Img/User-Profile.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_connections`
--

CREATE TABLE `user_connections` (
  `Connection_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `Last_Login` datetime NOT NULL,
  `Last_Activity` datetime NOT NULL,
  `Last_Count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_connections`
--

INSERT INTO `user_connections` (`Connection_ID`, `User_ID`, `Last_Login`, `Last_Activity`, `Last_Count`) VALUES
(1, 2, '2023-06-19 22:19:09', '2023-06-19 22:19:09', 1),
(2, 1, '2023-06-19 22:19:31', '2023-06-19 22:19:31', 1),
(3, 2, '2023-06-19 22:20:50', '2023-06-19 22:20:50', 2),
(4, 3, '2023-06-19 22:24:58', '2023-06-19 22:24:58', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Role_ID`);

--
-- Indices de la tabla `student_type`
--
ALTER TABLE `student_type`
  ADD PRIMARY KEY (`Student_Type_ID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Student_Type_ID` (`Student_Type_ID`),
  ADD KEY `Role_ID` (`Role_ID`);

--
-- Indices de la tabla `user_connections`
--
ALTER TABLE `user_connections`
  ADD PRIMARY KEY (`Connection_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Role_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `student_type`
--
ALTER TABLE `student_type`
  MODIFY `Student_Type_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user_connections`
--
ALTER TABLE `user_connections`
  MODIFY `Connection_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Student_Type_ID`) REFERENCES `student_type` (`Student_Type_ID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`Role_ID`) REFERENCES `roles` (`Role_ID`);

--
-- Filtros para la tabla `user_connections`
--
ALTER TABLE `user_connections`
  ADD CONSTRAINT `user_connections_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
