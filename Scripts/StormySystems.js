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
    // Register method
    register() {
        // Fetching the Username
        this.setUsername(document.getElementById("username").value);
        // Fetching the Mail Address
        this.setMailAddress(document.getElementById("mailAddress").value);
        // Fetching the First Name
        this.setFirstName(document.getElementById("firstName").value);
        // Fetching the Last Name
        this.setLastName(document.getElementById("lastName").value);
        // Fetching the Date Of Birth
        this.setDateOfBirth(document.getElementById("dateOfBirth").value);
        // Instantiating the User Object
        const userObject = new Object();
        // Filling User Object with data
        userObject.username = this.getUsername();
        userObject.mailAddress = this.getMailAddress();
        userObject.firstName = this.getFirstName();
        userObject.lastName = this.getLastName();
        userObject.dateOfBirth = this.getDateOfBirth();
        // Serializing User Data
        const userData = JSON.stringify(userObject);
        // Instantiating AJAX XML HTTP Request
        const XHR = new XMLHttpRequest();
        // Setting the POST Request
        XHR.open("POST", "../StormySystem.php", true);
        // Setting the Header
        XHR.setRequestHeader("Content-type", "application/json");
        // Sending the JSON
        XHR.send(userData);
    }
}
