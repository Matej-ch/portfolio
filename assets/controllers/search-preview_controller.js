import { Controller } from 'stimulus';

export default class extends Controller {

    static values = {
        url:String
    }

    static targets = ['result']

    async onSearchInput(e)
    {
        const params = new URLSearchParams({
            q: e.currentTarget.value,
            preview: '1'
        });

        const response = await fetch(`${this.urlValue}?${params.toString()}`);

        this.resultTarget.innerHTML = await response.text();
    }
}