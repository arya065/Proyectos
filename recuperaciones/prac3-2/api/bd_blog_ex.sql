-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 22 2024 г., 12:50
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd_blog_ex`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `valor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `valor`) VALUES
(1, 'categoria1');

-- --------------------------------------------------------

--
-- Структура таблицы `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idNoticia` int(11) NOT NULL,
  `estado` enum('sin validar','apto') NOT NULL,
  `fCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `comentario`, `idUsuario`, `idNoticia`, `estado`, `fCreacion`) VALUES
(1, 'com1', 1, 1, 'sin validar', '2024-05-14 06:45:31'),
(2, 'com2', 1, 1, 'apto', '2024-05-14 06:45:31'),
(3, 'com3', 2, 1, 'sin validar', '2024-05-14 06:45:43');

-- --------------------------------------------------------

--
-- Структура таблицы `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `copete` varchar(255) NOT NULL,
  `cuerpo` text NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `fPublicacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fCreacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fModificacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `copete`, `cuerpo`, `idUsuario`, `idCategoria`, `fPublicacion`, `fCreacion`, `fModificacion`) VALUES
(1, 'noticia1', 'noticia1', 'noticia1', 3, 1, '2024-05-14 06:44:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tipo` enum('comun','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `clave`, `email`, `tipo`) VALUES
(1, '1', '1', '1', 'admin'),
(2, '2', '2', '2', 'admin'),
(3, '3', '3', '3', 'comun');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Индексы таблицы `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);

--
-- Индексы таблицы `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`);

--
-- Индексы таблицы `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
