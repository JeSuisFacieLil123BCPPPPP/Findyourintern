<template>
  <div class="bd-2">
    <div v-if="loading == false">
      <a-card>
        <v-card-title class="" style="background: hsl(153, 53%, 53%)">
          <b-field>
            <template #label>
              <span style="font-size: 20px; color: white"
                >Répondre à
                <span class="text-uppercase">{{
                  " " + postulant.user.user.lastname
                }}</span
                ><span>{{ " " + postulant.user.user.firstname + " " }}</span
                >sur l'offre intitulé : <span>{{ " " + offre.title }}</span>
              </span>
            </template>
          </b-field>
        </v-card-title>
        <a-divider></a-divider>
        <b-button type="is-warning" @click="voirDemande(postulant)">
          Revoir les détails de la demande
        </b-button>
        <a-divider></a-divider>
        <a-card>
          <template slot="title">
            <b-field custom-class="is-medium" class="form-label">
              <template #label>
                <span style="color: red">* </span>Reponse
                <b-tooltip
                  position="is-right"
                  label="C'est la description du prohet/réalisation. Vous devez décrire le projet de façon détaillée"
                  size="is-medium"
                  type="is-bleue"
                  multilined
                >
                  <v-icon small style="color: hsl(153, 53%, 53%)"
                    >mdi-information
                  </v-icon>
                </b-tooltip>
              </template></b-field
            >
          </template>
          <vue-editor
            class="w-100"
            v-model="reponse.reponse"
            ref="exigences"
            placeholder="Décrivez les exigences de l'offre"
            :editorToolbar="customToolbar"
            :editorOptions="editorSettings"
          />
        </a-card>
        <v-card-action>
          <div class="d-flex flex-row justify-content-end">
            <b-button
              class="m-2 align-self-end"
              selected
              type="is-success"
              @click="reponsePostuler"
              >Envoyer</b-button
            >
          </div>
        </v-card-action>
      </a-card>
    </div>
    <div v-else>
      <a-spin></a-spin>
    </div>
  </div>
</template>

<script>
import { VueEditor, Quill } from "vue2-editor";
//import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-vue";
import { mapGetters, mapActions } from "vuex";
Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
const shortNum = require("number-shortener");
import moment from "moment";
export default {
  props: ["offreId", "postulantId"],
  data() {
    return {
      reponse: { reponse: "" },
      moment,
      postulants: [],
      postulant: null,
      offre: null,
      loading: false,
      customToolbar: [
        [{ font: [] }],

        [{ header: [false, 1, 2, 3, 4, 5, 6] }],

        [{ size: ["small", false, "large", "huge"] }],

        ["bold", "italic", "underline", "strike"],

        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],

        [{ header: 1 }, { header: 2 }],

        [{ list: "ordered" }, { list: "bullet" }],

        [{ color: [] }, { background: [] }],

        [{ direction: "rtl" }],
        ["clean"],
      ],

      editorSettings: {
        modules: {
          imageDrop: true,
          imageResize: {},
        },
      },
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  //reponse/postuler
  methods: {
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
    async reponsePostuler() {
      this.reponse.userId = this.user.id;
      this.reponse.postulerId = this.postulantId;
      await axios
        .post("/api/v1/reponse/postuler", this.reponse)
        .then((response) => {
          console.log(response.data);
          this.$vs.notify({
            color: "success",
            title: "SUCCES DU POSTE",
            text: response.data.message,
          });
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
    await this.getOffrebyId();
    this.getPostulant();
    // await this.getPostulantsbyOffre();
  },
  async beforeMount() {
    console.log("befmonted");
    await this.getOffrebyId();
    this.getPostulant();
    //await this.getPostulantsbyOffre();
  },
};
</script>
<style sclang="scss" scoped></style>
