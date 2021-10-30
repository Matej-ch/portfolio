import { Controller } from 'stimulus';

export default class extends Controller {

    openModal(event) {
        console.log(event);
        //function toggleModal(modalID){
            document.getElementById('modal-id').classList.toggle("hidden");
            document.getElementById('modal-id' + "-backdrop").classList.toggle("hidden");
            document.getElementById('modal-id').classList.toggle("flex");
            document.getElementById('modal-id' + "-backdrop").classList.toggle("flex");
        //}

    }
}