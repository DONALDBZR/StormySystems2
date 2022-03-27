// Application class
class Application {
    // Constructor method
    constructor() {
        // Importing Express.js
        this.express = require("express");
        // Creating the application
        this.application = this.express();
        // Calling the router of Express
        this.router = this.express.Router("caseSensitive");
        // Port for the application
        this.port = 8080;
    }
    // Initiator method
    initiator() {
        // Listening for any connection
        this.application.listen(this.port, () => this.listener());
        // Using the static directory for the static files
        this.application.use(this.express.static(__dirname + "/public"));
        // Handling all the request that are made to the application
        this.handleRequest();
    }
    // Listener method
    listener() {
        console.log(`Application running on port ${this.port}`);
    }
    // Request handler method
    handleRequest() {
        // Mapping the homepage
        this.application.get("/", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Homepage.html");
            console.log(`Application: /\nMethod: GET`);
        });
        // Mapping the about page
        this.application.get("/About", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/About.html");
            console.log(`Application: /About\nMethod: GET`);
        });
        // Mapping the about page
        this.application.get("/About/Professional", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Professional.html");
            console.log(`Application: /About/Professional\nMethod: GET`);
        });
    }
}
// Instanting the application
const application = new Application();
// Initializing the application
application.initiator();
