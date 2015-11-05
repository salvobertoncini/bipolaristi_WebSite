-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Nov 05, 2015 alle 20:51
-- Versione del server: 5.6.25
-- Versione PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bipolaristi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tb1_user`
--

CREATE TABLE IF NOT EXISTS `tb1_user` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `surname_user` varchar(255) NOT NULL,
  `username_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `bio_user` text NOT NULL,
  `id_image` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tb1_user`
--

INSERT INTO `tb1_user` (`id_user`, `name_user`, `surname_user`, `username_user`, `password_user`, `bio_user`, `id_image`) VALUES
(1, 'Salvo', 'Bertoncini', 'salvobertoncini@gmail.com', 'blink.182', 'Geek, Segretario di Messina Giovane http://messinagiovane.org  , volontario AISM. Interista.', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tb2_category`
--

CREATE TABLE IF NOT EXISTS `tb2_category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `bio_category` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tb2_category`
--

INSERT INTO `tb2_category` (`id_category`, `name_category`, `bio_category`) VALUES
(1, 'Attualit&agrave', 'Contezza dei fatti di attualità.'),
(2, 'Politica', 'Inquadrare il mondo che ci circonda.'),
(3, 'Tecnologia', 'Al passo coi tempi.'),
(4, 'Altro', 'Tutto. E niente.');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb3_post`
--

CREATE TABLE IF NOT EXISTS `tb3_post` (
  `id_post` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `article_post` text NOT NULL,
  `title_post` varchar(255) NOT NULL,
  `data_post` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tb3_post`
--

