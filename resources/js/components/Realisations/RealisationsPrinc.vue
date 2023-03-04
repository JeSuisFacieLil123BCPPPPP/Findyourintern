<template>
  <div :style="{ background: '#F5F5F5' }" style="margin-top: 10px">
    <div class="w-100">
      <a-row
        :gutter="[16, 16]"
        class="w-100"
        align="middle"
        type="flex"
        justify="center"
        style="height: 150px; background: white"
      >
        <a-col :xs="24" :md="24">
          <b-field label="" class="" expanded>
            <b-input
              placeholder="Rechercher un projet..."
              rounded
              style="margin-left: 100px"
              v-model="searchText"
              type="text"
              class="mb-4 w-100"
            ></b-input>
            <p class="control" style="width: 40px">
              <b-button type="is-bleue is-light" @click="searchIconClick">
                <b-icon icon="magnify" size="is-small"> </b-icon
              ></b-button>
            </p>
          </b-field>
        </a-col>
      </a-row>
    </div>
    <v-container
      v-if="activeLoading == true"
      class="d-flex flex-row flex-wrap justify-content-center align-items-center"
    >
      <v-skeleton-loader
        class="mx-4 my-2"
        width="300"
        :flat="true"
        style="border-radius: 15px"
        :key="i"
        v-for="i in 6"
        type="card"
      ></v-skeleton-loader>
    </v-container>
    <v-container
      class="d-flex flex-row flex-wrap justify-content-center align-items-center"
      v-if="realisations.length != 0"
    >
      <v-card
        v-for="(realis, i) in realisations"
        :key="i"
        @click="realisView(realis.id)"
        class="mx-4 my-2"
        width="300"
        :flat="true"
        style="border-radius: 15px"
      >
        <v-skeleton-loader type="image,card-heading,chip" :loading="activeLoading">
          <v-card
            class="position-relative"
            color="grey lighten-4"
            width="300"
            :flat="true"
            style="border-radius: 15px"
          >
            <div v-if="realis.video != null" style="border-radius: 15px">
              <v-hover v-slot="{ hover }">
                <v-img
                  style="border-radius: 15px 15px 0px 0px"
                  v-if="realis.poster != null && realis.poster.variants != null"
                  :src="realis.poster.url"
                  :height="200"
                  :width="300"
                  alt="1"
                  class="position-relative"
                >
                  <v-expand-transition>
                    <div
                      v-if="hover"
                      class="d-flex animate__fadeOut"
                      style="height: 100%"
                    >
                      <video
                        :autoplay="true"
                        :height="realis.video.variants['medium'][0].height"
                        :width="realis.video.variants['medium'][0].width"
                        :poster="realis.poster.variants['medium'].secure_url"
                      >
                        <source
                          :src="realis.video.variants['medium'][0].secure_url"
                          type="video/mp4"
                        />
                        <source
                          :src="realis.video.variants['medium'][1].secure_url"
                          type="video/webm"
                        />
                      </video>
                    </div> </v-expand-transition
                ></v-img>
                <v-img
                  v-else
                  src="https://res.cloudinary.com/ddt7qfshl/image/upload/v1667750051/ressources/posters/qkg0ldmbktr5rpyvrjld.png"
                  :height="200"
                  :width="300"
                  alt="2"
                  class="position-relative"
                  style="background: #e3f2fd"
                >
                  <v-expand-transition>
                    <div
                      v-if="hover"
                      class="d-flex animate__fadeOut blue darken-2 v-card--reveal text-h2 white--text"
                      style="height: 100%"
                    >
                      <video
                        :autoplay="true"
                        :height="realis.video.variants['medium'][0].height"
                        :width="realis.video.variants['medium'][0].width"
                        :poster="realis.poster.variants['medium'].secure_url"
                      >
                        <source
                          :src="realis.video.variants['medium'][0].secure_url"
                          type="video/mp4"
                        />
                        <source
                          :src="realis.video.variants['medium'][1].secure_url"
                          type="video/webm"
                        />
                      </video>
                    </div>
                  </v-expand-transition>
                </v-img>
              </v-hover>
            </div>
            <a-popover v-else trigger="hover" placement="leftBottom" class="text-break">
              <template slot="content">
                <div
                  @click="realisView(realis.id)"
                  class="card barre overflow-auto pointer-c"
                  style="max-width: 275px; height: 200px"
                >
                  <div class="card-header">
                    <span class="d-inline-block text-truncate" style="max-width: 150px">
                      {{ realis.title }}
                    </span>
                  </div>
                  <div class="card-body">
                    <div
                      class="d-flex animate__fadeOut blue darken-2 v-card--reveal white--text"
                      style="height: 100%; font-size: 16px; width: 100%"
                    >
                      <div v-html="realis.description"></div>
                    </div>
                  </div>
                </div>
              </template>
              <v-img
                v-if="realis.poster != null && realis.poster.variants != null"
                :src="realis.poster.url"
                :height="200"
                :width="300"
                alt="1"
                class="position-relative"
              >
              </v-img>
            </a-popover>
            <v-card-text class="elevation_2">
              <div class="d-flex flex-row">
                <div
                  class="flex-grow-1 d-flex flex-column justify-content-center align-items-start"
                >
                  <div>
                    <span
                      class="d-inline-block text-truncate font-weight-black text-h5"
                      style="width: 180px; color: black"
                    >
                      {{ realis.title }}</span
                    >
                  </div>
                  <div>
                    <span
                      ><v-icon size="20">mdi-calendar</v-icon>
                      <span>{{
                        "Publié le " + moment(realis.created_at).format("L")
                      }}</span></span
                    >
                  </div>
                </div>
              </div>
            </v-card-text>
          </v-card>
        </v-skeleton-loader>
      </v-card>
      <div class="w-100 position-relative" style="margin-top: 15px; height: 100px">
        <b-button
          v-if="realisations.length != total"
          @click="getAllRealisationsPaginateNext"
          rounded
          hovered
          style="background: #24855a; color: white"
          class="translate-middle start-50 top-50"
        >
          <a-spin v-if="loading == true" />
          <span v-if="!loading">Voir plus</span>
        </b-button>
      </div>
    </v-container>

    <v-container v-else class="position-relative">
      <b-field class="top-50 start-50 translate-middle">
        <template #label>
          <span>Aucun projet disponible</span>
        </template>
      </b-field>
    </v-container>
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
export default {
  name: "realisationPrinc",
  data() {
    return {
      model: 0,
      show: true,
      //loading: false,
      activeLoading: false,
      realisations: [],
      visible: false,
      moment,
      searchText: "",

      loading: false,
      busy: false,
      // firstPage: 1,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false,
      error: null,
    };
  },
  methods: {
    realisView(realisationId) {
      this.$router.push({
        name: "realisationdetails",
        params: {
          realisationId: Number(realisationId),
        },
      });
    }, //getAllRealisationsValideSearch
    searchIconClick() {
      /*if (this.user.user_type == "student") {
        if (this.search.length != 0 && this.$route.name == "realisationprinc")
          this.$router.push({
            // path: 'realisationsRecherche',
            name: "offresrecherche",
            query: {
              search: this.search,
            },
          });
        else {*/
      this.$router.push({
        // path: 'realisationsRecherche',
        name: "realisationsrecherche",
        query: {
          ...this.$route.query,
          search: this.searchText,
          order: null,
        },
      });
      /*}
      } else if (this.user.user_type == "company") {
        if (this.search.length != 0)
          this.$router.push({
            // path: 'realisationsRecherche',
            name: "realisationsrecherche",
            query: {
              search: this.search,
            },
          });
        else {
          this.$router.push({
            // path: 'realisationsRecherche',
            name: "realisationsrecherche",
            query: {
              ...this.$route.query,
              search: this.search,
            },
          });
        }
      }*/
    },
    async getAllRealisationsValide() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsValide")
        .then(async (response) => {
          console.log(response);
          console.log(response.data.data);

          this.realisations = response.data.data;
          // await this.getVisitor();
        })
        .catch((error) => {
          console.log("error");
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },

    async getAllRealisationsPaginate() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getRealisationsPaginate")
        .then((res) => {
          console.log(res);
          console.log(res.data.data);

          this.realisations = res.data.data;
          console.log(this.realisations);
          // this.data = res.data.data;
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          this.currentPage = res.data.meta.current_page;
          this.nextPage = this.nextPage < this.lastPage ? 2 : this.lastPage;
          //this.loading = false;
          this.activeLoading = false;
        })
        .catch((error) => {
          console.log("error");
          console.log(error);
          this.activeLoading = false;
        });
      //  .finally(() => (this.activeLoading = false));
    },
    getAllRealisationsPaginateNext() {
      if (/*bottomOfWindow && */ this.realisations.length < this.total) {
        this.loading = true;
        console.log(this.currentPage);
        axios
          .get("/api/v1/realisations/getRealisationsPaginate", {
            params: { page: this.currentPage + 1 },
          })
          .then((res) => {
            this.realisations = this.realisations.concat(res.data.data);
            //this.data = res.data.data;
            console.log(res);
            this.currentPage = res.data.meta.current_page;
            //|| this.currentPage;
            /* this.nextPage =
              this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;*/
            // this.activeLoading = false;
            this.loading = false;
          });
      }
      // };
    },
  },
  mounted() {
    console.log("monted");
  },
  async beforeMount() {
    await this.getAllRealisationsPaginate();
  },
};
</script>
<style scoped>
.animate__flipInX .animate__animated.animate__bounce {
  --animate-duration: 6s;
}
.barre::-webkit-scrollbar {
  width: 10px; /* width of the entire scrollbar */
}

.barre::-webkit-scrollbar-track {
  background: #f5f5f5; /* color of the tracking area */
}

.barre::-webkit-scrollbar-thumb {
  background-color: #e0e0e0; /* color of the scroll thumb */
  border-radius: 20px; /* roundness of the scroll thumb */
  border: 3px solid #f5f5f5; /* creates padding around scroll thumb */
}
.barre {
  scrollbar-width: thin; /* "auto" or "thin" */
  scrollbar-color: #e0e0e0 #f5f5f5; /* scroll thumb and track */
}
</style>
