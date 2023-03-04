<template>
  <div id="components-layout-demo-basic">
    <a-layout>
      <a-layout-sider>
        <sidebar
          :user="user"
          :collapsed="collapsed"
          :cle="cle"
          :sidebarlg="sidebarlg"
          @change-sidebar="changeSidebar"
          :search="search"
        >
        </sidebar
      ></a-layout-sider>
      <a-layout>
        <a-layout-header
          style="height: 80px"
          :style="{ position: 'fixed', zIndex: 1, width: '100%' }"
        >
          <!--<topbar
            :user="user"
            :collapsed="collapsed"
            :sidebarlg="sidebarlg"
            @change-sidebar="changeSidebar"
            :cle="cle"
          >
            !--<v-text-field
            label="Rechercher un projet..."
            solo
            style="margin-left: 100px; width: 400px"
            v-model="search"
            :rounded="true"
            class="mt-2"
            append-outer-icon="
              search"
          ></v-text-field>--
            <div v-if="$route.name == 'accueil'">
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
                  <span style="font-size: 25px; color: white">Ajout d'un projet</span>
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
            </div>
            <div v-if="$route.name == 'createoffre'" style="margin-left: 100px">
              <b-field>
                <template #label>
                  <span style="font-size: 25px; color: white">
                    <span class="text-truncate d-inline-block" style="width: 800px"
                      >Publier une offre d'emploi ou de stage</span
                    ></span
                  >
                </template>
              </b-field>
            </div>
          </topbar>-->
        </a-layout-header>
        <a-layout-content
          :style="{
            //margin: '18px 25px 0',
            //'margin-left': detmargeMain,
            'min-height': '100vh',
            //background: 'red',
            // padding: '15px',
            // background: '#fff',
          }"
        >
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
        <!--<a-layout-footer
          style="textalign: center"
          :style="{
            /*margin: '18px 25px 0'*/
          }"
        >
          UAC Students Emplois ©2022 Created by DAKE Facie
        </a-layout-footer>-->
      </a-layout>
    </a-layout>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import test from "../components/test.vue";
const baseUrl =
  "https://raw.githubusercontent.com/vueComponent/ant-design-vue/master/components/vc-slick/assets/img/react-slick/";
export default {
  components: { test },
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
};
</script>
<style scoped lang="scss">
.menu-ele2 {
  background: red !important;
  color: white !important;
  border-radius: 10px;
}
/*#components-layout-demo-basic {
  text-align: center;
}*/
#components-layout-demo-basic .ant-layout-header,
#components-layout-demo-basic .ant-layout-footer {
  background: hsl(153, 53%, 53%);
  color: #fff;
}
</style>
