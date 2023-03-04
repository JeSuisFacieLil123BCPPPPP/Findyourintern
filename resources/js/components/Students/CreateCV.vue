<template>
  <div class="w-100 h-100 row" style="margin-top: 100px; margin-bottom: 100px">
    <div style="background: #ffffff" class="offset-sm-1 col-sm-10 offset-sm-1">
      <b-steps type="is-bleue" :has-navigation="false" v-model="step">
        <b-step-item label="Détails" icon="account-key">
          <a-card>
            <a-divider class="label-text font-weight-bold text-lg-h6 text-h6"
              >Vos informations personnelles</a-divider
            >
            <div class="row">
              <b-field custom-class="is-medium" class="col-12 col-sm-6">
                <template #label>
                  <span style="color: red"></span
                  ><span style="font-size: 16px">Prénoms</span>
                </template>
                <b-input
                  v-model="userInfos.details.firstname"
                  type="text"
                  size="is-medium"
                >
                </b-input>
              </b-field>
              <b-field custom-class="is-medium" class="col-12 col-sm-6">
                <template #label>
                  <span style="color: red"></span><span style="font-size: 16px">Nom</span>
                </template>
                <b-input
                  v-model="userInfos.details.lastname"
                  type="text"
                  size="is-medium"
                >
                </b-input>
              </b-field>
            </div>
            <div class="row">
              <b-field class="col-12 col-md-6">
                <template #label>
                  <span style="font-size: 16px"> Adresse email</span>
                </template>
                <b-input v-model="userInfos.details.email" type="email" size="is-medium">
                </b-input>
              </b-field>
              <b-field class="col-12 col-md-6">
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
                      <b-button
                        style="height: 50px"
                        type="is-default"
                        :icon-right="active ? 'menu-up' : 'menu-down'"
                      >
                        <span style="font-size: 24px"> {{ selectedCountry.flag }}</span>
                      </b-button>
                      <p class="control" style="height: 50px">
                        <b-input
                          class="w-100 h-100"
                          size="is-medium"
                          style="border-color: #24855a; height: 50px"
                          disabled
                          :value="selectedCountry.translations.fra.common"
                        >
                        </b-input>
                      </p>
                    </b-field>
                  </template>

                  <template v-else #trigger>
                    <b-field>
                      <b-button
                        style="height: 50px"
                        type="is-default"
                        :icon-right="'menu-down'"
                      >
                        <span style="font-size: 16px; height: 50px"
                          >Sélectionnez un pays</span
                        >
                      </b-button>
                      <p class="control" style="height: 50px">
                        <b-input
                          class="w-100"
                          size="is-medium"
                          style="border-color: #24855a; height: 50px"
                          disabled
                          placeholder=""
                        >
                        </b-input>
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
            </div>
            <!-- <b-field class="col-12">
              <template #label>
                <span style="color: red"> </span
                ><span style="font-size: 16px" class="fw-bold">Numéro de tléphone</span>
              </template>
              <b-field>
                <b-dropdown aria-role="list" :scrollable="true" :max-height="200">
                  <template #trigger="{ active }">
                    <b-button
                      type="is-default"
                      :icon-right="active ? 'menu-up' : 'menu-down'"
                    >
                      <span style="font-size: 24px"> {{ offre.telephone.flag }}</span>

                      <span class="pays" v-if="offre.telephone.idd"
                        >{{ offre.telephone.idd.root
                        }}<span v-if="offre.telephone.idd.suffixes" class="pays">{{
                          offre.telephone.idd.suffixes[0]
                        }}</span></span
                      >
                    </b-button>
                  </template>

                  <b-dropdown-item
                    aria-role="listitem"
                    v-for="(item, name) in telephones"
                    :key="name"
                    style="font-size: 24px; color: black"
                    @click="offre.telephone = item"
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
                </b-dropdown>-->
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
                </b-select>
                <b-input
                  type="telephone"
                  placeholder="Numéro de téléphone"
                  v-model="userInfos.details.telephoneNum"
                ></b-input>
              </b-field>
            </b-field>-->
            <div class="footer" style="height: 150px">
              <div class="text-right">
                <b-button @click="step1">Continuer</b-button>
              </div>
            </div>
          </a-card>
        </b-step-item>
        <b-step-item label="Expérience professionnelles" icon="account">
          <a-card>
            <experience-1
              v-for="(exp, index) in userInfos.experiences"
              :experience="exp"
              :key="index"
              :index="index"
              :studentId="user.user.id"
              @delete-experience="deleteExperience"
            ></experience-1>
            <div>
              <v-btn
                @click="showModal('experiences')"
                color="#24855a"
                elevation="0"
                outlined
                class="my-2"
              >
                <span class="" style="color: #24855a"
                  >Ajouter une nouvelle expérience</span
                >
                <v-icon right light color="#24855a"> mdi-plus </v-icon>
              </v-btn>

              <modifier-cV
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
              </modifier-cV>
            </div>
            <div class="footer">
              <div class="text-right">
                <b-button @click="step = 2">Continuer</b-button>
              </div>
            </div>
          </a-card>
        </b-step-item>
        <b-step-item label="Formations" icon="account-plus">
          <b-button @click="step = 3"> addd </b-button>
        </b-step-item>
        <b-step-item label="Déclaration personnelle" icon="account-plus">
          <b-button @click="step = 0"> addd </b-button>
        </b-step-item>
      </b-steps>
    </div>
  </div>
