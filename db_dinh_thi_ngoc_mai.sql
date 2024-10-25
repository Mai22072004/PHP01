-- Tạo cơ sở dữ liệu
-- Tạo cơ sở dữ liệu
CREATE DATABASE db_dinh_thi_ngoc_mai;
USE db_dinh_thi_ngoc_mai;

-- Tạo bảng chứa các thuộc tính
CREATE TABLE Course (
    Id int AUTO_INCREMENT primary key,
    Title varchar(255) UNIQUE,
    Description text,
    ImageURL varchar(255)
   );