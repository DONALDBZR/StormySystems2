// Homepage class
class Homepage extends React.Component {
    // Render method
    render() {
        return [<Main />];
    }
}
// Main Class
class Main extends Homepage {
    // Render method
    render() {
        return (
            <main>
                <a href="/About">
                    <img src="/Images/(1544).png" alt="System Logo" />
                </a>
            </main>
        );
    }
}
// Rendering ./
ReactDOM.render(<Homepage />, document.getElementById("app"));
