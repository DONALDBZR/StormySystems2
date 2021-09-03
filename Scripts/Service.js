// Header Class
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
                        <a href="./">Services Offered</a>
                    </div>
                    <div>
                        <a href="../Projects">Projects</a>
                    </div>
                    <div>
                        <a href="../Login">Login</a>
                    </div>
                    <div>
                        <a href="../Register">Register</a>
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
                <div id="header">Service Offered:</div>
                <div id="service">Web Application Development</div>
                <div id="service">Desktop Application Development</div>
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
                <div>Contact Us by clicking on the envelope below</div>
                <a href="mailto:andygaspard@hotmail.com">
                    <i class="fa fa-envelope faMail"></i>
                </a>
            </footer>
        );
    }
}
// Service class
class Service extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />, <Footer />];
    }
}
// Rendering ./Service
ReactDOM.render(<Service />, document.getElementById("app"));
