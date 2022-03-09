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
                        <a href="./">
                            <img src="/Images/Logo.png" alt="System Logo" />
                        </a>
                    </div>
                    <div>
                        <a href="./About">About Me</a>
                    </div>
                    <div>
                        <a href="./Service">Services Offered</a>
                    </div>
                    <div>
                        <a href="./Project">Projects</a>
                    </div>
                    <div>
                        <a href="./Contact">Contact</a>
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
                <img src="/Images/Logo.png" alt="System Logo" />
            </main>
        );
    }
}
// Footer Class
class Footer extends React.Component {
    // Render method
    render() {
        return <footer></footer>;
    }
}
// Rendering ./
ReactDOM.render(<Homepage />, document.getElementById("app"));
