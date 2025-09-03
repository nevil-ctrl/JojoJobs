CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,                      
  `login` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL, -- логин
  `email` varchar(255) NOT NULL,                         
  `password` varchar(255) NOT NULL,                    
  `avatar` varchar(255) DEFAULT NULL                   \
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
