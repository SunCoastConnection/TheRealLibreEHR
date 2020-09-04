
CREATE TABLE `timeclock` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('IN','OUT') NOT NULL,
  `edit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `timeclock`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `timeclock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



