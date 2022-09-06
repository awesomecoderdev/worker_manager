import React, { Fragment } from 'react';
import { ClockIcon,LocationMarkerIcon,CurrencyDollarIcon,BriefcaseIcon } from "@heroicons/react/solid";
import { acf } from './Workers';

const Worker = ({worker,}) => {
    return (
        <article className="flex items-start lg:space-x-6 space-x-3 transform scale-[98%] shadow-md rounded-md overflow-hidden">
            <div className="w-32 h-32 flex-none rounded-l-md bg-slate-100 bg-center bg-cover bg-no-repeat" style={{
                 backgroundImage: `url(${worker.profile})`
                }}>
            </div>
            <div className="h-full min-w-0 relative flex-auto py-3">
                <h2 className="font-semibold text-slate-900 truncate pr-4">{worker.name}</h2>
                <div className="absolute top-0 right-0 bottom-0 h-full w-40 flex xl:items-center xl:justify-center lg:items-center lg:justify-center md:items-center md:justify-center items-start justify-end space-x-1">
                    <a className="md:px-3 md:py-2 px-2 py-1 z-10 text-sm rounded-md bg-primary-500 text-white hover:text-white cursor-pointer" href={worker.page_link ? worker.page_link : "javascript:void(0);"} target="_blank" rel="noopener noreferrer">
                        View
                        <span className="hidden sm:inline lg:hidden xl:inline"> Details</span>
                    </a>
                </div>
                <dl className="mt-2 flex flex-wrap sm:flex-row flex-col md:space-y-0 space-y-2 text-sm leading-6 font-medium lg:space-x-2 md:space-x-2">
                    <div className=''>
                        <dd className=" sm: justify-start px-1.5 ring-1 ring-slate-200 rounded flex  items-center">
                            <ClockIcon className='h-4 w-4 text-slate-500 mr-1' />
                            {worker.availability ? worker.availability : "Unavailable"}
                        </dd>
                    </div>
                    <div className=''>
                        <dd className=" lg:justify-center justify-start px-1.5 ring-1 ring-slate-200 rounded flex  items-center">
                            <LocationMarkerIcon className='h-4 w-4 text-slate-500 mr-1' />
                            {worker.location ? worker.location : "Unkonwn"}
                        </dd>
                    </div>
                    <div className=''>
                        <dd className=" lg:justify-center justify-start px-1.5 ring-1 ring-slate-200 rounded flex  items-center">
                            <CurrencyDollarIcon className='h-4 w-4 text-slate-500 mr-1' />
                            {(worker.day_rate && (worker.day_rate != acf.day_rate[0]) ) ? worker.day_rate : "Unkonwn"}
                        </dd>
                    </div>
                    <div className="flex-none md:block hidden w-full mt-2 pt-2 font-normal ">
                        <dd className="w-fit px-1.5 lg:-ml-2 md:-ml-2 ring-1 ring-slate-200 rounded text-slate-400 flex items-center">
                            <BriefcaseIcon className='h-4 w-4 text-slate-500 mr-1' />
                            {(worker.type_of_job && (worker.type_of_job != acf.type_of_job[0]) ) ? worker.type_of_job : "Unkonwn"}
                        </dd>
                    </div>
                </dl>
            </div>
        </article>
    );

}

export default Worker;
