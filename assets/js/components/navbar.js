import React, {useState} from "react";

const Navbar = ({fixed, admin}) => {
    const [navbarOpen, setNavbarOpen] = useState(false);

    return (
        <>
            <nav
                className={"flex flex-wrap items-center justify-between px-2 bg-blue-500" + (fixed ? ' fixed z-10 w-full' : ' relative')}>

                <div className="container px-4 mx-auto flex flex-wrap items-end justify-between pt-1">

                    <div
                        className="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                        <a className="text-4xl leading-none font-bold mr-4 whitespace-nowrap uppercase text-white logo"
                           href="/">
                            MC
                        </a>

                        <a className="text-sm leading-7 lg:leading-tight font-bold inline-block mr-4 py-2 whitespace-nowrap uppercase text-white hover:opacity-75"
                           href="/projects">
                            Projects
                        </a>

                        <button
                            className="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                            type="button"
                            onClick={() => setNavbarOpen(!navbarOpen)}>
                            <i className="fas fa-bars"/>
                        </button>
                    </div>

                    <div>

                    </div>

                    <div
                        className={"lg:flex flex-grow items-center" + (navbarOpen ? " flex" : " hidden")}
                        id="example-navbar-danger">
                        <ul className="flex flex-row md:flex-row items-baseline list-none lg:ml-auto">

                            <li>
                                <a
                                    className="pr-3 lg:pr-0 lg:px-3 flex items-baseline text-sm uppercase font-bold leading-snug text-white hover:opacity-75 py-2"
                                    href="/about">
                                    <span className="lg:ml-2">Hire me</span>
                                </a>
                            </li>

                            <li>
                                <a
                                    className="px-3 flex items-baseline text-sm uppercase font-bold leading-snug text-white hover:opacity-75 py-2"
                                    href="/about">
                                    <span className="ml-2">Contact</span>
                                </a>
                            </li>

                            <li>
                                <a
                                    className="px-3 flex items-baseline text-sm uppercase font-bold leading-snug text-white hover:opacity-75 py-2"
                                    href="/about">
                                    <span className="ml-2">About</span>
                                </a>
                            </li>

                            {admin ? <li>
                                <a
                                    className="px-3 flex items-center text-sm uppercase font-bold leading-snug text-white hover:opacity-75 py-2"
                                    href={admin}>
                                    ADMIN
                                </a>
                            </li> : ''}
                        </ul>
                    </div>
                </div>
            </nav>
        </>
    );
}

export default Navbar;