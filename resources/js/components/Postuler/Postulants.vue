<template>
  <a-row>
    <a-col :xs="{ span: 24 }" :md="{ offset: 2, span: 20, offset: 2 }">
      <div class="" style="min-height: 80vh">
        <div v-if="offre != null" class="d-flex flex-column justify-content-center">
          <a-card>
            <a-card-header>
              <a-divider>
                <b-field>
                  <template #label>
                    <span style="font-size: 30px">{{ offre.title }}</span>
                  </template>
                </b-field>
              </a-divider>
            </a-card-header>
            <a-card class="w-100" :bordered="true">
              <v-row>
                <v-col cols="6">
                  <b-field v-if="offre.type != null">
                    <template #label>
                      <span style="font-size: 16px">Type d'offre :</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field v-if="offre.type != null">
                    <template #label>
                      <span style="font-size: 16px">{{ offre.type }}</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Fonction :</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">{{ offre.fonction }}</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Nombre de candidat</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">{{ offre.nbr }}</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">Date limite :</span>
                    </template>
                  </b-field>
                </v-col>
                <v-col cols="6">
                  <b-field>
                    <template #label>
                      <span style="font-size: 16px">{{
                        moment(new Date(offre.date_limite)).format("LL")
                      }}</span>
                    </template>
                  </b-field>
                </v-col>
              </v-row>
            </a-card>
            <a-card>
              <a-card-header>
                <b-field>
                  <template #label>
                    <span style="font-size: 16px" class="mon-texte"
                      >Description de l'offre</span
                    >
                  </template>
                </b-field>
              </a-card-header>
              <description
                :content="offre.description"
                v-line-clamp:20="3"
                style="max-width: 70%; font-size: 16px; color: black; height: 100px"
                class="mt-3 mon-texte"
              ></description>
            </a-card>
          </a-card>

          <a-card>
            <!-- <vs-table stripe :data="postulants">
              <template slot="header">
                <a-divider>
                  <b-field>
                    <template #label>
                      <span style="font-size: 30px">Canditats ayant postulés</span>
                    </template>
                  </b-field>
                </a-divider>
              </template>
              <template slot="thead">
                <vs-th>
                  <b-field>
                    <template #label>
                      <span style="font-size: 20px">Nom</span>
                    </template>
                  </b-field></vs-th
                >
                <vs-th
                  ><b-field>
                    <template #label>
                      <span style="font-size: 20px">Prénoms</span>
                    </template>
                  </b-field>
                </vs-th>
                <vs-th
                  ><b-field>
                    <template #label>
                      <span style="font-size: 20px">Adresse électronique</span>
                    </template>
                  </b-field></vs-th
                >
                <vs-th>
                  <b-field>
                    <template #label>
                      <span style="font-size: 20px">Méssage </span>
                    </template>
                  </b-field>
                </vs-th>
                <vs-th>
                  <b-field>
                    <template #label>
                      <span style="font-size: 20px">CV</span>
                    </template>
                  </b-field>
                </vs-th>
                <vs-th
                  ><b-field>
                    <template #label>
                      <span style="font-size: 20px">Projets sur la plateforme</span>
                    </template>
                  </b-field></vs-th
                >
              </template>
    
              <template slot-scope="{ data }">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="tr">
                    <b-field class="colonne">
                      <template #label>
                        <span style="font-size: 15px">{{ tr.user.user.lastname }}</span>
                      </template>
                    </b-field>
                  </vs-td>
    
                  <vs-td :data="tr">
                    {{ tr.user.user.firstname }}
                  </vs-td>
    
                  <vs-td :data="tr">
                    <a-tooltip title="Envoyer un mail">
                      <a :href="`mailto:${tr.user.email}`">
                        {{ tr.user.email }}
                      </a>
                    </a-tooltip>
                  </vs-td>
                  <vs-td :data="tr">
                    {{ tr.message }}
                  </vs-td>
                  <vs-td :data="tr">
                    <span
                      ><a :href="tr.cv">{{
                        tr.user.user.firstname + "" + tr.user.user.lastname + "- CV"
                      }}</a></span
                    >
                  </vs-td>
                  <vs-td :data="tr">
                    <ol>
                      <li v-for="realis in tr.realisations" :key="realis.id">
                        <router-link
                          :to="{
                            name: 'realisationdeatails',
                            params: {
                              realisationId: Number(realis.id),
                            },
                          }"
                          >{{ realis.title }}</router-link
                        >
                      </li>
                    </ol>
                  </vs-td>
                </vs-tr>
              </template> </vs-table
            >-->
            <a-table
              style=""
              class="table12 m-2"
              :columns="columns"
              :row-key="(record) => record.id"
              :data-source="postulants"
              :loading="loading"
              :components="{ dfgh: 'dfghjk' }"
              :rowClassName="
                (record, index) => {
                  return 'elevation_1 table-tr';
                }
              "
              :hideDefaultSelections="true"
            >
              <!-- <template slot="id" slot-scope="id"
            >{{ id }}
            !-- <span class="bg-danger" v-if="user.is_locked == true">Bloqué(e)</span>
            <span class="bg-success" v-else>Activé(e)</span>--</template>-->
              <template slot="lastname" slot-scope="postulant">
                <span>
                  {{ postulant.user.user.lastname }}
                </span>
              </template>
              <template slot="firstname" slot-scope="postulant">
                <span>
                  {{ postulant.user.user.firstname }}
                </span>
              </template>
              <template slot="email" slot-scope="postulant">
                <a-tooltip title="Envoyer un mail">
                  <a :href="`mailto:${postulant.user.email}`">
                    {{ postulant.user.email }}
                  </a>
                </a-tooltip>
              </template>
              <!--<template slot="message" slot-scope="postulant">
                <span v-line-clamp:20="2" style="max-width: 90%">
                  {{ postulant.message }}
                </span>
              </template>-->
              <!-- <template slot="cv" slot-scope="postulant">
                <a :href="postulant.cv">{{
                  postulant.user.user.firstname + "" + postulant.user.user.lastname + "- CV"
                }}</a>
              </template>
            <template slot="projets" slot-scope="postulant">
                <ol>
                  <li v-for="realis in postulant.realisations" :key="realis.id">
                    <router-link
                      :to="{
                        name: 'realisationdetails',
                        params: {
                          realisationId: Number(realis.id),
                        },
                      }"
                      >{{ realis.title }}</router-link
                    >
                  </li>
                </ol>
              </template>-->
              <template slot="state" slot-scope="postulant">
                <span v-if="postulant.reponse == null"
                  ><vs-button color="danger" type="border">En attente</vs-button></span
                >
                <span v-else
                  ><vs-button color="#24855a" type="border">Déjà traité</vs-button></span
                >
              </template>

              <template slot="operation" slot-scope="postulant">
                <b-button
                  selected
                  type="is-bleue"
                  v-if="postulant.reponse == null"
                  @click="repondre(postulant)"
                  >Répondre
                </b-button>
                <b-button selected type="is-bleue" @click="voirDemande(postulant)"
                  >Détails
                </b-button>
              </template>
            </a-table>
          </a-card>

          <!-- <div>
            {{ offre }}
           </div>
         
          <div v-if="loading && !busy" class="demo-loading-container">
            <a-spin />
          </div>-->
        </div>
        <div
          class="position-absolute top-50 start-50 translate-middle"
          v-else-if="loading == true"
        >
          <b-field>
            <template #label>
              <span style="font-size: 20px">Chargement...</span>
            </template>
          </b-field>
        </div>
        <router-view></router-view>
      </div>
    </a-col>
  </a-row>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import noPostulants1 from "../Icons/no-postulants-1.vue";
