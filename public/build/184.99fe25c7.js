"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[184],{184:function(e,t,a){a.r(t),a.d(t,{default:function(){return h}});var r=a(6599),n=a(9980),i=a.n(n),c=a(637),s=a(769);function u(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}class h extends r.Qr{async connect(){const e=await fetch(`https://api.github.com/repos/${this.githubNameValue}/${this.projectNameValue}`),t=await e.json(),a=await fetch(`https://raw.githubusercontent.com/${this.githubNameValue}/${this.projectNameValue}/${t.default_branch}/README.md`),r=await a.text();c.Z.registerLanguage("php",s.Z);const n=new(i())("commonmark",{html:!0,linkify:!0,typographer:!0,highlight:function(e,t){if(t&&c.Z.getLanguage(t))try{return'<pre class="hljs"><code>'+c.Z.highlight(e,{language:t,ignoreIllegals:!0}).value+"</code></pre>"}catch(e){}return'<pre class="hljs"><code>'+n.utils.escapeHtml(e)+"</code></pre>"}});this.readmeTarget.innerHTML=n.render(r)}}u(h,"targets",["readme"]),u(h,"values",{githubName:String,projectName:String})}}]);