import React,{useState,useEffect, Fragment} from 'react';
import { CogIcon,LogoutIcon,ViewGridIcon } from "@heroicons/react/outline";
import { ChevronLeftIcon, ChevronRightIcon,ShoppingCartIcon,CalendarIcon } from "@heroicons/react/solid";
import {
    add,
    eachDayOfInterval,
    endOfMonth,
    format,
    getDay,
    isEqual,
    isSameDay,
    isSameMonth,
    isToday,
    parse,
    parseISO,
    startOfToday,
  } from 'date-fns';
import { workers,isWorker,logout,orders } from './Workers';
import Orders from './Orders';
import FilterCalendar from '../FilterCalendar';
import Schedule from './Schedule';
import Settings from './Settings';

console.log(ac_worker_manager);


function classNames(...classes) {
    return classes.filter(Boolean).join(' ')
}

const RecruiterNav = ({tab,setTab}) => {
    return (
        <Fragment>
            <span onClick={() => setTab("orders")} className="cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 hover:text-slate-900 ">
                <div
                    className={tab === "orders" ? classNames(
                    "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200  bg-primary-50"
                    ) : classNames(
                    "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 hover:bg-primary-50"
                    )}
                >
                    <ShoppingCartIcon className="h-7 w-5 m-1 p-0.5 " aria-hidden="true" />
                    <span className="pr-2 md:block hidden">Orders</span>
                </div>
            </span>
        </Fragment>
    );
}


const WorkerNav = ({tab,setTab}) => {
    return (
        <Fragment>
            <span onClick={() => setTab("schedule")} className="cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 hover:text-slate-900 ">
                <div
                    className={tab === "schedule" ? classNames(
                    "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200  bg-primary-50"
                    ) : classNames(
                    "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 hover:bg-primary-50"
                    )}
                >
                    <CalendarIcon className="h-7 w-5 m-1 p-0.5 " aria-hidden="true" />
                    <span className="pr-2 md:block hidden">Schedule</span>
                </div>
            </span>
        </Fragment>
    );
}


const WorkerDashboard = () => {
    const [tab, setTab] = useState("dashboard");
    useEffect(() => {
    //    console.log(tab);
    }, [tab]);

    return (
       <div className="flex">
        {/* start:nave */}
        <div className="w-1/5">
            <div className="relative flex flex-col items-center space-y-2">
                <span onClick={() => setTab("dashboard")} className="cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 hover:text-slate-900 ">
                    <div
                        className={tab === "dashboard" ? classNames(
                        "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200  bg-primary-50"
                        ) : classNames(
                        "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 hover:bg-primary-50"
                        )}
                    >
                        <ViewGridIcon className="h-7 w-5 m-1 p-0.5 " aria-hidden="true" />
                        <span className="pr-2 md:block hidden">Dashboard</span>
                    </div>
                </span>

                {!isWorker ? <RecruiterNav tab={tab} setTab={setTab} /> : <WorkerNav tab={tab} setTab={setTab} />}

                <span onClick={() => setTab("settings")} className="cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 hover:text-slate-900 ">
                    <div
                    className={tab === "settings" ? classNames(
                    "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200  bg-primary-50"
                    ) : classNames(
                    "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 hover:bg-primary-50"
                    )}
                    >
                        <CogIcon className="h-7 w-5 m-1 p-0.5 " aria-hidden="true" />
                        <span className="pr-2 md:block hidden">Settings</span>
                    </div>
                </span>

                <a href={ logout } className="cursor-pointer lg:text-sm lg:leading-6 font-medium text-slate-700 hover:text-slate-900 ">
                    <div className= "flex md:min-w-[8rem] md:px-0 px-1 items-center pointer-events-none mx-1 rounded-md ring-1 ring-slate-900/5 group-hover:shadow group-hover:ring-slate-900/10 group-hover:shadow-primary-200 hover:bg-primary-50"                       >
                        <LogoutIcon className="h-7 w-5 m-1 p-0.5 " aria-hidden="true" />
                        <span className="pr-2 md:block hidden">Logout</span>
                    </div>
                </a>
            </div>
        </div>
        {/* end:nave */}

        {/* start:content */}
        <div className="flex-auto md:mx-3 mx-1 ">
        {(() => {
            if (tab==="dashboard") {
              return (
                <Settings />
              )
            } else if (tab==="orders") {
              return (
                <Orders />
              )
            }else if(tab ==="schedule"){
                return(
                    <Schedule />
                )
            } else {
              return (
               <Settings />
              )
            }
        })()}
        </div>
        {/* end:content */}

       </div>
    );
}

export default WorkerDashboard;


