
--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL COMMENT 'Fremdschlüssel auf author.id',
  `title` varchar(255) NOT NULL COMMENT 'Titel',
  `created` date NOT NULL COMMENT 'Erstellungsdatum',
  `content` text NOT NULL COMMENT 'Der Inhalt',
  `ip` varchar(46) NOT NULL COMMENT 'IP-Adresse des Erstellers'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Artikel';

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
