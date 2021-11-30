// User class
class User {
    // Constructor method
    constructor(
        username,
        firstName,
        lastName,
        mailAddress,
        type,
        dateOfBirth,
        profilePicture,
        password,
        domain = "http://stormysystem.ddns.net"
    ) {
        this.username = username;
        this.firstName = firstName;
        this.lastName = lastName;
        this.mailAddress = mailAddress;
        this.type = type;
        this.dateOfBirth = dateOfBirth;
        this.profilePicture = profilePicture;
        this.password = password;
        this.domain = domain;
        this.render = new Render();
        this.request = new Redirector();
    }
    // Username accessor method
    getUsername() {
        return this.username;
    }
    // Username mutator method
    setUsername(username) {
        this.username = username;
    }
    // First Name accessor method
    getFirstName() {
        return this.firstName;
    }
    // First Name mutator method
    setFirstName(firstName) {
        this.firstName = firstName;
    }
    // Last Name accessor method
    getLastName() {
        return this.lastName;
    }
    // Last Name mutator method
    setLastName(lastName) {
        this.lastName = lastName;
    }
    // Mail Address accessor method
    getMailAddress() {
        return this.mailAddress;
    }
    // Mail Address mutator method
    setMailAddress(mailAddress) {
        this.mailAddress = mailAddress;
    }
    // Type accessor method
    getType() {
        return this.type;
    }
    // Type mutator method
    setType(type) {
        this.type = type;
    }
    // Date of Birth accessor method
    getDateOfBirth() {
        return this.dateOfBirth;
    }
    // Date of Birth mutator method
    setDateOfBirth(dateOfBirth) {
        this.dateOfBirth = dateOfBirth;
    }
    // Profile Picture accessor method
    getProfilePicture() {
        return this.profilePicture;
    }
    // Profile Picture mutator method
    setProfilePicture(profilePicture) {
        this.profilePicture = profilePicture;
    }
    // Password accessor method
    getPassword() {
        return this.password;
    }
    // Password mutator method
    setPassword(password) {
        this.password = password;
    }
    // Domain accessor method
    getDomain() {
        return this.domain;
    }
    // Register method
    register(event) {
        // Preventing default submission
        event.preventDefault();
        // Generating a POST request
        fetch(this.getDomain + "/Register/Register.php", {
            method: "POST",
            body: JSON.stringify({
                username: this.getUsername(),
                mailAddress: this.getMailAddress(),
                firstName: this.getFirstName(),
                lastName: this.getLastName(),
                dateOfBirth: this.getDateOfBirth(),
            }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then(
                (data) => this.render.setSuccess(data.success),
                this.render.setMessage(data.message),
                this.request.setUrl(data.url)
            )
            .finally(() =>
                setTimeout(this.request.redirect(this.request.getUrl()), 3870)
            );
    }
    // Login method
    login(event) {
        // Preventing default submission
        event.preventDefault();
        // Generating a POST request
        fetch(this.domain + "/Login/Login.php", {
            method: "POST",
            body: JSON.stringify({
                username: this.getUsername(),
                password: this.getPassword(),
            }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then(
                (data) => this.render.setSuccess(data.success),
                this.render.setMessage(data.message),
                this.request.setUrl(data.url)
            )
            .finally(() =>
                setTimeout(this.request.redirect(this.request.getUrl()), 4200)
            );
    }
}
// Render class
class Render {
    // Constructor method
    constructor(success, message) {
        this.success = success;
        this.message = message;
    }
    // Success accessor method
    getSuccess() {
        return this.success;
    }
    // Success mutator method
    setSuccess(success) {
        this.success = success;
    }
    // Message accessor method
    getMessage() {
        return this.message;
    }
    // Message mutator method
    setMessage(message) {
        this.message = message;
    }
}
// Redirector class
class Redirector {
    // Constructor method
    constructor(url) {
        this.url = url;
    }
    // URL accessor method
    getUrl() {
        return this.url;
    }
    // URL mutator method
    setUrl(url) {
        this.url = url;
    }
    // Redirect method
    redirect(url) {
        window.location.href = url;
    }
}
