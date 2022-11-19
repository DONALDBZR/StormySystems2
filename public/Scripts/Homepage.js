class Application extends React.Component {
    render() {
        return [<Main />];
    }
}
class Main extends Application {
    render() {
        return (
            <main>
                <div id="persona">
                    <header>
                        <div id="name">Andy Ewen Gaspard</div>
                        <div id="role">Full-Stack Web Developer</div>
                    </header>
                    <div id="image">
                        <img src="/Images/(33).png" />
                    </div>
                </div>
                <div class="continue"></div>
            </main>
        );
    }
}
// Rendering ./
ReactDOM.render(<Application />, document.body);
