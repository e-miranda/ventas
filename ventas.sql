-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2026 a las 02:20:27
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
-- Base de datos: `ventas`
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
(4, '2025_12_31_015104_create_permission_tables', 2),
(5, '2025_12_31_030401_add_perfil_to_users_table', 3),
(6, '2026_01_07_003926_create_productos_table', 4),
(7, '2026_01_16_215436_create_ventas_table', 5),
(8, '2026_01_17_030911_add_qr_to_ventas_table', 6),
(9, '2026_01_20_214659_add_estado_to_ventas_table', 7),
(10, '2026_01_23_153456_create_venta_estados_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `costo_unitario` decimal(8,2) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `cantidad`, `precio`, `imagen`, `costo_unitario`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'zapatos brasilero', 4, 850.00, 'productos/Ff4gOzjiW7g4qclV443B3ndSc9UOrmn06KTARcst.jpg', 100.00, 'activo', '2026-01-13 07:08:23', '2026-01-27 06:51:30'),
(2, 'botas', 189, 200.00, 'productos/tGjReoufeGSaOQKeT1IK98kcb2ka37iJUWPXhzms.webp', 50.00, 'activo', '2026-01-13 07:09:34', '2026-01-27 06:51:46'),
(3, 'Alicate', 99, 20.00, 'productos/gyA7gW6EnL3yQom7ykaB8jQCPa0aiVtqfSasrDS4.jpg', 20.00, 'activo', '2026-01-29 05:06:03', '2026-01-29 05:10:38'),
(4, 'Harina', 199, 300.00, 'productos/4ZiQqwqZ2Sz1WZMhSKjBC45XaKGEjXhqcfXmC4K6.jpg', 100.00, 'activo', '2026-01-29 05:06:37', '2026-01-29 05:10:04'),
(5, 'PlayStation-6', 99, 1000.00, 'productos/8h5hIEi8LdC7tRpx8qHcctCw5iNeKw683oFrVgb8.jpg', 1000.00, 'activo', '2026-01-29 05:07:19', '2026-01-29 05:11:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-31 06:54:01', '2025-12-31 06:54:01'),
(2, 'vendedor', 'web', '2025-12-31 06:54:02', '2025-12-31 06:54:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
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
('IYmMW3LZUblDz7bSxvWtimmNrycdNXpBc7X8USfy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicUlaZkttc2pCTkUxeHNqcEFyOXRKdlZZR0FsNlY2TFNRRmJjT1dEbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1769649581);

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
  `perfil` varchar(255) NOT NULL DEFAULT 'vendedor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `perfil`) VALUES
(1, 'administrador', 'administrador@ventas.com', NULL, '$2y$12$TnhZ3BlfFKdb8Nd4peYRguKf/SND9SsHp3lH17IIkWGRttAuxwRuq', NULL, '2025-12-31 05:40:14', '2025-12-31 07:12:04', 'admin'),
(2, 'vendedor', 'vendedor@ventas.com', NULL, '$2y$12$wyD8998PT99vidCJgmiCs.e0d2wNiVThG/gk/XKN/Ns6I17JYc2re', NULL, '2026-01-13 06:43:17', '2026-01-13 06:43:17', 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `nombre_comprador` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email_deposito` varchar(255) DEFAULT NULL,
  `autorizacion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `qr` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `producto_id`, `cantidad`, `precio`, `nombre_comprador`, `telefono`, `email_deposito`, `autorizacion`, `imagen`, `qr`, `estado`, `habilitado`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 5000.00, 'Elias', '5240745', 'elmirco@hotmail.com', '202601', 'comprobantes/Xjg7PHCYAinROAlZgxNyXEoirNfWsZVHlb5DtJaW.png', NULL, 1, 1, '2026-01-17 02:14:30', '2026-01-17 02:14:31'),
(2, 1, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'comprobantes/HpAzRaunlQNhThBFOvs6ZsaonDmyUTdNUaKVNRZ7.png', NULL, 3, 1, '2026-01-17 04:22:00', '2026-01-25 07:45:27'),
(3, 1, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'comprobantes/as8xCjyjYaUMQ0TJTorJNn8YQmT39NcJPhRUjhdp.png', NULL, 1, 1, '2026-01-17 04:24:10', '2026-01-23 20:15:33'),
(4, 2, 1, 5000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'comprobantes/RbA8vOGJFvG6LONcg3FIRcVMHdF2xaDPRreXAi2p.png', NULL, 3, 1, '2026-01-17 06:40:06', '2026-01-25 07:47:29'),
(5, 2, 1, 5000.00, 'Elias', '5240745', 'elmirco@hotmail.com', '202601', 'comprobantes/Lgf5Nn5lQXNTFDVIeIA5okqlUBQ2RnaLOPW4WoXL.png', NULL, 1, 1, '2026-01-17 06:40:30', '2026-01-17 06:40:30'),
(6, 1, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'productos/Ff4gOzjiW7g4qclV443B3ndSc9UOrmn06KTARcst.jpg', NULL, 0, 1, '2026-01-17 07:04:42', '2026-01-17 07:04:42'),
(7, 1, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'productos/Ff4gOzjiW7g4qclV443B3ndSc9UOrmn06KTARcst.jpg', 'qrs/venta_7.svg', 0, 1, '2026-01-17 07:12:15', '2026-01-17 07:12:15'),
(8, 2, 1, 5000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'productos/tGjReoufeGSaOQKeT1IK98kcb2ka37iJUWPXhzms.webp', 'qrs/venta_8.svg', 3, 1, '2026-01-17 07:17:03', '2026-01-25 07:48:28'),
(9, 1, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'productos/Ff4gOzjiW7g4qclV443B3ndSc9UOrmn06KTARcst.jpg', 'qrs/venta_9.svg', 0, 1, '2026-01-22 03:35:33', '2026-01-22 03:35:33'),
(10, 2, 2, 10000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'productos/tGjReoufeGSaOQKeT1IK98kcb2ka37iJUWPXhzms.webp', 'qrs/venta_10.svg', 3, 1, '2026-01-25 08:03:35', '2026-01-25 08:07:23'),
(11, 2, 1, 5000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'productos/tGjReoufeGSaOQKeT1IK98kcb2ka37iJUWPXhzms.webp', 'qrs/venta_11.svg', 1, 1, '2026-01-25 08:18:44', '2026-01-27 07:05:43'),
(12, 2, 1, 5000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'rechazada', 'comprobantes/Q4q85koRQiWUgzFiU6NOZFkMjU88nFLb9q0ElKkr.png', 'qrs/venta_12.svg', 2, 1, '2026-01-25 08:41:15', '2026-01-25 08:41:49'),
(13, 1, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'aprobada', 'productos/Ff4gOzjiW7g4qclV443B3ndSc9UOrmn06KTARcst.jpg', 'qrs/venta_13.svg', 3, 1, '2026-01-25 09:09:34', '2026-01-29 05:19:24'),
(14, 2, 2, 10000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'comprobantes/POSCDzLhnw3UTUNVJc2Jp4OQCUxKgJfOuC5PqMT7.png', 'qrs/venta_14.svg', 0, 1, '2026-01-25 09:09:59', '2026-01-25 09:10:00'),
(15, 4, 1, 300.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'comprobantes/EoWUdyJQBTWNyuh7Hfz8M9ldUDzwUJF58CzPWEYQ.png', 'qrs/venta_15.svg', 0, 1, '2026-01-29 05:10:03', '2026-01-29 05:10:04'),
(16, 3, 1, 20.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'comprobantes/ItIIhWehZgdnXrDKAl8eJMp8jsdBu7dIj0OuoLuZ.png', 'qrs/venta_16.svg', 0, 1, '2026-01-29 05:10:38', '2026-01-29 05:10:38'),
(17, 5, 1, 1000.00, 'Elias', '5240745', 'elmirco@hotmail.com', 'pendiente', 'comprobantes/BWGkp28c2DNb6ubXRFr9SalT2iqLUrRELHC6aD20.png', 'qrs/venta_17.svg', 0, 1, '2026-01-29 05:11:07', '2026-01-29 05:11:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_estados`
--

CREATE TABLE `venta_estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `estado_anterior` tinyint(3) UNSIGNED NOT NULL,
  `estado_nuevo` tinyint(3) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta_estados`
--

INSERT INTO `venta_estados` (`id`, `venta_id`, `estado_anterior`, `estado_nuevo`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 1, 1, '2026-01-23 20:24:25', '2026-01-23 20:24:25'),
(2, 4, 0, 1, 1, '2026-01-25 03:15:50', '2026-01-25 03:15:50'),
(3, 4, 0, 1, 1, '2026-01-25 03:17:09', '2026-01-25 03:17:09'),
(4, 4, 0, 1, 1, '2026-01-25 07:07:23', '2026-01-25 07:07:23'),
(5, 2, 1, 3, 1, '2026-01-25 07:21:46', '2026-01-25 07:21:46'),
(6, 2, 0, 1, 1, '2026-01-25 07:23:36', '2026-01-25 07:23:36'),
(7, 2, 0, 1, 1, '2026-01-25 07:24:34', '2026-01-25 07:24:34'),
(8, 2, 0, 1, 1, '2026-01-25 07:27:57', '2026-01-25 07:27:57'),
(9, 2, 0, 1, 1, '2026-01-25 07:29:24', '2026-01-25 07:29:24'),
(10, 2, 0, 1, 1, '2026-01-25 07:30:05', '2026-01-25 07:30:05'),
(11, 2, 0, 1, 1, '2026-01-25 07:32:39', '2026-01-25 07:32:39'),
(12, 2, 0, 1, 1, '2026-01-25 07:35:14', '2026-01-25 07:35:14'),
(13, 2, 0, 1, 1, '2026-01-25 07:36:24', '2026-01-25 07:36:24'),
(14, 2, 0, 1, 1, '2026-01-25 07:37:43', '2026-01-25 07:37:43'),
(15, 1, 1, 3, 1, '2026-01-25 07:38:22', '2026-01-25 07:38:22'),
(16, 1, 1, 3, 1, '2026-01-25 07:38:30', '2026-01-25 07:38:30'),
(17, 2, 0, 1, 1, '2026-01-25 07:45:08', '2026-01-25 07:45:08'),
(18, 2, 1, 3, 1, '2026-01-25 07:45:27', '2026-01-25 07:45:27'),
(19, 4, 0, 1, 1, '2026-01-25 07:46:35', '2026-01-25 07:46:35'),
(20, 4, 1, 3, 1, '2026-01-25 07:47:29', '2026-01-25 07:47:29'),
(21, 8, 0, 1, 1, '2026-01-25 07:47:59', '2026-01-25 07:47:59'),
(22, 8, 1, 3, 1, '2026-01-25 07:48:28', '2026-01-25 07:48:28'),
(23, 10, 0, 1, 2, '2026-01-25 08:03:51', '2026-01-25 08:03:51'),
(24, 10, 1, 3, 2, '2026-01-25 08:07:23', '2026-01-25 08:07:23'),
(25, 12, 0, 2, 2, '2026-01-25 08:41:49', '2026-01-25 08:41:49'),
(26, 11, 0, 1, 1, '2026-01-27 07:05:43', '2026-01-27 07:05:43'),
(27, 13, 0, 1, 1, '2026-01-27 07:25:01', '2026-01-27 07:25:01'),
(28, 13, 1, 3, 1, '2026-01-29 05:19:24', '2026-01-29 05:19:24');

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
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `venta_estados`
--
ALTER TABLE `venta_estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_estados_venta_id_foreign` (`venta_id`),
  ADD KEY `venta_estados_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `venta_estados`
--
ALTER TABLE `venta_estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `venta_estados`
--
ALTER TABLE `venta_estados`
  ADD CONSTRAINT `venta_estados_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `venta_estados_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
