<template>
  <div>
    <a-layout>
      <sidebar
        :user="user"
        :collapsed="collapsed"
        :cle="cle"
        :sidebarlg="sidebarlg"
        @change-sidebar="changeSidebar"
        :search="search"
      >
      </sidebar>

      <a-layout>
        <topbar
          :user="user"
          :collapsed="collapsed"
          :sidebarlg="sidebarlg"
          @change-sidebar="changeSidebar"
          :cle="cle"
          :style="{ background: '#fff', padding: 0 }"
        >
          <div v-if="$route.name == 'realisationprinc'">
            <b-input
              placeholder="Rechercher un projet..."
              rounded
              style="margin-left: 100px; width: 400px"
              :value="search"
              @input="serchValueChnage"
              class="mb-4"
              icon-pack="fas"
              icon-right="search"
              icon-right-clickable
              @icon-right-click="searchIconClick"
            ></b-input>
          </div>
          <div v-if="$route.name == 'realisationsrecherche'">
            <b-input
              placeholder="Rechercher un projet..."
              rounded
              style="margin-left: 100px; width: 400px"
              :value="$route.query.search"
              @input="serchValueChnage"
              class="mb-4"
              icon-pack="fas"
              icon-right="search"
              icon-right-clickable
              @icon-right-click="searchIconClick"
            ></b-input>
          </div>
          <div v-if="$route.name == 'createrealisations'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px">Ajout d'une réalisation/projet</span>
              </template>
            </b-field>
          </div>
          <div v-if="$route.name == 'realisationdeatails'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px">Détails d'une réalisation/projet</span>
              </template>
            </b-field>
          </div>
        </topbar>
        <a-layout-content
          :style="{
            margin: '18px 25px 0',
            'margin-left': detmargeMain,
            'min-height': '100vh',
            //background: 'red',
            padding: '15px',
            background: '#fff',
          }"
        >
          <router-view></router-view>
        </a-layout-content>
        <a-layout-footer
          style="textalign: center"
          :style="{ margin: '18px 25px 0', 'margin-left': detmargeMain }"
        >
          EtStudent ©2022 Created by F
        </a-layout-footer>
      </a-layout>
    </a-layout>
    <!--<sidebar :user="user" :sidebarstate="sidebarstate" :sidebarlg="sidebarlg"> </sidebar>-->
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
//import test from "../components/test.vue";
export default {
  // components: { test },
  data() {
    return {
      realisations: [],
      overlay: false,
      collapsed: false,
      sidebarlg: "240px",
      reduce: false,
      open: true,
      cle: 0,
      search: "",
    };
  },

  computed: {
    detmargeMain() {
      // var sidebar = document.getEmentbyId("sidebar");
      if (this.collapsed == true) {
        this.sidebarlg = "80" + "px";
        return "100px";
      } else if (this.collapsed == false) {
        this.sidebarlg = "240" + "px";
        return "220px";
      } /*else {
        //this.sidebarlg = "0x";
        return "2px";
      }*/
    },

    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  async beforeMount() {
    await this.getAllRealisationsValide();
  },
  methods: {
    serchValueChnage(val) {
      //console.log("value");
      //console.log(val);
      this.search = val;
    },
    searchIconClick() {
      if (this.search.length != 0 && this.$route.name == "realisationprinc")
        this.$router.push({
          // path: 'realisationsRecherche',
          name: "realisationsrecherche",
          query: {
            search: this.search,
          },
        });
      else {
        this.$router.push({
          // path: 'realisationsRecherche',
          name: "realisationsrecherche",
          query: {
            ...this.$route.query,
            search: this.search,
          },
        });
      }
    },
    ...mapActions({
      logout: "auth/logout", // map `this.add()` to `this.$store.dispatch('increment')`
    }),
    changeSidebar() {
      console.log("kouma");
      /*this.sidebarstate = !this.sidebarstate;*/
      this.collapsed = !this.collapsed;
    },
    realisView(realisationId) {
      this.$router.push({
        path: "contact",
        params: {
          realisationId: realisationId,
        },
      });
    },
    async getAllRealisationsValide() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsValide")
        .then((response) => {
          console.log(response);
          console.log(response.data.data);

          this.realisations = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    handleScroll(event) {
      console.log("scroller");
    },
  },
  mounted() {
    console.log("red");
    console.log(this.$route.name);
    var route = this.$route.name;
    switch (route) {
      case "realisationprinc":
        this.cle = 1;
        break;
      case "createrealisations":
        this.cle = 2;
        break;
      case "listrealisations":
        this.cle = 3;
        break;
      /* case "categories":
        this.cle = 4;
        break;
      case "subcategories":
        this.cle = 5;
        break;*/
    }
    //console.log(this.$route.name);
    window.Echo.private("realisation").listen(".realisation.created", (e) => {
      // this.addTodo(e.task);
      //this.$store.commit("task/ADD_TODO", e.task);
      // this.newTodo.title = "";
      console.log(e);
      console.log("real ajouter avec succès");
    });
    /* window.Echo.channel("realisation").listen("realisation.created", (e) => {
      // this.addTodo(e.task);
      //this.$store.commit("task/ADD_TODO", e.task);
      // this.newTodo.title = "";
      console.log(e);
      console.log("real ajouter avec succès");
    });*/

    window.onscroll = () => {
      console.log("scroll");
    };
  },
  watch: {
    $route(to, from) {
      // this.cle = value;
      console.log(to.name);
      console.log(to.path);
      switch (to.name) {
        case "realisationprinc":
          this.cle = 1;
          break;
        case "createrealisations":
          this.cle = 2;
          break;
        case "listrealisations":
          this.cle = 3;
          break;
        /*  case "categories":
          this.cle = 4;
          break;
        case "subcategories":
          this.cle = 5;
          break;*/
      }
    },
  },
  /*watch(){
     window.innerWidth(value){
          if(value<=750){

          }
     }
  },*/
  beforeEnter: (to, from, next) => {
    console.log("route");
    console.log(to.name);
    var cle = 0;
    switch (to.name) {
      case "realisationprinc":
        cle = 1;
        break;
      case "createrealisations":
        cle = 2;
        break;
      case "listrealisations":
        cle = 3;
        break;
      /*  case "categories":
        cle = 4;
        break;
      case "subcategories":
        cle = 5;
        break;*/
    }
    this.cle = cle;
    // alert("yogh");
  },
  /*  created() {
    window.addEventListener("scroll", this.handleScroll);
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  },*/
};
</script>
<style scoped lang="scss"></style>
