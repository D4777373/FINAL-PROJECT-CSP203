 CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

 CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    doctor VARCHAR(255) NOT NULL,           -- Added doctor field
    appointment_date DATETIME NOT NULL,      -- Combined date and time in a DATETIME field
    appointment_time TIME NOT NULL,          -- Added appointment_time field (separate from date)
    message TEXT,                            -- Added message for additional information
    FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE prescriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    prescription_text TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL
);
