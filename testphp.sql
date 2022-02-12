START TRANSACTION;

CREATE TABLE posts
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL, 
    title VARCHAR(100) NOT NULL,
    body TEXT NOT NULL
);
 
CREATE TABLE comments
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    postId INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(64) NOT NULL UNIQUE,
    body TEXT NOT NULL,
    FOREIGN KEY (postId)  REFERENCES posts (id)
);

COMMIT;