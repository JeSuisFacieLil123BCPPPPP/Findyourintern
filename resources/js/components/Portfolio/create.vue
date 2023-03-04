<template>
  <div>
    <div class="d-flex flex-column justify-content-center align-items-center">
      <v-row>
        <v-col cols="12">
          <a-card class="100 mx-2 my-5 elevation_0" style="border-radius: 12px">
            <template slot="title">
              <div class="d-flex flex-row">
                <p
                  class="font-weight-black text-h1 text-center"
                  style="
                    color: black;
                    opacity: 1;
                    margin: auto auto;
                    vertical-align: middle;
                  "
                >
                  <b-field>
                    <template #label>
                      <span style="font-size: 40px" class="font-weight-black text-h4"
                        >Ajouter mon propre portfolio</span
                      >
                    </template>
                  </b-field>
                </p>
                <img
                  src="../../assets/portfolio-icon-3.jpg"
                  alt=""
                  height="100"
                  width="250"
                  class=""
                  style="margin-left: auto; margin-right: 8px"
                />
              </div>
            </template>
          </a-card>
          <a-card
            :loading="isLoading"
            class="100 mx-2 my-5 elevation_0"
            style="border-radius: 12px"
          >
            <v-card style="width: 950px" elevation="0">
              <b-field custom-class="is-medium">
                <template #label>
                  <span style="color: red">* </span
                  ><span style="font-size: 16px">Métier</span>
                  <b-tooltip
                    position="is-right"
                    label="Il s'agit du métier conçerné"
                    size="is-medium"
                    type="is-bleue"
                    multilined
                  >
                    <v-icon small color="#24855a">mdi-information </v-icon>
                  </b-tooltip>
                </template>
                <v-autocomplete
                  color="#24855a"
                  v-model="portfolio.metierId"
                  :value="name"
                  @update:search-input="(event) => (name = event)"
                  :items="metiers"
                  dense
                  chips
                  small-chips
                  label="Metiers"
                  item-text="name"
                  item-value="id"
                  :multiple="false"
                  solo
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
                    >
                      {{ data.item.name }}
                    </v-chip>
                  </template>

                  <template slot="prepend-item">
                    <b-button type="is-bleue" outlined @click="showAddMetier">
                      Ajouter un métier
                    </b-button>
                  </template>
                </v-autocomplete>
              </b-field>
              <b-field custom-class="is-medium">
                <template #label>
                  <span style="color: red">* </span
                  ><span style="font-size: 16px">Lien du site de votre portfolio</span>
                  <b-tooltip
                    position="is-right"
                    type="is-bleue"
                    label="Il s'agit du lien du site web de votre portfolio"
                  >
                    <v-icon small color="#24855a">mdi-information </v-icon>
                  </b-tooltip>
                </template>
                <b-input type="text" size="is-small" v-model="portfolio.url"> </b-input>
              </b-field>
              <b-field custom-class="is-medium">
                <template #label>
                  <span style="color: red">* </span
                  ><span style="font-size: 16px">Mon poster</span>
                  <b-tooltip
                    position="is-right"
                    label="Il s'agit de l'image qui servira de poster pour votre portfolio"
                    size="is-medium"
                    type="is-bleue"
                    multilined
                  >
                    <v-icon small color="#24855a">mdi-information </v-icon>
                  </b-tooltip>
                </template>
              </b-field>
              <b-field>
                <v-col cols="12">
                  <VueFileAgent
                    ref="poster"
                    :multiple="false"
                    :deletable="true"
                    :meta="true"
                    :accept="'image/*'"
                    :maxSize="'10MB'"
                    :helpText="'Choisir le poster'"
                    :errorText="{
                      type: 'Le type de l\'image est invalide',
                      size: 'La taille du fichier ne doit pas dépasser 10Mo',
                    }"
                    @select="filesSelected($event, 'poster')"
                    @beforedelete="onBeforeDelete($event, 'poster')"
                    @delete="fileDeleted($event, 'poster')"
                    @upload="retourUpload($event, 'poster')"
                    @upload:error="retourError($event, 'poster')"
                    v-model="posterRecords"
                  ></VueFileAgent>
                  <b-button
                    type="is-bleue"
                    :loading="loading"
                    :disabled="loading"
                    class="ma-2 white--text bttn-float bttn-success"
                    @click="uploadFiles('poster')"
                  >
                    Importer {{ posterRecordsForUpload.length }} fichiers
                    <v-icon right dark> mdi-cloud-upload </v-icon></b-button
                  >
                </v-col>
              </b-field>
              <b-button type="is-bleue" @click="createPortfolio">Créer</b-button>
            </v-card>
            <b-message
              v-if="importation"
              title="Danger"
              type="is-danger"
              aria-close-label="Close message"
              is-bottom-right
            >
              Il y a des médias que vous n'avez pas importé ou qui sont en cours
              d'importation.
            </b-message>
            <b-message
              v-if="vide"
              title="Danger"
              type="is-danger"
              aria-close-label="Close message"
              is-bottom-right
            >
              Il y a des champs vides
            </b-message>
          </a-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";
