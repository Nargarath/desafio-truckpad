import axios from "../interceptor";


const ApiService = {
    get(route,params) 
    {
        return axios.get(route(route),params).catch(error => {
          throw new Error(`[TRUCKPAD] ApiService ${error}`);
        });
    },
    post(route,params)
    {
        return axios.post(route(route),params);
    },
    update(route,params) 
    {
        return axios.put(route(route),params);
    },
    
    put(route, params)
    {
        return axios.put(route(route),params);
    },
    
    delete(route) 
    {
        return axios.delete(route(route)).catch(error => {
          throw new Error(`[TRUCKPAD] ApiService ${error}`);
        });
    }
};

export default ApiService;
