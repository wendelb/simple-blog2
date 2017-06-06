
--
-- Tabellenstruktur für Tabelle `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article` int(11) NOT NULL COMMENT 'Fremdschlüssel auf Article.id',
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ip` varchar(46) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Kommentare';

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
