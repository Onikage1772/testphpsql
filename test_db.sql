CREATE DATABASE test_db;

USE test_db;

CREATE TABLE nguoidung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten VARCHAR(100) NOT NULL,
    gioitinh VARCHAR(10) NOT NULL,
    ngaysinh DATE NOT NULL
);
