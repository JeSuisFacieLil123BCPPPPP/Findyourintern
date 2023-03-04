<template>
  <div class="d-flex flex-column">
    <!--<div class="d-flex w-100">
      <div style="margin-top: 10px">
        <v-card style="width: 100%">
          <div>
            <v-card>
              <v-card-title> Trier par</v-card-title>
              <a-card>
                <b-field size="is-medium" expanded>
                  <template #label>
                    <span style="font-size: 16px">Par métier</span>
                  </template>
                  <b-select
                    size="is-medium"
                    placeholder="Type"
                    v-model="offre.type"
                    expanded
                  >
                    <option value="Stage académique">Stage académique</option>
                    <option value="Stage profesionnel">Stage profesionnel</option>
                    <option value="Emploi">Emploi</option>
                  </b-select>
                </b-field>
              </a-card>
            </v-card>
          </div>
        </v-card>
      </div>
    </div>
  
     <v-app style="height:250px">
    <v-row justify="center">
      <v-col
        cols="12"
        sm="7"
        md="6"
        lg="5"
      >
        <v-sheet
          elevation="10"
          rounded="xl"
        >
          <v-sheet
          style="background-color:  #24855a"
            class="pa-3  text-right"
            dark
            rounded="t-xl"
          >
            <v-btn icon>
              <v-icon>mdi-content-save-cog-outline</v-icon>
            </v-btn>
  
            <v-btn
              class="ml-2"
              icon
            >
              <v-icon>mdi-check-bold</v-icon>
            </v-btn>
          </v-sheet>
  
          <div class="pa-4">
            !--<v-chip-group
              active-class="primary--text"
              column
            >
              <v-chip
                v-for="tag in tags"
                :key="tag"
              >
                {{ tag }}
              </v-chip>
            </v-chip-group>--
          </div>
        </v-sheet>
      </v-col>
    </v-row>
  </v-app>
  
  -->
    <div style="margin: 15px">
      <v-card>
        <v-card-title> Trier par</v-card-title>
        <a-card>
          <a-row :gutter="[18, 18]">
            <a-col :md="{ span: 12 }" :xs="{ span: 24 }">
              <b-field label="Par tendance" expanded>
                <a-select
                  size="large"
                  mode="default"
                  default-value="1"
                  style="width: 100%; border-radius: 10px"
                  class="label-text"
                  @change="getAllPortfolios"
                >
                  <a-select-option value="1">Plus pertinent</a-select-option>
                  <a-select-option value="2">Plus tendance</a-select-option>
                  <a-select-option value="3">Plus récent</a-select-option>
                </a-select>
              </b-field>
            </a-col>
            <a-col :md="{ span: 12 }" :xs="{ span: 24 }">
              <b-field size="is-medium" expanded>
                <template #label>
                  <span style="font-size: 16px">Par métier </span>
                </template>
                <a-select
                  size="large"
                  mode="default"
                  v-model="portfolio.metier"
                  default-value="lucy"
                  style="width: 100%; border-radius: 10px"
                  class="label-text"
                >
                  <a-select-option value="">Tous les métiers</a-select-option>
                  <a-select-option
                    :key="metier.id"
                    v-for="metier in metiers"
                    :value="metier.name"
                  >
                    {{ metier.name }}
                  </a-select-option>
                </a-select>
              </b-field>
            </a-col>
          </a-row>
          <!--<b-field horizontal>
            <b-field size="is-medium">
              <template #label>
                <span style="font-size: 16px">Par métier </span>
              </template>
              <b-select
                size="is-medium"
                placeholder="Type"
                v-model="portfolio.metier"
                expanded
              >
                <option value="">Tous les métiers</option>
                <option :value="metier.name" :key="metier.id" v-for="metier in metiers">
                  {{ metier.name }}
                </option>
              </b-select>
            </b-field>
            <b-field size="is-medium">
              <template #label>
                <span style="font-size: 16px">Par popularité</span>
              </template>
              <b-select
                size="is-medium"
                placeholder="Type"
                v-model="portfolio.metier"
                expanded
              >
                <option value="">Pas important</option>
                <option :value="metier.name" :key="metier.id" v-for="metier in metiers">
                  {{ metier.name }}
                </option>
              </b-select>
            </b-field>
          </b-field>-->
        </a-card>
      </v-card>
    </div>
    <div
      fluid
      class="p-2 w-100 d-flex flex-column justify-content-between position-relative"
      style="min-height: 300px; min-width: 20%"
    >
      <p
        class="font-weight-black text-h1 text-center vert"
        style="
          color: black;
          opacity: 1;
          margin: 20px 0px;
          box-sizing: content;
          background: #24855a;
        "
      >
        <b-field>
          <template #label>
            <span style="font-size: 40px; color: white" class="font-weight-black text-h4"
              >Portfolios de quelques étudiants</span
            >
          </template>
        </b-field>
      </p>
      <div
        v-if="portfolios.length == 0 && loading == false"
        class="position-relative"
        style="height: 400px"
      >
        <div class="position-absolute start-50 top-50 translate-middle">
          <img src="../../assets/img-2.png" alt="" height="200" width="300" class="" />
          <b-field class="text-center">
            <template #label>
              <span
                style="font-size: 40px; color: black"
                class="font-weight-black text-h6"
                >Aucun résultat disponible</span
              >
            </template>
          </b-field>
        </div>
      </div>
      <div v-if="loading == false">
        <div class="d-flex flex-row flex-wrap" style="margin: 30px">
          <portfolio-c
            v-for="(item, index) in portfolios"
            :key="index"
            :portfolio="item"
          ></portfolio-c>
        </div>
        <div style="margin-top: 35px">
          <b-button
            v-if="portfolios.length < total"
            @click="getAllPortfoliosPaginateNext"
            rounded
            hovered
            type="is-bleue"
            class="translate-middle start-50 top-100"
          >
            <a-spin v-if="loading == true" />
            <span v-if="!loading">Voir plus</span>
          </b-button>
        </div>
      </div>
      <div v-else class="position-absolute top-50 start-50 translate-middle">
        <a-spin size="large"> </a-spin>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      portfolio: {
        metier: "",
      },
      loading: true,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      portfolios: [],
      metiers: [],
    };
  },
  props: ["user"],
  methods: {
    async getAllMetiers() {
      await axios
        .get("/api/v1/metiers")
        .then((response) => {
          console.log(response.data);
          console.log("metiers");
          console.log(response);
          this.metiers = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
      // .finally(() => (this.activeLoading = false));
    },
    async getAllPortfolios() {
      this.loading = true;
      await axios
        .get("/api/v1/portfolios/getAllPortfolios", {
          params: { metier: this.portfolio.metier },
        })
        .then((res) => {
          console.log("logine");
          console.log(res);
          this.portfolios = res.data.data;
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          this.nextPage = this.nextPage < this.lastPage ? 2 : this.lastPage;
          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
        });
    },
    getAllPortfoliosPaginateNext() {
      if (this.portfolios.length < this.total) {
        this.loading = true;
        axios
          .get("/api/v1/portfolios/getAllPortfolios", {
            params: Object.assign(
              {},
              { metier: this.portfolio.metier },
              { page: this.nextPage }
            ),
          })
          .then((res) => {
            this.portfolios = this.portfolios.concat(res.data.data);
            this.currentPage = res.data.meta.currentPage || this.currentPage;
            this.nextPage =
              this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;
            this.loading = false;
          });
      }
      // };
    },
  },
  watch: {
    "portfolio.metier"(value) {
      this.getAllPortfolios();
    },
  },
  async mounted() {
    await this.getAllPortfolios();
    await this.getAllMetiers();
  },
};
</script>
<style scoped></style>