import { defineComponent, ref } from "vue";
import { VueEditor, Quill } from "vue2-editor";
//import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-vue";

Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
export default {
  name: "App",
  data() {
    return {
      radio: "",
      portfolio: { metierId: "", poster: "", url: "" },
      posterRecords: [],
      posterRecordsForUpload: [],
      posterToStore: [],
      cloudName: "ddt7qfshl",
      uploadHeaders: {},
      importation: false,
      isLoading: false,
      loading: false,
      loading2: false,
      name: "",
      values: [],
      metiers: [],
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    showAddMetier() {
      this.$buefy.dialog.prompt({
        type: "is-info",
        message: `Métier`,
        inputAttrs: {
          placeholder: "e.g. Web",
          maxlength: 20,
          value: this.name,
        },
        confirmText: "Ajouter",
        onConfirm: (value) => {
          this.createMetier(value);
          this.getAllMetiers();
        },
      });
    },
    remove(item) {
      console.log("item");
      console.log(item);
      console.log(this.values);
      this.portfolio.metierId = null;
      //if (index >= 0) this.values.splice(index, 1);
    },
    async getAllMetiers() {
      await axios
        .get("/api/v1/metiers")
        .then((response) => {
          console.log(response.data);
          console.log("metiers");
          console.log(response);
          this.metiers = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },
    async createMetier(value) {
      await axios
        .post("/api/v1/metiers", { name: value })
        .then((response) => {
          console.log(response.data.metier);
          this.$vs.notify({
            title: "Success",
            text: "Vous venez d'ajouter un métier avec succès",
            color: "success",
          });
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
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
      }
    },
    retourUpload(res, type) {
      switch (type) {
        case "poster":
          console.log("logo");
          console.log(res[0].data.secure_url);
          this.portfolio.poster = res[0].data.secure_url;

          this.posterToStore = res;
          this.posterRecordsForUpload = [];
          this.loading = false;
          console.log("poster");
          console.log(this.posterToStore);
          break;
      }
    },
    async uploadFiles(type) {
      const CLOUDINARY_UPLOAD_PRESET = "portfolio";
      switch (type) {
        case "poster":
          this.loading = true;
          console.log(this.posterRecordsForUpload);
          await this.$refs.poster.upload(
            "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/upload",
            this.uploadHeaders,
            this.posterRecordsForUpload,
            // this.formDataUpload(fileRecord, "ressources/portfolioPosters")
            (fileRecord) => {
              let formData = new FormData();
              formData.append("upload_preset", CLOUDINARY_UPLOAD_PRESET);
              formData.append("folder", "ressources/portfolioPosters");
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
      }
    },
    ...mapActions({
      signIn: "auth/login",
    }),

    async createPortfolio() {
      this.processing = true;
      // this.portfolio.url = this.posterRecords[0].data.url;
      await axios
        .post("/api/v1/portfolio/create/" + this.user.id, this.portfolio)
        .then((response) => {
          console.log("Succès");
          // alert(response);
          //this.signIn();
        })
        .catch(({ response: { data } }) => {
          alert(data.message);
        })
        .finally(() => {
          this.processing = false;
        });
    },
  },

  async mounted() {
    await this.getAllMetiers();
  },
};
</script>
<style scoped>
/* tile uploaded pictures */
.pointer {
  cursor: pointer;
}
.upload-list-inline :deep(.ant-upload-list-item) {
  float: left;
  width: 200px;
  margin-right: 8px;
}
.upload-list-inline [class*="-upload-list-rtl"] :deep(.ant-upload-list-item) {
  float: right;
}
.editor {
  margin-left: 0px !important;
  padding: 0px !important;
}
.cdx-settings-button {
  color: red;
  background: greenyellow;
}
/*.ce-block__content,
  .ce-toolbar__content {
    max-width: unset;
    background: green !important;
  }*/
</style>
