// Professional class
class Professional extends React.Component {
    // Render method
    render() {
        return <Footer />;
    }
}
// Footer class
class Footer extends Professional {
    // Render method
    render() {
        return (
            <footer>
                <div class="job">
                    <div class="position">Associate Software Engineer</div>
                    <div class="company">AGILEUM</div>
                    <div class="period">20/06/2022 - 19/08/2022</div>
                </div>
                <div class="job">
                    <div class="position">Junior Software Developer</div>
                    <div class="company">RT Knits</div>
                    <div class="period">06/12/2021 - 15/03/2022</div>
                </div>
                <div class="job">
                    <div class="position">Full-Stack Web Developer</div>
                    <div class="company">Rakatoo Associates LTD</div>
                    <div class="period">04/10/2021 - 30/10/2021</div>
                </div>
                <div class="job">
                    <div class="position">Junior Software Engineer</div>
                    <div class="company">Université Des Mascareignes</div>
                    <div class="period">07/06/2021 - 27/08/2021</div>
                </div>
                <div class="job">
                    <div class="position">Full-Stack Web Developer</div>
                    <div class="company">Rakatoo Associates LTD</div>
                    <div class="period">04/02/2020 - 07/11/2020</div>
                </div>
                <div class="job">
                    <div class="position">Web Designer</div>
                    <div class="company">Millennium Services LTD</div>
                    <div class="period">06/01/2020 - 31/01/2020</div>
                </div>
            </footer>
        );
    }
}
// Rendering ./About/Professional
ReactDOM.render(<Professional />, document.getElementById("footer"));
