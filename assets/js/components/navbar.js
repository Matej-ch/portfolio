import React,{ useState } from "react";
import ReactDOM from "react-dom";

const Navbar = ({ fixed,github,linkedin }) => {
    const [navbarOpen, setNavbarOpen] = useState(false);

    return (
        <>
            <nav className={"flex flex-wrap items-center justify-between px-2 py-3 bg-blue-500" + (fixed ? ' fixed z-10 w-full' : ' relative')}>
                <div className="container px-4 mx-auto flex flex-wrap items-center justify-between">
                    <div className="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                        <a className="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
                           href="/projects">
                            Projects
                        </a>

                        <a className="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
                           href="/projects">
                            <i className="fas fa-gamepad text-lg leading-lg text-white opacity-75"/>
                            <span className="ml-2">Games</span>
                        </a>

                        <a className="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
                           href="/projects">
                            <i className="fas fa-cubes text-lg leading-lg text-white opacity-75"/>
                            <span className="ml-2">Packages</span>
                        </a>

                        <button
                            className="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                            type="button"
                            onClick={() => setNavbarOpen(!navbarOpen)}>
                            <i className="fas fa-bars"/>
                        </button>
                    </div>
                    <div
                        className={"lg:flex flex-grow items-center" + (navbarOpen ? " flex" : " hidden")}
                        id="example-navbar-danger">
                        <ul className="flex flex-col lg:flex-row list-none lg:ml-auto">
                            <li className="nav-item">
                                <a
                                    className="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75"
                                    href={linkedin}>
                                    <i className="fab fa-linkedin text-lg leading-lg text-white opacity-75"/>
                                </a>
                            </li>
                            <li className="nav-item">
                                <a
                                    className="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75"
                                    href={ github }>
                                    <i className="fab fa-github text-lg leading-lg text-white opacity-75"/>
                                </a>
                            </li>
                            <li className="nav-item">
                                <a
                                    className="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75"
                                    href="/about">
                                    <i className="fas fa-user text-lg leading-lg text-white opacity-75"/><span className="ml-2">About me</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </>
    );
}

//export default Navbar;

if(document.getElementById('react-app')) {
    ReactDOM.render(
        <Navbar github="https://github.com/Matej-ch" linkedin="https://www.linkedin.com"/>,
        document.getElementById('react-app')
    );
}