const columns = [
  {
    title: "Nom",
    // dataIndex: "lastname",
    sorter: false,
    //width: "20%",
    scopedSlots: { customRender: "lastname" },
  },
  {
    title: "Prénoms",
    // dataIndex: "firstname",
    sorter: false,
    //width: "20%",
    scopedSlots: { customRender: "firstname" },
  },
  {
    title: "Adresse électronique",
    // dataIndex: "email",
    sorter: false,
    scopedSlots: { customRender: "email" },
  },
  /* {
    title: "Message",
    //dataIndex: "message",
    sorter: false,
    scopedSlots: { customRender: "message" },
    ellipsis: true,
  },*/
  /*{
    title: "Message",
    // dataIndex: "cv",
    sorter: false,
    scopedSlots: { customRender: "message" },
  },*/
  {
    title: "Etat du dossier",
    //dataIndex: "projet",
    sorter: false,
    scopedSlots: { customRender: "state" },
  },
  {
    title: "Actions",
    //dataIndex: "user_type",
    sorter: false,
    scopedSlots: { customRender: "operation" },
  },
];
export default {
  components: { noPostulants1 },
  props: ["offreId"],
  data() {
    return {
      moment,
      postulants: [],
      offre: null,
      data: [],
      loading: false,
      busy: false,
      // firstPage: 1,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false,
      columns,
    };
  },
  watch: {
    offreId() {
      this.getOffrebyId();
    },
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
    voirDemande(postulant) {
      this.$router.push({
        //path: "/offres/postulants/reponse/"+this.offreId+"/"+postulant.id,
        name: "voirPostulantPost",
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
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      this.loading = false;
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

          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      this.loading = false;
    },
  },
  async mounted() {
    console.log("monted");
    await this.getOffrebyId();
    //await this.getPostulantsbyOffre();
  },
  async beforeMount() {
    console.log("befmonted");
    await this.getOffrebyId();
    //await this.getPostulantsbyOffre();
  },
};
</script>
<style lang="scss">
$color1: rgb(71, 218, 135);
$color2: rgb(94, 150, 239);
$color3: rgb(192, 195, 200);
input[type="search"] {
  border-radius: 4px;
}
.table-tr {
  //background: blue;
  border-radius: 10px;
  //border-color: chartreuse;
  border-width: 3px;
  border-style: solid;
  /*box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2), 0 3px 4px rgba(0, 0, 0, 0.14),
    0 3px 3px -2px rgba(0, 0, 0, 0.12);*/
}

.description {
  max-height: 50px !important;
  overflow: hidden;
  display: inline-block;
  :deep(img) {
    display: none !important;
  }
  &:after {
    content: "...";
  }
}

.table12 {
  border-collapse: separate;
  border-spacing: 0px 12px;
}
.colonne {
  margin-left: 0px !important;
}
.user {
  display: flex;
  background: #ccc;
  border-radius: 1em;
  margin: 1em auto;
}

.user-avatar {
  padding: 1em;
}

.user-avatar img {
  display: block;
  width: 100%;
  min-width: 64px;
  height: auto;
  border-radius: 50%;
}

.user-details {
  padding: 1em;
}

.user-name {
  margin: 0;
  padding: 0;
  font-size: 2rem;
  font-weight: 900;
}

.demo-loading {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}

.demo-infinite-container {
  border: 1px solid #e8e8e8;
  border-radius: 4px;
  overflow: auto;
  padding: 8px 24px;
  height: 300px;
}
.demo-loading-container {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}
</style>
