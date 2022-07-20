-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lut 2022, 14:59
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
-- Baza danych: `baza_sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `zdj` text NOT NULL,
  `text` text NOT NULL,
  `kategoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `zdj`, `text`, `kategoria`) VALUES
(2, 'spodnie', 'spodnie.jpg', 'spodnie ultra fast', 'odziez'),
(3, 'bluza', 'bluza.jpg', 'bluza klasy szerokiej', 'odziez'),
(4, 'czapa', 'czapka_w_ryby.jpg', 'Superancka Czapa w Ryby', 'odziez'),
(5, 'pilka', 'pilka.jpg', 'okrągła piłka', 'sprzet'),
(6, 'Rekawice', 'Rekawice.jpg', 'Rękawice', 'sprzet'),
(7, 'buty', 'buty.jpg', 'Buty do biegania', 'obowie'),
(8, 'kreativa', 'keratyna.jpg', 'kreativa', 'odzywianie'),
(9, 'propionate', 'propionate.jpg', 'przedtreningówka', 'odzywianie'),
(10, 'izotonik', 'izotonik.jpg', 'czujesz że żyjesz', 'odzywianie'),
(11, 'kulki_mocy', 'kulkamocy.jpg', 'proteinowe kulki mocy anny lewandowskiej', 'odzywianie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `nazwa` text NOT NULL,
  `uprawnienia` int(11) NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`nazwa`, `uprawnienia`, `haslo`) VALUES
('admin', 1, 'admin'),
('Bedi', 0, '123'),
('mati', 1, '123123'),
('super', 0, 'super'),
('test', 0, '123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `adres` text NOT NULL,
  `miasto` text NOT NULL,
  `kod-pocztowy` text NOT NULL,
  `email` text NOT NULL,
  `produkty_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `imie`, `nazwisko`, `adres`, `miasto`, `kod-pocztowy`, `email`, `produkty_id`) VALUES
(1, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '9'),
(2, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(3, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(4, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(5, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '11'),
(6, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(7, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '21'),
(8, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(9, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(10, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '4511'),
(11, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(12, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '45'),
(13, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(14, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '4,5,6,'),
(15, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(16, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '4,5,'),
(17, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', ''),
(18, 'Mati', 'Super', 'Super 23', 'Garnowo', '12-231', 'super.email@gmail.com', '4,5,');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`nazwa`(20));

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
