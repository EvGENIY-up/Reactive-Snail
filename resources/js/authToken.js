import axios from 'axios';

class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');
        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;
        if (this.token) {
             axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
    }

    login(token, user) {
        this.token = token;
        this.user = user;
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }
    
    logout() {
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('user');
        this.token = null;
        this.user = null;
    }

     check () {
       return !! this.token
    }
}

export default new Auth();