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
  `email` VARCHAR(100) NOT NULL,
  `authority` VARCHAR(100) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

--


--
-- SQL KOD FÖR UPPGIFT 2
--


SELECT COUNT(id) FROM users;
DELETE FROM users WHERE id='$id';
SELECT * FROM users WHERE id='$id';
UPDATE users SET info = ?, email = ?, authority = ? WHERE id='$id';
SELECT * FROM users WHERE name LIKE '$search';
SELECT * FROM users ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;
