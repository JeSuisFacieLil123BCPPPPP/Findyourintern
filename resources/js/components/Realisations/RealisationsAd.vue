<template>
  <div class="w-100">
    <div class="d-flex flex-column">
      <v-row>
        <v-col cols="12">
          <a-card>
            <div class="d-flex flex-row justify-content-between">
              <p
                class="font-weight-black text-h1 text-center"
                style="color: black; opacity: 1; vertical-align: middle"
              >
                <b-field>
                  <template #label>
                    <span style="font-size: 40px" class="font-weight-black text-h4"
                      >Ajouter une réalisation</span
                    >
                  </template>
                </b-field>
              </p>
              <add-realisation-1 width="200px" height="100px"></add-realisation-1>
            </div>
          </a-card>
        </v-col>
        <v-col cols="12">
          <a-card :loading="isLoading" class="p-0" style="background: #f0f2f5">
            <v-stepper
              v-model="e1"
              :non-linear="false"
              class="vert"
              style="background: #f0f2f5"
            >
              <v-stepper-header>
                <v-stepper-step step="1" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label> Informations de base </template>
                  </b-field></v-stepper-step
                >

                <v-divider></v-divider>

                <v-stepper-step step="2" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label> Decription </template>
                  </b-field></v-stepper-step
                >

                <v-divider></v-divider>

                <v-stepper-step step="3" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label> Médias </template>
                  </b-field>
                </v-stepper-step>
              </v-stepper-header>

              <v-stepper-items>
                <v-stepper-content step="1">
                  <a-row>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 3, span: 18, offset: 3 }"
                      :xl="{ offset: 3, span: 18, offset: 3 }"
                      :xs="{ span: 24 }"
                    >
                      <div>
                        <a-card
                          class="mx-2 my-5 elevation_0 my-card_1"
                          style="border-radius: 12px"
                        >
                          <div class="d-flex flex-row justify-content-between">
                            <p
                              class="font-weight-black text-h1 text-center"
                              style="color: black; opacity: 1; vertical-align: middle"
                            >
                              <b-field>
                                <template #label>
                                  <span
                                    style="font-size: 40px"
                                    class="font-weight-black text-h4"
                                    >Informations de base</span
                                  >
                                </template>
                              </b-field>
                            </p>
                            <infos-base-1 width="200px" height="100px"></infos-base-1>
                          </div>
                        </a-card>
                        <a-card
                          class="mx-2 my-5 elevation_0 my-card_1"
                          style="border-radius: 12px"
                        >
                          <b-field custom-class="is-medium">
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px"
                                >Titre de la réalisation</span
                              >
                              <b-tooltip
                                position="is-right"
                                type="is-success"
                                label="Il s'agit du titre de votre réalisation/projet"
                              >
                                <v-icon small color="#24855a">mdi-information </v-icon>
                              </b-tooltip>
                            </template>
                            <b-input
                              :value="title"
                              @input="valideTitle"
                              type="text"
                              size="is-medium"
                            >
                            </b-input>
                          </b-field>

                          <b-message
                            type="is-info"
                            v-if="viewInfoTilte == true"
                            closable="true"
                            :duration="7"
                          >
                            Il s'agit du titre de votre réalisation/projet
                          </b-message>
                          <b-field custom-class="is-medium">
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Tags</span>
                              <b-tooltip
                                position="is-right"
                                label="Choisissez un ou plusieurs mots clés liés à votre réalisation/projet. S'il le
                            mot clé que vous voulez n'existe pas, vous pouvez l'ajouter."
                                size="is-medium"
                                type="is-success"
                                multilined
                              >
                                <v-icon small color="#24855a">mdi-information </v-icon>
                              </b-tooltip>
                            </template>
                            <v-autocomplete
                              color="#24855a"
                              v-model="values"
                              :value="name"
                              @update:search-input="(event) => (name = event)"
                              :items="tags"
                              dense
                              chips
                              small-chips
                              label="Tags"
                              item-text="name"
                              item-value="id"
                              multiple
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
                                <b-button type="is-susscess" outlined @click="showAddTag">
                                  Ajouter un tag
                                </b-button>
                              </template>
                            </v-autocomplete>
                          </b-field>
                        </a-card>
                        <a-card
                          class="mx-2 my-5 elevation_0 my-card_1"
                          style="border-radius: 12px"
                        >
                          <b-button type="is-bleue" @click="e1 = 2"> Continuer</b-button>
                        </a-card>
                      </div>
                    </a-col>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 3, span: 18, offset: 3 }"
                      :xl="{ offset: 3, span: 18, offset: 3 }"
                      :xs="{ span: 24 }"
                    >
                    </a-col>
                  </a-row>
                </v-stepper-content>

                <v-stepper-content step="2">
                  <a-row>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 2, span: 20, offset: 2 }"
                      :xl="{ offset: 2, span: 20, offset: 2 }"
                      :xs="{ span: 24 }"
                    >
                      <a-card class="my-2" style="border-radius: 8px 8px">
                        <div class="d-flex flex-row justify-content-between">
                          <p
                            class="font-weight-black text-h1 text-center"
                            style="
                              color: black;
                              opacity: 1;

                              vertical-align: middle;
                            "
                          >
                            <b-field>
                              <template #label>
                                <span
                                  style="font-size: 40px"
                                  class="font-weight-black text-h4"
                                  >Description</span
                                >
                              </template>
                            </b-field>
                          </p>
                          <description-1 width="200px" height="100px"></description-1>
                        </div>
                      </a-card>
                    </a-col>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 2, span: 20, offset: 2 }"
                      :xl="{ offset: 2, span: 20, offset: 2 }"
                      :xs="{ span: 24 }"
                    >
                      <a-card
                        class="elevation_1 mon-card_1 my-2"
                        style="border-radius: 8px 8px"
                      >
                        <template slot="title"> </template>
                        <vue-editor
                          v-model="description"
                          ref="editor"
                          placeholder="Décrivez votre projet/réalisation"
                          useCustomImageHandler
                          @image-added="handleImageAdded"
                          @image-removed="handleImageRemoved"
                          :editorToolbar="customToolbar"
                          :editorOptions="editorSettings"
                        />
                      </a-card>
                    </a-col>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 2, span: 20, offset: 2 }"
                      :xl="{ offset: 2, span: 20, offset: 2 }"
                      :xs="{ span: 24 }"
                    >
                      <a-card
                        class="elevation_1 mon-card_1 my-2"
                        style="border-radius: 8px 8px"
                      >
                        <v-btn color="#24855a" style="color: white" @click="e1 = 3">
                          Continuer</v-btn
                        >
                        <v-btn text @click="e1 = 1"> Réculer</v-btn></a-card
                      ></a-col
                    >
                  </a-row>
                </v-stepper-content>

                <v-stepper-content step="3">
                  <a-col
                    :sm="{ span: 24 }"
                    :md="{ span: 22, offset: 2 }"
                    :lg="{ offset: 3, span: 18, offset: 3 }"
                    :xl="{ offset: 3, span: 18, offset: 3 }"
                    :xs="{ span: 24 }"
                  >
                    <a-card class="my-2" style="border-radius: 8px 8px">
                      <div class="d-flex flex-row justify-content-between">
                        <p
                          class="font-weight-black text-h1 text-center"
                          style="
                            color: black;
                            opacity: 1;

                            vertical-align: middle;
                          "
                        >
                          <b-field>
                            <template #label>
                              <span
                                style="font-size: 40px"
                                class="font-weight-black text-h4"
                                >Médias</span
                              >
                            </template>
                          </b-field>
                        </p>

                        <medias-1 width="200px" height="100px"></medias-1>
                      </div>
                    </a-card>
                    <a-card
                      class="elevation_1 mon-card_1 my-2"
                      style="border-radius: 8px 8px"
                    >
                      <a-form-model-item>
                        <vs-collapse>
                          <vs-collapse-item class="overflow-auto">
                            <div slot="header" class="card-header pointer">
                              <b-field
                                label="Ajouter un poster pour la réalisation"
                              ></b-field>
                            </div>
                            <VueFileAgent
                              ref="poster"
                              :multiple="false"
                              :deletable="true"
                              :meta="true"
                              :accept="'image/*'"
                              :maxSize="'10MB'"
                              :helpText="'Choisir l\'image du poster'"
                              :errorText="{
                                type: 'Le type de l\'image est invalide',
                                size: 'La taille du fichier ne doit pas dépasser 10Mo',
                              }"
                              @select="filesSelected($event, 'poster')"
                              @beforedelete="onBeforeDelete($event, 'poster')"
                              @delete="fileDeleted($event, 'poster', 'image')"
                              @upload="retourUpload($event, 'poster')"
                              @upload:error="retourError($event, 'poster')"
                              v-model="records['poster']"
                            >
                              <!--<template v-slot:before-inner>
                                <h1>Here might be a page title</h1>
                              </template>-->
                              <!--<template v-slot:file-preview>
                                <button class="btn">Ajouter</button>
                              </template>
                              <template v-slot:file-preview-new>
                                <button class="btn">Ajouter</button>
                              </template>-->
                            </VueFileAgent>
                            <v-btn
                              :loading="loading['poster']"
                              :disabled="loading['poster']"
                              color="#24855a"
                              style="color: white"
                              class="ma-2 white--text"
                              @click="
                                uploadFiles('poster', 'image', 'ressources/posters')
                              "
                            >
                              Importer {{ recordsForUpload["poster"].length }} files
                              <v-icon right dark> mdi-cloud-upload </v-icon>
                            </v-btn>
                          </vs-collapse-item>
                        </vs-collapse>
                      </a-form-model-item>
                      <a-form-model-item>
                        <vs-collapse>
                          <vs-collapse-item class="overflow-auto">
                            <div slot="header" class="card-header pointer">
                              <b-field label="Ajouter une vidéo"></b-field>
                            </div>
                            <VueFileAgent
                              ref="video"
                              :multiple="false"
                              :deletable="true"
                              :meta="true"
                              :accept="'video/*,.avi'"
                              :maxSize="'100MB'"
                              :helpText="'Choisir la vidéo à ajouter'"
                              :errorText="{
                                type:
                                  'Le fichier que vous avez choisir n\'a pas un format vidéo',
                                size:
                                  'La taille d\' une vidéo ne doit pas dépasser 100Mo',
                              }"
                              @select="filesSelected($event, 'video')"
                              @beforedelete="onBeforeDelete($event, 'video')"
                              @delete="fileDeleted($event, 'video', 'video')"
                              @upload="retourUpload($event, 'video')"
                              @upload:error="retourError($event, 'video')"
                              v-model="records['video']"
                            ></VueFileAgent>
                            <v-btn
                              :loading="loading['video']"
                              :disabled="loading['video']"
                              color="#24855a"
                              style="color: white"
                              class="ma-2 white--text"
                              @click="uploadFiles('video', 'video', 'ressources/videos')"
                            >
                              Importer {{ recordsForUpload["video"].length }} files
                              <v-icon right dark> mdi-cloud-upload </v-icon>
                            </v-btn>
                          </vs-collapse-item>
                        </vs-collapse>
                      </a-form-model-item>
                      <a-form-model-item>
                        <vs-collapse>
                          <vs-collapse-item class="overflow-auto">
                            <div slot="header" class="card-header pointer">
                              <b-field label="Ajouter des documents"></b-field>
                            </div>
                            <VueFileAgent
                              ref="docs"
                              :multiple="true"
                              :deletable="true"
                              :meta="true"
                              :accept="'.pdf,.docx,.doc,.odt,.txt,.ods,.zip'"
                              :maxSize="'100MB'"
                              :helpText="'Choisir le document à ajouter'"
                              :errorText="{
                                type:
                                  'Le fichier que vous avez choisir n\'a pas un des formats autorisés',
                                size:
                                  'La taille d\' une vidéo ne doit pas dépasser 100Mo',
                              }"
                              @select="filesSelected($event, 'docs')"
                              @beforedelete="onBeforeDelete($event, 'docs')"
                              @delete="fileDeleted($event, 'docs', 'image')"
                              @upload="retourUpload($event, 'docs')"
                              @upload:error="retourError($event, 'docs')"
                              v-model="records['docs']"
                            ></VueFileAgent>
                            <v-btn
                              :loading="loading['docs']"
                              :disabled="loading['docs']"
                              color="#24855a"
                              style="color: white"
                              class="ma-2 white--text"
                              @click="uploadFiles('docs', 'image', 'ressources/docs')"
                            >
                              Importer {{ recordsForUpload["docs"].length }} files
                              <v-icon right dark> mdi-cloud-upload </v-icon>
                            </v-btn>
                          </vs-collapse-item>
                        </vs-collapse>
                      </a-form-model-item>
                    </a-card>
                    <a-card
                      class="elevation_1 mon-card_1 my-2"
                      style="border-radius: 8px 8px"
                    >
                      <v-alert text prominent type="error" v-if="importation">
                        Il y a des médias que vous n'avez pas importé ou qui sont en cours
                        d'importation.
                      </v-alert>
                      <v-alert text prominent type="error" v-if="vide">
                        Il y a des champs vides
                      </v-alert>
                      <v-btn color="#24855a" style="color: white" @click="submitForm">
                        Soumettre</v-btn
                      >
                      <v-btn text @click="e1 = 2"> Réculer</v-btn></a-card
                    >
                  </a-col>
                </v-stepper-content>
              </v-stepper-items>
            </v-stepper>
          </a-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
