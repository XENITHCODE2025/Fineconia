-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2025 a las 19:32:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fineconia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id_Gasto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_Ingreso` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_Ingreso`, `fecha`, `descripcion`, `categoria`, `monto`, `created_at`, `updated_at`) VALUES
(2, '2025-05-14', 'Trabajo extra', 'Salario', 150.00, '2025-05-14 22:07:46', '2025-05-14 22:07:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_17_033247_add_edad_y_miembro_to_users_table', 1),
(5, '2025_04_26_013834_add_verification_code_to_users_table', 2),
(6, '2025_04_29_175652_add_codigo_verificacion_to_users_table', 3),
(7, '2025_05_12_160735_remove_edad_from_users_table', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dp3MgtnKnLNHuyP32qyxmztokgPYJ4T7UWTggOjl', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicnN1Z0ppeUtiUmF6M1RCR2dFa3NNNmFaTFRuTFJpdGVTS0VNQVRnWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjE6e2k6MDtzOjc6InN1Y2Nlc3MiO31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE2O3M6Nzoic3VjY2VzcyI7czoxMToiQmllbnZlbmlkbyEiO30=', 1747163635),
('sAnqvScnJLuyqHL8Dxjdu4wyCScattOUOgOp2QIn', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTmp4QTh4RUswa0NQb25uNXA2SFN0OXpBQndQeVFMUUFMbnZRVllRTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nYXN0b3MtaW5ncmVzb3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNjt9', 1747165729),
('wzPo3xfhDBTQ6pGLfucxkCQHHn0NoQxc3BqG1Z0x', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHltQktSVDV5MWx3WTRLYWRKem16MW01UExrQk92RDBVb3U1aVVmSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9maW5hbnphcy1wZXJzb25hbGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1747241176);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `miembro` varchar(255) DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `codigo_verificacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `miembro`, `verification_code`, `codigo_verificacion`) VALUES
(1, 'alex aparicio', 'alexa@gmail.com', NULL, '$2y$12$47ELfXpc9gdnceA3Nk6uWOzompEZEkeIUEoJ4lAOVrVZn0a.XyZ4W', NULL, '2025-04-17 09:50:28', '2025-04-30 02:43:24', 'hijo', NULL, '459976'),
(2, 'William Alexander', 'apariciowilliam2004@gmail.com', NULL, '$2y$12$A1GYIji4n9zyAetqOM8HZegyWNwJwoQyw3xLTQ65P74/fIkRlsROy', NULL, '2025-04-18 05:09:34', '2025-04-30 02:46:24', 'hijo', NULL, '156596'),
(5, 'Test User', 'test@example.com', NULL, '$2y$12$VHXLkQLOoW3FNi6zAa4G2umf1xfxSdoBvvNcaYKvi9Y6Y2myhXvA6', NULL, '2025-04-25 23:33:24', '2025-04-30 02:49:09', 'Sí', NULL, '469703'),
(6, 'alex Alexander', 'alex_zelaya01@hotmail.com', NULL, '$2y$12$W/9EBnHsgVLVFDZqwh1yUu7c8Tjn2ZaXSWhFqlPu4f9JeTrDGG1Ie', NULL, '2025-04-25 23:41:49', '2025-04-25 23:41:49', 'padre', NULL, NULL),
(7, 'Juan diaz', 'Juan@gmail.com', NULL, '$2y$12$ufuLW7e1l.DdKmPL5.ayM.gIFibymT70LsM8FkIt9Q4iuksm4MzhS', NULL, '2025-04-26 00:12:40', '2025-04-30 02:53:20', 'hijo', NULL, '676243'),
(8, 'Rolando Iglesias', 'reznoreza@gmail.com', NULL, '$2y$12$9Cs3rLDElzhzY9jJ/mvaI.GAxaLfgC2H7Gxwqd81jvNiBHMud.hye', NULL, '2025-04-26 00:40:40', '2025-04-26 00:40:40', 'padre', NULL, NULL),
(11, 'Karen Carrilo', 'Karen@gmail.com', '2025-04-26 01:07:51', '$2y$12$T8qudPlJczIClMVCcCFV/uRh8KguBjJq1Hl4NHqnuOzeCyBHQhsqa', NULL, '2025-04-26 01:03:45', '2025-04-30 03:01:58', 'hijo', NULL, '653020'),
(12, 'Josue Gilberto Castro Zelaya', 'reznoreza1@gmail.com', '2025-04-26 05:01:13', '$2y$12$hJ3PbQAoQupMbyGqd8RVQe0JMe2PEGnrWmh0M7IAKRXRA1Y6yrMI6', NULL, '2025-04-26 05:00:19', '2025-04-30 02:23:48', 'hijo', NULL, '817219'),
(16, 'Karen Lisbeth Carrillo Lara', 'Carrillolara@gmail.com', '2025-04-26 08:29:33', '$2y$12$AUr2YnaPEs3pNw2dLyH51OLYRALYFvoRAMPznmTFU7Gja2mYly9xS', NULL, '2025-04-26 08:22:58', '2025-04-30 02:23:18', 'hijo', NULL, '214201'),
(17, 'Fredy Stanley Aparicio Zelaya', 'Fredy@gmail.com', '2025-04-26 08:43:56', '$2y$12$yT/ORxFLayP5eBkrX/PdTOb/2I8VxDZA.u4NC8gpRyXw6WJ42LlRy', NULL, '2025-04-26 08:43:33', '2025-04-30 03:20:30', 'hijo', NULL, '197732'),
(23, 'Testeo Testeo', 'Testeo@gmail.com', NULL, '$2y$12$WUx7LkyGwd59mEJZ4FEr9.3Iks5TQWizxARPon2Kis0EqLjDFwueu', NULL, '2025-04-30 09:13:10', '2025-04-30 09:13:10', 'hijo', '8oJHjX', NULL),
(24, 'ASS AAA', 'AAS@GMAIL.COM', '2025-04-30 09:18:57', '$2y$12$Fo.g6NDryQCD2RdXAUHRg.uh7aWwzGcZmpDx5Gxuwb8fsFPYI.Ow6', NULL, '2025-04-30 09:18:19', '2025-04-30 09:18:57', 'madre', NULL, NULL),
(25, 'Luis Hernandez', 'Luis@ugb.edu.sv', '2025-04-30 23:01:57', '$2y$12$tDWhYc5nWmn4AsbRpS6wPeNJ5QtLrxI4qedao/NN8I13o43o62A3a', NULL, '2025-04-30 23:01:30', '2025-04-30 23:01:57', 'padre', NULL, NULL),
(26, 'Josue Gilberto Castro Zelaya', 'josuecstro2023@gmail.com', '2025-05-13 21:56:51', '$2y$12$6m8Xa/S7UhnhrMuzSF6rge3SEMTuiM5T4YHqyr4.TRV0IFkUYESsO', NULL, '2025-05-13 21:56:08', '2025-05-13 21:56:51', 'padre', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id_Gasto`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_Ingreso`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id_Gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_Ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
