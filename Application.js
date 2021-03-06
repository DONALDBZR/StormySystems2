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
        this.application.listen(process.env.PORT || this.port, () =>
            this.listener()
        );
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
        // /
        this.application.get("/", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Homepage.html");
            console.log(`Application: /\nMethod: GET`);
        });
        // /About
        this.application.get("/About", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/About.html");
            console.log(`Application: /About\nMethod: GET`);
        });
        // /About/Professional
        this.application.get("/About/Professional", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Professional.html");
            console.log(`Application: /About/Professional\nMethod: GET`);
        });
        // /About/Academical
        this.application.get("/About/Academical", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Academical.html");
            console.log(`Application: /About/Academical\nMethod: GET`);
        });
        // /About/Linguistic
        this.application.get("/About/Linguistic", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Linguistic.html");
            console.log(`Application: /About/Linguistic\nMethod: GET`);
        });
        // /About/Hobby
        this.application.get("/About/Hobby", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Hobby.html");
            console.log(`Application: /About/Hobby\nMethod: GET`);
        });
        // /About/Skill
        this.application.get("/About/Skill", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Skill.html");
            console.log(`Application: /About/Skill\nMethod: GET`);
        });
        // /About/Project
        this.application.get("/About/Project", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Project.html");
            console.log(`Application: /About/Project\nMethod: GET`);
        });
        // /Service
        this.application.get("/Service", (request, response) => {
            response.sendFile(__dirname + "/public/Pages/Service.html");
            console.log(`Application: /About/Service\nMethod: GET`);
        });
    }
}
// Instanting the application
const application = new Application();
// Initializing the application
application.initiator();
