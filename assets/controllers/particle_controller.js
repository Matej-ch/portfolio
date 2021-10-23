import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['canvas','settingBtn','settingMenu'];


    //connect() {
        // add html with settings menu

        //add animation to canvas

        /*this.settingBtnTarget.addEventListener('click',() => {

        })*/
    //}

    showMenu() {
        this.settingBtnTarget.classList.add('hidden');
        this.settingMenuTarget.classList.remove('hidden');
    }


}