<template>
  <div class="m-2">
    <v-container class="container h-100 elevation_5 container-m">
      <v-row>
        <v-col cols="12">
          <a-card class="h-100 w-100">
            <div class="w-100 d-flex flex-row justify-content-center">
              <div>
                <div>
                  <span
                    class="login-title my-2 align-self-start fs-8"
                    style="font-size: 40px; font-weight: bold"
                  >
                    Inscription</span
                  >

                  <div>Bienvenue à vous ! Inscrivez-vous sur notre plateforme.</div>
                </div>
              </div>
              <inscrire-employeur
                class="align-self-end ms-auto me-3"
                style="width: 200px; height: 200px"
              ></inscrire-employeur>
            </div>
          </a-card>
        </v-col>
        <!-- <v-col cols="12">
          <a-card>
            <div
              class="h-100 w-100 bttn-float bttn-success d-flex justify-content-center align-items-center"
            >
              <inscrire-employeur
                style="width: 250px; height: 250px"
              ></inscrire-employeur>
            </div>
          </a-card>
        </v-col>-->
        <v-col cols="12">
          <div>
            <a-card>
              <section></section>
              <section class="mt-5">
                <v-row>
                  <v-col cols="12">
                    <b-field
                      label="Pseudo"
                      :message="messagePseudo"
                      class="form-label"
                      :type="typePseudo"
                    >
                      <b-input
                        :value="user.pseudo"
                        @input="validePseudo"
                        type="text"
                        size="is-medium"
                        class="input-login"
                        icon-pack="mdi"
                        icon="person"
                      >
                      </b-input>
                    </b-field>
                  </v-col>
                  <v-col cols="12">
                    <b-field
                      label="Email"
                      :message="messageEmail"
                      class="form-label"
                      :type="typeEmail"
                    >
                      <b-input
                        :value="user.email"
                        @input="valideEmail"
                        type="email"
                        size="is-medium"
                        class="input-login"
                        icon-pack="mdi"
                        icon="email"
                      >
                      </b-input>
                    </b-field>
                  </v-col>
                  <v-col cols="12">
                    <b-field
                      class="form-label"
                      label="Mot de passe"
                      :message="messagePassword"
                      :type="typePassword"
                    >
                      <b-input
                        :value="user.password"
                        @input="validePassword"
                        class="input-login"
                        icon-pack="mdi"
                        icon="lock"
                        size="is-medium"
                        password-reveal
                      >
                      </b-input>
                    </b-field>
                  </v-col>
                  <v-col cols="12" sm="6" class="">
                    <b-field
                      label="Type de compte"
                      :message="messageUsertype"
                      :type="typeUsertype"
                    >
                      <b-select
                        placeholder="Normal"
                        icon="account"
                        :value="user.user_type"
                        @input="valideUsertype"
                      >
                        <option value="normal" class="elevation_2" selected>
                          Normal
                        </option>
                        <option value="student" class="elevation_2">Etudiant</option>
                        <option value="company" class="elevation_2">Entreprise</option>
                      </b-select>
                    </b-field>
                  </v-col>
                  <v-col cols="12" v-if="user_type == 'student'">
                    <v-row align="start">
                      <v-col cols="12" sm="6">
                        <b-field
                          label="Prénoms"
                          :message="messageFirstname"
                          class="form-label"
                          :type="typeFirstname"
                        >
                          <b-input
                            :value="user.firstname"
                            @input="valideFirstname"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                            icon="account"
                          >
                          </b-input>
                        </b-field>
                      </v-col>
                      <v-col sm="6" cols="12">
                        <b-field
                          label="Nom"
                          :message="messageLastname"
                          class="form-label"
                          :type="typeLastname"
                        >
                          <b-input
                            :value="user.lastname"
                            @input="valideLastname"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                            icon="account"
                          >
                          </b-input>
                        </b-field>
                      </v-col>
                      <v-col cols="12">
                        <b-field custom-class="is-medium" expanded>
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px">Université</span>
                          </template>
                          <b-select
                            expanded
                            size="is-medium"
                            placeholder="Université"
                            :value="'Université d\'Abomey-Calavi (UAC)'"
                          >
                            <option value="Université d'Abomey-Calavi (UAC)">
                              Université d'Abomey-Calavi (UAC)
                            </option>
                          </b-select>
                        </b-field>
                      </v-col>
                      <v-col cols="12">
                        <b-field custom-class="is-medium">
                          <template #label>
                            <span style="color: red">* </span>
                            <span style="font-size: 16px">Entité</span>
                          </template>
                          <v-autocomplete
                            v-model="selectedEntity"
                            :items="entities"
                            solo
                            color="blue-grey lighten-2 text-truncated"
                            item-text="name"
                            item-value="id"
                            :height="60"
                            required
                          >
                            <template v-slot:selection="data">
                              <v-avatar left class="me-2">
                                <v-img :src="data.item.logo"></v-img>
                              </v-avatar>
                              <span class="d-inline-block text-truncate">
                                {{ data.item.name }}</span
                              >
                            </template>
                            <template v-slot:item="data">
                              <template>
                                <v-list-item-avatar>
                                  <img :src="data.item.logo" />
                                </v-list-item-avatar>
                                <v-list-item-content>
                                  <v-list-item-title
                                    v-html="data.item.name"
                                  ></v-list-item-title>
                                </v-list-item-content>
                              </template>
                            </template>
                          </v-autocomplete>
                        </b-field>
                      </v-col>
                      <v-col cols="12">
                        <b-field custom-class="is-medium">
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px">Filière</span>
                          </template>
                          <v-autocomplete
                            v-model="selectedFiliere"
                            :items="filieres"
                            :disabled="disabledFiliere"
                            solo
                            color="blue-grey lighten-2 text-truncated"
                            item-text="name"
                            item-value="id"
                            :height="60"
                            required
                          >
                            <template v-slot:selection="data">
                              <span class="d-inline-block text-truncate">
                                {{ data.item.name }}</span
                              >
                            </template>
                            <template v-slot:item="data">
                              <template>
                                <v-list-item-content>
                                  <v-list-item-title
                                    v-html="data.item.name"
                                  ></v-list-item-title>
                                </v-list-item-content>
                              </template>
                            </template>
                            <template v-slot:no-data>
                              <div>
                                <span> Aucune filière disponible dans cette entité</span>
                              </div>
                            </template>
                          </v-autocomplete>
                        </b-field>
                      </v-col>
                      <!-- <v-col cols="6">
                        <b-field
                          label="Université"
                          :message="messageSchoolname"
                          class="form-label"
                          :type="typeSchoolname"
                        >
                          <b-input
                            :value="user.school_name"
                            @input="valideSchoolname"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                          >
                          </b-input>
                        </b-field>
                      </v-col>-->
                    </v-row>
                  </v-col>
                  <v-col cols="12" v-if="user_type == 'company'">
                    <v-row>
                      <v-col cols="12">
                        <b-field
                          label="Nom de l'entreprise"
                          :message="messageCompany"
                          class="form-label"
                          :type="typeCompany"
                        >
                          <b-input
                            :value="user.company_name"
                            @input="valideCompany"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                            icon="account"
                          >
                          </b-input>
                        </b-field>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <b-field
                          label="Adresse de l'entreprise"
                          :message="messageAdresse"
                          class="form-label"
                          :type="typeAdresse"
                        >
                          <b-input
                            :value="user.adresse"
                            @input="valideAdresse"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                            icon="account"
                          >
                          </b-input>
                        </b-field>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <b-field
                          label="Ville"
                          :message="messageVille"
                          class="form-label"
                          :type="typeVille"
                        >
                          <b-input
                            :value="user.ville"
                            @input="valideVille"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                            icon="account"
                          >
                          </b-input>
                        </b-field>
                      </v-col>
                      <v-col cols="12" sm="6" class="">
                        <b-field
                          label="Pays"
                          :message="messagePays"
                          :type="typePays"
                          size="is-medium"
                        >
                          <b-select
                            size="is-medium"
                            placeholder="Pays"
                            icon="earth"
                            @input="validePays"
                          >
                            <option
                              :value="pays.pays"
                              v-for="(pays, index) in Pays"
                              :key="index"
                            >
                              {{ pays.pays }}
                            </option>
                          </b-select>
                        </b-field>
                      </v-col>
                      <v-col cols="12">
                        <b-field label="Site internet de l'internet" class="form-label">
                          <b-input
                            v-model="user.site"
                            type="text"
                            size="is-medium"
                            class="input-login"
                            icon-pack="mdi"
                            icon="link"
                          >
                          </b-input>
                        </b-field>
                      </v-col>
                      <v-col cols="12">
                        <VueFileAgent
                          ref="poster"
                          :multiple="false"
                          :deletable="true"
                          :meta="true"
                          :accept="'image/*'"
                          :maxSize="'10MB'"
                          :helpText="'Choisir le logo de votre entreprise'"
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
                          Importer {{ posterRecordsForUpload.length }} files
                          <v-icon right dark> mdi-cloud-upload </v-icon></b-button
                        >
                      </v-col>
                      <v-col cols="12">
                        <b-field label="Description" type="is-medium">
                          <vue-editor
                            class="w-100"
                            v-model="user.description"
                            ref="editor"
                            placeholder="Décrivez votre entreprise ici"
                            :editorToolbar="customToolbar"
                            :editorOptions="editorSettings" /></b-field
                      ></v-col>
                    </v-row>
                    <!-- <v-col cols="12">
                          <b-field
                            label="Description"
                            :message="messageDescription"
                            class="form-label"
                            :type="typeDescription"
                          >
                            <b-input
                              :value="user.description"
                              @input="valideDescription"
                              type="textarea"
                              size="is-medium"
                              class="input-login"
                              icon-pack="mdi"
                              icon="account"
                            >
                            </b-input>
                          </b-field>
                        </v-col>
                      </v-row>-->
                  </v-col>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6"
                        ><b-checkbox :value="true" type="is-bleue">
                          Rester connecter
                        </b-checkbox></v-col
                      >
                      <v-col cols="6">
                        <a href="" style="color: #4caf50">
                          Mot de passe oublié ?</a
                        ></v-col
                      >
                    </v-row>
                  </v-col>
                  <v-col cols="12">
                    <b-button
                      class="w-100 fw-bold is-bleue"
                      :disabled="processing"
                      @click="register"
                      >S'inscire</b-button
                    >
                  </v-col>
                  <v-col cols="6">
                    Vous avez déjà un compte ?
                    <a href="/login" class="" style="color: #4caf50">Connectez-vous</a>
                  </v-col>
                </v-row>
              </section>
            </a-card>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import reqwest from "reqwest";
