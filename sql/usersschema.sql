CREATE TABLE
    `myblogdb`.`users`
    (`id` INT AUTO_INCREMENT ,
     `usename` VARCHAR(50) NOT NULL ,
     `email` VARCHAR(100) NOT NULL ,
     `password_hash` VARCHAR(255) NOT NULL ,
     `role` ENUM('user','admin','moderator') DEFAULT 'user' ,
     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`),
    UNIQUE (`usename`),
    UNIQUE (`email`)
    );

