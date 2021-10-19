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
    render() {
        return (
            <main>
                <div id="formContainer">
                    <form method="post">
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
                                <input
                                    type="submit"
                                    value="Login"
                                    name="login"
                                />
                            </div>
                        </div>
                    </form>
                    <div id="serverRendering"></div>
                </div>
            </main>
        );
    }
}
// Footer class
class Footer extends React.Component {
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
