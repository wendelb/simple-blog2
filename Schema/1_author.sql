--
-- Tabellenstruktur für Tabelle `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT 'Login-Name',
  `password` varchar(255) NOT NULL COMMENT 'BCrypt Password',
  `fullName` varchar(255) NOT NULL COMMENT 'Vollständiger Name',
  `address` text NOT NULL COMMENT 'Anschrift für Impressum',
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Autoren';

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;