let sha1 = require("js-sha1");

import { VueEditor, Quill } from "vue2-editor";
//import { ImageDrop } from "quill-image-drop-module";
//import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-vue";
//import inscrireEmployeur1 from "./Icons/inscrire-employeur-1.vue";
Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
export default {
  // components: { inscrireEmployeur1 },
  data: () => ({
    user: {
      pseudo: "",
      email: "",
      password: "",
      user_type: "",
      firstname: "",
      lastname: "",
      firstname: "",
      filiere_id: "",
      entity_id: "",
      company_name: "",
      adresse: "",
      ville: "",
      pays: "",
      site: "",
      logo: "",
      description: "",
    },
    processing: false,
    typeEmail: "",
    messageEmail: "",
    typePassword: "",
    messagePassword: "",

    valid: true,
    showP: false,
    showC: false,
    firstRules: [(v) => !!v || "Le prénom est obligatoire"],
    lastnameRules: [(v) => !!v || "Le nom est obligatoire"],
    pseudoRules: [(v) => !!v || "Le pseudo est obligatoire"],
    emailRules: [
      (v) => !!v || "L'email est obligatoire",
      (v) => /.+@.+\..+/.test(v) || "L'email entré n'est pas valide",
    ],
    select: null,
    items: ["Item 1", "Item 2", "Item 3", "Item 4"],
    checkbox: false,
    rules: {
      required: (value) => !!value || "Le mot de passe est requis",
      min: (v) => v.length >= 8 || "Au moins 8 caractères",
      emailMatch: () => `The email and password you entered don't match`,
    },
    typeEmail: "",
    messageEmail: "",

    typePassword: "",
    messagePassword: "",

    typeUsertype: "is-bleue",
    messageUsertype: "",

    //typePays: "is-success",
    //messagePays: "",

    typeFirstname: "",
    messageFirstname: "",

    typeLastname: "",
    messageLastname: "",

    typeSchoolname: "",
    messageSchoolname: "",

    typeCompany: "",
    messageCompany: "",

    typeDescription: "",
    messageDescription: "",
    user_type: "",

    typePseudo: "",
    messagePseudo: "",

    typeAdresse: "",
    messageAdresse: "",

    typeVille: "",
    messageVille: "",

    typePays: "is-success",
    messagePays: "",

    /* passwordConfRules: [
        (v) => !!v || "Veuille",
        (v) => /.+@.+\..+/.test(v) || "L'email entré n'est pas valide",
      ],*/

    selectedEntity: null,
    selectedFiliere: null,
    entities: [],

    disabledFiliere: true,
    filieres: [],
    Pays: [],

    posterRecords: [],
    posterRecordsForUpload: [],
    posterToStore: [],
    loading: false,
    cloudName: "ddt7qfshl",
    uploadHeaders: {},
    editorSettings: {
      modules: {
        imageDrop: true,
        imageResize: {},
      },
    },
    customToolbar: [
      [{ font: [] }],

      [{ header: [false, 1, 2, 3, 4, 5, 6] }],

      [{ size: ["small", false, "large", "huge"] }],

      ["bold", "italic", "underline", "strike"],

      [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],

      [{ header: 1 }, { header: 2 }],

      [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],

      [{ script: "sub" }, { script: "super" }],

      [{ indent: "-1" }, { indent: "+1" }],

      [{ color: [] }, { background: [] }],

      [{ direction: "rtl" }],
      ["clean"],
    ],
  }),
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

  methods: {
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
          this.user.logo = res[0].data.secure_url;

          this.posterToStore = res;
          this.posterRecordsForUpload = [];
          this.loading = false;
          console.log(this.posterToStore);
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
              formData.append("folder", "ressources/logo_companies");
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
    async handleImageAdded(file) {
      console.log("file");
      console.log(file);
    },
    valideEmail(value = "") {
      this.user.email = value;
      console.log(value);
      if (this.user.email.length == 0) {
        this.typeEmail = "is-danger";
        this.messageEmail = "Ce champ est requis";
      } else if (/.+@.+\..+/.test(this.user.email) == false) {
        this.typeEmail = "is-danger";
        this.messageEmail = "L'email entré n'est pas valide";
      } else if (/.+@.+\..+/.test(this.user.email) == true) {
        this.typeEmail = "";
        this.messageEmail = "";
      }
    },
    valideUsertype(value = "") {
      this.user_type = value;
      this.user.user_type = value;
      console.log(this.user.user_type);
      if (this.user.user_type.length == 0) {
        this.typeUsertype = "is-danger";
        this.messageUsertype = "Ce champ est requis";
      } else {
        this.typeUsertype = "is-success";
        this.messageUsertype = "";
      }
    },

    validePays(value = "") {
      //this.user_type = value;
      this.user.pays = value;
      console.log(this.user.pays);
      if (this.user.pays.length == 0) {
        this.typePays = "is-danger";
        this.messagePays = "Ce champ est requis";
      } else {
        this.typePays = "is-success";
        this.messagePays = "";
      }
    },
    valideFirstname(value) {
      this.user.firstname = value;
      console.log(value);
      if (this.user.firstname.length == 0) {
        this.typeFirstname = "is-danger";
        this.messageFirstname = "Ce champ est requis";
      } else {
        this.typeFirstname = "";
        this.messageFirstname = "";
      }
    },
    valideLastname(value) {
      this.user.lastname = value;
      console.log(value);
      if (this.user.lastname.length == 0) {
        this.typeLastname = "is-danger";
        this.messageLastname = "Ce champ est requis";
      } else {
        this.typeLastname = "";
        this.messageLastname = "";
      }
    },
    valideAdresse(value) {
      this.user.adresse = value;
      console.log(value);
      if (this.user.adresse.length == 0) {
        this.typeAdresse = "is-danger";
        this.messageAdresse = "Ce champ est requis";
      } else {
        this.typeAdresse = "";
        this.messageAdresse = "";
      }
    },
    valideVille(value) {
      this.user.ville = value;
      console.log(value);
      if (this.user.ville.length == 0) {
        this.typeVille = "is-danger";
        this.messageVille = "Ce champ est requis";
      } else {
        this.typeVille = "";
        this.messageVille = "";
      }
    },
    validePseudo(value) {
      this.user.pseudo = value;
      console.log(value);
      if (this.user.pseudo.length == 0) {
        this.typePseudo = "is-danger";
        this.messagePseudo = "Ce champ est requis";
      } else {
        this.typePseudo = "";
        this.messagePseudo = "";
      }
    },
    validePassword(value = "") {
      console.log(value);
      this.user.password = value;
      if (this.user.password.length == 0) {
        this.typePassword = "is-danger";
        this.messagePassword = "Le mot de passe est requis";
      } else if (this.user.password.length < 8) {
        this.typePassword = "is-warning";
        this.messagePassword = "Au moins 8 caractère";
      } else if (this.user.password != null) {
        this.typePassword = "";
        this.messagePassword = "";
      }
    },
    valideSchoolname(value) {
      this.user.school_name = value;
      console.log(value);
      if (this.user.school_name.length == 0) {
        this.typeSchoolname = "is-danger";
        this.messageSchoolname = "Ce champ est requis";
      } else {
        this.typeSchoolname = "";
        this.messageSchoolname = "";
      }
    },
    valideCompany(value) {
      this.user.company_name = value;
      console.log(value);
      if (this.user.company_name.length == 0) {
        this.typeCompany = "is-danger";
        this.messageCompany = "Ce champ est requis";
      } else {
        this.typeCompany = "";
        this.messageCompany = "";
      }
    },
    valideDescription(value) {
      this.user.description = value;
      console.log(value);
      if (this.user.description.length == 0) {
        this.typeDescription = "is-danger";
        this.messageDescription = "Ce champ est requis";
      } else {
        this.typeDescription = "";
        this.messageDescription = "";
      }
    },

    validate() {
      console.log(this.user.user_type);
      if (this.$refs.register.validate()) {
        this.register();
      }
      console.log("oui");
      console.log(this.$refs.register.validate());
    },
    reset() {
      this.$refs.register.reset();
    },
    resetValidation() {
      this.$refs.register.resetValidation();
    },
    ...mapActions({
      signIn: "auth/login",
    }),

    async registerFunction() {
      this.processing = true;
      console.log("user");
      console.log(this.user);
      this.user.entity_id = this.selectedEntity;
      this.user.filiere_id = this.selectedFiliere;
      await axios
        .post("/api/register", this.user)
        .then((response) => {
          alert(response);
          this.signIn();
        })
        .catch(({ response: { data } }) => {
          alert(data.message);
        })
        .finally(() => {
          this.processing = false;
        });
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
    async register() {
      if (
        this.user.email != null &&
        this.user.email.length != 0 &&
        this.user.password != null &&
        this.user.password.length != 0 &&
        this.user.user_type != null &&
        this.user.user_type.length != 0 &&
        this.user.pseudo != null &&
        this.user.pseudo.length != 0 &&
        this.messageUsertype == "" &&
        this.messagePseudo == "" &&
        this.messageEmail == "" &&
        this.messagePassword == ""
      ) {
        if (this.user.user_type == "normal") {
          await this.registerFunction();
        } else {
          if (this.user.user_type == "student") {
            if (
              this.user.firstname != null &&
              this.user.firstname.length != 0 &&
              this.user.lastname != null &&
              this.user.lastname.length != 0 &&
              // this.user.school_name != null &&
              //this.user.school_name.length != 0 &&
              this.messageFirstname == "" &&
              this.messageLastname == "" &&
              this.selectedFiliere != null &&
              this.selectedEntity != null
            ) {
              await this.registerFunction();
            } else {
              this.valideFirstname(this.user.firstname);
              this.valideLastname(this.user.lastname);
              //this.valideSchoolname(this.user.school_name);
            }
          } else {
            if (
              this.user.description != null &&
              this.user.description.length != 0 &&
              this.user.company_name != null &&
              this.user.company_name.length != 0 &&
              this.messageCompany == "" &&
              this.messageDescription == ""
            ) {
              await this.registerFunction();
            } else {
              this.valideCompany(this.user.company_name);
              this.valideDescription(this.user.description);
            }
          }
        }
      } else {
        this.validePseudo(this.user.pseudo);
        this.valideEmail(this.user.email);
        this.validePassword(this.user.password);
        this.valideUsertype(this.user.user_type);
      }
    },
    async getAllPays() {
      await axios
        .get(
          "https://www.citysearch-api.com/fr/pays?login=UACEmploisStuents&apikey=base64:+5J/v/YZhXPmhNsmWvnWeTm+EmTg1tKrM7tqSF59wfU=",
          {
            headers: {
              // remove headers
            },
          }
        )
        .then((res) => {
          console.log("nathe");
          console.log(res.data.results);
          this.Pays = res.data.results;
          console.log(res);
        });
    },
  },
  /* axios.get(
    ""
  );*/

  /* mounted() {
      this.getAllPays();
    },*/
  async beforeMount() {
    await this.getAllEntities();
    await this.getAllPays();
    await this.getAllPays();
  },
};
</script>
<style scoped></style>
