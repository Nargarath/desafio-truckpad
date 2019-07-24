import axios from "../interceptor";


const ApiService = {

    get(route,params,uri = {} ) 
    {
        return axios.get(window.route(route,uri),params).catch(error => {
          throw new Error(`[TRUCKPAD] ApiService ${error}`);
        });
    },
    post(route,params)
    {
        return axios.post(window.route(route),params);
    },
    put(route,params,uri) 
    {
        return axios.put(window.route(route,uri),params);
    },
    
    patch(route, params, uri)
    {
        return axios.patch(window.route(route,uri),params);
    },
    
    delete(route,uri) 
    {
        return axios.delete(window.route(route,uri)).catch(error => {
          throw new Error(`[TRUCKPAD] ApiService ${error}`);
        });
    }
};

export default ApiService;
