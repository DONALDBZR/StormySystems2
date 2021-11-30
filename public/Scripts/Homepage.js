// Homepage class
class Homepage extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />, <Footer />];
    }
}
// Header Class
class Header extends React.Component {
    // Render method
    render() {
        return (
            <header>
                <nav>
                    <div>
                        <a href="/StormySystems2/">
                            <img
                                src="./public/Images/Logo.png"
                                alt="System Logo"
                            />
                        </a>
                    </div>
                    <div>
                        <a href="/StormySystems2/AboutUs">About Us</a>
                    </div>
                    <div>
                        <a href="/StormySystems2/Service">Services Offered</a>
                    </div>
                    <div>
                        <a href="/StormySystems2/Projects">Projects</a>
                    </div>
                    <div>
                        <a href="/StormySystems2/Login">Login</a>
                    </div>
                    <div>
                        <a href="/StormySystems2/Register">Register</a>
                    </div>
                </nav>
            </header>
        );
    }
}
// Main Class
class Main extends React.Component {
    // Render method
    render() {
        return (
            <main>
                <h1>Welcome to</h1>
                <img src="./public/Images/Logo.png" alt="System Logo" />
            </main>
        );
    }
}
// Footer Class
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
// Rendering ./
ReactDOM.render(<Homepage />, document.getElementById("app"));
