 import Vue from 'vue';
    import Vuex from 'vuex';
    import router from '../router';
    Vue.use(Vuex);
    
    function deleteProperties(obj) {
        for (var property in obj) {
            console.log("type ")
            console.log(typeof obj[property])
          if (typeof obj[property] === "object") {
            deleteProperties(obj[property]);
          }
          delete obj[property];
        }
        console.log(obj)
      }

      const modelOffre= {
        title: "",
        type: "",
        lieu: "",
        secteur: "",
        description: "",
        exigences: "",
        //fonction: "",
        // responsabilite: "",
        exigences: "",
        zone: "",
        // disponiblite: "",
        date_limite: "",
        date_deb: "",
        nbr: 0,
        //time: "Jour(s)",
       // nbrTime: 0,
        duree: {
           nbrTime:0,
            time:"Jour(s)",
        },
        salaire: {
            device:"",
            montant:"",
            time:"par jour",
        },
        horaires: [],
        urgence: 1,
        emails:{},
      };
    export default {
        namespaced: true,
        //namespaced: true,
    state :{
       // emails:{},
        offres:{},
        //formData1: new FormData(),
       // radio: "Je suis normal",
       // radio1: "",  
       // e1:1,  
        steps:{}       
     },
        getters :{
           /* getOffreById: (state) => (id) => {
                console.log('id')
                console.log(id)
               let result= state.offres[id];
               if(result){
                return result;
               }else{
                return null;
               }
              },*/
              getOffre(state, getters, rootState, rootGetters) {
                let userId=rootGetters["auth/getUser"].id;
                //state=null;
                console.log(state);
                //deleteProperties(state.offres[userId].telephoneNum);
               /* deleteProperties(state.offres);
                deleteProperties(state.steps);
                deleteProperties(state.emails);
                deleteProperties(state.radio);
                deleteProperties(state.radio1);
                deleteProperties(state.formData1);
                deleteProperties(state.e1);*/
               // state.offres[userId]=null;
              /* state=null;*/
              // state.offres={};
               
              // state.steps={};
                if(state.offres[userId]){
                return state.offres[userId];
                }else{
                    return {...modelOffre,...{emails:{[0]:rootGetters["auth/getUser"].email}}};
                }
               
            },
              getStep(state, getters, rootState, rootGetters) {
                let userId=rootGetters["auth/getUser"].id;
                if(state.steps[userId]){
                    return state.steps[userId];
                    }else{
                        return 1;
                    }
            },
           /* getEmails(state, getters, rootState, rootGetters) {
                 
                let userId=rootGetters["auth/getUser"].id;
               // return state.offres[userId].emails;
                if(state.offres[userId].emails){
                    if(Object.keys(state.offres[userId].emails).length==0){
                      return  Object.assign({},{[0]:rootGetters["auth/getUser"].email}); 
                    }else{
                        return state.offres[userId].emails;
                    }
                   
                    }else{
                        return  Object.assign({},{[0]:rootGetters["auth/getUser"].email});
                    }
            },*/
            getRadio1(state) {
    
                return state.radio1
            },
            getFormData1(state) {
                return state.formData1
            },
        },
        actions :{
            step1({ dispatch, commit, getters, rootGetters },offre){           
                 let userId=rootGetters["auth/getUser"].id;
                commit('SET_OFFRE_STEP_1',{offre,userId});
                //commit('SET_RADIO',"ca y est ");
                commit('SET_STEP',{userId,step:2});                
             },
             step2({ dispatch, commit, getters, rootGetters },offre){           
                 let userId=rootGetters["auth/getUser"].id;
                commit('SET_OFFRE_STEP_2',{offre,userId});
                commit('SET_STEP',{userId,step:3});                
             },
             step3({ dispatch, commit, getters, rootGetters },offre){           
                let userId=rootGetters["auth/getUser"].id;
                commit('SET_OFFRE_STEP_3',{offre,userId});
               commit('SET_STEP',{userId,step:4});                
            },
            step4({ dispatch, commit, getters, rootGetters },offre){           
                let userId=rootGetters["auth/getUser"].id;
                console.log('step4');
                console.log(offre);
                commit('SET_OFFRE_STEP_4',{offre,userId});
               commit('SET_STEP',{userId,step:5});
               console.log('offre')
               //console.log(getters.getOffre)   ;             
            }
        },
        mutations : {
            REMOVE_ALL(state,user){
/*state.offres={};
                state.steps={};
                state.emails={};
                state.radio={};
                state.e1={};
                state.offre={};*/
               // deleteProperties(state.offres[userId]);
              /* state.offres=null;
               state.emails=null;
               state.steps=null;*/
              //state.offres[userId]=null;
             // state.steps[userId]=null;*/
             state.offres={...state.offres,...{[user.id]:null}};
             state.steps={...state.steps,...{[user.id]:1}};
            // state.steps[user.id]=1;
            },
            SET_STEP(state,{userId,step}){

                state.steps={...state.steps,...{[userId]:step}};
             },
             SET_RADIO(state,value){
                 state.radio=value;
             },

             SET_OFFRE_STEP_1(state,{offre,userId}) {
                let   newOffre={...state.offres[userId],...offre};//Object.assign(state.offres[userId],offre4);//newOffre={...state.offres[userId],...offre4};//Object.assign(state.offres[userId],offre4);
                console.log(newOffre);            
             state.offres=Object.assign(state.offres,{[userId]:newOffre});
             console.log(state.offres[userId]);      
             },
             SET_OFFRE_STEP_2(state,{offre,userId}) {
                let   newOffre= Object.assign(state.offres[userId],offre);
                state.offres=Object.assign(state.offres,{[userId]:newOffre}); 
            },
            SET_OFFRE_STEP_3(state,{offre,userId}) {
                let   newOffre= Object.assign(state.offres[userId],offre);
                state.offres=Object.assign(state.offres,{[userId]:newOffre});
            },
            SET_OFFRE_STEP_4(state,{offre,userId}) {
                //const newOffre={...state.offres[userId],...offre4};
                //console.log({...state.offres[userId],...offre4});
                console.log(offre);
                console.log('new offre');
                let   newOffre={...state.offres[userId],...offre};//Object.assign(state.offres[userId],offre4);//newOffre={...state.offres[userId],...offre4};//Object.assign(state.offres[userId],offre4);
                console.log(newOffre);            
             state.offres=Object.assign(state.offres,{[userId]:newOffre});
             console.log(state.offres[userId]); 
            },
            ADD_EMAIL(state,{email,userId}){
                //console.log(Object.keys(state.emails[userId]).length);
               // deleteProperties(state.emails[userId]); n'oublie pas de corriger, quand tu réinit aucun index n'est
          
                const index=Object.keys(state.offres[userId].emails) ? Object.keys(state.offres[userId].emails).length :0;
                //const newEmailsp={...state.emails[userId],...{[index]:email}};
               // state.offres={...state.offres,...{[userId]:Object.assign(state.offres[userId],{[index]:email})}};
               state.offres = {
                ...state.offres,
                ...{
                  [userId]: Object.assign(state.offres[userId], {
                    [index]: email,
                  }),
                },
              };
            }
           
        },
        }