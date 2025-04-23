CREATE DATABASE grocery_store;

USE grocery_store;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10,2),
    image VARCHAR(255)
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    quantity INT,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (name, price, image) VALUES
('Apple', 2.99, 'https://plus.unsplash.com/premium_photo-1661322640130-f6a1e2c36653?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YXBwbGV8ZW58MHx8MHx8fDA%3D.jpg'),
('Banana', 1.49, 'https://images.unsplash.com/photo-1647377502180-7604b5470dbe?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGJhbmFuYXxlbnwwfHwwfHx8MA%3D%3D.jpg'),
('Milk', 3.25, 'https://images.unsplash.com/photo-1635436338433-89747d0ca0ef?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8TUlsa3xlbnwwfHwwfHx8MA%3D%3D.jpg'),
('Bread', 2.50, 'https://images.unsplash.com/photo-1668887462299-a2693a3fbcee?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGJyZWFkfGVufDB8fDB8fHww.jpg'),
('Wwatermelom', 5, 'https://plus.unsplash.com/premium_photo-1674382739371-57254fd9a9e4?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8d2F0ZXJtZWxvbnxlbnwwfHwwfHx8MA%3D%3D.jpg');

