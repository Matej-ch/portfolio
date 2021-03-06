import {Controller} from 'stimulus';
import ReactDOM from "react-dom";
import React from "react";
import Footer from "../js/components/footer";

/* stimulusFetch: 'lazy' */
export default class extends Controller {

    static values = {
        sites: Array
    }

    connect() {
        ReactDOM.render(<Footer sites={this.sitesValue}/>, this.element);
    }
}