 import axios from 'axios';
 import Echo from 'laravel-echo';
 import Pusher from 'pusher-js';

 // Axios setup
 window.axios = axios;
 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

 // Pusher setup
 window.Pusher = Pusher;

 // Laravel Echo setup
 window.Echo = new Echo({
     broadcaster: 'pusher',
     key: 'local', // Matches PUSHER_APP_KEY in .env
     cluster: 'mt1',
     wsHost: window.location.hostname,
     wsPort: 6001,
     forceTLS: false,
     disableStats: true,
     enabledTransports: ['ws'],
 });

 // ✅ Listen for broadcasted messages
 window.Echo.channel('chat')
     .listen('.message.sent', (e) => {
         console.log('✅ Received message from Echo:', e);

         // Trigger a browser event to pass the message to the Blade frontend
         window.dispatchEvent(new CustomEvent('new-chat-message', { detail: e }));
     });
