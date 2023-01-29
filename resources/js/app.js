import './bootstrap';
// require('./bootstrap')

import { createApp } from 'vue'

import App from './App.vue'



import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

const YOUR_TOKEN_FROM_LOGIN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ODUzMWI2MS03Mzk3LTRjMjAtYWNmYi1mOTgzNzkwZjZhYmQiLCJqdGkiOiJlZmY3OWZlYjE1NDIwZjlkYjNkMTA1MDZiODA4YzQ5NjY0ZWU5MWYxNGQ4ZjBlODExYmE2Y2FjYTY0NmZiYjBmMDNhYjU5MjI4ZTkxZjE5NiIsImlhdCI6MTY3NDgyODE4MS43NTgxMjUsIm5iZiI6MTY3NDgyODE4MS43NTgxMjgsImV4cCI6MTcwNjM2NDE4MS43NDg0NTYsInN1YiI6IjMiLCJzY29wZXMiOltdfQ.XPuePQVPtAvfyC0oza_4pyHJfd6Mu6-95XtIAJN6-PXERCDskq8nGYdj6Gjy1SXggGyNwfnxfFtU_XcoyQ8sCVtUPQZm9XW9llgQhXW5daYUSXXRigyL3o3pBXyo2JR6NARzZ7Ou6lPDo_Omywx5B726iuLpMQcVOayyf1qjGQxjMe0IJeCOoIlAw0bFNOv-gNAphQGUwFCBYTSNe3j8FGY3bfJAhyDChXUQk4kHf4JiTl8izrRHaBVDSH3I9ewvRUw0hIXY8eDMPf-xH054YiqqecSasog3I1eDb6dh0Nc9nCf23kLfHcXNXn3zb9acW-flcqfl_gNjhKEoK24ho1rbsMSngOgfoXMxDagF2A3xtsu035Zz_a2dshr3dCc5gj8YbXX4Hp3MAlh4lc2xQsCLhdxem1ic2c69b6rOhWxK1xcH5IlzjmL2Cg64-HoBy8IBigJ2LUqr3XkqnN9Oni01vv2knHiIhm-RT0LFZW36PKc5cMJ8SWHoXgd-8kM8beNC0_KxRvo_HSuW1GXvIb2jbXB2HaakDZrh-JMwBIuX59qBs4ZsOFaXaqPLpxq68l3EHQYBOUPrH5IUYnwBohxaM2JoNGPx2-XTS5WimQPd2DEURpxPkGtjOM5LzgP_XC_CykF2pNbT1Upn2jtMzjYgXWlGdIFdPPAFg-vs-7o';
// console.log(process.env.VUE_APP_WEBSOCKETS_KEY);

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'local',
    wsHost: '127.0.0.1',
    wsPort: 6002,
    cluster: "mt1",
    forceTLS: false,
    disableStats: true,
    authEndpoint :'http://127.0.0.1:8000/api/broadcasting/auth',
    auth:{
        headers: {
            Authorization: 'Bearer '+ YOUR_TOKEN_FROM_LOGIN,
        }
    },

});


createApp(App).mount('#todolist-app')
