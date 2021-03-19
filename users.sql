CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `firstname` varchar(255)  NOT NULL,
  `lastname` varchar(255)  NOT NULL,
  `user_email` varchar(255)  NOT NULL,
  `user_password` varchar(255)  NOT NULL,
  `reset_link_token` varchar(255) DEFAULT NULL,
  `exp_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

  