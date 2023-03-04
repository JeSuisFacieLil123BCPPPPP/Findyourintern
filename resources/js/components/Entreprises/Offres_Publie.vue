<template>
  <div class="">
    <div class="">
      <!-- <div class="my-2" style="height: 150px; background: white">
        <a-row :gutter="[16, 16]" class="w-100 m-2">
          <a-col :xs="24" :md="24">
            <a-divider>
              <div class="">
                <b-field>
                  <template #label>
                    <span class="fw-bold text-h4 ms-3 text-black"
                      >Les offres d'emploi ou de stage disponibles
                    </span></template
                  >
                </b-field>
              </div></a-divider
            >
          </a-col>
        </a-row>
      </div>
      <div class="my-2" style="height: 150px; background: white">
        <a-row :gutter="[16, 16]">
          <a-col :xs="24" :md="24">
            <b-field label="" class="" expanded>
              <b-input
                placeholder="Rechercher une offre par titre"
                rounded
                style="margin-left: 100px; width: 400px"
                v-model="searchText"
                type="text"
                class="mb-4"
              ></b-input>
              <p class="control" style="width: 40px">
                <b-button type="is-bleue is-light" @click="searchIconClick">
                  <b-icon icon="magnify" size="is-small"> </b-icon
                ></b-button>
              </p>
            </b-field>
          </a-col>
        </a-row>
      </div>-->
      <div class="pa-3 mx-2 my-2 vert-b" style="background: #24855a">
        <a-row :gutter="[16, 16]" class="w-100 m-2">
          <a-col :xs="24" :md="24">
            <a-divider>
              <div class="">
                <b-field>
                  <template #label>
                    <span class="fw-bold text-h4 ms-3 text-white"
                      >Les offres d'emploi ou de stage disponibles
                    </span></template
                  >
                </b-field>
              </div></a-divider
            >
          </a-col>
        </a-row>
      </div>
      <div class="pa-3 mx-2 bg-white">
        <a-row :gutter="[16, 16]" class="w-100 m-2">
          <a-col :xs="24" :md="24">
            <b-field label="" class="" expanded>
              <b-input
                placeholder="Rechercher une offre par titre"
                rounded
                style="margin-left: 100px"
                v-model="searchText"
                type="text"
                class="mb-4 w-100"
              ></b-input>
              <p class="control" style="width: 40px">
                <b-button type="is-bleue is-light" @click="searchIconClick">
                  <b-icon icon="magnify" size="is-small"> </b-icon
                ></b-button>
              </p>
            </b-field>
          </a-col>
        </a-row>
      </div>
      <div class="p-2 w-100 d-flex flex-column justify-content-between m-2 flex-wrap">
        <div v-if="activeLoading == false">
          <v-card
            v-for="(offre, i) in offres"
            :key="i"
            class="mx-4 my-2 d-flex flex-column p-2 position-relative"
            :flat="true"
            style="border-radius: 15px"
          >
            <v-btn
              class="d-none d-md-block"
              absolute
              :rounded="true"
              :retain-focus-on-click="true"
              medium
              top
              flat
              right
              style="cursor: auto; background: #24855a; color: white"
            >
              <v-icon>mdi-palette-swatch</v-icon>
              <span class="ms-2">{{ offre.type }}</span>
            </v-btn>
            <div class="d-flex flex-column justify-content-between m-2 flex-wrap">
              <div class="p-2">
                <div class="d-flex bd-highlight">
                  <!--<div class="p-2 flex-shrink-1 bd-highlight">
                    <v-img
                      v-if="offre.user.user.logo == null"
                      lazy-src="https://picsum.photos/id/11/10/6"
                      class="h-100"
                      width="100"
                      src="https://picsum.photos/id/11/500/300"
                      style="border-radius: 8px; margin-right: 10px"
                    ></v-img>
                    <v-img
                      v-else
                      lazy-src="https://picsum.photos/id/11/10/6"
                      class="h-100"
                      width="100"
                      :src="offre.user.user.logo"
                      style="border-radius: 8px; margin-right: 10px"
                    ></v-img>
                  </div>-->
                  <div class="p-2 w-100 bd-highlight">
                    <div>
                      <b-field class="">
                        <template #label>
                          <span style="font-size: 20px"> {{ offre.title }}</span>
                        </template>
                      </b-field>
                    </div>

                    <div>
                      <b-field class="">
                        <template #label>
                          <span style="font-size: 14px; font-weight: bold" class="m-1">{{
                            offre.user.user.company_name
                          }}</span>
                        </template>
                      </b-field>
                    </div>

                    <div
                      v-html="offre.description"
                      v-line-clamp:20="2"
                      style="max-width: 70%"
                    ></div>
                  </div>
                </div>
              </div>

              <div class="m-1">
                <div class="d-flex flex-row justify-content-between flex-wrap">
                  <!--<span class="me-2"
                        ><v-icon size="20">mdi-eye</v-icon>
                        <span>{{ realis.nbr_vue }}</span> <span>{{ " vues" }}</span></span
                      >-->
                  <div class="d-flex flex-row flex-wrap justify-content-between">
                    <b-tag
                      outlined
                      style="color: black"
                      :selected="false"
                      size="is-medium"
                      class="mx-1 my-1"
                    >
                      <span
                        ><v-icon size="20" class="mx-2" style="color: black"
                          >mdi-calendar</v-icon
                        >
                        <span>{{
                          "Publié le " + moment(offre.created_at).format("L")
                        }}</span></span
                      >
                    </b-tag>
                    <b-tag
                      outlined
                      style="color: black; cursor: normal"
                      :selected="false"
                      size="is-medium"
                      class="mx-1 my-1"
                    >
                      <span
                        ><v-icon size="20" class="mx-2" style="color: black"
                          >mdi-timer-outline</v-icon
                        >{{
                          "Date limite : " +
                          moment(new Date(offre.date_limite)).format("LL")
                        }}</span
                      >
                    </b-tag>

                    <b-tag
                      v-if="offre.zone != null"
                      outlined
                      :selected="false"
                      style="cursor: normal"
                      size="is-medium"
                      class="mx-1"
                    >
                      <span
                        ><v-icon size="20" class="ms-2" style="color: black"
                          >mdi-map-marker</v-icon
                        >{{ offre.zone }}</span
                      >
                    </b-tag>
                  </div>

                  <div class="">
                    <b-button
                      v-if="offre.statut == false && user.user_type == 'student'"
                      hovered
                      selected
                      style="background: #24855a; color: white"
                      @click="postulerView(offre.id)"
                      rounded
                      >Postuler
                    </b-button>
                    <b-button
                      v-else-if="user.user_type == 'student' && offre.statut == true"
                      hovered
                      selected
                      style="color: white"
                      class="rouge-b"
                      @click="monDossierView(offre.id)"
                      rounded
                      >Mon dossier</b-button
                    >
                    <b-button
                      rounded
                      outlined
                      style="border-color: #24855a; color: #24855a"
                      @click="offreView(offre.id)"
                      >Lire plus</b-button
                    >
                  </div>
                </div>
              </div>
            </div>
          </v-card>
          <div style="margin-top: 35px">
            <b-button
              v-if="offres.length != total"
              @click="getAllOffresPaginateNext"
              rounded
              hovered
              type="is-bleue"
              class="translate-middle start-50 top-100"
            >
              <a-spin v-if="loading == true" />
              <span v-if="!loading">Voir plus</span>
            </b-button>
          </div>
        </div>
        <div v-else class="position-absolute top-50 start-50 translate-middle">
          <a-spin size="large"> </a-spin>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "offrePrinc",
  data() {
    return {
      e1: 1,
      formData1: new FormData(),
      offre: {
        type: "",
        secteur: "",
        fonction: "",
        responsabilite: "",
        exigences: "",
        zone: "",
        disponiblite: "",
        date_limite: "",
      },
      isLoading: false,

      model: 0,
      show: true,
      //loading: false,
      activeLoading: false,
      offres: [],
      visible: false,
      moment,
      searchText: "",

      loading: false,
      busy: false,
      // firstPage: 1,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false,
      error: null,
      statut: false,

      secteurs: [
        { name: "Informatique,Telecom,Internet" },
        { name: "Energie, Mines, Matière première" },
        { name: "Banque, Assurance, Finance" },
      ],
      fonctions: [
        { name: "Création/Design" },
        { name: "Administration réseau" },
        { name: "Sécurité réseaux" },
        { name: "Désigner web" },
        { name: "Développeur d'application mobile" },
      ],
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    searchIconClick() {
      this.$router.push({
        name: "offresrecherche",
        query: {
          title: this.searchText,
        },
      });
    },
    offreView(offreId) {
      this.$router.push({
        name: "offredetails",
        params: {
          offreId: Number(offreId),
        },
      });
    },
    monDossierView(offreId) {
      this.$router.push({
        name: "dossierdetails",
        params: {
          offreId: Number(offreId),
        },
      });
    },
    postulerView(offreId) {
      this.$router.push({
        name: "postuler",
        params: {
          offreId: Number(offreId),
        },
      });
    }, //getAllRealisationsValideSearch
    async getAllOffresPaginate() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getOffresPaginate")
        .then((res) => {
          console.log(res);
          console.log(res.data.data);

          this.offres = res.data.data;
          this.offres.forEach((element) => {
            // console.log(element);
            element.statut = false;
            element.postuler.forEach((ele) => {
              if (ele.id == this.user.id) {
                console.log("stat");

                element.statut = true;
                console.log(element);
              } //else element.statut = false;
            });
          });
          console.log("offfres");
          console.log(this.offres);
          // this.data = res.data.data;
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          //  this.currentPage = res.data.meta.currentPage;
          this.nextPage = this.nextPage < this.lastPage ? 2 : this.lastPage;
          //this.loading = false;
          this.activeLoading = false;
        })
        .catch((error) => {
          console.log("error");
          console.log(error);
          this.activeLoading = false;
        });
      //  .finally(() => (this.activeLoading = false));
    },
    getAllOffresPaginateNext() {
      if (/*bottomOfWindow && */ this.offres.length < this.total) {
        this.loading = true;
        axios
          .get("/api/v1/offres/getOffresPaginate", {
            params: { page: this.nextPage },
          })
          .then((res) => {
            this.offres = this.offres.concat(res.data.data);
            //this.data = res.data.data;
            this.currentPage = res.data.meta.currentPage || this.currentPage;
            this.nextPage =
              this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;
            // this.activeLoading = false;
            this.loading = false;
          });
      }
      // };
    },
    async getStatut(offre) {
      console.log("getstatut");
      console.log(this.user.id);
      console.log(offre.postuler);
      const postulants = offre.postuler;
      var postulant = postulants.find((row) => {
        return row.id == this.user.id;
      });
      console.log("post");
      console.log(postulant);
      if (postulant != null) return true;

      return false;
    },
  },
  mounted() {
    console.log("monted");
    //this.getAllRealisationsPaginateNext();
  },
  async beforeMount() {
    await this.getAllOffresPaginate();
  },
};
</script>
<style lang="scss">
.marge {
  margin: 0px !important;
}
.vert {
  color: #24855a; /*hsl(153, 53%, 53%);*/
}
.jaune {
  color: #fdfd02; //hsl(44, 100%, 77%);
}
.rouge {
  color: #f2062f; //hsl(14, 100%, 53%);
}
.vert-b {
  background-color: #24855a; /*hsl(153, 53%, 53%);*/
}
.jaune-b {
  background-color: #fdfd02; //hsl(44, 100%, 77%);
}
.rouge-b {
  background-color: #f2062f; //hsl(14, 100%, 53%);
}
/*.conteneur {
  margin-bottom: 100px;
}
@media (max-width: 1200px) {
  .box-search-ele1 {
    display: block;
  }
  .box-search-ele2 {
    display: none;
  }
  .conteneur {
    display: flex;
    flex-direction: column;
  }
  .box-search {
    position: fixed;
    margin-bottom: 2px;
    z-index: 300;
    //bottom: 75px;
  }
  .liste {
    margin-right: 10px;
    z-index: 250;
    margin-top: 220px;
    position: relative;
    min-height: 300px;
    min-width: 80%;
  }
  .v-card {
    width: 100%;
  }
}

@media (min-width: 1200px) {
  .box-search-ele2 {
    display: block;
  }
  .box-search-ele1 {
    display: none;
  }
  .conteneur {
    display: flex;
    flex-direction: row;
  }
  .box-search {
    position: fixed;
    margin-bottom: 2px;
    bottom: 75px;
  }
  .liste {
    position: relative;
    min-height: 300px;
    min-width: 20%;
    margin-left: 300px;
    right: 10px;
  }
  .v-card2 {
    width: 300px;
  }
}*/
</style>
