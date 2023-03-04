<template>
  <v-card class="mx-auto">
    <v-container fluid>
      <v-row dense>
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
      </v-row>
    </v-container>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      nbrValidRes: 0,
      nbrNoValidRes: 0,
      nbrRes: 0,
      cards: [
        {
          title: "Pre-fab homes",
          icon: "fas fa-list",
          flex: 4,
          label: "Nombre total de réalisations ",
          nbr: "nbrRes",
        },
        {
          title: "Favorite road trips",
          icon: "mdi-bookmark",
          flex: 4,
          label: "Nombre total de réalisations en attente de validation",
          nbr: "nbrValidRes",
        },
        {
          title: "Best airlines",
          icon: "mdi-bookmark",
          flex: 4,
          label: "Nombre total de sous-catégories",
          nbr: "nbrNoValidRes",
        },
      ],
    };
  },
  async mounted() {
    await this.init();
  },

  methods: {
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
    },
    async getAllRealisationsValide() {
      // this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsValide")
        .then((response) => {
          console.log(response.data.total);
          this.nbrValidRes = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },
    async getAllRealisationsNoValide() {
      // this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsNoValide")
        .then((response) => {
          console.log(response.data.total);
          this.nbrNoValidRes = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },
    async getAllRealisations() {
      // this.activeLoading = true;
      await axios
        .get("/api/v1/realisations")
        .then((response) => {
          console.log(response.data.total);
          this.nbrRes = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },
  },
};
</script>
<style scoped></style>
