class Application extends React.Component {
    render() {
        return <Main />;
    }
}
class Main extends Application {
    render() {
        return (
            <main>
                <div id="person">
                    <div id="introduction">
                        <h1>Hi, I'm Andy.  Nice to meet you.</h1>
                        <p>Since, the beginning of my journey as a freelance web developer over 3 years ago, I have done remote work for many small and medium-sized enterprises for the realization of their projects as well as collaborated with talented people to create digital products for both business and consumer use.  I'm quietly confident, naturally curious and perpetually working on improving my chops one design problem at a time.</p>
                    </div>
                    <div id="image">
                        <img src="/Images/(1154).jpg" />
                    </div>
                </div>
                <div class="continue">
                    <a href="/About">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Continue
                    </a>
                </div>
            </main>
        );
    }
}
ReactDOM.render(<Application />, document.body);
