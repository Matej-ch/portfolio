import React from "react";

const Footer = ({sites}) => {

    return (
        <>
            <a href="mailto:me@test.dev" className="footer__link font-semibold">me@test.dev</a>
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
                <div className="w-full md:w-4/12 px-4 mx-auto text-center">
                    <div className="text-sm text-slate-300 font-semibold py-1">
                        Created with Symfony
                    </div>
                </div>
            </div>
        </>

    );
}

export default Footer;
