import {Controller} from '@hotwired/stimulus';
import PBackground from "@mtjch/bg_particles/src/js/PBackground";

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
        bgColor: {type: String, default: 'linear-gradient(0.15turn, rgb(223, 185, 106, 1), rgb(135, 190, 231, 1)90% )'},
        lineColor: {type: Array, default: [0, 84, 219]}
    };

    connect() {
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
            lineColor: this.lineColorValue
        }

        this.bg = new PBackground(this.bgOptions);

        this.initializeParticles(this.bg);

        /** start animation */
        this.bg.animate();
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
        //console.log(event.currentTarget.value)
        this.bg.speedModValue = parseFloat(event.currentTarget.value);

        //console.log('parseFloat(event.currentTarget.value)',parseFloat(event.currentTarget.value));
        //console.log('this.bg.speedModValue',this.bg.speedModValue);

        this.initializeParticles(this.bg);
    }

    initializeParticles(bg) {

        //bg.speedModValue = this.speedModValue;
        //console.log('initializeParticles bg.speedModValue',bg.speedModValue);
        //console.log('this.speedModValue',this.speedModValue);
        /** initialize particles */
        bg.init();
    }
}