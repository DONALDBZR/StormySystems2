// Professional class
class Professional extends React.Component {
    // Render method
    render() {
        return <Footer />;
    }
}
// Footer class
class Footer extends Professional {
    // Component Did Mount method
    componentDidMount() {
        this.proficiencyChecker();
    }
    // Proficiency Checker method
    proficiencyChecker() {
        // Local variables
        const proficiencies = document.querySelectorAll(".proficiency");
        // Calling Change Color method for each element in the array.
        proficiencies.forEach(this.changeColor);
    }
    // Change Color method
    changeColor(element) {
        // Local variables
        const value = element.textContent;
        // If-statement to verify the value
        if (value == "Bilingual or native language") {
            element.style.color = "rgb(0, 255, 0)";
        } else if (value == "Intermediate proficiency") {
            element.style.color = "rgb(255, 255, 0)";
        } else if (value == "Elementary proficiency") {
            element.style.color = "rgb(255, 0, 0)";
        }
    }
    // Render method
    render() {
        return (
            <footer>
                <div class="language">
                    <div class="type">English</div>
                    <div class="proficiency">Bilingual or native language</div>
                </div>
                <div class="language">
                    <div class="type">French</div>
                    <div class="proficiency">Bilingual or native language</div>
                </div>
                <div class="language">
                    <div class="type">Chinese</div>
                    <div class="proficiency">Elementary proficiency</div>
                </div>
            </footer>
        );
    }
}
// Rendering ./About/Professional
ReactDOM.render(<Professional />, document.getElementById("footer"));
