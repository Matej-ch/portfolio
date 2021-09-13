import PBackground from "bg_particles/src/js/PBackground";

const bg = new PBackground({
    canvasSelector: '#background',
    bgColor:'linear-gradient(0.15turn, rgb(223, 185, 106, 1), rgb(135, 190, 231, 1)90% )',
    canvasW: window.innerWidth,
    canvasH: document.querySelector('.js-background-parent').clientHeight,
    speedMod: 0.2,
    particleCount:200,
    lineModifier: 10000,
    lineColor: [0, 84, 219]});

/** initialize particles */
bg.init();

/** start animation */
bg.animate();