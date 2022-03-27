// Service class
class Service extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />];
    }
}
// Header Class
class Header extends Service {
    // Render method
    render() {
        return (
            <header>
                <nav>
                    <div>
                        <a href="/">
                            <img
                                src="../Images/(1544).png"
                                alt="System Logo"
                            />
                        </a>
                    </div>
                    <div>
                        <a href="/About">About Us</a>
                    </div>
                    <div>
                        <a href="/Service">Services Offered</a>
                    </div>
                </nav>
            </header>
        );
    }
}
// Main Class
class Main extends Service {
    // Render method
    render() {
        return (
            <main>
                <div id="header">Service Offered</div>
                <div id="service">Web Application Development</div>
                <div id="service">Desktop Application Development</div>
            </main>
        );
    }
}
// Rendering ./Service
ReactDOM.render(<Service />, document.getElementById("app"));
