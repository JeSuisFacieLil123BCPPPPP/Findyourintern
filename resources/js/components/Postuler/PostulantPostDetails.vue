<template>
  <a-row>
    <a-col :xs="{ span: 24 }" :md="{ offset: 4, span: 16, offset: 4 }">
      <div v-if="loading == false" class="" style="min-height: 300px; min-width: 20%">
        <v-card>
          <v-card-title class="" style="background: #24855a">
            <b-field>
              <template #label>
                <span style="font-size: 20px; color: white">Détails du postulant</span>
              </template>
            </b-field>
          </v-card-title>
          <v-container>
            <a-card>
              <v-row>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Nom :</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">{{
                        postulant.user.user.lastname
                      }}</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Prénoms :</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">{{
                        postulant.user.user.firstname
                      }}</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Adresse électronique :</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">{{ postulant.user.email }}</span>
                    </template>
                  </b-field>
                </v-col>
                <div v-if="postulant.user.portfolio != null">
                  <a-divider></a-divider>
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Portfolio</span>
                    </template>
                  </b-field>
                  <portfolio-c :portfolio="portfolio"></portfolio-c>
                </div>
                <a-divider></a-divider>
                <v-col cols="6">
                  <b-tag outlined type="is-bleue" :selected="false" size="is-medium">
                    <span
                      ><v-icon size="20" class="ms-2" style="color: white"
                        >mdi-calendar</v-icon
                      >
                      <span>{{
                        "Postulé le" + moment(postulant.created_at).format("L")
                      }}</span></span
                    >
                  </b-tag>
                </v-col>
                <a-divider v-if="postulant.message.length >= 2"></a-divider>
                <b-field v-if="postulant.message.length >= 2">
                  <template #label>
                    <span style="font-size: 16px">Message</span>
                  </template>
                </b-field>
                <a-card>
                  <description
                    v-if="postulant.message.length >= 2"
                    :content="postulant.message"
                    style="max-width: 70%; font-size: 16px; color: black; height: 100px"
                    class="mt-3 mon-texte"
                  ></description
                ></a-card>
              </v-row>
              <a-divider></a-divider>
              <v-row>
                <div class="d-flex flex-column" style="width: 250px">
                  <v-icon size="64" color="#24855a"> mdi-file-document </v-icon>
                  <b-button outlined selected type="is-bleue">
                    <a :href="postulant.cv" style="color: black">Télécharger le CV</a>
                  </b-button>
                </div>
              </v-row>
              <a-divider></a-divider>
              <b-field v-if="postulant.realisations.length != 0">
                <template #label>
                  <span style="font-size: 16px">Projets sur la plateforme</span>
                </template>
              </b-field>
              <a-divider></a-divider>
              <v-row>
                <ol>
                  <li v-for="realis in postulant.realisations" :key="realis.id">
                    <router-link
                      :to="{
                        name: 'realisationdetails',
                        params: {
                          realisationId: Number(realis.id),
                        },
                      }"
                    >
                      <v-chip
                        style="
                          border-style: solid;
                          border-color: #24855a;
                          cursor: pointer;
                        "
                        color="#24855a"
                        text-color="white"
                        class="m-2"
                      >
                        <v-avatar left class="me-2">
                          <v-img
                            v-if="realis.poster != null"
                            :src="realis.poster.url"
                          ></v-img>
                          <v-img
                            v-else
                            :src="'https://res.cloudinary.com/ddt7qfshl/image/upload/v1666816988/ressources/images/index3_k0nvch.png'"
                          ></v-img>
                        </v-avatar>
                        <span class="d-inline-block text-truncate">
                          {{ realis.title }}</span
                        >
                      </v-chip></router-link
                    >
                  </li>
                </ol>
              </v-row>
              <div v-if="postulant.reponse != null">
                <a-divider></a-divider>
                <b-field>
                  <template #label>
                    <span style="font-size: 16px">Ma réponse</span>
                  </template>
                </b-field>
                <a-card
                  ><description
                    :content="postulant.reponse.reponse"
                    style="font-size: 16px; color: black; height: 100px"
                    class="mt-3 mon-texte"
                  ></description
                ></a-card>
              </div>
            </a-card>
            <!-- <v-row>
            <v-col cols="12" md="10">
              <template>
                <a-card hoverable style="width: 300px">
                  <template slot="actions" class="ant-card-actions">
                    <a-icon key="setting" type="setting" />
                    <a-icon key="edit" type="edit" />
                    <a-icon key="ellipsis" type="ellipsis" />
                  </template>
                </a-card>
              </template>
            </v-col>
            <v-col class="hidden-sm-and-down text-right" md="2">
              <v-icon size="64"> mdi-file-document </v-icon>
              <b-button> Téléecharger le CV </b-button>
            </v-col>
          </v-row>-->
          </v-container>
          <v-card-action>
            <div class="d-flex flex-row justify-content-end">
              <b-button
                class="m-2 align-self-end"
                selected
                type="is-bleue"
                @click="repondre(postulant)"
                >Répondre</b-button
              >
            </div>
          </v-card-action>
        </v-card>
      </div>
      <div v-else class="position-absolute translate-middle top-50 start-50">
        <a-spin style="color: green; border-color: green" size="large"></a-spin>
      </div>
    </a-col>
  </a-row>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import Description from "../Description.vue";
