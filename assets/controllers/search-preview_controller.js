import { Controller } from 'stimulus';
import { useClickOutside } from 'stimulus-use'
import { useDebounce } from 'stimulus-use'

export default class extends Controller {

    static values = {
        url:String
    }

    static targets = ['result']

    static debounces = ['search']

    connect() {
        useClickOutside(this);
        useDebounce(this);
    }

    clickOutside(event) {
       // event.preventDefault()
        this.resultTarget.innerHTML = '';
    }

    async onSearchInput(e)
    {
        this.search(e.currentTarget.value);
    }

    async search(query) {
        const params = new URLSearchParams({
            q: query,
            preview: '1'
        });

        const response = await fetch(`${this.urlValue}?${params.toString()}`);

        this.resultTarget.innerHTML = await response.text();
    }
}