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
                      >Publier une offre
                    </span>
                  </template>
                </b-field>
              </p>
              <publier-offre-1 width="200px" height="100px"></publier-offre-1>
            </div>
          </a-card>
        </v-col>
        <v-col cols="12">
          <a-card
            :loading="isLoading1"
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
                <v-stepper-step step="4" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label>Préférences de candidature</template>
                  </b-field></v-stepper-step
                >
                <v-divider></v-divider>
                <v-stepper-step step="5" color="#24855a">
                  <b-field custom-class="is-medium">
                    <template #label>Finale</template>
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
                                  >Ajouter les Informations de base</span
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
                        <b-field :type="type.title">
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
                          <template #message>
                            <span
                              style="
                                display: block;
                                height: 10px;
                                color: #f14668;
                                font-size: 0.75rem;
                                margin-top: 0.25rem;
                              "
                              >{{ message.step1.title }}</span
                            >
                          </template>
                          <b-input
                            required
                            type="text"
                            :value="offre.title.value"
                            @input="valide($event, 'step1', 'title')"
                          >
                          </b-input>
                        </b-field>
                      </a-card>

                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field :type="type.lieu">
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
                          <template #message>
                            <span
                              style="
                                display: block;
                                height: 10px;
                                color: #f14668;
                                font-size: 0.75rem;
                                margin-top: 0.25rem;
                              "
                              >{{ message.step1.lieu }}</span
                            >
                          </template>
                          <!--<b-select
                            placeholder=" Sélectionnez un type de lieu...."
                            @input="valide($event, 'step1', 'lieu')"
                            :value="offre.lieu.value"
                            expanded
                          >
                            <option
                              :value="lieu.name"
                              v-for="(lieu, index) in lieux"
                              :key="index"
                            >
                              {{ lieu.name }}
                            </option>
                          </b-select>-->
                          <a-select
                            size="large"
                            mode="default"
                            placeholder="Séléctionnez le type de lieu"
                            :value="offre.lieu.value"
                            style="width: 100%; border-radius: 10px"
                            @change="handleChangeTypeLieu"
                            class="label-text"
                          >
                            <a-select-option
                              v-for="item in lieux"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
                        <b-field
                          :type="type.zone"
                          expanded
                          v-if="offre.lieu.value == 'En personne(lieu précis)'"
                        >
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px">Quelle est ce lieu ?</span>
                          </template>
                          <template #message>
                            <span
                              style="
                                display: block;
                                height: 10px;
                                color: #f14668;
                                font-size: 0.75rem;
                                margin-top: 0.25rem;
                              "
                              >{{ message.step1.zone }}</span
                            >
                          </template>
                          <b-input
                            type="text"
                            :value="offre.zone.value"
                            @input="valide($event, 'step1', 'zone')"
                          >
                          </b-input>
                        </b-field>
                        <vs-alert
                          class="my-1"
                          v-if="offre.lieu.value == 'Télétravail'"
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
                        class="mx-2 my-2 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field expanded :type="type.secteur">
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
                          <template #message>
                            <span
                              style="
                                display: block;
                                height: 10px;
                                color: #f14668;
                                font-size: 0.75rem;
                                margin-top: 0.25rem;
                              "
                              >{{ message.step1.secteur }}</span
                            >
                          </template>
                          <!--<b-select
                            placeholder="Sélectionnez un secteur d'activité"
                            @input="valide($event, 'step1', 'secteur')"
                            :value="offre.secteur.value"
                            expanded
                          >
                            <option
                              :value="secteur.name"
                              v-for="(secteur, index) in secteurs"
                              :key="index"
                            >
                              {{ secteur.name }}
                            </option>
                          </b-select>-->
                          <a-select
                            size="large"
                            mode="default"
                            placeholder="Séléctionnez le secteur d'activité"
                            :value="offre.secteur.value"
                            style="width: 100%; border-radius: 10px"
                            @change="handleChangeSecteur"
                            class="label-text"
                          >
                            <a-select-option
                              v-for="item in secteurs"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
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
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          @click="step1Valid"
                          :loading="isLoading"
                          style="background: #24855a; color: white"
                        >
                          Enregistrer et continuer
                        </b-button></a-card
                      >
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
                                      >Décrire l'offre</span
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
                          <b-field>
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
                          v-model="offre.description.value"
                          ref="editor"
                          placeholder="Description de l'offre"
                          :editorToolbar="customToolbar"
                          :editorOptions="editorSettings"
                        />
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step2.description }}</span
                        >
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <template slot="title">
                          <b-field>
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
                          v-model="offre.exigences.value"
                          ref="exigences"
                          placeholder="Ajouter les exigences de l'offre"
                          :editorToolbar="customToolbar"
                          :editorOptions="editorSettings"
                        />
                      </a-card>
                      <b-message
                        type="is-danger"
                        has-icon
                        icon-size="is-size"
                        class="my-2"
                        v-if="message.step2.description"
                      >
                        Veuillez donner la description du poste
                      </b-message>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          style="background: #24855a; color: white"
                          @click="step2Valid"
                        >
                          <span class="mon-texte"
                            >Enregistrer et continuer</span
                          ></b-button
                        >
                        <b-button
                          outlined
                          @click="
                            e1 = 1;
                            errors = {};
                          "
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
                        <b-field expanded :type="type.type">
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
                          <a-select
                            size="large"
                            mode="default"
                            placeholder="Séléctionnez le type de l'emploi"
                            :value="offre.type.value"
                            style="width: 100%; border-radius: 10px"
                            @change="handleChangeType"
                            class="label-text"
                          >
                            <a-select-option
                              v-for="item in types"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
                        <!--<b-select
                            size="is-medium"
                            placeholder="Type"
                            @input="valide($event, 'step3', 'type')"
                            :value="offre.type.value"
                            expanded
                          >
                            <option value="Stage académique">Stage académique</option>
                            <option value="Stage profesionnel">Stage profesionnel</option>
                            <option value="Emploi">Emploi</option>
                          </b-select>-->

                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step3.type }}</span
                        >
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field :type="type.duree">
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
                          <b-input
                            v-model="offre.duree.value.nbrTime"
                            style="color: green"
                            type="number"
                          >
                          </b-input>
                          <b-select
                            placeholder=""
                            v-model="offre.duree.value.time"
                            :expanded="false"
                          >
                            <option value="Jour(s)">Jour(s)</option>
                            <option value="Semaine(s)">Semaine(s)</option>
                            <option value="Mois">Mois</option>
                            <option value="Année(s)">Année(s)</option>
                          </b-select>

                          <!--<b-field grouped>
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
                          </b-field>-->
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step3.duree }}</span
                        >
                      </a-card>

                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field :type="type.horaires" expanded>
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
                            <a-select
                              size="large"
                              mode="multiple"
                              placeholder="Séléctionnez les horaires"
                              :value="offre.horaires.value"
                              style="width: 100%; border-radius: 10px"
                              @change="handleChangeHoraire"
                              class="label-text"
                            >
                              <a-select-option
                                v-for="item in filteredHoraire"
                                :key="item.id"
                                :value="item.text"
                              >
                                {{ item.text }}
                              </a-select-option>
                            </a-select>
                            <!--<v-chip
                              class="ma-2"
                              @click="chipClick(tag)"
                              v-for="tag in horaires"
                              :key="tag.id"
                              :color="tag.checked == true ? '#24855a' : '#f0f2f5'"
                              :text-color="tag.checked == true ? 'white' : ''"
                            >
                              <v-icon v-if="tag.checked == true"
                                >mdi-checkbox-marked-circle</v-icon
                              >
                              <v-icon v-else>mdi-plus</v-icon>
                              {{ tag.text }}</v-chip
                            >-->
                          </div>
                          <!--<div v-if="message.step3.horaire.length != 0">
                            <span style="color: red"> errrrreur</span>
                          </div>-->
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step3.horaires }}</span
                        >
                      </a-card>

                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Il y a t-il une date limite de dépôts prévue pour ce poste
                              ?</span
                            >
                            <b-tooltip
                              position="is-right"
                              type="is-bleue"
                              label="Il s'agit de la dte limite de dépôt desdossiers"
                            >
                              <v-icon small style="color: #24855a"
                                >mdi-information
                              </v-icon>
                            </b-tooltip>
                          </template>
                        </b-field>
                        <a-card
                          class="elevation_0 my-card_1 my-1"
                          style="border-radius: 12px"
                        >
                          <b-radio
                            v-model="offre.datef"
                            type="is-bleue"
                            :native-value="true"
                          >
                            Oui
                          </b-radio>
                        </a-card>

                        <a-card
                          class="elevation_0 my-card_1 my-1"
                          style="border-radius: 12px"
                        >
                          <b-radio
                            v-model="offre.datef"
                            type="is-bleue"
                            :native-value="false"
                          >
                            Non
                          </b-radio>
                        </a-card>

                        <div v-if="offre.datef == true">
                          <b-field :type="type.date_limite" expanded>
                            <b-datepicker
                              expanded
                              placeholder="Sélectionnez une date"
                              :min-date="new Date()"
                              ref="datepicker2"
                              :value="
                                offre.date_limite.value
                                  ? new Date(offre.date_limite.value)
                                  : null
                              "
                              :show-week-number="false"
                              :locale="'fr-FR'"
                              icon="calendar-today"
                              @input="valideDate($event, 'step3', 'date_limite')"
                              :icon-right="offre.date_limite.value ? 'close-circle' : ''"
                              icon-right-clickable
                              @icon-right-click="valideDate(null, 'step3', 'date_limite')"
                              trap-focus
                            >
                            </b-datepicker>
                            <b-button
                              @click="$refs.datepicker2.toggle()"
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
                            >{{ message.step3.date_limite }}</span
                          >
                        </div>
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
                        <a-card
                          class="elevation_0 my-card_1 my-1"
                          style="border-radius: 12px"
                        >
                          <b-radio
                            v-model="offre.dated"
                            name="date_deb1"
                            type="is-bleue"
                            :native-value="true"
                          >
                            Oui
                          </b-radio>
                        </a-card>

                        <a-card
                          class="elevation_0 my-card_1 my-1"
                          style="border-radius: 12px"
                        >
                          <b-radio
                            name="date_deb2"
                            v-model="offre.dated"
                            type="is-bleue"
                            :native-value="false"
                          >
                            Non
                          </b-radio>
                        </a-card>

                        <div v-if="offre.dated == true">
                          <b-field :type="type.date_deb" expanded>
                            <b-datepicker
                              expanded
                              placeholder="Sélectionnez une date"
                              :min-date="new Date()"
                              ref="datepicker1"
                              :value="
                                offre.date_deb.value
                                  ? new Date(offre.date_deb.value)
                                  : null
                              "
                              :show-week-number="false"
                              :locale="'fr-FR'"
                              icon="calendar-today"
                              @input="valideDate($event, 'step3', 'date_deb')"
                              :icon-right="offre.date_deb.value ? 'close-circle' : ''"
                              icon-right-clickable
                              @icon-right-click="valideDate(null, 'step3', 'date_deb')"
                              trap-focus
                            >
                            </b-datepicker>
                            <b-button
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
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field expanded :type="type.nbr">
                          <template #label>
                            <span style="color: red"> </span
                            ><span style="font-size: 16px"
                              >Combien de personnes souhaitez-vous recruter pour ce poste
                              ?
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
                            <b-input type="number" v-model="offre.nbr.value"> </b-input>
                            <!--<b-select
                              placeholder="Nombre de personnes"
                              @input="valide($event, 'step3', 'nbr')"
                              :value="offre.nbr.value"
                              expanded
                            >
                              <option :value="1">1</option>
                              <option :value="2">2</option>
                              <option :value="3">3</option>
                              <option :value="100">Plus de 10</option>
                            </b-select>-->
                          </div>
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step3.nbr }}</span
                        >
                        <b-field expanded :type="type.urgence">
                          <template #label>
                            <span style="color: red">* </span
                            ><span style="font-size: 16px"
                              >Votre recrutement est-il urgent ?
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
                            <a-select
                              size="large"
                              mode="default"
                              placeholder="Séléctionnez l'urgence du recrutement'"
                              :value="offre.urgence.value"
                              style="width: 100%; border-radius: 10px"
                              @change="handleChangeUrgence"
                              class="label-text"
                            >
                              <a-select-option
                                v-for="item in urgences"
                                :key="item.id"
                                :value="item.text"
                              >
                                {{ item.text }}
                              </a-select-option>
                            </a-select>
                            <!--<a-select-option  value="1">1 à 3jour</a-select-option >
                              <a-select-option  value="2">1 à 2 semaines</a-select-option>
                              <a-select-option  value="3">1 à 2 mois</a-select-option >
                              <a-select-option  value="4">4 à 5mois</a-select-option >
                            </a-select>-->
                          </div>
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step3.urgence }}</span
                        >
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <span style="color: red"></span
                            ><span style="font-size: 16px">Niveau d'expérience</span>
                          </template>
                          <a-select
                            size="large"
                            mode="default"
                            placeholder="Séléctionnez le niveau d'expérience"
                            :value="offre.niveau_exp.value"
                            style="width: 100%"
                            @change="handleChangeNiveauExperience"
                            class="select"
                          >
                            <a-select-option
                              v-for="item in filteredExperience"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
                        <b-field>
                          <template #label>
                            <span style="color: red"></span
                            ><span style="font-size: 16px">Niveau d'étude</span>
                          </template>
                          <a-select
                            size="large"
                            mode="multiple"
                            placeholder="Séléctionnez le niveau d'étude"
                            :value="offre.niveau_std.value"
                            style="width: 100%"
                            @change="handleChangeNiveauEtude"
                            class="select"
                          >
                            <a-select-option
                              v-for="item in filteredEtudes"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field expanded :type="type.salaire">
                          <template #label>
                            <span style="color: red"></span
                            ><span style="font-size: 16px">Quel est le salaire ? </span>
                          </template>
                          <b-input
                            v-model="offre.salaire.value.montant"
                            style="color: green"
                            type="number"
                          >
                          </b-input>
                          <b-select
                            placeholder=""
                            v-model="offre.salaire.value.devise"
                            :expanded="false"
                          >
                            <option value="$">$</option>
                            <option value="£">£</option>
                            <option value="€">€</option>
                            <option value="F">F</option>
                          </b-select>
                          <b-select
                            placeholder=""
                            v-model="offre.salaire.value.frequence"
                            :expanded="false"
                          >
                            <option value="par jour" selected>par jour</option>
                            <option value="par semaine">par semaine</option>
                            <option value="par mois">par mois</option>
                            <option value="par an">par an</option>
                          </b-select>

                          <!--<b-input
                              type="text"
                              size="is-medium"
                              :value="offre.salaire"
                              @input="valideSalaire"
                            >
                            </b-input>-->
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step3.salaire }}</span
                        >
                      </a-card>
                      <b-message
                        class="mx-2 my-5 elevation_0 my-card_1"
                        v-if="e1 == 3 && Object.keys(errors).length != 0"
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
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          style="background: #24855a; color: white"
                          @click="step3Valid"
                        >
                          <span class="mon-texte"> Continuer</span></b-button
                        >
                        <b-button
                          outlined
                          @click="
                            e1 = 2;
                            errors = {};
                          "
                          ><span class="mon-texte">Réculer</span></b-button
                        >
                      </a-card>
                    </a-col>
                  </a-row>
                </v-stepper-content>

                <v-stepper-content step="4">
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
                                  class="font-weight-black text-xs-h5 text-md-h4"
                                  >Définir les préférences en matière de candidature</span
                                >
                              </template>
                            </b-field>
                          </p>
                          <preferences-candidature
                            width="200px"
                            height="100px"
                          ></preferences-candidature>
                        </div>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-field>
                          <template #label>
                            <div class="d-flex flex-row justify-content-between">
                              <span style="font-size: 26px" class="font-weight-bold"
                                >Paramètres de communication</span
                              >
                            </div>
                          </template>
                        </b-field>
                        <b-field>
                          <template #label>
                            <span style="color: red">*</span
                            ><span style="font-size: 16px">Moyen de candidature </span>
                          </template>
                          <a-select
                            size="large"
                            mode="multiple"
                            placeholder="Séléctionnez le mode de candidature"
                            :value="offre.moyens.value"
                            style="width: 100%"
                            @change="handleChangeModeCandidature"
                            class="select"
                          >
                            <a-select-option
                              v-for="item in filteredMoyens"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step4.moyens }}</span
                        >
                        <div>
                          <a-card
                            class="mb-2 mt-2"
                            v-if="
                              offre.moyens.value.some(
                                (item) => item != 'Sur la plateforme'
                              )
                            "
                          >
                            <div
                              v-if="
                                offre.moyens.value &&
                                offre.moyens.value.some(
                                  (item) =>
                                    item == 'Par mail (précisez le ou les adresses mails)'
                                )
                              "
                            >
                              <div
                                v-if="
                                  offre.candidature &&
                                  offre.candidature.value &&
                                  offre.candidature.value.emails &&
                                  offre.candidature.value.emails.length > 0
                                "
                              >
                                <div class="my-1">
                                  <b-field
                                    label="Adresses mail de candidature"
                                    custom-class="is-smal"
                                  >
                                    <div
                                      :key="index"
                                      v-for="(value, index) in offre.candidature.value
                                        .emails"
                                    >
                                      <b-field
                                        v-if="index == 0"
                                        class=""
                                        expended
                                        :type="typeEmail['candidatureEmails'][index]"
                                      >
                                        <template #message>
                                          {{ messageEmail["candidatureEmails"][index] }}
                                        </template>
                                        <b-input
                                          size="is-small"
                                          expended
                                          type="email"
                                          :value="value"
                                          @input="
                                            valideEmails(
                                              $event,
                                              'candidatureEmails',
                                              index
                                            )
                                          "
                                        >
                                        </b-input>
                                      </b-field>
                                      <b-field
                                        v-if="index > 0"
                                        class=""
                                        :type="typeEmail['candidatureEmails'][index]"
                                        expended
                                      >
                                        <template #message>
                                          {{ messageEmail["candidatureEmails"][index] }}
                                        </template>
                                        <b-input
                                          size="is-small"
                                          expended
                                          type="email"
                                          :value="value"
                                          @input="
                                            valideEmails(
                                              $event,
                                              'candidatureEmails',
                                              index
                                            )
                                          "
                                        >
                                        </b-input>

                                        <p class="">
                                          <vs-button
                                            @click="
                                              removeInputEmail('candidatureEmails', index)
                                            "
                                            class=""
                                            color="danger"
                                            type="border"
                                            icon="delete"
                                            size="small"
                                          ></vs-button>
                                        </p>
                                      </b-field>
                                    </div>
                                  </b-field>
                                  <b-button
                                    @click="addNewInputEmail('candidatureEmails')"
                                    type="is-bleue"
                                  >
                                    Ajouter
                                  </b-button>
                                </div>
                              </div>
                            </div>
                            <div
                              v-if="
                                offre.moyens.value &&
                                offre.moyens.value.some(
                                  (item) => item == 'Par dépot physique'
                                )
                              "
                            >
                              <b-field
                                custom-class="is-small"
                                label="Lieu du dépot"
                                :message="messageCandidature.lieu[0]"
                                :type="typeCandidature.lieu[0]"
                              >
                                <b-input
                                  size="is-small"
                                  type="text"
                                  :value="offre.candidature.value.lieu[0]"
                                  @input="valideCandidature($event, 'lieu', 0)"
                                >
                                </b-input>
                              </b-field>
                            </div>
                            <div
                              v-if="
                                offre.moyens.value &&
                                offre.moyens.value.some(
                                  (item) =>
                                    item ==
                                    'Par whatsapp (précisez le ou les numéros de réception)'
                                )
                              "
                            >
                              <b-field
                                label="Numéro de téléphone whatsapp"
                                custom-class="is-small"
                                expanded
                                :message="messageCandidature.phones[0]"
                                :type="typeCandidature.phones[0]"
                              >
                                <b-field>
                                  <b-input
                                    size="is-small"
                                    placeholder="+229 96857412"
                                    expanded
                                    :value="offre.candidature.value.phones[0]"
                                    @input="valideCandidature($event, 'phones', 0)"
                                    type="tel"
                                    required
                                  ></b-input>
                                </b-field>
                              </b-field>
                            </div>
                          </a-card>
                        </div>
                        <b-field>
                          <template #label>
                            <span style="color: red">*</span
                            ><span>Dossier de candidature</span>
                          </template>
                          <a-select
                            size="large"
                            mode="multiple"
                            placeholder="Séléctionnez le contenu des dossiers de candidatures"
                            :value="offre.docs.value"
                            style="width: 100%"
                            @change="handleChangeModeCandidatureDocs"
                            class="select"
                          >
                            <a-select-option
                              v-for="item in filteredDocCandidature"
                              :key="item.id"
                              :value="item.text"
                            >
                              {{ item.text }}
                            </a-select-option>
                          </a-select>
                        </b-field>
                        <span
                          style="
                            display: block;
                            height: 18px;
                            color: #f14668;
                            font-size: 0.75rem;
                            margin-top: 0.25rem;
                          "
                          >{{ message.step4.docs }}</span
                        >
                        <!--<div v-if="offre.moyen == '3'">
                          <b-field>
                            <template #label>
                              <span style="color: red"> </span>
                              <span>Numéro de réception des candidatures</span>
                            </template>
                            <b-input> </b-input>
                          </b-field>
                        </div>-->

                        <b-field expanded :type="type.emails">
                          <template #label>
                            <span style="color: red">*</span
                            ><span style="font-size: 16px"
                              >Envoyer des informations quotidiennes sur ce poste et les
                              candidatures associées à :
                            </span>
                          </template>
                          <div v-for="(value, index) in offre.emails.value" :key="index">
                            <b-field
                              :key="index"
                              :message="messageEmail['emails'][index]"
                              :type="typeEmail['emails'][index]"
                              v-if="index + 1 <= Object.keys(offre.emails.value).length"
                              expended
                              class="mt-1"
                            >
                              <b-input
                                expanded
                                :ref="index"
                                :key="index"
                                type="email"
                                :value="value || ''"
                                @input="valideEmails($event, 'emails', index)"
                              >
                              </b-input>
                            </b-field>
                            <b-field
                              class="mt-1"
                              v-else
                              :message="messageEmail['emails'][index]"
                              :type="typeEmail['emails'][index]"
                              expended
                            >
                              <b-input
                                :key="index"
                                expended
                                :ref="index"
                                type="email"
                                :value="value || ''"
                                @input="valideEmails($event, 'emails', index)"
                              >
                              </b-input>
                              <span></span>
                              <p class="">
                                <vs-button
                                  @click="removeInputEmail('emails', index)"
                                  class="h-100"
                                  color="danger"
                                  type="border"
                                  icon="delete"
                                ></vs-button>
                              </p>
                            </b-field>
                          </div>
                          <!-- <b-input
                            type="email"
                            size="is-medium"
                            v-for="(value, index) in emails"
                            v-if="index + 1 > Object.keys(theEmails).length"
                            :value="value"
                            :key="value"
                            @input="valideEmails(value)"
                          >
                          </b-input>-->
                        </b-field>
                        <b-button @click="addNewInputEmail('emails')" type="is-bleue">
                          Ajouter
                        </b-button>
                        <div>
                          <span class="">
                            <v-checkbox
                              color="#24855a"
                              aria-describedby="Autoriser l'envoi de  notification par email à chaque nouvelle candidature"
                              v-model="offre.autoriseMail.value"
                              label="Envoyer une notification par email à chaque nouvelle candidature"
                            ></v-checkbox>
                          </span>
                        </div>
                        <b-field expanded :type="type.appel">
                          <template #label>
                            <span style="color: red"></span
                            ><span style="font-size: 16px"
                              >Autorisez les candidat·es à vous appeler directement pour
                              cette annonce :
                            </span>
                          </template>
                          <b-field>
                            <b-dropdown
                              @change="chercher()"
                              @active-change="chercher()"
                              aria-role="list"
                              :scrollable="true"
                              :max-height="200"
                            >
                              <template #trigger="{ active }">
                                <b-button
                                  type="is-default"
                                  :icon-right="active ? 'menu-up' : 'menu-down'"
                                >
                                  <span style="font-size: 24px">
                                    {{ telephone.flag }}</span
                                  >

                                  <span class="pays" v-if="telephone.idd"
                                    >{{ telephone.idd.root
                                    }}<span v-if="telephone.idd.suffixes" class="pays">{{
                                      telephone.idd.suffixes[0]
                                    }}</span></span
                                  >
                                </b-button>
                              </template>

                              <b-dropdown-item
                                aria-role="listitem"
                                v-for="(item, name) in telephones"
                                :key="name"
                                style="font-size: 24px; color: black"
                                @click="
                                  offre.telephone.value.contact.value.indic_tel = item.iid.root.concat(
                                    item.iid.suffixes[0]
                                  )
                                "
                                class="text-captation"
                              >
                                <span style="font-size: 24px"> {{ item.flag }}</span
                                ><span style="font-size: 16px" class="ms-2 pays">{{
                                  item.translations.fra.common
                                }}</span>

                                <span class="pays" v-if="item.idd.root">{{
                                  item.idd.root + ""
                                }}</span
                                ><span v-if="item.idd.suffixes" class="pays">{{
                                  item.idd.suffixes[0]
                                }}</span></b-dropdown-item
                              >
                            </b-dropdown>
                            <!--<b-select placeholder="Currency" size="is-medium">
                              <option
                                v-for="(item, name) in telephones"
                                :key="name"
                                style="line-height: 100px; font-size: 24px"
                              >
                                <span style="line-height: 100px; font-size: 24px">
                                  {{ item.flag }}</span
                                ><span style="font-size: 16px" class="ms-2 pays">{{
                                  item.translations.fra.common
                                }}</span>

                                <span class="pays">{{ item.idd.root }}</span>
                              </option>
                            </b-select>-->
                            <b-input
                              type="telephone"
                              placeholder="Numéro de téléphone"
                              v-model="offre.telephone.value.contact.value.phone_number"
                            ></b-input>
                          </b-field>
                        </b-field>
                        <div>
                          <span class="text-caption"
                            >En saisissant votre numéro de téléphone, vous consentez à
                            recevoir des appels et des SMS de la part d'FindYourIntern et
                            de candidat·es potentiel·les concernant cette annonce.</span
                          >
                        </div>

                        <a-divider></a-divider>
                        <b-field>
                          <template #label>
                            <span style="font-size: 20px" class="font-weight-bold"
                              >Paramètres du message</span
                            ></template
                          >
                          <b-field>
                            <template #label>
                              <span style="color: red">*</span>
                              <span
                                >Voulez-vous laisser les candidat·es qui postulent à votre
                                offre engager la conversation ?</span
                              >
                            </template>
                            <div>
                              <span class="text-caption mon-texte"
                                >Autorisez les candidat·es à vous contacter au sujet de
                                leur candidature. Les messages seront envoyés à la même
                                adresse email que celle que vous avez fournie pour les
                                informations quotidiennes.</span
                              >
                              <a-card
                                class="elevation_0 my-card_1 my-1"
                                style="border-radius: 12px"
                              >
                                <b-radio
                                  v-model="offre.auto_convers.value"
                                  type="is-bleue"
                                  :native-value="true"
                                  size="is-medium"
                                >
                                  Oui
                                </b-radio>
                              </a-card>

                              <a-card
                                class="elevation_0 my-card_1 my-1"
                                style="border-radius: 12px"
                              >
                                <b-radio
                                  v-model="offre.auto_convers.value"
                                  type="is-bleue"
                                  :native-value="false"
                                  size="is-medium"
                                >
                                  Non
                                </b-radio>
                              </a-card>
                            </div>
                          </b-field>
                        </b-field>
                        <b-field type="is-medium">
                          <template #label>
                            <div class="d-flex flex-row justify-content-between">
                              <span style="font-size: 20px" class="font-weight-bold"
                                >Assistant virtuel</span
                              >
                              <b-switch type="is-bleue" v-model="offre.isSwitched.value">
                                Activé
                              </b-switch>
                            </div>
                            <div>
                              <span class="text-caption"
                                >FindYourIntern refusera en votre nom les candidats qui ne
                                vous intéressent pas.</span
                              >
                            </div>
                          </template>
                          <div>
                            <a-card v-if="offre.isSwitched.value">
                              <p class="font-weight-black text-h6">
                                Si je ne manifeste pas mon intérêt, refuser la candidature
                                automatiquement après :
                              </p>
                              <div style="margin-top: 40px"></div>
                              <v-slider
                                :max="2"
                                step="1"
                                ticks="always"
                                tick-size="8"
                                v-model="offre.reject.value"
                                thumb-size="28"
                                thumb-color="#24855a"
                                track-color="#24855a"
                                track-fill-color="#24855a"
                                color="#24855a"
                                :tick-labels="nbrJrs"
                                :tiks="true"
                                ><template v-slot:thumb-label="props">
                                  <v-icon color="white"> mdi-map-marker-circle </v-icon>
                                </template></v-slider
                              >
                            </a-card>
                          </div>
                        </b-field>
                      </a-card>
                      <b-message
                        class="mx-2 my-5 elevation_0 my-card_1"
                        v-if="e1 == 4 && Object.keys(errors).length != 0"
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
                      <b-message
                        class="mx-2 my-5 elevation_0 my-card_1"
                        v-if="e1 == 4 && errorsSub.valide == false"
                        title=""
                        type="is-danger"
                        has-icon
                        icon-size="is-medium"
                        role="alert"
                        :closable="false"
                      >
                        <span>{{ errorsSub.text }}</span>
                      </b-message>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          style="background: #24855a; color: white"
                          @click="step4Valid"
                        >
                          <span class="mon-texte"
                            >Enregistrer et continuer</span
                          ></b-button
                        >
                        <b-button outlined @click="e1 = 3"
                          ><span class="mon-texte">Réculer</span></b-button
                        ></a-card
                      >
                    </a-col>
                  </a-row>
                </v-stepper-content>

                <v-stepper-content step="5">
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
                        <b-message
                          :closable="false"
                          title="Presqu'à la fin!"
                          type="is-success"
                          has-icon
                          aria-close-label="Close message"
                        >
                          <p class="text-subtitle">
                            Vous avez remplir toutes les informations nécessaires à votre
                            offre. Vous pouvez retourner modifier des données ou publier
                            l'offre
                          </p>
                          <!--<div class="mx-2 my-5" style="border-radius: 12px">
                            <b-button
                              style="background: #24855a; color: white"
                              @click="submitForm"
                            >
                              <span class="mon-texte">Publier</span></b-button
                            >
                            <b-button
                              outlined
                              @click="setStep({ userId: user.id, step: 4 })"
                              ><span class="mon-texte">Réculer</span></b-button
                            >
                          </div>-->
                        </b-message>
                      </a-card>
                      <a-card
                        class="mx-2 my-5 elevation_0 my-card_1"
                        style="border-radius: 12px"
                      >
                        <b-button
                          style="background: #24855a; color: white"
                          @click="submitForm"
                        >
                          <span class="mon-texte">Publier</span></b-button
                        >
                        <b-button
                          outlined
                          @click="
                            e1 = 4
                            /* errors = {};*/
                          "
                          ><span class="mon-texte">Réculer</span></b-button
                        ></a-card
                      >
                    </a-col>
                  </a-row>
                </v-stepper-content>
              </v-stepper-items>
            </v-stepper>
            <b-message v-if="erreur" title="Danger" type="is-danger">
              Il y a des champs obligatoires qui sont vides
            </b-message>
          </a-card>
        </v-col>
      </v-row>
    </div>
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
const OPTIONS = ["Apples", "Nails", "Bananas", "Helicopters"];
export default {
  components: {
    infosBase1,
    description1,
    addDetailsIcon1,
    publierOffre1,
    preferencesCandidature,
  },
  //name: "App",
  props: ["offreModele"],
  data() {
    return {
      errorsSub: {
        text: "",
        valide: true,
      },
      change: true,
      moyensCandidature: [
        { id: 1, text: "Par dépot physique" },
        { id: 2, text: "Par mail (précisez le ou les adresses mails)" },
        { id: 3, text: "Par whatsapp (précisez le ou les numéros de réception)" },
        { id: 4, text: "Sur la plateforme" },
      ],
      dossiersCandidature: [
        { id: 1, text: "CV" },
        { id: 2, text: "Lettre de motivation" },
        { id: 3, text: "Copie des diplomes" },
      ],
      experiences: [
        { id: 1, text: "3 mois" },
        { id: 2, text: "Plus de 6 mois" },
        { id: 3, text: "Plus de 9 mois" },
        { id: 4, text: "1 an" },
        { id: 5, text: "2 ans" },
      ],
      etudes: [
        { id: 1, text: "CEP" },
        { id: 2, text: "BEPC" },
        { id: 3, text: "CAP" },
        { id: 4, text: "BAC" },
        { id: 5, text: "BAC+1" },
        { id: 5, text: "BAC+2" },
        { id: 4, text: "BAC+3" },
        { id: 5, text: "BAC+4" },
        { id: 5, text: "BAC+5" },
      ],
      selectedItems: [],
      dates: [],
      telephones: [],
      telephone: {},
      typeEmail: {
        emails: [],
        candidatureEmails: [],
      },
      messageEmail: {
        emails: [],
        candidatureEmails: [],
      },
      messageCandidature: {
        phones: [],
        lieu: [],
      },
      typeCandidature: {
        phones: [],
        lieu: [],
      },
      email1: "",
      nbrJrs: ["7 jours", "10 jours", "14 jours", "22 jours"],
      e1: this.myE1(this.$route.query.step),
      offre: this.offreModele
        ? { ...this.offreModele, index: this.$route.query.index }
        : this.modelOffre,
      formData1: new FormData(),
      isLoading: false,
      isLoading1: false,
      modelOffre: {
        index: this.$route.query.index,
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
        telephone: {
          value: {
            contact: {
              value: {
                phone_number: "",
                indic_tel: "",
              },
            },
            //candidature: [],
          },
          required: false,
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
            devise: "F",
            montant: 0,
            frequence: "par jour",
          },
          required: false,
        },
        urgence: {
          value: "",
          required: true,
        },
        emails: {
          value: {},
          required: false,
        },
        /*telephone: {
          value: {
            phone_number: "",
            indic_tel: "",
          },
          required: false,
        },*/
        moyens: {
          value: [],
          required: true,
        },
        docs: {
          value: [],
          required: true,
        },
        horaires: {
          value: [],
          required: true,
        },
        dated: false,
        datef: false,
        niveau_exp: {
          value: "",
          required: false,
        },
        niveau_std: {
          value: [],
          required: false,
        },
        candidature: {
          value: {
            emails: [],
            phones: [],
            lieu: [],
          },
          required: false,
        },
        reject: {
          value: "",
          required: false,
        },
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
          horaires: "",
          urgence: "",
        },
        step4: {
          moyens: "",
          docs: "",
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
        horaires: "",
        urgence: "",
        moyens: "",
        docs: "",
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
      urgences: [
        { id: 1, text: "1 à 5 jours" },
        { id: 2, text: "1 à 2 semaines" },
        { id: 3, text: "2 semaines à 1 mois" },
      ],

      horaires: [
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
        { id: 1, text: "Informatique,Telecom,Internet" },
        { id: 2, text: "Energie, Mines, Matière première" },
        { id: 3, text: "Banque, Assurance, Finance" },
      ],
      select1: [],
      lieux: [
        { id: 1, text: "Télétravail" },
        { id: 2, text: "En personne(lieu précis)" },
      ],
      types: [
        { id: 1, text: "Emploi" },
        { id: 2, text: "Stage académique" },
        { id: 2, text: "Stage profesionnel" },
      ],

      fonctions: [
        { name: "Création/Design" },
        { name: "Administration réseau" },
        { name: "Sécurité réseaux" },
        { name: "Désigner web" },
        { name: "Développeur d'application mobile" },
      ],
      erreur: false,
      errors: {},
      errorsEmails: {},
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
    ...mapGetters({}),
    descriptionTextLength() {
      const div = document.createElement("div");
      div.innerHTML = this.offre["description"].value;
      return div.textContent.length;
    },
    filteredMoyens() {
      if (this.offre.moyens.value)
        return this.moyensCandidature.filter((moyen) => {
          return !this.offre.moyens.value.some((item) => item == moyen.text);
        });
      else {
        return this.moyensCandidature;
      }
    },
    filteredTypeLieux() {
      if (this.offre.lieu.value)
        return this.lieux.filter((lieu) => {
          return !this.offre.lieu.value.includes(lieu.text);
        });
      else {
        return this.offre.lieu;
      }
    },
    filteredDocCandidature() {
      if (this.offre.docs.value)
        return this.dossiersCandidature.filter((docs) => {
          return !this.offre.docs.value.includes(docs.text);
        });
      else {
        return this.dossiersCandidature;
      }
    },
    filteredSecteur() {
      // return  OPTIONS.filter((o) => !this.offre.moyens.value.includes(o));
      if (this.offre.secteur.value)
        return this.secteurs.filter((moyen) => {
          return !this.offre.secteur.value.includes(moyen.text);
        });
      else {
        this.secteurs;
      }
    },
    filteredEtudes() {
      if (this.offre.niveau_std && this.offre.niveau_std.value) {
        console.log("this.offre.niveau_std.value");
        console.log(this.offre.niveau_std.value);
        return this.etudes.filter((niv) => {
          return !this.offre.niveau_std.value.some((ele) => ele.id == niv.id);
        });
      } else {
        return this.etudes;
      }
    },
    filteredExperience() {
      // return  OPTIONS.filter((o) => !this.offre.moyens.value.includes(o));
      if (this.offre.niveau_exp && this.offre.niveau_exp.value)
        return this.experiences.filter((niv) => {
          return !this.offre.niveau_exp.value.includes(niv.text);
        });
      else {
        return this.experiences;
      }
    },
    filteredHoraire() {
      // return  OPTIONS.filter((o) => !this.offre.moyens.value.includes(o));
      if (this.offre.horaires.value)
        return this.horaires.filter((hor) => {
          return !this.offre.horaires.value.some((ele) => hor.id == ele.id);
        });
      else {
        return this.horaires;
      }
    },
  },

  methods: {
    getDate(val) {
      if (val == null) {
        return val;
      } else {
        return new Date(val);
      }
    },
    handleChangeModeCandidature(selectedItems) {
      this.offre.moyens.value = selectedItems;
      this.valide(this.offre.moyens.value, "step4", "moyens");
    },
    handleChangeTypeLieu(selectedItem) {
      this.offre.lieu.value = selectedItem;
      this.valide(selectedItem, "step1", "lieu");
    },
    handleChangeSecteur(selectedItem) {
      this.offre.secteur.value = selectedItem;
      this.valide(selectedItem, "step1", "secteur");
    },
    handleChangeType(selectedItem) {
      this.offre.type.value = selectedItem;
      this.valide(selectedItem, "step3", "type");
    },
    handleChangeUrgence(selectedItem) {
      this.offre.urgence.value = selectedItem;
      this.valide(selectedItem, "step3", "urgence");
    },
    handleChangeModeCandidatureDocs(selectedItem) {
      this.offre.docs.value = selectedItem;
    },
    handleChangeNiveauEtude(selectedItem) {
      this.offre.niveau_std.value = selectedItem;
    },
    handleChangeNiveauExperience(selectedItem) {
      this.offre.niveau_exp.value = selectedItem;
    },
    handleChangeHoraire(selectedItem) {
      this.offre.horaires.value = selectedItem;
      this.valide(selectedItem, "step3", "horaires");
    },

    slides(val) {
      console.log("valeur");
      console.log(val);
    },
    chercher(value) {
      console.log("cest     moi!!!!!!!!!!!!!!!!!!!!!!!");
    },
    ...mapMutations({}),

    ...mapActions({}),
    myStep(value) {
      let sortie = "getting-started";
      switch (value) {
        case 1:
          sortie = "getting-started";
          break;
        case 2:
          sortie = "offre-descriptions";
          break;
        case 3:
          sortie = "offre-details";
          break;
        case 4:
          sortie = "offre-preferencesCandidature";
          break;
        case 5:
          sortie = "offre-finale";
          break;
      }
      return sortie;
    },
    myE1(value) {
      let sortie = 1;
      switch (value) {
        case "getting-started":
          sortie = 1;
          break;
        case "offre-descriptions":
          sortie = 2;
          break;
        case "offre-details":
          sortie = 3;
          break;
        case "offre-preferencesCandidature":
          sortie = 4;
          break;
        case "offre-finale":
          sortie = 5;
          break;
      }
      return sortie;
    },
    errorSearch(obj) {
      for (const [key, value] of Object.entries(obj)) {
        if (value.length != 0) {
          this.errors = { ...this.errors, ...{ [key]: value } };
          console.log(this.errors);
        }
      }
    },
    errorSearchEmail(obj) {
      for (const [key, value] of obj) {
        console.log("eleeeeeeeeeeeeee");
        console.log(value);
        if (value.length != 0) {
          this.errorsEmails = { ...this.errorsEmails, ...{ [key]: value } };
          console.log(this.errorsEmails);
        }
      }
      /* if (
        obj.some((item) => {
          return item.length;
        })
      ) {
        this.errorsSub["candidatureEmails"] = "Il y a des champs d'emails";
      } else {
        this.errorsSub["candidatureEmails"] = "";
      }*/
    },
    async updateOffreCache(e1) {
      this.isLoading = true;
      console.log("iciiiiiiiiiii");
      await axios
        .post("/api/v1/offre/cache/" + this.user.id, {
          offre: {
            ...this.offre,
          },
          index: this.$route.query.index,
        })
        .then((response) => {
          console.log(response);
          this.isLoading = false;
          //  this.offre = response.data.data;
          this.e1 = e1;
        })
        .catch((error) => {
          console.log(error.message);
          this.isLoading = false;
        });
    },
    async deleteOffreCache() {
      await axios
        .post("/api/v1/offre/cache/delete/" + this.user.id, {
          index: this.offre.index,
        })
        .then((response) => {
          console.log(response);
          // this.offre ;
          console.log("this.offre");
          console.log(this.offre);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    messagesTexts(step, field) {
      let message = "";
      switch (field) {
        case "title":
          message = "Veuillez renseigner l'intitulé du poste";
          break;
        case "secteur":
          message = "Veuillez renseigner le secteur d'activité";
          break;
        case "lieu":
          message = "Veuillez renseigner le type de lieu";
          break;
        case "zone":
          if (
            this.offre["lieu"].value.length != 0 &&
            this.offre["lieu"].value != "Télétravail"
          )
            message = "Veuillez renseigner le  lieu";
          break;
        case "description":
          message = "Veuillez renseigner la description de l'offre";
          break;
        case "date_deb":
          message = "Veuillez renseigner la date de début";
          break;
        case "date_limite":
          message = "Veuillez renseigner la date limite";
          break;
        case "type":
          message = "Veuillez renseigner le type de l'offre";
          break;
        case "urgence":
          message = "Veuillez renseigner l'urgence du recrutement";
          break;
        case "duree":
          message = "Veuillez renseigner la duree du contrat";
          break;
        case "horaires":
          message = "Veuillez renseigner les horaires de ce poste";
          break;
        case "moyens":
          message = "Veuillez renseigner les moyens de candidature";
          break;
        case "docs":
          message = "Veuillez renseigner le contenu des dossiers de candidature";
          break;
      }
      return message;
    },
    verifBasic(value, step, field) {
      this.offre[field].value = value;
      if (value == null) {
        this.type[field] = "is-danger";
        this.message[step][field] = this.messagesTexts(step, field);
      } else if (value.length == 0) {
        this.type[field] = "is-danger";
        this.message[step][field] = this.messagesTexts(step, field);
      } else {
        this.type[field] = "";
        this.message[step][field] = "";
        this.removeError(field);
      }
    },
    valideDate(value, step, field) {
      console.log("la date");
      console.log(value);
      this.offre[field].value = value;
      if (value == null) {
        if (this.offre.dated == true && field == "date_deb") {
          this.type[field] = "is-danger";
          this.message[step][field] = this.messagesTexts(step, field);
        } else if (this.offre.dated == false && field == "date_deb") {
          this.type[field] = "";
          this.message[step][field] = "";
          this.removeError(field);
        }
        if (this.offre.datef == true && field == "date_limite") {
          this.type[field] = "is-danger";
          this.message[step][field] = this.messagesTexts(step, field);
        } else if (this.offre.datef == false && field == "date_limite") {
          this.type[field] = "";
          this.message[step][field] = "";
          this.removeError(field);
        }
      } else if (
        // field == "date_limite" &&
        this.offre["date_limite"].value != null &&
        this.offre["date_deb"].value != null &&
        this.offre.datef == true &&
        this.offre.dated == true
      ) {
        if (this.offre["date_limite"].value > this.offre["date_deb"].value) {
          this.type["date_limite"] = "is-danger";
          this.message[step]["date_limite"] =
            "La date limite de dépot des dossiers doit être inférieur à la date de début du poste";
          this.type["date_deb"] = "is-danger";
          this.message[step]["date_deb"] =
            "La date de début du poste doit être supérieur à la date limite de dépot des dossiers";
        } else {
          this.type["date_limite"] = "";
          this.message[step]["date_limite"] = "";
          this.type["date_deb"] = "";
          this.message[step]["date_deb"] = "";
          this.removeError("date_limite");
          this.removeError("date_deb");
        }
        /*} else if (
        field == "date_deb" &&
        this.offre[field].value != null &&
        this.offre["date_limite"].value != null &&
        this.offre.dated == true &&
        this.offre.datef == true
      ) {
        if (this.offre[field].value > this.offre["date_limite"].value) {
          this.type[field] = "is-danger";
          this.message[step][field] =
            "La date de début doit être inférieur à la date limite";
          this.message[step]["date_limite"] =
            "La date limite doit être supérieur à la date de début";
        } else {
          this.type[field] = "";
          this.message[step][field] = "";
          this.removeError(field);
          this.type["date_limite"] = "";
          this.message[step]["date_limite"] = "";
          this.removeError("date_limite");
        }*/
      } else {
        this.type[field] = "";
        this.message[step][field] = "";
        this.removeError(field);
      }
    },
    valide(value, step, field) {
      this.offre[field].value = value;
      this.verifBasic(value, step, field);
      if (field == "description" && this.descriptionTextLength < 40) {
        this.type.description = "is-danger";
        this.message.step2.description =
          "Vous devez renseigner la description avec au moins 40 caractères";
      } else if (field == "description" && this.descriptionTextLength > 40) {
        this.type.description = "is-success";
        this.message.step2.description = "";
        this.removeError("description");
      }
    },
    step1Valid() {
      let keys = ["title", "lieu", "zone", "secteur"];
      for (let ele of keys) {
        this.valide(this.offre[ele].value, "step1", ele);
      }
      this.errorSearch(this.message.step1);
      if (Object.keys(this.errors).length == 0) {
        this.updateOffreCache(2);
      }
    },
    step2Valid() {
      this.valide(this.offre["description"].value, "step2", "description");
      this.errorSearch(this.message.step2);
      if (Object.keys(this.errors).length == 0) {
        this.updateOffreCache(3);
      }
    },

    step3Valid() {
      // this.isLoading = true;
      let keys = ["type", "horaires", "urgence"];
      for (let ele of keys) {
        this.valide(this.offre[ele].value, "step3", ele);
      }
      let keys1 = ["date_limite", "date_deb"];
      for (let ele of keys1) {
        if (this.offre.dated == true && ele == "date_deb")
          this.valideDate(this.offre[ele].value, "step3", ele);
        if (this.offre.datef == true && ele == "date_limite")
          this.valideDate(this.offre[ele].value, "step3", ele);
      }
      this.errorSearch(this.message.step3);
      if (Object.keys(this.errors).length == 0) {
        this.updateOffreCache(4);
      }
    },

    step4Valid() {
      let keys = ["moyens", "docs"];
      for (let ele of keys) {
        this.valide(this.offre[ele].value, "step4", ele);
      }
      let compte1 = true;
      for (let index in this.offre.emails.value) {
        console.log("index");
        console.log(index);
        this.valideEmails(this.offre.emails.value[index], "emails", index);
      }
      if (
        this.messageEmail["emails"] &&
        this.messageEmail["emails"].some((ele) => {
          ele.length != 0;
        })
      ) {
        compte1 = false;
      }

      let compte2 = true;
      if (
        this.offre.candidature.value.emails &&
        this.offre.candidature.value.emails.length != 0
      ) {
        for (let index in this.offre.candidature.value.emails) {
          this.valideEmails(
            this.offre.candidature.value.emails[index],
            "candidatureEmails",
            index
          );
        }
        if (
          this.messageEmail["candidatureEmails"] &&
          this.messageEmail["candidatureEmails"].some((ele) => {
            return ele.length != 0;
          })
        ) {
          compte2 = false;
        }
      }

      let compte3 = true;
      console.log(this.offre.candidature.value.phones);
      if (
        this.offre.candidature.value.phones &&
        this.offre.candidature.value.phones.length != 0
      ) {
        this.valideCandidature(this.offre.candidature.value.phones[0], "phones", 0);

        if (
          /*this.messageCandidature["phones"][0] &&*/
          this.messageCandidature["phones"][0].length != 0
        ) {
          compte3 = false;
        }
      }
      let compte4 = true;
      if (
        this.offre.candidature.value["lieu"] &&
        this.offre.candidature.value["lieu"].length != 0
      ) {
        this.valideCandidature(this.offre.candidature.value.lieu[0], "lieu", 0);
        if (
          this.messageCandidature["lieu"][0] &&
          this.messageCandidature["lieu"][0].length != 0
        ) {
          compte4 = false;
        }
      }

      this.errorSearch(this.message.step4);

      if (
        (compte1 == false || compte2 == false || compte3 == false || compte4 == false) &&
        Object.keys(this.errors).length == 0
      ) {
        this.errorsSub = {
          text:
            "Il y a des erreurs conçernant les informations supplémentaires pour le mode de candidature",
          valide: false,
        };
      } else {
        this.errorsSub = {
          text: "",
          valide: true,
        };
      }
      if (
        Object.keys(this.errors).length == 0 &&
        compte1 == true &&
        compte2 == true &&
        compte3 == true &&
        compte4 == true
      ) {
        this.e1 = 5;
        this.updateOffreCache(5);
      }
    },
    async submitForm() {
      this.isLoading1 = true;
      await axios
        .post("/api/v1/users/" + this.user.id + "/offres", {
          ...this.offre,
          ...{ emails: JSON.stringify(this.offre.emails.value) },
          ...{ duree: JSON.stringify(this.offre.duree.value) },
          ...{ horaires: JSON.stringify(this.offre.horaires.value) },
          ...{
            // JSON.stringify(
            telephone: /* this.offre.telephone.value.contact
                .value */ {
              phone_number: this.offre.telephone.value.contact.value.phone_number,
              indic_tel: this.offre.telephone.value.contact.value.indic_tel,
            },
          },
          ...{ niveau_std: JSON.stringify(this.offre.niveau_std.value) },
          ...{ candidature: JSON.stringify(this.offre.candidature.value) },
          ...{ docs: JSON.stringify(this.offre.docs.value) },
          ...{ duree: JSON.stringify(this.offre.duree.value) },
          ...{ moyens: JSON.stringify(this.offre.moyens.value) },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          //
          this.deleteOffreCache();
          this.isLoading1 = false;
          this.$vs.notify({
            color: "success",
            title: "SUCCES",
            text: "Votre offre d'emploi a bien été publiée",
            time: 6000,
          });
          this.$router.replace({ name: "successPosting" });
          //  this.e1 = 1;
          //this.offre = { ...this.modelOffre, ...{ emails: { [0]: this.user.email } } };
          // this.setStep({ usserId: user.id, step: 1 });

          /* setTimeout(function () {
            this.$router.push("/accueil").catch((err) => {
              console.log(err);
            });
          }, 3000);*/

          //this.init();
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.$vs.notify({
            color: "danger",
            title: "Erreur",
            text: "Quelque chose n'a pas marcher au niveau du serveur",
          });
          this.isLoading1 = false;
        });
      /*   .finally(() => {
          this.isLoading1 = false;
          // this.removeAll(this.user.id);
          // this.setStep({ userId: user.id, step: 1 });
          // this.setStep()
        });*/
    },
    removeError(text) {
      for (const [key, value] of Object.entries(this.errors)) {
        if (key == text && Object.keys(this.errors).length != 0) {
          console.log(this.errors);
          Reflect.deleteProperty(this.errors, key);
        }
      }
    },

    valideEmails(e, field, index) {
      if (field == "emails") {
        this.offre.emails.value = { ...this.offre.emails.value, ...{ [index]: e } };
      } else if (field == "candidatureEmails") {
        this.offre.candidature.value["emails"][index] = e;
      }
      if (e.length == 0) {
        this.typeEmail[field][index] = "is-danger";
        this.messageEmail[field][index] = "Ce champ est requis";
      } else if (/.+@.+\..+/.test(e) == false) {
        this.typeEmail[field][index] = "is-danger";
        this.messageEmail[field][index] = "L'email entré n'est pas valide";
      } else if (/.+@.+\..+/.test(e) == true) {
        this.typeEmail[field][index] = "";
        this.messageEmail[field][index] = "";
      }
    },
    valideCandidature(e, field, index) {
      console.log("eeeerrr");
      console.log(e);
      if (field == "phones") {
        this.offre.candidature.value[field][0] = e;
      } else if (field == "lieu") {
        this.offre.candidature.value[field][0] = e;
      }
      if (e == null || e.length == 0) {
        this.typeCandidature[field][0] = "is-danger";
        this.messageCandidature[field][0] = "Ce champ est requis";
      } else if (e.length != 0) {
        console.log(field);
        // this.typeCandidature[field][0] = "";
        this.$set(this.typeCandidature[field], 0, "");
        this.$set(this.messageCandidature[field], 0, "");
        //this.messageCandidature[field][0] = "";
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
            title: "SUCCES DE L'OPERATION",
            text: "OFRRE PUBLIE AVEC SUCCES",
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
    addNewInputEmail(field) {
      if (field == "emails") {
        let index = Object.keys(this.offre.emails.value).length;
        console.log(index);
        if (index <= 2) {
          this.offre.emails.value = { ...this.offre.emails.value, ...{ [index]: "" } };
          // console.log(this.offre.emails.value);
        } else {
          // this.addNewInput = false;
        }
      }
      if (field == "candidatureEmails") {
        let length = this.offre.candidature.value.emails.length;
        if (length <= 2) {
          this.offre.candidature.value.emails.push("");
        }
      }
    },
    removeInputEmail(field, index) {
      console.log(index);
      if (field == "emails") {
        delete this.offre.emails.value[index];
        //Reflect.deleteProperty(this.offre.emails.value, index);
        // this.offre.emails.value = { ...this.offre.emails.value };
        console.log(this.offre.emails.value);
      } else if (field == "candidatureEmails") {
        this.offre.candidature.value.emails.splice(index, 1);
      }
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
    getAllTelephones() {
      fetch("https://restcountries.com/v3.1/all")
        .then((response) => response.json())
        .then((data) => {
          console.log("telephones");
          console.log(data);
          this.telephones = data;
          this.offre.telephone;
        })
        .catch((error) => console.error(error));
    },
    async getSelectedPhone1() {
      await axios
        .get("https://restcountries.com/v3.1/name/benin")
        .then((data) => {
          console.log("data loading2");
          console.log(data.data);
          // this.offre.telephone = data.data[0];
          console.log("contact");
          console.log(this.offre.telephone);
          console.log(" this.offre.telephone");
          this.telephone = this.telephones.find((tel) => {
            let retour = false;
            if (tel.iid != null) {
              if (
                tel.iid.root.toString().concat("", tel.iid.suffixes[0]) ==
                this.offre.telephone.value.contact.value.indic_tel
              )
                retour = true;
            }
            return retour;
          });
          if (!this.telephone) this.telephone = data.data[0];
        })
        .catch((error) => console.error(error));
    },
    async getOffreCache() {
      if (!this.offreModele) {
        await axios
          .post("/api/v1/offre/cache/init/" + this.user.id, {
            index: this.$route.query.index,
          })
          .then((data) => {
            console.log("offre cache loading2");
            console.log(data);
            this.offre = data.data.data != null ? data.data.data : this.modelOffre;
            console.log("this.offre");
            console.log(this.offre);
          })
          .catch((error) => console.error(error));
      }
    },
  },
  watch: {
    "offre.dated"(value) {
      console.log("cccccccccccccccccc");
      console.log(value);
      if (value == false) {
        this.offre.date_deb.value = null;
        this.valideDate(null, "step3", "date_deb");
      }
    },
    "offre.datef"(value) {
      if (value == false) {
        this.offre.date_limite.value = null;
        this.valideDate(null, "step3", "date_limite");
      }
    },
    "offre.moyens.value"(value) {
      let test = this.offre.moyens.value.some(
        (item) => item == "Par mail (précisez le ou les adresses mails)"
      );
      console.log("kimie" + test);
      console.log(this.offre.candidature.value.emails.length);
      if (test == true && this.offre.candidature.value.emails.length == 0) {
        this.offre.candidature.value.emails.push("");
        console.log(this.offre.candidature.value.emails);
      } else if (test == false) {
        this.offre.candidature.value["emails"].length = 0;
        this.messageEmail["candidatureEmails"].length = 0;
        this.typeEmail["candidatureEmails"].length = 0;
      }
      let test1 = this.offre.moyens.value.some(
        (item) => item == "Par whatsapp (précisez le ou les numéros de réception)"
      );
      if (test1 == true && this.offre.candidature.value.phones.length == 0) {
        this.offre.candidature.value.phones.push("");
        console.log(this.offre.candidature.value.emails);
      } else if (test == false) {
        this.typeCandidature["phones"].length = 0;
        this.messageCandidature["phones"].length = 0;
        this.offre.candidature.value["phones"].length = 0;
      }

      let test3 = this.offre.moyens.value.some((item) => item == "Par dépot physique");
      if (test3 == true && this.offre.candidature.value.lieu.length == 0) {
        this.offre.candidature.value.lieu.push("");
        console.log(this.offre.candidature.value.lieu);
      } else if (test == false) {
        this.typeCandidature.lieu.length = 0;
        this.messageCandidature.lieu.length = 0;
        this.offre.candidature.value.lieu.length = 0;
      }
    },
    e1(value) {
      this.$router.replace({
        name: "postingOffre",
        query: { index: this.$route.query.index, step: this.myStep(value) },
      });
    },
    "offre.description.value"() {
      this.valide(this.offre["description"].value, "step2", "description");
    },
    "$route.query.step"(value) {
      this.e1 = this.myE1(value);
    },
  },
  async beforeMount() {
    //this.removeAll();

    console.log("modeleoffre");
    console.log(this.offreModele);
    await this.getOffreCache();
    this.getAllTelephones();
    await this.getSelectedPhone1();
    if (this.offre.emails && this.offre.emails.value) {
      if (Object.keys(this.offre.emails.value).length == 0) {
        this.offre.emails.value = {
          ...this.offre.emails.value,
          ...{ [0]: this.user.email },
        };
      }
    } else {
      this.offre.emails = { value: { ...{}, ...{ [0]: this.user.email } } };
    }
  },
  /* beforeRouteUpdate() {
    console.log("mis à jour");
  },*/
  mounted() {
    // window.scrollTo(0, 0);
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
</style>
