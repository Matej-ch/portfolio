import React from "react";

const Footer = ({sites, email}) => {

    return (
        <>
            <a href={"mailto:" + email} className="footer__link font-semibold">{email}</a>
            <ul className="social-list">

                {sites.map(function (site) {
                    return <li className="social-list__item" key={site['id']}>
                        <a className="social-list__link" href={site['url']} title={site['name']}>
                            <i className={site['icon']}/>
                        </a>
                    </li>
                })}
            </ul>

            <hr className="my-6 border-slate-300"/>

            <div className="flex flex-wrap items-center md:justify-between justify-center">
                <div className="container flex justify-between px-4 mx-auto text-center">
                    <div className="text-sm text-slate-300 font-semibold py-1">
                        <a href="/sitemap">Sitemap</a>
                    </div>
                    <div className="text-sm text-slate-300 font-semibold py-1">
                        <a href="https://symfony.com">Created with Symfony</a>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Footer;