INSERT INTO `tb3_post` (`id_post`, `id_category`, `id_user`, `article_post`, `title_post`, `data_post`) VALUES
(1, 2, 1, '"Sono stato accoltellato da 26 nomi e cognomi ma da un unico mandante". La consiliatura &egrave finita e per Ignazio Marino &egrave giunto il momento di togliersi qualche sasso (anzi, qualche macigno) dalle scarpe. L''ormai ex sindaco, nella conferenza stampa che segue di poco le dimissioni di massa dei consiglieri comunali (19 del Pd più altri sette), non si lascia sfuggire l''occasione di puntare il dito sia contro il Nazareno, sia contro la sua ex maggioranza. Per entrambi, il messaggio &egrave: "Si può uccidere una squadra, ma non si possono fermare le idee". Ma la replica del premier Matteo Renzi &egrave lapidaria: "Marino non &egrave vittima di una congiura di palazzo, ma un sindaco che ha perso contatto con la sua città". "Con Renzi non ho nessun rapporto da un anno", precisa il chirurgo nell''affollata sala della Protomoteca, in Campidoglio. &Egrave l''unica volta che nomina il segretario del Pd, ma nessuno dubita che proprio a lui si riferisce quando indica il responsabile del suo "licenziamento". Il presidente del Consiglio per&ograve non &egrave l''unico bersaglio di Marino. Il partito democratico, sottolinea il chirurgo, "mi ha deluso per il comportamento dei suoi dirigenti, perch&egrave ha rinunciato ad agire dentro i confini della democrazia negando il suo stesso nome e il suo Dna". Osservazione accolta da un lunghissimo applauso dei sostenitori, fin dal pomeriggio saliti in piazza del Campidoglio con cartelli di protesta. Toni duri anche verso i consiglieri, che "hanno preferito sottomettersi e dimettersi invece di avere un confronto democratico". Così gli eletti hanno ridotto se stessi "a meri ratificatori di decisioni prese altrove".', 'Marino: "In 26 mi hanno accoltellato\r\nma il mandante &egrave unico". Renzi: "Nessuna congiura di palazzo"', '2015-10-29'),
(2, 4, 1, 'Il Pibe de Oro compie 55 anni: il 30 ottobre 1960 Diego Armando Maradona, considerato uno dei pi&ugrave grandi calciatori di tutti i tempi, nasce a Lanus, un quartiere di Buenos Aires. La sua carriera nel calcio professionistico inizia, giovanissimo, nell''Argentinos Juniors, per poi proseguire nel Boca Juniors. Le sue straordinarie capacit&agrave lo portano in nazionale a soli 16 anni, convocato dall''allora c.t. dell''Albiceleste Luis Cesar Menotti, anche se verr&agrave escluso dalla rosa dei Mondiali del 1978, non senza polemiche. Del resto, Diego non aveva neanche 18 anni.', 'Maradona, 55 anni da Pibe de Oro', '2015-10-27'),
(3, 1, 1, '"Non si tratta di smettere di mangiare carne". Il commissario europeo alla Salute e alla Sicurezza alimentare, Vytenis Andriukaitis, stempera le polemiche quattro giorni dopo la pubblicazione del rapporto dello Iarc, che ha inserito le carni lavorate tra gli agenti sicuramente cancerogeni per l''uomo e la carne rossa tra i probabili cancerogeni. Il documento dell''Agenzia internazionale per la ricerca sul cancro - ha detto Andriukaitis in conferenza stampa - non deve essere accolto con "isteria" ma come un''informazione in pi&ugrave, anche perch&egrave "la carne contiene componenti che sono necessarie per il nostro corpo, quello di cui si parla &egrave di non abusarne e di non dimenticare di mangiare frutta e verdura". Il commissario UE ha preso come esempio la dieta mediterranea, dicendo che "include anche carne rossa", ricordando che le abitudini sane devono includere anche smettere di fumare, consumare meno zuccheri e praticare sport.\r\nIarc: abbiamo solo identificato rischi\r\nPoche ore prima, era stato lo stesso Iarc di Lione, per bocca di Kurt Straif, a capo del Programma monografie, a ridimensionare il dibattito carne sì/carne no: "Il nostro annuncio - ha detto - non era allarmista, sono stati identificati dei rischi e il report finale, che sar&agrave disponibile a metà 2016, fornirà dati dettagliati dalla revisione degli studi, ma le conclusioni e il ragionamento alla base saranno gli stessi di quelli già riportati». «La comunicazione dello Iarc afferma esplicitamente che, sebbene dei rischi siano stati identificati, la grandezza di tali rischi è piccola se paragonata ad altri ben noti cancerogeni come il fumo di sigaretta" ha scandito Straif. Dunque la "nuova valutazione rafforza le raccomandazioni esistenti da parte delle autorità sanitarie di limitare il consumo di carni rosse e di carni lavorate". Queste includono, aggiunge, "una raccomandazione dell’Oms del 2002 di limitare l’assunzione di carni lavorate per ridurre il rischio di cancro del colon-retto". Lo Iarc, evidenzia Straif, "ha anche rilevato che la carne ha noti benefici nutrizionali, ma che i singoli possono scegliere di ridurre la propria assunzione di carne".', 'Oms: non bisogna eliminare\r\nla carne lavorata, solo ridurla', '2015-10-30');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb4_image`
--

CREATE TABLE IF NOT EXISTS `tb4_image` (
  `id_image` int(11) NOT NULL,
  `image_image` blob NOT NULL,
  `size_image` varchar(255) NOT NULL,
  `type_image` varchar(255) NOT NULL,
  `name_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tb1_user`
--
ALTER TABLE `tb1_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indici per le tabelle `tb2_category`
--
ALTER TABLE `tb2_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indici per le tabelle `tb3_post`
--
ALTER TABLE `tb3_post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indici per le tabelle `tb4_image`
--
ALTER TABLE `tb4_image`
  ADD PRIMARY KEY (`id_image`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tb1_user`
--
ALTER TABLE `tb1_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `tb2_category`
--
ALTER TABLE `tb2_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `tb3_post`
--
ALTER TABLE `tb3_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `tb4_image`
--
ALTER TABLE `tb4_image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
