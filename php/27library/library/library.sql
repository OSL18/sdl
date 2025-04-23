CREATE DATABASE library;

USE library;

-- Table for storing user information
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL
);

-- Table for storing book information
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(50),
    price DECIMAL(10, 2),
    description TEXT,
    image VARCHAR(255) -- URL for book cover image
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);


INSERT INTO books (title, author, genre, price, description, image) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 10.99, 'A novel about the American dream in the 1920s.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg/500px-The_Great_Gatsby_Cover_1925_Retouched.jpg'),
('To Kill a Mockingbird', 'Harper Lee', 'Fiction', 7.99, 'A novel about racial injustice in the Deep South.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg/500px-To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg'),
('1984', 'George Orwell', 'Dystopian', 8.99, 'A novel about a totalitarian society under constant surveillance.', 'https://upload.wikimedia.org/wikipedia/commons/5/51/1984_first_edition_cover.jpg');


-- Sample User (password is "admin123")
INSERT INTO users (username, email, password)
VALUES ('admin', 'admin@example.com', SHA2('admin123', 256));
