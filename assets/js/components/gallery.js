import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';

window.onload = function () {
    if (document.getElementById('image-gallery')) {
        const lightbox = new PhotoSwipeLightbox({
            gallery: '#image-gallery',
            children: 'a',
            showHideAnimationType: 'none',
            initialZoomLevel: 0,
            secondaryZoomLevel: 1,
            maxZoomLevel: 1,
            bgOpacity: 0.2,
            padding: {top: 20, bottom: 40, left: 50, right: 50},
            pswpModule: () => import('photoswipe')
        });

        lightbox.on('uiRegister', function () {
            lightbox.pswp.ui.registerElement({
                name: 'custom-caption',
                order: 9,
                isButton: false,
                appendTo: 'root',
                html: 'Caption text',
                onInit: (el, pswp) => {
                    lightbox.pswp.on('change', () => {
                        const currSlideElement = lightbox.pswp.currSlide.data.element;
                        let captionHTML = '';
                        if (currSlideElement) {
                            const hiddenCaption = currSlideElement.querySelector('.hidden-caption-content');
                            if (hiddenCaption) {
                                // get caption from element with class hidden-caption-content
                                captionHTML = hiddenCaption.innerHTML;
                            } else {
                                // get caption from alt attribute
                                captionHTML = currSlideElement.querySelector('img').getAttribute('alt');
                            }
                        }
                        el.innerHTML = captionHTML || '';
                    });
                }
            });
        });


        lightbox.init();
    }
}

