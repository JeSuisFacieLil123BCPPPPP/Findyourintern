<template>
  <div>
    <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
      {{ offre.title.value }}
      <b-field custom-class="is-medium" class="form-label" :type="type.title">
        <template #label>
          <span style="color: red">* </span
          ><span style="font-size: 16px">Intitulé du poste</span>
          <b-tooltip
            step="is-right"
            type="is-bleue"
            label="Il s'agit de l'intitulé du poste et il apparaitra comme le titre de l'offre"
          >
            <v-icon small style="color: #24855a">mdi-information </v-icon>
          </b-tooltip>
        </template>
        <b-input
          type="text"
          size="is-medium"
          :value="offre.title.value"
          @input="valide($event, 'step1', 'title')"
        >
        </b-input>
      </b-field>
      <span
        style="
          display: block;
          height: 18px;
          color: #f14668;
          font-size: 0.75rem;
          margin-top: 0.25rem;
        "
        >{{ message.step1.title }}</span
      >
    </a-card>
    <!--
    <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
      <b-field custom-class="is-medium" class="form-label" :type="type.lieu">
        <template #label>
          <span style="color: red">* </span
          ><span style="font-size: 16px"
            >Parmi ces options, laquelle décrit le mieux le lieu de travail de ce poste
            ?</span
          >
          <b-tooltip
            step="is-right"
            type="is-bleue"
            label="Il s'agit du  mode de travail"
          >
            <v-icon small style="color: #24855a">mdi-information </v-icon>
          </b-tooltip>
        </template>
        <b-select
          size="is-medium"
          placeholder=""
          @input="valideLieu"
          :value="offre.lieu"
          expanded
        >
          <option :value="lieu.name" v-for="(lieu, index) in lieux" :key="index">
            {{ lieu.name }}
          </option>
        </b-select>
      </b-field>
      <span style="display: block; height: 18px; color: #f14668; font-size: 0.75rem">{{
        message.step1.lieu
      }}</span>
      <b-field
        custom-class="is-medium"
        class="form-label"
        :type="type.zone"
        expanded
        v-if="offre.lieu == 'En personne(lieu précis)'"
      >
        <template #label>
          <span style="color: red">* </span
          ><span style="font-size: 16px">Quelle est l'adresse postale de ce lieu ?</span>
        </template>
        <b-input type="text" size="is-medium" :value="offre.zone" @input="valideZone">
        </b-input>
      </b-field>
      <span
        style="
          display: block;
          height: 18px;
          color: #f14668;
          font-size: 0.75rem;
          margin-top: 0.25rem;
        "
        >{{ message.step1.zone }}</span
      >
      <vs-alert
        class="my-2"
        v-if="offre.lieu == 'Télétravail'"
        closable
        close-icon="cancel"
        icon="info"
      >
        Nous indiquerons « Télétravail » comme lieu du poste et nous le promouverons
        auprès de personnes à la recherche de travail à distance au sein du pays.
      </vs-alert>
    </a-card>
    <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
      <b-field expanded custom-class="is-medium" class="form-label" :type="type.secteur">
        <template #label>
          <span style="color: red">* </span
          ><span style="font-size: 16px">Secteur d'activité</span>
          <b-tooltip
            step="is-right"
            type="is-bleue"
            label="Il s'agit du titre de votre réalisation/projet"
          >
            <v-icon small style="color: #24855a">mdi-information </v-icon>
          </b-tooltip>
        </template>

        <b-select
          size="is-medium"
          placeholder="Secteur d'activité"
          @input="valideSecteur"
          :value="offre.secteur"
          expanded
        >
          <option :value="secteur.name" v-for="(secteur, index) in secteurs" :key="index">
            {{ secteur.name }}
          </option>
        </b-select>
      </b-field>
      <span
        style="
          display: block;
          height: 18px;
          color: #f14668;
          font-size: 0.75rem;
          margin-top: 0.25rem;
        "
        >{{ message.step1.secteur }}</span
      >
    </a-card>
    <b-message
      class="mx-2 my-5 elevation_0 my-card_1"
      v-if="e1 == 1 && Object.keys(errors).length != 0"
      title=""
      type="is-danger"
      has-icon
      icon-size="is-medium"
      role="alert"
      :closable="false"
    >
      <div>
        <span style="color: #2d2d2d; font-weight: bold"
          >Des éléments requièrent votre attention</span
        >
      </div>
      <ul style="list-style: square">
        <li v-for="error in errors" :key="error">
          <span style="color: #6e6c6c">{{ error }}</span>
        </li>
      </ul>
    </b-message>
    <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
      <b-button
        @click="step1Valid"
        :loading="isLoading"
        style="background: #24855a; color: white"
      >
        Enregistrer et continuer
      </b-button></a-card
    >

    <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
      <b-field>
        <template #label>
          <span style="color: red">* </span
          ><span style="font-size: 16px"
            >Il y a t-il une date de début prévu pour ce poste ?</span
          >
          <b-tooltip
            step="is-right"
            type="is-bleue"
            label="Il s'agit du type de poste de votre offre"
          >
            <v-icon small style="color: #24855a">mdi-information </v-icon>
          </b-tooltip>
        </template>
      </b-field>
      <b-field>
        <b-datepicker placeholder="selectionne" range v-model="dates"> </b-datepicker>
      </b-field>
      <a-card>
        <a-card class="elevation_0 my-card_1 my-1" style="border-radius: 12px">
          <b-radio v-model="radio" type="is-bleue" :native-value="true" size="is-medium">
            Oui
          </b-radio>
        </a-card>

        <a-card class="elevation_0 my-card_1 my-1" style="border-radius: 12px">
          <b-radio v-model="radio" type="is-bleue" :native-value="false" size="is-medium">
            Non
          </b-radio>
        </a-card>

        <div v-if="radio == true">
          <b-field
            custom-class="is-medium"
            class="form-label"
            :type="type.date_deb"
            expanded
          >
            <b-datepicker
              :min-date="new Date()"
              ref="datepicker1"
              expanded
              placeholder="Sélectionnez une date"
              @input="valideDateDeb"
              :value="offre.date_deb"
              size="is-medium"
            >
            </b-datepicker>
            <b-button
              class="h-100"
              @click="$refs.datepicker1.toggle()"
              icon-left="calendar-today"
              type="is-bleue"
            />
          </b-field>
          <span
            style="
              display: block;
              height: 18px;
              color: #f14668;
              font-size: 0.75rem;
              margin-top: 0.25rem;
            "
            >{{ message.step3.date_deb }}</span
          >
        </div>
      </a-card>
    </a-card>-->
  </div>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
