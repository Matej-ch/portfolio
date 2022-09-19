import React from "react";

const Footer = ({sites, email}) => {

    return (
        <>
            <a href={"mailto:" + email} className="footer__link font-semibold">{email}</a>
            <ul className="social-list">

                {sites.map(function (site) {
                    if (site['icon'].includes('fiverr')) {
                        return <li className="social-list__item" key={site['id']}>
                            <a className="social-list__link" href={site['url']} title={site['name']}>

                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     role="img" width="1em" height="1em" className={'inline-block'}
                                     preserveAspectRatio="xMidYMid meet" viewBox="-2.5 -2 24 24">
                                    <g fill="currentColor">
                                        <path
                                            d="M16.25 16.25v-10h-10v-.625c0-1.034.841-1.875 1.875-1.875H10V0H8.125A5.632 5.632 0 0 0 2.5 5.625v.625H0V10h2.5v6.25H0V20h8.75v-3.75h-2.5V10h6.285v6.25H10V20h8.75v-3.75h-2.5z"></path>
                                        <circle cx="14.375" cy="1.875" r="1.875"></circle>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    }
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
