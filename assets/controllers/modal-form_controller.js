import { Controller } from 'stimulus';

export default class extends Controller {

    static targets = ['modal','backdrop','close','body'];

    static values = {
        formUrl: String
    }

    connect()
    {
        window.addEventListener('keyup', this.hideOnKeyUp)
    }

    disconnect () {
        window.removeEventListener('keyup', this.hideOnKeyUp)
    }

    hideOnKeyUp = (event) => {
        if(event.code === 'Escape') {
            this.modalTarget.classList.add("hidden");
            this.backdropTarget.classList.add("hidden");
            this.modalTarget.classList.remove("flex");
            this.backdropTarget.classList.remove("flex");
        }
    }

    async openModal(event) {
        this.bodyTarget.innerHTML = 'Loading... ';

        this.toggleModal();

        const response = await fetch(this.formUrlValue);

        this.bodyTarget.innerHTML = await response.text();

    }

    closeModal(event) {
        this.toggleModal();
    }

    toggleModal() {
        this.modalTarget.classList.toggle("hidden");
        this.backdropTarget.classList.toggle("hidden");
        this.modalTarget.classList.toggle("flex");
        this.backdropTarget.classList.toggle("flex");
    };
}