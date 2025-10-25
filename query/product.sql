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
-- Struttura della tabella `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `disponibile` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `product`
--

INSERT INTO `product` (`id`, `nome`, `descrizione`, `prezzo`, `disponibile`, `created_at`) VALUES
(1, 'Prodotto A', 'Descrizione del prodotto A', '19.99', 1, '2025-10-21 19:10:17'),
(2, 'Prodotto B', 'Descrizione del prodotto B', '29.50', 1, '2025-10-21 19:10:17'),
(3, 'Prodotto C', 'Descrizione del prodotto C', '9.99', 1, '2025-10-21 19:10:17'),
(4, 'Prodotto D', 'Descrizione del prodotto D', '49.00', 1, '2025-10-21 19:10:17'),
(5, 'Prodotto E', 'Descrizione del prodotto E', '5.75', 1, '2025-10-21 19:10:17'),
(6, 'Prodotto F', 'Descrizione del prodotto F', '99.99', 1, '2025-10-21 19:10:17'),
(7, 'Prodotto G', 'Descrizione del prodotto G', '15.00', 1, '2025-10-21 19:10:17'),
(8, 'Prodotto H', 'Descrizione del prodotto H', '25.25', 1, '2025-10-21 19:10:17'),
(9, 'Prodotto I', 'Descrizione del prodotto I', '12.10', 1, '2025-10-21 19:10:17'),
(10, 'Prodotto J', 'Descrizione del prodotto J', '200.00', 0, '2025-10-21 19:10:17');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
