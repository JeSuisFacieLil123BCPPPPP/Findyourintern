<template>
  <div>
    <div style="">
      <div style="background: #ffffff" class="p-3 d-flex flex-row align-items-center">
        <!--<a-row class="w-100">
          <a-col
            :xs="{ offset: 1, span: 22, offset: 1 }"
            :lg="{ offset: 1, span: 10, offset: 1 }"
          >
            <b-field label="Métier, domaine ou filière" class="">
              <b-input name="name" placeholder="" expanded></b-input>
            </b-field>
          </a-col>
          <a-col
            :xs="{ offset: 1, span: 22, offset: 1 }"
            :lg="{ offset: 1, span: 10, offset: 1 }"
          >
            <b-field label="Location" class="">
              <b-input name="name" placeholder="location" expanded></b-input>
            </b-field>
          </a-col>
        </a-row>-->
      </div>

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
                        Profil et visibilité
                      </span>
                      <div class="text-right">
                        <b-switch> </b-switch>
                      </div>
                    </div>
                  </v-sheet>

                  <div class="p-4 label" style="font-weight: normal; font-size: 16px">
                    Augmentez vos chances de trouver un nouvel emploi en permettant aux
                    recruteurs de vous trouver par votre profil et votre CV.
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
                        Mes données personnelles
                      </span>
                      <div class="text-right">
                        <v-btn class="mx-2" fab dark small outlined color="#24855a">
                          <v-icon dark> mdi-pencil </v-icon>
                        </v-btn>

                        <!--<v-btn color="#24855a" elevation="0" outlined>
                        <span class="" style="color: #24855a"> Editer </span>
                        <v-icon right light color="#24855a"> mdi-pencil </v-icon>
                      </v-btn>-->
                      </div>
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
                      <div class="text-right">
                        <v-btn
                          @click="showModal('infosSupp')"
                          color="#24855a"
                          elevation="0"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-pencil </v-icon>
                        </v-btn>

                        <dialog-modifier
                          v-if="initVisible.infosSupp"
                          @handle-cancel="handleCancel"
                          @add-update-infos-supp="addUpdateInfosSupp"
                          section="infosSupp"
                          action="update"
                          :obj="{
                            infosSupp: {
                              ...user.user.infosSupp,
                              ...{
                                pays: '',
                                ville: '',
                                date_nais: '',
                                decla_pers: '',
                                genre: '',
                              },
                            },
                          }"
                          :initVisible="initVisible.infosSupp"
                        >
                        </dialog-modifier>
                      </div>
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

                    <template v-slot:actions>
                      <div v-if="!user.user.infosSupp || !user.user.infosSupp.pays">
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('infosSupp')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
                    </template>
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

                    <template v-slot:actions>
                      <div v-if="!user.user.infosSupp || !user.user.infosSupp.ville">
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('infosSupp')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
                    </template>
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

                    <template v-slot:actions>
                      <div v-if="!user.user.infosSupp || !user.user.infosSupp.date_nais">
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('infosSupp')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
                    </template>
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

                    <template v-slot:actions>
                      <div v-if="!user.user.infosSupp || !user.user.infosSupp.genre">
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('infosSupp')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
                    </template>
                  </v-banner>
                  <v-banner class="mx-3">
                    <span
                      style="color: #0f151a; font-weight: bold; font-size: 16px"
                      class="label"
                    >
                      Déclaration personnelle
                    </span>
                    <a-divider></a-divider>

                    <span v-if="user.user.infosSupp && user.user.infosSupp.decla_pers">
                      <v-card-text class="subtitle-1 font-weight-normal">
                        "{{ user.user.infosSupp.decla_pers }}"
                      </v-card-text></span
                    >

                    <template v-slot:actions>
                      <div v-if="!user.user.infosSupp || !user.user.infosSupp.decla_pers">
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('infosSupp')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
                    </template>
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
                      <div class="text-right">
                        <v-btn
                          @click="confirmUpdateCV"
                          class="mx-2"
                          elevation="1"
                          fab
                          dark
                          small
                          outlined
                          color="#24855a"
                        >
                          <v-icon dark> mdi-pencil </v-icon>
                        </v-btn>
                        <modal-update-cv
                          :initVisible="updateCV"
                          :obj="user"
                          :etat="user.user.cv ? 1 : 2"
                          v-if="updateCV == true"
                        >
                        </modal-update-cv>
                        <!--<v-btn color="#24855a" elevation="0" outlined>
                        <span class="" style="color: #24855a">Modifier</span>
                        <v-icon right light color="#24855a"> mdi-pencil </v-icon>
                      </v-btn>-->
                      </div>
                    </div>
                  </v-sheet>

                  <div class="p-4 label" style="font-weight: normal; font-size: 16px">
                    Augmentez vos chances de trouver un nouvel emploi en permettant aux
                    recruteurs de vous trouver par votre profil et votre CV.
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
                        Préferences de stages ou d'emplois
                      </span>
                      <div class="text-right">
                        <v-btn
                          @click="showModal('preferences')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon dark> mdi-pencil </v-icon>
                        </v-btn>

                        <dialog-modifier
                          @handle-cancel="handleCancel"
                          section="preferences"
                          :initVisible="initVisible.preferences"
                          :obj="{
                            preferences: user.user.preferencesPoste,
                          }"
                          @update-preferences="updatePreferences"
                          action="update"
                          v-if="initVisible.preferences"
                        >
                        </dialog-modifier>
                      </div>
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
                      >
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('preferences')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
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
                      >
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('preferences')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
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

                    <template v-slot:actions>
                      <div
                        v-if="
                          !user.user.preferencesPoste ||
                          !user.user.preferencesPoste.secteurs
                        "
                      >
                        <span class="" style="color: #24855a">Ajouter</span>
                        <v-btn
                          @click="showModal('preferences')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon light color="#24855a"> mdi-plus </v-icon>
                        </v-btn>
                      </div>
                    </template>
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
                      <div class="text-right">
                        <dialog-modifier
                          @handle-cancel="handleCancel"
                          section="experiences"
                          :initVisible="initVisible.experiences"
                          v-if="initVisible.experiences"
                        >
                        </dialog-modifier>
                      </div>
                    </div>
                  </v-sheet>
                  <experience
                    v-for="exp in user.user.experiences"
                    :experience="exp"
                    :key="exp.id"
                    @update-experience="updateExperience"
                    @delete-experience="deleteExperience"
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
                    <div>
                      <v-btn
                        @click="showModal('experiences')"
                        color="#24855a"
                        elevation="0"
                        outlined
                      >
                        <span class="" style="color: #24855a"
                          >Ajouter une nouvelle expérience</span
                        >
                        <v-icon right light color="#24855a"> mdi-plus </v-icon>
                      </v-btn>

                      <dialog-modifier
                        @handle-cancel="handleCancel"
                        @add-experience="addExperience"
                        section="experiences"
                        :obj="{
                          experience: {
                            poste: '',
                            company_name: '',
                            date_deb: null,
                            date_fin: null,
                            description: '',
                            status: false,
                          },
                        }"
                        v-if="initVisible.experiences"
                        :initVisible="initVisible.experiences"
                      >
                      </dialog-modifier>
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
                        Formations
                      </span>
                      <div class="text-right">
                        <!-- <v-btn
                        @click="showModal('experiences')"
                        color="#24855a"
                        elevation="0"
                        outlined
                      >
                        <span class="" style="color: #24855a">Modifier</span>
                        <v-icon right light color="#24855a"> mdi-pencil </v-icon>
                      </v-btn>-->

                        <dialog-modifier
                          @handle-cancel="handleCancel"
                          section="formations"
                          :initVisible="initVisible.formations"
                          v-if="initVisible.formations"
                        >
                        </dialog-modifier>
                      </div>
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
                    <div>
                      <v-btn
                        @click="showModal('formations')"
                        color="#24855a"
                        elevation="0"
                        outlined
                      >
                        <span class="" style="color: #24855a"
                          >Ajouter une nouvelle formation</span
                        >
                        <v-icon right light color="#24855a"> mdi-plus </v-icon>
                      </v-btn>

                      <dialog-modifier
                        v-if="initVisible.formations"
                        @handle-cancel="handleCancel"
                        @add-formation="addFormation"
                        section="formations"
                        :obj="{
                          formation: {
                            institution: '',
                            date_deb: null,
                            date_fin: null,
                            status: false,
                            theme: '',
                            type: '',
                          },
                        }"
                        :initVisible="initVisible.formations"
                      >
                      </dialog-modifier>
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
                      class="p-3 d-flex flex-row justify-content-between align-items-center"
                    >
                      <span
                        style="color: #0f151a; font-weight: bold; font-size: 20px"
                        class="label"
                      >
                        Compétences
                      </span>
                      <div class="text-right">
                        <v-btn
                          @click="showModal('competences')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class=""
                          fab
                          dark
                          small
                        >
                          <v-icon dark> mdi-pencil </v-icon>
                        </v-btn>

                        <dialog-modifier
                          @handle-cancel="handleCancel"
                          @add-competence="addCompetence"
                          v-if="initVisible.competences"
                          section="competences"
                          :initVisible="initVisible.competences"
                          :obj="{
                            competences: user.user.competences,
                            competence: {
                              nameC: '',
                            },
                          }"
                        >
                        </dialog-modifier>
                      </div>
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
                      <div class="text-right">
                        <v-btn
                          @click="showModal('langues')"
                          color="#24855a"
                          elevation="1"
                          outlined
                          class="mx-2"
                          fab
                          dark
                          small
                        >
                          <v-icon dark> mdi-pencil </v-icon>
                        </v-btn>

                        <dialog-modifier
                          v-if="initVisible.langues"
                          @handle-cancel="handleCancel"
                          @add-update-langue="addUpdateLangue"
                          @delete-langue="deleteLangue"
                          section="langues"
                          :width="800"
                          :initVisible="initVisible.langues"
                          :obj="{
                            langues: [...user.user.langues],
                            /*competence: {
                            nameC: '',
                          },*/
                          }"
                          action="create"
                        >
                        </dialog-modifier>
                      </div>
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
    showModal(key) {
      for (const [cle, value] of Object.entries(this.initVisible)) {
        if (cle == key) {
          // console.log("key");
          this.initVisible[cle] = !this.initVisible[cle];
          console.log("key");
          console.log(cle);
          console.log("value");
          console.log(value);
          break;
        }
      }
      //this.initVisible = !this.initVisible;
    },
    /* handleOk(e) {
      this.ModalText = "The modal will be closed after two seconds";
      this.confirmLoading = true;
      setTimeout(() => {
        this.initVisible = false;
        this.confirmLoading = false;
      }, 2000);
    },*/
    handleCancel(key) {
      console.log("Clicked cancel button");
      for (const [cle, value] of Object.entries(this.initVisible)) {
        if (cle == key) {
          // console.log("key");
          this.initVisible[cle] = !this.initVisible[cle];
          console.log("key");
          console.log(cle);
          console.log("value");
          console.log(value);
          break;
        }
      }
      if ((key = "confirmcv")) {
        this.updateCV = false;
      }
    },
    changeSidebar(val) {
      alert(val);
    },
    addExperience(newExperience) {
      this.user.user.experiences.push(newExperience);
      console.log("new exp");
      console.log(newExperience);
    },
    updateExperience(updateExperience) {
      let ele = this.user.user.experiences.find((exp) => {
        return exp.id == updateExperience.id;
      });
      console.log("update index");
      console.log(ele);
    },
    deleteExperience(deleteExperience) {
      let index = this.user.user.experiences.findIndex((exp) => {
        return exp.id == deleteExperience.id;
      });

      this.user.user.experiences.splice(index, 1);
    },

    addFormation(newFormation) {
      this.user.user.formations.push(newFormation);
      console.log("new exp");
      console.log(newFormation);
    },
    updateFormation(updateFormation) {
      let ele = this.user.user.formations.find((exp) => {
        return exp.id == updateFormation.id;
      });
      console.log("update index");
      console.log(ele);
    },
    deleteFormation(deleteFormation) {
      let index = this.user.user.formations.findIndex((exp) => {
        return exp.id == deleteFormation.id;
      });

      this.user.user.formations.splice(index, 1);
    },
    addCompetence(newCompetence) {
      this.user.user.competences.push(newCompetence);
      console.log("new cmp");
      console.log(newCompetence);
    },
    deleteCompetence(comp) {
      const index = this.user.user.competences.findIndex((competence) => {
        return competence.id == comp.id;
      });
      this.user.user.competences.splice(index, 1);
    },
    deleteLangue(langue) {
      const index = this.user.user.langues.findIndex((lang) => {
        return lang.id == langue.id;
      });
      this.user.user.langues.splice(index, 1);
    },
    updatePreferences(preferences) {
      console.log("preferences");
      console.log(preferences);
      this.user.user.preferencesPoste = preferences;
    },
    async getUserById() {
      let user = null;
      await axios
        .get("/api/v1/users/show/" + this.userConnect.id)
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
    addUpdateInfosSupp(newInfosSupp) {
      this.user.user.infosSupp = newInfosSupp;
    },
    async getEntityById(entityId) {
      await axios
        .get("/api/v1/entities/" + entityId)
        .then((response) => {
          this.entity = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
      return entity;
    },
    async getFiliereById(filiereId) {
      await axios
        .get("/api/v1/filieres/" + filiereId)
        .then((response) => {
          console.log("reponse");
          this.filiere = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addUpdateLangue(langues) {
      console.log("add-update-langue");
      console.log(langues);
      this.user.user.langues = langues;
    },
    confirmUpdateCV() {
      this.updateCV = !this.updateCV;
      // if (this.user.user.cv) {
      /* this.$buefy.dialog.confirm({
        title: "Confirmation",
        message:
          "Vous aviez déjà un importé un CV le" +
          "" +
          ". Souhaitez-vous le mettre à jour ?",
        type: "is-bleue",
        hasIcon: true,
        icon: "information",
        iconPack: "mdi",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: () =>
          //this.updateCV = true;
          (this.updateCV = true),
        // alert("eeeeeeeeeeeeee");
      });*/
      //}
    },
  },
  /* async created() {
    await this.getUserById();
  },*/
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
