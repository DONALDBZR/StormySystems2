// Login class
class Login extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />, <Footer />];
    }
}
// Header class
class Header extends Login {
    // Render method
    render() {
        return (
            <header>
                <nav>
                    <div>
                        <a href="../">
                            <img
                                src="../public/Images/Logo.png"
                                alt="System Logo"
                            />
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
                        <a href="./">Login</a>
                    </div>
                    <div>
                        <a href="../Register">Register</a>
                    </div>
                </nav>
            </header>
        );
    }
}
// Main class
class Main extends Login {
    // Constructor method
    constructor(props) {
        super(props);
        this.state = {
            usernameOrMailAddress: "",
            password: "",
            success: "",
            message: "",
            url: "",
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
        // Local variables
        const delay = 4200;
        // Prevent default submission
        event.preventDefault();
        // Generating a POST request
        fetch("./Login.php", {
            method: "POST",
            body: JSON.stringify({
                usernameOrMailAddress: this.state.usernameOrMailAddress,
                password: this.state.password,
            }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) =>
                this.setState({
                    success: data.success,
                    message: data.message,
                    url: data.url,
                })
            )
            .then(() => this.redirector(delay));
    }
    // Redirector method
    redirector(delay) {
        setTimeout(() => {
            window.location.href = this.state.url;
        }, delay);
    }
    // Render method
    render() {
        return (
            <main>
                <div id="formContainer">
                    <form method="post" onSubmit={this.handleSubmit.bind(this)}>
                        <div id="label">Login Form</div>
                        <div id="formContainerInsideAForm">
                            <div id="usernameOrMailAddress">
                                <div id="input">
                                    <div>Username / Mail Address:</div>
                                    <input
                                        type="text"
                                        name="usernameOrMailAddress"
                                        id="usernameOrMailAddress"
                                        placeholder="Username or Mail Address"
                                        value={this.state.usernameOrMailAddress}
                                        onChange={this.handleChange.bind(this)}
                                        required
                                    />
                                </div>
                                <div id="guidelines">
                                    Please enter your username or the mail
                                    address that you have used to register!
                                </div>
                            </div>
                            <div id="password">
                                <div id="input">
                                    <div>Password:</div>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Password"
                                        value={this.state.password}
                                        onChange={this.handleChange.bind(this)}
                                        required
                                    />
                                </div>
                                <div id="guidelines">
                                    Please enter your password!
                                </div>
                                <div id="guidelines">
                                    If, you have just registered into the
                                    system, your password has been sent to you
                                    by mail but please consider to change it!
                                </div>
                            </div>
                            <div id="loginButton">
                                <button>Login</button>
                            </div>
                        </div>
                    </form>
                    <div id="serverRendering">
                        <h1 id={this.state.success}>{this.state.message}</h1>
                    </div>
                </div>
            </main>
        );
    }
}
// Footer class
class Footer extends Login {
    // Render method
    render() {
        return (
            <footer>
                <h1>Stormy Systems</h1>
            </footer>
        );
    }
}
// Rendering ./Login
ReactDOM.render(<Login />, document.getElementById("app"));
