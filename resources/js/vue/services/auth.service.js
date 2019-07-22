import ApiService from './api.service';


const AuthService = {

    login( email, password )
    {
        return ApiService.post('auth.login',{ email, password });
    },
    logout()
    {
        return ApiService.get('auth.logout');
    },
    refresh()
    {
        return ApiService.get('auth.refresh');
    },
    me()
    {
        return ApiService.get('auth.me');
    }
};

export default AuthService;