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
            padding: {top: 20, bottom: 40, left: 100, right: 100},
            pswpModule: () => import('photoswipe')
        });
        lightbox.init();
    }
}

