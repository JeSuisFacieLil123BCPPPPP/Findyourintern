import Vue from 'vue';
import Vuex from 'vuex';
import router from '../router';
Vue.use(Vuex);


export default {
    namespaced: true,
    state :{
        authenticated: false,
        user: {user_type:''},
        nathe:"nathe"
    },
    getters :{
        getAuthenticated(state) {
            return state.authenticated
        },
        getUser(state) {
            return state.user
        }
    },
    actions :{
        login({ commit }) {
            return axios.get('/api/user').then(({ data }) => {
                console.log(data);
                commit('SET_USER', data.data)
                commit('SET_AUTHENTICATED', true)
                //alert(data.data.user_type)
                switch (data.data.user_type) {
                    case 'admin':
                        router.push({ name: 'dashboard'})
                       
                      // router.push({name:'appli'})
                      //router.push({ name: 'realisationprinc', })
                        break;
                    case 'comapny':
                        //router.push({ name: 'specialappli', })
                        //router.push({name:'appli'})
                        router.push({ name: 'accueil'})
                        break;
                    case 'student':
                        //router.push({ name: 'accueilspecial', })
                       // router.push({name:'appli'})
                        router.push({ name: 'accueil', })
                        break;
                    default:
                        //router.push({ name: 'realisationprinc', })
                        router.push({ name: 'accueil', })  
                        break;
                }
            }).catch(({ response: { data } }) => {
                commit('SET_USER',{user_type:''})
                commit('SET_AUTHENTICATED', false)
               
               // alert("echec login")
            })
        },
       async logout({ commit }) {
          await axios.post('/api/logout').then(({ data }) => {
                console.log(data);
                commit('SET_USER', {user_type:''})
                commit('SET_AUTHENTICATED', false)
                //alert("success logout")
                router.push({ name: 'login' })
            }).catch(({ response: { data } }) => {
               
            });
           
        }
    },
    mutations : {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = value
           // alert(state.user.email)
        }
    },
    }