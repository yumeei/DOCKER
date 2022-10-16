CREATE TABLE `post` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` INT NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `post`
  MODIFY id INT NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;

ALTER TABLE `post`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;