// User class
class User {
    // Class variables
    #username;
    #firstName;
    #lastName;
    #type;
    #mailAddress;
    #dateOfBirth;
    #profilePicture;
    #password;
    domain = "http://stormysystem.ddns.net/";
    // Constructor method
    constructor() {}
    // Username accesor method
    getUsername() {
        return this.#username;
    }
    // Username mutator method
    setUsername(username) {
        this.#username = username;
    }
    // First Name accesor method
    getFirstName() {
        return this.#firstName;
    }
    // First Name mutator method
    setFirstName(firstName) {
        this.#firstName = firstName;
    }
    // Last Name accesor method
    getLastName() {
        return this.#lastName;
    }
    // Last Name mutator method
    setLastName(lastName) {
        this.#lastName = lastName;
    }
    // Type accesor method
    getType() {
        return this.#type;
    }
    // Type mutator method
    setType(type) {
        this.#type = type;
    }
    // Date of Birth accesor method
    getDateOfBirth() {
        return this.#dateOfBirth;
    }
    // Date of Birth mutator method
    setDateOfBirth(dateOfBirth) {
        this.#dateOfBirth = dateOfBirth;
    }
    // Profile Picture accesor method
    getProfilePicture() {
        return this.#profilePicture;
    }
    // Profile Picture mutator method
    setProfilePicture(profilePicture) {
        this.#profilePicture = profilePicture;
    }
    // Password accesor method
    getPassword() {
        return this.#password;
    }
    // Password mutator method
    setPassword(password) {
        this.#password = password;
    }
    // Mail Address accessor method
    getMailAddress() {
        return this.#mailAddress;
    }
    // Mail Address mutator method
    setMailAddress(mailAddress) {
        this.#mailAddress = mailAddress;
    }
    // Register Asynchronuous method
    async register() {
        // Data retrieved from the form.
        const data = {
            username: document.getElementById("username").value,
            mailAddress: document.getElementById("mailAddress").value,
            firstName: document.getElementById("firstName").value,
            lastName: document.getElementById("lastName").value,
            dateOfBirth: document.getElementById("dateOfBirth").value,
        };
        // Calling AJAX to call $User::register() from StormySystem.php
        $.ajax({
            url: "./index.php",
            type: "POST",
            header: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            data: JSON.stringify(data),
        });
    }
}
