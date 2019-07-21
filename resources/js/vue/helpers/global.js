export default{
    methods:{
        getLaravelCSRF(Vue){
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                Vue.$axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            } else {
                console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
            }
        },
        isEmpty(obj) {
            for(var key in obj) {
                if(obj.hasOwnProperty(key))
                    return false;
            }
            return true;
        }

    }
}