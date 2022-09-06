import React,{useState,useEffect,useRef,Fragment} from 'react';
import { CogIcon,LogoutIcon,ViewGridIcon } from "@heroicons/react/outline";
import { ChevronLeftIcon, ChevronRightIcon,ShoppingCartIcon,CalendarIcon, ExclamationCircleIcon } from "@heroicons/react/solid";
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
import Position from './Position';
import Rate from './Rate';
import Experience from './Experience';
import JobType from './JobType';
import Calendar from './Calendar';
import Worker from './Worker';
import { acf, workers } from './Workers';

function isJSON(str) {
  try {
      return (JSON.parse(str) && !!str);
  } catch (e) {
      return false;
  }
}

const Filter = () => {
  const [searchPosition, setSearchPosition] = useState("");
  const [searchJobType, setSearchJobType] = useState("");
  const [searchRate, setSearchRate] = useState("");
  const [searchExperience, setSearchExperience] = useState("");
  const [searchCalendar, setSearchCalendar] = useState([]);
  const [filteredWorkers, setFilteredWorkers] = useState(workers);
  const isMountRef = useRef(0);

  const filteredWorkerWithPosition = searchPosition === acf.position[0] ? workers : workers.filter((worker) => {
    const position = worker.position ? worker.position.toString().toLowerCase() : acf.position[0];
    return position.replace(/\s+/g, '').includes(searchPosition.toLowerCase().replace(/\s+/g, ''))
  });
  // console.log("filteredWorkerWithPosition",filteredWorkerWithPosition);

  const filteredWorkerWithJobType = searchJobType === acf.type_of_job[0] ? filteredWorkerWithPosition : filteredWorkerWithPosition.filter((worker) => {
    const type_of_job = worker.type_of_job ? worker.type_of_job.toString().toLowerCase() : acf.type_of_job[0];
    return type_of_job.replace(/\s+/g, '').includes(searchJobType.toLowerCase().replace(/\s+/g, ''))
  });
  // console.log("filteredWorkerWithJobType",filteredWorkerWithJobType);

  const filteredWorkerWithRate = searchRate === acf.day_rate[0] ? filteredWorkerWithJobType : filteredWorkerWithJobType.filter((worker) => {
    const day_rate = worker.day_rate ? worker.day_rate.toString().toLowerCase() : acf.day_rate[0];
    return day_rate.replace(/\s+/g, '').includes(searchRate.toLowerCase().replace(/\s+/g, ''))
  });
  // console.log("filteredWorkerWithRate",filteredWorkerWithRate);

  const filteredWorkerWithExperience = searchExperience === acf.experience[0] ? filteredWorkerWithRate : filteredWorkerWithRate.filter((worker) => {
    const experience = worker.experience ? worker.experience.toString().toLowerCase() : acf.experience[0];
    return experience.replace(/\s+/g, '').includes(searchExperience.toLowerCase().replace(/\s+/g, ''))
  });
  // console.log("filteredWorkerWithExperience",filteredWorkerWithExperience);

  const filteredWorkerWithCalendar = searchCalendar.length == 0 ? filteredWorkerWithExperience : filteredWorkerWithExperience.filter((worker) => {
    const schedules = (worker.ac_worker_manager_schedule && isJSON(worker.ac_worker_manager_schedule)) ? JSON.parse( worker.ac_worker_manager_schedule) : [];
    if(schedules.length == 0){
      return false;
    }else{
      const haveWorkerSchedule = searchCalendar.filter(function(schedule) {
        return schedules.includes(schedule);
      });
      // console.log("haveWorkerSchedule",haveWorkerSchedule);
      return haveWorkerSchedule.length != 0;
    }
  });
  // console.log("filteredWorkerWithCalendar",filteredWorkerWithCalendar);

  useEffect(() => {
    if(isMountRef.current > 1){
      setFilteredWorkers(filteredWorkerWithCalendar)
    }
    isMountRef.current ++;
  }, [
    searchPosition,
    searchJobType,
    searchRate,
    searchExperience,
    searchCalendar,
  ]);

  function search() {
    const submitSearch = filteredWorkerWithCalendar;
    console.log(submitSearch);
    setFilteredWorkers(submitSearch)
    // console.log("searched");
    // console.log(setFilteredWorkers(filteredWorkerWithCalendar));
  }

  return (
    <Fragment>
      <div className='worker-manager grid lg:grid-cols-4 md:grid-cols-2'>
        <Position searchPosition={searchPosition} setSearchPosition={setSearchPosition} />
        <JobType searchJobType={searchJobType} setSearchJobType={setSearchJobType} />
        <Rate searchRate={searchRate} setSearchRate={setSearchRate} />
        <Experience searchExperience={searchExperience} setSearchExperience={setSearchExperience} />
      </div>
      <div className="worker-manager w-full my-4 flex justify-between lg:flex-row md:flex-col flex-col  ">
        <div className="lg:w-72 md:w-full">
          <Calendar searchCalendar={searchCalendar} setSearchCalendar={setSearchCalendar} />
          {/* <div className="relative block md:inline-block text-left w-full px-3  py-4 lg:mx-2 m-0 rounded-lg">
            <button type="submit" onClick={search} className=" mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:text-gray-800 hover:bg-gray-50 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 ">
                Search
            </button>
          </div> */}
        </div>

        <div className="relative lg:w-4/5 w-full lg:ml-2 lg:my-0 mt-4 ml-0 lg:px-2 px-0">
          <div className="bg-white h-full">
            {/* <div className="relative grid lg:grid-cols-2"> */}
                  {filteredWorkers.length > 0 ? (
                    <div className="relative grid space-y-4 overflow-y-scroll max-h-96 last:pb-5 scrollbar:!w-1.5 scrollbar:!h-1.5 scrollbar:bg-transparent scrollbar-track:!bg-slate-100 scrollbar-thumb:!rounded scrollbar-thumb:!bg-slate-300 scrollbar-track:!rounded supports-scrollbars:pr-2">
                      {
                        filteredWorkers.map((worker) => (
                          <Worker
                            key={worker.nickname}
                            worker={worker}
                          />
                        ))
                      }
                       {/* {
                        filteredWorkers.map((worker) => (
                          <Worker
                            key={worker.nickname}
                            worker={worker}
                          />
                        ))
                      } */}
                    </div>
                  ) : (
                    <div className="relative grid lg:space-y-0 space-y-4">
                      <div className="relative w-full flex justify-center items-center h-screen max-h-96 rounded-lg  ">
                        <div className="flex items-center space-x-2">
                            <ExclamationCircleIcon className='class="h-5 w-5 text-red-500/70' />
                            <p className="text-sm text-slate-500">No worker available.</p>
                        </div>
                      </div>
                    </div>
                  )}
          </div>
        </div>
      </div>
    </Fragment>
  );
};

export default Filter;

