<template>
  <a-config-provider :locale="locale">
    <v-app>
      <router-view></router-view>
    </v-app>
  </a-config-provider>
</template>
<script>
import frFr from "ant-design-vue/lib/locale-provider/fr_FR"; //en_US
import enUS from "ant-design-vue/lib/locale-provider/en_US";
export default {
  data() {
    return {
      locale: frFr,
      locale1: enUS,
    };
  },
  mounted() {
    // console.log("monte100");
    /* window.Echo.private("App.User." + this.$route.params.id).listen("newMessage", (e) => {
      console.log("message de la conversations");
      console.log(e);
    });*/
    /*console.log("koweit");
    window.Echo.channel("realisation").listen(".realisation.created", (e) => {
      // this.addTodo(e.task);
      //this.$store.commit("task/ADD_TODO", e.task);
      // this.newTodo.title = "";
      console.log(e);
      console.log("real ajouter avec succès");
    });
    window.Echo.channel("realisation").listen("realisation.created", (e) => {
      // this.addTodo(e.task);
      //this.$store.commit("task/ADD_TODO", e.task);
      // this.newTodo.title = "";
      console.log(e);
      console.log("real ajouter avec succès");
    });*/
  },
};
</script>
<style lang="scss"></style>
