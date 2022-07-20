-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Maj 2022, 07:44
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 7.4.27

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
-- Struktura tabeli dla tabeli `firma`
--

CREATE TABLE `firma` (
  `ID` int(11) NOT NULL,
  `firma_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `miejsce` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `firma`
--

INSERT INTO `firma` (`ID`, `firma_nazwa`, `miejsce`) VALUES
(1, 'Piekarnia Pawełek', 'Legionów 66, 05-200 Wołomin'),
(2, 'ONEMilli', 'Parkowa 14, 86-302 Grudziądz'),
(3, 'JingleJangle', 'Józefa Wybickiego 10, 64-730 Wieleń'),
(4, 'KSF', 'Szembruk 39, 86-318 Szembruk'),
(5, 'Pinex', 'Opoczyńska 31, 97-330 Sulejów'),
(6, 'Microsoft', 'Szczaniec 39, 66-225 Szczaniec'),
(7, 'Chupa Chups', 'plac Zamkowy 3A, 64-130 Rydzyna'),
(8, 'Wydma', 'Kamrowa 5A, 81-603 Gdynia'),
(9, 'Dredziasta Małpa', 'Brudna 6, 05-120 Legionowo'),
(10, 'Halibut', 'Generała Jarosława Dąbrowskiego, 35-001 Rzeszów');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ostatnio_dodane`
--

CREATE TABLE `ostatnio_dodane` (
  `ID` int(11) NOT NULL,
  `ID_dodania` int(11) NOT NULL,
  `ID_rzeczy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ostatnio_dodane`
--

INSERT INTO `ostatnio_dodane` (`ID`, `ID_dodania`, `ID_rzeczy`) VALUES
(1, 0, 6),
(2, 2, 4),
(3, 0, 4),
(4, 0, 5),
(5, 1, 7),
(6, 2, 5),
(7, 1, 8),
(8, 0, 6),
(9, 0, 7),
(10, 2, 6),
(11, 2, 7),
(12, 2, 8),
(13, 0, 8),
(14, 1, 9),
(15, 0, 9),
(16, 0, 10),
(17, 1, 10),
(18, 2, 9),
(19, 2, 10),
(20, 2, 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `ID` int(11) NOT NULL,
  `KOD` varchar(6) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`ID`, `KOD`) VALUES
(1, '499152'),
(2, '411383'),
(3, '302111'),
(4, '513212'),
(5, '971313'),
(6, '571609'),
(7, '803358'),
(9, '934877'),
(10, '377053'),
(11, '062795');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_szczegoly`
--

CREATE TABLE `produkty_szczegoly` (
  `KOD` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `produkt_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` float NOT NULL,
  `firma_ID` int(11) NOT NULL,
  `sklep_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty_szczegoly`
--

INSERT INTO `produkty_szczegoly` (`KOD`, `produkt_nazwa`, `ilosc`, `cena`, `firma_ID`, `sklep_ID`) VALUES
('062795', 'Grzebień', 532, 5.51, 5, 6),
('302111', 'Zabawki', 3, 7, 2, 3),
('377053', 'Truskawka', 1, 40, 10, 10),
('411383', 'Kamera', 1, 69000, 8, 9),
('499152', 'Kajzerka', 125, 0.5, 1, 1),
('513212', 'Kajak', 499, 120, 3, 1),
('571609', 'Sztanga', 3, 300, 8, 7),
('803358', 'Cukierki', 15415, 15.5, 3, 2),
('934877', 'Mikrofon', 13, 420.69, 9, 8),
('971313', 'Kwaśny Lizak', 6326, 0.7, 7, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sklep`
--

CREATE TABLE `sklep` (
  `ID` int(11) NOT NULL,
  `sklep_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `miejsce` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sklep`
--

INSERT INTO `sklep` (`ID`, `sklep_nazwa`, `miejsce`) VALUES
(1, 'Atlantyda', 'Henryka Sucharskiego 2, 82-200 Malbork	'),
(2, 'Umamy', 'Warzyn 9, 88-140 Warzyn'),
(3, 'MF', 'Kupno 23, 87-337 Kupno'),
(4, 'Papaj', 'Papieska 21/37, 34-100 Wadowice'),
(5, 'Fartan', 'Wierzawice 119, 37-300 Wierzawice'),
(6, 'Pazdan Store', 'Łysa 14, 62-600 Koło'),
(7, 'Pakmil', 'Daleka 117, 82-200 Malbork'),
(8, 'Drake', 'Zamkowa, 11-600 Węgorzewo'),
(9, 'ParamaxilMilions JNC.', 'Bankowa 5, 09-140 Kraśniewo'),
(10, 'YellowBananaFactory', 'Strzelińska 1, 55-020 Węgry');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `ostatnio_dodane`
--
ALTER TABLE `ostatnio_dodane`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `produkty_szczegoly`
--
ALTER TABLE `produkty_szczegoly`
  ADD PRIMARY KEY (`KOD`);

--
-- Indeksy dla tabeli `sklep`
--
ALTER TABLE `sklep`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `firma`
--
ALTER TABLE `firma`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `ostatnio_dodane`
--
ALTER TABLE `ostatnio_dodane`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `sklep`
--
ALTER TABLE `sklep`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
