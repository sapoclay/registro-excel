-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-03-2024 a las 23:59:11
-- Versión del servidor: 8.0.36-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario-excel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_product`
--

CREATE TABLE `tbl_product` (
  `tbl_product_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction` enum('Venta','Compra') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `people` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nif_cif` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_product`
--

INSERT INTO `tbl_product` (`tbl_product_id`, `product_name`, `product_code`, `quantity`, `price`, `date`, `transaction`, `people`, `nif_cif`, `notes`) VALUES
(1, 'Zapatos', '1A', 1123, '65.30', '2024-03-05 22:23:34', 'Compra', 'Josete C.', '14897AA', 'Ejemplo'),
(5, 'Coderas', 'DNNa1', 125, '100.00', '2024-03-05 21:51:31', 'Compra', 'pepe', '456789d', 'Con chorreras'),
(6, 'Salami', 'C19', 10000, '125.50', '2024-03-05 22:26:36', 'Venta', 'chonchi', '1478523D', ''),
(8, 'ADF', 'FDF', 3444, '34.00', '2024-03-05 22:26:16', 'Compra', 'Josete', '432484k', ''),
(9, 'Chorreras', 'Cho9449', 322, '232.00', '2024-03-03 22:27:34', 'Compra', 'Frenando', '879546d', NULL),
(10, 'pelotillas', 'pelo9349', 23, '1125.25', '2024-03-05 22:27:43', 'Venta', 'Sulfuroso', '23434S', ''),
(11, 'Medias de presión', 'Cii0', 12, '12.87', '2024-03-04 08:29:22', 'Compra', 'Remigio', 'A223234', NULL),
(12, 'Tazas', 'TaZ99', 99, '1.99', '2024-03-05 22:44:26', 'Venta', 'Remigio', 'A223234', 'De parís'),
(13, 'Calcetines', 'C19', 34, '125.00', '2024-03-04 22:41:06', 'Venta', 'wer', '14897a', 'sololis'),
(19, 'Cerillas', 'Ceri4309', 3434, '0.90', '2024-03-05 22:00:01', 'Compra', 'Coque', '434345k', 'De cabeza roja'),
(20, 'Cables', 'C19', 236, '23.45', '2024-03-05 22:04:50', 'Venta', 'Josete', '8839202B', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`tbl_product_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `tbl_product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
