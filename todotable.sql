

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `task` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;


INSERT INTO `todo` (`id`, `task`, `created`, `modified`) VALUES
(1, 'task to do', '2022-06-01 01:12:26', '2022-05-31 17:42:26'),
(2, 'task to do',  '2022-06-01 01:12:26', '2022-05-31 17:42:26'),
(3, 'task to do',  '2022-06-01 01:12:26', '2022-05-31 17:42:26'),
(6, 'task to do',  '2022-06-01 01:12:26', '2022-05-31 02:42:21'),
(7, 'task to do',  '2022-06-01 01:13:45', '2022-05-31 02:43:39'),
(8, 'task to do',  '2022-06-01 01:14:13', '2022-05-31 02:44:08'),
(9, 'task to do',  '2022-06-01 01:18:36', '2022-05-31 02:48:31'),
(10, 'task to do',  '2022-06-06 17:10:01', '2022-06-05 18:39:51'),
(11, 'task to do', '2022-06-06 17:11:04', '2022-06-05 18:40:54'),
(12, 'task to do', '2022-06-06 17:12:21', '2022-06-05 18:42:11'),
(13, 'task to do', '2022-06-06 17:12:59', '2022-06-05 18:42:49');



ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

