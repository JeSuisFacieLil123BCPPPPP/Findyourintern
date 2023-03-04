<template>
  <v-app class="mx-auto">
    <a-card :loading="loading">
      <v-row>
        <!-- <v-col cols="4">
          <v-card fab dark large color="cyan">
            <v-card-title fab dark large color="pink"></v-card-title>
            <v-card-text
              ><v-icon dark :size="80"> mdi-account-multiple </v-icon
              ><span size="100" class="fw-bolder">{{ usersconnected }}</span></v-card-text
            >
            <v-card-subtitle color="indigo"
              ><v-sparkline
                :value="value"
                :gradient="gradient"
                :smooth="radius || false"
                :padding="padding"
                :line-width="width"
                :stroke-linecap="lineCap"
                :gradient-direction="gradientDirection"
                :fill="fill"
                :type="type"
                :auto-line-width="autoLineWidth"
                auto-draw
              ></v-sparkline>
            </v-card-subtitle>
          </v-card>
        </v-col>-->
        <v-col cols="3">
          <v-card fab dark large color="indigo">
            <v-card-title fab dark large color="pink"></v-card-title>
            <v-card-text
              ><v-icon dark :size="80">mdi-account-multiple</v-icon></v-card-text
            >
            <v-card-subtitle color="indigo"
              ><span class="title-card">Le nombre d'utilisateur total connecté : </span
              ><span class="title-card">{{ usersconnected }}</span>
            </v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card fab dark large color="indigo">
            <v-card-title fab dark large color="pink"></v-card-title>
            <v-card-text
              ><v-icon dark :size="80">mdi-account-multiple</v-icon></v-card-text
            >
            <v-card-subtitle color="indigo"
              ><span class="title-card">Le nombre d'étudiants total connecté : </span
              ><span class="title-card">{{ studentsconnected }}</span>
            </v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card fab large>
            <v-card-title fab dark large color="pink"></v-card-title>
            <v-card-text
              ><v-icon dark :size="80" color="indigo"
                >mdi-account-multiple</v-icon
              ></v-card-text
            >
            <v-card-subtitle
              ><span class="title-card">Le nombre d'entreprise total connecté : </span
              ><span class="title-card">{{ companiesconnected }}</span>
            </v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card fab large>
            <v-card-title fab dark large></v-card-title>
            <v-card-text
              ><v-icon dark :size="80" color="indigo"
                >mdi-account-multiple</v-icon
              ></v-card-text
            >
            <v-card-subtitle color="indigo"
              ><span class="title-card">Le nombre d'aministrateur total connecté : </span
              ><span class="title-card">{{ adminsconnected }}</span>
            </v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card fab dark large color="indigo">
            <v-card-title fab dark large color="pink"></v-card-title>
            <v-card-text
              ><v-icon dark :size="80">mdi-account-multiple</v-icon></v-card-text
            >
            <v-card-subtitle color="indigo"
              ><span class="title-card">Le nombre d'utilisateur total connecté : </span
              ><span class="title-card">{{ usersconnected }}</span>
            </v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="4">
          <!-- <v-card fab dark large color="pink">
            <v-card-title fab dark large color="pink"></v-card-title>
            <v-card-text><v-icon dark :size="80"> mdi-pencil </v-icon></v-card-text>
            <v-card-subtitle color="indigo">Le nombre de </v-card-subtitle>
          </v-card>-->
          <v-card class="mt-4 mx-auto" max-width="400">
            <v-sheet
              class="v-sheet--offset mx-auto"
              color="cyan"
              elevation="12"
              max-width="calc(100% - 32px)"
            >
              <v-sparkline
                :labels="labels"
                :value="value"
                color="white"
                line-width="2"
                padding="16"
                auto-draw
              ></v-sparkline>
            </v-sheet>

            <v-card-text class="pt-0">
              <div class="text-h6 font-weight-light mb-2">User Registrations</div>
              <div class="subheading font-weight-light grey--text">
                Last Campaign Performance
              </div>
              <v-divider class="my-2"></v-divider>
              <v-icon class="mr-2" small> mdi-clock </v-icon>
              <span class="text-caption grey--text font-weight-light"
                >last registration 26 minutes ago</span
              >
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <!-- <v-row dense>
        <v-col v-for="card in cards" :key="card.title" :cols="card.flex">
          <v-card>
            <v-card-title class="d-flex flex-row">
              <v-icon x-large style="color: green" class="fs-6" dense>
                {{ card.icon }}</v-icon
              ><span>{{ nbr(card.nbr) }}</span></v-card-title
            >
            <v-card-text>{{ card.label }}</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn icon>
                <v-icon>mdi-heart</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon>mdi-bookmark</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon>mdi-share-variant</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>-->
      <v-card> </v-card>
    </a-card>
  </v-app>
