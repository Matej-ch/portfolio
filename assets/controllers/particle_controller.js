import { Controller } from 'stimulus';
import PBackground from "bg_particles/src/js/PBackground";

export default class extends Controller {

    static targets = ['canvas','settingBtn','settingMenu'];

    static values = {
        speedMod: Number,
        particleCount: Number,
        lineModifier: Number,
    };

    connect()
    {
        this.initializeParticles({
            speedMod: this.speedModValue,
            particleCount: this.particleCountValue,
            lineModifier: this.lineModifierValue
        });
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
        this.initializeParticles({[event.currentTarget.dataset.attribute]: parseInt(event.currentTarget.value)});
    }

    initializeParticles(options = {}) {

        let bg = {};

        let bgOptions = {
            canvasSelector: `#${this.canvasTarget.id}`,
            bgColor:'linear-gradient(0.15turn, rgb(223, 185, 106, 1), rgb(135, 190, 231, 1)90% )',
            canvasW: window.innerWidth,
            canvasH: this.element.clientHeight,
            speedMod: 0.2,
            particleCount:200,
            lineModifier: 10000,
            lineColor: [0, 84, 219]
        }

        bgOptions = {...bgOptions,...options};

        bg = new PBackground(bgOptions);

        /** initialize particles */
        bg.init();

        /** start animation */
        bg.animate();
    }
}