const TurboHelper = class {
    constructor() {
        document.addEventListener('turbo:before-cache', () => {

        });

        document.addEventListener('turbo:before-render', (event) => {
            if (this.isPreviewRendered()) {

                event.detail.newBody.classList.remove('turbo-loading');
                requestAnimationFrame(() => {
                    document.body.classList.add('turbo-loading');
                });
            } else {
                const isRestoration = event.detail.newBody.classList.contains('turbo-loading');
                if (isRestoration) {

                    event.detail.newBody.classList.remove('turbo-loading');
                    return;
                }
                event.detail.newBody.classList.add('turbo-loading');
            }

            if (document.querySelector('.js-fiver-script')) {
                const fiverrScript = document.querySelector('.js-fiver-script');
                
                const script = document.createElement('script');
                script.setAttribute('src', fiverrScript.src);
                script.setAttribute('async', 'true');
                script.setAttribute('defer', 'true');
                script.id = fiverrScript.id;
                script.classList.add('js-fiver-script');
                script.dataset.config = fiverrScript.dataset.config;
                fiverrScript.remove();
                document.head.appendChild(script);
            }
        });

        document.addEventListener('turbo:render', (event) => {
            if (!this.isPreviewRendered()) {
                requestAnimationFrame(() => {
                    document.body.classList.remove('turbo-loading');
                });
            }
        });
        document.addEventListener('turbo:load', () => {
            // for analytics
        });

        document.addEventListener('turbo:visit', () => {
            document.body.classList.add('turbo-loading');
        });
    }

    isPreviewRendered() {
        return document.documentElement.hasAttribute('data-turbo-preview');
    }
}

export default new TurboHelper();