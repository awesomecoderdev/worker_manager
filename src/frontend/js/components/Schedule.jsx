import React, { Component, Fragment, useState,useEffect } from "react";
import { Menu, Transition } from "@headlessui/react";
import { DotsVerticalIcon } from "@heroicons/react/outline";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/react/solid";
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
import { ajaxurl, user } from "./Workers";
import axios from "axios";


function classNames(...classes) {
    return classes.filter(Boolean).join(' ')
}

function isJSON(str) {
    try {
        return (JSON.parse(str) && !!str);
    } catch (e) {
        return false;
    }
}

const colStartClasses = [
    '',
    'col-start-2',
    'col-start-3',
    'col-start-4',
    'col-start-5',
    'col-start-6',
    'col-start-7',
];
const Schedule = () => {
    const currentUser = JSON.parse(atob(user));
    const currentUserSchedule = isJSON(currentUser.ac_worker_manager_schedule) ? JSON.parse(currentUser.ac_worker_manager_schedule) : [];
    const today = startOfToday();
    const [selectedDay, setSelectedDay] = useState(today)
    const [currentMonth, setCurrentMonth] = useState(format(today, 'MMM-yyyy'))
    const firstDayCurrentMonth = parse(currentMonth, 'MMM-yyyy', new Date())
    const days = eachDayOfInterval({
      start: firstDayCurrentMonth,
      end: endOfMonth(firstDayCurrentMonth),
    })
    function previousMonth() {
      const firstDayNextMonth = add(firstDayCurrentMonth, { months: -1 })
      setCurrentMonth(format(firstDayNextMonth, 'MMM-yyyy'))
    }
    function nextMonth() {
      const firstDayNextMonth = add(firstDayCurrentMonth, { months: 1 })
      setCurrentMonth(format(firstDayNextMonth, 'MMM-yyyy'))
    }

    const [workerSchedule, setWorkerSchedule] = useState(currentUserSchedule);

    function setSchedule(day) {
        const tdy = format(day, 'yyyy-MM-dd');
        // console.log(tdy);

        if(workerSchedule.includes(tdy)){
            // console.log("today have schedule");
            workerSchedule.splice(workerSchedule.indexOf(tdy), 1);  //deleting
            setWorkerSchedule(workerSchedule);
        }else{
          //  console.log("today don't  have schedule");
           workerSchedule.push(tdy);
           setWorkerSchedule(workerSchedule)
        }
        // console.log(workerSchedule );
    }

    function saveSchedule() {
        axios.post(ajaxurl,{
            ac_action: "schedule",
            schedule: workerSchedule,
            user_id: currentUser.ID,
        }).then(function (response) {
          location.reload();
          // console.log(response.data);
        }).catch(function (error) {
            // console.log(error);
        });
    }

    return (
        <div className="worker-manager ">
            <div className="w-full px-4 mx-auto sm:px-7 md:max-w-4xl md:px-6 shadow-md py-4">
                <div className="md:divide-x md:divide-gray-200">
                    <div className="">
                        <div className="flex items-center">
                <h2 className="flex-auto font-semibold text-gray-900">
                  {format(firstDayCurrentMonth, 'MMMM yyyy')}
                </h2>
                <button
                  type="button"
                  onClick={previousMonth}
                  className="-my-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                >
                  <span className="sr-only">Previous month</span>
                  <ChevronLeftIcon className="w-5 h-5" aria-hidden="true" />
                </button>
                <button
                  onClick={nextMonth}
                  type="button"
                  className="-my-1.5 -mr-1.5 ml-2 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                >
                  <span className="sr-only">Next month</span>
                  <ChevronRightIcon className="w-5 h-5" aria-hidden="true" />
                </button>
                        </div>
                        <div className="grid grid-cols-7 mt-10 text-xs leading-6 text-center text-gray-500">
                          <div>S</div>
                          <div>M</div>
                          <div>T</div>
                          <div>W</div>
                          <div>T</div>
                          <div>F</div>
                          <div>S</div>
                        </div>
                        <div className="grid grid-cols-7 mt-2 text-sm">
                          {days.map((day, dayIdx) => (
                              <div
                                key={day.toString()}
                                className={classNames(
                                  dayIdx === 0 && colStartClasses[getDay(day)],
                                  'py-1.5'
                                )}
                              >
                                <button
                                  type="button"
                                  onClick={() => {
                                    setSelectedDay(day);
                                    setSchedule(day);
                                }}
                                  className={classNames(
                                    isEqual(day, today) && 'text-white pointer-events-none',
                                    isEqual(day, startOfToday()) && 'pointer-events-none bg-green-500 text-gray-100 ',
                                    !isEqual(day, selectedDay) && 'text-gray-600',
                                    !isEqual(day, selectedDay) &&
                                      isToday(day) &&
                                      'text-red-500',
                                    !isEqual(day, selectedDay) &&
                                      !isToday(day) &&
                                      isSameMonth(day, firstDayCurrentMonth) &&
                                      'text-gray-600',
                                    isEqual(day, selectedDay) && isToday(day) && 'bg-green-500', // set currrent date color
                                    !isEqual(day, selectedDay) && 'hover:bg-gray-300',
                                    (isEqual(day, selectedDay) || isToday(day)) &&
                                      'font-normal',
                                    'mx-auto flex h-8 w-8 items-center justify-center rounded-full',
                                    // (today > day) && 'text-red-500 pointer-events-none', // disable previous date to select
                                    (today > day) && 'bg-gray-400/50  opacity-70 pointer-events-none', // disable previous date to select
                                    ((workerSchedule.includes(format(day, 'yyyy-MM-dd')) && today < day ) && 'bg-sky-500/20 text-gray-600'), // disable previous date to select
                                  )}
                                >
                                  <time dateTime={format(day, 'yyyy-MM-dd')}>
                                    {format(day, 'd')}
                                  </time>
                                </button>

                                <div className="w-1 h-1 mx-auto mt-1 ">
                                  {/* {meetings.some((meeting) =>
                                    isSameDay(parseISO(meeting.startDatetime), day)
                                  ) && (
                                    <div className="w-1 h-1 rounded-full bg-sky-500"></div>
                                  )} */}
                                    {/* <div className="w-1 h-1 rounded-full bg-sky-500"></div> */}
                                </div>
                              </div>
                          ))}
                        </div>
                    </div>
                </div>
            </div>
            <div className="relative block md:inline-block text-left">
                <button onClick={() => { saveSchedule(); }} type="submit" className="hover:text-slate-700 mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 ">
                   Save Changes
                </button>
            </div>
        </div>
    );
}

export default Schedule;
