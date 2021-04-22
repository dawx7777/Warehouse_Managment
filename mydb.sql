-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Kwi 2021, 15:33
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `idKlient` int(10) UNSIGNED NOT NULL,
  `Imie` varchar(45) DEFAULT NULL,
  `Nazwisko` varchar(45) DEFAULT NULL,
  `dokument` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `magazyn`
--

CREATE TABLE `magazyn` (
  `idmagazyn` int(11) NOT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `adres` varchar(45) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `magazyn`
--

INSERT INTO `magazyn` (`idmagazyn`, `nazwa`, `adres`, `telefon`) VALUES
(1, 'Magazyn Okien i Drzwi', 'ul. Polowa 44', '527817917'),
(2, 'Magazyn Elektorniki', 'ul. Polowa 44/b', '647817917'),
(3, 'Magazyn Napojów', 'ul. Polowa 44/b', '657382831');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `idProfil` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `Imie` varchar(45) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `data_ur` date DEFAULT NULL,
  `stanowisko` enum('kierownik','magazynier') DEFAULT NULL,
  `magazyn_idmagazyn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pracownik`
--

INSERT INTO `pracownik` (`idProfil`, `email`, `haslo`, `Imie`, `nazwisko`, `data_ur`, `stanowisko`, `magazyn_idmagazyn`) VALUES
(12, 'kierownik2@gmail.com', '$2y$10$ucs8bIdBtw9DmIq80PmpmunEnC2hVI4PmjBNVKsMg96axnwRYKgEi', 'Kierownik1', 'Kier2', '2021-03-04', 'kierownik', 3),
(15, 'magazynier@gmail.com', '$2y$10$v/9aAVU58P.puFs7hzfHKeVPIxeB449o5Igq/PCfwk1baiaRNzN7O', 'Magazynier', 'Mag', '1984-10-16', 'magazynier', 2),
(16, 'kierownik@gmail.com', '$2y$10$/adVXRCcbU7Ln5ixRK1bzu0x/pV3KYplM96yH80BheUZiHuUXsIra', 'Kierownik', 'Kier', '1988-02-04', 'kierownik', 1),
(17, 'brttttt@hotmail.com', '$2y$10$xGYlIjh35S6qSiZcGxwrGemwSYv9qswKJU0zw3V/u1I8nA.P6b1O.', 'brt', 'brtttt', '1993-02-02', 'kierownik', 2),
(18, 'kierownik22@gmail.com', '$2y$10$tmJKoL44q2OSbEPHhOyq5.FzvOZdF1.v9JcWXRPXWLTE3iWVoJhrW', 'sasasa', 'sasa', '2021-04-14', 'kierownik', 1),
(19, 'kierownik222@gmail.com', '$2y$10$751LOcG8QlW7GhYyMsZI5.aeb0OTFGduLmTg/b0O8t8moRp3suPqu', 'gagag', 'hahahah', '2021-04-15', 'kierownik', 1),
(20, 'kierownik232@gmail.com', '$2y$10$SC/qvMKDtkFI.O9nxBotOuewJvtL1w3xph/3KRORivh1XCeXQLhby', 'sasasa', 'Zawiślan', '2021-04-02', 'kierownik', 2),
(21, 'wieclawekmaciej@gmail.com', '$2y$10$VfaHAfD6UHMrubRg9JvIpuAcVcQus1jB8VP3VO7pnAtR5XFv5YTBS', 'Maciej', 'Więcławek', '2021-04-02', 'kierownik', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt`
--

CREATE TABLE `produkt` (
  `idProdukt` int(11) NOT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `typ` varchar(45) DEFAULT NULL,
  `nr_indeksu` varchar(45) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `producent` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkt`
--

INSERT INTO `produkt` (`idProdukt`, `nazwa`, `typ`, `nr_indeksu`, `ilosc`, `producent`) VALUES
(42, 'Huawei P30', 'telefon', '45678', 12, 'Huawei'),
(43, 'Huawei P31', 'telefon', '45678', 12, 'Huawei'),
(44, 'Huawei P33', 'telefon', '45678', 12, 'Huawei'),
(45, 'Huawei P35', 'telefon', '45678', 12, 'Huawei'),
(46, 'Huawei P36', 'telefon', '45678', 12, 'Huawei'),
(47, 'Huawei P37', 'telefon', '45678', 12, 'Huawei'),
(48, 'Huawei P44', 'telefon', '57136', 2, 'Huawei'),
(49, 'ggfgf', 'telefon', '45678', 4, 'Huawei'),
(50, 'Huawei P45', 'telefon', '12345', 5, 'Huawei'),
(51, 'Huawei P46', 'telefon', '12356', 5, 'Huawei'),
(52, 'Huawei P40', 'telefon', '34532', 5, 'Huawei'),
(53, 'Huawei P48', 'telefon', '34532', 5, 'Huawei'),
(54, 'Huawei P4321', 'telefon', '11111', 4, 'Huawei'),
(55, 'Huawei P43244', 'telefon', '34567', 4, 'Huawei');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_klient`
--

CREATE TABLE `produkty_klient` (
  `idProdukty_klient` int(11) NOT NULL,
  `Nazwa_produktu` varchar(45) DEFAULT NULL,
  `Ilosc` varchar(45) DEFAULT NULL,
  `Klient_idKlient` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt_has_skladowanie`
--

CREATE TABLE `produkt_has_skladowanie` (
  `Produkt_idProdukt` int(11) NOT NULL,
  `Skladowanie_idSkladowanie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkt_has_skladowanie`
--

INSERT INTO `produkt_has_skladowanie` (`Produkt_idProdukt`, `Skladowanie_idSkladowanie`) VALUES
(42, 42),
(48, 48),
(51, 51),
(54, 54),
(55, 55);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skladowanie`
--

CREATE TABLE `skladowanie` (
  `idSkladowanie` int(11) NOT NULL,
  `rzad` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT NULL,
  `miejsce_poziom` enum('1','2','3','4') DEFAULT NULL,
  `miejsce_pion` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT NULL,
  `magazyn_idmagazyn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `skladowanie`
--

INSERT INTO `skladowanie` (`idSkladowanie`, `rzad`, `miejsce_poziom`, `miejsce_pion`, `magazyn_idmagazyn`) VALUES
(42, '3', '1', '1', 2),
(43, '1', '1', '1', 2),
(44, '1', '1', '1', 1),
(45, '1', '1', '1', 1),
(46, '1', '1', '1', 2),
(47, '1', '1', '1', 1),
(48, '4', '3', '8', 2),
(49, '1', '1', '1', 1),
(50, '4', '3', '1', 2),
(51, '10', '1', '1', 1),
(52, '1', '3', '4', 2),
(53, '1', '1', '1', 1),
(54, '1', '1', '1', 2),
(55, '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `towar_zakupiony`
--

CREATE TABLE `towar_zakupiony` (
  `idTowar_zakupiony` int(11) NOT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `ilosc_dostarczona` varchar(45) DEFAULT NULL,
  `dokument` varchar(45) DEFAULT NULL,
  `dostawca` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `towar_zakupiony_has_produkt`
--

CREATE TABLE `towar_zakupiony_has_produkt` (
  `Towar_zakupiony_idTowar_zakupiony` int(11) NOT NULL,
  `Produkt_idProdukt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`idKlient`);

--
-- Indeksy dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
  ADD PRIMARY KEY (`idmagazyn`);

--
-- Indeksy dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`idProfil`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`) USING BTREE,
  ADD KEY `fk_Pracownik_magazyn1_idx` (`magazyn_idmagazyn`);

--
-- Indeksy dla tabeli `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`idProdukt`);

--
-- Indeksy dla tabeli `produkty_klient`
--
ALTER TABLE `produkty_klient`
  ADD PRIMARY KEY (`idProdukty_klient`),
  ADD KEY `fk_Produkty_klient_Klient1_idx` (`Klient_idKlient`);

--
-- Indeksy dla tabeli `produkt_has_skladowanie`
--
ALTER TABLE `produkt_has_skladowanie`
  ADD KEY `fk_Produkt_has_Skladowanie_Skladowanie1_idx` (`Skladowanie_idSkladowanie`),
  ADD KEY `fk_Produkt_has_Skladowanie_Produkt_idx` (`Produkt_idProdukt`);

--
-- Indeksy dla tabeli `skladowanie`
--
ALTER TABLE `skladowanie`
  ADD PRIMARY KEY (`idSkladowanie`),
  ADD KEY `fk_Skladowanie_magazyn1_idx` (`magazyn_idmagazyn`);

--
-- Indeksy dla tabeli `towar_zakupiony`
--
ALTER TABLE `towar_zakupiony`
  ADD PRIMARY KEY (`idTowar_zakupiony`);

--
-- Indeksy dla tabeli `towar_zakupiony_has_produkt`
--
ALTER TABLE `towar_zakupiony_has_produkt`
  ADD PRIMARY KEY (`Towar_zakupiony_idTowar_zakupiony`,`Produkt_idProdukt`),
  ADD KEY `fk_Towar_zakupiony_has_Produkt_Produkt1_idx` (`Produkt_idProdukt`),
  ADD KEY `fk_Towar_zakupiony_has_Produkt_Towar_zakupiony1_idx` (`Towar_zakupiony_idTowar_zakupiony`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
  MODIFY `idmagazyn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `idProfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `produkt`
--
ALTER TABLE `produkt`
  MODIFY `idProdukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT dla tabeli `skladowanie`
--
ALTER TABLE `skladowanie`
  MODIFY `idSkladowanie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
