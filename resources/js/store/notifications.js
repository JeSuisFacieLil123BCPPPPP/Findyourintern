import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);


export default {
    namespaced: true,
    state :{
       notifications: [],
        toRemove: null,
        newNotification: {
            title: '',
           state: false
        }
    },
    getters :{
        newNotification: state => {
            return state.newNotification
        },
        notifications: state => {
            return state.notifications
        },
        toRemove: state => {
            return state.toRemove
        }  
    },
   /* actions :{
        ADD_TODO({commit}, todo) {
            axios.post('/api/todos', todo).then(res => {
                console.log(res.data.task)
                if (res.data.data === "added"){
                commit('ADD_TODO',res.data.task)
                    console.log('ok')
                }
            }).catch(err => {
                console.log(err)
            })
        },
        DELETE_TODO({commit}, todo) {
            axios.delete(`/api/todos/${todo.id}`)
                .then(res => {
                    if (res.data.data === 'deleted')
                    console.log(res.data.data);
                    //commit('CACHE_REMOVED',res.data.task)
                        commit('DELETE_TODO',res.data.task)
                        console.log('deleted')
                }).catch(err => {
                    console.log(err)
                })
        },
        GET_TODOS({commit}) {
            axios.get('/api/todos')
                .then(res => {
                    {  
                        commit('GET_TODOS', res.data)
                    }
                }).catch(err => {
                    console.log(err)
                })
        }
    },*/
    mutations : {
        ADD_NOTIFICATION(state, notification) {
            state.notifications.unshift(notification)
        },
        CACHE_REMOVED(state, notification) {
          state.toRemove = notification;
        },
        GET_NOTIFICATIONS(state, notifications) {
            state.notifications = notifications
        },
        DELETE_TODO(state, notification) {
console.log(state.notifications.findIndex(object => {
    return object.id === notification.id;
  }))
            state.notifications.splice(state.notifications.findIndex(object => {
                return object.id === notification.id;
              }), 1)
            state.toRemove = null;
        }
    },
    }