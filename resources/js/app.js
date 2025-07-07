 import './bootstrap';
import '../css/app.css';

import Echo from 'laravel-echo';
window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':3000'
});

window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log('📩 New message received:', e.message);
    });
