import {Controller} from 'stimulus';
import Swiper from 'swiper/bundle'

export default class extends Controller {
    swiper;
    //optionsValue;

    static values = {
        options: Object
    }

    connect() {
        console.log(this.optionsValue);
        this.swiper = new Swiper(this.element, {
            ...this.defaultOptions,
            ...this.optionsValue
        })
    }

    disconnect() {
        this.swiper.destroy()
        this.swiper = undefined
    }

    get defaultOptions() {
        return {}
    }
}