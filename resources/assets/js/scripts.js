import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
let client = require('pusher-js');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token.content
    }
})



window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
    // forceTLS: true,
    // client: client
    auth: {
        headers:
            {
                'Authorization': 'Bearer ' + 'xKrOX6jjH8WUDiDSngEOBb2yH00h8gwOlTWTuZNM'
            }
    },
})

window.Echo.private('chat.1000000000')
    .listen('message.sent', (e) => {
        alert(e.data.message);
    });
