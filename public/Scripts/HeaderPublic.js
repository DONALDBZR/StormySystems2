// Header Class
class Header extends React.Component {
    // Render method
    render() {
        return (
            <header>
                <nav>
                    <div>
                        <a href="/StormySystems2/">
                            <img src="./Images/Logo.png" alt="System Logo" />
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
// Exporting Header
export { Header };
