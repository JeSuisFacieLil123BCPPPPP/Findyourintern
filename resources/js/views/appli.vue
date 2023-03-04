<template>
  <!--<a-layout>
      <topbar :user="user" :cle="cle">
        <div v-if="/*$route.name == 'accueil' && user.user_type == 'student'*/ 1 == 1">
          <b-input
            placeholder="Rechercher une offre..."
            rounded
            style="width: 400px"
            :value="search"
            @input="serchValueChnage"
            class="me-3"
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
        <div v-if="$route.name == 'offresrecherche'">
          <b-input
            placeholder="Rechercher une offre..."
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
      </topbar>

     
      <a-layout-content
        :style="{
          //margin: '18px 25px 0',
          // marginLeft: '280px',
          // marginRight: '280px',
          minHeight: '100vh',
          //background: 'red',
          // padding: '15px',
          // background: '#fff',
        }"
      >
        
      </a-layout-content>
      <a-layout-footer
        style="textalign: center"
        :style="{
          'margin-left': $route.path.includes('/offres/postulants') ? '400px' : '0px',
          //position:fixed
          /*margin: '18px 25px 0'*/
        }"
      >
        OES-Students ©2022 Tous les droits sont réservés
      </a-layout-footer>
    </a-layout>-->
  <div id="components-layout-demo-basic">
    <a-layout>
      <!-- <b-navbar
            type="is-success"
            style="height: 82px"
            :fixed-top="true"
            :spaced="true"
            :shadow="true"
            class="w-100"
            :style="{
              top: 0,
              right: 0,
            }"
            id="topnavbar"
          >
            <template #brand>
              <b-navbar-item tag="router-link" :to="{ path: '/' }"> </b-navbar-item>
            </template>
            <template #start>
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
            </template>
            <template #end>
              <b-navbar-item
                style="color: black"
                key="1"
                :class="{
                  ' text-muted rounded menu-ele2 ': cle == 1 ? true : false,
                }"
                class="text-black"
              >
                <router-link :to="{ path: '/realisationsStudents' }">
                  <span style="color: white">Acceuil</span></router-link
                ></b-navbar-item
              >
              !--<b-navbar-item href="#projets"> Projets étudiants</b-navbar-item>--
              <b-navbar-item
                v-if="user.user_type == 'student'"
                style="color: black"
                key="2"
                :class="{
                  ' text-muted rounded menu-ele2 ': cle == 2 ? true : false,
                }"
                class="text-black"
              >
                <router-link :to="{ path: '/create/realisations' }">
                  <span style="color: white">Soumettre un projet</span></router-link
                >
              </b-navbar-item>
              <b-navbar-item
                v-else-if="user.user_type == 'company'"
                style="color: black"
                key="3"
                :class="{
                  ' text-muted rounded menu-ele2 ': cle == 3 ? true : false,
                }"
                class="text-black"
              >
                <router-link :to="{ path: '/create/offre' }">
                  <span style="color: white">Publier une offre</span></router-link
                >
              </b-navbar-item>
            <b-navbar-item
               
                style="color: black"
                key="4"
                :class="{
                  ' text-muted rounded menu-ele2 ': cle == 4 ? true : false,
                }"
                class="text-black"
              >
                <router-link :to="{ path: '/offres/postulants' }">
                  <span style="color: white">Postulants</span></router-link
                >
              </b-navbar-item>
              <b-navbar-dropdown
                label="Entreprises"
                style="color: black"
                key="5"
                :class="{
                  ' text-muted rounded menu-ele2 ': cle == 5 ? true : false,
                }"
                class="text-black"
              >
                <b-navbar-item>
                  <router-link :to="{ path: '/create/offre' }">
                    <span style="">Publier une offre</span></router-link
                  >
                </b-navbar-item>
                <b-navbar-item>
                  <router-link :to="{ path: '/offres/all' }">
                    <span style="">Offres d'emploi/stage</span></router-link
                  >
                </b-navbar-item>
              </b-navbar-dropdown>
              <b-navbar-item
                style="color: black"
                key="6"
                :class="{
                  ' text-muted rounded menu-ele2 ': cle == 6 ? true : false,
                }"
                class="text-black"
              >
                <router-link :to="{ path: '/create/realisations' }">
                  <span style="color: white">Messagerie</span></router-link
                >
              </b-navbar-item>
  
              <b-dropdown aria-role="list" v-if="user != null" position="is-bottom-left">
                <template #trigger="{ active }">
                  <a-tooltip placement="topLeft">
                    <template slot="title">
                      <vs-list-item :title="user.pseudo" :subtitle="user.email">
                      </vs-list-item>
                    </template>
                    <vs-avatar
                      size="large"
                      v-if="user.avatar != null"
                      :src="user.avatar.variants['small'].secure_url"
                    />
                    <vs-avatar v-else icon="person" size="large" />
                  </a-tooltip>
                </template>
                <b-dropdown-item aria-role="listitem">
                  <vs-list-item :title="user.pseudo" :subtitle="user.email">
                    <template slot="avatar">
                      <vs-avatar
                        size="large"
                        v-if="user.avatar != null"
                        :src="user.avatar.variants['small'].secure_url"
                      />
                      <vs-avatar v-else icon="person" size="large" />
                    </template>
                  </vs-list-item>
                </b-dropdown-item>
                <b-dropdown-item
                  aria-role="listitem"
                  class="d-flex flex-row justify-content-center align-items-center"
                >
                  <div class="buttons button is-bleue" @click="logout">
                    <b-icon icon="logout"></b-icon> <strong>Se déconnecter</strong>
                  </div>
                </b-dropdown-item>
                !-- <b-dropdown-item aria-role="listitem">Another action</b-dropdown-item>
              <b-dropdown-item value="logout" aria-role="menuitem" @click="logout">
                <b-icon icon="logout"></b-icon>
                Se déconnecter
              </b-dropdown-item>--
              </b-dropdown>
              <b-navbar-item tag="div" v-else>
                <div class="buttons">
                  <router-link :to="{ path: '/login' }" class="button is-warning"
                    ><strong>Se connecter</strong></router-link
                  >
                  <router-link :to="{ path: '/register' }" class="button is-danger"
                    >S'inscrire</router-link
                  >
                </div>
              </b-navbar-item>
            </template>
          </b-navbar>-->
      <topbar :user="user" :cle="cle">
        <!--<v-text-field
            label="Rechercher un projet..."
            solo
            style="margin-left: 100px; width: 400px"
            v-model="search"
            :rounded="true"
            class="mt-2"
            append-outer-icon="
              search"
          ></v-text-field>-->
        <div v-if="$route.name == 'accueil' && user.user_type == 'student'">
          <b-input
            placeholder="Rechercher une offre..."
            rounded
            style="width: 400px"
            :value="search"
            @input="serchValueChnage"
            class="me-3"
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
        <div v-if="$route.name == 'offresrecherche'">
          <b-input
            placeholder="Rechercher une offre..."
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
        <!--<div v-if="$route.name == 'createrealisations'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px; color: white">Ajouter d'une réalisation</span>
              </template>
            </b-field>
          </div>
          <div v-if="$route.name == 'realisationdetails'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px; color: white">
                  <span
                    v-if="realisation != null"
                    class="text-truncate d-inline-block"
                    style="width: 800px"
                    >Détails du projet {{ " " + realisation.title }}</span
                  ></span
                >
              </template>
            </b-field>
          </div>
          <div v-if="$route.name == 'offres_postulants'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px; color: white">
                  <span class="text-truncate d-inline-block" style="width: 800px"
                    >Les offres que j'ai publié</span
                  ></span
                >
              </template>
            </b-field>
          </div>
          <div v-if="$route.name == 'postulants'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px; color: white">
                  <span class="text-truncate d-inline-block" style="width: 800px"
                    >Détails de l'offre</span
                  ></span
                >
              </template>
            </b-field>
          </div>
          <div v-if="$route.name == 'reponsePostuler'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px; color: white">
                  <span class="text-truncate d-inline-block" style="width: 800px"
                    >Répondre à un postulant</span
                  ></span
                >
              </template>
            </b-field>
          </div>-->
        <!--<div v-if="$route.name == 'postingOffre'" style="margin-left: 100px">
            <b-field>
              <template #label>
                <span style="font-size: 25px; color: white">
                  <span class="text-truncate d-inline-block" style="width: 800px"
                    >Publier une offre d'emploi ou de stage</span
                  ></span
                >
              </template>
            </b-field>
          </div>-->
      </topbar>
      <!--<div :style="{ height: '100px', width: '100%', background: 'green' }"></div>-->
      <a-layout-content
        :style="{
          minHeight: '100vh',
        }"
      >
        <!--<portfolio :user="user"></portfolio>-->
        <router-view></router-view>
        <!--<a-carousel arrows dots-class="slick-dots slick-thumb">
              <a slot="customPaging" slot-scope="props">
                <img :src="getImgUrl(props.i)" />
              </a>
              <div v-for="item in 4">
                <img :src="baseUrl + 'abstract0' + item + '.jpg'" />
              </div>
            </a-carousel>-->
        <!--<p class="font-weight-black text-h1" style="color: black">Nos projets</p>-->
      </a-layout-content>
      <a-layout-footer
        style="textalign: center"
        :style="{
          //    'margin-left': $route.path.includes('/offres/postulants') ? '400px' : '0px',
          //position:fixed
          /*margin: '18px 25px 0'*/
        }"
      >
        FindYourIntern ©2023 Tous les droits sont réservés
      </a-layout-footer>
    </a-layout>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import test from "../components/test.vue";
