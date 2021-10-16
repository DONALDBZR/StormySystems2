// Storing the Query Selector
const form = document.querySelector("form");
// Adding Event Listener to the form.
form.addEventListener("submit", register);
// Register function
async function register() {
    // // Accessing the data from the form
    // const data = new URLSearchParams();
    // // Retrieving data from the form
    // data.append("username", document.getElementById("username").value);
    // data.append("mailAddress", document.getElementById("mailAddress").value);
    // data.append("firstName", document.getElementById("firstName").value);
    // data.append("lastName", document.getElementById("lastName").value);
    // data.append("dateOfBirth", document.getElementById("dateOfBirth").value);
    // // Calling Fetch function
    // fetch("./index.php", {
    //     method: "POST",
    //     body: data,
    // })
    //     .then(function (response) {
    //         return response.text();
    //     })
    //     .then(function (text) {
    //         console.log(text);
    //     })
    //     .catch(function (error) {
    //         console.log(error);
    //     });
    // return false;
    // // Preventing Default submission
    // form.preventDefault();
    // Instantiating Form Data
    // const userObject = Object.fromEntries(new FormData(form));
    // Calling Fetch function to request the client to POST the JSON
    // fetch("../StormySystem.php", {
    //     method: "POST",
    //     headers: {
    //         "Content-Type": "application/json",
    //     },
    //     body: JSON.stringify(userObject),
    // });
    // Calling AJAX to call $User::register() from StormySystem.php
    $.ajax({
        url: "./index.php",
        type: "POST",
        data: {
            username: document.getElementById("username").value,
            mailAddress: document.getElementById("mailAddress").value,
            firstName: document.getElementById("firstName").value,
            lastName: document.getElementById("lastName").value,
            dateOfBirth: document.getElementById("dateOfBirth").value,
            register: "register",
        },
        success: function (response) {
            document.getElementById("serverRendering") = response;
        },
    });
}
// // Importing StormySystems
// importScripts("./StormySystems");
// // Instantiating User
// const User = new User();
// // Header class
// class Header extends React.Component {
//     // Render method
//     render() {
//         return (
//             <header>
//                 <nav>
//                     <div>
//                         <a href="../">
//                             <img src="../Images/Logo.png" alt="System Logo" />
//                         </a>
//                     </div>
//                     <div>
//                         <a href="../AboutUs">About Us</a>
//                     </div>
//                     <div>
//                         <a href="../Service">Services Offered</a>
//                     </div>
//                     <div>
//                         <a href="../Projects">Projects</a>
//                     </div>
//                     <div>
//                         <a href="../Login">Login</a>
//                     </div>
//                     <div>
//                         <a href="./">Register</a>
//                     </div>
//                 </nav>
//             </header>
//         );
//     }
// }
// // Main class
// class Main extends React.Component {
//     render() {
//         return (
//             <main>
//                 <form method="post" action="./">
//                     <div id="label">Registration Form</div>
//                     <div id="formContainer">
//                         <div id="username">
//                             <div id="input">
//                                 <div>Username *:</div>
//                                 <input
//                                     type="text"
//                                     name="username"
//                                     id="username"
//                                     placeholder="Username"
//                                     required
//                                 />
//                             </div>
//                             <div id="guidelines">
//                                 Please enter a username which is unique!
//                             </div>
//                             <div id="guidelines">
//                                 Ensure that your username is not NSFW!
//                             </div>
//                         </div>
//                         <div id="mailAddress">
//                             <div id="input">
//                                 <div>Mail Address *:</div>
//                                 <input
//                                     type="email"
//                                     name="mailAddress"
//                                     id="mailAddress"
//                                     placeholder="Mail Address"
//                                     required
//                                 />
//                             </div>
//                             <div id="guidelines">
//                                 The Mail Address is required to send you your
//                                 password and to access your account, afterwards.
//                             </div>
//                         </div>
//                         <div id="firstName">
//                             <div id="input">
//                                 <div>First Name *:</div>
//                                 <input
//                                     type="text"
//                                     name="firstName"
//                                     id="firstName"
//                                     placeholder="First Name"
//                                     required
//                                 />
//                             </div>
//                             <div id="guidelines">
//                                 Please enter your first name!
//                             </div>
//                         </div>
//                         <div id="lastName">
//                             <div id="input">
//                                 <div>Last Name *:</div>
//                                 <input
//                                     type="text"
//                                     name="lastName"
//                                     id="lastName"
//                                     placeholder="Last Name"
//                                     required
//                                 />
//                             </div>
//                             <div id="guidelines">
//                                 Please enter your last name!
//                             </div>
//                         </div>
//                         <div id="dateOfBirth">
//                             <div id="input">
//                                 <div>Date Of Birth *:</div>
//                                 <input
//                                     type="date"
//                                     name="dateOfBirth"
//                                     id="dateOfBirth"
//                                     required
//                                 />
//                             </div>
//                             <div id="guidelines">
//                                 Please enter your date of birth!
//                             </div>
//                             <div id="guidelines">
//                                 You need to be at least thirteen years old to
//                                 register into this system!
//                             </div>
//                         </div>
//                         <div id="registrationButton">
//                             <input
//                                 type="submit"
//                                 value="Register"
//                                 name="register"
//                                 onClick={User.register()}
//                             />
//                         </div>
//                     </div>
//                     <div id="serverRendering"></div>
//                 </form>
//             </main>
//         );
//     }
// }
// // Footer class
// class Footer extends React.Component {
//     // Render method
//     render() {
//         return (
//             <footer>
//                 <h1>Stormy Systems</h1>
//             </footer>
//         );
//     }
// }
// // Register class
// class Register extends React.Component {
//     // Render method
//     render() {
//         return [<Header />, <Main />, <Footer />];
//     }
// }
// // Rendering ./Register
// ReactDOM.render(<Register />, document.getElementById("app"));