import PortfolioComp from "../Portfolio/PortfolioComp.vue";
export default {
  components: { Description, PortfolioComp },
  props: ["offreId", "postulantId"],
  data() {
    return {
      moment,
      postulants: [],
      postulant: null,
      offre: null,
      loading: false,
      portfolio: null,
    };
  },
  methods: {
    repondre(postulant) {
      this.$router.push({
        //path: "/offres/postulants/reponse/"+this.offreId+"/"+postulant.id,
        name: "reponsePostuler",
        params: {
          offreId: this.offreId,
          postulantId: postulant.id,
        },
      });
    },
    async getOffrebyId() {
      this.loading = true;
      //if (this.offreId != null)
      await axios
        .get("/api/v1/offres/" + this.offreId)
        .then(async (response) => {
          this.offre = response.data.data;
          console.log("mon offre");
          console.log(this.offre);
          await this.getPostulantsbyOffre();
          // this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      //this.loading = false;
    },
    async getPortfolioPostulant() {
      //api/v1/portfolio/user/{id}
      console.log("id");
      console.log(this.postulant.user);
      await axios
        .get("/api/v1/portfolio/" + this.postulant.user.portfolio.id)
        .then((response) => {
          console.log("komane");
          console.log(this.postulant.message);
          console.log(response);
          this.portfolio = response.data.data;
          console.log("postulants");
          console.log(this.portfolio);

          // this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getPostulantsbyOffre() {
      this.loading = true;
      await axios
        .get("/api/v1/offres/getPostulantsbyOffre/" + this.offreId)
        .then((response) => {
          console.log(response);
          this.postulants = response.data.data;

          console.log("postulants");
          console.log(this.postulants);

          // this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      // this.loading = false;
    },
    getPostulant() {
      this.loading = true;
      this.postulant = this.postulants.find((row) => {
        console.log("row.id");
        console.log(row);
        return row.id == this.postulantId;
      });
      console.log("postula");
      console.log(this.postulant);
      this.loading = false;
    },
  },
  async mounted() {
    console.log("monted");
    // await this.getOffrebyId();
    // this.getPostulant();
    // await this.getPostulantsbyOffre();
  },
  async beforeMount() {
    console.log("befmonted");
    await this.getOffrebyId();
    this.getPostulant();
    this.getPortfolioPostulant();
    //await this.getPostulantsbyOffre();
  },
};
</script>
<style sclang="scss" scoped></style>
