import { Controller } from 'stimulus';
import PBackground from "bg_particles/src/js/PBackground";

export default class extends Controller {
    bg = null;
    bgOptions = {};

    static targets = ['canvas','settingBtn','settingMenu'];

    static values = {
        speedMod: Number,
        particleCount: Number,
        lineModifier: Number,
    };

    connect()
    {
        this.bgOptions = {
            canvasSelector: `#${this.canvasTarget.id}`,
            bgColor:'linear-gradient(0.15turn, rgb(223, 185, 106, 1), rgb(135, 190, 231, 1)90% )',
            canvasW: window.innerWidth,
            canvasH: this.element.clientHeight,
            speedMod: 5,
            particleCount:200,
            lineModifier: 10000,
            lineColor: [0, 84, 219]
        }

        this.bgOptions = {...this.bgOptions,...{
                speedMod: this.speedModValue,
                particleCount: this.particleCountValue,
                lineModifier: this.lineModifierValue
            }};

        //console.log(this.bgOptions);
        this.bg = new PBackground(this.bgOptions);

        this.initializeParticles(this.bg);

        /** start animation */
        this.bg.animate();
    }

    showMenu()
    {
        this.settingBtnTarget.classList.add('hidden');
        this.settingMenuTarget.classList.remove('hidden');
    }

    hideMenu()
    {
        this.settingMenuTarget.classList.add('hidden');
        this.settingBtnTarget.classList.remove('hidden');
    }

    updateBackground(event)
    {
        //console.log(event.currentTarget.value)
        this.bg.speedModValue = parseFloat(event.currentTarget.value);

        console.log('parseFloat(event.currentTarget.value)',parseFloat(event.currentTarget.value));
        console.log('this.bg.speedModValue',this.bg.speedModValue);

        this.initializeParticles(this.bg);
    }

    initializeParticles(bg) {

        //bg.speedModValue = this.speedModValue;
        console.log('initializeParticles bg.speedModValue',bg.speedModValue);
        //console.log('this.speedModValue',this.speedModValue);
        /** initialize particles */
        bg.init();
    }
}