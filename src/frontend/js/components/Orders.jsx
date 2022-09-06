import React from 'react';
import { CogIcon,LogoutIcon,ViewGridIcon } from "@heroicons/react/outline";
import { ChevronLeftIcon, ChevronRightIcon,ShoppingCartIcon } from "@heroicons/react/solid";
import { workers,isWorker,logout,orders } from './Workers';
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



const Orders = () => {

    const ordersList = orders.map((order) =>
        <tr  key={order.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" className=" md:block hidden md:px-6 md:py-4 px-2 py-1 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {format( parseISO(order.date), "d MMM, Y")}
            </th>
            <td className="md:px-6 md:py-3 px-3 py-2">
                {order.name ?? "Unknown"}
            </td>
            <td className="md:px-6 md:py-3 px-3 py-2" dangerouslySetInnerHTML={{__html: order.value}}>
            </td>
        </tr>
    );

    return (
        <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table className="w-full mb-0 text-sm text-left text-gray-500 dark:text-gray-400">
                <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" className="md:px-6 md:py-3 px-3 py-2 md:block hidden">
                            Order Created
                        </th>
                        <th scope="col" className="md:px-6 md:py-3 px-3 py-2">
                            Package
                        </th>
                        <th scope="col" className="md:px-6 md:py-3 px-3 py-2">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {ordersList}
                </tbody>
            </table>
        </div>
    );
}

export default Orders;
