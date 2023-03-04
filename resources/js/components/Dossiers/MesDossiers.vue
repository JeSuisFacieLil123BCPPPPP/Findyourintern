<template>
  <div style="height: 100vh">
    <div
      class="d-flex flex-row justify-content-center align-items-center mt-3"
      v-if="activeLoading == false"
    >
      <v-card style="width: 80%" elevation="3">
        <vs-list>
          <v-card-title style="font-size: 25px" color="#24855a" class="elevation_3 mb-2">
            <a-divider>
              <b-field>
                <template #label>
                  <span style="font-size: 25px">Les offres auxquelles j'ai postulé</span>
                </template>
              </b-field>
            </a-divider></v-card-title
          >
          <!--<v-list-item
            v-for="offre in offres"
            :key="offre.id"
            class="liste"
            @click="monDossierView(offre.id)"
            :class="{ selected: $route.params.offreId == offre.id ? true : false }"
          >
            <v-list-item-content class="position-relative">
              <v-list-item-title v-text="offre.title"></v-list-item-title>
              <vs-button
                color="success"
                type="border"
                class="position-absolute top-50 start-80"
                >Déjà traité</vs-button
              >
            </v-list-item-content>
          </v-list-item>-->
        </vs-list>
        <a-card
          class="d-flex bd-highlight liste"
          v-for="offre in offres"
          :key="offre.id"
          @click="monDossierView(offre.id)"
          :class="{ selected: $route.params.offreId == offre.id ? true : false }"
        >
          <div class="p-2 flex-grow-1 bd-highlight">{{ offre.title }}</div>
          <div class="p-2 flex-grow-1 bd-highlight" v-if="offre.zone">
            {{ offre.zone }}
          </div>
          <div class="p-2 flex-grow-1 bd-highlight">sdfghn</div>
          <div class="p-2 bd-highlight">
            <vs-button color="success" type="border" class="">Consulter l'état</vs-button>
            <!--<vs-button color="danger" type="border" class="">
              <span v-if="postulant.reponse == null"
                ><vs-button color="danger" type="border">En attente</vs-button></span
              >
              <span v-else
                ><vs-button color="#24855a" type="border">Déjà traité</vs-button></span
              ></vs-button
            >-->
          </div>
        </a-card>
      </v-card>
    </div>
    <div v-else class="position-absolute translate-middle top-50 start-50">
      <div>
        <div>
          <a-spin style="color: green; border-color: green" size="large"></a-spin>
        </div>
        <!-- <b-message type="is-success " :closable="false">
            Chargement des données...
          </b-message>-->
      </div>
    </div>
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      model: 0,
      show: true,
      //loading: false,
      activeLoading: true,
      offres: [],
      visible: false,
      moment,
      searchText: "",
      offreId: null,

      loading: false,
      busy: false,
      // firstPage: 1,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false,
      error: null,
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    /* offreView(offreId) {
        this.$router.push({
          name: "offredetails",
          params: {
            offreId: Number(offreId),
          },
        });
      },*/
    monDossierView(offreId) {
      this.$router.push({
        name: "dossierdetails",
        params: {
          offreId: Number(offreId),
        },
      });
    },
    postulerView(offre) {
      this.$router.push({
        name: "postulants",
        params: {
          offreId: Number(offre.id),
        },
      });
    }, //getAllRealisationsValideSearch
    async getAllOffresValide() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getAlloffresValide")
        .then(async (response) => {
          console.log(response);
          console.log(response.data.data);

          this.offres = response.data.data;
          // await this.getVisitor();
        })
        .catch((error) => {
          console.log("error");
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },

    async getAllOffresPaginate() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getOffresPaginate")
        .then((res) => {
          console.log(res);
          console.log(res.data.data);

          this.offres = res.data.data;
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
    async getOffresByUser() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getOffresPostulerUser/" + this.user.id)
        .then((response) => {
          console.log("logou");
          this.offres = response.data.data;
          console.log(response.data.data);
          console.log(this.offres);
        })
        .catch((error) => {
          console.log(error);
        });
      this.activeLoading = false;
    },
  },
  mounted() {
    console.log("monted");
    //this.getAllRealisationsPaginateNext();
  },
  async beforeMount() {
    await this.getOffresByUser();
  },
};
</script>
<style scoped>
.selected {
  background: hsl(153, 53%, 53%);
  color: white !important;
}
c-pointer {
  cursor: pointer;
}
</style>
