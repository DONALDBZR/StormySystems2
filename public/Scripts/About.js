// About class
class About extends React.Component {
    // Render method
    render() {
        return [<Header />, <Main />];
    }
}
// Header Class
class Header extends About {
    // Render method
    render() {
        return (
            <header>
                <nav>
                    <div>
                        <a href="/">
                            <img src="/Images/(1544).png" alt="System Logo" />
                        </a>
                    </div>
                    <div>
                        <a href="/About">About Me</a>
                    </div>
                    <div>
                        <a href="/Service">Services Offered</a>
                    </div>
                </nav>
            </header>
        );
    }
}
// Main Class
class Main extends About {
    // Render method
    render() {
        return (
            <main>
                <div>
                    <div id="personalDetails">
                        <div>
                            <div class="label">Name:</div>
                            <div>Andy Ewen Gaspard</div>
                        </div>
                        <div>
                            <div class="label">Address:</div>
                            <div>
                                <a
                                    href="https://www.google.com/maps/place/20%C2%B014'38.0%22S+57%C2%B034'09.9%22E/@-20.2438956,57.5688767,19z/data=!3m1!4b1!4m5!3m4!1s0x0:0x7b29b853b1f82859!8m2!3d-20.2438969!4d57.5694239"
                                    target="_blank"
                                >
                                    <i class="fa fa-location-pin faLocation"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="label">Phone:</div>
                            <div>
                                <a href="tel:+23059016623">
                                    <i class="fa fa-phone faPhone"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="label">Mail Address:</div>
                            <div>
                                <a href="mailto:andygaspard@hotmail.com">
                                    <i class="fa fa-envelope faMail"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="label">Linked-In:</div>
                            <div>
                                <a
                                    href="https://www.linkedin.com/in/andy-gaspard/"
                                    target="_blank"
                                >
                                    <i class="fa fa-linkedin faLinkedIn"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="label">Facebook:</div>
                            <div>
                                <a
                                    href="https://www.facebook.com/Darkness4869/"
                                    target="_blank"
                                >
                                    <i class="fa fa-facebook faFacebook"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="label">Instagram:</div>
                            <div>
                                <a
                                    href="https://www.instagram.com/darkness_4869/"
                                    target="_blank"
                                >
                                    <i class="fa fa-instagram faInstagram"></i>
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="label">Git Hub:</div>
                            <div>
                                <a
                                    href="https://github.com/DONALDBZR"
                                    target="_blank"
                                >
                                    <i class="fa fa-github faGitHub"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="profilePicture">
                        <div>
                            <img src="/Images/(1154).jpg" />
                        </div>
                    </div>
                </div>
                <div id="description">
                    I am Andy Ewen Gaspard. I am a junior software developer as
                    well as I am 22 years old.
                </div>
                <nav>
                    <div>
                        <a href="/About/Professional">Professional Career</a>
                    </div>
                    <div>
                        <a href="/About/Academical">Education</a>
                    </div>
                    <div>
                        <a href="/About/Linguistic">Languages</a>
                    </div>
                    <div>
                        <a href="/About/Hobby">Interests</a>
                    </div>
                    <div>
                        <a href="/About/Skill">Skills</a>
                    </div>
                    <div>
                        <a href="/About/Project">Projects</a>
                    </div>
                </nav>
            </main>
        );
    }
}
// Rendering ./About
ReactDOM.render(<About />, document.getElementById("app"));
