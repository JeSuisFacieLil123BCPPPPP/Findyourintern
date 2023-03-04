<template>
  <div class="">
    <div class="w-100">
      <v-card>
        <v-card-title>Recherche</v-card-title>
        <a-card>
          <a-row :gutter="[18, 18]">
            <a-col :md="{ offset: 3, span: 18, offset: 3 }" :xs="{ span: 24 }">
              <b-field class="" horizontal>
                <b-input
                  placeholder="Rechercher une offre ..."
                  rounded
                  style="margin-left: 100px"
                  :value="$route.query.title"
                  @input="searchValueChange"
                  icon-pack="fas"
                  icon-right="search"
                  icon-right-clickable
                  @icon-right-click="searchIconClick"
                  expanded
                ></b-input>
              </b-field>
            </a-col>
            <a-col :md="{ span: 12 }" :xs="{ span: 24 }">
              <b-field label="Type de lieu" expanded>
                <!-- <a-select
                  size="large"
                  mode="default"
                  default-value="1"
                  style="width: 100%; border-radius: 10px"
                  class="label-text"
                >
                  <a-select-option value="1">Plus pertinent</a-select-option>
                  <a-select-option value="2">Plus tendance</a-select-option>
                  <a-select-option value="3">Plus récent</a-select-option>
                </a-select>
              </b-field>
            </a-col>-->
                <a-select
                  size="large"
                  mode="default"
                  placeholder="Séléctionnez le type de lieu"
                  :value="lieu"
                  style="width: 100%; border-radius: 10px"
                  @change="handleChangeTypeLieu"
                  class="label-text"
                  default-value=""
                >
                  <a-select-option value="">Tous les types de lieux</a-select-option>
                  <a-select-option
                    v-for="item in lieux"
                    :key="item.id"
                    :value="item.text"
                  >
                    {{ item.text }}
                  </a-select-option>
                </a-select>
              </b-field>
            </a-col>
            <a-col :md="{ span: 12 }" :xs="{ span: 24 }">
              <b-field size="is-medium" expanded>
                <template #label>
                  <span style="font-size: 16px">Par secteur </span>
                </template>
                <a-select
                  size="large"
                  mode="default"
                  v-model="secteur"
                  default-value=""
                  style="width: 100%; border-radius: 10px"
                  class="label-text"
                  @change="changeSecteur"
                >
                  <a-select-option value="">Tous les secteurs</a-select-option>
                  <a-select-option
                    :value="secteur.name"
                    v-for="(secteur, index) in secteurs"
                    :key="index"
                  >
                    {{ secteur.name }}
                  </a-select-option>
                </a-select>
              </b-field>
            </a-col>
            <!--<a-col :md="{ offset: 2, span: 20, offset: 2 }" :xs="{ span: 24 }">
              <b-field label="Par zone ou ville" class="" expanded>
                <b-input
                  placeholder=""
                  rounded
                  style="margin-left: 100px"
                  :value="$route.query.title"
                  @input="searchValueChange"
                  class="w-100"
                  icon-pack="fas"
                  icon-right="search"
                  icon-right-clickable
                  @icon-right-click="searchIconClick"
                  expanded
                ></b-input>
              </b-field>
            </a-col>-->
          </a-row>
        </a-card>
      </v-card>
      <!--<v-card class="v-card2">
          <div>
            <v-card>
              <v-card-title> Trier par</v-card-title>
              <a-card class="box-search-ele1">
                <b-field grouped>
                  <b-field size="is-medium" expanded>
                    <template #label>
                      <span style="font-size: 16px">Type de de l'offre </span>
                    </template>
                    <b-select
                      size="is-medium"
                      placeholder="Type"
                      v-model="offre.type"
                      expanded
                    >
                      <option value="">Tous les types</option>
                      <option value="Stage académique">Stage académique</option>
                      <option value="Stage profesionnel">Stage profesionnel</option>
                      <option value="Emploi">Emploi</option>
                    </b-select>
                  </b-field>
                  <b-field expanded size="is-medium">
                    <template #label>
                      <span style="font-size: 16px">Secteur d'activité</span>
                    </template>

                    <b-select
                      size="is-medium"
                      placeholder="Secteur d'activité"
                      v-model="offre.secteur"
                      expanded
                    >
                      <option value="">Tous les secteurs</option>
                      <option
                        :value="secteur.name"
                        v-for="(secteur, index) in secteurs"
                        :key="index"
                      >
                        {{ secteur.name }}
                      </option>
                    </b-select>
                  </b-field>
                  <!--<b-field size="is-medium" expanded>
                      <template #label
                        ><span style="font-size: 16px">titles</span>
                      </template>
  
                      <b-select
                        size="is-medium"
                        placeholder="title"
                        v-model="offre.title"
                        expanded
                      >
                      <option value="">Toutes les titles</option>
                        <option
                          :value="title.name"
                          v-for="(title, index) in titles"
                          :key="index"
                        >
                          {{ title.name }}
                        </option>
                      </b-select>
                    </b-field>-->

      <!-- <b-field custom-class="is-medium" expanded>
                      <template #label>
                        <span style="font-size: 16px">Zone géographique</span>
                      </template>
                      <b-input type="text" size="is-medium" v-model="offre.zone"> </b-input>
                    </b-field>--
                  <b-field custom-class="is-medium" expanded>
                    <template #label>
                      <span style="font-size: 16px">Disponibilité</span>
                    </template>
                    <b-select
                      expanded
                      size="is-medium"
                      placeholder="Disponibilité"
                      v-model="offre.disponibilite"
                    >
                      <option value="">Tous les disponibilités</option>
                      <option value="Mi-temps">Mi-temps</option>
                      <option value="Stage profesionnel">Temps partiel</option>
                      <option value="Emploi">Temps plein</option>
                    </b-select>
                  </b-field>
                </b-field>
              </a-card>
              <a-card class="box-search-ele2">
                <b-field size="is-medium" expanded>
                  <template #label>
                    <span style="font-size: 16px">Type de l'offre</span>
                  </template>
                  <b-select
                    size="is-medium"
                    placeholder="Type"
                    v-model="offre.type"
                    expanded
                    ><option value="">Tous les types</option>
                    <option value="Stage académique">Stage académique</option>
                    <option value="Stage profesionnel">Stage profesionnel</option>
                    <option value="Emploi">Emploi</option>
                  </b-select>
                </b-field>
                <b-field expanded size="is-medium">
                  <template #label>
                    <span style="font-size: 16px">Secteur d'activité</span>
                  </template>

                  <b-select
                    size="is-medium"
                    placeholder="Secteur d'activité"
                    v-model="offre.secteur"
                    expanded
                  >
                    <option value="">Tous les secteurs</option>
                    <option
                      :value="secteur.name"
                      v-for="(secteur, index) in secteurs"
                      :key="index"
                    >
                      {{ secteur.name }}
                    </option>
                  </b-select>
                </b-field>
              </a-card>
            </v-card>
          </div>
        </v-card>-->
      <div class="p-2 w-100 d-flex flex-column justify-content-between">
        <div
          class="d-inline-block font-weight-black text-h4 ms-3"
          style="font-size: 30px; font-weight: "
        ></div>

        <div v-if="activeLoading == false">
          <v-card
            v-for="(offre, i) in offres"
            :key="i"
            class="mx-4 my-2 d-flex flex-column p-2 position-relative flex-wrap"
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
                  <div class="p-2 flex-shrink-1 bd-highlight">
                    <!--<v-img
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
                    ></v-img>-->
                  </div>
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
                          <span style="font-size: 14px; font-weight: bold" class="vert">{{
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
                  <div class="d-flex flex-row justify-content-between flex-wrap">
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
                        ><v-icon size="20" class="m-2" style="color: black"
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
                        ><v-icon size="20" class="mx-2" style="color: black"
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
                      v-else-if="user.user_type == 'student'"
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
              v-if="offres.length < total"
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
        <div
          v-else-if="loading == true"
          class="position-absolute top-50 start-50 translate-middle"
        >
          <a-spin size="large"> </a-spin>
        </div>
        <div
          v-if="loading == false && offres.length == 0"
          class="d-flex flex-column justify-content-center align-items-center"
        >
          <no-data-1 height="300px" width="300px"></no-data-1>
          <b-field>
            <div class="font-weight-bold text-subtitle-1 text-black">
              Aucun résultat pour cette recherche
            </div>
          </b-field>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
import noData1 from "../Icons/no-data-1.vue";
import noOffre from "../Icons/no-offre.vue";
export default {
  components: { noData1, noOffre },
  name: "offrePrinc",
  data() {
    return {
      e1: 1,
      formData1: new FormData(),
      offre: {
        type: this.$route.query.type || "",
        secteur: this.$route.query.secteur || "",
        title: this.$route.query.title || "",
        responsabilite: "",
        exigences: "",
        zone: "",
        disponiblite: this.$route.query.disponibilite || "",
        date_limite: "",
      },
      secteur: this.$route.query.type || "",
      title: this.$route.query.title || "",
      type: this.$route.query.type || "",
      lieu: this.$route.query.lieu || "",
      zone: this.$route.query.zone || "",
      isLoading: false,

      model: 0,
      show: true,
      //loading: false,
      activeLoading: false,
      offres: [],
      visible: false,
      moment,

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
      types: [
        { id: 1, text: "Emploi" },
        { id: 2, text: "Stage académique" },
        { id: 2, text: "Stage profesionnel" },
      ],
      lieux: [
        { id: 1, text: "Télétravail" },
        { id: 2, text: "En personne(lieu précis)" },
      ],
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    changeSecteur() {
      this.$router.push({
        name: "offresrecherche",
        query: {
          ...this.$route.query,
          secteur: this.secteur,
        },
      });
      this.getAllOffresPaginate();
    },
    handleChangeTypeLieu(lieu) {
      this.lieu = lieu;
      this.$router.push({
        name: "offresrecherche",
        query: {
          ...this.$route.query,
          lieu: this.lieu,
        },
      });
    },
    searchIconClick() {
      this.$router.push({
        name: "offresrecherche",
        query: {
          ...this.$route.query,
          title: this.title,
        },
      });
      this.getAllOffresPaginate();
    },
    searchValueChange(value) {
      this.title = value;
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
        .get("/api/v1/offres/getAllOffresSearch", {
          params: { type: this.type, secteur: this.secteur, title: this.title },
        })
        .then((res) => {
          console.log("res");
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
          console.log();
          console.log("offfres");
          console.log(this.offres);
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          this.nextPage = this.nextPage < this.lastPage ? 2 : this.lastPage;
          this.activeLoading = false;
        })
        .catch((error) => {
          console.log("error");
          console.log(error.message);
          this.activeLoading = false;
        });
      //  .finally(() => (this.activeLoading = false));
    },
    getAllOffresPaginateNext() {
      console.log("click");
      console.log(this.offres.length);
      if (this.offres.length < this.total) {
        this.loading = true;
        axios
          .get("/api/v1/offres/getAllOffresSearch", {
            params: Object.assign({}, this.$route.query, { page: this.nextPage }),
          })
          .then((res) => {
            console.log("next");
            console.log(this.offres);
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
  watch: {
    "offre.type"(value) {
      console.log(this.offre.type);
      console.log(value.length);
      // alert(value.length)
      if (value.length != 0) {
        this.$router.push({
          name: "offresrecherche",
          query: Object.assign({}, this.$route.query, { type: this.offre.type }),
        });
      } else {
        var query = { ...this.$route.query };
        Reflect.deleteProperty(query, "type");
        console.log("query");
        console.log(this.$route.query);
        this.$router.replace({
          name: "offresrecherche",
          query: query,
        });
      }
      this.getAllOffresPaginate();
    },
    "offre.secteur"(value) {
      console.log(this.offre.secteur);
      console.log(value);
      if (value.length != 0) {
        this.$router.push({
          name: "offresrecherche",
          query: Object.assign({}, this.$route.query, { secteur: this.offre.secteur }),
        });

        this.getAllOffresPaginate();
      } else {
        var query = { ...this.$route.query };
        Reflect.deleteProperty(query, "secteur");
        console.log("query");
        console.log(this.$route.query);
        this.$router.replace({
          name: "offresrecherche",
          query: query,
        });
      }
    },
    "offre.disponibilite"(value) {
      console.log(this.offre.disponibilite);
      console.log(value);
      if (value.length != 0) {
        this.$router.push({
          name: "offresrecherche",
          query: Object.assign({}, this.$route.query, {
            disponibilite: this.offre.disponibilite,
          }),
        });
        this.getAllOffresPaginate();
      } else {
        var query = { ...this.$route.query };
        Reflect.deleteProperty(query, "disponibilite");
        console.log("query");
        console.log(this.$route.query);
        this.$router.replace({
          name: "offresrecherche",
          query: query,
        });
      }
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
.conteneur {
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
}
</style>
