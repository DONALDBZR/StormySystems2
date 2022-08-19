// Project class
class Project extends React.Component {
    // Render method
    render() {
        return <Footer />;
    }
}
// Footer class
class Footer extends Project {
    // Component Did Mount method
    componentDidMount() {
        this.statusChecker();
    }
    // Status Checker method
    statusChecker() {
        // Local variables
        const statuses = document.querySelectorAll(".status");
        // Calling Change Color method for each element in the array.
        statuses.forEach(this.changeColor);
    }
    // Change Color method
    changeColor(element) {
        // Local variables
        const value = element.textContent;
        // If-statement to verify the value
        if (value == "Complete") {
            element.style.color = "rgb(0, 255, 0)";
        } else if (value == "In development") {
            element.style.color = "rgb(255, 255, 0)";
        } else if (value == "Drop") {
            element.style.color = "rgb(255, 0, 0)";
        }
    }
    // Render method
    render() {
        return (
            <footer>
                <div class="project">
                    <div class="header">Name</div>
                    <div class="header">Status</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="https://darkness4869.herokuapp.com/">
                            Portfolio
                        </a>
                    </div>
                    <div class="status">Complete</div>
                    <div class="version">2.12</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="http://rakatooassociatesltd.com/">
                            Rakatoo Associates
                        </a>
                    </div>
                    <div class="status">Complete</div>
                    <div class="version">2.79</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="https://github.com/DONALDBZR/LMS">
                            Library Management System
                        </a>
                    </div>
                    <div class="status">Complete</div>
                    <div class="version">1.112</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="https://github.com/DONALDBZR/chat">
                            Chat
                        </a>
                    </div>
                    <div class="status">In development</div>
                    <div class="version">0.42</div>
                </div>
            </footer>
        );
    }
}
// Rendering ./About/Project
ReactDOM.render(<Project />, document.getElementById("footer"));
