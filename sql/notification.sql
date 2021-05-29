SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `konu` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `mesaj` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `notif` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
