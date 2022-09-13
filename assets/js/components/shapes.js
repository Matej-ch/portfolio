import SBackgroundCreator from "@mtjch/bg_shapes/src/js/SBackgroundCreator";

window.onload = function () {
    const canvasEl = document.getElementById('canvas');

    const parentEl = canvasEl.parentElement;

    canvasEl.width = parentEl.offsetWidth;
    canvasEl.height = parentEl.offsetHeight;

    const bg = new SBackgroundCreator(canvasEl, {
        fillShape: true,
        numShapes: 8,
        bgColor: 'rgba(243, 244, 246, 1)'
    });

    bg.deactivateShapes(['Heart', 'Triangle', 'Line', 'Wave']);

    bg.init();

    bg.draw();
}