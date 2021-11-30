// AboutUs class
class AboutUs extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />, <Footer />];
    }
}
// Header Class
class Header extends AboutUs {
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
                        <a href="./">About Us</a>
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
                        <a href="../Register">Register</a>
                    </div>
                </nav>
            </header>
        );
    }
}
// Main Class
class Main extends AboutUs {
    // Render method
    render() {
        return (
            <main>
                <div id="team">
                    It is basically a team of developers which works on projects
                    on low prices as well as on projects that will contribute to
                    any kind of communities along with that the projects done by
                    them are generally open-source projects given that there are
                    also corporate projects.
                </div>
                <div id="teamHeader">Team Members:</div>
                <div id="member">
                    <div>
                        <a href="./username1">username1</a>
                    </div>
                </div>
            </main>
        );
    }
}
// Footer Class
class Footer extends AboutUs {
    // Render method
    render() {
        return (
            <footer>
                <a href="mailto:andygaspard@hotmail.com">
                    <i class="fa fa-envelope faMail"></i>
                </a>
            </footer>
        );
    }
}
// Rendering ./AboutUs
ReactDOM.render(<AboutUs />, document.getElementById("app"));
