-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2022 a las 02:24:45
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Laptop', '2022-02-10 00:28:15'),
(2, 'Audífonos', '2022-02-10 00:28:55'),
(3, 'Mouse', '2022-02-10 00:29:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) DEFAULT NULL,
  `ultima_compra` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(1, 'Javier', 65813548, 'javier@gmail.com', '+051 985 654-155', 'jr. javier prado', '1992-09-21', 2, '2022-02-09 20:18:48', '2022-02-10 01:18:48'),
(2, 'Santiago', 36918524, 'santiago@gmail.com', '985-654-257', 'calle libertad', '1993-12-28', 2, '2022-02-09 20:20:19', '2022-02-10 01:20:19'),
(3, 'Hugo', 32516843, 'hugo@gmail.com', '989-615-478', 'calle las palmeras', '1990-05-13', 4, '2022-02-09 20:21:33', '2022-02-10 01:21:33'),
(4, 'Mario', 65823489, 'mario@gmail.com', '987-365-149', 'avenida libertad', '1989-01-17', 8, '2022-02-09 20:22:59', '2022-02-10 01:22:59'),
(5, 'Liz', 32654861, 'liz@gmail.com', '988-759-153', 'avenida girasoles', '1992-01-21', 1, '2022-02-09 20:10:28', '2022-02-10 01:10:28'),
(6, 'Julia', 35184521, 'julia@gmail.com', '987-512-483', 'jr. lurin', '1997-05-07', 1, '2022-02-09 20:11:19', '2022-02-10 01:11:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, '7320254486150', 'Laptop HP Pavilion Gaming 15', 'public/img/products/7320254486150/910.png', 23, 3100, 3410, 2, '2022-02-10 01:20:18'),
(2, 1, '3808406985284', 'Laptop Asus TUF F15 FX506', 'public/img/products/3808406985284/820.jpg', 28, 4200, 4620, 2, '2022-02-10 01:18:48'),
(3, 2, '3663877761272', 'Audifonos Halion HA Z60', 'public/img/products/3663877761272/843.jpg', 27, 120, 132, 2, '2022-02-10 01:22:59'),
(4, 2, '6226523541319', 'Audifonos Landbyte LB 215', 'public/img/products/6226523541319/573.jpg', 29, 70, 77, 2, '2022-02-10 01:22:59'),
(5, 3, '8741882508012', 'Logitech Mouse G203', 'public/img/products/8741882508012/662.jpg', 20, 130, 143, 5, '2022-02-10 01:22:59'),
(6, 3, '8578127897737', 'Logitech Mouse G305 Wireless Blue', 'public/img/products/8578127897737/472.jpg', 22, 180, 198, 5, '2022-02-10 01:22:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'public/img/users/admin/231.jpg', 1, '2022-02-09 20:23:07', '2022-02-10 01:23:07'),
(2, 'Miguel', 'UserMiguel', '$2a$07$asxx54ahjppf45sd87a5au20YMKSYeeMNmCbyrKCcCOM5Rsf9q2OG', 'Vendedor', 'public/img/users/UserMiguel/679.png', 1, '2022-02-09 20:22:27', '2022-02-10 01:22:27'),
(3, 'Luis', 'UserLuis', '$2a$07$asxx54ahjppf45sd87a5au9UOJrsvYpe7sFZuD0pDYe0bhYmxOc8m', 'Vendedor', 'public/img/users/UserLuis/968.png', 1, '2022-02-09 20:09:50', '2022-02-10 01:09:50'),
(4, 'Jorge', 'UserJorge', '$2a$07$asxx54ahjppf45sd87a5auu7yibzPlKulhkeUOoM/huw/wvSliNW2', 'Especial', 'public/img/users/UserJorge/236.jpg', 1, NULL, '2022-02-10 01:06:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
(1, 10001, 1, 1, '[{\"id\":\"3\",\"descripcion\":\"Audifonos Halion HA Z60\",\"cantidad\":\"1\",\"stock\":\"28\",\"precio\":\"132\",\"total\":\"132\"}]', 23.76, 132, 155.76, 'Efectivo', '2021-10-10 01:14:45'),
(2, 10002, 2, 1, '[{\"id\":\"5\",\"descripcion\":\"Logitech Mouse G203\",\"cantidad\":\"1\",\"stock\":\"24\",\"precio\":\"143\",\"total\":\"143\"}]', 25.74, 143, 168.74, 'Efectivo', '2021-10-20 01:14:35'),
(3, 10003, 3, 2, '[{\"id\":\"6\",\"descripcion\":\"Logitech Mouse G305 Wireless Blue\",\"cantidad\":\"1\",\"stock\":\"26\",\"precio\":\"198\",\"total\":\"198\"}]', 35.64, 198, 233.64, 'Efectivo', '2021-11-10 01:14:51'),
(4, 10004, 4, 2, '[{\"id\":\"5\",\"descripcion\":\"Logitech Mouse G203\",\"cantidad\":\"1\",\"stock\":\"23\",\"precio\":\"143\",\"total\":\"143\"}]', 25.74, 143, 168.74, 'Efectivo', '2021-11-20 01:14:56'),
(5, 10005, 5, 3, '[{\"id\":\"1\",\"descripcion\":\"Laptop HP Pavilion Gaming 15\",\"cantidad\":\"1\",\"stock\":\"24\",\"precio\":\"3410\",\"total\":\"3410\"}]', 613.8, 3410, 4023.8, 'Efectivo', '2021-12-10 01:14:58'),
(6, 10006, 6, 3, '[{\"id\":\"2\",\"descripcion\":\"Laptop Asus TUF F15 FX506\",\"cantidad\":\"1\",\"stock\":\"29\",\"precio\":\"4620\",\"total\":\"4620\"}]', 831.6, 4620, 5451.6, 'Efectivo', '2021-12-20 01:15:01'),
(7, 10007, 1, 1, '[{\"id\":\"2\",\"descripcion\":\"Laptop Asus TUF F15 FX506\",\"cantidad\":\"1\",\"stock\":\"28\",\"precio\":\"4620\",\"total\":\"4620\"}]', 831.6, 4620, 5451.6, 'Efectivo', '2022-02-10 01:24:12'),
(8, 10008, 2, 1, '[{\"id\":\"1\",\"descripcion\":\"Laptop HP Pavilion Gaming 15\",\"cantidad\":\"1\",\"stock\":\"23\",\"precio\":\"3410\",\"total\":\"3410\"}]', 613.8, 3410, 4023.8, 'Efectivo', '2022-02-10 01:24:15'),
(9, 10009, 3, 2, '[{\"id\":\"4\",\"descripcion\":\"Audifonos Landbyte LB 215\",\"cantidad\":\"1\",\"stock\":\"30\",\"precio\":\"77\",\"total\":\"77\"},{\"id\":\"5\",\"descripcion\":\"Logitech Mouse G203\",\"cantidad\":\"2\",\"stock\":\"21\",\"precio\":\"143\",\"total\":\"286\"}]', 65.34, 363, 428.34, 'Efectivo', '2022-02-10 01:24:24'),
(10, 10010, 4, 2, '[{\"id\":\"6\",\"descripcion\":\"Logitech Mouse G305 Wireless Blue\",\"cantidad\":\"4\",\"stock\":\"22\",\"precio\":\"198\",\"total\":\"792\"},{\"id\":\"5\",\"descripcion\":\"Logitech Mouse G203\",\"cantidad\":\"1\",\"stock\":\"20\",\"precio\":\"143\",\"total\":\"143\"},{\"id\":\"4\",\"descripcion\":\"Audifonos Landbyte LB 215\",\"cantidad\":\"1\",\"stock\":\"29\",\"precio\":\"77\",\"total\":\"77\"},{\"id\":\"3\",\"descripcion\":\"Audifonos Halion HA Z60\",\"cantidad\":\"1\",\"stock\":\"27\",\"precio\":\"132\",\"total\":\"132\"}]', 205.92, 1144, 1349.92, 'Efectivo', '2022-02-10 01:24:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
