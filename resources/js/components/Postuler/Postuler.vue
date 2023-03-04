<template>
  <a-row type="flex" justify="center" align="middle">
    <a-col
      :md="{ offset: 1, span: 12, offset: 1, order: 1 }"
      :xs="{ order: 2, span: 24 }"
    >
      <b-steps type="is-bleue" :has-navigation="false" v-model="step">
        <b-step-item label="Données de base" icon="account-key">
          <a-card>
            <a-divider class="label-text font-weight-bold text-lg-h6 text-h6"
              >Indiquez vos données</a-divider
            >

            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red">* </span><span style="font-size: 16px">Nom</span>
              </template>
              <b-input type="text" size="is-medium" :value="user.user.lastname" disabled>
              </b-input>
            </b-field>
            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red">* </span
                ><span style="font-size: 16px">Prénoms</span>
              </template>
              <b-input type="text" size="is-medium" :value="user.user.firstname" disabled>
              </b-input>
            </b-field>
            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red">* </span
                ><span style="font-size: 16px">Adresse mail</span>
              </template>
              <b-input type="text" size="is-medium" :value="user.email" disabled>
              </b-input>
            </b-field>
            <b-field label="Message">
              <b-input type="textarea" v-model="postuler.message"></b-input>
            </b-field>
            <div class="text-right">
              <b-button @click="step = 2">Continuer</b-button>
            </div>
          </a-card>
        </b-step-item>
        <b-step-item label="Les dossiers de candidatures" icon="account">
          <a-card>
            <b-field>
              <template #label>
                <span style="color: red"> </span
                ><span style="font-size: 16px">Votre CV</span>
              </template>
              <VueFileAgent
                ref="poster"
                :multiple="false"
                :deletable="true"
                :meta="true"
                :accept="'.pdf,.docx,.doc,.odt'"
                :maxSize="'3MB'"
                :helpText="'Choisir le document de votre CV'"
                :errorText="{
                  type: 'Les formats accept\'e sont :pdf, docx, doc, odt ',
                  size: 'La taille du fichier ne doit pas dépasser 3Mo',
                }"
                @select="filesSelected($event, 'poster')"
                @beforedelete="onBeforeDelete($event, 'poster')"
                @delete="fileDeleted($event, 'poster')"
                @upload="retourUpload($event, 'poster')"
                @upload:error="retourError($event, 'poster')"
                v-model="posterRecords"
              ></VueFileAgent>
            </b-field>
            <b-field>
              <b-button
                style="background: #24855a; color: white"
                :loading="loading"
                :disabled="loading"
                class="ma-2 white--text bttn-float bttn-success"
                @click="uploadFiles('poster')"
              >
                Importer {{ posterRecordsForUpload.length }} fichiers
                <v-icon right dark> mdi-cloud-upload </v-icon></b-button
              >
            </b-field>
            <b-field>
              <template #label>
                <span style="color: red"></span
                ><span style="font-size: 16px">Autres documents </span>
              </template>
              <VueFileAgent
                ref="documents"
                :multiple="true"
                :deletable="true"
                :meta="true"
                :maxSize="'3MB'"
                :helpText="'Choisir les documents à ajouter'"
                :errorText="{
                  // type: 'Les formats accept\'e sont :pdf, docx, doc, odt ',
                  size: 'La taille du fichier ne doit pas dépasser 3Mo',
                }"
                @select="filesSelected($event, 'documents')"
                @beforedelete="onBeforeDelete($event, 'documents')"
                @delete="fileDeleted($event, 'documents')"
                @upload="retourUpload($event, 'documents')"
                @upload:error="retourError($event, 'documents')"
                v-model="documentsRecords"
              ></VueFileAgent>
            </b-field>
            <b-field>
              <b-button
                style="background: #24855a; color: white"
                :loading="loading1"
                :disabled="loading1"
                class="ma-2 white--text bttn-float bttn-success"
                @click="uploadFiles('documents')"
              >
                Importer {{ documentsRecordsForUpload.length }} fichiers
                <v-icon right dark> mdi-cloud-upload </v-icon></b-button
              >
            </b-field>
            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red"></span
                ><span style="font-size: 16px">Réalisations sur la plateforme</span>
                <b-tooltip
                  position="is-right"
                  label="Choisissez un ou plusieurs mots clés liés à votre réalisation/projet. S'il le
              mot clé que vous voulez n'existe pas, vous pouvez l'ajouter."
                  size="is-medium"
                  type="is-bleue"
                  multilined
                >
                  <v-icon small color="#24855a">mdi-information </v-icon>
                </b-tooltip>
              </template>
              <v-autocomplete
                color="#24855a"
                :attach="true"
                v-model="postuler.projets"
                @update:search-input="(event) => (title = event)"
                :items="realisationForUser"
                dense
                chips
                small-chips
                label="Vos projets sur la plateforme"
                item-text="title"
                item-value="id"
                multiple
                solo
                style="min-height: 60px"
              >
                <template v-slot:selection="data">
                  <v-chip
                    style="border-style: solid; border-color: #24855a"
                    color="#24855a"
                    text-color="white"
                    v-bind="data.attrs"
                    :input-value="data.selected"
                    close
                    @click="data.select"
                    @click:close="remove(data.item)"
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
                      {{ data.item.title }}</span
                    >
                  </v-chip>
                </template>
                <template v-slot:item="data">
                  <template>
                    <v-list-item-avatar>
                      <img
                        :src="'https://res.cloudinary.com/ddt7qfshl/image/upload/v1666816988/ressources/images/index3_k0nvch.png'"
                      />
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <v-list-item-title v-html="data.item.title"></v-list-item-title>
                    </v-list-item-content>
                  </template>
                </template>
              </v-autocomplete>
            </b-field>

            <b-field>
              <p class="control">
                <b-button
                  label="Valider"
                  style="background: #24855a; color: white"
                  @click="postulerF"
                />
              </p>
            </b-field>
          </a-card>
        </b-step-item>
      </b-steps>
    </a-col>
    <a-col :md="{ offset: 1, span: 8, offset: 1, order: 2 }" :xs="{ order: 1, span: 24 }">
      <a-card>
        <div>
          <p class="font-weight-bold" style="font-size: 20px">{{ offre.title }}</p>
        </div>
        <div class="">
          <div class="card-header font-weight-bold text-subtitle-2">
            Dossier de candidature
          </div>
          <div class="card-body">
            <ol>
              <li
                class="label-text text-subtitle-1"
                v-for="doc in JSON.parse(offre.docs)"
                :key="doc"
              >
                {{ doc }}
              </li>
            </ol>
          </div>
          <div class="">
            <div class="card-header font-weight-bold text-subtitle-2">
              Moyens de candidature
            </div>
            <ol>
              <li
                class="label-text text-subtitle-1"
                v-for="moyen in JSON.parse(offre.moyens)"
                :key="moyen"
              >
                {{ moyen }}
              </li>
            </ol>
          </div>
          <div
            class=""
            v-if="offre.niveau_std && JSON.parse(offre.niveau_std).length != 0"
          >
            <div class="card-header font-weight-bold text-subtitle-2">
              Niveaux d'étude
            </div>
            <ol>
              <li
                class="label-text text-subtitle-1"
                v-for="niv_std in JSON.parse(offre.niveau_std)"
                :key="niv_std"
              >
                {{ niv_std }}
              </li>
            </ol>
          </div>
          <div
            class=""
            v-if="offre.niveau_exp && JSON.parse(offre.niveau_exp).length != 0"
          >
            <div class="card-header font-weight-bold text-subtitle-2">
              Niveau d'expérience
            </div>
            <span>{{ JSON.parse(offre.niveau_exp) }}</span>
          </div>
        </div>
        <div class="text-right">
          <b-button type="is-bleue">Voir plus</b-button>
        </div>
      </a-card>
    </a-col>
  </a-row>
  <!--<a-card style="width: 600px">
        class="d-flex flex-column align-items-center justify-content-center"
        <a-card-header>
          <b-field>
            <template #label>
              <span style="font-size: 20px">{{
                "Postuler à l'offre :" + offre.title
              }}</span>
            </template>
          </b-field>
          <a-card>
            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red">* </span><span style="font-size: 16px">Nom</span>
              </template>
              <b-input type="text" size="is-medium" :value="user.user.lastname" disabled>
              </b-input>
            </b-field>
            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red">* </span
                ><span style="font-size: 16px">Prénoms</span>
              </template>
              <b-input type="text" size="is-medium" :value="user.user.firstname" disabled>
              </b-input>
            </b-field>
            <b-field label="Message">
              <b-input type="textarea" v-model="postuler.message"></b-input>
            </b-field>
            <b-field>
              <template #label>
                <span style="color: red">* </span
                ><span style="font-size: 16px">Votre CV</span>
              </template>
              <VueFileAgent
                ref="poster"
                :multiple="false"
                :deletable="true"
                :meta="true"
                :accept="'.pdf,.docx,.doc,.odt'"
                :maxSize="'3MB'"
                :helpText="'Choisir le document de votre CV'"
                :errorText="{
                  type: 'Les formats accept\'e sont :pdf, docx, doc, odt ',
                  size: 'La taille du fichier ne doit pas dépasser 3Mo',
                }"
                @select="filesSelected($event, 'poster')"
                @beforedelete="onBeforeDelete($event, 'poster')"
                @delete="fileDeleted($event, 'poster')"
                @upload="retourUpload($event, 'poster')"
                @upload:error="retourError($event, 'poster')"
                v-model="posterRecords"
              ></VueFileAgent>
            </b-field>
            <b-field>
              <b-button
                style="background: #24855a; color: white"
                :loading="loading"
                :disabled="loading"
                class="ma-2 white--text bttn-float bttn-success"
                @click="uploadFiles('poster')"
              >
                Importer {{ posterRecordsForUpload.length }} fichiers
                <v-icon right dark> mdi-cloud-upload </v-icon></b-button
              >
            </b-field>
            <b-field>
              <template #label>
                <span style="color: red">* </span
                ><span style="font-size: 16px">Autres documents </span>
              </template>
              <VueFileAgent
                ref="documents"
                :multiple="true"
                :deletable="true"
                :meta="true"
                :maxSize="'3MB'"
                :helpText="'Choisir les documents à ajouter'"
                :errorText="{
                  // type: 'Les formats accept\'e sont :pdf, docx, doc, odt ',
                  size: 'La taille du fichier ne doit pas dépasser 3Mo',
                }"
                @select="filesSelected($event, 'documents')"
                @beforedelete="onBeforeDelete($event, 'documents')"
                @delete="fileDeleted($event, 'documents')"
                @upload="retourUpload($event, 'documents')"
                @upload:error="retourError($event, 'documents')"
                v-model="documentsRecords"
              ></VueFileAgent>
            </b-field>
            <b-field>
              <b-button
                style="background: #24855a; color: white"
                :loading="loading1"
                :disabled="loading1"
                class="ma-2 white--text bttn-float bttn-success"
                @click="uploadFiles('documents')"
              >
                Importer {{ documentsRecordsForUpload.length }} fichiers
                <v-icon right dark> mdi-cloud-upload </v-icon></b-button
              >
            </b-field>
            <b-field custom-class="is-medium">
              <template #label>
                <span style="color: red">* </span
                ><span style="font-size: 16px">Réalisations sur la plateforme</span>
                <b-tooltip
                  position="is-right"
                  label="Choisissez un ou plusieurs mots clés liés à votre réalisation/projet. S'il le
              mot clé que vous voulez n'existe pas, vous pouvez l'ajouter."
                  size="is-medium"
                  type="is-bleue"
                  multilined
                >
                  <v-icon small color="#24855a">mdi-information </v-icon>
                </b-tooltip>
              </template>
              <v-autocomplete
                color="#24855a"
                :attach="true"
                v-model="postuler.projets"
                @update:search-input="(event) => (title = event)"
                :items="realisationForUser"
                dense
                chips
                small-chips
                label="Vos projets sur la plateforme"
                item-text="title"
                item-value="id"
                multiple
                solo
                style="min-height: 60px"
              >
                <template v-slot:selection="data">
                  <v-chip
                    style="border-style: solid; border-color: #24855a"
                    color="#24855a"
                    text-color="white"
                    v-bind="data.attrs"
                    :input-value="data.selected"
                    close
                    @click="data.select"
                    @click:close="remove(data.item)"
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
                      {{ data.item.title }}</span
                    >
                  </v-chip>
                </template>
                <template v-slot:item="data">
                  <template>
                    <v-list-item-avatar>
                      <img
                        :src="'https://res.cloudinary.com/ddt7qfshl/image/upload/v1666816988/ressources/images/index3_k0nvch.png'"
                      />
                    </v-list-item-avatar>
                    <v-list-item-content>
                      <v-list-item-title v-html="data.item.title"></v-list-item-title>
                    </v-list-item-content>
                  </template>
                </template>
              </v-autocomplete>
            </b-field>

            <b-field>
              <p class="control">
                <b-button
                  label="Valider"
                  style="background: #24855a; color: white"
                  @click="postulerF"
                />
              </p>
            </b-field>
          </a-card>
        </a-card-header>
      </a-card>-->
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
      radio: "",
      docV: false,
      desc: false,
      moment,
      offre: {},
      offreUser: {},
      show: false,
      model: 0,
      realisationForUser: [],
      hover: "",
      //loading: false,
      content:
        '<p class="ql-align-justify"><img src="https://res.cloudinary.com/ddt7qfshl/image/upload/v1666810039/ressources/images/Capture_okoo6h.png" style="display: inline; margin: 0px 1em 1em 0px; float: left;" width="215"><strong>Travaillez, prenez de la peine&nbsp;:</strong></p><p class="ql-align-justify"><strong>C’est le fonds qui manque le moin</strong>s.</p><p> Un riche Laboureur, sentant sa mort prochaine,</p><p class="ql-indent-1"> Fit venir ses enfants, leur parla sans témoins.</p><ul><li class="ql-indent-4"> Gardez-vous, leur dit-il, de vendre l’héritage</li><li class="ql-indent-4"> Que nous ont laissé nos parents.</li><li class="ql-indent-4"> Un trésor est caché dedans.</li></ul><p> Je ne sais pas l’endroit&nbsp;; mais un peu de courage</p><p> Vous le fera trouver, vous en viendrez à bout.</p><p> Remuez votre champ dès qu’on aura fait l’Oût.</p><p> Creusez, fouiller, bêchez&nbsp;; ne laissez nulle place</p><p> Où la main ne passe et repasse.</p>',
      posterRecords: [],
      posterRecordsForUpload: [],
      posterToStore: [],
      documentsRecords: [],
      documentsRecordsForUpload: [],
      documentsToStore: [],
      loading: false,
      loading1: false,
      cloudName: "ddt7qfshl",
      uploadHeaders: {},
      postuler: { userId: null, cv: "", message: "", offreId: null, projets: [] },
      step: 0,
      docsCand: [],
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    deserial(ele) {
      console.log(ele);
      console.log(JSON.parse(ele));
      return JSON.parse(ele);
    },
    retourError(res, type) {
      switch (type) {
        case "poster":
          /* this.posterToStore = res;
          this.posterRecordsForUpload = [];*/
          this.loading = false;
          console.log("poster error");
          console.log(this.posterRecordsForUpload);
          break;
        case "documents":
          /* this.posterToStore = res;
          this.posterRecordsForUpload = [];*/
          this.loading1 = false;
          console.log("documents error");
          console.log(this.documentsRecordsForUpload);
          break;
      }
    },
    /*valide(value, field) {},
    step1Valid() {
      let keys = ["nom", "prenom", "email"];
      for (let ele of keys) {
        this.valide(this.postuler., "step1", ele);
      }
      this.errorSearch(this.message.step1);
      if (Object.keys(this.errors).length == 0) {
        this.updateOffreCache(2);
      }
    },*/
    retourUpload(res, type) {
      switch (type) {
        case "poster":
          console.log("doc");
          console.log(res[0].data.secure_url);
          this.postuler.cv = res[0].data.secure_url;

          this.posterToStore = res;
          this.posterRecordsForUpload = [];
          this.loading = false;
          console.log(this.posterToStore);
          break;
        case "documents":
          this.documentsToStore = this.documentsToStore.concat(res);
          this.documentsRecordsForUpload = [];
          this.loading1 = false;
          console.log(this.documentsToStore);
          break;
      }
    },
    async uploadFiles(type) {
      const CLOUDINARY_UPLOAD_PRESET = "ml_default";
      switch (type) {
        case "poster":
          this.loading = true;
          console.log(this.posterRecordsForUpload);
          await this.$refs.poster.upload(
            "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/upload",
            this.uploadHeaders,
            this.posterRecordsForUpload,
            // this.formDataUpload(fileRecord, "ressources/posters")
            (fileRecord) => {
              let formData = new FormData();
              formData.append("upload_preset", "ml_default");
              formData.append("folder", "ressources/CV");
              formData.append("file", fileRecord.file);
              return formData;
            }
          );

          break;
        case "documents":
          this.loading1 = true;
          console.log(this.documentsRecordsForUpload);
          await this.$refs.documents.upload(
            "https://api.cloudinary.com/v1_1/" + this.cloudName + "/upload",
            this.uploadHeaders,
            this.documentsRecordsForUpload,
            // this.formDataUpload(fileRecord, "ressources/docs")
            (fileRecord) => {
              let formData = new FormData();
              formData.append("upload_preset", "ml_default");
              formData.append("folder", "ressources/docs_postuler");
              formData.append("file", fileRecord.file);
              return formData;
            }
          );
          break;
      }
    },
    async formDataDeleted(public_id) {
      const timestamp = new Date().getTime();
      const api_key = "721474231639524";
      const string1 =
        "public_id=" +
        public_id +
        "&timestamp=" +
        timestamp +
        "tKW-g80_eRQbtSHSjwQHbfNzwDc";
      const signature = await sha1(string1);
      let formData = new FormData();
      formData.append("public_id", public_id);
      formData.append("signature", signature);
      formData.append("timestamp", timestamp);
      formData.append("api_key", api_key);
      return formData;
    },
    async deleteUploadedFile(fileRecord, type) {
      switch (type) {
        case "poster":
          const ele3 = this.posterToStore.find((row) => {
            console.log(row.fileRecord);
            if (row.fileRecord == fileRecord) return row;
          });
          console.log("ele3");
          console.log(ele3);
          if (ele3 != null) {
            var k = this.posterToStore.indexOf(ele3);
            if (k !== -1) this.posterToStore.splice(k, 1);
            const public_id = ele3.data.public_id;
            await axios
              .post(
                "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/destroy",
                await this.formDataDeleted(public_id)
              )
              .then((res) => {
                console.log("nathe");
                console.log(res.data.result);
              });
          }
          break;

        case "documents":
          let ele4 = this.documentsToStore.find((row) => {
            console.log(row.fileRecord);
            if (row.fileRecord == fileRecord) {
              return row;
            }
          });
          console.log("ele4");
          console.log(ele4);
          if (ele4 != null) {
            var k = this.documentsToStore.indexOf(ele1);
            if (k !== -1) this.documentsToStore.splice(k, 1);
            const public_id = ele4.data.public_id;
            await axios
              .post(
                "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/destroy",
                await this.formDataDeleted(public_id)
              )
              .then((res) => {
                console.log("nathe");
                console.log(res.data.result);
              });
          }
          break;
      }
      //const
    },
    filesSelected(fileRecordsNewlySelected, type) {
      console.log("selected");
      console.log(fileRecordsNewlySelected);
      switch (type) {
        case "poster":
          var validFileRecords = fileRecordsNewlySelected.filter(
            (fileRecord) => !fileRecord.error
          );
          this.posterRecordsForUpload = validFileRecords;
          break;
        case "documents":
          var validFileRecords = fileRecordsNewlySelected.filter(
            (fileRecord) => !fileRecord.error
          );
          this.documentsRecordsForUpload = this.documentsRecordsForUpload.concat(
            validFileRecords
          );
          break;
      }
    },
    onBeforeDelete(fileRecord, type) {
      switch (type) {
        case "poster":
          var i = this.posterRecordsForUpload.indexOf(fileRecord);
          if (i !== -1) {
            // queued file, not yet uploaded. Just remove from the arrays
            this.posterRecordsForUpload.splice(i, 1);
            var k = this.posterRecords.indexOf(fileRecord);
            if (k !== -1) this.posterRecords.splice(k, 1);
          } else {
            if (confirm("Are you sure you want to delete?")) {
              this.$refs.poster.deleteFileRecord(fileRecord, type); // will trigger 'delete' event
            }
          }
          break;
        case "documents":
          var i = this.documentsRecordsForUpload.indexOf(fileRecord);
          if (i !== -1) {
            // queued file, not yet uploaded. Just remove from the arrays
            this.documentsRecordsForUpload.splice(i, 1);
            var k = this.documentsRecords.indexOf(fileRecord);
            if (k !== -1) this.documentsRecords.splice(k, 1);
          } else {
            if (confirm("Are you sure you want to delete?")) {
              this.$refs.documents.deleteFileRecord(fileRecord, type); // will trigger 'delete' event
            }
          }
          break;
      }
    },
    fileDeleted(fileRecord, type) {
      switch (type) {
        case "poster":
          var i = this.posterRecordsForUpload.indexOf(fileRecord);
          if (i !== -1) {
            this.posterRecordsForUpload.splice(i, 1);
          } else {
            this.deleteUploadedFile(fileRecord, type);
          }
          break;
        case "documents":
          var i = this.documentsRecordsForUpload.indexOf(fileRecord);
          if (i !== -1) {
            this.documentsRecordsForUpload.splice(i, 1);
          } else {
            this.deleteUploadedFile(fileRecord, type);
          }
          break;
      }
    },
    async getOffrebyId() {
      this.loading = true;
      await axios
        .get("/api/v1/offres/" + this.offreId)
        .then((response) => {
          this.offre = response.data.data;
          this.docsCand = JSON.parse(this.offre.docs);
          console.log(this.offre);
          console.log(JSON.parse(this.offre.docs));
          console.log(JSON.parse(this.offre.moyens));
          console.log(this.offre.user);
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      this.loading = false;
    },
    async postulerF() {
      this.postuler.userId = this.user.id;
      this.postuler.offreId = this.offreId;
      this.postuler.documents = JSON.stringify(this.documentsToStore);
      await axios
        .post("/api/v1/offre/postuler", this.postuler)
        .then((response) => {
          console.log(response.data);
          this.$router.push({ name: "successPostuler" });
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
    async like() {
      await axios
        .post("/api/v1/offre/" + this.offreId + "/user/" + this.user.id + "/like")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async dislike() {
      await axios
        .post("/api/v1/offre/" + this.offreId + "/user/" + this.user.id + "/dislike")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async unlike() {
      await axios
        .post("/api/v1/offre/" + this.offreId + "/user/" + this.user.id + "/unlike")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async undislike() {
      await axios
        .post("/api/v1/offre/" + this.offreId + "/user/" + this.user.id + "/undislike")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getRealisationsByUser() {
      await axios
        .get("/api/v1/realisations/getRealisationsByUser/" + this.user.id)
        .then((response) => {
          // console.log(response);
          console.log("logtyu");
          this.realisationForUser = response.data.data;
          console.log(this.realisationForUser);
          console.log(this.realisationForUser);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  async beforeMount() {
    await this.getOffrebyId();
    await this.getRealisationsByUser();
  },
};
</script>
<style lang="scss" scoped></style>
