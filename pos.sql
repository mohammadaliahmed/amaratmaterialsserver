-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 14, 2023 at 04:44 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_manager` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch_sales_targets`
--

DROP TABLE IF EXISTS `branch_sales_targets`;
CREATE TABLE IF NOT EXISTS `branch_sales_targets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch_target_lists`
--

DROP TABLE IF EXISTS `branch_target_lists`;
CREATE TABLE IF NOT EXISTS `branch_target_lists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `target_id` int NOT NULL DEFAULT '0',
  `branch_id` int NOT NULL DEFAULT '0',
  `target_amount` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `urdu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

DROP TABLE IF EXISTS `calendars`;
CREATE TABLE IF NOT EXISTS `calendars` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `allDay` tinyint(1) NOT NULL,
  `className` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

DROP TABLE IF EXISTS `cash_registers`;
CREATE TABLE IF NOT EXISTS `cash_registers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urdu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_by`, `created_at`, `updated_at`, `image`, `urdu`) VALUES
(1, 'Cement', 'cement', 1, '2023-02-13 02:31:14', '2023-03-02 00:54:09', NULL, 'سیمنٹ'),
(2, 'Paint', 'paint', 1, '2023-03-02 00:54:23', '2023-03-02 00:54:23', NULL, 'پینٹ');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `famous` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_ordered_product_timeline`
--

DROP TABLE IF EXISTS `customer_ordered_product_timeline`;
CREATE TABLE IF NOT EXISTS `customer_ordered_product_timeline` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `selled_item_id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_ordered_product_timeline`
--

INSERT INTO `customer_ordered_product_timeline` (`id`, `selled_item_id`, `product_id`, `status`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 8, 3, 0, 1, '2023-04-13 00:35:23', '2023-04-13 00:35:23'),
(2, 8, 3, 1, 2, '2023-04-13 00:36:03', '2023-04-13 00:36:03'),
(3, 8, 3, 2, 2, '2023-04-13 00:36:10', '2023-04-13 00:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_timelines`
--

DROP TABLE IF EXISTS `customer_order_timelines`;
CREATE TABLE IF NOT EXISTS `customer_order_timelines` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_id` int NOT NULL,
  `order_status` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_order_timelines`
--

