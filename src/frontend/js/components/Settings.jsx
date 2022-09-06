import axios from 'axios';
import React, {useState} from 'react';
import { acf, acf_fields, acf_user, ajaxurl, currentUser } from './Workers';

// console.log(acf_fields);

const Settings = () => {
    const [normalFields, setNormalFields] = useState([
        "text",
        "number"
    ]);

    const [userFields, setUserFields] = useState([
        "first_name",
        "last_name",
    ]);
    const [FirstName, setFirstName] = useState(currentUser.first_name);
    const [LastName, setLastName] = useState(currentUser.last_name);
    const [acfField, setAcfField] = useState(acf_user);


    function setFieldValue(name,event) {
        const newFields =  {[name]: event.target.value}
        setAcfField({...acfField, ...newFields})
    }

    function saveWorkerProfile(event) {
        event.preventDefault();
        // console.log(acfField);
        axios.post(ajaxurl,{
            ac_action: "worker_profile",
            worker: acfField,
            first_name: FirstName,
            last_name: LastName,
        }).then(function (response) {
            // console.log(response.data);
            location.reload();
        }).catch(function (error) {
            // console.log(error);
        });
    }

    return (
        <div className='worker-manager relative w-full space-y-2'>
            <form onSubmit={saveWorkerProfile} encType="multipart/form-data">
                <div className="ml-2 mt-2 rounded-md">
                    <p className=" mb-1 italic text-slate-800 text-sm font-light">
                       First Name
                    </p>
                    <input onChange={(e) => setFirstName(e.target.value)}
                    placeholder="First Name"
                    type="text"
                    value={FirstName}
                    name="first_name"
                    className="border w-full block p-3 border-gray-300/50 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md " />
                </div>

                <div className="ml-2 mt-2 rounded-md">
                    <p className=" mb-1 italic text-slate-800 text-sm font-light">
                       Last Name
                    </p>
                    <input onChange={(e) => setLastName(e.target.value)}
                    placeholder="Last Name"
                    type="text"
                    value={LastName}
                    name="last_name"
                    className="border w-full block p-3 border-gray-300/50 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md " />
                </div>

                {acf_fields.map((field, i) => {
                    if(normalFields.includes(field.type)){
                        return(
                            <div key={field.ID} className="ml-2 mt-2 rounded-md">
                                <p className=" mb-1 italic text-slate-800 text-sm font-light">
                                   {field.label}
                                </p>
                                <input onChange={(e) => setFieldValue(field.name,e)}
                                {...(field.placeholder && field.placeholder !=="" ? {placeholder: field.placeholder} : {})}
                                {...(field.step && field.step !=="" ? {step: field.step} : {})}
                                {...(field.min && field.min !=="" ? {min: field.min} : {})}
                                {...(field.max && field.max !=="" ? {max: field.max} : {})}
                                type={field.type}
                                value={acfField[field.name]}
                                name={field.name}
                                className="border w-full block p-3 border-gray-300/50 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md " />
                            </div>
                        )
                    }else if(field.type=="select"){
                        return(
                            <div key={field.ID} className="ml-2 mt-2 rounded-md">
                                <p className=" mb-1 italic text-slate-800 text-sm font-light">
                                   {field.label}
                                </p>
                               <select onChange={(e) => setFieldValue(field.name,e)} name={field.name} defaultValue={acfField[field.name]} className="border w-full block p-3 border-gray-300/50 shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md " >
                                    {Object.keys(field.choices).map((item) => <option key={item} value={item} >{item}</option>)}
                                </select>
                            </div>
                        )
                    }

                })}

                <div className="relative block md:inline-block text-left w-40 py-4 lg:mx-2 m-0 rounded-lg">
                    <button type="submit" className=" mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:text-gray-800 hover:bg-gray-50 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 ">
                        Update
                    </button>
                </div>
            </form>
        </div>
    );
}

export default Settings;
