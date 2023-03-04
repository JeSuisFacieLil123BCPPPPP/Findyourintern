<template>
  <v-app class="bg-grey">
    <div id="projets" class="bg-white">
      <a-divider>
        <p
          class="font-weight-black text-h1 text-center vert"
          style="color: black; opacity: 1; margin: 20px 0px; box-sizing: content"
        >
          <b-field>
            <template #label>
              <span style="font-size: 40px" class="text-black font-weight-black text-h4"
                >Recherches de réalisations</span
              >
            </template>
          </b-field>
        </p></a-divider
      >
    </div>
    <div class="w-100 mt-3" style="background: #fff">
      <a-row
        :gutter="[16, 16]"
        class="w-100 b-vert vert-b"
        align="middle"
        type="flex"
        justify="center"
        style="height: 150px; background: white"
      >
        <a-col :xs="24" :md="12">
          <div>
            <b-field label="" class="" expanded>
              <b-input
                placeholder="Rechercher un projet..."
                rounded
                style="margin-left: 100px"
                :value="$route.query.search"
                @input="searchValueChange"
                class="w-100"
                icon-pack="fas"
                icon-right="search"
                icon-right-clickable
                @icon-right-click="searchIconClick"
                expanded
              ></b-input>
            </b-field>
          </div>
        </a-col>
        <a-col :xs="24" :md="12">
          <b-field label="" class="" expanded>
            <a-select
              size="large"
              mode="default"
              placeholder=""
              :value="order"
              style="width: 100%; border-radius: 10px"
              @change="handleChangeTypeOrder"
              class="label-text"
              :default-value="null"
            >
              <a-select-option
                v-for="item in orders"
                :key="item.text"
                :value="item.value"
              >
                {{ item.text }}
              </a-select-option>
            </a-select>
          </b-field>
        </a-col>
      </a-row>
    </div>

    <div
      class="d-flex flex-row flex-wrap justify-content-center align-items-center bg-grey"
      v-if="realisations.length != 0"
      style="bacgkround: #f0f2f5"
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
        <!-- <a-modal
          v-if="realis.video != null"
          :visible="visible"
          :footer="null"
          :height="realis.video.variants['small'][0].height"
          :width="realis.video.variants['small'][0].width"
          @cancel="visible = false"
          :mask="false"
        >
          <video style="width: 100%" :src="realis.video.variants['small'][0].height" />
        </a-modal>-->
        <!-- <v-skeleton-loader type="image,card-heading,chip" :loading="activeLoading">
        <v-card
          style="border-radius: 20px"
          class="mx-auto position-relative"
          color="grey lighten-4"
          width="300"
          :flat="true"
        >
          !--<v-img
                src="https://cdn.vuetifyjs.com/images/cards/kitchen.png"
              >-->
        <div v-if="realis.video != null" style="border-radius: 50px 0px">
          <v-hover v-slot="{ hover }">
            <v-img
              style="border-radius: 15px 15px 0px 0px"
              v-if="realis.poster != null && realis.poster.variants != null"
              :src="realis.poster.url"
              :height="200"
              :width="300"
              alt="1"
              class="position-relative"
              ><v-btn
                v-if="realis.video != null"
                absolute
                :rounded="true"
                :retain-focus-on-click="true"
                medium
                bottom
                flat
                right
                style="cursor: auto; background: #e3f2fd"
              >
                {{ moment(realis.video.duration / 60, "HH:mm:ss").format("LT") }}
              </v-btn>
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
              <v-btn
                v-if="realis.video != null"
                absolute
                :rounded="true"
                :retain-focus-on-click="true"
                small
                bottom
                flat
                right
                style="cursor: auto; background: #e3f2fd"
              >
                {{ moment(realis.video.duration, "HH:mm:ss").format("LT") }}
              </v-btn>
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
            ><v-btn
              v-if="realis.video != null"
              absolute
              :rounded="true"
              :retain-focus-on-click="true"
              medium
              bottom
              flat
              right
              style="cursor: auto; background: #e3f2fd"
            >
              {{ moment(realis.video.duration, "HH:mm:ss").format("LT") }}
            </v-btn>
          </v-img>
          <!--  <div v-else>topo</div>-->
        </a-popover>
        <v-card-text class="elevation_2">
          <div class="d-flex flex-row">
            <div>
              <v-avatar :size="50" class="me-3">
                <img
                  v-if="realis.user.avatar != null"
                  alt="Avatar"
                  :src="realis.user.avatar.variants['small'].secure_url"
                />
                <v-icon :size="50" v-else> mdi-account-circle </v-icon>
              </v-avatar>
            </div>
            <div
              class="flex-grow-1 d-flex flex-column justify-content-center align-items-start"
            >
              <div
                class="d-inline-block text-truncate font-weight-black text-h5 text-truncate"
                style="
                  line-height: 1.364;
                  max-width: 180px;
                  font-size: 30px;
                  font-weight: bold;
                "
              >
                {{ realis.title }}
              </div>
              <div>
                <span>{{ moment(realis.created_at).fromNow() }}</span>
              </div>
            </div>
          </div>
        </v-card-text>
      </v-card>
      <!--</v-skeleton-loader>
      </v-card>-->
      <div v-if="loading" class="demo-loading-container">
        <a-spin />
      </div>
    </div>
    <div
      v-if="loading == false && realisations.length == 0"
      class="d-flex flex-column justify-content-center align-items-center"
    >
      <no-data-1 height="300px" width="300px"></no-data-1>
      <b-field>
        <div class="font-weight-bold text-subtitle-1 text-black">
          Aucun résultat pour cette recherche
        </div>
      </b-field>
    </div>
  </v-app>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import noData1 from "../Icons/no-data-1.vue";
