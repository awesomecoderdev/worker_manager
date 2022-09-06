export const workers = ac_worker_manager.workers;
export const ajaxurl = ac_worker_manager.ajaxurl;
export const currentPage = ac_worker_manager.hook;
export const isLoggedIn = ac_worker_manager.is_user_logged_in;
export const url = ac_worker_manager.url;
export const user = ac_worker_manager.user;
export const isWorker = ac_worker_manager.type;
export const logout = ac_worker_manager.logout;
export const orders = ac_worker_manager.orders;
export const currentUser = user ? JSON.parse(atob(user)) : [];
export const acf = ac_worker_manager.acf;
export const acf_fields = ac_worker_manager.acf_fields;
export const acf_user = ac_worker_manager.acf_user;



// console.log(currentUser.ac_worker_manager_schedule);
console.log(currentUser);

export default {
    workers,
    ajaxurl,
    currentPage,
    isLoggedIn,
    url,
    user,
    isWorker,
    logout,
    orders,
    currentUser,
    acf,
    acf_fields,
    acf_user,
}