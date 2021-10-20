-- Creating the Database
CREATE DATABASE StormySystem;
-- Creating the User table
CREATE TABLE StormySystem.User (
    UserUsername VARCHAR(64) NOT NULL PRIMARY KEY,
    UserMailAddress VARCHAR(64) NOT NULL,
    UserPassword VARCHAR(64) NOT NULL,
    UserType INT,
    UserProfilePicture VARCHAR(128),
    UserFirstName VARCHAR(64) NOT NULL,
    UserLastName VARCHAR(64) NOT NULL,
    UserDateOfBirth VARCHAR(16) NOT NULL
);
-- Creating Login table
CREATE TABLE StormySystem.Login (
    LoginId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    LoginUser VARCHAR(64) NOT NULL,
    LoginDate VARCHAR(32) NOT NULL,
    CONSTRAINT fkLoginUserUserUsername FOREIGN KEY (LoginUser) REFERENCES StormySystem.User (UserUsername)
);
-- TESTING CODE 1: Removing data from the User table
DELETE FROM StormySystem.User WHERE UserMailAddress = "andygaspard@hotmail.com";
-- TESTING CODE 2: Selecting all data from the User table
SELECT * FROM StormySystem.User;
-- TESTING CODE 3: Selecting all data from the Login table
SELECT * FROM StormySystem.Login;
-- TESTING CODE 4: Removing data from the Login table
DELETE FROM StormySystem.Login WHERE LoginUser = "Darkness4869";
-- TESTING CODE 5: Deleting the Login Table
DROP TABLE StormySystem.Login;