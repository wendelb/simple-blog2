SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `blog`
--

--
-- Daten für Tabelle `article`
--

INSERT INTO `article` (`id`, `author`, `title`, `created`, `content`, `ip`) VALUES
(1, 1, 'This is the first post', '2017-05-09', 'This is a post', '127.0.0.1'),
(2, 2, 'This is the second post', '2017-05-01', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. \r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugia', '127.0.0.1'),
(3, 1, 'This is the first post', '2017-05-07', '<p>This is a post out of many</p>', '127.0.0.1'),
(4, 2, 'This is the second post', '2017-05-02', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. \r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugia', '127.0.0.1'),
(5, 1, 'Neuer Eintrag', '2017-05-25', '<p>Hallo <strong>Welt</strong></p>', '192.168.56.1');

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`id`, `username`, `password`, `fullName`, `address`, `email`) VALUES
(1, 'bernhard', '$2y$10$Gz.i3puGTEeH0lrDlOamyOGeGjKyESbDvhe0eBQYK7F9ki3H.O8yq', 'Bernhard Wendel', 'StraÃŸe 1\n12345 Ort 1', ''),
(2, 'autor', '$2y$10$6TFXhBYg81SUWJaoZ2SxZOyl5SnHSgNz2WM.Uw5ITgLFiIsgF.u2C', 'Name des Autors', 'StraÃŸe 2\n12345 Ort 2\n(Passwort: "Autor")', '');

--
-- Daten für Tabelle `comment`
--

INSERT INTO `comment` (`id`, `article`, `date`, `name`, `url`, `mail`, `ip`, `comment`) VALUES
(1, 4, '2017-05-16 00:00:00', 'abc', '', '', '192.168.56.1', 'ABCDEF'),
(2, 4, '2017-05-25 23:01:28', 'Name 2', 'http://www.google.de', '', '192.168.56.1', 'sadffsljvg <b>This is me</b>');
