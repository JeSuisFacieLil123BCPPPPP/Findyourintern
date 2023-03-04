<template>
  <div class="">
    <a-row :gutter="[18, 18]">
      <a-col :md="{ offset: 3, span: 18, offset: 3 }" :xs="{ span: 24 }">
        <a-card style="height: 300px; width: 300px" v-if="loading == true">
          <a-spin></a-spin>
        </a-card>
        <div v-else>
          <a-card v-if="offre.user.user_type == 'company'">
            <a-card-header>
              <b-field>
                <template #label>
                  <span style="font-size: 25px">Entreprise</span>
                </template>
              </b-field>
            </a-card-header>
            <a-divider></a-divider>
            <div class="d-flex">
              <div class="flex-shrink-1 bd-highlight">
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
              </div>
              <div class="p-2 w-100 bd-highlight">
                <div>
                  <b-field class="">
                    <template #label>
                      <span style="font-size: 25px; font-weight: bold" class="vert">{{
                        offre.user.user.company_name
                      }}</span>
                    </template>
                  </b-field>
                </div>

                <div>
                  <b-field class="">
                    <template #label>
                      <span style="font-size: 14px">{{ offre.user.user.adresse }}</span>
                    </template>
                  </b-field>
                </div>
              </div>
            </div>
          </a-card>
          <a-card>
            <v-btn
              absolute
              :rounded="true"
              medium
              top
              flat
              right
              v-if="offre.statut == false && user.usertype == 'student'"
              style="background: #24855a; color: white"
              @click="postulerView(offre.id)"
              >Postuler</v-btn
            >
            <v-btn
              absolute
              :rounded="true"
              medium
              top
              flat
              right
              v-else-if="offre.statut == true && user.usertype == 'student'"
              style="background: hsl(14, 100%, 53%); color: white"
              @click="monDossierView(offre.id)"
              >Mon dossier</v-btn
            >
            <a-card-header>
              <b-field>
                <template #label>
                  <span style="font-size: 25px">Détails de l'offre</span>
                </template>
              </b-field>
            </a-card-header>
            <a-divider></a-divider>
            <b-field>
              <template #label>
                <span style="font-size: 16px">{{ "Titre : " + offre.title }}</span>
              </template>
            </b-field>
            <!--<div class="d-flex">
        <div class="flex-shrink-1 bd-highlight">
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
        </div>
        <div class="p-2 w-100 bd-highlight">
          <div>
            <b-field class="">
              <template #label>
                <span style="font-size: 25px; font-weight: bold" class="vert">{{
                  offre.user.user.company_name
                }}</span>
              </template>
            </b-field>
          </div>
  
          <div>
            <b-field class="">
              <template #label>
                <span style="font-size: 14px">{{ offre.user.user.adresse }}</span>
              </template>
            </b-field>
          </div>
        </div>
      </div>-->
            <a-divider></a-divider>
            <div>
              <a-card style="max-width: 700px" :bordered="true">
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
                        <span style="font-size: 16px">Secteur d'activité :</span>
                      </template>
                    </b-field>
                  </v-col>
                  <v-col cols="6">
                    <b-field>
                      <template #label>
                        <span style="font-size: 16px">{{ offre.secteur }}</span>
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
                        <span style="font-size: 16px">Localisation géographique :</span>
                      </template>
                    </b-field>
                  </v-col>
                  <v-col cols="6">
                    <b-field>
                      <template #label>
                        <span style="font-size: 16px">{{ offre.zone }}</span>
                      </template>
                    </b-field>
                  </v-col>
                  <v-col cols="6">
                    <b-field>
                      <template #label>
                        <span style="font-size: 16px">Disponibilité :</span>
                      </template>
                    </b-field>
                  </v-col>
                  <v-col cols="6">
                    <b-field>
                      <template #label>
                        <span style="font-size: 16px">{{ offre.disponibilite }}</span>
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
            </div>
            <a-divider></a-divider>

            <div v-if="offre.description.length != 0">
              <a-divider></a-divider>
              <div>
                <b-field>
                  <template #label>
                    <span style="font-size: 20px">
                      Description de l'offre ou du poste</span
                    >
                  </template>
                </b-field>
              </div>
              <description
                :content="offre.description"
                style="max-width: 950px; line-height: 100px"
                class="overflow-auto"
              ></description>
            </div>
            <a-divider></a-divider>
            <div v-if="offre.exigences && offre.exigences.length != 0">
              <a-divider></a-divider>
              <div>
                <b-field>
                  <template #label>
                    <span style="font-size: 20px">Exigences de l'offre</span>
                  </template>
                </b-field>
              </div>
              <description
                :content="offre.exigences"
                style="max-width: 950px"
                class="overflow-auto mon-texte"
              ></description>
            </div>
            <a-divider> </a-divider>
            <b-notification
              type="is-success is-light"
              aria-close-label="Close notification"
              :closable="false"
              style="font-style: italic"
            >
              Soyez vigilant ! N'envoyez pas d'argent à un employeur potentiel. Ne versez
              aucune somme d'argent en échange d'un contrat de travail potentiel ou pour
              suivre une formation préalable à l'embauche. Merci de signaler toute
              irrégularité en utilisant le formulaire de contact candidat et en
              sélectionnant l'objet "Signaler une annonce d'emploi".
            </b-notification>
          </a-card>
        </div>
      </a-col>
    </a-row>
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
//import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-vue";
export default {
  // props: ["realisationId"],
  props: {
    offreId: {
      type: [Number, String],
      required: false,
      default: null,
    },
  },
  data() {
    return {
      docV: false,
      desc: false,
      moment,
      nbrlikes: 0,
      nbrdislikes: 0,
      actions: null,
      offre: {},
      offreUser: {},
      show: false,
      model: 0,
      offreForUser: [],
      offrebyTags: [],
      hover: "",
      loading: true,
      content:
        '<p class="ql-align-justify"><img src="https://res.cloudinary.com/ddt7qfshl/image/upload/v1666810039/ressources/images/Capture_okoo6h.png" style="display: inline; margin: 0px 1em 1em 0px; float: left;" width="215"><strong>Travaillez, prenez de la peine&nbsp;:</strong></p><p class="ql-align-justify"><strong>C’est le fonds qui manque le moin</strong>s.</p><p> Un riche Laboureur, sentant sa mort prochaine,</p><p class="ql-indent-1"> Fit venir ses enfants, leur parla sans témoins.</p><ul><li class="ql-indent-4"> Gardez-vous, leur dit-il, de vendre l’héritage</li><li class="ql-indent-4"> Que nous ont laissé nos parents.</li><li class="ql-indent-4"> Un trésor est caché dedans.</li></ul><p> Je ne sais pas l’endroit&nbsp;; mais un peu de courage</p><p> Vous le fera trouver, vous en viendrez à bout.</p><p> Remuez votre champ dès qu’on aura fait l’Oût.</p><p> Creusez, fouiller, bêchez&nbsp;; ne laissez nulle place</p><p> Où la main ne passe et repasse.</p>',
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    offreIndex(realisation) {
      return offre.reaction.findIndex((element) => (element.id = this.user.id));
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
    },
    async getOffrebyId() {
      this.loading = true;
      await axios
        .get("/api/v1/offres/" + this.offreId)
        .then((response) => {
          this.offre = response.data.data;
          this.offre.statut = false;
          this.offre.postuler.forEach((ele) => {
            if (ele.id == this.user.id) {
              this.offre.statut = true;
              console.log(this.offre);
            }
          });
          console.log(this.offre.statut);
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      this.loading = false;
    },
    async getOffresByUser() {
      await axios
        .get("/api/v1/offres/getOffresByUser/" + this.offre.user.id)
        .then((response) => {
          console.log("logtyu");
          this.offreForUser = response.data.data;
          console.log(this.offreForUser);
          console.log(this.offreForUser);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  async beforeMount() {
    await this.getOffrebyId();
    // await this.getOffreByUser();
  },
};
</script>
<style lang="scss" scoped></style>
