-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Cze 2022, 22:56
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
-- Baza danych: `szopracz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `user_email` text COLLATE utf8_polish_ci NOT NULL,
  `user_pass` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'admin@szopracz.pl', '123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoria_id` int(100) NOT NULL,
  `kategoria_nazwa` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`kategoria_id`, `kategoria_nazwa`) VALUES
(1, 'Bluzki'),
(2, 'Bluzy'),
(3, 'Jeansy'),
(5, 'Spodnie'),
(6, 'Spódnice'),
(7, 'Sukienki'),
(9, 'Swetry'),
(10, 'Szorty'),
(11, 'T-shirty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `qty` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`p_id`, `ip_add`, `qty`) VALUES
(6, '::1', 1),
(5, '::1', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `produkt_id` int(100) NOT NULL,
  `produkt_rodzaj` text COLLATE utf8_polish_ci NOT NULL,
  `produkt_kategoria` text COLLATE utf8_polish_ci NOT NULL,
  `produkt_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `produkt_cena` int(255) NOT NULL,
  `produkt_opis` text COLLATE utf8_polish_ci NOT NULL,
  `produkt_ilosc` int(255) NOT NULL,
  `produkt_rozmiar` text COLLATE utf8_polish_ci NOT NULL,
  `produkt_zdjecie` text COLLATE utf8_polish_ci NOT NULL,
  `produkt_skluczowe` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`produkt_id`, `produkt_rodzaj`, `produkt_kategoria`, `produkt_nazwa`, `produkt_cena`, `produkt_opis`, `produkt_ilosc`, `produkt_rozmiar`, `produkt_zdjecie`, `produkt_skluczowe`) VALUES
(1, '1', '1', 'Bluzka Falbanka', 80, 'Kolor:\r\nBrudny różowy\r\nStyl:\r\nBoho\r\nRodzaj Wzoru:\r\nProsty\r\nRodzaj:\r\nTop\r\nDekolt:\r\nZąbkowany\r\nSzczegóły:\r\nFalbanka\r\nDługość Rękawa:\r\nDługi Rękaw\r\nRodzaj Rękawa:\r\nRękaw z falbankami\r\nDługość:\r\nDługi\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nBody:\r\nNie\r\nOchraniacz na klatkę piersiową:\r\nBez Poduszek Naramiennych\r\nPrzezroczysty:\r\nNie', 22, 'M', 'z.png', 'bluzki, falbanka, równy, codzienny'),
(2, '1', '1', 'Sznurówka Kontrastowa', 65, 'Kolor:\r\nBiały\r\nStyl:\r\nCasual\r\nRodzaj Wzoru:\r\nOwoce i warzywa, Nadruk po całości\r\nRodzaj:\r\nTop\r\nDekolt:\r\nDekolt „V”\r\nSzczegóły:\r\nSznurówka kontrastująca\r\nDługość Rękawa:\r\nKrótki Rękaw\r\nRodzaj Rękawa:\r\nRękaw Motylkowy\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nPrzezroczysty:\r\nNie\r\n', 10, 'S', 'a.png', 'Bluzki, Sznurówka, Kontrastowa, Owoc, Warzywo, Codzienny'),
(3, '1', '1', 'Falbanka Pomarszczony', 100, 'Kolor:\r\nBiały\r\nStyl:\r\nBoho\r\nRodzaj Wzoru:\r\nProsty\r\nDekolt:\r\nKwadratowy Dekolt\r\nSzczegóły:\r\nFalbanka, Pomarszczony, Haft Oczkowy\r\nDługość Rękawa:\r\nKrótki Rękaw\r\nRodzaj Rękawa:\r\nBufiaste rękawy\r\nDługość:\r\nPrzycięcie\r\nPasujący Rodzaj:\r\nSlim fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce, nie czyścić chemicznie\r\nPrzezroczysty:\r\nNie\r\n', 5, 'L', 'B.png', 'Damskie, Bluzki, Falbanka, Pomarszczony, Haft, Oczkowy, Prosty, Boho'),
(4, '1', '1', 'Bluzka Guziki z przodu', 115, 'Kolor:\r\nCiemnozielony\r\nStyl:\r\nCasual\r\nRodzaj Wzoru:\r\nProsty\r\nRodzaj:\r\nKoszula\r\nDekolt:\r\nDekolt „V”\r\nSzczegóły:\r\nRozwarstwiony, Guziki z przodu\r\nDługość Rękawa:\r\nKrótki kimonowy rękaw\r\nRodzaj Rękawa:\r\nRękaw Motylkowy\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nPrzezroczysty:\r\nNie\r\n', 56, 'M', 'C.png', 'Damskie, Bluzki, Guziki z przodu, Prosty, Casual'),
(5, '1', '1', 'Bluzka Sznurówka', 50, 'Kolor:\r\nCzarne\r\nStyl:\r\nBoho\r\nRodzaj Wzoru:\r\nKolorowe bloki\r\nRodzaj:\r\nTop\r\nDekolt:\r\nDekolt „V”\r\nSzczegóły:\r\nSznurówka kontrastująca\r\nDługość Rękawa:\r\nKrótki Rękaw\r\nRodzaj Rękawa:\r\nStandardowa długość rękawa\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nPrzezroczysty:\r\nNie', 11, 'XS', 'D.png', 'Damskie, Bluzki, Sznurówka, kontrastująca, Kolorowe, bloki, Boho'),
(6, '1', '1', 'Sznurówka Kopertowe', 25, 'Kolor:\r\nBiały\r\nStyl:\r\nCasual\r\nRodzaj Wzoru:\r\nProsty\r\nRodzaj:\r\nTop\r\nDekolt:\r\nDekolt „V”\r\nSzczegóły:\r\nSznurówka kontrastująca, Kopertowe\r\nDługość Rękawa:\r\nRękaw na 3/4\r\nRodzaj Rękawa:\r\nRękaw luźny opadający\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nPrzezroczysty:\r\nPółprzezroczyste\r\n', 65, 'M', 'E.png', 'Damskie, Bluzki, Sznurówka, kontrastująca, Kopertowe, Prosty, Casual'),
(7, '1', '1', 'Sznurówka Siateczka', 250, 'Kolor:\r\nJasnoniebieski\r\nStyl:\r\nBoho\r\nRodzaj Wzoru:\r\nProsty\r\nRodzaj:\r\nTop\r\nDekolt:\r\nDekolt „V”\r\nSzczegóły:\r\nHaft, Sznurówka kontrastująca, Siateczka kontrastująca, Guziki z przodu\r\nDługość Rękawa:\r\nKrótki Rękaw\r\nRodzaj Rękawa:\r\nStandardowa długość rękawa\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nPrzezroczysty:\r\nNie', 2, 'S', 'f.png', 'Damskie, Bluzki, Sznurówka, kontrastująca, Siateczka, kontrastująca, Haft, Guziki z przodu, Prosty, Casual'),
(8, '1', '1', 'Zmarszczony Cały', 125, 'Kolor:\r\nCzarne i Białe\r\nStyl:\r\nCasual\r\nRodzaj Wzoru:\r\nNadruk po całości\r\nRodzaj:\r\nTop\r\nDekolt:\r\nGłębokie wcięcie\r\nSzczegóły:\r\nPomarszczony\r\nDługość Rękawa:\r\nDługi Rękaw\r\nRodzaj Rękawa:\r\nRękaw z falbankami\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nPoliester\r\nSkład:\r\n100% Poliester\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nBody:\r\nBez podszewki\r\nOchraniacz na klatkę piersiową:\r\nBez Poduszek Naramiennych\r\nPrzezroczysty:\r\nNie', 6, 'L', 'g.png', 'Damskie, Bluzki, Zmarszczony, Cały, Nadruk, Codzienny'),
(9, '1', '1', 'Top z koronką', 45, 'Kolor:\r\nBiały\r\nStyl:\r\nBoho\r\nRodzaj Wzoru:\r\nProsty\r\nRodzaj:\r\nTop\r\nDekolt:\r\nOkrągły Dekolt\r\nSzczegóły:\r\nSznurówka kontrastująca, Guziki\r\nDługość Rękawa:\r\nKrótki kimonowy rękaw\r\nRodzaj Rękawa:\r\nRękaw Motylkowy\r\nDługość:\r\nRegular\r\nPasujący Rodzaj:\r\nRegular fit\r\nTkanina:\r\nNierozciągliwe\r\nMateriał:\r\nBawełna\r\nSkład:\r\n100% Bawełna\r\nInstrukcja dotycząca pielęgnacji:\r\nPrać w pralce lub w profesjonalnej pralni chemicznej\r\nPrzezroczysty:\r\nNie', 100, 'M', 'h.png', 'Top, z koronką, z wycięciem na plecach');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj`
--

CREATE TABLE `rodzaj` (
  `rodzaj_id` int(100) NOT NULL,
  `rodzaj_nazwa` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rodzaj`
--

INSERT INTO `rodzaj` (`rodzaj_id`, `rodzaj_nazwa`) VALUES
(1, 'Kobieta'),
(2, 'Mężczyzna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `uzytkownik_id` int(11) NOT NULL,
  `uzytkownik_ip` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_email` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_pass` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_kodp` text COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_miasto` text COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_adres` text COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_numer` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik_zdjecie` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `zamowienie_id` int(11) NOT NULL,
  `zamowienie_prod` text COLLATE utf8_polish_ci NOT NULL,
  `ip` text COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `kwota` text COLLATE utf8_polish_ci NOT NULL,
  `produkt` text COLLATE utf8_polish_ci NOT NULL,
  `status` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`produkt_id`);

--
-- Indeksy dla tabeli `rodzaj`
--
ALTER TABLE `rodzaj`
  ADD PRIMARY KEY (`rodzaj_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`uzytkownik_id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`zamowienie_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoria_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `produkt_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `rodzaj`
--
ALTER TABLE `rodzaj`
  MODIFY `rodzaj_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `uzytkownik_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `zamowienie_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
