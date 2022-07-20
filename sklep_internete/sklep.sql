-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Sty 2022, 07:16
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `ilosc`) VALUES
(1, 'Koszulka', 445),
(2, 'Spodnie', 916),
(3, 'Buty', 49),
(4, 'Skiety', 879),
(5, 'Kurtka', 196),
(6, 'Czapka', 946),
(7, 'Koszulka w ślimaki', 0),
(8, 'Katana', 0),
(9, 'Skiety w ryby', 5800),
(10, 'Kurtka giga chad', 420),
(11, 'Buty ultrafast', 782);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `uzytkownik` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `produkt` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `kolor` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `rozmiar` text CHARACTER SET utf8 NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `uzytkownik`, `produkt`, `kolor`, `rozmiar`, `ilosc`) VALUES
(1, 'Błażejek', 'Czapka', 'blue', 'M', 5),
(2, 'SzybkaFoka51', 'Koszulka', 'red', 'M', 2),
(3, 'MiniKobra3', 'Buty', 'red', 'XL', 9),
(4, 'ślimak', 'Koszulka w ślimaki', 'yellow', 'L', 7),
(5, 'gigachad', 'Kurtka giga chad', 'blue', 'XL', 1),
(6, 'super', 'Skiety w ryby', 'blue', 'M', 19),
(7, 'super1', 'Spodnie', 'red', 'M', 1),
(8, 'super2', 'Buty', 'red', '0', 1),
(9, 'test', 'Koszulka w ślimaki', 'blue', 'S', 3),
(10, 'super', 'Koszulka w ślimaki', 'red', 'M', 1),
(11, 'super', 'Koszulka w ślimaki', 'red', 'M', -1),
(12, 'test', 'Koszulka w ślimaki', 'red', 'S', 1),
(13, 'test', 'Koszulka w ślimaki', 'red', 'S', -1),
(14, 'super', 'Koszulka w ślimaki', 'red', 'S', -1),
(15, '1', 'Koszulka w ślimaki', 'red', 'M', 1),
(16, 'f', 'Buty', 'red', 'M', 1),
(17, 'B', 'Koszulka', 'red', 'S', 3),
(18, '?', 'Spodnie', 'blue', 'S', 1),
(19, 'B', 'Koszulka', 'red', 'S', 3),
(20, '?', 'Spodnie', 'blue', 'S', 1),
(21, 'B', 'Koszulka', 'red', 'S', 3),
(22, '?', 'Spodnie', 'blue', 'S', 1),
(23, 'B', 'Koszulka', 'red', 'S', 3),
(24, '?', 'Spodnie', 'blue', 'S', 1),
(25, 'B', 'Koszulka', 'red', 'S', 3),
(26, '?', 'Spodnie', 'blue', 'S', 1),
(27, 'B', 'Koszulka', 'red', 'S', 3),
(28, '?', 'Spodnie', 'blue', 'S', 1),
(29, 'B', 'Koszulka', 'red', 'S', 3),
(30, '?', 'Spodnie', 'blue', 'S', 1),
(31, 'B', 'Koszulka', 'red', 'S', 3),
(32, '?', 'Spodnie', 'blue', 'S', 1),
(33, 'B', 'Koszulka', 'red', 'S', 3),
(34, '?', 'Spodnie', 'blue', 'S', 1),
(35, 'B', 'Koszulka', 'red', 'S', 3),
(36, '?', 'Spodnie', 'blue', 'S', 1),
(37, 'B', 'Koszulka', 'red', 'S', 3),
(38, '?', 'Spodnie', 'blue', 'S', 1),
(39, 'B', 'Koszulka', 'red', 'S', 3),
(40, '?', 'Spodnie', 'blue', 'S', 1),
(41, 'B', 'Koszulka', 'red', 'S', 3),
(42, '?', 'Spodnie', 'blue', 'S', 1),
(43, 'B', 'Koszulka', 'blue', 'S', 2),
(44, 'Błażejek', 'Koszulka', 'red', 'S', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
