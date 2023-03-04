import Vue from 'vue';
 import Vuex from 'vuex';
 import createPersistedState from 'vuex-persistedstate';
 import { createLogger } from 'vuex';

 import auth from './auth';
 import conversation from './conversation';
 import publierOffre from './publierOffre';
 
 Vue.use(Vuex);
 
 export default new Vuex.Store({
    /* plugins:[
         createPersistedState()
     ],*/
     plugins: [createPersistedState(),createLogger()],
     modules:{
       auth: auth,
       conversation:conversation,
       publierOffre: publierOffre,
     }
 });