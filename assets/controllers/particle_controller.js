import {Controller} from '@hotwired/stimulus';
import PBackground from "@mtjch/bg_particles/src/js/PBackground";

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    bg = null;
    bgOptions = {};

    static targets = ['canvas', 'settingBtn', 'settingMenu'];

    static values = {
        speedMod: {type: Number, default: 5},
        particleCount: {type: Number, default: 200},
        lineModifier: {type: Number, default: 10000},
        particleColor: String,
        mouseInteraction: {type: Boolean, default: true},
        animate: {type: Boolean, default: true},
        bgColor: {type: String, default: 'linear-gradient(0.15turn, rgb(223, 185, 106, 1), rgb(135, 190, 231, 1)90% )'},
        lineColor: {type: Array, default: [0, 84, 219]}
    };

    initialize() {

        if (window.innerWidth <= 600) {
            this.particleCountValue /= 3;
        }

        this.bgOptions = {
            canvasSelector: `#${this.canvasTarget.id}`,
            bgColor: this.bgColorValue,
            canvasW: window.innerWidth,
            canvasH: this.element.clientHeight,
            speedMod: this.speedModValue,
            particleCount: this.particleCountValue,
            lineModifier: this.lineModifierValue,
            particleColor: this.particleColorValue || null,
            mouseInteraction: this.mouseInteractionValue,
            lineColor: this.lineColorValue,
            runAnimation: {value: this.animateValue}
        }

        this.bg = new PBackground(this.bgOptions);

        this.initializeParticles(this.bg);

        /** start animation */
        this.bg.animate();
    }

    disconnect() {
        this.bg = null;
    }

    showMenu() {
        this.settingBtnTarget.classList.add('hidden');
        this.settingMenuTarget.classList.remove('hidden');
    }

    hideMenu() {
        this.settingMenuTarget.classList.add('hidden');
        this.settingBtnTarget.classList.remove('hidden');
    }

    updateBackground(event) {

        this.bg.speedModValue = parseFloat(event.currentTarget.value);


        this.initializeParticles(this.bg);
    }

    initializeParticles(bg) {
        /** initialize particles */
        bg.init();
    }
}