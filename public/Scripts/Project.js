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
                        <a href="https://github.com/DONALDBZR/StormySystems2">Portfolio</a>
                    </div>
                    <div class="status">In development</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="http://rakatooassociatesltd.com/">Rakatoo Associates</a>
                    </div>
                    <div class="status">Complete</div>
                </div>
                <div class="project">
                    <div class="name">Cash Dodo</div>
                    <div class="status">In development</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="https://github.com/DONALDBZR/LMS">Library Management System</a>
                    </div>
                    <div class="status">Complete</div>
                </div>
                <div class="project">
                    <div class="name">
                        <a href="https://github.com/DONALDBZR/Grand-Ground">Grand Ground</a>
                    </div>
                    <div class="status">In development</div>
                </div>
            </footer>
        );
    }
}
// Rendering ./About/Project
ReactDOM.render(<Project />, document.getElementById("footer"));
