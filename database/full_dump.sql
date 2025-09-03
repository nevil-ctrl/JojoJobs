-- Создание таблицы пользователей

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,                             
  `login` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL, 
  `email` varchar(255) NOT NULL,                        
  `password` varchar(255) NOT NULL,                      
  `avatar` varchar(255) DEFAULT NULL                     
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Создание таблицы профиля пользователя

CREATE TABLE profiles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,                    
    full_name VARCHAR(150) NOT NULL,                  
    title VARCHAR(150) DEFAULT NULL,                  
    location VARCHAR(150) DEFAULT NULL,               
    status ENUM('open', 'closed') DEFAULT 'open',     
                  

    views INT DEFAULT 0,                              
    responses INT DEFAULT 0,                          
    interviews INT DEFAULT 0,                         

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_profiles_users FOREIGN KEY (user_id) 
        REFERENCES users(id) ON DELETE CASCADE
);

-- Создание таблицы категорий

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(155) NOT NULL
);

-- Создание таблицы вакансий

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    salary DECIMAL(10,2),
    company VARCHAR(255),
    location VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);