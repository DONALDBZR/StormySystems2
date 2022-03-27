// Academical class
class Academical extends React.Component {
    // Render method
    render() {
        return <Footer />;
    }
}
// Footer class
class Footer extends Academical {
    // Render method
    render() {
        return (
            <footer>
                <div class="level">
                    <div class="type">BSc Software Engineering</div>
                    <div class="school">Université Des Mascareignes</div>
                    <div class="period">10/2021 - 10/2022</div>
                </div>
                <div class="level">
                    <div class="type">Diploma in Software Engineering</div>
                    <div class="school">Université Des Mascareignes</div>
                    <div class="period">08/2019 - 08/2021</div>
                </div>
                <div class="level">
                    <div class="type">High-School Certificate</div>
                    <div class="school">New Eton College</div>
                    <div class="period">02/2017 - 11/2018</div>
                </div>
                <div class="level">
                    <div class="type">School Certificate</div>
                    <div class="school">St Mary's College</div>
                    <div class="period">01/2015 - 11/2016</div>
                </div>
            </footer>
        );
    }
}
// Rendering ./About/Academical
ReactDOM.render(<Academical />, document.getElementById("footer"));
