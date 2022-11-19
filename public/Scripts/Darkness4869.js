/**
 * It has all the scripts that need to be run before the application is mounted.
 * @type {Darkness4869}
 */
class Darkness4869 {
    constructor() {
        /**
         * The request URI of the page needed
         * @type {string}
         */
        this.__requestUniformRequestInformation;
        /**
         * The ID of the body
         * @type {string}
         */
        this.__bodyId;
        /**
         * Stylesheets of the application
         * @type {string[]}
         */
        this._stylesheets = [
            "/Public/Stylesheets/darkness4869.css",
            "/Public/Stylesheets/desktop.css",
            "/Public/Stylesheets/mobile.css",
            "/Public/Stylesheets/tablet.css"
        ];
        /**
         * Relationship of the object
         * @type {string}
         */
        this.__relationship;
        /**
         * MIME Type of the object
         * @type {string}
         */
        this.__mimeType;
        /**
         * @type {string[]}
         */
        this._mediaQueries = [
            "screen and (min-width: 1024px)",
            "screen and (min-width: 640px) and (max-width: 1023px)",
            "screen and (max-width: 639px)"
        ];
        this.init();
    }
    /**
     * @returns {string}
     */
    getRequestUniformInformation() {
        return this.__requestUniformRequestInformation;
    }
    /**
     * @param {string} request_uniform_information 
     */
    setRequestUniformInformation(request_uniform_information) {
        this.__requestUniformRequestInformation = request_uniform_information;
    }
    /**
     * @returns {string}
     */
    getBodyId() {
        return this.__bodyId;
    }
    /**
     * @param {string} body_id 
     */
    setBodyId(body_id) {
        this.__bodyId = body_id;
    }
    /**
     * @returns {string}
     */
    getRelationship() {
        return this.__relationship;
    }
    /**
     * @param {string} relationship 
     */
    setRelationship(relationship) {
        this.__relationship = relationship;
    }
    /**
     * @returns {string}
     */
    getMimeType() {
        return this.__mimeType;
    }
    /**
     * @param {string} mime_type 
     */
    setMimeType(mime_type) {
        this.__mimeType = mime_type;
    }
    /**
     * Initializing the application
     */
    init() {
        const body = document.body;
        this.setRequestUniformInformation(window.location.pathname);
        if (this.getRequestUniformInformation() == "/") {
            this.setBodyId("Homepage");
        } else {
            this.setBodyId(this.getRequestUniformInformation().replaceAll("/", ""));
        }
        body.id = this.getBodyId();
        this.style();
    }
    /**
     * Styling the application
     */
    style() {
        this.setRelationship("stylesheet");
        this.setMimeType("text/css");
        for (let index = 0; index < this._stylesheets.length; index++) {
            const link = document.createElement("link");
            link.href = this._stylesheets[index];
            if (link.href.includes("desktop")) {
                link.media = this._mediaQueries[0];
            } else if (link.href.includes("mobile")) {
                link.media = this._mediaQueries[2];
            } else if (link.href.includes("tablet")) {
                link.media = this._mediaQueries[1];
            }
            link.rel = this.getRelationship();
            link.type = this.getMimeType();
            document.head.appendChild(link);
        }
    }
}
const application = new Darkness4869();