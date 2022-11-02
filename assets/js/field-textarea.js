class AutoOverflow {
    constructor(field) {
        this.field = field;
        this.autogrow();
    }

    autogrow() {
        this.field.style.overflow = 'auto';
        this.field.style.resize = 'both';
        this.field.style.boxSizing = 'border-box';
        this.field.style.height = 'auto';

        // this check is needed because the <textarea> element can be inside a
        // minimizable panel, causing its scrollHeight value to be 0
        if (this.field.scrollHeight > 0) {
            this.field.style.height = this.field.scrollHeight + 'px';
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.js-textarea-container-with-overflow').forEach(function (wrapper) {
        new AutoOverflow(wrapper.querySelector('textarea'));
    });
});
