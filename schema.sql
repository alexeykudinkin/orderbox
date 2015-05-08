
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

# Orders
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


# View
CREATE OR REPLACE
  ALGORITHM = TEMPTABLE
VIEW orders_mview (
  id,
  short_description,
  full_description,
  cost,
  email 
) AS SELECT orders.id                 AS order_id, 
            orders.short_description  AS order_short_description,
            orders.full_description   AS order_full_description,
            orders.cost               AS order_cost,
            users.email               AS order_created_by
  FROM orders JOIN users ON orders.created_by = users.id
  WHERE executed_by IS NULL ORDER BY orders.id DESC
