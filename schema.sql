
# Users
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  email TEXT NOT NULL,
  password_digest TEXT NOT NULL,
  balance DECIMAL(10,2)
) 
  AUTO_INCREMENT = 1, 
  ENGINE = innodb;

# Customers 
CREATE TABLE customer_attrs (
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
                                              ON UPDATE CASCADE
);

# Executors 
CREATE TABLE executor_attrs (
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
                                              ON UPDATE CASCADE
);

#Orders
CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  short_description TEXT NOT NULL,
  full_description TEXT,
  until DATETIME,
  cost DECIMAL(10,2),
  created_by INT,
  executed_by INT,

  FOREIGN KEY (created_by) REFERENCES users (id)  ON DELETE SET NULL
                                                  ON UPDATE CASCADE,
  FOREIGN KEY (executed_by) REFERENCES users (id) ON DELETE SET NULL
                                                  ON UPDATE CASCADE
) 
  AUTO_INCREMENT = 1, 
  ENGINE = innodb;
