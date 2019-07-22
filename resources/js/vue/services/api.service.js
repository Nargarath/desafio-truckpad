import axios from "../interceptor";


const ApiService = {

    get(route,params) 
    {
        return axios.get(window.route(route),params).catch(error => {
          throw new Error(`[TRUCKPAD] ApiService ${error}`);
        });
    },
    post(route,params)
    {
        return axios.post(window.route(route),params);
    },
    put(route,params) 
    {
        return axios.put(window.route(route),params);
    },
    
    patch(route, params)
    {
        return axios.patch(window.route(route),params);
    },
    
    delete(route) 
    {
        return axios.delete(window.route(route)).catch(error => {
          throw new Error(`[TRUCKPAD] ApiService ${error}`);
        });
    }
};

export default ApiService;
