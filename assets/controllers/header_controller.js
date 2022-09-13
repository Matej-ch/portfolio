import {Controller} from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ['navbar']

    connect() {

    }

    showNavbar(e) {
        if (this.navbarTarget.classList.contains('flex')) {
            this.navbarTarget.classList.add('hidden');
            this.navbarTarget.classList.remove('flex');
        } else {
            this.navbarTarget.classList.add('flex');
            this.navbarTarget.classList.remove('hidden');
        }
    }
}