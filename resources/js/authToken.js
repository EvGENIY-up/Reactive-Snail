import axios from 'axios';

class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');
        if (this.token) {
             axios.defaults.headers.common['Authorization'] = 'Bearer' + this.token;
        }
    }

    saveToken(token) {
        this.token = token;
        window.localStorage.setItem('token', this.token);
        axios.defaults.headers.common['Authorization'] = 'Bearer' + this.token;
    }
    
    deleteToken() {
        window.localStorage.removeItem('token');
        this.token = null;
    }

     checkToken() {
       return !! this.token
    }
}

export default new Auth();