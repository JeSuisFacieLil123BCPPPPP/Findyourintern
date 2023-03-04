<template>
  <div>
    <div style="">
      <div
        style="background: #ffffff"
        class="p-3 d-flex flex-row align-items-center"
      ></div>

      <div v-if="user">
        <a-row class="">
          <a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 8 }"
            :xl="{ span: 8 }"
            :xs="{ span: 24 }"
          >
            <div class="d-flex flex-column">
              <a-card
                :bordered="false"
                style="min-height: 300px; background: transparent"
                class="d-flex flex-column"
              >
                <v-sheet elevation="2" rounded="lg" class="my-1">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Données personnelles
                      </span>
                    </div>
                  </v-sheet>

                  <div class="d-flex bd-highlight">
                    <div class="p-4 flex-grow-1 bd-highlight">
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        {{ user.user.firstname + " " + user.user.lastname }}
                      </span>
                      <span
                        style="color: #0f151a; font-weight: normal; font-size: 16px"
                        class="label"
                      >
                        {{ user.user.school_name || "UAC" }}
                      </span>
                      <span
                        v-if="user.user.entity"
                        style="color: #0f151a; font-weight: normal; font-size: 16px"
                        class="label"
                      >
                        {{ user.user.entity.name }}
                      </span>
                      <span
                        style="
                          color: #0f151a;
                          font-weight: bold;
                          font-size: 16px;
                          font-style: italic;
                        "
                        class="label"
                        v-if="user.user.filiere"
                      >
                        {{ user.user.filiere.name }}
                      </span>
                      <span
                        style="
                          color: #0f151a;
                          font-weight: normal;
                          font-size: 16px;
                          font-style: italic;
                        "
                        class="label"
                      >
                        <v-icon v-text="'mdi-email'"></v-icon>

                        <a :href="`mailto:${user.email}`" class="text-black">
                          {{ user.email }}
                        </a>
                      </span>
                    </div>

                    <div class="p-2 bd-highlight">
                      <vs-avatar
                        size="70px"
                        style="font-size: 30px; font-weight: bold"
                        color="#24855a"
                        :text="user.user.firstname + ' ' + user.user.lastname"
                      />
                    </div>
                  </div>
                </v-sheet>

                <v-sheet elevation="2" rounded="lg" class="my-1">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Informations supplémentaires
                      </span>
                    </div>
                  </v-sheet>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Pays
                    </span>
                    <span v-if="user.user.infosSupp && user.user.infosSupp.pays">
                      {{ user.user.infosSupp.pays }}</span
                    >
                  </v-banner>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Ville
                    </span>

                    <span v-if="user.user.infosSupp && user.user.infosSupp.ville">
                      {{ user.user.infosSupp.ville }}</span
                    >
                  </v-banner>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Date de naissance
                    </span>

                    <span v-if="user.user.infosSupp && user.user.infosSupp.date_nais">
                      {{ user.user.infosSupp.date_nais }}</span
                    >
                  </v-banner>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Genre
                    </span>

                    <span v-if="user.user.infosSupp && user.user.infosSupp.genre">
                      {{
                        user.user.infosSupp.genre == "feminin" ? "Féminin" : "Masculin"
                      }}</span
                    >
                  </v-banner>
                  <v-banner
                    class="mx-3"
                    v-if="user.user.infosSupp && user.user.infosSupp.decla_pers"
                  >
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Déclaration personnelle
                    </span>
                    <a-divider></a-divider>

                    <span>
                      <v-card-text class="subtitle-1 font-weight-normal">
                        "{{ user.user.infosSupp.decla_pers }}"
                      </v-card-text></span
                    >
                  </v-banner>
                </v-sheet>
              </a-card>
            </div>
          </a-col>
          <a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 16 }"
            :xl="{ span: 16 }"
            :xs="{ span: 24 }"
          >
            <div class="">
              <a-card style="background: transparent" :bordered="false">
                <v-sheet elevation="2" rounded="lg" class="">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        CV
                      </span>
                      <div class="text-right"></div>
                    </div>
                  </v-sheet>
                </v-sheet>
                <v-sheet elevation="2" rounded="lg" class="my-2">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Préferences de stages ou d'emplois
                      </span>
                      <div class="text-right"></div>
                    </div>
                  </v-sheet>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Type de lieu
                    </span>
                    <span
                      v-if="user.user.preferencesPoste && user.user.preferencesPoste.lieu"
                    >
                      {{ user.user.preferencesPoste.lieu }}</span
                    >

                    <template v-slot:actions>
                      <div
                        v-if="
                          !user.user.preferencesPoste || !user.user.preferencesPoste.lieu
                        "
                      ></div>
                    </template>
                  </v-banner>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Lieu
                    </span>
                    <span
                      v-if="user.user.preferencesPoste && user.user.preferencesPoste.zone"
                    >
                      {{ user.user.preferencesPoste.zone }}</span
                    >

                    <template v-slot:actions>
                      <div
                        v-if="
                          !user.user.preferencesPoste || !user.user.preferencesPoste.zone
                        "
                      ></div>
                    </template>
                  </v-banner>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Secteur d'activité préféré
                    </span>
                    <span
                      v-if="
                        user.user.preferencesPoste && user.user.preferencesPoste.secteurs
                      "
                    >
                      {{ user.user.preferencesPoste.secteurs }}</span
                    >
                  </v-banner>
                </v-sheet>
                <v-sheet elevation="2" rounded="lg" class="my-2">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Expériences
                      </span>
                    </div>
                  </v-sheet>
                  <experience
                    v-for="exp in user.user.experiences"
                    :experience="exp"
                    :key="exp.id"
                  ></experience>
                  <b-notification
                    type="is-info is-light"
                    has-icon
                    v-if="user.user.experiences.length == 0"
                    :closable="false"
                  >
                    <b-field label=" Aucune expérience ajoutée pour le moment"></b-field>
                  </b-notification>
                  <v-sheet
                    class="d-flex flex-row justify-content-end align-items-center card-footer"
                  >
                  </v-sheet>
                </v-sheet>
                <v-sheet elevation="2" rounded="lg" class="my-2">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Formations
                      </span>
                      <div class="text-right"></div>
                    </div>
                  </v-sheet>
                  <formation
                    v-for="form in user.user.formations"
                    :formation="form"
                    :key="form.id"
                    class="p-2"
                    @update-formation="updateFormation"
                    @delete-formation="deleteFormation"
                  ></formation>
                  <b-notification
                    type="is-info is-light"
                    has-icon
                    v-if="user.user.formations.length == 0"
                    :closable="false"
                  >
                    <b-field label=" Aucune formation ajoutée pour le moment"></b-field>
                  </b-notification>
                  <v-sheet
                    class="d-flex flex-row justify-content-end align-items-center card-footer"
                  >
                    <div></div>
                  </v-sheet>
                </v-sheet>

                <v-sheet elevation="2" rounded="lg" class="my-2">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="p-3 d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Compétences
                      </span>
                    </div>
                  </v-sheet>
                  <div style="min-height: 50px" class="m-3">
                    <competences
                      :closable="false"
                      :competences="user.user.competences"
                      @delete-competence="deleteCompetence"
                    >
                    </competences>
                    <b-notification
                      type="is-info is-light"
                      has-icon
                      v-if="user.user.competences.length == 0"
                      :closable="false"
                    >
                      <b-field
                        label=" Aucune compétence ajoutée pour le moment"
                      ></b-field>
                    </b-notification>
                  </div>
                </v-sheet>
                <v-sheet elevation="2" rounded="lg" class="my-2">
                  <v-sheet
                    class="pa-3"
                    rounded="t-lg"
                    :outlined="true"
                    style="
                      border-bottom-style: solid;
                      border-bottom-width: 1px;
                      border-bottom-color: #cecece;
                    "
                  >
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Langues
                      </span>
                    </div>
                  </v-sheet>
                  <div style="min-height: 50px" class="m-3">
                    <langues :closable="false" :langues="user.user.langues"> </langues>
                  </div>
                </v-sheet>
              </a-card>
            </div>
          </a-col>
        </a-row>
      </div>
      <div v-else style="margin-top: 22px">
        <b-skeleton
          size="is-large"
          style="height: 50%; width: 50%"
          :active="true"
        ></b-skeleton>
        <b-skeleton
          size="is-large"
          style="height: 50%; width: 50%"
          :active="true"
        ></b-skeleton>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import dialogModifier from "./DialogModifier.vue";
