CREATE TABLE `email_verification`.`users` 
(`name` VARCHAR(100) NOT NULL , 
`email` VARCHAR(500) NOT NULL , 
`verification_code` VARCHAR(200) NOT NULL ) 
ENGINE = InnoDB;
