// User class
class User {
    // Class variables
    #username;
    #firstName;
    #lastName;
    #type;
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
}
