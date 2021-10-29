import { Controller } from 'stimulus';
import ReactDOM from "react-dom";
import React from "react";
import Footer from "../js/components/footer";


export default class extends Controller {

    connect() {
        ReactDOM.render(<Footer />, this.element);
    }
}