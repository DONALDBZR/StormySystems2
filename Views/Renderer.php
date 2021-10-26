<?php
// Renderer Class
class Renderer {
    // User Register Username Exists method
    public function userRegisterUsernameExists() {
        return "You already have an account on the system!  You will be redirected to the login page!";
    }
    // User Register Too Young method
    public function userRegisterTooYoung() {
        return "You are too young to use this system.  Please come back when you are older!";
    }
    // User Register Success method
    public function userRegisterSuccess() {
        return "You have been registered into the system, you will be redirected to the login page.";
    }
    // User Register Form Wrongly Filled method
    public function userRegisterFormWronglyFilled() {
        return "The form is not filled correctly!";
    }
    // User Login User Does Not Exist method
    public function userLoginUserDoesNotExist($user) {
        return "{$user} does not exist!";
    }
    // User Login Incorrect Password method
    public function userLoginIncorrectPassword() {
        return "Incorrect Password!";
    }
    // User Login Form Wrongly Filled method
    public function userLoginFormWronglyFilled() {
        return "The form is not filled correctly!";
    }
    // User Check Session Banned User method
    public function userCheckSessionBannedUser() {
        return "You have been banned!  Please consider into contacting an administrator!";
    }
    // User Check Session Cannot Verify Type method
    public function userCheckSessionCannotVerifyType() {
        return "There is an issue with the system.  Please try again later!";
    }
    // User Check Session User Does Not Exist method
    public function userCheckSessionUserDoesNotExist($user) {
        return "{$user} does not exist!";
    }
    // User Reset Password Password Changed method
    public function userResetPasswordPasswordChanged() {
        return "Your password has been changed!";
    }
}
?>