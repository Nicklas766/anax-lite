--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a testuser
--
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
USE nien16;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `pass` VARCHAR(100),
  `info` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

--
-- SELECT * FROM `users`;




--
-- SQL KOD FÖR UPPGIFT 1
--

INSERT into users (name, pass, authority) VALUES ('$user', '$pass', '$authority')

SELECT info, email, authority FROM users WHERE name='$user';
UPDATE users SET info = ?, email = ? WHERE name='$user';
UPDATE users SET pass='$pass' WHERE name='$user';
UPDATE users SET pass='$pass' WHERE id='$id';
SELECT * FROM users WHERE name='$user';
