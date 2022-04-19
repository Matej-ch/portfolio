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

        document.addEventListener('turbo:visit  ', () => {
            document.body.classList.add('turbo-loading');
        });
    }

    isPreviewRendered() {
        return document.documentElement.hasAttribute('data-turbo-preview');
    }
}

export default new TurboHelper();