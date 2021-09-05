CREATE DATABASE StormySystem;
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
DELETE FROM StormySystem.User WHERE UserUsername = "username1";