<template>
  <div>
    <template slot="title">
      <v-card-title>
        <div v-if="section == 'preferences'">Préférences</div>
        <span
          class="fw-bold label"
          style="font-size: 20px"
          v-else-if="section == 'experiences'"
          >Experience</span
        >
        <div v-else-if="section == 'formations'">Formation</div>
        <div v-else-if="section == 'competences'">Compétences</div>
        <div v-else-if="section == 'langues'">Langues</div>
        <div v-else-if="section == 'infosSupp'">Informations supplémentaires</div>
      </v-card-title>
    </template>
    <div v-if="section == 'donnees-pers'">Données</div>
    <div v-else-if="section == 'preferences'">
      <b-field custom-class="is-medium" class="form-label" :type="type.lieu">
        <template #label>
          <span style="color: red"> </span
          ><span style="font-size: 16px">Type de lieu de travail</span>
        </template>
        <b-select
          size="is-medium"
          placeholder=""
          v-model="userInfos.preferences.lieu"
          expanded
        >
          <option :value="lieu.name" v-for="(lieu, index) in lieux" :key="index">
            {{ lieu.name }}
          </option>
        </b-select>
      </b-field>
      <span style="display: block; height: 10px; color: #f14668; font-size: 0.75rem">{{
        message.preferences.lieu
      }}</span>
      <b-field
        custom-class="is-medium"
        class="form-label"
        :type="type.preferences"
        expanded
        v-if="userInfos.preferences.lieu == 'En personne(lieu précis)'"
      >
        <template #label>
          <span style="color: red"></span
          ><span style="font-size: 16px">Ville ou zone du lieu :</span>
        </template>
        <b-input
          type="text"
          size="is-medium"
          :value="userInfos.preferences.zone"
          @input="valide($event, 'preferences', 'zone')"
        >
        </b-input>
      </b-field>
      <span style="display: block; height: 10px; color: #f14668; font-size: 0.75rem">{{
        message.preferences.zone
      }}</span>
      <vs-alert
        class="my-2"
        v-if="userInfos.preferences.lieu == 'Télétravail'"
        :closable="false"
        icon="info"
      >
        Nous indiquerons « Télétravail » comme lieu du poste et nous le promouverons
        auprès de personnes à la recherche de travail à distance au sein du pays.
      </vs-alert>
      <b-field expanded custom-class="is-medium" class="form-label" :type="type.secteurs">
        <template #label>
          <span style="color: red"> </span
          ><span style="font-size: 16px">Secteur d'activité</span>
        </template>

        <b-select
          size="is-medium"
          placeholder="Secteur d'activité"
          v-model="userInfos.preferences.secteurs"
          expanded
        >
          <option value="">Sélectionne un secteur d'activité</option>
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
        >{{ message.preferences.secteurs }}</span
      >
    </div>
    <div v-else-if="section == 'competences'">
      <competences
        :competences="userInfos.competences"
        @delete-competence="deleteCompetence"
      >
      </competences>
      <a-divider></a-divider>
      <div>
        <b-field
          custom-class="is-medium"
          class="form-label"
          :type="type.competence.nameC"
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Nouvelle Compétence</span>
          </template>
          <b-input
            type="text"
            size="is-medium"
            :value="userInfos.competence.nameC"
            @input="valide($event, 'competence', 'nameC')"
          >
          </b-input>
        </b-field>
      </div>
    </div>
    <div v-else-if="section == 'formations'">
      <div>
        <b-field
          custom-class="is-medium"
          class="form-label"
          :type="type.formation.institution"
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold"
              >Intitution de la formation</span
            >
          </template>
          <b-input
            type="text"
            size="is-medium"
            :value="userInfos.formation.institution"
            @input="valide($event, 'formation', 'institution')"
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
          >{{ message.formation.institution }}</span
        >
        <b-field
          expanded
          custom-class="is-medium"
          class="form-label"
          :type="type.formation.type"
        >
          <template #label>
            <span style="font-size: 16px">Type de de la formation</span>
            <b-tooltip
              position="is-right"
              type="is-bleue"
              label="Il s'agit du type de poste de votre offre"
            >
              <v-icon small style="color: #24855a">mdi-information </v-icon>
            </b-tooltip>
          </template>
          <b-select
            size="is-medium"
            placeholder="Type"
            :value="userInfos.formation.type"
            @input="valide($event, 'formation', 'type')"
            expanded
          >
            <option value="">Sélectionner une option</option>
            <option value="universitaire">Formation universitaire</option>
            <option value="specifique">Atelier ou formation spécifique</option>
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
          >{{ message.formation.type }}</span
        >
        <b-field
          v-if="userInfos.formation.type == 'universitaire'"
          custom-class="is-medium"
          class="form-label"
          :type="type.formation.diplome"
          vertical
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Dimplome</span>
          </template>
          <b-input
            type="text"
            size="is-medium"
            :value="userInfos.formation.diplome"
            @input="valide($event, 'formation', 'diplome')"
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
          >{{ message.formation.diplome }}</span
        >
        <b-field
          v-if="userInfos.formation.type == 'specifique'"
          custom-class="is-medium"
          class="form-label"
          :type="type.formation.theme"
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Thème de la formation</span>
          </template>
          <b-input
            type="text"
            size="is-medium"
            :value="userInfos.formation.theme"
            @input="valide($event, 'formation', 'theme')"
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
          >{{ message.formation.diplome }}</span
        >

        <b-field custom-class="is-medium" :type="type.formation.date_deb" expanded>
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Date de début</span>
          </template>
          <b-datepicker
            :max-date="new Date()"
            ref="date_deb"
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'formation', 'date_deb')"
            :value="userInfos.formation.date_deb"
            v-if="action == 'create'"
            size="is-medium"
          >
          </b-datepicker>
          <b-datepicker
            :max-date="new Date()"
            ref="date_deb"
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'formation', 'date_deb')"
            :value="new Date(userInfos.formation.date_deb)"
            v-else
            size="is-medium"
          >
          </b-datepicker>
          <b-button
            class="h-100"
            @click="$refs.date_deb.toggle()"
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
            margin-bottom: 3px;
          "
          >{{ message.formation.date_deb }}</span
        >
        <b-field
          custom-class="is-medium"
          class="form-label"
          :type="type.formation.date_fin"
          expanded
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Date de fin</span>
          </template>
          <b-datepicker
            :max-date="new Date()"
            ref="date_fin"
            v-if="action == 'create'"
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'formation', 'date_fin')"
            :value="userInfos.formation.date_fin"
            size="is-medium"
          >
          </b-datepicker>
          <b-datepicker
            :max-date="new Date()"
            ref="date_fin"
            v-else
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'formation', 'date_fin')"
            :value="new Date(userInfos.formation.date_fin)"
            size="is-medium"
          >
          </b-datepicker>
          <b-button
            class="h-100"
            @click="$refs.date_fin.toggle()"
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
          >{{ message.formation.date_fin }}</span
        >
      </div>
    </div>
    <div v-else-if="section == 'experiences'">
      <a-card class="offset-2 col-8 offset-2">
        <b-field
          custom-class="is-medium"
          class="form-label"
          :type="type.experience.poste"
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Intitulé du poste</span>
          </template>
          <b-input
            type="text"
            size="is-medium"
            :value="userInfos.experience.poste"
            @input="valide($event, 'experience', 'poste')"
            ref="poste"
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
          >{{ message.experience.poste }}</span
        >
        <b-field
          ref="company_name"
          custom-class="is-medium"
          class="form-label"
          :type="type.experience.company_name"
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Structure</span>
          </template>
          <b-input
            type="text"
            size="is-medium"
            :value="userInfos.experience.company_name"
            @input="valide($event, 'experience', 'company_name')"
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
          >{{ message.experience.company_name }}</span
        >

        <b-field custom-class="is-medium" :type="type.experience.date_deb" expanded>
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Date de début</span>
          </template>
          <b-datepicker
            :max-date="new Date()"
            ref="date_deb"
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'experience', 'date_deb')"
            :value="userInfos.experience.date_deb"
            v-if="action == 'create'"
            size="is-medium"
          >
          </b-datepicker>
          <b-datepicker
            :max-date="new Date()"
            ref="date_deb"
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'experience', 'date_deb')"
            :value="new Date(userInfos.experience.date_deb)"
            v-else
            size="is-medium"
          >
          </b-datepicker>
          <b-button
            class="h-100"
            @click="$refs.date_deb.toggle()"
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
            margin-bottom: 3px;
          "
          >{{ message.experience.date_deb }}</span
        >
        <!-- <b-field custom-class="is-small" class="form-label">
              <b-checkbox
                v-model="userInfos.experience.status"
                type="is-bleue"
                size="is-small"
              >
                C'est mon expérience actuelle</b-checkbox
              >
            </b-field>-->

        <b-field
          custom-class="is-medium"
          class="form-label"
          :type="type.experience.date_fin"
          expanded
        >
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold">Date de fin</span>
          </template>
          <b-datepicker
            :max-date="new Date()"
            ref="date_fin"
            v-if="action == 'create'"
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'experience', 'date_fin')"
            :value="userInfos.experience.date_fin"
            size="is-medium"
          >
          </b-datepicker>
          <b-datepicker
            :max-date="new Date()"
            ref="date_fin"
            v-else
            expanded
            placeholder="Sélectionnez une date"
            @input="valide($event, 'experience', 'date_fin')"
            :value="new Date(userInfos.experience.date_fin)"
            size="is-medium"
          >
          </b-datepicker>
          <b-button
            class="h-100"
            @click="$refs.date_fin.toggle()"
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
          >{{ message.experience.date_fin }}</span
        >

        <b-field custom-class="is-medium" class="form-label">
          <template #label>
            <span style="color: red"> </span
            ><span style="font-size: 16px" class="fw-bold"
              >Description des responsabilités</span
            >
          </template>
          <b-input
            size="is-medium"
            :value="userInfos.experience.description"
            @input="valide($event, 'experience', 'description')"
            maxlength="200"
            type="textarea"
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
          >{{
        }}</span>
      </a-card>
    </div>
    <div v-else-if="section == 'langues'">
      <div class="mx-2">
        <div class="row">
          <div class="col-md-6">
            <b-field label="Ajouter au plus cinq(5) langues" size="is-medium"> </b-field>
          </div>
          <div class="d-none d-lg-block col-md-6">
            <b-field label="Niveau" size="is-medium"> </b-field>
          </div>
        </div>
        <div class="row" v-for="(langue, index) in userInfos.langues" :key="index">
          <div class="col-lg-6">
            <b-select
              expanded
              @input="valideLangues($event, index, 'name_langue')"
              :value="langue.name_langue"
            >
              <option value="Français">Français</option>
              <option value="Anglais">Anglais</option>
            </b-select>
            <span>{{ message.langues[index] }}</span>
          </div>
          <div class="col-lg-6">
            <b-field expanded>
              <template #label>
                <span class="d-block d-sm-none">Niveau</span>
              </template>
              <b-radio
                type="is-bleue"
                v-model="userInfos.langues[index].niveau"
                :name="'niveau' + index"
                :native-value="1"
                >Débutant</b-radio
              >
              <b-radio
                type="is-bleue"
                v-model="userInfos.langues[index].niveau"
                :name="'niveau' + index"
                :native-value="2"
              >
                Intermédiaire
              </b-radio>
              <b-radio
                type="is-bleue"
                v-model="userInfos.langues[index].niveau"
                :name="'niveau' + index"
                :native-value="3"
                >Excellent</b-radio
              >
              <v-btn class="" color="#f44336" outlined @click="removeLangue(langue)">
                <v-icon light color="#f44336"> mdi-delete</v-icon>
              </v-btn>
            </b-field>
          </div>
        </div>
        <div class="row col-3">
          <v-btn @click="addLigneLangue" color="#24855a" elevation="0" outlined>
            <span class="" style="color: #24855a">Ajouter</span>
            <v-icon right light color="#24855a"> mdi-plus</v-icon>
          </v-btn>
        </div>
      </div>
    </div>
    <div v-else-if="section == 'infosSupp'">
      <b-field>
        <template #label>
          <span style="color: red"> </span
          ><span style="font-size: 16px" class="fw-bold"> Pays de résidence</span>
        </template>
        <b-dropdown
          v-model="selectedCountry"
          aria-role="list"
          :scrollable="true"
          :max-height="200"
        >
          <template v-if="selectedCountry" #trigger="{ active }">
            <b-field>
              <b-button type="is-default" :icon-right="active ? 'menu-up' : 'menu-down'">
                <span style="font-size: 24px"> {{ selectedCountry.flag }}</span>
              </b-button>
              <p class="control">
                <b-input
                  style="border-color: #24855a"
                  disabled
                  :value="selectedCountry.translations.fra.common"
                >
                </b-input>
              </p>
            </b-field>
          </template>

          <template v-else #trigger>
            <b-field>
              <b-button type="is-default" :icon-right="'menu-down'">
                <span style="font-size: 16px">Sélectionnez un pays</span>
              </b-button>
              <p class="control">
                <b-input style="border-color: #24855a" disabled placeholder=""> </b-input>
              </p>
            </b-field>
          </template>

          <b-dropdown-item
            aria-role="listitem"
            @click="selectedCountry = item"
            v-for="(item, name) in countries"
            :key="name"
            style="font-size: 24px; color: black"
            class="text-captation"
          >
            <span style="font-size: 24px"> {{ item.flag }}</span
            ><span style="font-size: 16px" class="ms-2 pays">{{
              item.translations.fra.common
            }}</span>

            <span class="pays" v-if="item.idd.root">{{ item.idd.root + "" }}</span
            ><span v-if="item.idd.suffixes" class="pays">{{
              item.idd.suffixes[0]
            }}</span></b-dropdown-item
          >
        </b-dropdown>
      </b-field>
      <b-field custom-class="is-medium" class="form-label">
        <template #label>
          <span style="color: red"> </span
          ><span style="font-size: 16px" class="fw-bold">Ville</span>
        </template>
        <b-input type="text" size="is-medium" :value="userInfos.infosSupp.ville">
        </b-input>
      </b-field>
      <b-field
        custom-class="is-medium"
        class="form-label"
        :type="type.infosSupp.date_nais"
        expanded
      >
        <template #label>
          <span style="color: red"> </span
          ><span style="font-size: 16px" class="fw-bold">Date de naissance</span>
        </template>
        <b-datepicker
          :max-date="new Date('12/01/2005')"
          ref="date_nais"
          expanded
          placeholder="Sélectionnez une date"
          v-model="userInfos.infosSupp.date_nais"
          size="is-medium"
        >
        </b-datepicker>
        <b-button
          class="h-100"
          @click="$refs.date_nais.toggle()"
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
        >{{ message.infosSupp.date_nais }}</span
      >
      <b-field custom-class="is-medium" class="form-label" :type="type.infosSupp.genre">
        <template #label>
          <span style="color: red"> </span><span style="font-size: 16px"> Genre</span>
        </template>
        <b-select
          icon="gender"
          size="is-medium"
          placeholder=""
          v-model="userInfos.infosSupp.genre"
          expanded
        >
          <option value="">Sélectionner une option</option>
          <option value="feminin">Féminin</option>
          <option value="masculin">Masculin</option>
        </b-select>
      </b-field>
      <b-field custom-class="is-medium" class="form-label" :type="type.infosSupp.genre">
        <template #label>
          <span style="color: red"> </span
          ><span style="font-size: 16px">Déclaration personnelle</span>
        </template>
        <b-input type="textarea" maxlength="300" v-model="userInfos.infosSupp.decla_pers">
        </b-input>
      </b-field>
    </div>
    <div class="footer">
      <div>
        <b-field horizontal v-if="section == 'experiences' && action == 'create'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer"
              type="is-bleue"
              @click="operations('experience', 'create')"
              :loading="isLoading"
            />
          </p>
        </b-field>
        <b-field horizontal v-if="section == 'experiences' && action == 'update'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer les modifications"
              type="is-bleue"
              @click="operations('experience', 'update')"
              :loading="isLoading"
            />
          </p>
        </b-field>

        <b-field horizontal v-if="section == 'formations' && action == 'create'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer"
              type="is-bleue"
              @click="operations('formation', 'create')"
              :loading="isLoading"
            />
          </p>
        </b-field>
        <b-field horizontal v-if="section == 'competences' && action == 'create'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer"
              type="is-bleue"
              @click="operations('competence', 'create')"
              :loading="isLoading"
            />
          </p>
        </b-field>
        <b-field horizontal v-if="section == 'langues' && action == 'create'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer la langue"
              type="is-bleue"
              @click="operation1('langues', 'create')"
              :loading="isLoading"
            />
          </p>
        </b-field>
        <b-field horizontal v-if="section == 'formations' && action == 'update'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer les modifications"
              type="is-bleue"
              @click="operations('formation', 'update')"
              :loading="isLoading"
            />
          </p>
        </b-field>
        <b-field horizontal v-if="section == 'preferences' && action == 'update'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer les modifications"
              type="is-bleue"
              @click="operation2()"
              :loading="isLoading"
            />
          </p>
        </b-field>
        <b-field horizontal v-if="section == 'infosSupp' && action == 'update'"
          ><!-- Label left empty for spacing -->
          <p class="control">
            <b-button label="Annuler" type="is-default" />
            <b-button
              label="Enregistrer les modifications"
              type="is-bleue"
              @click="updateOrCreateInfosSupp"
              :loading="isLoading"
            />
          </p>
        </b-field>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import competences from "../Competences.vue";
