import { Controller } from 'stimulus';
import PBackground from "bg_particles/src/js/PBackground";

export default class extends Controller {
    bg = null;

    static targets = ['canvas','settingBtn','settingMenu'];

    static values = {
        speedMod: Number,
        particleCount: Number,
        lineModifier: Number,
    };

    connect()
    {
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

        bgOptions = {...bgOptions,...{
                speedMod: this.speedModValue,
                particleCount: this.particleCountValue,
                lineModifier: this.lineModifierValue
            }};

        this.bg = new PBackground(bgOptions);

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
        this.initializeParticles(this.bg);
    }

    initializeParticles(bg) {

        /** initialize particles */
        bg.init();
    }
}