// Hobby class
class Hobby extends React.Component {
    // Render method
    render() {
        return <Footer />;
    }
}
// Footer class
class Footer extends Hobby {
    // Render method
    render() {
        return (
            <footer>
                <div>Gaming</div>
                <div>Programming</div>
                <div>Sports</div>
                <div>Arts</div>
                <div>Mechanics</div>
                <div>Travelling</div>
            </footer>
        );
    }
}
// Rendering ./About/Hobby
ReactDOM.render(<Hobby />, document.getElementById("footer"));
