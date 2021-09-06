import React, {createRef, useState} from "react";
import {createPopper} from "@popperjs/core";
import ReactDOM from "react-dom";

const Tooltip = ({color, position = 'left'}) => {
    const [tooltipShow, setTooltipShow] = useState(false);
    const btnRef = createRef();
    const tooltipRef = createRef();

    const openLeftTooltip = () => {
        createPopper(btnRef.current, tooltipRef.current, {
            placement: position
        });
        setTooltipShow(true);
    };
    const closeLeftTooltip = () => {
        setTooltipShow(false);
    };

    return (
        <>
            <div className="flex flex-wrap">
                <div className="w-full text-center">
                    <button
                        className={
                            "bg-" + color +
                            "-500 text-white active:bg-" + color +
                            "-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        }
                        type="button"
                        onMouseEnter={openLeftTooltip}
                        onMouseLeave={closeLeftTooltip}
                        ref={btnRef}>
                        Contact me
                    </button>
                    <div
                        className={
                            (tooltipShow ? "" : "hidden ") + "bg-" + color +
                            "-600 border-0 mr-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                        }
                        ref={tooltipRef}>
                        <div>
                            <div
                                className={
                                    "bg-" + color + "-600 text-white opacity-75 font-semibold p-3 mb-0 border-b border-solid border-blueGray-100 uppercase rounded-t-lg"
                                }>
                                {color} tooltip title
                            </div>
                            <div className="text-white p-3">
                                Additional info
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

if (document.getElementById('tooltip-wrapper')) {
    ReactDOM.render(
        <Tooltip color={'blue'}/>,
        document.getElementById('tooltip-wrapper')
    );
}