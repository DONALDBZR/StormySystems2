// Skill class
class Skill extends React.Component {
    // Render method
    render() {
        return <Footer />;
    }
}
// Footer class
class Footer extends Skill {
    // Component Did Mount method
    componentDidMount() {
        this.levelChecker();
    }
    // Level Checker method
    levelChecker() {
        // Local variables
        const levels = document.querySelectorAll(".level");
        // Calling Change Color method for each element in the array.
        levels.forEach(this.changeColor);
    }
    // Change Color method
    changeColor(element) {
        // Local variables
        const value = element.textContent;
        // If-statement to verify the value
        if (value > 7) {
            element.style.color = "rgb(0, 255, 0)";
        } else if (value >= 5 && value <= 7) {
            element.style.color = "rgb(255, 255, 0)";
        } else if (value < 5) {
            element.style.color = "rgb(255, 0, 0)";
        }
    }
    // Render method
    render() {
        return (
            <footer>
                <div class="skill">
                    <div class="header">Skills</div>
                    <div class="header">Levels</div>
                </div>
                <div class="skill">
                    <div class="type">Microsoft Office</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">Hypertext Markup Language</div>
                    <div class="level">9</div>
                </div>
                <div class="skill">
                    <div class="type">Cascade Style Sheet</div>
                    <div class="level">9</div>
                </div>
                <div class="skill">
                    <div class="type">Photo Editing</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">Video Editing</div>
                    <div class="level">4</div>
                </div>
                <div class="skill">
                    <div class="type">Designing</div>
                    <div class="level">7</div>
                </div>
                <div class="skill">
                    <div class="type">Python</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">Java</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">Hypertext Preprocessor</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">Structured Query Language</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">JavaScript</div>
                    <div class="level">9</div>
                </div>
                <div class="skill">
                    <div class="type">C#</div>
                    <div class="level">2</div>
                </div>
                <div class="skill">
                    <div class="type">Computer Aided Designs</div>
                    <div class="level">7</div>
                </div>
                <div class="skill">
                    <div class="type">React.JS</div>
                    <div class="level">7</div>
                </div>
                <div class="skill">
                    <div class="type">Flask.PY</div>
                    <div class="level">6</div>
                </div>
                <div class="skill">
                    <div class="type">FileMaker</div>
                    <div class="level">6</div>
                </div>
                <div class="skill">
                    <div class="type">Node.JS</div>
                    <div class="level">9</div>
                </div>
                <div class="skill">
                    <div class="type">UML 2.5</div>
                    <div class="level">8</div>
                </div>
                <div class="skill">
                    <div class="type">Git</div>
                    <div class="level">9</div>
                </div>
                <div class="skill">
                    <div class="type">Heroku</div>
                    <div class="level">10</div>
                </div>
                <div class="skill">
                    <div class="type">Drupal</div>
                    <div class="level">1</div>
                </div>
                <div class="skill">
                    <div class="type">React Native</div>
                    <div class="level">1</div>
                </div>
            </footer>
        );
    }
}
// Rendering ./About/Skill
ReactDOM.render(<Skill />, document.getElementById("footer"));
