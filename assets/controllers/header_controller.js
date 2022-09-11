import {Controller} from 'stimulus';
import ReactDOM from "react-dom";
import React from "react";
import Navbar from "../js/components/navbar";


export default class extends Controller {

    static values = {
        admin: String,
    }

    connect() {
        ReactDOM.render(<Navbar admin={this.adminValue}/>, this.element);
    }
}