import _ from "lodash";
import { VueEditor, Quill } from "vue2-editor";
//import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-vue";
import infosBase1 from "../Icons/infos-base-1.vue";
import description1 from "../Icons/description-1.vue";
import addDetailsIcon1 from "../Icons/add-details-icon-1.vue";
import publierOffre1 from "../Icons/publier-offre-1.vue";
import preferencesCandidature from "../Icons/preferences-candidature.vue";

Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
//import { createNamespacedHelpers } from "vuex";

//import { mapGetters, mapActions, mapMutations } from "vuex";

export default {
  components: {
    infosBase1,
    description1,
    addDetailsIcon1,
    publierOffre1,
    preferencesCandidature,
  },
  //name: "App",
  data() {
    return {
      dates: [],
      telephones: [],
      typeEmail: [],
      messageEmail: [],
      email1: "",
      nbrJrs: ["7 jours", "10 jours", "14 jours", "22 jours"],
      //e1: this.myE1(this.$route.query.step),
      offre: {
        //telephoneNum: null,
        title: {
          value: "",
          //required: true,
          valide: (v) => {
            this.valideBasic(v);
          },
        },
        type: {
          value: "",
          required: true,
        },
        lieu: {
          value: "",
          required: true,
        },
        secteur: {
          value: "",
          required: true,
        },
        description: {
          value: "",
          required: true,
        },
        exigences: {
          value: "",
          required: false,
        },
        auto_convers: {
          value: false,
          required: true,
        },
        autoriseMail: {
          value: false,
          required: true,
        },
        isSwitched: {
          value: false,
          required: true,
        },
        zone: {
          value: "",
          required: "",
        },
        date_limite: {
          value: null,
          //required: false,
          type: "date",
          valide: (v) => {},
        },
        date_deb: {
          value: null,
          required: false,
          type: "date",
        },
        nbr: {
          value: 1,
          required: false,
        },
        duree: {
          value: {
            nbrTime: 0,
            time: "Jour(s)",
          },
          required: false,
        },
        salaire: {
          value: {
            devise: "",
            montant: "",
            frequence: "par jour",
          },
          required: false,
        },
        //salaire:
        horaires: [],
        urgence: 1,
        urgence: {
          value: 1,
          required: true,
        },
        emails: {
          value: {},
          required: false,
        },
        telephone: {},
      },
      formData1: new FormData(),
      radio: false,
      radio1: false,
      isLoading: false,
      isLoading1: false,
      modelOffre: {
        title: "",
        type: "",
        lieu: "",
        secteur: "",
        description: "",
        exigences: "",
        auto_convers: false,
        autoriseMail: false,
        exigences: "",
        zone: "",
        date_limite: "",
        date_deb: "",
        nbr: 1,
        duree: {
          nbrTime: 0,
          time: "Jour(s)",
        },
        salaire: {
          devise: "",
          montant: "",
          frequence: "par jour",
        },
        horaires: [],
        urgence: 1,
        emails: {},
      },
      message: {
        step1: {
          title: "",
          lieu: "",
          zone: "",
          secteur: "",
        },
        step2: {
          description: "",
          exigences: "",
        },
        step3: {
          date_limite: "",
          date_deb: "",
          type: "",
          duree: "",
          salaire: "",
          horaire: "",
          urgence: "",
        },
      },
      type: {
        title: "",
        lieu: "",
        type: "",
        zone: "",
        secteur: "",
        //fonction: "",
        //responsabilite: "",
        description: "",
        exigences: "",

        // disponiblite: "",
        date_limite: "",
        date_deb: "",
        type: "",
        nbr: "",
        // frequence: "",
        // nbrfrequence: "",
        duree: "",
        salaire: "",
        horaire: "",
        urgence: "",
      },
      messageTitle: "",
      typeTitle: "",
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

      tags: [
        { id: 1, text: "Horaires flexibles", checked: false },
        { id: 2, text: "Travail en journée", checked: false },
        { id: 3, text: "Du lundi au vendredi", checked: false },
        { id: 4, text: "Disponible le week-end", checked: false },
        { id: 5, text: "Tous les week-end", checked: false },
        { id: 6, text: "Horaires aménageables", checked: false },
      ],
      editorSettings: {
        modules: {
          imageDrop: true,
          imageResize: {},
        },
      },
      isLoading: false,
      secteurs: [
        { name: "Informatique,Telecom,Internet" },
        { name: "Energie, Mines, Matière première" },
        { name: "Banque, Assurance, Finance" },
      ],
      lieux: [{ name: "Télétravail" }, { name: "En personne(lieu précis)" }],

      fonctions: [
        { name: "Création/Design" },
        { name: "Administration réseau" },
        { name: "Sécurité réseaux" },
        { name: "Désigner web" },
        { name: "Développeur d'application mobile" },
      ],
      erreur: false,
      errors: {},
      tags: [
        { id: 1, text: "Horaires flexibles", checked: false },
        { id: 2, text: "Travail en journée", checked: false },
        { id: 3, text: "Du lundi au vendredi", checked: false },
        { id: 4, text: "Disponible le week-end", checked: false },
        { id: 5, text: "Tous les week-end", checked: false },
        { id: 6, text: "Horaires aménageables", checked: false },
      ],
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

        [{ list: "ordered" }, { list: "bullet" }],

        [{ color: [] }, { background: [] }],

        [{ direction: "rtl" }],
        ["clean"],
      ],
    };
  },

  methods: {
    messagesTexts(step, field) {
      let message = "";
      switch (field) {
        case "title":
          message = "Veuillez renseigner l'intitulé du poste";
          break;
        case "poste":
          message = "Veuillez renseigner le titre du poste";
          break;
        case "company_name":
          message = "Veuillez renseigner la structure";
          break;
        case "date_deb":
          message = "Veuillez renseigner la date de début";
          break;
        case "date_fin":
          message = "Veuillez renseigner la date de fin";
          break;
        case "intitution":
          message = "Veuillez renseigner le nom del'institution de la formation";
          break;
        case "type":
          message = "Veuillez renseigner le type deformation";
          break;
        case "diplome":
          if (this.offre.type.value == "universitaire")
            message = "Veuillez renseigner le diplome";
          break;
        case "theme":
          if (this.offre.type.value == "specifique")
            message = "Veuillez renseigner le theme de la formation";
          break;
        case "name_langue":
          message = "Veuillez renseigner la compétence";
          break;
        /* case "lieu":
            message = "Veuillez renseigner le type de lieu";
            break;*/
        case "zone":
          if (this.offre.preferences["lieu"] != null) {
            if (this.offre.preferences["lieu"] == "En personne(lieu précis)") {
              message = "Veuillez renseigner l'adresse du lieu";
            }
          }
          //  message = "Veuillez renseigner le type de lieu";
          break;
        /*  default:
            message = "Veuillez renseigner la langue";
            break;*/
      }
      return message;
    },
    verifBasic(value, step, field) {
      if (value == null) {
        this.type[field] = "is-danger";
        this.message[step][field] = this.messagesTexts(step, field);
      } else if (value.length == 0) {
        this.type[field] = "is-danger";
        this.message[step][field] = this.messagesTexts(step, field);
      } else {
        this.type[field] = "is-success";
        this.message[step][field] = "";
        // this.removeError(field);
      }
    },
    valide(value, step, field) {
      this.offre[field].value = value;
      this.verifBasic(value, step, field);
      if (field == "date_deb") {
        console.log("edate_deb");
      }
    },
  },
};
</script>

<style scoped></style>
