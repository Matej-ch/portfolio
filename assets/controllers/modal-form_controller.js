import { Controller } from 'stimulus';

export default class extends Controller {

    static targets = ['modal','backdrop'];

    openModal(event) {
        this.modalTarget.classList.toggle("hidden");
        this.backdropTarget.classList.toggle("hidden");
        this.modalTarget.classList.toggle("flex");
        this.backdropTarget.classList.toggle("flex");
    }
}