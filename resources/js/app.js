/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue').default;
import Vue from 'vue';
window.Vue = Vue;
import router from './router/index';
import App from './App.vue';
//import changeComponent from './mixin/changeComponent';
import store from './store/index';



import Swal from 'sweetalert2';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css'
import './css/style.css';
import './css/elevation.css';
import './css/buefy.scss';
import './css/ant-theme.less'
import Buefy from 'buefy';
//import 'buefy/dist/buefy.css';
import vuetify from './plugins/vuetify';
//import { Icon } from 'ant-design-vue';
//import { Input } from 'ant-design-vue';
//import Vuetify from 'vuetify';
//import 'vuetify/dist/vuetify.min.css';

//Vue.use(Vuetify);

import Antd from 'ant-design-vue';
//import "ant-design-vue/dist/antd.css";
import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
import myVideo from  'vue-media-player';
import EditorJS from '@editorjs/editorjs';
import { VueEditor, Quill } from "vue2-editor";

Vue.use(VueEditor);
import lineClamp from 'vue-line-clamp'
 

//Vue.use(Quill);
//Vue.use(EditorJS);
//import './src/sass/main.scss';
//import { Upload} from 'ant-design-vue';
//import { defineComponent, ref } from 'vue';
//import VueConfirmDialog from 'vue-confirm-dialog';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

  Vue.component('my-video',myVideo);
  Vue.component('VueEditor',VueEditor);

Vue.use(Buefy);

Vue.use(Vuesax);

Vue.use(Antd);

Vue.use(VueFileAgent);

Vue.use(lineClamp, {
  // plugin options
})
Vue.component('like',require('./components/Like.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard-admin-layout', require('./components/Layout/DashboardAdminLayout.vue').default);
Vue.component('topbar', require('./components/Layout/Topbar.vue').default);
Vue.component('realisations-princ', require('./components/Realisations/RealisationsPrinc.vue').default);
//Vue.component('realisations-princ', require('./components/Realisations/RealisationsPrinc.vue').default);

Vue.component('sidebar', require('./components/Layout/Sidebar.vue').default);
Vue.component('comments', require('./components/Comments/comments.vue').default);
Vue.component('comment', require('./components/Comments/comment.vue').default);//ForgotPassword.vue
Vue.component('comment-child', require('./components/Comments/commentChild.vue').default);
Vue.component('forgot-password', require('./components/Users/ForgotPassword.vue').default);

Vue.component('messagerie-component', require('./components/Messagerie/MessagerieComponent.vue').default);
Vue.component('message', require('./components/Messagerie/Message.vue').default);

Vue.component('postulants', require('./components/Postuler/Postulants.vue').default);

Vue.component('portfolio', require('./components/Portfolio/PortfolioComponent.vue').default);
Vue.component('portfolio-c', require('./components/Portfolio/PortfolioComp.vue').default);

Vue.component('offres-c', require('./components/Entreprises/Offres_Publie.vue').default);
//Vue.component('comp-postulants', require('./components/Postuler/Offre_Postulant_Comp.vue').default);

Vue.component('mana', require('./components/mana.vue').default);



//../components/mana.vue'
Vue.component('test', require('./components/test.vue').default);
Vue.component('description', require('./components/Description.vue').default);
Vue.component('bar-chart', require('./components/BarChart.vue').default);
Vue.component('item', require('./components/Item.vue').default);

//Les icons en svg
//Vue.component('inscrire-employeur', require('./components/Icons/inscrire-employeur-1.vue').default);
//Vue.component('description-icon-1', require('./components/Icons/description-1.vue').default);
//Vue.component('infos-base', require('./components/Icons/infos-base-1.vue').default);
//Vue.component('medias-1', require('./components/Icons/medias-1.vue').default);
//Vue.component('publier-offre-1', require('./components/Icons/publier-offre-1.vue').default);
//Vue.component('add-details-icon-1', require('./components/Icons/add-details-icon-1.vue').default);

import { Bar } from 'vue-chartjs';

//Vue.component('realisation-princ', require('./components/Realisations/RealisationsPrinc.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
    render: h => h(App)
});


/*window.Echo.channel("realisation").listen(".realisation.created", (e) => {
  // this.addTodo(e.task);
  //this.$store.commit("task/ADD_TODO", e.task);
  // this.newTodo.title = "";
  console.log(e);
  console.log("real ajouter avec succès");
});*/

/*var channel = window.Pusher.subscribe('realisation');
channel.bind('realisation.created', function(data) {
  app.messages.push(JSON.stringify(data));
});*/