INSERT INTO `customer_order_timelines` (`id`, `sale_id`, `order_status`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 1, '2023-04-13 00:35:23', '2023-04-13 00:35:23'),
(2, 8, 1, 2, '2023-04-13 00:36:22', '2023-04-13 00:36:22'),
(3, 8, 2, 2, '2023-04-13 00:36:39', '2023-04-13 00:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `from`, `slug`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'User Create', 'Laravel', 'user_create', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(2, 'Customer Create', 'Laravel', 'customer_create', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(3, 'Vendor Create', 'Laravel', 'vendor_create', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(4, 'Quotations Create', 'Laravel', 'quotations_create', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `email_template_langs`
--

DROP TABLE IF EXISTS `email_template_langs`;
CREATE TABLE IF NOT EXISTS `email_template_langs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `lang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_template_langs`
--

INSERT INTO `email_template_langs` (`id`, `parent_id`, `lang`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'ar', 'User Create', '<p>مرحبًا,<b> {user_name} </b>!</p>\r\n                            <p>مرحبًا بك في التطبيق الخاص بنا تفاصيل تسجيل الدخول الخاصة بـ <b> {app_name}</b> هو <br></p>\r\n                            <p><b>البريد الإلكتروني   : </b>{user_email}</p>\r\n                            <p><b>كلمة المرور   : </b>{user_password}</p>\r\n                            <p><b>عنوان url للتطبيق    : </b>{app_url}</p>\r\n                            <p>شكرا لتواصلك معنا،</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(2, 1, 'da', 'User Create', '<p>Hej,<b> {user_name} </b>!</p>\r\n                            <p>Velkommen til vores app, hvor du kan logge ind <b> {app_name}</b> er <br></p>\r\n                            <p><b>E-mail   : </b>{user_email}</p>\r\n                            <p><b>Adgangskode : </b>{user_password}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p> Tak fordi du tog kontakt med os,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(3, 1, 'de', 'User Create', '<p>Hallo,<b> {user_name} </b>!</p>\r\n                            <p>Willkommen in unserer App für Ihre Login-Daten <b> {app_name}</b> ist <br></p>\r\n                            <p><b>Email   : </b>{user_email}</p>\r\n                            <p><b>Passwort   : </b>{user_password}</p>\r\n                            <p><b> App-URL    : </b>{app_url}</p>\r\n                            <p>Danke, dass Sie sich mit uns verbunden haben,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(4, 1, 'en', 'User Create', '<p>Hello,<b> {user_name} </b>!</p>\r\n                            <p>Welcome to our app yore login detail for <b> {app_name}</b> is <br></p>\r\n                            <p><b>Email   : </b>{user_email}</p>\r\n                            <p><b>Password   : </b>{user_password}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p>Thank you for connecting with us,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(5, 1, 'es', 'User Create', '<p>Hola,<b> {user_name} </b>!</p>\r\n                            <p>Bienvenido a nuestra aplicación antaño detalles de inicio de sesión para <b> {app_name}</b> es <br></p>\r\n                            <p><b>Correo electrónico   : </b>{user_email}</p>\r\n                            <p><b>Clave   : </b>{user_password}</p>\r\n                            <p><b>URL de la aplicación  : </b>{app_url}</p>\r\n                            <p>Gracias por conectar con nosotras,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(6, 1, 'fr', 'User Create', '<p>Bonjour,<b> {user_name} </b>!</p>\r\n                            <p>Bienvenue sur notre application autrefois les informations de connexion pour <b> {app_name}</b> est <br></p>\r\n                            <p><b>E-mail   : </b>{user_email}</p>\r\n                            <p><b>Mot de passe   : </b>{user_password}</p>\r\n                            <p><b>URL de l\'application   : </b>{app_url}</p>\r\n                            <p>Merci de nous avoir contacté,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(7, 1, 'it', 'User Create', '<p>Ciao,<b> {user_name} </b>!</p>\r\n                            <p>Benvenuto nella nostra app per i tuoi dati di accesso <b> {app_name}</b> è <br></p>\r\n                            <p><b>E-mail   : </b>{user_email}</p>\r\n                            <p><b>Parola d\'ordine   : </b>{user_password}</p>\r\n                            <p><b>URL dell\'app    : </b>{app_url}</p>\r\n                            <p>Grazie per esserti connesso con noi,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(8, 1, 'ja', 'User Create', '<p>こんにちは,<b> {user_name} </b>!</p>\r\n                            <p>私たちのアプリのyoreログインの詳細へようこそ <b> {app_name}</b> は <br></p>\r\n                            <p><b>Eメール   : </b>{user_email}</p>\r\n                            <p><b>パスワード   : </b>{user_password}</p>\r\n                            <p><b>アプリのURL    : </b>{app_url}</p>\r\n                            <p>ご連絡ありがとうございます,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(9, 1, 'nl', 'User Create', '<p>Hallo,<b> {user_name} </b>!</p>\r\n                            <p>Welkom bij de inloggegevens van onze app voor: <b> {app_name}</b> is <br></p>\r\n                            <p><b>E-mail   : </b>{user_email}</p>\r\n                            <p><b>Wachtwoord   : </b>{user_password}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p>Bedankt voor het contact met ons,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(10, 1, 'pl', 'User Create', '<p>Witam,<b> {user_name} </b>!</p>\r\n                            <p>Witamy w naszej aplikacji yore dane logowania do <b> {app_name}</b> jest <br></p>\r\n                            <p><b>E-mail   : </b>{user_email}</p>\r\n                            <p><b>Hasło   : </b>{user_password}</p>\r\n                            <p><b>URL aplikacji    : </b>{app_url}</p>\r\n                            <p>Dziękujemy za kontakt z nami,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(11, 1, 'ru', 'User Create', '<p>Привет,<b> {user_name} </b>!</p>\r\n                            <p>Добро пожаловать в наше приложение. <b> {app_name}</b> является <br></p>\r\n                            <p><b>Эл. адрес   : </b>{user_email}</p>\r\n                            <p><b>Пароль   : </b>{user_password}</p>\r\n                            <p><b>URL приложения    : </b>{app_url}</p>\r\n                            <p>Спасибо, что связались с нами,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(12, 1, 'pt', 'User Create', '<p>Olá,<b> {user_name} </b>!</p>\r\n                            <p>Bem-vindo ao nosso aplicativo antigo detalhe de login para <b> {app_name}</b> é <br></p>\r\n                            <p><b>E-mail   : </b>{user_email}</p>\r\n                            <p><b>Senha   : </b>{user_password}</p>\r\n                            <p><b>URL do aplicativo    : </b>{app_url}</p>\r\n                            <p>Obrigado por conectar com a gente,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(13, 2, 'ar', 'Customer Create', '<p>مرحبًا,<b> {customer_name} </b>!</p>\r\n                            <p>مرحبًا بك في التطبيق الخاص بنا تفاصيل تسجيل الدخول الخاصة بـ <b> {app_name}</b> هو <br></p>\r\n                            <p><b>البريد الإلكتروني   : </b>{customer_email}</p>\r\n                            <p><b>عنوان url للتطبيق    : </b>{app_url}</p>\r\n                            <p><b>عنوان العميل   : </b>{customer_address}</p>\r\n                            <p><b>بلد العميل   : </b>{customer_country}</p>\r\n                            <p><b>الرمز البريدي للعميل   : </b>{customer_zipcode}</p>\r\n                            <p>شكرا لتواصلك معنا,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(14, 2, 'da', 'Customer Create', '<p>Hej,<b> {customer_name} </b>!</p>\r\n                            <p>Velkommen til vores app, hvor du kan logge ind <b> {app_name}</b> er <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p><b>Kundeadresse   : </b>{customer_address}</p>\r\n                            <p><b>Kundeland   : </b>{customer_country}</p>\r\n                            <p><b>Kundens postnummer   : </b>{customer_zipcode}</p>\r\n                            <p>Tak fordi du tog kontakt med os,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(15, 2, 'de', 'Customer Create', '<p>Hallo,<b> {customer_name} </b>!</p>\r\n                            <p>Willkommen in unserer App für Ihre Login-Daten <b> {app_name}</b> ist <br></p>\r\n                            <p><b>Email   : </b>{customer_email}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p><b>Kundenadresse   : </b>{customer_address}</p>\r\n                            <p><b>Kundenland   : </b>{customer_country}</p>\r\n                            <p><b>Postleitzahl des Kunden : </b>{customer_zipcode}</p>\r\n                            <p>Vielen Dank, dass Sie sich mit uns verbunden haben,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(16, 2, 'en', 'Customer Create', '<p>Hello,<b> {customer_name} </b>!</p>\r\n                            <p>Welcome to our app yore login detail for <b> {app_name}</b> is <br></p>\r\n                            <p><b>Email   : </b>{customer_email}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p><b>Customer Address   : </b>{customer_address}</p>\r\n                            <p><b>Customer Country   : </b>{customer_country}</p>\r\n                            <p><b>Customer Zipcode   : </b>{customer_zipcode}</p>\r\n                            <p>Thank you for connecting with us,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(17, 2, 'es', 'Customer Create', '<p>Hola,<b> {customer_name} </b>!</p>\r\n                            <p>Bienvenido a nuestra aplicación antaño detalles de inicio de sesión para <b> {app_name}</b> es <br></p>\r\n                            <p><b>Correo electrónico   : </b>{customer_email}</p>\r\n                            <p><b>URL de la aplicación    : </b>{app_url}</p>\r\n                            <p><b>Dirección del cliente   : </b>{customer_address}</p>\r\n                            <p><b>País del cliente   : </b>{customer_country}</p>\r\n                            <p><b>Código postal del cliente   : </b>{customer_zipcode}</p>\r\n                            <p>Gracias por conectar con nosotros,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(18, 2, 'fr', 'Customer Create', '<p>Bonjour,<b> {customer_name} </b>!</p>\r\n                            <p>Bienvenue sur notre application autrefois les informations de connexion pour <b> {app_name}</b> est <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL de l\'application   : </b>{app_url}</p>\r\n                            <p><b>Adresse du client   : </b>{customer_address}</p>\r\n                            <p><b>Pays du client   : </b>{customer_country}</p>\r\n                            <p><b>Code postal du client   : </b>{customer_zipcode}</p>\r\n                            <p>Merci de nous avoir contacté,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(19, 2, 'it', 'Customer Create', '<p>Ciao,<b> {customer_name} </b>!</p>\r\n                            <p>Benvenuto nella nostra app per i tuoi dati di accesso <b> {app_name}</b> è <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL dell\'app    : </b>{app_url}</p>\r\n                            <p><b>Indirizzo del cliente   : </b>{customer_address}</p>\r\n                            <p><b>Paese cliente   : </b>{customer_country}</p>\r\n                            <p><b>Codice postale del cliente   : </b>{customer_zipcode}</p>\r\n                            <p>Grazie per esserti connesso con noi,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(20, 2, 'ja', 'Customer Create', '<p>こんにちは,<b> {customer_name} </b>!</p>\r\n                            <p>私たちのアプリのyoreログインの詳細へようこそ <b> {app_name}</b> は <br></p>\r\n                            <p><b>Eメール   : </b>{customer_email}</p>\r\n                            <p><b>アプリのURL    : </b>{app_url}</p>\r\n                            <p><b>お客様の住所   : </b>{customer_address}</p>\r\n                            <p><b>顧客の国   : </b>{customer_country}</p>\r\n                            <p><b>顧客の郵便番号   : </b>{customer_zipcode}</p>\r\n                            <p>ご連絡ありがとうございます,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(21, 2, 'nl', 'Customer Create', '<p>Hallo,<b> {customer_name} </b>!</p>\r\n                            <p>Welkom bij de inloggegevens van onze app voor: <b> {app_name}</b> is <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p><b>Klant adres   : </b>{customer_address}</p>\r\n                            <p><b>Land van klant   : </b>{customer_country}</p>\r\n                            <p><b>Postcode klant   : </b>{customer_zipcode}</p>\r\n                            <p>Bedankt voor het contact met ons,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(22, 2, 'pl', 'Customer Create', '<p>Witam,<b> {customer_name} </b>!</p>\r\n                            <p>Witamy w naszej aplikacji yore dane logowania do <b> {app_name}</b> jest <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL aplikacji    : </b>{app_url}</p>\r\n                            <p><b>Adres klienta   : </b>{customer_address}</p>\r\n                            <p><b>Kraj klienta   : </b>{customer_country}</p>\r\n                            <p><b>Kod pocztowy klienta   : </b>{customer_zipcode}</p>\r\n                            <p>Dziękujemy za kontakt z nami,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(23, 2, 'ru', 'Customer Create', '<p>Привет,<b> {customer_name} </b>!</p>\r\n                            <p>Добро пожаловать в наше приложение. <b> {app_name}</b> является <br></p>\r\n                            <p><b>Эл. адрес   : </b>{customer_email}</p>\r\n                            <p><b>URL приложения    : </b>{app_url}</p>\r\n                            <p><b>Адрес клиента   : </b>{customer_address}</p>\r\n                            <p><b>Страна клиента  : </b>{customer_country}</p>\r\n                            <p><b>Страна клиента  : </b>{customer_zipcode}</p>\r\n                            <p>Спасибо, что связались с нами,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(24, 2, 'pt', 'Customer Create', '<p>Olá,<b> {customer_name} </b>!</p>\r\n                            <p>Bem-vindo ao nosso aplicativo antigo detalhe de login para <b> {app_name}</b> é <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL do aplicativo    : </b>{app_url}</p>\r\n                            <p><b>Endereço do cliente   : </b>{customer_address}</p>\r\n                            <p><b>País do cliente   : </b>{customer_country}</p>\r\n                            <p><b>CEP do cliente   : </b>{customer_zipcode}</p>\r\n                            <p>Obrigado por conectar com a gente,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(25, 3, 'ar', 'Vendor Create', '<p>مرحبًا,<b> {vendor_name} </b>!</p>\r\n                        <p>مرحبًا بك في التطبيق الخاص بنا تفاصيل تسجيل الدخول الخاصة بـ <b> {app_name}</b> هو <br></p>\r\n                        <p><b>البريد الإلكتروني   : </b>{vendor_email}</p>\r\n                        <p><b>عنوان url للتطبيق    : </b>{app_url}</p>\r\n                        <p><b>عنوان البائع   : </b>{vendor_address}</p>\r\n                        <p><b>بلد البائع   : </b>{vendor_country}</p>\r\n                        <p><b>الرمز البريدي للبائع   : </b>{vendor_zipcode}</p>\r\n                        <p>شكرا لتواصلك معنا,</p>\r\n                        <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(26, 3, 'da', 'Vendor Create', '<p>Hej,<b> {vendor_name} </b>!</p>\r\n                            <p>Velkommen til vores app, hvor du kan logge ind <b> {app_name}</b> er <br></p>\r\n                            <p><b>E-mail   : </b>{vendor_email}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p><b>Leverandørens adresse   : </b>{vendor_address}</p>\r\n                            <p><b>Leverandørland   : </b>{vendor_country}</p>\r\n                            <p><b>Leverandørens postnummer   : </b>{vendor_zipcode}</p>\r\n                            <p>Tak fordi du tog kontakt med os,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(27, 3, 'de', 'Vendor Create', '<p>Hallo,<b> {vendor_name} </b>!</p>\r\n                            <p>Willkommen in unserer App für Ihre Login-Daten <b> {app_name}</b> ist <br></p>\r\n                            <p><b>Email   : </b>{vendor_email}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p><b>Adresse des Anbieters   : </b>{vendor_address}</p>\r\n                            <p><b>Land des Anbieters   : </b>{vendor_country}</p>\r\n                            <p><b>Postleitzahl des Anbieters   : </b>{vendor_zipcode}</p>\r\n                            <p>Vielen Dank, dass Sie sich mit uns verbunden haben,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(28, 3, 'en', 'Vendor Create', '<p>Hello,<b> {vendor_name} </b>!</p>\r\n                            <p>Welcome to our app yore login detail for <b> {app_name}</b> is <br></p>\r\n                            <p><b>Email   : </b>{vendor_email}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p><b>Vendor Address   : </b>{vendor_address}</p>\r\n                            <p><b>Vendor Country   : </b>{vendor_country}</p>\r\n                            <p><b>Vendor Zipcode   : </b>{vendor_zipcode}</p>\r\n                            <p>Thank you for connecting with us,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(29, 3, 'es', 'Vendor Create', '<p>Hallo,<b> {vendor_name} </b>!</p>\r\n                            <p>Willkommen in unserer App für Ihre Login-Daten <b> {app_name}</b> ist <br></p>\r\n                            <p><b>Email   : </b>{vendor_email}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p><b>Adresse des Anbieters   : </b>{vendor_address}</p>\r\n                            <p><b>Land des Anbieters   : </b>{vendor_country}</p>\r\n                            <p><b>Postleitzahl des Anbieters   : </b>{vendor_zipcode}</p>\r\n                            <p>Vielen Dank, dass Sie sich mit uns verbunden haben,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(30, 3, 'fr', 'Vendor Create', '<p>Bonjour,<b> {vendor_name} </b>!</p>\r\n                            <p>Bienvenue sur notre application autrefois les informations de connexion pour <b> {app_name}</b> est <br></p>\r\n                            <p><b>E-mail   : </b>{vendor_email}</p>\r\n                            <p><b>URL de l\'application    : </b>{app_url}</p>\r\n                            <p><b>Adresse du vendeur   : </b>{vendor_address}</p>\r\n                            <p><b>Pays du vendeur   : </b>{vendor_country}</p>\r\n                            <p><b>Code postal du vendeur   : </b>{vendor_zipcode}</p>\r\n                            <p>Merci de nous avoir contacté,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(31, 3, 'it', 'Vendor Create', '<p>Ciao,<b> {vendor_name} </b>!</p>\r\n                            <p>Benvenuto nella nostra app per i tuoi dati di accesso <b> {app_name}</b> è <br></p>\r\n                            <p><b>E-mail   : </b>{vendor_email}</p>\r\n                            <p><b>URL dell\'app    : </b>{app_url}</p>\r\n                            <p><b>Indirizzo del venditore   : </b>{vendor_address}</p>\r\n                            <p><b>Paese fornitore   : </b>{vendor_country}</p>\r\n                            <p><b>Codice postale del venditore   : </b>{vendor_zipcode}</p>\r\n                            <p>Grazie per esserti connesso con noi,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(32, 3, 'ja', 'Vendor Create', '<p>こんにちは,<b> {vendor_name} </b>!</p>\r\n                            <p>私たちのアプリのyoreログインの詳細へようこそ <b> {app_name}</b> は <br></p>\r\n                            <p><b>Eメール   : </b>{vendor_email}</p>\r\n                            <p><b>アプリのURL    : </b>{app_url}</p>\r\n                            <p><b>ベンダーの住所   : </b>{vendor_address}</p>\r\n                            <p><b>ベンダーの国   : </b>{vendor_country}</p>\r\n                            <p><b>ベンダーの郵便番号   : </b>{vendor_zipcode}</p>\r\n                            <p>ご連絡ありがとうございます,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(33, 3, 'nl', 'Vendor Create', '<p>Hallo,<b> {vendor_name} </b>!</p>\r\n                            <p>Welkom bij de inloggegevens van onze app voor: <b> {app_name}</b> is <br></p>\r\n                            <p><b>E-mail   : </b>{vendor_email}</p>\r\n                            <p><b>App-URL   : </b>{app_url}</p>\r\n                            <p><b>Adres leverancier  : </b>{vendor_address}</p>\r\n                            <p><b>Land van leverancier  : </b>{vendor_country}</p>\r\n                            <p><b>Postcode leverancier   : </b>{vendor_zipcode}</p>\r\n                            <p>Bedankt voor het contact met ons,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(34, 3, 'pl', 'Vendor Create', '<p>Witam,<b> {vendor_name} </b>!</p>\r\n                            <p>Witamy w naszej aplikacji yore dane logowania do <b> {app_name}</b> jest <br></p>\r\n                            <p><b>E-mail   : </b>{vendor_email}</p>\r\n                            <p><b>URL aplikacji    : </b>{app_url}</p>\r\n                            <p><b>Adres dostawcy   : </b>{vendor_address}</p>\r\n                            <p><b>Kraj dostawcy   : </b>{vendor_country}</p>\r\n                            <p><b>Kod pocztowy dostawcy   : </b>{vendor_zipcode}</p>\r\n                            <p>Dziękujemy za kontakt z nami,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(35, 3, 'ru', 'Vendor Create', '<p>Привет,<b> {vendor_name} </b>!</p>\r\n                            <p>Добро пожаловать в наше приложение. <b> {app_name}</b> является <br></p>\r\n                            <p><b>Эл. адрес   : </b>{vendor_email}</p>\r\n                            <p><b>URL приложения    : </b>{app_url}</p>\r\n                            <p><b>Адрес поставщика   : </b>{vendor_address}</p>\r\n                            <p><b>Страна поставщика   : </b>{vendor_country}</p>\r\n                            <p><b>Почтовый индекс поставщика  : </b>{vendor_zipcode}</p>\r\n                            <p>Спасибо, что связались с нами,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(36, 3, 'pt', 'Vendor Create', '<p>Olá,<b> {vendor_name} </b>!</p>\r\n                            <p>Bem-vindo ao nosso aplicativo antigo detalhe de login para <b> {app_name}</b> é <br></p>\r\n                            <p><b>E-mail   : </b>{vendor_email}</p>\r\n                            <p><b>URL do aplicativo    : </b>{app_url}</p>\r\n                            <p><b>Endereço do fornecedor   : </b>{vendor_address}</p>\r\n                            <p><b>País do fornecedor   : </b>{vendor_country}</p>\r\n                            <p><b>CEP do fornecedor   : </b>{vendor_zipcode}</p>\r\n                            <p>Obrigado por conectar com a gente,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(37, 4, 'ar', 'Quotations Create', '<p>مرحبًا,<b> {quotation_customers} </b>!</p>\r\n                            <p>مرحبًا بك في التطبيق الخاص بنا تفاصيل تسجيل الدخول الخاصة بـ <b> {app_name}</b> هو <br></p>\r\n                            <p><b>البريد الإلكتروني   : </b>{customer_email}</p>\r\n                            <p><b>عنوان url للتطبيق    : </b>{app_url}</p>\r\n                            <p><b>رقم مرجع الاقتباس   : </b>{quotation_reference_no}</p>\r\n                            <p><b>تاريخ الاقتباس  : </b>{quotation_date}</p>\r\n                            <p>شكرا لتواصلك معنا,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(38, 4, 'da', 'Quotations Create', '<p>Hej,<b> {quotation_customers} </b>!</p>\r\n                            <p>Velkommen til vores app, hvor du kan logge ind <b> {app_name}</b> er <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p><b>Tilbudsreferencenr   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Tilbudsdato  : </b>{quotation_date}</p>\r\n                            <p>Tak fordi du tog kontakt med os,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(39, 4, 'de', 'Quotations Create', '<p>Hallo,<b> {quotation_customers} </b>!</p>\r\n                            <p>Willkommen in unserer App für Ihre Login-Daten <b> {app_name}</b> ist <br></p>\r\n                            <p><b>Email   : </b>{customer_email}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p><b>Zitat-Referenz-Nr   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Angebotsdatum : </b>{quotation_date}</p>\r\n                            <p>Vielen Dank, dass Sie sich mit uns verbunden haben,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(40, 4, 'en', 'Quotations Create', '<p>Hello,<b> {quotation_customers} </b>!</p>\r\n                            <p>Welcome to our app yore login detail for <b> {app_name}</b> is <br></p>\r\n                            <p><b>Email   : </b>{customer_email}</p>\r\n                            <p><b>App url    : </b>{app_url}</p>\r\n                            <p><b>Quotation Reference No   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Quotation Date  : </b>{quotation_date}</p>\r\n                            <p>Thank you for connecting with us,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(41, 4, 'es', 'Quotations Create', '<p>Hola,<b> {quotation_customers} </b>!</p>\r\n                            <p>Bienvenido a nuestra aplicación antaño detalles de inicio de sesión para <b> {app_name}</b> es <br></p>\r\n                            <p><b>Correo electrónico   : </b>{customer_email}</p>\r\n                            <p><b>URL de la aplicación    : </b>{app_url}</p>\r\n                            <p><b>Número de referencia de cotización   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Fecha de cotización  : </b>{quotation_date}</p>\r\n                            <p>Gracias por conectar con nosotras,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(42, 4, 'fr', 'Quotations Create', '<p>Bonjour,<b> {quotation_customers} </b>!</p>\r\n                            <p>Bienvenue sur notre application autrefois les informations de connexion pour <b> {app_name}</b> est <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL de l\'application   : </b>{app_url}</p>\r\n                            <p><b>Référence du devis Non  : </b>{quotation_reference_no}</p>\r\n                            <p><b>Date de cotation  : </b>{quotation_date}</p>\r\n                            <p>Merci de nous avoir contacté,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(43, 4, 'it', 'Quotations Create', '<p>Ciao,<b> {quotation_customers} </b>!</p>\r\n                            <p>Benvenuto nella nostra app per i tuoi dati di accesso <b> {app_name}</b> è <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL dell\'app    : </b>{app_url}</p>\r\n                            <p><b>Riferimento preventivo n   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Data di preventivo  : </b>{quotation_date}</p>\r\n                            <p>Grazie per esserti connesso con noi,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(44, 4, 'ja', 'Quotations Create', '<p>こんにちは,<b> {quotation_customers} </b>!</p>\r\n                            <p>私たちのアプリのyoreログインの詳細へようこそ <b> {app_name}</b> は <br></p>\r\n                            <p><b>Eメール   : </b>{customer_email}</p>\r\n                            <p><b>アプリのURL    : </b>{app_url}</p>\r\n                            <p><b>見積もり参照番号   : </b>{quotation_reference_no}</p>\r\n                            <p><b>見積もり日  : </b>{quotation_date}</p>\r\n                            <p>ご連絡ありがとうございます,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(45, 4, 'nl', 'Quotations Create', '<p>Hallo,<b> {quotation_customers} </b>!</p>\r\n                            <p>Welkom bij de inloggegevens van onze app voor: <b> {app_name}</b> is <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>App-URL    : </b>{app_url}</p>\r\n                            <p><b>Referentienummer offerte:   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Offertedatum:  : </b>{quotation_date}</p>\r\n                            <p>Bedankt voor het contact met ons,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(46, 4, 'pl', 'Quotations Create', '<p>Witam,<b> {quotation_customers} </b>!</p>\r\n                            <p>Witamy w naszej aplikacji yore dane logowania do <b> {app_name}</b> jest <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL aplikacji    : </b>{app_url}</p>\r\n                            <p><b>Numer referencyjny oferty  : </b>{quotation_reference_no}</p>\r\n                            <p><b>Data wyceny  : </b>{quotation_date}</p>\r\n                            <p>Dziękujemy za kontakt z nami,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(47, 4, 'ru', 'Quotations Create', '<p>Привет,<b> {quotation_customers} </b>!</p>\r\n                            <p>Добро пожаловать в наше приложение. <b> {app_name}</b> является <br></p>\r\n                            <p><b>Эл. адрес   : </b>{customer_email}</p>\r\n                            <p><b>URL приложения    : </b>{app_url}</p>\r\n                            <p><b>Цитата Номер ссылки   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Дата котировки  : </b>{quotation_date}</p>\r\n                            <p>Спасибо, что связались с нами,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(48, 4, 'pt', 'Quotations Create', '<p>Olá,<b> {quotation_customers} </b>!</p>\r\n                            <p>Bem-vindo ao nosso aplicativo antigo detalhe de login para <b> {app_name}</b> é <br></p>\r\n                            <p><b>E-mail   : </b>{customer_email}</p>\r\n                            <p><b>URL do aplicativo    : </b>{app_url}</p>\r\n                            <p><b>Nº de referência de cotação   : </b>{quotation_reference_no}</p>\r\n                            <p><b>Data de cotação  : </b>{quotation_date}</p>\r\n                            <p>Obrigado por conectar com a gente,</p>\r\n                            <p>{app_name}</p>', '2023-02-10 05:15:57', '2023-02-10 05:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `branch_id` tinyint NOT NULL DEFAULT '0',
  `category_id` int NOT NULL DEFAULT '0',
  `amount` double DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
CREATE TABLE IF NOT EXISTS `expense_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_page_sections`
--

DROP TABLE IF EXISTS `landing_page_sections`;
CREATE TABLE IF NOT EXISTS `landing_page_sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_order` int NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci,
  `section_type` enum('section-1','section-2','section-3','section-4','section-5','section-6','section-7','section-8','section-9','section-10','section-plan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_demo_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_blade_file_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2020_01_08_102946_create_permission_tables', 1),
(5, '2020_01_13_051013_create_branches_table', 1),
(6, '2020_01_13_060248_create_taxes_table', 1),
(7, '2020_01_13_110148_create_units_table', 1),
(8, '2020_01_13_122418_create_products_table', 1),
(9, '2020_01_13_123207_create_categories_table', 1),
(10, '2020_01_13_123233_create_brands_table', 1),
(11, '2020_01_17_164241_create_cash_registers_table', 1),
(12, '2020_01_18_105949_create_purchases_table', 1),
(13, '2020_01_22_154101_create_customers_table', 1),
(14, '2020_01_22_164831_create_vendors_table', 1),
(15, '2020_01_23_102832_create_sales_table', 1),
(16, '2020_01_24_122536_create_purchased_items_table', 1),
(17, '2020_01_24_124332_create_selled_items_table', 1),
(18, '2020_01_27_171128_create_settings_table', 1),
(19, '2020_02_05_094618_create_products_returns_table', 1),
(20, '2020_02_05_095819_create_returned_items_table', 1),
(21, '2020_02_12_114307_create_quotations_table', 1),
(22, '2020_02_12_140623_create_quotation_items_table', 1),
(23, '2020_02_14_163303_create_calendars_table', 1),
(24, '2020_02_15_122212_create_notifications_table', 1),
(25, '2020_02_19_160028_create_todos_table', 1),
(26, '2020_02_20_092128_create_expenses_table', 1),
(27, '2020_02_20_092204_create_expense_categories_table', 1),
(28, '2020_02_20_112609_create_branch_sales_targets_table', 1),
(29, '2020_02_20_113020_create_branch_target_lists_table', 1),
(30, '2020_07_28_110858_change_amount_fields', 1),
(31, '2020_08_18_113105_update_setting_table', 1),
(32, '2021_03_02_061833_add_mode_to_users', 1),
(33, '2021_07_30_070207_create_landing_page_sections_table', 1),
(34, '2021_10_19_070646_add_lastlogin_to_users_table', 1),
(35, '2022_07_20_045600_create_email_templates_table', 1),
(36, '2022_07_20_045843_create_email_template_langs_table', 1),
(37, '2022_07_20_045940_create_user_email_templates_table', 1),
(38, '2022_07_20_050734_add_user_type', 1),
(39, '2022_12_19_064339_create_product_vendor_mappings_table', 1),
(40, '2022_12_20_061313_create_vendor_orders_table', 1),
(41, '2022_12_22_070051_add_order_status_to_vendor_orders_table', 1),
(42, '2022_12_22_070238_add_order_status_to_sales_table', 1),
(43, '2022_12_22_080356_create_customer_order_timelines_table', 1),
(44, '2022_12_22_080445_create_vendor_order_timelines_table', 1),
(45, '2022_12_29_090115_add_password_to_customers_table', 1),
(46, '2022_12_31_094507_alter_table_products_add_subtitle', 1),
(47, '2022_12_31_102730_create_table_sites', 1),
(48, '2023_01_20_103910_update_sites_table_add_coordinates', 1),
(49, '2023_01_21_081224_add_site_id_to_sales_table', 1),
(50, '2023_01_23_070414_add_site_id_to_sites_table', 1),
(51, '2023_01_24_063625_add_famous_to_sites_table', 1),
(52, '2023_01_31_095147_add_image_to_category', 1),
(53, '2023_02_02_061518_add_status_to_sell_items', 1),
(54, '2023_02_08_054823_add_reset_token_customer', 1),
(55, '2023_03_02_054233_alter_table_products_add_urdu', 2),
(56, '2023_03_02_054431_alter_table_categories_add_urdu', 2),
(57, '2023_03_02_054510_alter_table_units_add_urdu', 2),
(58, '2023_03_02_054544_alter_table_brands_add_urdu', 2),
(59, '2023_04_13_051335_create_customer_ordered_product_timeline_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `color` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Edit Profile', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(2, 'Change Password', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(3, 'Manage User', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(4, 'Create User', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(5, 'Edit User', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(6, 'Delete User', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(7, 'Create Permission', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(8, 'Manage Permission', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(9, 'Delete Permission', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(10, 'Edit Permission', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(11, 'Create Role', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(12, 'Manage Role', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(13, 'Edit Role', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(14, 'Delete Role', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(15, 'System Settings', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(16, 'Manage Language', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(17, 'Create Language', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(18, 'Manage Profile', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(19, 'Delete Profile', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(20, 'Email Settings', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(21, 'Manage Logos', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(22, 'Manage Branch', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(23, 'Create Branch', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(24, 'Edit Branch', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(25, 'Delete Branch', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(26, 'Manage Tax', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(27, 'Create Tax', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(28, 'Edit Tax', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(29, 'Delete Tax', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(30, 'Manage Unit', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(31, 'Create Unit', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(32, 'Edit Unit', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(33, 'Delete Unit', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(34, 'Manage Product', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(35, 'Create Product', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(36, 'Edit Product', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(37, 'Delete Product', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(38, 'Manage Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(39, 'Create Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(40, 'Edit Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(41, 'Delete Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(42, 'Manage Brand', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(43, 'Create Brand', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(44, 'Edit Brand', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(45, 'Delete Brand', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(46, 'Manage Cash Register', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(47, 'Create Cash Register', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(48, 'Edit Cash Register', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(49, 'Delete Cash Register', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(50, 'Manage Purchases', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(51, 'Manage Sales', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(52, 'Manage Customer', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(53, 'Create Customer', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(54, 'Edit Customer', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(55, 'Delete Customer', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(56, 'Manage Vendor', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(57, 'Create Vendor', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(58, 'Edit Vendor', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(59, 'Delete Vendor', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(60, 'Billing Settings', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(61, 'Store Settings', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(62, 'Change Language', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(63, 'Manage Returns', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(64, 'Create Returns', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(65, 'Edit Returns', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(66, 'Delete Returns', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(67, 'Create Quotations', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(68, 'Manage Quotations', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(69, 'Edit Quotations', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(70, 'Delete Quotations', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(71, 'Manage Expense Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(72, 'Create Expense Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(73, 'Edit Expense Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(74, 'Delete Expense Category', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(75, 'Manage Expense', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(76, 'Create Expense', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(77, 'Edit Expense', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(78, 'Delete Expense', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(79, 'Manage Branch Sales Target', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(80, 'Create Branch Sales Target', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(81, 'Edit Branch Sales Target', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(82, 'Delete Branch Sales Target', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(83, 'Manage Calendar Event', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(84, 'Create Calendar Event', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(85, 'Edit Calendar Event', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(86, 'Delete Calendar Event', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(87, 'Manage Notification', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(88, 'Create Notification', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(89, 'Edit Notification', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(90, 'Delete Notification', 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` double DEFAULT '0',
  `sale_price` double DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL DEFAULT '0',
  `tax_id` int NOT NULL DEFAULT '0',
  `unit_id` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL DEFAULT '0',
  `brand_id` int NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` tinyint NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_value` int DEFAULT NULL,
  `moq` int DEFAULT NULL,
  `urdu_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urdu_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `purchase_price`, `sale_price`, `description`, `quantity`, `tax_id`, `unit_id`, `category_id`, `brand_id`, `image`, `product_type`, `created_by`, `created_at`, `updated_at`, `unit_value`, `moq`, `urdu_title`, `urdu_description`) VALUES
(1, 'Bestway cement', 'bestway-cement', '', 900, 1100, 'Bestway cement', 9999, 0, 1, 1, 0, NULL, 0, 1, '2023-02-13 02:31:59', '2023-02-13 02:31:59', 50, 5, NULL, NULL),
(2, 'Duluxe Paint', 'duluxe-paint', '', 0, 4500, 'Duluxe Paint', 9999, 0, 2, 0, 0, NULL, 0, 1, '2023-02-15 04:21:10', '2023-02-15 04:21:32', 5, 1, NULL, NULL),
(3, 'Tape', 'tape', '', 0, 120, 'Tape', 9999, 0, 1, 0, 0, NULL, 0, 1, '2023-02-16 01:56:43', '2023-03-02 00:58:59', 1, 1, 'ٹیپ', 'ٹیپ');

-- --------------------------------------------------------

--
-- Table structure for table `products_returns`
--

DROP TABLE IF EXISTS `products_returns`;
CREATE TABLE IF NOT EXISTS `products_returns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int NOT NULL DEFAULT '0',
  `customer_id` int NOT NULL DEFAULT '0',
  `return_note` text COLLATE utf8mb4_unicode_ci,
  `staff_note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_vendor_mappings`
--

DROP TABLE IF EXISTS `product_vendor_mappings`;
CREATE TABLE IF NOT EXISTS `product_vendor_mappings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_vendor_mappings`
--

INSERT INTO `product_vendor_mappings` (`id`, `product_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-02-13 02:36:01', '2023-02-13 02:36:01'),
(3, 2, 1, '2023-02-15 04:21:32', '2023-02-15 04:21:32'),
(6, 3, 2, '2023-03-02 00:58:59', '2023-03-02 00:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_items`
--

DROP TABLE IF EXISTS `purchased_items`;
CREATE TABLE IF NOT EXISTS `purchased_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `price` double DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `tax_id` int NOT NULL DEFAULT '0',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int NOT NULL DEFAULT '0',
  `branch_id` int NOT NULL DEFAULT '0',
  `cash_register_id` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
CREATE TABLE IF NOT EXISTS `quotations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int NOT NULL DEFAULT '0',
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

DROP TABLE IF EXISTS `quotation_items`;
CREATE TABLE IF NOT EXISTS `quotation_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `quotation_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `price` double DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `tax_id` int NOT NULL DEFAULT '0',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_items`
--

DROP TABLE IF EXISTS `returned_items`;
CREATE TABLE IF NOT EXISTS `returned_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `price` double DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `tax_id` int NOT NULL DEFAULT '0',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_by`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 0, 'web', '2023-02-10 05:15:55', '2023-02-10 05:15:55'),
(2, 'Employee', 1, 'web', '2023-02-10 05:15:56', '2023-02-10 05:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(60, 1),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(79, 2),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(83, 2),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int NOT NULL DEFAULT '0',
  `branch_id` int NOT NULL DEFAULT '0',
  `cash_register_id` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_status` int NOT NULL DEFAULT '0',
  `site_id` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_id`, `customer_id`, `branch_id`, `cash_register_id`, `status`, `created_by`, `created_at`, `updated_at`, `order_status`, `site_id`) VALUES
(1, '1', 0, 0, 0, 2, 1, '2023-02-13 02:32:11', '2023-02-13 02:32:11', 0, 0),
(2, '2', 0, 0, 0, 2, 1, '2023-02-15 04:20:30', '2023-02-15 04:20:30', 0, 0),
(3, '3', 0, 0, 0, 2, 1, '2023-02-15 04:21:42', '2023-04-13 00:12:17', 1, 0),
(4, '4', 0, 0, 0, 2, 1, '2023-02-16 01:57:16', '2023-04-13 00:12:05', 2, 0),
(5, '5', 0, 0, 0, 2, 1, '2023-04-13 00:32:50', '2023-04-13 00:32:50', 0, 0),
(6, '6', 0, 0, 0, 2, 1, '2023-04-13 00:33:23', '2023-04-13 00:33:23', 0, 0),
(7, '7', 0, 0, 0, 2, 1, '2023-04-13 00:34:09', '2023-04-13 00:34:09', 0, 0),
(8, '8', 0, 0, 0, 2, 1, '2023-04-13 00:35:23', '2023-04-13 00:36:39', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `selled_items`
--

DROP TABLE IF EXISTS `selled_items`;
CREATE TABLE IF NOT EXISTS `selled_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sell_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  `price` double DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `tax_id` int NOT NULL DEFAULT '0',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `selled_items`
--

INSERT INTO `selled_items` (`id`, `sell_id`, `product_id`, `price`, `quantity`, `tax_id`, `tax`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 1100, 3, 0, 0.00, '2023-02-13 02:32:11', '2023-02-13 02:32:11', 0),
(2, 2, 1, 1100, 3, 0, 0.00, '2023-02-15 04:20:30', '2023-02-15 04:20:30', 0),
(3, 3, 2, 4500, 5, 0, 0.00, '2023-02-15 04:21:42', '2023-02-15 04:21:42', 0),
(4, 4, 3, 120, 17, 0, 0.00, '2023-02-16 01:57:16', '2023-04-13 00:27:27', 2),
(5, 5, 1, 1100, 1, 0, 0.00, '2023-04-13 00:32:50', '2023-04-13 00:32:50', 0),
(6, 6, 1, 1100, 1, 0, 0.00, '2023-04-13 00:33:23', '2023-04-13 00:33:23', 0),
(7, 7, 1, 1100, 3, 0, 0.00, '2023-04-13 00:34:09', '2023-04-13 00:52:12', 2),
(8, 8, 3, 120, 3, 0, 0.00, '2023-04-13 00:35:23', '2023-04-13 00:36:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_created_by_unique` (`name`,`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'local_storage_validation', 'jpg,jpeg,png,xlsx,xls,csv,pdf', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(2, 'wasabi_storage_validation', 'jpg,jpeg,png,xlsx,xls,csv,pdf', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(3, 's3_storage_validation', 'jpg,jpeg,png,xlsx,xls,csv,pdf', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(4, 'local_storage_max_upload_size', '2048000', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(5, 'wasabi_max_upload_size', '2048000', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(6, 's3_max_upload_size', '2048000', 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(7, 'footer_text', 'dsf', 1, NULL, NULL),
(8, 'cookie_text', '', 1, NULL, NULL),
(9, 'cust_theme_bg', 'off', 1, NULL, NULL),
(10, 'cust_darklayout', 'off', 1, NULL, NULL),
(11, 'gdpr_cookie', 'off', 1, NULL, NULL),
(12, 'SITE_RTL', 'off', 1, NULL, NULL),
(13, 'color', 'theme-4', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `near` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_default` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

DROP TABLE IF EXISTS `todos`;
CREATE TABLE IF NOT EXISTS `todos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `urdu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `shortname`, `created_by`, `created_at`, `updated_at`, `urdu`) VALUES
(1, 'Kilogram', 'Kg', 1, '2023-02-13 02:31:29', '2023-03-02 00:51:21', 'کلوگرام'),
(2, 'Liter', 'lt', 1, '2023-02-15 04:21:19', '2023-03-02 00:51:11', 'لیٹر');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int NOT NULL DEFAULT '0',
  `cash_register_id` int NOT NULL DEFAULT '0',
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light',
  `is_active` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `email_verified_at`, `password`, `avatar`, `parent_id`, `type`, `branch_id`, `cash_register_id`, `lang`, `mode`, `is_active`, `remember_token`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 'owner', 'owner@example.com', NULL, NULL, '$2y$10$6CN0ihZ3/8oVaiRIXMXXxuaRUPGNeyXJsP1He8gar66r7dh5oSvBW', NULL, 0, 'Owner', 0, 0, 'en', 'light', 1, NULL, '2023-02-10 05:15:56', '2023-04-12 23:54:55', '2023-04-13 04:54:55'),
(2, 'admin', 'admin@gmail.com', NULL, NULL, '$2y$10$omXCaBtHgKVxBjIE..u0u.nYGbDsQA0er7Fux.7zVdyMI6VV0iwbe', NULL, 1, '', 1, 1, 'en', 'light', 1, NULL, '2023-04-12 23:55:40', '2023-04-13 03:35:46', '2023-04-13 08:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_email_templates`
--

DROP TABLE IF EXISTS `user_email_templates`;
CREATE TABLE IF NOT EXISTS `user_email_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `template_id` int NOT NULL,
  `user_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_email_templates`
--

INSERT INTO `user_email_templates` (`id`, `template_id`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(2, 2, 1, 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(3, 3, 1, 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57'),
(4, 4, 1, 1, '2023-02-10 05:15:57', '2023-02-10 05:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendors_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `phone_number`, `address`, `city`, `state`, `country`, `zipcode`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Ali trading', 'adsa@gmail.com', '3534534534', 'sdfsd', 'lkj', 'lkjl', 'kljsflskj', '', 1, 1, '2023-02-13 02:35:51', '2023-02-13 02:35:51'),
(2, 'Tapes Wala', 'sfdfsdfsd@gmail.com', '32432432432', '', '', '', '', '', 1, 1, '2023-02-16 01:56:14', '2023-02-16 01:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_orders`
--

DROP TABLE IF EXISTS `vendor_orders`;
CREATE TABLE IF NOT EXISTS `vendor_orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `product_id` int NOT NULL,
  `sale_id` int NOT NULL,
  `quantity` int NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_orders`
--

INSERT INTO `vendor_orders` (`id`, `vendor_id`, `product_id`, `sale_id`, `quantity`, `status`, `created_at`, `updated_at`, `order_status`) VALUES
(1, 1, 1, 1, 3, 'assigned', '2023-02-13 02:36:18', '2023-02-13 04:38:49', 2),
(2, 1, 2, 3, 5, 'assigned', '2023-02-16 01:17:30', '2023-04-13 00:10:27', 2),
(3, 1, 1, 2, 3, 'assigned', '2023-02-16 01:17:41', '2023-02-16 01:17:41', 0),
(4, 2, 3, 4, 17, 'assigned', '2023-02-16 01:57:30', '2023-02-16 01:57:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_order_timelines`
--

DROP TABLE IF EXISTS `vendor_order_timelines`;
CREATE TABLE IF NOT EXISTS `vendor_order_timelines` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `order_status` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_order_timelines`
--

INSERT INTO `vendor_order_timelines` (`id`, `order_id`, `order_status`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-02-13 04:38:46', '2023-02-13 04:38:46'),
(2, 1, 2, 1, '2023-02-13 04:38:49', '2023-02-13 04:38:49'),
(3, 2, 1, 2, '2023-04-13 00:10:15', '2023-04-13 00:10:15'),
(4, 2, 0, 2, '2023-04-13 00:10:20', '2023-04-13 00:10:20'),
(5, 2, 2, 2, '2023-04-13 00:10:27', '2023-04-13 00:10:27');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
