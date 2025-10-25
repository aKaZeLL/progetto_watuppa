-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 23, 2025 alle 22:10
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watuppa_test`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantita` int(11) NOT NULL DEFAULT 1,
  `prezzo_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantita`, `prezzo_unitario`) VALUES
(1, 1, 2, '19.99'),
(1, 3, 1, '9.99'),
(2, 4, 1, '49.00'),
(2, 5, 3, '5.75'),
(3, 2, 1, '29.50'),
(3, 8, 2, '25.25'),
(3, 9, 1, '12.10'),
(4, 1, 1, '19.99'),
(4, 10, 1, '200.00'),
(5, 6, 2, '99.99'),
(5, 7, 1, '15.00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
