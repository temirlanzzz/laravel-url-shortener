require('./bootstrap');
import {createApp} from "vue";
import PostIndex from './components/Posts/Index'

const app = createApp({})
app.component('short-link',PostIndex)
app.mount('#app')
