import { forEach } from 'lodash';
import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);


export default {
    namespaced: true,
    state :{
        conversations: {},
    },
    getters :{

        conversations: state => {
            return state.conversations
        },
        messages : function (state) {
            return function({id}){
                let conversation=state.conversations[id];
                if(conversation && conversation.messages){
                    return conversation.messages;
                }else{
                    return [];
                }
            }
        },
       /* messages: (state) => (id) => {
            let conversation=state.conversations[id];
            if(conversation && conversation.messages){
                return conversation.messages;
            }else{
                return [];
            }
          },*/
        conversation: (state) => (id) => {
            if(state.conversations[id])
                return  state.conversations[id] 
                else
                return {};
            }
    
    },
    actions :{
      async  loadConversations({commit}) {
           await axios.get('/api/v1/conversations').then(res => {
                console.log(res.data.conversations)
                commit('ADD_CONVERSATIONS',{conversations:res.data.conversations})
            }).catch(err => {
                console.log(err)
            })
        },
        async loadMessages(context,conversationId){
           // if(!context.getters.conversation(conversationId).loaded){
            await axios.get('/api/v1/conversation/'+conversationId).then(res => {
                console.log("messagesdata")
                    console.log(res.data.messages)   
                    context.commit('ADD_MESSAGES',{messages:res.data.messages,id:conversationId})
                    console.log('ok');
                }).catch(err => {
                    console.log(err)
                })
           // }
        },

        async sendMessage(context,{content,user_rec_id}){

            await axios.post('/api/v1/conversation/sendMessage',{
                userRecId:user_rec_id,
                body:content,
              })
              .then((response) => {
                console.log(response);
                context.commit('ADD_MESSAGE',{message:response.data.message,conversationId:user_rec_id});
              })
              .catch((error) => {
                console.log(error);
              });
            }

           /* setUser(context,UserId){
                
            }*/

    },
    mutations : {
        ADD_CONVERSATIONS(state,{conversations}){
            conversations.forEach(function(c){
                const id=c.id;
                let conversation=state.conversations[id] ? state.conversations[id] : {messages:[]};
                conversation={...conversation,...c}
                state.conversations={...state.conversations,...{[id]:conversation}};
            })
        },
        ADD_MESSAGES(state,{messages,id}){
            console.log(messages)
            let conversation= state.conversations[id] ? state.conversations[id] : {};
            conversation.loaded=true;
            conversation.messages=messages;
            console.log('cid')
            console.log(id)
            state.conversations={...state.conversations,...{[id]:conversation}};
        },
        ADD_MESSAGE(state,{message,conversationId}){
            console.log(state.conversations[conversationId].messages);
            state.conversations[conversationId].messages.push(message);
           let conversation= state.conversations[conversationId];
            //console.log('coverid')
           // console.log(conversationId)
            state.conversations={...state.conversations,...{[conversationId]:conversation}};
           /* let conversation=state.conversations[id] || {};
            conversation.loaded=true;
            conversation.messages=messages;
            state.conversations={...state.conversations,...{[id]:conversation}};*/
        }
    }
}