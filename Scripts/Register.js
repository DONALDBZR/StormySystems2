// Header class
class Header extends React.Component {
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
class Main extends React.Component {
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
        fetch("../StormySystem.php", {
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
        // Generating a POST request to call User::register()
        fetch("./index.php", {
            method: "POST",
            body: JSON.stringify({ register: "register" }),
            headers: {
                "Content-Type":
                    "application/x-www-form-urlencoded; charset=UTF-8",
            },
        }).then((response) => response.text());
    }
    // Render method
    render() {
        return (
            <main>
                <form onSubmit={this.handleSubmit.bind(this)}>
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
                    <ServerRendering />
                </form>
            </main>
        );
    }
}
// Server Rendering class
class ServerRendering extends React.Component {
    // Render class
    render() {
        return <div id="serverRendering"></div>;
    }
}
// Footer class
class Footer extends React.Component {
    // Render method
    render() {
        return (
            <footer>
                <h1>Stormy Systems</h1>
            </footer>
        );
    }
}
// Register class
class Register extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />, <Footer />];
    }
}
// Rendering ./Register
ReactDOM.render(<Register />, document.getElementById("app"));
