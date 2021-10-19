// Register class
class Register extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />, <Footer />];
    }
}
// Header class
class Header extends Register {
    // Render method
    render() {
        return (
            <header>
                <nav>
                    <div>
                        <a href="../">
                            <img src="../Images/Logo.png" alt="System Logo" />
                        </a>
                    </div>
                    <div>
                        <a href="../AboutUs">About Us</a>
                    </div>
                    <div>
                        <a href="../Service">Services Offered</a>
                    </div>
                    <div>
                        <a href="../Projects">Projects</a>
                    </div>
                    <div>
                        <a href="../Login">Login</a>
                    </div>
                    <div>
                        <a href="./">Register</a>
                    </div>
                </nav>
            </header>
        );
    }
}
// Main class
class Main extends Register {
    // Constructor method
    constructor(props) {
        super(props);
        this.state = {
            username: "",
            mailAddress: "",
            firstName: "",
            lastName: "",
            dateOfBirth: "",
        };
    }
    // Change handler method
    handleChange(event) {
        const target = event.target;
        const value = target.value;
        const name = target.name;
        this.setState({
            [name]: value,
        });
    }
    // Submit handler method
    handleSubmit(event) {
        // Preventing default submission
        event.preventDefault();
        // Generating a POST request
        fetch("./Register.php", {
            method: "POST",
            body: JSON.stringify({
                username: this.state.username,
                mailAddress: this.state.mailAddress,
                firstName: this.state.firstName,
                lastName: this.state.lastName,
                dateOfBirth: this.state.dateOfBirth,
            }),
            headers: {
                "Content-Type": "application/json",
            },
        }).then((response) => response.json());
    }
    // Render method
    render() {
        return (
            <main>
                <form method="POST" onSubmit={this.handleSubmit.bind(this)}>
                    <div id="label">Registration Form</div>
                    <div id="formContainer">
                        <div id="username">
                            <div id="input">
                                <div>Username *:</div>
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    placeholder="Username"
                                    value={this.state.username}
                                    onChange={this.handleChange.bind(this)}
                                    required
                                />
                            </div>
                            <div id="guidelines">
                                Please enter a username which is unique!
                            </div>
                            <div id="guidelines">
                                Ensure that your username is not NSFW!
                            </div>
                        </div>
                        <div id="mailAddress">
                            <div id="input">
                                <div>Mail Address *:</div>
                                <input
                                    type="email"
                                    name="mailAddress"
                                    id="mailAddress"
                                    placeholder="Mail Address"
                                    value={this.state.mailAddress}
                                    onChange={this.handleChange.bind(this)}
                                    required
                                />
                            </div>
                            <div id="guidelines">
                                The Mail Address is required to send you your
                                password and to access your account, afterwards.
                            </div>
                        </div>
                        <div id="firstName">
                            <div id="input">
                                <div>First Name *:</div>
                                <input
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    placeholder="First Name"
                                    value={this.state.firstName}
                                    onChange={this.handleChange.bind(this)}
                                    required
                                />
                            </div>
                            <div id="guidelines">
                                Please enter your first name!
                            </div>
                        </div>
                        <div id="lastName">
                            <div id="input">
                                <div>Last Name *:</div>
                                <input
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    placeholder="Last Name"
                                    value={this.state.lastName}
                                    onChange={this.handleChange.bind(this)}
                                    required
                                />
                            </div>
                            <div id="guidelines">
                                Please enter your last name!
                            </div>
                        </div>
                        <div id="dateOfBirth">
                            <div id="input">
                                <div>Date Of Birth *:</div>
                                <input
                                    type="date"
                                    name="dateOfBirth"
                                    id="dateOfBirth"
                                    value={this.state.dateOfBirth}
                                    onChange={this.handleChange.bind(this)}
                                    required
                                />
                            </div>
                            <div id="guidelines">
                                Please enter your date of birth!
                            </div>
                            <div id="guidelines">
                                You need to be at least thirteen years old to
                                register into this system!
                            </div>
                        </div>
                        <div id="registrationButton">
                            <button>Register</button>
                        </div>
                    </div>
                    <div id="serverRendering"></div>
                </form>
            </main>
        );
    }
}
// Footer class
class Footer extends Register {
    // Render method
    render() {
        return (
            <footer>
                <h1>Stormy Systems</h1>
            </footer>
        );
    }
}
// Server Rendering class
class ServerRendering extends Main {
    // Constructor method
    constructor(props) {
        super(props);
        this.state = {
            success: false,
            message: "",
        };
    }
    // Component Did Mount method
    componentDidMount() {
        // Retrieving the POST response from the Back-end by using fetch()
        fetch("./Register.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                title: "Back-end's response",
            }),
        })
            .then((response) => response.json())
            .then((result) =>
                setState({
                    success: result.success,
                    message: result.message,
                })
            );
    }
    // Render method
    render() {
        return (
            <div id="serverRendering">
                <h1 id={this.state.success}>{this.state.message}</h1>
            </div>
        );
    }
}
// // User Register Success class
// class UserRegisterSuccess extends ServerRendering {
//     // Constructor method
//     constructor(props) {
//         super(props);
//         this.state = {
//             message: super.state.message,
//         };
//     }
//     // Render method
//     render() {
//         return <h1 id="userRegisterSuccess">{this.state.message}</h1>;
//     }
// }
// // User Register Failure class
// class UserRegisterFailure extends ServerRendering {
//     // Constructor method
//     constructor(props) {
//         super(props);
//         this.state = {
//             message: super.state.message,
//         };
//     }
//     // Render method
//     render() {
//         return <h1 id="userRegisterFailure">{this.state.message}</h1>;
//     }
// }
// Rendering ./Register
ReactDOM.render(<Register />, document.getElementById("app"));
