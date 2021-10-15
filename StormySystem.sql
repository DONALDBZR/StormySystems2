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
-- TESTING CODE 1: Removing data from the User table
DELETE FROM StormySystem.User WHERE UserMailAddress = "andygaspard@hotmail.com";
-- TESTING CODE 2: Selecting all data from the User table
SELECT * FROM StormySystem.User;