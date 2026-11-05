-- Runs automatically the first time the database starts.
CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

INSERT INTO students (name) VALUES ('Alice'), ('Bob'), ('Charlie');

CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  author VARCHAR(100) NOT NULL
);

INSERT INTO books (title, author) VALUES
  ('Dune', 'Frank Herbert'),
  ('1984', 'George Orwell');
