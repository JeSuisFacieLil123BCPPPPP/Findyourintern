window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.withCredentials = true;
/*
import Echo from 'laravel-echo';    
    window.Pusher = require('pusher-js');
    
  
     window.Echo = new Echo({

       broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: false,
        authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                axios.post('/api/v1/broadcasting/auth', {
                    socket_id: socketId,
                    channel_name: channel.name
                })
                .then(response => {
                  console.log("response124");
                  console.log(response);
                 //console.log(callback)
                    callback(false, response.data);
                })
                .catch(error => {
                    callback(true, error);
                });
            }
        };
        
    },
  
    });*/
    //window.Echo.connector.pusher.config.auth.headers["Authorization"] = "Bearer token";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
