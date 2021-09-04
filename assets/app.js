/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// start the Stimulus application
import './bootstrap';

import React from "react";
import ReactDOM from "react-dom";
import Navbar from "./js/components/navbar";

if(document.getElementById('react-app')) {
    ReactDOM.render(
        <Navbar github="https://github.com/Matej-ch" linkedin="https://www.linkedin.com"/>,
        document.getElementById('react-app')
    );
}

