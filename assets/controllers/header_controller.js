import { Controller } from 'stimulus';
import ReactDOM from "react-dom";
import React from "react";
import Navbar from "../js/components/navbar";


export default class extends Controller {

    static values = {
        github: String,
        linkedin: String
    }

    connect() {
        ReactDOM.render(<Navbar github={this.githubValue} linkedin={this.linkedinValue} />, this.element);
    }
}