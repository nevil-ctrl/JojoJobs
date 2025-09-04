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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
