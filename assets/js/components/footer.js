import React from "react";

const Footer = () => {

    return (
        <>
            <div
                className="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
                style={{height: '80px'}}>
            </div>
            <div className="container mx-auto px-4">
                <div className="flex flex-wrap">
                    <div className="w-full lg:w-6/12 px-4">
                        <h4 className="text-3xl font-semibold">test</h4>
                        <h5 className="text-lg mt-0 mb-2 text-gray-700">
                            Other platforms ?
                        </h5>
                        <div className="mt-6">
                            something here ?
                        </div>
                    </div>
                </div>
                <hr className="my-6 border-gray-400"/>
                <div className="flex flex-wrap items-center md:justify-between justify-center">
                    <div className="w-full md:w-4/12 px-4 mx-auto text-center">
                        <div className="text-sm text-gray-600 font-semibold py-1">
                            Created with Symfony
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Footer;
