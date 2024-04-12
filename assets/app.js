import './styles/app.scss'; 
import './bootstrap'; 
import { createApp } from 'vue' 
 
createApp({ 
  data() { 
    return { 
      compteur: 0 
    } 
  } 
}).mount('#app') 