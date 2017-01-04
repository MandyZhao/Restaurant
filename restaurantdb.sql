/* 
 * Student Info: Name=Xiaolei Zhao, ID=16117 
 * Subject: CS526A_HW3_Fall_2016 
 * Author: mandy
 * Filename: restaurantdb.sql
 * Date and Time: Nov 6, 2016 9:05:23 PM
 * Project Name: Xiaolei_16117_CS526A_HW3
 */


DROP DATABASE IF EXISTS restaurantdb;

CREATE DATABASE restaurantdb;

USE restaurantdb;
 
CREATE TABLE categories (
  categoryID       INT(11)        NOT NULL   AUTO_INCREMENT,
  categoryName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE foods (
  foodID           INT(11)        NOT NULL   AUTO_INCREMENT,
  categoryID      INT(11)        NOT NULL,
  foodName         VARCHAR(255)   NOT NULL,
  foodPrice        DECIMAL(10,2)  NOT NULL,
  imagePath         VARCHAR(255)    NOT NULL,
  PRIMARY KEY (foodID)
);


INSERT INTO categories VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Drink');


INSERT INTO foods VALUES
(1, 1, 'Bagel', '3.99','img/bagel.png'),
(2, 1, 'Sandwich', '3.29','img/sandwich.png'),
(3, 2, 'Pasta', '9.95','img/pasta.png'),
(4, 2, 'Burger', '4.99','img/burger.png'),
(5, 3, 'Pizza', '9.99','img/pizza.png'),
(6, 3, 'Beef', '13.99','img/beef.png'),
(7, 4, 'MilkTea', '2.99','img/milktea.png'),
(8, 4, 'Coffee', '3.49','img/coffee.png');


GRANT SELECT, INSERT, DELETE, UPDATE
ON restaurantdb.*
TO admin@localhost
IDENTIFIED BY 'pass@word';


GRANT SELECT
ON foods
TO peter@localhost
IDENTIFIED BY 'pass@word';
