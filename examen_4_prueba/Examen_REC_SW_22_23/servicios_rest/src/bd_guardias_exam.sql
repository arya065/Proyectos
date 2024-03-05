-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2021 a las 19:35:41
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_guardias_exam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_guardias`
--

CREATE TABLE `horario_guardias` (
  `id_hor_gua` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `dia` int(1) NOT NULL,
  `hora` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `horario_guardias`
--

INSERT INTO `horario_guardias` (`id_hor_gua`, `usuario`, `dia`, `hora`) VALUES
(226, 17, 1, 1),
(227, 45, 1, 1),
(228, 49, 1, 1),
(229, 61, 1, 1),
(230, 66, 1, 1),
(231, 83, 1, 1),
(232, 86, 1, 1),
(233, 11, 1, 2),
(234, 14, 1, 2),
(235, 31, 1, 2),
(236, 45, 1, 2),
(237, 71, 1, 2),
(238, 79, 1, 2),
(239, 90, 1, 2),
(240, 101, 1, 2),
(241, 10, 1, 3),
(242, 16, 1, 3),
(243, 17, 1, 3),
(244, 20, 1, 3),
(245, 35, 1, 3),
(246, 73, 1, 3),
(247, 102, 1, 3),
(248, 10, 1, 4),
(249, 53, 1, 4),
(250, 64, 1, 4),
(251, 75, 1, 4),
(252, 86, 1, 4),
(253, 89, 1, 4),
(254, 96, 1, 4),
(255, 104, 1, 4),
(256, 22, 1, 5),
(257, 49, 1, 5),
(258, 67, 1, 5),
(259, 72, 1, 5),
(260, 71, 1, 5),
(261, 79, 1, 5),
(262, 113, 1, 5),
(263, 35, 1, 6),
(264, 47, 1, 6),
(265, 50, 1, 6),
(266, 55, 1, 6),
(267, 62, 1, 6),
(268, 71, 1, 6),
(269, 108, 1, 6),
(270, 41, 2, 1),
(271, 70, 2, 1),
(272, 71, 2, 1),
(273, 102, 2, 1),
(274, 107, 2, 1),
(275, 108, 2, 1),
(276, 113, 2, 1),
(277, 27, 2, 2),
(278, 53, 2, 2),
(279, 47, 2, 2),
(280, 65, 2, 2),
(281, 89, 2, 2),
(282, 92, 2, 2),
(283, 96, 2, 2),
(284, 101, 2, 2),
(285, 55, 2, 3),
(286, 64, 2, 3),
(287, 75, 2, 3),
(288, 83, 2, 3),
(289, 82, 2, 3),
(290, 86, 2, 3),
(291, 90, 2, 3),
(292, 46, 2, 4),
(293, 48, 2, 4),
(294, 61, 2, 4),
(295, 62, 2, 4),
(296, 73, 2, 4),
(297, 75, 2, 4),
(298, 96, 2, 4),
(299, 100, 2, 4),
(300, 22, 2, 5),
(301, 46, 2, 5),
(302, 60, 2, 5),
(303, 73, 2, 5),
(304, 95, 2, 5),
(305, 101, 2, 5),
(306, 104, 2, 5),
(307, 6, 2, 6),
(308, 20, 2, 6),
(309, 47, 2, 6),
(310, 62, 2, 6),
(311, 71, 2, 6),
(312, 81, 2, 6),
(313, 104, 2, 6),
(314, 46, 3, 1),
(315, 60, 3, 1),
(316, 66, 3, 1),
(317, 72, 3, 1),
(318, 78, 3, 1),
(319, 82, 3, 1),
(320, 114, 3, 1),
(321, 51, 3, 2),
(322, 77, 3, 2),
(323, 82, 3, 2),
(324, 92, 3, 2),
(325, 90, 3, 2),
(326, 101, 3, 2),
(327, 105, 3, 2),
(328, 35, 3, 3),
(329, 51, 3, 3),
(330, 66, 3, 3),
(331, 74, 3, 3),
(332, 93, 3, 3),
(333, 97, 3, 3),
(334, 105, 3, 3),
(335, 11, 3, 4),
(336, 10, 3, 4),
(337, 16, 3, 4),
(338, 41, 3, 4),
(339, 55, 3, 4),
(340, 70, 3, 4),
(341, 94, 3, 4),
(342, 16, 3, 5),
(343, 20, 3, 5),
(344, 22, 3, 5),
(345, 65, 3, 5),
(346, 77, 3, 5),
(347, 97, 3, 5),
(348, 100, 3, 5),
(349, 6, 3, 6),
(350, 9, 3, 6),
(351, 16, 3, 6),
(352, 60, 3, 6),
(353, 67, 3, 6),
(354, 82, 3, 6),
(355, 108, 3, 6),
(356, 12, 4, 1),
(357, 17, 4, 1),
(358, 52, 4, 1),
(359, 62, 4, 1),
(360, 68, 4, 1),
(361, 102, 4, 1),
(362, 24, 4, 1),
(363, 2, 4, 2),
(364, 29, 4, 2),
(365, 41, 4, 2),
(366, 46, 4, 2),
(367, 57, 4, 2),
(368, 61, 4, 2),
(369, 100, 4, 2),
(370, 20, 4, 3),
(371, 28, 4, 3),
(372, 45, 4, 3),
(373, 50, 4, 3),
(374, 55, 4, 3),
(375, 86, 4, 3),
(376, 21, 4, 3),
(377, 16, 4, 4),
(378, 28, 4, 4),
(379, 75, 4, 4),
(380, 74, 4, 4),
(381, 86, 4, 4),
(382, 95, 4, 4),
(383, 101, 4, 4),
(384, 6, 4, 5),
(385, 12, 4, 5),
(386, 20, 4, 5),
(387, 22, 4, 5),
(388, 27, 4, 5),
(389, 65, 4, 5),
(390, 95, 4, 5),
(391, 8, 4, 6),
(392, 35, 4, 6),
(393, 45, 4, 6),
(394, 104, 4, 6),
(395, 106, 4, 6),
(396, 108, 4, 6),
(397, 8, 5, 1),
(398, 22, 5, 1),
(399, 41, 5, 1),
(400, 40, 5, 1),
(401, 52, 5, 1),
(402, 62, 5, 1),
(403, 114, 5, 1),
(404, 10, 5, 2),
(405, 14, 5, 2),
(406, 34, 5, 2),
(407, 61, 5, 2),
(408, 64, 5, 2),
(409, 78, 5, 2),
(410, 83, 5, 2),
(411, 8, 5, 3),
(412, 29, 5, 3),
(413, 34, 5, 3),
(414, 35, 5, 3),
(415, 40, 5, 3),
(416, 65, 5, 3),
(417, 81, 5, 3),
(418, 100, 5, 3),
(419, 11, 5, 4),
(420, 12, 5, 4),
(421, 45, 5, 4),
(422, 61, 5, 4),
(423, 70, 5, 4),
(424, 104, 5, 4),
(425, 105, 5, 4),
(426, 107, 5, 4),
(427, 9, 5, 5),
(428, 31, 5, 5),
(429, 48, 5, 5),
(430, 68, 5, 5),
(431, 93, 5, 5),
(432, 100, 5, 5),
(433, 25, 5, 5),
(434, 9, 5, 6),
(435, 41, 5, 6),
(436, 40, 5, 6),
(437, 66, 5, 6),
(438, 70, 5, 6),
(439, 75, 5, 6),
(440, 107, 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `clave`, `email`) VALUES
(1, 'Apellido1 Apellido2, NOMBRE1', 'profesor1', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(2, 'Apellido1 Apellido2, NOMBRE2', 'profesor2', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(3, 'Apellido1 Apellido2, NOMBRE3', 'profesor3', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(4, 'Apellido1 Apellido2, NOMBRE4', 'profesor4', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(5, 'Apellido1 Apellido2, NOMBRE5', 'profesor5', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(6, 'Apellido1 Apellido2, NOMBRE6', 'profesor6', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(7, 'Apellido1 Apellido2, NOMBRE7', 'profesor7', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(8, 'Apellido1 Apellido2, NOMBRE8', 'profesor8', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(9, 'Apellido1 Apellido2, NOMBRE9', 'profesor9', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(10, 'Apellido1 Apellido2, NOMBRE10', 'profesor10', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(11, 'Apellido1 Apellido2, NOMBRE11', 'profesor11', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(12, 'Apellido1 Apellido2, NOMBRE12', 'profesor12', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(13, 'Apellido1 Apellido2, NOMBRE13', 'profesor13', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(14, 'Apellido1 Apellido2, NOMBRE14', 'profesor14', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(15, 'Apellido1 Apellido2, NOMBRE15', 'profesor15', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(16, 'Apellido1 Apellido2, NOMBRE16', 'profesor16', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(17, 'Apellido1 Apellido2, NOMBRE17', 'profesor17', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(18, 'Apellido1 Apellido2, NOMBRE18', 'profesor18', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(19, 'Apellido1 Apellido2, NOMBRE19', 'profesor19', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(20, 'Apellido1 Apellido2, NOMBRE20', 'profesor20', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(21, 'Apellido1 Apellido2, NOMBRE21', 'profesor21', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(22, 'Apellido1 Apellido2, NOMBRE22', 'profesor22', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(23, 'Apellido1 Apellido2, NOMBRE23', 'profesor23', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(24, 'Apellido1 Apellido2, NOMBRE24', 'profesor24', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(25, 'Apellido1 Apellido2, NOMBRE25', 'profesor25', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(26, 'Apellido1 Apellido2, NOMBRE26', 'profesor26', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(27, 'Apellido1 Apellido2, NOMBRE27', 'profesor27', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(28, 'Apellido1 Apellido2, NOMBRE28', 'profesor28', 'e10adc3949ba59abbe56e057f20f883e', 'sfd'),
(29, 'Apellido1 Apellido2, NOMBRE29', 'profesor29', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(30, 'Apellido1 Apellido2, NOMBRE30', 'profesor30', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(31, 'Apellido1 Apellido2, NOMBRE31', 'profesor31', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(32, 'Apellido1 Apellido2, NOMBRE32', 'profesor32', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(33, 'Apellido1 Apellido2, NOMBRE33', 'profesor33', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(34, 'Apellido1 Apellido2, NOMBRE34', 'profesor34', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(35, 'Apellido1 Apellido2, NOMBRE35', 'profesor35', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(36, 'Apellido1 Apellido2, NOMBRE36', 'profesor36', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(37, 'Apellido1 Apellido2, NOMBRE37', 'profesor37', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(38, 'Apellido1 Apellido2, NOMBRE38', 'profesor38', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(39, 'Apellido1 Apellido2, NOMBRE39', 'profesor39', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(40, 'Apellido1 Apellido2, NOMBRE40', 'profesor40', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(41, 'Apellido1 Apellido2, NOMBRE41', 'profesor41', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(42, 'Apellido1 Apellido2, NOMBRE42', 'profesor42', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(43, 'Apellido1 Apellido2, NOMBRE43', 'profesor43', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(44, 'Apellido1 Apellido2, NOMBRE44', 'profesor44', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(45, 'Apellido1 Apellido2, NOMBRE45', 'profesor45', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(46, 'Apellido1 Apellido2, NOMBRE46', 'profesor46', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(47, 'Apellido1 Apellido2, NOMBRE47', 'profesor47', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(48, 'Apellido1 Apellido2, NOMBRE48', 'profesor48', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(49, 'Apellido1 Apellido2, NOMBRE49', 'profesor49', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(50, 'Apellido1 Apellido2, NOMBRE50', 'profesor50', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(51, 'Apellido1 Apellido2, NOMBRE51', 'profesor51', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(52, 'Apellido1 Apellido2, NOMBRE52', 'profesor52', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(53, 'Apellido1 Apellido2, NOMBRE53', 'profesor53', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(54, 'Apellido1 Apellido2, NOMBRE54', 'profesor54', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(55, 'Apellido1 Apellido2, NOMBRE55', 'profesor55', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(56, 'Apellido1 Apellido2, NOMBRE56', 'profesor56', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(57, 'Apellido1 Apellido2, NOMBRE57', 'profesor57', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(58, 'Apellido1 Apellido2, NOMBRE58', 'profesor58', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(59, 'Apellido1 Apellido2, NOMBRE59', 'profesor59', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(60, 'Apellido1 Apellido2, NOMBRE60', 'profesor60', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(61, 'Apellido1 Apellido2, NOMBRE61', 'profesor61', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(62, 'Apellido1 Apellido2, NOMBRE62', 'profesor62', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(63, 'Apellido1 Apellido2, NOMBRE63', 'profesor63', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(64, 'Apellido1 Apellido2, NOMBRE64', 'profesor64', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(65, 'Apellido1 Apellido2, NOMBRE65', 'profesor65', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(66, 'Apellido1 Apellido2, NOMBRE66', 'profesor66', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(67, 'Apellido1 Apellido2, NOMBRE67', 'profesor67', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(68, 'Apellido1 Apellido2, NOMBRE68', 'profesor68', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(69, 'Apellido1 Apellido2, NOMBRE69', 'profesor69', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(70, 'Apellido1 Apellido2, NOMBRE70', 'profesor70', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(71, 'Apellido1 Apellido2, NOMBRE71', 'profesor71', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(72, 'Apellido1 Apellido2, NOMBRE72', 'profesor72', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(73, 'Apellido1 Apellido2, NOMBRE73', 'profesor73', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(74, 'Apellido1 Apellido2, NOMBRE74', 'profesor74', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(75, 'Apellido1 Apellido2, NOMBRE75', 'profesor75', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(76, 'Apellido1 Apellido2, NOMBRE76', 'profesor76', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(77, 'Apellido1 Apellido2, NOMBRE77', 'profesor77', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(78, 'Apellido1 Apellido2, NOMBRE78', 'profesor78', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(79, 'Apellido1 Apellido2, NOMBRE79', 'profesor79', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(80, 'Apellido1 Apellido2, NOMBRE80', 'profesor80', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(81, 'Apellido1 Apellido2, NOMBRE81', 'profesor81', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(82, 'Apellido1 Apellido2, NOMBRE82', 'profesor82', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(83, 'Apellido1 Apellido2, NOMBRE83', 'profesor83', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(84, 'Apellido1 Apellido2, NOMBRE84', 'profesor84', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(85, 'Apellido1 Apellido2, NOMBRE85', 'profesor85', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(86, 'Apellido1 Apellido2, NOMBRE86', 'profesor86', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(87, 'Apellido1 Apellido2, NOMBRE87', 'profesor87', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(88, 'Apellido1 Apellido2, NOMBRE88', 'profesor88', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(89, 'Apellido1 Apellido2, NOMBRE89', 'profesor89', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(90, 'Apellido1 Apellido2, NOMBRE90', 'profesor90', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(91, 'Apellido1 Apellido2, NOMBRE91', 'profesor91', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(92, 'Apellido1 Apellido2, NOMBRE92', 'profesor92', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(93, 'Apellido1 Apellido2, NOMBRE93', 'profesor93', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(94, 'Apellido1 Apellido2, NOMBRE94', 'profesor94', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(95, 'Apellido1 Apellido2, NOMBRE95', 'profesor95', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(96, 'Apellido1 Apellido2, NOMBRE96', 'profesor96', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(97, 'Apellido1 Apellido2, NOMBRE97', 'profesor97', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(98, 'Apellido1 Apellido2, NOMBRE98', 'profesor98', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(99, 'Apellido1 Apellido2, NOMBRE99', 'profesor99', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(100, 'Apellido1 Apellido2, NOMBRE100', 'profesor100', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(101, 'Apellido1 Apellido2, NOMBRE101', 'profesor101', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(102, 'Apellido1 Apellido2, NOMBRE102', 'profesor102', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(103, 'Apellido1 Apellido2, NOMBRE103', 'profesor103', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(104, 'Apellido1 Apellido2, NOMBRE104', 'profesor104', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(105, 'Apellido1 Apellido2, NOMBRE105', 'profesor105', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(106, 'Apellido1 Apellido2, NOMBRE106', 'profesor106', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(107, 'Apellido1 Apellido2, NOMBRE107', 'profesor107', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(108, 'Apellido1 Apellido2, NOMBRE108', 'profesor108', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(109, 'Apellido1 Apellido2, NOMBRE109', 'profesor109', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(110, 'Apellido1 Apellido2, NOMBRE110', 'profesor110', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(111, 'Apellido1 Apellido2, NOMBRE111', 'profesor111', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(112, 'Apellido1 Apellido2, NOMBRE112', 'profesor112', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(113, 'Apellido1 Apellido2, NOMBRE113', 'profesor113', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(114, 'Apellido1 Apellido2, NOMBRE114', 'profesor114', 'e10adc3949ba59abbe56e057f20f883e', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horario_guardias`
--
ALTER TABLE `horario_guardias`
  ADD PRIMARY KEY (`id_hor_gua`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horario_guardias`
--
ALTER TABLE `horario_guardias`
  MODIFY `id_hor_gua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario_guardias`
--
ALTER TABLE `horario_guardias`
  ADD CONSTRAINT `horario_guardias_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