import _ from "lodash";
import { defineComponent, ref } from "vue";
import { VueEditor, Quill } from "vue2-editor";
//import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-vue";
import infosBase1 from "../Icons/infos-base-1.vue";
import description1 from "../Icons/description-1.vue";
import medias1 from "../Icons/medias-1.vue";
import addRealisation1 from "../Icons/add-realisation-1.vue";
Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
import uplodFile from "../../mixin/uplodFile";
export default {
  components: { infosBase1, medias1, description1, addRealisation1 },
  name: "App",
  mixins: [uplodFile],
  data() {
    return {
      radio: "",
      value: null,

      viewInfoTilte: false,
      images: [],

      index: null,
      selecteds: [],
      data: null,
      editor: null,
      labelCol: { span: 4 },
      wrapperCol: { span: 14 },
      title: "",
      formData1: new FormData(),

      entities: [],

      subcategory_id: null,
      tags: [],
      success: "",
      corne: ref(4),

      cloudName: "ddt7qfshl",
      uploadHeaders: {},
      importation: false,
      isError: false,
      errorText: null,
      isLoading: false,
      records: {
        poster: [],
        images: [],
        docs: [],
        video: [],
      },
      toStore: {
        poster: [],
        images: [],
        docs: [],
        video: [],
      },
      recordsForUpload: {
        poster: [],
        images: [],
        docs: [],
        video: [],
      },
      loading: {
        poster: false,
        images: false,
        docs: false,
        video: false,
      },
      name: "",
      selectedEntity: null,
      selectedFiliere: null,
      selectable: false,

      values: [],
      e1: 1,
      steps: 2,
      description: "",

      typeTitle: "",
      messageTitle: "",
      vide: false,

      disabledFiliere: true,
      filieres: [],

      customToolbar: [
        [{ font: [] }],

        [{ header: [false, 1, 2, 3, 4, 5, 6] }],

        [{ size: ["small", false, "large", "huge"] }],

        ["bold", "italic", "underline", "strike"],

        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],

        [{ header: 1 }, { header: 2 }],

        ["blockquote", "code-block"],

        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],

        [{ script: "sub" }, { script: "super" }],

        [{ indent: "-1" }, { indent: "+1" }],

        [{ color: [] }, { background: [] }],

        ["link", "image", "formula"],

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
  watch: {
    selectedEntity(val) {
      var index = val;
      var entity = this.entities.find((entity) => {
        return entity.id == val;
      });
      console.log("entity");
      console.log(entity);
      this.filieres = entity.filieres;
      console.log(this.filieres);
      this.disabledFiliere = false;
    },
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
    filteredDataArray() {
      return this.tags.filter((option) => {
        return option.name.toString().toLowerCase().indexOf(this.name.toLowerCase()) >= 0;
      });
    },
    filterTag(item, queryText, itemText) {
      return itemText.toLocaleLowerCase().indexOf(queryText.toLocaleLowerCase()) >= 0;
    },
  },

  methods: {
    valideTitle(value = "") {
      console.log(value);
      this.title = value;
      if (this.title.length == 0) {
        this.typeTitle = "is-danger";
        this.messageTitle = "Le titre est requis";
      } else {
        this.typeTitle = "is-success";
        this.messageTitle = "";
      }
    },
    remove(item) {
      console.log(item);
      console.log(this.values);
      const index = this.values.indexOf(item.id);
      if (index >= 0) this.values.splice(index, 1);
    },
    showAddTag() {
      this.$buefy.dialog.prompt({
        type: "is-info",
        message: `Tag`,
        inputAttrs: {
          placeholder: "e.g. Web",
          maxlength: 20,
          value: this.name,
        },
        confirmText: "Ajouter",
        onConfirm: (value) => {
          this.createTag(value);
          this.getAllTags();
        },
      });
    },
    async createTag(value) {
      await axios
        .post("/api/v1/tags", { name: value })
        .then((response) => {
          console.log(response.data.tag);
          this.$vs.notify({
            title: "Success",
            text: "Vous venez d'ajouter un tag avec succès",
            color: "success",
          });
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    init() {
      /* this.posterRecords = [];
      this.posterRecordsForUpload = [];
      this.posterToStore = [];
      this.imagesRecords = [];
      this.imagesRecordsForUpload = [];
      this.imagesToStore = [];
      this.docsRecords = [];
      this.docsRecordsForUpload = [];
      this.docsToStore = [];
      this.videoRecords = [];
      this.videoRecordsForUpload = [];
      this.videoToStore = [];
      this.formData1 = new FormData();
      this.title = "";
      this.description = "";
      this.values = [];*/
    },
    async getAllEntities() {
      await axios
        .get("/api/v1/entities")
        .then((response) => {
          console.log("entites");
          console.log(response.data.data);
          const entities = response.data.data;
          this.entities = [...entities];
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },
    formDataForRealisation(type, index, fileToStore) {
      this.formData1.append(type, JSON.stringify(fileToStore));
    },
    async submitForm() {
      this.valideTitle(this.title);
      if (this.messageTitle.length == 0) {
        if (
          //this.imagesRecordsForUpload.length == 0 &&
          this.recordsForUpload["images"].length == 0 &&
          this.recordsForUpload["video"].length == 0 &&
          this.recordsForUpload["docs"].length == 0
        ) {
          console.log("description");
          console.log(this.description);
          this.formData1.append("title", this.title);
          this.formData1.append("description", this.description);
          this.formData1.append("tags", JSON.stringify(this.values));
          this.formData1.append("entity_id", this.selectedEntity);
          this.formData1.append("filiere_id", this.selectedFiliere);
          //this.formData1.append("tags",this.values);
          /*_.each(this.values, (value, key) => {
          this.formData1.append("tags[]", value);
        });*/
          if (this.posterToStore.length != 0)
            this.formDataForRealisation("poster", 0, this.posterToStore);
          if (this.videoToStore.length != 0)
            this.formDataForRealisation("video", 0, this.videoToStore);
          if (this.docsToStore.length != 0)
            this.formDataForRealisation("docs", 0, this.docsToStore);
          console.log("mon sesult");
          console.log(this.formData1.get);

          this.isLoading = true;

          await axios
            .post("/api/v1/users/" + this.user.id + "/realisations", this.formData1)
            .then((response) => {
              console.log(response);
              this.$vs.notify({
                color: "success",
                title: "SUCCES",
                text: "LA REALISATION/PROJET A ETE AJOUTE AVEC SUCCES",
              });
              this.init();
            })
            .catch(({ response: { data } }) => {
              console.log(data);
              this.$vs.notify({
                color: "danger",
                title: "Erreur",
                text: data,
              });
            })
            .finally(() => {
              this.isLoading = false;
            });
        } else {
          this.importation = true;
          setTimeout(() => {
            this.importation = false;
          }, 10000);
        }
      } else {
        this.vide = true;
        setTimeout(() => {
          this.vide = false;
        }, 10000);
      }
    },
    successUpload() {
      this.$vs.notify({
        color: "success",
        title: "Upload Success",
        text: "Lorem ipsum dolor sit amet, consectetur",
      });
    },
    async addRealisation() {
      //api/v1/users/{user}/subcategories/{subcategory}/realisations
      console.log("azertyuiop  " + this.desc + "");
      await axios
        .post(
          "/api/v1/users/" +
            this.user.id +
            "/subcategories/" +
            this.subcategory_id +
            "/realisations",
          this.form
        )
        .then((response) => {
          console.log(response);
          this.$vs.notify({
            color: "success",
            color: "success",
            title: "Upload Success",
            text: response.data.message,
          });
          this.init();
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
          this.$vs.notify({
            color: "danger",
            title: "boff",
            text: response.data.message,
          });
        });
    },
    async getAllTags() {
      await axios
        .get("/api/v1/tags")
        .then((response) => {
          console.log(response.data.data);
          // const categories = response.data.data;
          this.tags = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },

    async handleImageAdded(file, Editor, cursorLocation, resetUploader) {
      const CLOUDINARY_UPLOAD_PRESET = "ml_default";
      let formData = new FormData();
      formData.append("upload_preset", CLOUDINARY_UPLOAD_PRESET);
      formData.append("folder", "ressources/images");
      formData.append("file", file);
      console.log("sass");
      console.log(cursorLocation);
      console.log(resetUploader);
      // console.log(a);
      await axios
        .post("https://api.cloudinary.com/v1_1/ddt7qfshl/image/upload", formData)
        .then((response) => {
          console.log(response);
          this.images.push(response.data);
          console.log(Editor);
          Editor.insertEmbed(
            cursorLocation,
            "image",
            response.data.secure_url
            //response.data.public_id
          );
          resetUploader();
        })
        .catch(({ response: { data } }) => {
          console.log(data);
        });
    },
    async handleImageRemoved(file, Editor, cursorLocation) {
      console.log("seyd");
      console.log(file);
      console.log(Editor);
      console.log(cursorLocation);
      var index = this.images.findIndex(function (ele) {
        console.log("file");
        console.log(file);
        return ele.secure_url == file;
      });
      await axios
        .post(
          "https://api.cloudinary.com/v1_1/ddt7qfshl/image/destroy",
          await this.formDataDeletedFile(index)
        )
        .then((res) => {
          console.log("nathe");
          console.log(res.data.result);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    async formDataDeletedFile(index) {
      const timestamp = new Date().getTime();
      const api_key = "721474231639524";
      const string1 =
        "public_id=" +
        this.images[index].public_id +
        "&timestamp=" +
        timestamp +
        "tKW-g80_eRQbtSHSjwQHbfNzwDc";
      const signature = await sha1(string1);
      let formData = new FormData();
      formData.append("public_id", this.images[index].public_id);
      formData.append("signature", signature);
      formData.append("timestamp", timestamp);
      formData.append("api_key", api_key);
      return formData;
    },
  },
  async mounted() {
    await this.getAllTags();
    await this.getAllEntities();
    console.log("methode fdghjklmù");
    console.log(this.$data);
  },
};
</script>
<style scoped>
/* tile uploaded pictures */
.pointer {
  cursor: pointer;
}
/*.upload-list-inline :deep(.ant-upload-list-item) {
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
}*/
/*.ce-block__content,
.ce-toolbar__content {
  max-width: unset;
  background: green !important;
}*/
</style>
