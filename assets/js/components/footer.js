import React from "react";

const Footer = () => {

    return (
        <div className="grid px-10">

            <div className={'grid grid-cols-2'}>
                <div>
                    <div>Bio and picture here</div>
                    <p>Full stack developer <br/>
                        Available to hire
                    </p>
                </div>
                <div>
                    <div>link 1</div>
                    <div>link 2</div>
                </div>
            </div>

            <hr className="my-6 border-slate-400"/>
            <div className="flex flex-wrap items-center md:justify-between justify-center">
                <div className="w-full md:w-4/12 px-4 mx-auto text-center">
                    <div className="text-sm text-slate-600 font-semibold py-1">
                        Created with Symfony
                    </div>
                </div>
            </div>
        </div>

    );
}

export default Footer;