</template>
<script>
import modifierCV from "./CVBuilder/ModifierCV.vue";
import getCountries from "../../mixin/getCountries";
import experience1 from "./CVBuilder/Experience.vue";
import formation from "./Formation.vue";
import competences from "./Competences.vue";
import langues from "./Langues.vue";
export default {
  components: {
    modifierCV,
    experience1,
    formation,
    competences,
    langues,
  },
  mixins: [getCountries],
  data() {
    return {
      step: 0,
      user: null,
      userInfos: {
        experiences: null,
        details: null,
      },
      initVisible: {
        preferences: false,
        experiences: false,
        formations: false,
        competences: false,
        langues: false,
        infosSupp: false,
      },
    };
  },
  methods: {
    async step1() {
      await this.addorUpdateDetailsStudent();
      this.step = 1;
    },
    async step2() {
      await this.addorUpdateDetailsStudent();
      this.step = 2;
    },
    // addorUpdateDetailsStudent
    async addorUpdateDetailsStudent() {
      await axios
        .post("/api/v1/cvbuilder/addorUpdateDetailsStudent", {
          infos: this.userInfos.details,
          id: this.user.user.id,
        })
        .then((response) => {
          console.log("yeeeeeeeeeeeh");
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    async getUserById() {
      let user = null;
      await axios
        .get("/api/v1/users/show/" + this.$route.params.userId)
        .then((response) => {
          console.log("response users show bla");
          console.log(response.data);
          this.user = response.data.user;
          user = {
            email: response.data.user.email,
            firstname: response.data.user.user.firstname,
            lastname: response.data.user.user.lastname,
            phone: response.data.user.phone,
          };
        })
        .catch((error) => {
          console.log(error.message);
        });
      //cvbuilder/getStudentCvBuilder
      await axios
        .get("/api/v1/cvbuilder/getStudentCvBuilder/" + this.user.user.id)
        .then((response) => {
          console.log("response");
          console.log(response.data);
          if (response.data.details) user = response.data.details;
        })
        .catch((error) => {
          console.log(error.message);
        });
      return user;
    }, //getExperiencesCvBuilder
    async getExperiences() {
      let experiences = [];
      await axios
        .get("/api/v1/cvbuilder/getExperiencesCvBuilder/" + this.user.user.id)
        .then((response) => {
          console.log("response");
          console.log(response.data);
          experiences = response.data.experiences;
        })
        .catch((error) => {
          console.log(error.message);
        });
      return experiences;
    },
    valide() {},
    addExperience(experiences) {
      /* this.userInfos.experiences.push(newExperience);
      console.log("new exp");
      console.log(newExperience);*/
      if (experiences != null) {
        this.userInfos.experiences = experiences;
      }
    },
    addExperience(newExperience) {
      this.userInfos.experiences.push(newExperience);
      console.log("new exp");
      console.log(newExperience);
    },
    updateExperience(updateExperience) {
      let ele = this.userInfos.experiences.find((exp) => {
        return exp.id == updateExperience.id;
      });
      console.log("update index");
      console.log(ele);
    },
    deleteExperience(experiences) {
      /*let index = this.userInfos.experiences.findIndex((exp) => {
        return exp.id == deleteExperience.id;
      });*/

      // this.userInfos.experiences.splice(index, 1);
      this.userInfos.experiences = experiences;
    },

    addFormation(newFormation) {
      this.userInfos.formations.push(newFormation);
      console.log("new exp");
      console.log(newFormation);
    },
    updateFormation(updateFormation) {
      let ele = this.userInfos.formations.find((exp) => {
        return exp.id == updateFormation.id;
      });
      console.log("update index");
      console.log(ele);
    },
    deleteFormation(deleteFormation) {
      let index = this.userInfos.formations.findIndex((exp) => {
        return exp.id == deleteFormation.id;
      });

      this.userInfos.formations.splice(index, 1);
    },
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
  },

  async beforeMount() {
    this.userInfos.details = await this.getUserById();
    this.userInfos.experiences = await this.getExperiences();
    await this.getAllCountries();
    if (this.userInfos.details && this.userInfos.details.pays)
      await this.getSelectedCountry(this.userInfos.details.pays);
  },
};
</script>

<style scoped></style>
