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
                    <div id="name"></div>
                    <div id="image"></div>
                </div>
                <div class="continue"></div>
            </main>
        );
    }
}
// Rendering ./
ReactDOM.render(<Application />, document.body);