import topbar from "../components/Layout/Topbar.vue";
const baseUrl =
  "https://raw.githubusercontent.com/vueComponent/ant-design-vue/master/components/vc-slick/assets/img/react-slick/";
export default {
  components: { test, topbar },
  data() {
    return {
      icons: ["mdi-facebook", "mdi-twitter", "mdi-linkedin", "mdi-instagram"],
      realisation: null,
      offres: [],
      baseUrl,
      realisations: [],
      overlay: false,
      collapsed: false,
      sidebarlg: "240px",
      reduce: false,
      open: true,
      cle: 0,
      search: "",

      model: 0,
      items: [
        {
          src:
            "https://moocs.uac.bj/pluginfile.php/1/theme_klass/slide3image/1591958149/moocs3.jpg",
        },
        {
          src:
            "https://moocs.uac.bj/pluginfile.php/1/theme_klass/slide2image/1591958149/moocs2.jpg",
        },
        {
          src:
            "https://moocs.uac.bj/pluginfile.php/1/theme_klass/slide1image/1591958149/moocs1.jpg",
        },
        /* {
          src: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg",
        },*/
      ],
      data: [
        {
          title: "Ant Design Title 1",
        },
        {
          title: "Ant Design Title 2",
        },
        {
          title: "Ant Design Title 3",
        },
        {
          title: "Ant Design Title 4",
        },
      ],
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
    getImgUrl(i) {
      return `${baseUrl}abstract0${i + 1}.jpg`;
    },
    serchValueChnage(val) {
      //console.log("value");
      //console.log(val);
      this.search = val;
    },
    searchIconClick() {
      if (this.user.user_type == "student") {
        if (this.search.length != 0 && this.$route.name == "realisationprinc")
          this.$router.push({
            // path: 'realisationsRecherche',
            name: "offresrecherche",
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
      } else if (this.user.user_type == "company") {
        if (this.search.length != 0)
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
    async getRealisationbyId() {
      console.log("psg");
      console.log(this.$route.params);
      await axios
        .get("/api/v1/realisations/" + this.$route.params.realisationId)
        .then((response) => {
          this.realisation = response.data.data;
          console.log("soloman");
          console.log(this.realisation);
        })
        .catch((error) => {
          console.log(error);
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
  /*beforeRouteUpdate(to, from, next) {
    const name = to.name;
    switch (name) {
      case "accueil":
        this.cle = 1;
        next();
        break;
      case "createrealisations":
        this.cle = 2;
        next();
        break;
      case "listrealisations":
        this.cle = 2;
        next();
        break;
    }
  },*/
  provide() {
    return {
      message: this.cle,
    };
  },
  mounted() {
    console.log("red");
    console.log(this.$route.name);
    var route = this.$route.name;
    if (route == "realisationdetails") {
      console.log("larrrrrrrrrr");
      this.getRealisationbyId();
    }
    switch (this.$route.name) {
      case "accueil":
        this.cle = 1;
        break;
      case "createrealisations":
        this.cle = 2;
        break;
      case "listrealisations":
        this.cle = 2;
        break;
      case "offres_postulants":
        this.cle = 3;
      /* case "realisationprinc":
        this.cle = 2;
        break;*/
      case "realisationprinc":
        if (this.user.user_type == "student") this.cle = 7;
        else this.cle = 6;
        break;
      case "portfolio":
        this.cle = 2;
        break;
      case "postingOffre":
        this.cle = 3;
        break;
      case "portfolioPrinc":
        this.cle = 8;
        // this.cle = 3;
        break;
      case "offres_postulants":
        this.cle = 3;
      case "alloffres":
        if (user.user_type == "student" || user.user_type == "company") this.cle = 4;
        // else this.cle = 3;
        break;
      case "mesdossiers":
        this.cle = 5;
        break;
    }
  },
  /* beforeMount() {
    console.log("red1");
    console.log(this.$route.name);
    var route = this.$route.name;
    switch (route) {
      case "accueil":
        this.cle = 1;
        break;
      case "createrealisations":
        this.cle = 2;
        break;
      case "listrealisations":
        this.cle = 3;
        break;
    }
  },*/
  watch: {
    $route(to, from) {
      console.log("route");
      console.log(to.name);
      //console.log(to.path);
      if (to.name == "realisationdetails") {
        console.log("larrrrrrrrrr");
        this.getRealisationbyId();
      }
      switch (to.name) {
        case "accueil":
          this.cle = 1;
          break;
        case "createrealisations":
          this.cle = 2;
          break;
        case "listrealisations":
          this.cle = 2;
          break;
        case "realisationprinc":
          if (this.user.user_type == "student") this.cle = 7;
          else this.cle = 6;
          break;
        case "portfolio":
          this.cle = 2;
        case "postingOffre":
          this.cle = 3;
          break;
        case "portfolioPrinc":
          this.cle = 8;
          break;
        case "alloffres":
          /* if (this.user.user_type == "company")*/ this.cle = 4;
          // else this.cle = 3;
          break;
        case "mesdossiers":
          this.cle = 5;
          break;
      }
    },
  },
  /*beforeEnter: (to, from, next) => {
    console.log("route");
    console.log(to.name);
    console.log(to.path);
    if (to.name == "realisationdetails") {
      console.log("larrrrrrrrrr");
      this.getRealisationbyId();
    }
    switch (to.name) {
      case "accueil":
        this.cle = 1;
        break;
      case "createrealisations":
        this.cle = 2;
        break;
      case "listrealisations":
        this.cle = 2;
        break;
      case "postingOffre":
        this.cle = 3;
        break;
      case "alloffres":
        this.cle = 3;
        break;
    }
  },*/
  /*  created() {
    window.addEventListener("scroll", this.handleScroll);
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  },*/
};
</script>
<style scoped lang="scss">
.menu-ele2 {
  background: #f2061a !important;
  color: white !important;
  border-radius: 10px;
}
#components-layout-demo-basic .ant-layout-header,
#components-layout-demo-basic .ant-layout-footer {
  background: #24855a;
  color: #fff;
}
.router-border {
  border-style: none !important;
}

.ant-layout-content {
  //background: rgba(16, 142, 233, 1);
  //color: #fff;
  margin-top: 25px;
  min-height: calc(100vh) !important;
  //padding: 20px;
}
</style>