import experience from "./Experience.vue";
import formation from "./Formation.vue";
import competences from "./Competences.vue";
import langues from "./Langues.vue";
import modalUpdateCv from "./ModalUpdateCV.vue";
export default {
  components: {
    dialogModifier,
    experience,
    formation,
    competences,
    langues,
    modalUpdateCv,
  },
  props: ["userId"],
  computed: {
    ...mapGetters({
      userConnect: "auth/getUser",
    }),
  },
  data() {
    return {
      user: null,
      entity: null,
      filiere: null,
      dialog: false,
      ModalText: "Content of the modal",
      initVisible: {
        preferences: false,
        experiences: false,
        formations: false,
        competences: false,
        langues: false,
        infosSupp: false,
      },
      confirmLoading: false,
      updateCV: false,
    };
  },
  methods: {
    async getUserById() {
      let user = null;
      await axios
        .get("/api/v1/users/show/" + this.userId)
        .then((response) => {
          console.log("response");
          console.log(response.data);
          user = response.data.user;
        })
        .catch((error) => {
          console.log(error.message);
        });
      return user;
    },
  },

  async created() {
    //this.getEntityById(this.user.user.entity_id);
    // this.getFiliereById(this.user.user.filiere_id);
    //this.getUserById();
    this.user = await this.getUserById();
    console.log("user");
    console.log(this.user);
  },
};
</script>
<style lang="scss" scoped></style>
