<template>
  <div>
    <a-modal
      :visible="visible"
      @cancel="handleCancel"
      centered
      :footer="null"
      v-if="etat1 == 1"
    >
      <div>
        <p class="text-center title-1">Mis à jour de ton CV</p>
        <p>
          Nous avon remarqué que tu as ajouté un CV le {{ userInfos.user.cv.created_at }}.
          Voudrais -tu le changer ?Si c,'est le cas, le CV actuel sera remplacé par le
          nouveau de tu définiras
        </p>
        <div>
          <b-button @click="handleCancel">Annueler</b-button>
          <b-button type="is-bleue" @click="etat1 == 2">Continuer</b-button>
        </div>
      </div>
    </a-modal>
    <a-modal
      :visible="visible"
      @cancel="handleCancel"
      centered
      v-if="etat1 == 2"
      :width="700"
      :footer="null"
    >
      <template slot="title"> </template>
      <div class="p-3">
        <p class="text-left title-1 my-2 row">Mis à jour de ton CV</p>
        <div class="row my-2">
          <VueFileAgent
            ref="cv"
            :multiple="false"
            :deletable="true"
            :meta="true"
            :accept="'.docx, .doc, .pdf,.txt,.odt,.rtf.'"
            :maxSize="'2.5MB'"
            :helpText="'Importer ton CV \n Pas plus de 2.5 Mo'"
            :errorText="{
              type: 'Le type de l\'image est invalide',
              size: 'La taille du fichier ne doit pas dépasser 2.5Mo',
            }"
            @select="filesSelected($event, 'cv')"
            @beforedelete="onBeforeDelete($event, 'cv')"
            @delete="fileDeleted($event, 'cv', 'image')"
            @upload="retourUpload($event, 'cv')"
            @upload:error="retourError($event, 'cv')"
            v-model="records['cv']"
          >
          </VueFileAgent>
        </div>
        <div class="row my-2 ms-1">
          <v-btn
            :loading="loading['cv']"
            :disabled="loading['cv']"
            color="#24855a"
            style="color: white; width: 200px"
            class="white--text"
            @click="uploadFiles('cv', 'image', 'ressources/CV')"
          >
            Importer {{ recordsForUpload["cv"].length }} fichier
            <v-icon right dark> mdi-cloud-upload </v-icon>
          </v-btn>
        </div>
        <p class="text-left title-1 my-2 row">Créeer ton CV</p>
        <div class="row">
          <div class="col-sm-6 order-1 order-sm-1 col-12">
            <div class="label-text">
              Tu ne sais pas par où commencer ? Nous pouvons t'aider à creer un CV en
              quelques minutes
            </div>
          </div>
          <div class="col-sm-6 order-2 order-sm-3 col-12">
            <b-button
              class="w-100"
              type="is-bleue"
              @click="createCV"
              outlined
              style="height: 50px"
            >
              <span class="label-text">Créer ton CV</span>
            </b-button>
          </div>
          <div class="col-sm-6 order-3 order-sm-2 col-12">
            <div class="label-text">
              Tu préfère le faire toi-meme? Télécharge un template word gratuit
            </div>
          </div>
          <div class="col-sm-6 order-4 order-sm-4">
            <b-button class="w-100" type="is-bleue" outlined style="height: 50px">
              <span class="label-text">Télécharger ton CV</span></b-button
            >
          </div>
        </div>
        <div class="row label-text">
          <p class="">Une autre alternative serait d'utiliser ton profil LinkedIn</p>
          <ol class="list-group list-group-numbered label-text ms-2">
            <li class="mx-2">
              Visite&nbsp;<a
                href="https://www.linkedin.com"
                rel="noopener noreferrer"
                target="_blank"
                >LinkedIn</a
              >&nbsp;dansun nouvel onglet
            </li>
            <li class="mx-2">Voir ton profil</li>
            <li class="mx-2">
              Cliquez sur le bouton Plus et sélectionnez Enregistrer au format PDF
            </li>
            <li class="mx-2">
              Enregistrez le PDF sur votre appareil et revenez pour le télécharger
            </li>
          </ol>
        </div>
      </div>
    </a-modal>
  </div>
</template>
<script>
import uplodFile from "../../mixin/uplodFile";
export default {
  mixins: [uplodFile],
  props: ["initVisible", "etat", "obj"],
  data() {
    return {
      userInfos: { ...this.obj },
      visible: this.initVisible,
      confirmLoading: false,
      etat1: this.etat,
      records: {
        cv: [],
      },
      toStore: {
        cv: [],
      },
      recordsForUpload: {
        cv: [],
      },
      loading: {
        cv: false,
      },
    };
  },
  methods: {
    createCV() {
      console.log("userinfos");
      console.log(this.userInfos);
      this.$router.push({
        path: "/student/myprofile/createcv/" + this.userInfos.id,
        /*params: {
          userId: this.userInfos.id,
        },*/
      });
    },
    handleOk(e) {
      // this.confirmLoading = true;
      /* setTimeout(() => {
        this.visible = false;
        this.confirmLoading = false;
      }, 2000);*/
      //this.$emit("handle-cancel", this.section);
    },
    handleCancel(e) {
      console.log("Clicked cancel button");
      this.visible = false;
      this.$emit("handle-cancel", "confirmcv");
    },
  },
  mounted() {
    console.log("userinfos");
    console.log(this.userInfos);
  },
};
</script>
<style scoped>
.title-1 {
  font-weight: bolder !important;
  font-size: 20px !important;
}
.label-text {
  font-family: BlinkMacSystemFont, -apple-system, Segoe UI, Roboto, Oxygen, Ubuntu,
    Cantarell, Fira Sans, Droid Sans, Helvetica Neue, Helvetica, Arial, sans-serif !important;
  font-size: 1rem;
}
.btn-1 :hover {
  background: #87fabf !important;
}
</style>