import noOffre from "../Icons/no-offre.vue";
export default {
  components: { noData1, noOffre },
  data() {
    return {
      activeLoading: false,
      realisations: [],
      moment,
      searchText: "",
      loading: false,
      busy: false,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false,
      error: null,
      search: "",
      orders: [
        { value: null, text: "Plus pertinents" },
        { value: "trending", text: "Tendance" },
        { value: "lastest", text: "Plus récents" },
      ],
      order: this.$route.query.order == null ? null : this.$route.query.order,
      entities: [],
      entity: this.$route.query.entity == null ? null : this.$route.query.entity,
      filiere: this.$route.query.filere == null ? null : this.$route.query.filiere,
      //selectable: false,

      disabledFiliere: this.$route.query.filere == null ? true : false,
      filieres: [],
      realisationbyTags: [],
      loadingEntity: false,
      loadingFiliere: false,
    };
  },
  methods: {
    /* cd(a) {
      console.log("b");
      console.log(a);
    },*/
    searchIconClick() {
      // this.$route.query.search = this.searchText;
      this.$router.push({
        name: "realisationsrecherche",
        query: {
          ...this.$route.query,
          search: this.searchText,
        },
      });
      this.getAllRealisationsValideSearch();
    },
    searchValueChange(value) {
      this.searchText = value;
    },
    handleChangeTypeOrder(selectedOrder) {
      console.log("item");
      console.log(selectedOrder);
      this.order = selectedOrder;
      this.getAllRealisationsValideSearch();
      this.$router.push({
        name: "realisationsrecherche",
        query: {
          ...this.$route.query,
          order: this.order,
        },
      });
      /*fetch({
        results: this.results,
        page: this.currentPage,
        search: this.search,
        order: this.order,
      });*/
    },
    async getAllEntities() {
      this.loadingEntity = true;
      await axios
        .get("/api/v1/entities")
        .then((response) => {
          console.log("entites");
          console.log(response.data.data);
          const entities = response.data.data;
          this.entities = [...entities];
          this.loadingEntity = false;
        })
        .catch((error) => {
          console.log(error);
          this.loadingEntity = false;
        });
      // .finally(() => (this.activeLoading = false));
    },
    async getRealisationsByTagFirsts() {
      await axios
        .get("/api/v1/realisations/getRealisationsByTagFirsts/" + 161)
        .then((response) => {
          console.log("tags");
          console.log(response);
          //this.realisationbyTags = response.data.data;
          console.log(this.realisationbyTags.length);
          // console.log(this.realisationForSubcategory);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    realisView(realisationId) {
      this.$router.push({
        name: "realisationdeatails",
        params: {
          realisationId: Number(realisationId),
        },
      });
    },
    async getAllRealisationsValideSearch() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsValideSearch/", {
          params: {
            search: this.$route.query.search,
            order: this.order,
            entity: this.entity,
            filiere: this.filiere,
          },
        })
        .then(async (response) => {
          console.log("requete");
          console.log(response);
          console.log(response.data.data);

          this.realisations = response.data.data;
          //await this.getVisitor();
        })
        .catch((error) => {
          console.log("error");
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    /* async getVisitor() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/visitors")
        .then((response) => {
          console.log("visitor");
          console.log(response);
          // console.log(response.data.data);

          // this.realisations = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },*/
    /* publish_at(date) {
      let dat = new Date(date);
      return "Publié le " + dat.toLocaleDateString("fr");
    },*/
    getAllRealisationsPaginateNext() {
      window.onscroll = () => {
        let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.documentElement.scrollHeight; //
        /*console.log(document.documentElement);
        console.log("window.innerHeight");
        console.log(window.innerHeight);
        console.log("srolltop");
        console.log(document.documentElement.scrollTop);
        console.log("srollheight");
        console.log(document.documentElement.scrollHeight);
        console.log("offsetHeight");
        console.log(document.documentElement.offsetHeight);
        console.log("ttotal");
        console.log(this.total);
        console.log("somme");
        console.log(
          document.documentElement.scrollTop + window.innerHeight ===
            document.documentElement.scrollHeight
        );*/
        console.log(this.total);
        if (this.realisations.length >= this.total) {
          this.activeLoading = false;
          this.busy = true;
          return;
        }

        if (bottomOfWindow && this.realisations.length < this.total) {
          this.loading = true;
          axios
            .get("/api/v1/realisations/getRealisationsPaginate", {
              params: { page: this.nextPage },
            })
            .then((res) => {
              console.log("req2");
              console.log(res);
              this.realisations = this.realisations.concat(res.data.data);
              //this.data = res.data.data;
              this.currentPage = res.data.meta.currentPage || this.currentPage;
              this.nextPage =
                this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;
              // this.activeLoading = false;
              this.loading = false;
            });
        }
      };
    },
  },
  async mounted() {
    console.log("monted");
    await this.getAllEntities();
    //this.getAllRealisationsValideSearch(); // this.getAllRealisationsPaginateNext();
  },
  async beforeMount() {
    await this.getAllRealisationsValideSearch();
    //await this.getRealisationsByTagFirsts();
    await this.getAllEntities();
  },
  watch: {
    $route(to, from) {
      this.getAllRealisationsValideSearch();
    },
    /*order(a) {
      console.log("select");
      console.log(a);
      this.getAllRealisationsValideSearch();
      // if (this.order != null) {
      this.$router.push({
        name: "realisationsrecherche",
        query: {
          ...this.$route.query,
          order: this.order,
        },
      });
    },*/
    entity(val) {
      var index = val == null ? null : val;
      if (val != null)
        var entity = this.entities.find((entity) => {
          return entity.id == val;
        });
      console.log("entity");
      if (val != null) console.log(entity);
      if (val != null) this.filieres = entity.filieres;
      console.log(this.filieres);
      this.disabledFiliere = false;
      this.$router.push({
        query: {
          ...this.$route.query,
          entity: index,
        },
      });
    },
    filiere(val) {
      console.log("filiere");
      console.log(val);
      // console.log(this.filiere);
      // this.disabledFiliere = false;
      this.$router.push({
        query: {
          ...this.$route.query,
          filiere: val,
        },
      });
    },
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
.bg-grey {
  background: #f0f2f5 !important;
}
</style>