</template>
<script>
const gradients = [
  ["#222"],
  //["#42b3f4"],
  // ["red", "orange", "yellow"],
  // ["purple", "violet"],
  //  ["#00c6ff", "#F0F", "#FF0"],
  //  ["#f72047", "#ffd200", "#1feaea"],
];

export default {
  data() {
    return {
      thedata: [
        {
          icon: "mdi-account-multiple",
          title: "Nombre d'étudiants connect\é",
          nbr: this.studentsconnected,
        },
        {
          icon: "mdi-account-multiple",
          title: "Nombre d'administrateurs connect\é",
          nbr: this.adminsconnected,
        },
      ],
      loading: false,
      width: 2,
      radius: 10,
      padding: 8,
      lineCap: "round",
      gradient: gradients[5],
      //value: [0, 2, 5, 9, 5, 10, 3, 5, 0, 0, 1, 8, 2, 9, 0],
      labels: ["12am", "3am", "6am", "9am", "12pm", "3pm", "6pm", "9pm"],
      value: [200, 675, 410, 390, 310, 460, 250, 240],
      gradientDirection: "top",
      gradients,
      fill: false,
      type: "trend",
      autoLineWidth: false,
      nbrValidRes: 0,
      nbrNoValidRes: 0,
      nbrRes: 0,
      usersconnected: 0,
      studentsconnected: 0,
      adminsconnected: 0,
      companiesconnected: 0,
      normalsconnected: 0,
    };
  },
  async beforeMount() {
    await this.init();
  },

  methods: {
    nbrUsers(index) {
      switch (index) {
        case 0:
          return this.studentsconnected;
          break;
        case 1:
          return this.companiesconnected;
          break;
        case 2:
          return this.adminsconnected;
          break;
        case 3:
          return this.normalsconnected;
          break;
      }
    },
    nbr(type) {
      switch (type) {
        case "nbrRes":
          return this.nbrRes;
          break;
        case "nbrValidRes":
          return this.nbrValidRes;
          break;
        case "":
          return this.nbrNoValidRes;
          break;
      }
    },
    async init() {
      await this.getAllRealisationsValide();
      await this.getAllRealisationsNoValide();
      await this.getAllRealisations();
      await this.getAllUsersConnected();
    },
    async getAllRealisationsValide() {
      this.loading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsValide")
        .then((response) => {
          console.log(response.data.total);
          this.nbrValidRes = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    async getAllRealisationsNoValide() {
      this.loading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsNoValide")
        .then((response) => {
          console.log(response.data.total);
          this.nbrNoValidRes = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    async getAllRealisations() {
      this.loading = true;
      await axios
        .get("/api/v1/realisations")
        .then((response) => {
          console.log(response.data.total);
          this.nbrRes = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    }, //getAllUsersConnected
    async getAllUsersConnected() {
      this.loading = true;
      await axios
        .get("/api/v1/getAllUsersConnected")
        .then((response) => {
          console.log(response);
          this.usersconnected = response.data.usersconnected;
          this.studentsconnected = response.data.studentsconnected;
          this.adminsconnected = response.data.adminsconnected;
          this.companiesconnected = response.data.companiesconnected;
          this.normalsconnected = response.data.usersnormals;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
  },
  mounted() {},
};
</script>
<style scoped>
.v-sheet--offset {
  top: -24px;
  position: relative;
}
.title-card {
  font-size: 18px;
  font-weight: bold;
}
</style>