import Geonames from "geonames.js"; /* es module */ /* commonJS */
const geonames = Geonames({
  username: "nathewill",
  lan: "fr",
  encoding: "JSON",
});
import getCountries from "../../../mixin/getCountries";
export default {
  mixins: [getCountries],
  components: { competences },
  props: {
    initVisible: {
      type: Boolean,
      required: true,
      default: false,
    },
    section: {
      type: String,
      required: true,
      //default: false,
    },
    action: {
      type: String,
      required: false,
      default: "create",
    },
    obj: {
      type: Object,
      required: false,
      default: () => {
        return {};
      },
    },
    width: {
      type: [String, Number],
      required: false,
      default: 520,
    },
  },
  data() {
    return {
      userInfos: { ...this.obj },
      isLoading: false,
      isLoadingDeb: false,
      lieux: [{ name: "Télétravail" }, { name: "En personne(lieu précis)" }],
      secteurs: [
        { name: "Informatique,Telecom,Internet" },
        { name: "Energie, Mines, Matière première" },
        { name: "Banque, Assurance, Finance" },
      ],
      // typeForm:
      message: {
        experience: {
          poste: "",
          company_name: "",
          date_deb: "",
          date_fin: "",
        },
        formation: {
          institution: "",
          date_deb: "",
          date_fin: "",
          status: "",
          theme: "",
          type: "",
        },
        competence: {
          nameC: "",
        },
        langues: {},
        preferences: {
          lieu: "",
          zone: "",
          secteurs: "",
        },
        infosSupp: {
          pays: "",
          ville: "",
          date_nais: "",
          decla_pers: "",
          genre: "",
        },
      },
      type: {
        experience: {
          poste: "",
          company_name: "",
          date_deb: "",
          date_fin: "",
        },
        formation: {
          institution: "",
          date_deb: "",
          date_fin: "",
          status: "",
          theme: "",
          type: "",
        },
        competence: {
          nameC: "",
        },
        langues: {},
        preferences: {
          lieu: "",
          zone: "",
          secteurs: "",
        },
        infosSupp: {
          pays: "",
          ville: "",
          date_nais: "",
          decla_pers: "",
          genre: "",
        },
      },
      // visible: true,
      visible: this.initVisible,
      confirmLoading: false,
      errors: {},
      selectedCountry: null,
      countries: null,
      town: null,
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  watch: {
    initVisible(val) {
      console.log("moddddddd");
      this.visible = val;
    },
  },
  methods: {
    maxLangue() {
      if (this.userInfos.langues.length < 5) {
        return true;
      } else if (this.userInfos.langues.length >= 5) {
        return false;
      }
    },
    messagesTexts(position, field) {
      let message = "";
      switch (field) {
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
          if (this.userInfos[position].type == "universitaire")
            message = "Veuillez renseigner le diplome";
          break;
        case "theme":
          if (this.userInfos[position].type == "specifique")
            message = "Veuillez renseigner le theme de la formation";
          break;
        case "name_langue":
          message = "Veuillez renseigner la compétence";
          break;
        /* case "lieu":
            message = "Veuillez renseigner le type de lieu";
            break;*/
        case "zone":
          if (this.userInfos.preferences["lieu"] != null) {
            if (this.userInfos.preferences["lieu"] == "En personne(lieu précis)") {
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
    verifBasic(position, field) {
      if (this.userInfos[position][field] == null) {
        this.type[position][field] = "is-danger";
        this.message[position][field] = this.messagesTexts(position, field);
      } else if (this.userInfos[position][field].length == 0) {
        this.type[position][field] = "is-danger";
        this.message[position][field] = this.messagesTexts(position, field);
      } else {
        this.type[position][field] = "is-success";
        this.message[position][field] = "";
        this.removeError(field);
      }
    },
    valideLangues(value, index, field) {
      this.userInfos.langues[index].name_langue = value;
      if (this.userInfos.langues[index].name_langue.length == 0) {
        this.message.langues = {
          ...this.message.langues,
          ...{
            [index]: "Veuillez renseigner la compétence",
          },
        };
        console.log("messages");
        console.log({
          ...this.message.langues,
          ...{
            [index]: "Veuillez renseigner la compétence",
          },
        });

        this.type.langues = { ...this.type.langues, ...{ [index]: "is-danger" } };
        // this.message.langues[index][field] = "Veuillez renseigner la compétence";
      } else {
        this.message.langues = {
          ...this.message.langues,
          ...{
            [index]: "",
          },
        };

        this.type.langues = { ...this.type.langues, ...{ [index]: "is-success" } };
        this.removeError(index);
      }
    },
    valide(value, position, field) {
      //    console.log("field" + field);
      console.log("this.userInfos[position][field]");
      console.log(this.userInfos[position][field]);
      this.userInfos[position][field] = value; // ? value : this.userInfos[position][field];
      console.log(this.userInfos);
      if (field != "date_deb" && field != "date_fin" && field != "description") {
        this.verifBasic(position, field);
      } else {
        this.verifBasic(position, field);
        if (
          field == "date_fin" &&
          this.userInfos[position][field] != null &&
          this.userInfos[position]["date_deb"] != null
        ) {
          if (this.userInfos[position][field] < this.userInfos[position]["date_deb"]) {
            this.type[position][field] = "is-danger";
            this.message[position][field] =
              "La date de fin doit être supérieur à la date de début";
          }
        } else if (
          field == "date_deb" &&
          this.userInfos[position][field].length != null &&
          this.userInfos[position]["date_fin"].length != null
        ) {
          if (this.userInfos[position][field] > this.userInfos[position]["date_fin"]) {
            this.type[position][field] = "is-danger";
            this.message[position][field] =
              "La date de début doit être inférieur à la date de fin";
          }
        }
      }
      //}
    },
    errorSearch(obj) {
      for (const [key, value] of Object.entries(obj)) {
        if (value.length != 0) {
          this.errors = { ...this.errors, ...{ [key]: value } };
          console.log(this.errors);
        }
      }
    },
    removeError(text) {
      for (const [key, value] of Object.entries(this.errors)) {
        if (key == text && Object.keys(this.errors).length != 0) {
          console.log(this.errors);
          Reflect.deleteProperty(this.errors, key);
        }
      }
    },
    async removeLangue(langue) {
      let id = langue.id;
      if (id) {
        await this.deleteLangueApi(langue);
      }
      const index = this.userInfos.langues.findIndex((lang) => {
        return lang.id == langue.id;
      });
      this.userInfos.langues.splice(index, 1);
      this.$emit("delete-langue", langue);
    },
    async deleteLangueApi(langue) {
      await axios
        .delete("/api/v1/langues/" + langue.id)
        .then((response) => {
          console.log("res");
          console.log(response);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    async addExperienceApi() {
      let experiences = null;
      this.isLoading = true;
      console.log("this.userInfos qsdfghj");
      console.log(this.user);
      await axios
        .post("/api/v1/cvbuilder/addWorkExperience", {
          experience: this.userInfos.experience,
          ...{ id: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          experiences = response.data.experiences;
          this.$vs.notify({
            color: "success",
            title: "SUCCES",
            text: "Experience ajoutée avec succès",
          });
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return experiences;
    },
    async updateExperienceApi() {
      let newExperience = null;
      this.isLoading = true;
      console.log();
      await axios
        .put("/api/v1/experiences/" + this.userInfos.experience.id, {
          ...this.userInfos.experience,
          ...{ studentId: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newExperience = response.data.Experience;
          this.$vs.notify({
            color: "success",
            title: "SUCCES",
            text: "Experience mis à jour avec succès",
          });
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newExperience;
    },
    async addFormationApi() {
      let newFormation = null;
      this.isLoading = true;
      await axios
        .post("/api/v1/formations", {
          ...this.userInfos.formation,
          ...{ studentId: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newFormation = response.data.Formation;
          this.$vs.notify({
            color: "success",
            title: "SUCCES",
            text: "formation ajoutée avec succès",
          });
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newFormation;
    },
    async updateFormationApi() {
      let newFormation = null;
      this.isLoading = true;
      console.log();
      await axios
        .put("/api/v1/formations/" + this.userInfos.formation.id, {
          ...this.userInfos.formation,
          ...{ studentId: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newFormation = response.data.formation;
          this.$vs.notify({
            color: "success",
            title: "SUCCES",
            text: "formation mis à jour avec succès",
          });
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newFormation;
    },
    async addCompetenceApi() {
      let newCompetence = null;
      this.isLoading = true;
      await axios
        .post("/api/v1/competences", {
          description: this.userInfos.competence.nameC,
          studentId: this.user.user.id,
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newCompetence = response.data.Competence;
          /*this.$vs.notify({
              color: "success",
              title: "SUCCES",
              text: "Competence ajoutée avec succès",
            });*/
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newCompetence;
    },
    async addLangueApi(langue) {
      let newLangue = null;
      this.isLoading = true;

      await axios
        .post("/api/v1/langues/updateOrCreate", {
          ...{ ...langue },
          ...{ student_id: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newLangue = response.data.Langue;
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newLangue;
    },
    async updatePreferencesApi(preference) {
      let newPreferences = null;
      this.isLoading = true;
      if (preference.lieu == "Télétravail") {
        preference.zone = null;
      }
      await axios
        .post("/api/v1/prefsPoste/updateOrCreate", {
          ...{ ...preference },
          ...{ student_id: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newPreferences = response.data.Preferences;
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newPreferences;
    },
    async updateOrCreateInfosSupp() {
      let newInfosSupp = null;
      this.isLoading = true;
      await axios
        .post("/api/v1/infosSupp/updateOrCreate", {
          ...{ ...this.userInfos.infosSupp },
          ...{ student_id: this.user.user.id },
          ...{
            pays: this.selectedCountry
              ? this.selectedCountry.translations.fra.common
              : "",
          },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newInfosSupp = response.data.InfosSupp;
          this.$emit("add-update-infos-supp", newInfosSupp);
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      //  if (newInfosSupp != null) {
      //  }else{

      //}
    },
    deleteCompetence(comp) {
      const index = this.userInfos.competences.findIndex((competence) => {
        return competence.id == comp.id;
      });
      this.userInfos.competences.splice(index, 1);
    },
    addLigneLangue() {
      console.log("actine valeur");
      console.log(this.userInfos.langues);
      if (this.userInfos.langues.length < 5) {
        this.userInfos.langues.push({
          name_langue: "",
          niveau: 1,
        });
      }
    },
    async operation1(position, action) {
      console.log("operation 1");
      for (let i = 0; i < this.userInfos.langues.length; i++) {
        console.log("index");
        console.log(i);
        console.log(this.userInfos.langues[i]);
        this.valideLangues(this.userInfos.langues[i].name_langue, i, "name_langue");
      }

      for (const [key, value] of Object.entries(this.message.langues)) {
        if (value.length != 0) {
          this.errors = { ...this.errors, ...{ [key]: value } };
          console.log("errors");
          console.log(this.errors);
        }
      }
      if (Object.keys(this.errors).length == 0) {
        if (position == "langues" && action == "create") {
          let newLangues = [];
          this.userInfos.langues.forEach(async (langue) => {
            let newLangue = await this.addLangueApi(langue);
            newLangues.push(newLangue);
            console.log(newLangue);
          });
          if (newLangues.length != 0) {
            this.$emit("add-update-langue", newLangues);
          }
          this.handleCancel();
        }
      }
    },
    async operations(position, action) {
      for (const [key, value] of Object.entries(this.userInfos[position])) {
        console.log("key" + key + "value" + value);
        this.valide(value, position, key);
      }
      this.errorSearch(this.message[position]);
      if (Object.keys(this.errors).length == 0) {
        if (position == "experience" && action == "create") {
          let experiences = await this.addExperienceApi();
          this.$emit("add-experience", experiences);
          // this.handleCancel();
        } else if (position == "experience" && action == "update") {
          let newExperience = await this.updateExperienceApi();
          this.$emit("update-experience", newExperience);
          this.handleCancel();
        } else if (position == "formation" && action == "create") {
          let newFormation = await this.addFormationApi();
          this.$emit("add-formation", newFormation);
          this.handleCancel();
        } else if (position == "formation" && action == "update") {
          let newFormation = await this.updateFormationApi();
          this.$emit("update-formation", newFormation);
          this.handleCancel();
        } else if (position == "competence") {
          let newCompetence = await this.addCompetenceApi();
          this.userInfos.competence.nameC = "";
          this.$emit("add-competence", newCompetence);
          this.handleCancel();
        } else if (position == "preferences") {
        }
      }
    },
    async operation2() {
      let preferences = await this.updatePreferencesApi(this.userInfos.preferences);
      //this.userInfos.competence.nameC = "";
      this.$emit("update-preferences", preferences);
      this.handleCancel();
    },

    handleOk(e) {
      this.ModalText = "The modal will be closed after two seconds";
      this.confirmLoading = true;
      setTimeout(() => {
        this.visible = false;
        this.confirmLoading = false;
      }, 2000);
    },
    handleCancel(e) {
      console.log("Clicked cancel button");
      this.visible = false;
      this.userInfos[this.position] = null;
      this.$emit("handle-cancel", this.section);
    },
    sendEnvent() {
      this.$emit("change-sidebar", "Je resterai ton amie");
    },
    async test() {
      //const countries = await geonames.countryInfo({}); //get continents
      //const name=this.
      let genomeId = 0;
      //get continents
      const countries = await geonames.countryInfo({}); //get continents
      const states = await geonames.children({
        geonameId: countries.geonames[0].geonameId,
      });
      await geonames
        .children({ geonameId: states.geonames[0].geonameId })
        /* await geonames
          .countryInfo({ country: "Andorre" })*/
        .then((data) => {
          console.log("villes");
          console.log(data);
          let pays = data.geonames;
          let paysIndex = data.geonames.findIndex((ele) => {
            return (ele.countryName = "Andorre");
          });
          console.log("paysId");
          console.log(data.geonames[paysIndex].geonameId);
          genomeId = data.geonames[paysIndex].geonameId;
          // this.offre.telephone = data.data[0];
        })
        .catch((error) => console.error(error));

      return genomeId;
    },
    async test1(genomeId) {
      await geonames
        .children({ genomeId: genomeId })
        .then((data) => {
          console.log("regions");
          console.log(data);
        })
        .catch((error) => console.error(error));
    },
  },
  async beforeMount() {
    this.isLoadingDeb = true;
    if (this.section == "infosSupp") {
      console.log("present");
      await this.getAllCountries();
      if (this.userInfos.infosSupp && this.userInfos.infosSupp.pays)
        await this.getSelectedCountry(this.userInfos.infosSupp.pays);
    }
    this.isLoadingDeb = false;
  },
  async created() {},
};
</script>

<style scoped></style>
