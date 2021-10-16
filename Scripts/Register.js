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
    // Register method
    register(props) {
        const [user, setUser] = useState(props.user);
        // Calling Submit function
        this.submit();
    }
    // Submit method
    submit(event) {
        // Preventing default submission
        event.preventDefault();
        // Generating POST request
        fetch("../JSON/", {
            method: "POST",
            body: JSON.stringify({ user }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((json) => setUser(json.user));
    }
    // Render method
    render() {
        return (
            <main>
                <form onSubmit={this.submit}>
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
                                    value={user.username}
                                    onChange={(event) =>
                                        setUser({
                                            ...user,
                                            username: event.target.value,
                                        })
                                    }
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
                                    value={user.mailAddress}
                                    onChange={(event) =>
                                        setUser({
                                            ...user,
                                            mailAddress: event.target.value,
                                        })
                                    }
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
                                    value={user.firstName}
                                    onChange={(event) =>
                                        setUser({
                                            ...user,
                                            firstName: event.target.value,
                                        })
                                    }
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
                                    value={user.lastName}
                                    onChange={(event) =>
                                        setUser({
                                            ...user,
                                            lastName: event.target.value,
                                        })
                                    }
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
                                    value={user.dateOfBirth}
                                    onChange={(event) =>
                                        setUser({
                                            ...user,
                                            dateOfBirth: event.target.value,
                                        })
                                    }
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
