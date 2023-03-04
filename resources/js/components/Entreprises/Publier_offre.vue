<template>
  <div class="w-100">
    <div class="d-flex flex-column">
      <v-row>
        <v-col cols="12">
          <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
            <div class="d-flex flex-row justify-content-between">
              <p
                class="font-weight-black text-h1 text-center"
                style="color: black; opacity: 1; vertical-align: middle"
              >
                <b-field>
                  <template #label>
                    <span style="font-size: 40px" class="font-weight-black text-h4"
                      >Informations de base</span
                    >
                  </template>
                </b-field>
              </p>
              <publier-offre-1 width="200px" height="100px"></publier-offre-1>
            </div>
          </a-card>
        </v-col>
        <v-col cols="12">
          <a-card
            :loading="isLoading"
            class="mx-2 my-5 elevation_0 my-card_1"
            style="border-radius: 12px"
          >
            <v-stepper
              v-model="e1"
              :non-linear="true"
              class="vert"
              style="background: #f0f2f5"
            >
              <v-stepper-header>
                <v-stepper-step step="1" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label> Informations de base</template>
                  </b-field></v-stepper-step
                >

                <v-divider></v-divider>

                <v-stepper-step step="2" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label> Decriptions </template>
                  </b-field></v-stepper-step
                >

                <v-divider></v-divider>
                <v-stepper-step step="3" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label>Détails </template>
                  </b-field></v-stepper-step
                >
                <v-divider></v-divider>
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
                        <b-field
                          custom-class="is-medium"
                          :message="message.title"
                          class="form-label"
                          :type="type.title"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px">Intitulé du poste</span>
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit de l'intitulé du poste et il apparaitra comme le titre de l'offre"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                          <b-input
                            type="text"
                            size="is-medium"
                            :value="offre.title"
                            @input="valideTitle"
                          >
                          </b-input>
                        </b-field>
                      </a-card>

                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field
                          custom-class="is-medium"
                          :message="message.lieu"
                          class="form-label"
                          :type="type.lieu"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Parmi ces options, laquelle décrit le mieux le lieu de
                              travail de ce poste ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit du  mode de travail"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                          <b-select
                            size="is-medium"
                            placeholder=""
                            @input="valideLieu"
                            :valeur="offre.lieu"
                            expanded
                          >
                            <option
                              :value="lieu.name"
                              v-for="(lieu, index) in lieux"
                              :key="index"
                            >
                              {{ lieu.name }}
                            </option>
                          </b-select>
                        </b-field>

                        <b-field
                          custom-class="is-medium"
                          :message="message.zone"
                          class="form-label"
                          :type="type.zone"
                          expanded
                          v-if="offre.lieu == 'En personne(lieu précis)'"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Quelle est l'adresse postale de ce lieu ?</span
                            >
                          </template>
                          <b-input
                            type="text"
                            size="is-medium"
                            :value="offre.zone"
                            @input="valideZone"
                          >
                          </b-input>
                        </b-field>
                        <vs-alert
                          class="my-2"
                          v-if="offre.lieu == 'Télétravail'"
                          closable
                          close-icon="cancel"
                          icon="info"
                        >
                          Nous indiquerons « Télétravail » comme lieu du poste et nous le
                          promouverons auprès de personnes à la recherche de travail à
                          distance au sein du pays.
                        </vs-alert>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field
                          expanded
                          custom-class="is-medium"
                          :message="message.secteur"
                          class="form-label"
                          :type="type.secteur"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px">Secteur d'activité</span>
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit du titre de votre réalisation/projet"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>

                          <b-select
                            size="is-medium"
                            placeholder="Secteur d'activité"
                            @input="valideSecteur"
                            :valeur="offre.secteur"
                            expanded
                          >
                            <option
                              :value="secteur.name"
                              v-for="(secteur, index) in secteurs"
                              :key="index"
                            >
                              {{ secteur.name }}
                            </option>
                          </b-select>
                        </b-field>
                      </a-card>
                      <!-- <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field
                          custom-class="is-medium"
                          :message="message.title"
                          class="form-label"
                          :type="type.title"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Quelle sont les langes obligatoires à parler ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit de l'intitulé du poste et il apparaitra comme le titre de l'offre"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>

                          <b-input
                            type="text"
                            size="is-medium"
                            :value="offre.title"
                            @input="valideTitle"
                          >
                          </b-input>
                        </b-field>
                      </a-card>-->
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          @click="e1 = 2"
                          style="background: #24855a; color: white"
                        >
                          Continuer
                        </b-button></a-card
                      >
                      <!--<a-card>
                        <b-field grouped>
                          <b-field
                            custom-class="is-medium"
                            :message="message.type"
                            :type="type.type"
                            expanded
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Type de l'offre</span>
                              <b-tooltip
                                position="is-right"
                                type="is-bleue"
                                label="Il s'agit du titre de votre réalisation/projet"
                              >
                                <v-icon small style="color: #24855a"
                                  >mdi-information
                                </v-icon>
                              </b-tooltip>
                            </template>
                            <b-select
                              size="is-medium"
                              placeholder="Type"
                              @input="valideType"
                              :value="offre.type"
                              expanded
                            >
                              <option value="Stage académique">Stage académique</option>
                              <option value="Stage profesionnel">
                                Stage profesionnel
                              </option>
                              <option value="Emploi">Emploi</option>
                            </b-select>
                          </b-field>
                          <b-field
                            custom-class="is-medium"
                            :message="message.date_limite"
                            class="form-label"
                            :type="type.date_limite"
                            expanded
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Date limite de l'offre</span>
                              <b-tooltip
                                position="is-right"
                                type="is-bleue"
                                label="Il s'agit du titre de votre réalisation/projet"
                              >
                                <v-icon small style="color: #24855a"
                                  >mdi-information
                                </v-icon>
                              </b-tooltip>
                            </template>
                            <b-datepicker
                              style="margin-top: 0px"
                              :min-date="new Date()"
                              ref="datepicker"
                              expanded
                              placeholder="Sélectionnez une date"
                              @input="valideDateLimite"
                              :value="offre.date_limite"
                              size="is-medium"
                            >
                            </b-datepicker>
                            <b-button
                              class="h-100"
                              @click="$refs.datepicker.toggle()"
                              icon-left="calendar-today"
                              type="is-bleue"
                            />
                          </b-field>
                        </b-field>
                        <b-field grouped>
                          <b-field
                            expanded
                            custom-class="is-medium"
                            :message="message.secteur"
                            class="form-label"
                            :type="type.secteur"
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Secteur d'activité</span>
                              <b-tooltip
                                position="is-right"
                                type="is-bleue"
                                label="Il s'agit du titre de votre réalisation/projet"
                              >
                                <v-icon small style="color: #24855a"
                                  >mdi-information
                                </v-icon>
                              </b-tooltip>
                            </template>

                            <b-select
                              size="is-medium"
                              placeholder="Secteur d'activité"
                              @input="valideSecteur"
                              :valeur="offre.secteur"
                              expanded
                            >
                              <option
                                :value="secteur.name"
                                v-for="(secteur, index) in secteurs"
                                :key="index"
                              >
                                {{ secteur.name }}
                              </option>
                            </b-select>
                          </b-field>
                          <b-field
                            size="is-medium"
                            custom-class="is-medium"
                            :message="message.fonction"
                            class="form-label"
                            :type="type.fonction"
                            expanded
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Fonctions</span>
                              <b-tooltip
                                position="is-right"
                                type="is-bleue"
                                label="Il s'agit du titre de votre réalisation/projet"
                              >
                                <v-icon small style="color: #24855a"
                                  >mdi-information
                                </v-icon>
                              </b-tooltip>
                            </template>

                            <b-select
                              size="is-medium"
                              placeholder="Fonction"
                              @input="valideFonction"
                              :value="offre.fonction"
                              expanded
                            >
                              <option
                                :value="fonction.name"
                                v-for="(fonction, index) in fonctions"
                                :key="index"
                              >
                                {{ fonction.name }}
                              </option>
                            </b-select>
                          </b-field>
                        </b-field>
                        <b-field grouped>
                          <b-field
                            custom-class="is-medium"
                            :message="message.zone"
                            class="form-label"
                            :type="type.zone"
                            expanded
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Zone géographique</span>
                            </template>
                            <b-input
                              type="text"
                              size="is-medium"
                              :value="offre.zone"
                              @input="valideZone"
                            >
                            </b-input>
                          </b-field>
                          <b-field
                            custom-class="is-medium"
                            :message="message.disponibilite"
                            class="form-label"
                            :type="type.disponibilite"
                            expanded
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Disponibilité</span>
                            </template>
                            <b-select
                              expanded
                              size="is-medium"
                              placeholder="Disponibilité"
                              @input="valideDisponibilite"
                              :value="offre.disponibilite"
                            >
                              <option value="Mi-temps">Mi-temps</option>
                              <option value="Stage profesionnel">Temps partiel</option>
                              <option value="Emploi">Temps plein</option>
                            </b-select>
                          </b-field>
                          <b-field
                            custom-class="is-medium"
                            :message="message.nbr"
                            class="form-label"
                            :type="type.nbr"
                            expanded
                          >
                            <template #label>
                              <span style="color: red">* </span
                              ><span style="font-size: 16px">Nombre recherché</span>
                            </template>
                            <b-numberinput
                              expanded
                              size="is-medium"
                              step="1"
                              exponential
                              @input="valideNbr"
                              :value="offre.nbr"
                              style="color: green"
                              type="is-bleue"
                            >
                            </b-numberinput>
                          </b-field>
                        </b-field>
                      </a-card>-->
                    </a-col>
                  </a-row>
                </v-stepper-content>

                <v-stepper-content step="2">
                  <a-row>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 3, span: 18, offset: 3 }"
                      :xl="{ offset: 3, span: 18, offset: 3 }"
                      :xs="{ span: 24 }"
                    >
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <template slot="title">
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
                                      >Descriptions de l'offre</span
                                    >
                                  </template>
                                </b-field>
                              </p>
                              <description-1 width="200px" height="100px"></description-1>
                            </div>
                          </a-card>
                        </template>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <template slot="title">
                          <b-field custom-class="is-medium" class="form-label">
                            <template #label>
                              <span style="color: red">* </span>Description de l'offre
                              <b-tooltip
                                position="is-right"
                                label="C'est la description du projet/réalisation. Vous devez décrire le projet de façon détaillée"
                                size="is-medium"
                                type="is-bleue"
                                multilined
                              >
                                <v-icon small style="color: #24855a"
                                  >mdi-information
                                </v-icon>
                              </b-tooltip>
                            </template></b-field
                          >
                        </template>
                        <b-message
                          type=""
                          :closable="false"
                          aria-close-label="Close message"
                        >
                          Décrivez les responsabilités du poste, ainsi que d'autres
                          critères de sélection tels que l'expérience professionnelle, les
                          compétences et ou le niveau d'étude.
                          <span
                            >Vous avez la possibilité d'importer un document qui le
                            décrit</span
                          >
                        </b-message>

                        <vue-editor
                          class="w-100"
                          v-model="offre.description"
                          ref="editor"
                          placeholder="Description de l'offre"
                          :editorToolbar="customToolbar"
                          :editorOptions="editorSettings"
                        />
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <template slot="title">
                          <b-field custom-class="is-medium" class="form-label">
                            <template #label>
                              <span style="color: red"></span>Exigences du poste
                              <b-tooltip
                                position="is-right"
                                label="Exigences du poste"
                                size="is-medium"
                                type="is-bleue"
                                multilined
                              >
                                <v-icon small style="color: #24855a"
                                  >mdi-information
                                </v-icon>
                              </b-tooltip>
                            </template></b-field
                          >
                        </template>
                        <b-message
                          type=""
                          :closable="false"
                          aria-close-label="Close message"
                        >
                          Décrivez ici les exigences du poste comme la/les langue.s ,
                          l’âge ou bien d'autres critères exigés pour ce poste
                        </b-message>

                        <vue-editor
                          class="w-100"
                          v-model="offre.exigences"
                          ref="exigences"
                          placeholder="Ajouter les exigences de l'offre"
                          :editorToolbar="customToolbar"
                          :editorOptions="editorSettings"
                        />
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          style="background: #24855a; color: white"
                          @click="e1 = 3"
                        >
                          <span class="mon-texte"> Continuer</span></b-button
                        >
                        <b-button outlined @click="e1 = 1"
                          ><span class="mon-texte">Réculer</span></b-button
                        >
                      </a-card>
                    </a-col>
                  </a-row>
                </v-stepper-content>

                <v-stepper-content step="3">
                  <a-row>
                    <a-col
                      :sm="{ span: 24 }"
                      :md="{ span: 22, offset: 2 }"
                      :lg="{ offset: 3, span: 18, offset: 3 }"
                      :xl="{ offset: 3, span: 18, offset: 3 }"
                      :xs="{ span: 24 }"
                    >
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <template slot="title">
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
                                      >Ajouter des détails</span
                                    >
                                  </template>
                                </b-field>
                              </p>
                              <add-details-icon-1
                                width="200px"
                                height="100px"
                              ></add-details-icon-1>
                            </div>
                          </a-card>
                        </template>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field
                          custom-class="is-medium"
                          :message="message.type"
                          :type="type.type"
                          expanded
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >De quel type de poste s'agit-il ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit du type de poste de votre offre"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                          <b-select
                            size="is-medium"
                            placeholder="Type"
                            @input="valideType"
                            :value="offre.type"
                            expanded
                          >
                            <option value="Stage académique">Stage académique</option>
                            <option value="Stage profesionnel">Stage profesionnel</option>
                            <option value="Emploi">Emploi</option>
                          </b-select>
                        </b-field>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <span style="color: red"> </span
                            ><span style="font-size: 16px"
                              >Quelle est la durée du contrat ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit de la durée du contrat"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>

                          <b-field grouped>
                            <p class="control">
                              <b-numberinput
                                size="is-medium"
                                step="1"
                                :exponential="false"
                                @input="valideNbrTime"
                                :value="offre.nbrTime"
                                style="color: green"
                                type="is-bleue"
                              >
                              </b-numberinput>
                            </p>
                            <b-select
                              size="is-medium"
                              placeholder=""
                              @input="valideTime"
                              :value="offre.time"
                              :expanded="false"
                            >
                              <option value="Jour(s)">Jour(s)</option>
                              <option value="Semaine(s)">Semaine(s)</option>
                              <option value="Mois">Mois</option>
                              <option value="Année(s)">Année(s)</option>
                            </b-select>
                          </b-field>
                        </b-field>
                      </a-card>

                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Quels sont les horaires de ce poste ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit du type de poste de votre offre"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                          <div>
                            <v-chip
                              class="ma-2"
                              @click="chipClick(tag)"
                              v-for="tag in tags"
                              :key="tag.id"
                              :color="tag.checked == true ? '#24855a' : '#f0f2f5'"
                              :text-color="tag.checked == true ? 'white' : ''"
                            >
                              <v-icon v-if="tag.checked == true"
                                >mdi-checkbox-marked-circle</v-icon
                              >
                              <v-icon v-else>mdi-plus</v-icon>
                              {{ tag.text }}</v-chip
                            >
                          </div>
                        </b-field>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Il y a t-il une date de début prévu pour ce poste ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit du type de poste de votre offre"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                        </b-field>
                        <a-card>
                          <b-field>
                            <b-radio
                              v-model="radio"
                              type="is-bleue"
                              native-value="oui"
                              size="is-medium"
                            >
                              Oui
                            </b-radio>
                          </b-field>
                          <b-field>
                            <b-radio
                              v-model="radio"
                              type="is-bleue"
                              native-value="non"
                              size="is-medium"
                            >
                              Non
                            </b-radio>
                          </b-field>

                          <div v-if="radio == 'oui'">
                            <b-field
                              custom-class="is-medium"
                              :message="message.date_deb"
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
                          </div>
                        </a-card>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Il y a t-il une date de début prévu pour ce poste ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit du type de poste de votre offre"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                        </b-field>
                        <a-card>
                          <b-field>
                            <b-radio
                              v-model="radio1"
                              type="is-bleue"
                              native-value="oui"
                              size="is-medium"
                            >
                              Oui
                            </b-radio>
                          </b-field>
                          <b-field>
                            <b-radio
                              v-model="radio1"
                              type="is-bleue"
                              native-value="non"
                              size="is-medium"
                            >
                              Non
                            </b-radio>
                          </b-field>

                          <div v-if="radio1 == 'oui'">
                            <b-field
                              custom-class="is-medium"
                              :message="message.date_limite"
                              class="form-label"
                              :type="type.date_limite"
                              expanded
                            >
                              <b-datepicker
                                :min-date="new Date()"
                                ref="datepicker2"
                                expanded
                                placeholder="Sélectionnez une date"
                                @input="valideDateLimite"
                                :value="offre.date_limite"
                                size="is-medium"
                              >
                              </b-datepicker>
                              <b-button
                                class="h-100"
                                @click="$refs.datepicker2.toggle()"
                                icon-left="calendar-today"
                                type="is-bleue"
                              />
                            </b-field>
                          </div>
                        </a-card>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field
                          expanded
                          custom-class="is-medium"
                          :message="message.secteur"
                          class="form-label"
                          :type="type.secteur"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Combien de personnes souhaitez-vous recruter pour ce poste
                              ?
                            </span>
                            <p
                              class="control"
                              style="font-size: 14px; font-weight: normal; color: #8b8f93"
                            >
                              Si vous avez besoin de quelqu'un rapidement, vous aurez peut
                              être besoin d'une plus grande visibilité.
                            </p>
                          </template>
                          <div>
                            <b-select
                              size="is-medium"
                              placeholder="Nombre de personnes"
                              @input="valideSecteur"
                              :valeur="offre.secteur"
                              expanded
                            >
                              <option :value="9">9</option>
                              <option :value="18">18</option>
                              <option :value="50">50</option>
                              <option :value="100">100</option>
                            </b-select>
                          </div>
                        </b-field>
                        <b-field
                          expanded
                          custom-class="is-medium"
                          :message="message.secteur"
                          class="form-label"
                          :type="type.urgence"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Votre recrutement est-il urgent ?
                            </span>
                            <p
                              class="control"
                              style="font-size: 14px; font-weight: normal; color: #8b8f93"
                            >
                              Plus il y a de postes à pouvoir, plus vous avez besoin de
                              candidatures
                            </p>
                          </template>
                          <div>
                            <b-select
                              size="is-medium"
                              placeholder="Urgence du recrutement"
                              @input="valideUrgence"
                              :valeur="offre.urgence"
                              expanded
                            >
                              <option value="1">1 à 3jour</option>
                              <option value="2">1 à 2 semaines</option>
                              <option value="3">1 à 2 mois</option>
                              <option value="4">4 à 5mois</option>
                            </b-select>
                          </div>
                        </b-field>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field
                          expanded
                          custom-class="is-medium"
                          :message="message.salaire"
                          class="form-label"
                          :type="type.salaire"
                        >
                          <template #label>
                            <span style="color: red"></span
                            ><span style="font-size: 16px">Quel est le salaire ? </span>
                          </template>
                          <div>
                            <b-input
                              type="text"
                              size="is-medium"
                              :value="offre.salaire"
                              @input="valideSalaire"
                            >
                            </b-input>
                          </div>
                        </b-field>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          style="background: #24855a; color: white"
                          @click="submitForm"
                        >
                          <span class="mon-texte"> Soumettre</span></b-button
                        >
                        <b-button outlined @click="e1 = 2"
                          ><span class="mon-texte">Réculer</span></b-button
                        >
                      </a-card>
                    </a-col>
                  </a-row>
                </v-stepper-content>
              </v-stepper-items>
            </v-stepper>
            <b-message
              v-if="erreur"
              title="Danger"
              type="is-danger"
              aria-close-label="Close message"
              is-bottom-right
            >
              Il y a des champs obligatoires qui sont vides
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
import infosBase1 from "../Icons/infos-base-1.vue";
import description1 from "../Icons/description-1.vue";
import addDetailsIcon1 from "../Icons/add-details-icon-1.vue";
Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
export default {
  components: { infosBase1, description1, addDetailsIcon1 },
  name: "App",
  //user_id,title,description,metier,experience,localisation
  data() {
    ////titre,type,secteur,fonction,responsabilité,exigences, zone,disponiblité,date_limite,
    return {
      e1: 1,
      formData1: new FormData(),
      radio: "",
      radio1: "",
      offre: {
        title: "",
        type: "",
        lieu: "",
        secteur: "",
        fonction: "",
        responsabilite: "",
        exigences: "",
        zone: "",
        disponiblite: "",
        date_limite: "",
        date_deb: "",
        nbr: 0,
        time: "Jour(s)",
        nbrTime: 0,
        duree: "",
        salaire: "",
        horaires: [],
      },
      message: {
        title: "",
        lieu: "",
        type: "",
        secteur: "",
        fonction: "",
        responsabilite: "",
        exigences: "",
        zone: "",
        disponiblite: "",
        date_limite: "",
        date_deb: "",
        salaire: "",
        nbr: "",
      },
      type: {
        title: "",
        lieu: "",
        type: "",
        secteur: "",
        fonction: "",
        responsabilite: "",
        exigences: "",
        zone: "",
        disponiblite: "",
        date_limite: "",
        date_deb: "",
        salaire: "",
        nbr: "",
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
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },

  methods: {
    chipClick(tag) {
      tag.checked = !tag.checked;

      if (tag.checked == true) {
        this.offre.horaires.push(tag.text);
      } else if (tag.checked == false) {
        var index = this.offre.horaires.indexOf(tag.text);

        if (index > -1) {
          this.offre.horaires.splice(index, 1);
        }
      }
      console.log("horaires");
      console.log(this.offre.horaires);
    },
    async submitForm() {
      console.log("description");
      console.log(this.description);
      this.valideTitle();
      this.valideType();
      this.valideZone();
      this.valideSecteur(), this.valideDisponibilite();
      this.valideDateLimite();
      this.valideFonction();
      this.valideNbr();
      if (
        this.offre.title.length != 0 &&
        this.offre.type.length != 0 &&
        this.offre.zone.length != 0 &&
        this.offre.secteur.length != 0 &&
        this.offre.disponibilite.length != 0 &&
        this.offre.date_limite.length != 0 &&
        this.offre.fonction.length != 0 &&
        this.offre.fonction.length != 0 &&
        this.offre.nbr.length != 0
      ) {
        this.isLoading = true;
        await axios
          .post("/api/v1/users/" + this.user.id + "/offres", this.offre)
          .then((response) => {
            console.log(response);
            this.$vs.notify({
              color: "success",
              title: "SUCCES",
              text: "Bien publier",
            });
            //this.init();
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
        this.erreur = true;
        this.e1 = 1;
        setTimeout(() => {
          this.erreur = false;
        }, 6000);
      }
    },
    valideTitle(value = "") {
      this.offre.title = value;
      console.log(this.offre.title);
      if (this.offre.title.length == 0) {
        this.type.title = "is-danger";
        this.message.title = "Ce champ est requis";
      } else {
        this.type.title = "is-success";
        this.message.title = "";
      }
    },
    valideType(value = "") {
      this.offre.type = value;
      console.log(this.offre.type);
      if (this.offre.type.length == 0) {
        this.type.type = "is-danger";
        this.message.type = "Ce champ est requis";
      } else {
        this.type.type = "is-success";
        this.message.type = "";
      }
    },
    valideTime(value = "Jour(s)") {
      this.offre.time = value;
      this.offre.duree = this.offre.nbrTime + " " + this.offre.time;
    },
    valideNbrTime(value = 0) {
      this.offre.nbrTime = value;
      this.offre.duree = this.offre.nbrTime + " " + this.offre.time;
    },
    valideSecteur(value = "") {
      this.offre.secteur = value;
      console.log(this.offre.secteur);
      if (this.offre.secteur.length == 0) {
        this.type.secteur = "is-danger";
        this.message.secteur = "Ce champ est requis";
      } else {
        this.type.secteur = "is-success";
        this.message.secteur = "";
      }
    },
    valideFonction(value = "") {
      this.offre.fonction = value;
      console.log(this.offre.fonction);
      if (this.offre.fonction.length == 0) {
        this.type.fonction = "is-danger";
        this.message.fonction = "Ce champ est requis";
      } else {
        this.type.fonction = "is-success";
        this.message.fonction = "";
      }
    },
    valideZone(value = "") {
      this.offre.zone = value;
      console.log(this.offre.zone);
      if (this.offre.zone.length == 0) {
        this.type.zone = "is-danger";
        this.message.zone = "Ce champ est requis";
      } else {
        this.type.zone = "is-success";
        this.message.zone = "";
      }
    },
    valideLieu(value = "") {
      this.offre.lieu = value;
      console.log(this.offre.lieu);
      if (this.offre.lieu.length == 0) {
        this.type.lieu = "is-danger";
        this.message.lieu = "Ce champ est requis";
      } else {
        this.type.lieu = "is-success";
        this.message.lieu = "";
      }
    },
    valideDisponibilite(value = "") {
      this.offre.disponibilite = value;
      console.log(this.offre.disponibilite);
      if (this.offre.disponibilite.length == 0) {
        this.type.disponibilite = "is-danger";
        this.message.disponibilite = "Ce champ est requis";
      } else {
        this.type.disponibilite = "is-success";
        this.message.disponibilite = "";
      }
    },
    valideDateLimite(value = "") {
      this.offre.date_limite = value;
      console.log(this.offre.date_limite);
      if (this.offre.date_limite.length == 0) {
        this.type.date_limite = "is-danger";
        this.message.date_limite = "Ce champ est requis";
      } else {
        this.type.date_limite = "is-success";
        this.message.date_limite = "";
      }
    },
    valideDateDeb(value = "") {
      this.offre.date_deb = value;
      console.log(this.offre.date_deb);
      if (this.offre.date_deb.length == 0) {
        this.type.date_deb = "is-danger";
        this.message.date_deb = "Ce champ est requis";
      } else {
        this.type.date_deb = "is-success";
        this.message.date_deb = "";
      }
    },
    valideNbr(value = "") {
      this.offre.nbr = value;
      console.log(this.offre.nbr);
      if (this.offre.nbr.length == 0) {
        this.type.nbr = "is-danger";
        this.message.nbr = "Ce champ est requis";
      } else {
        this.type.nbr = "is-success";
        this.message.nbr = "";
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
    deleteDropFile(index) {
      this.dropPoster.splice(index, 1);
      console.log(this.dropPoster);
    },
    /*async save() {
        await this.editor.save().then((savedData) => {
          this.desc = savedData;
          console.log(this.desc);
        });
      },*/
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
    //  await this.getAllTags();
    //await this.getAllEntities();
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
  color: rgb(97, 175, 114);
}
/*.ce-block__content,
  .ce-toolbar__content {
    max-width: unset;
    background: green !important;
  }*/
</style>
