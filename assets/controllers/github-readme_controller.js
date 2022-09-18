import {Controller} from '@hotwired/stimulus';
import MarkdownIt from 'markdown-it';
import hljs from 'highlight.js';
import php from 'highlight.js/lib/languages/php';

/* stimulusFetch: 'lazy' */
export default class extends Controller {

    static targets = ['readme'];

    static values = {
        githubName: String,
        projectName: String
    }

    async connect() {

        const repoResponse = await fetch(`https://api.github.com/repos/${this.githubNameValue}/${this.projectNameValue}`);

        const repoResponseData = await repoResponse.json();

        const response = await fetch(`https://raw.githubusercontent.com/${this.githubNameValue}/${this.projectNameValue}/${repoResponseData.default_branch}/README.md`);

        const markdownText = await response.text();

        hljs.registerLanguage('php', php);

        const md = new MarkdownIt('commonmark', {
            html: true,
            linkify: true,
            typographer: true,
            highlight: function (str, lang) {
                if (lang && hljs.getLanguage(lang)) {
                    try {
                        return '<pre class="hljs"><code>' +
                            hljs.highlight(str, {language: lang, ignoreIllegals: true}).value +
                            '</code></pre>';
                    } catch (__) {
                    }
                }

                return '<pre class="hljs"><code>' + md.utils.escapeHtml(str) + '</code></pre>';
            }
        });

        this.readmeTarget.innerHTML = md.render(markdownText);
    }
}