import axios from "axios";
import router from "./router";

const api = axios.create();

// //Start Request
api.interceptors.request.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
        }
    return config
}, error => {
})

//End response
api.interceptors.response.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
        }
    return config;
}, error => {
    if(error.response.data.message === "Token has expired"){
        console.log("Tokeeeeen has expireeeeed!")
       return axios.post('/api/auth/refresh', {}, {
           headers: {
               'authorization':`Bearer ${localStorage.getItem('access_token')}` //aici trimitem tokenu vechi-expirat
           }
       }).then(res =>{
           localStorage.setItem('access_token', res.data.access_token);
           error.config.headers.authorization = `Bearer ${res.data.access_token}`;

           return api.request(error.config);
       })
    }
    if(error.response.status === 401){
        router.push({name:'Login'});
    }
})

export default api;
