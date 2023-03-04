import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);


export default {
    namespaced: true,
    state :{
        realisations: [],
        toRemove: null,
        /*newTodo: {
            title: '',
            completed: false
        }*/
    },
    getters :{
        /*newTodo: state => {
            return state.newTodo
        },*/
        realisations: state => {
            return state. realisations
        },
        toRemove: state => {
            return state.toRemove
        }  
    },
    actions :{
        ADD_REALISATION({commit},userId,formData) {
            axios
            .post("/api/v1/users/" + userId + "/realisations",formData)
            .then((response) => {
              console.log(response);
              return response;
              /*this.$vs.notify({
                color: "success",
                title: "SUCCES",
                text: "La REALISATION/PROJET A ETE AJOUTE AVEC SUCCES",
              });*/
              //this.init();
            })
            .catch(({ response: { data } }) => {
              console.log(data);
              return data;
              /*this.$vs.notify({
                color: "danger",
                title: "Erreur",
                text: data,
              });*/
            })
          /*  .finally(() => {
             
            });*/
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
    },
    mutations : {
       /* ADD_TODO(state, todo) {
            state.todos.unshift(todo)
        },*/
        CACHE_REMOVED(state, realisation) {
          state.toRemove =  realisation;
        },
        GET_REALISATIONS(state, realisations) {
            state.todos = realisations
        },
        DELETE_TODO(state, todo) {
           // console.log(state.todos.indexOf(todo))
           // const thetodo = (element) => element.id > 13;

//console.log(array1.findIndex(isLargeNumber));
console.log(state.todos.findIndex(object => {
    return object.id === todo.id;
  }))
            state.todos.splice(state.todos.findIndex(object => {
                return object.id === todo.id;
              }), 1)
            state.toRemove = null;
        }
    },
    }