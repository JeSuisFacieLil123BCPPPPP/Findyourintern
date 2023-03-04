<template>
  <div class="bg-white bg-light">
    <a-row class="my-2">
      <!--<b-breadcrumb separator="has-dot-separator">
        <b-breadcrumb-item href="/">Offre</b-breadcrumb-item>
        <b-breadcrumb-item href="/documentation" active
          >Mes offres publiées</b-breadcrumb-item
        >
      </b-breadcrumb>-->
    </a-row>
    <a-row class="card m-3 p-3" style="background: #f0f2f5" :gutter="[16, 16]">
      <a-col
        :lg="{ offset: 2, span: 20, offset: 2 }"
        :xs="{ span: 24 }"
        v-if="store.cache.loading == false"
      >
        <a-card
          class="mx-2 my-5 elevation_0 my-card_1 elem"
          style="border-radius: 12px"
          v-for="offre in store.cache.data"
          :key="offre.id"
          :class="{ selected: offreId == offre.id ? true : false }"
        >
          <a-row type="flex" justify="center" align="middle" :gutter="[16, 16]">
            <a-col :md="{ span: 6 }" :xs="{ span: 24 }"
              ><p class="text-subtitle-1">{{ offre.title.value }}</p></a-col
            >
            <a-col :md="{ span: 12 }" :xs="{ span: 24 }">
              <b-message
                class="my-1 elevation_0 my-card_1"
                type="is-danger"
                has-icon
                icon-size="is-medium"
                role="alert"
                :closable="false"
              >
                <div
                  class="d-flex flex-row justify-content-between align-items-center flex-wrap"
                >
                  <div class="flex-grow-1">Cette offre est imcomplète</div>
                  <div class="flex-shrink-1">
                    <b-button type="is-bleue">
                      <router-link
                        class="no-line"
                        :to="{
                          path: '/p/posting/',
                          query: { step: 'getting-started', index: offre.index },
                        }"
                      >
                        <span class="text-white no-line">Continuer</span></router-link
                      >
                    </b-button>
                  </div>
                </div>
              </b-message></a-col
            >
            <a-col :md="{ span: 6 }" :xs="{ span: 24 }">
              <div class="gutter-box">
                <vs-button
                  color="danger"
                  type="border"
                  @click="confirmDelete(offre.index)"
                  >Supprimer ce brouillon</vs-button
                >
              </div>
            </a-col>
          </a-row>
        </a-card>
      </a-col>
      <a-col
        v-if="store.cache.loading == true"
        :sm="{ span: 24 }"
        :md="{ span: 24 }"
        :lg="{ offset: 2, span: 20, offset: 2 }"
        :xl="{ offset: 2, span: 20, offset: 2 }"
        :xs="{ span: 24 }"
      >
        <b-skeleton
          class="mode"
          active
          is-centered
          size="is-large"
          height="250"
          count="1"
        ></b-skeleton>
      </a-col>
      <a-col
        :sm="{ span: 24 }"
        :md="{ span: 24 }"
        :lg="{ offset: 2, span: 20, offset: 2 }"
        :xl="{ offset: 2, span: 20, offset: 2 }"
        :xs="{ span: 24 }"
        v-if="store.bd.loading == false"
      >
        <a-card
          class="mx-2 my-5 elevation_0 my-card_1 elem"
          style="border-radius: 12px"
          v-for="offre in store.bd.data"
          :key="offre.id"
          @click="offreId = offre.id"
          :class="{ selected: offreId == offre.id ? true : false }"
        >
          <!--<a-row type="flex">
            <a-col type="flex" align="middle" justify="flex-start">
              <div class="">
                <p class="text-h6">{{ offre.title }}</p>
              </div>
              <div class="">
                <p class="text-h6">{{ offre.lieu }}</p>
              </div>
            </a-col>
          </a-row>-->
          <a-row :gutter="[16, 16]">
            <a-col class="gutter-row" :md="{ span: 5 }" :xs="{ span: 24 }">
              <div class="gutter-box">
                <p class="text-subtitle-1">{{ offre.title }}</p>
              </div>
            </a-col>
            <a-col class="gutter-row" :md="{ span: 5 }" :xs="{ span: 24 }">
              <div class="gutter-box">
                <p class="text-subtitle-1">{{ offre.lieu }}</p>
              </div>
            </a-col>
            <a-col class="gutter-row" :md="{ span: 5 }" :xs="{ span: 24 }">
              <div class="gutter-box">
                <p class="text-subtitle-1">{{ moment(offre.created_at).format("ll") }}</p>
              </div>
            </a-col>
            <a-col class="gutter-row" :md="{ span: 5 }" :xs="{ span: 24 }">
              <b-dropdown aria-role="list">
                <template #trigger="{ active }">
                  <b-button
                    :type="getStatusColor(offre.status)"
                    :icon-right="active ? 'menu-up' : 'menu-down'"
                    >{{ getStatus(offre.status) }}</b-button
                  >
                </template>

                <b-dropdown-item
                  aria-role="listitem"
                  @click="updateStatus('activate', offre.id)"
                  ><b-button class="w-100" type="is-success is-light" outlined
                    ><span class="text-black">Activer</span></b-button
                  ></b-dropdown-item
                >
                <b-dropdown-item
                  aria-role="listitem"
                  @click="updateStatus('pending', offre.id)"
                  ><b-button class="w-100" type="is-warning is-light"
                    ><span class="text-black">Suspendre</span></b-button
                  ></b-dropdown-item
                >
                <b-dropdown-item
                  aria-role="listitem"
                  @click="updateStatus('desactivate', offre.id)"
                  ><b-button class="w-100"
                    ><span class="text-black">Desactiver</span></b-button
                  ></b-dropdown-item
                >
              </b-dropdown>
            </a-col>
            <a-col class="gutter-row" :md="{ span: 4 }" :xs="{ span: 24 }">
              <b-dropdown aria-role="list">
                <template #trigger>
                  <b-button type="is-light">...</b-button>
                </template>

                <b-dropdown-item aria-role="listitem">Mettre à jour</b-dropdown-item>
                <b-dropdown-item aria-role="listitem" @click="confirmDeleteInBD(offre.id)"
                  >Supprimer</b-dropdown-item
                >
                <b-dropdown-item aria-role="listitem" @click="offreView(offre.id)"
                  >Détailler</b-dropdown-item
                >
              </b-dropdown>
            </a-col>
          </a-row>
          <!--<div class="d-flex flex-row">
            <div class="flex-grow-1">
              <p class="text-h6">{{ offre.title }}</p>
            </div>
            <div class="flex-grow-1">
              <p class="text-h6">{{ offre.lieu }}</p>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
              <vs-button color="#24855a" type="border" class="m-1 badge-1" disabled
                >Offre publiée</vs-button
              >
              <vs-button radius color="danger" type="border" icon="delete"></vs-button>
            </div>
          </div>-->
        </a-card>
        <!--<v-list-item
          v-for="offre in offres"
          :key="offre.id"
          class="mon-texte"
          @click="postulerView(offre)"
          :class="{ selected: $route.params.offreId == offre.id ? true : false }"
        >
          <v-list-item-content>
            <v-list-item-title v-text="offre.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>-->
      </a-col>

      <a-col
        v-if="store.bd.loading == true"
        :sm="{ span: 24 }"
        :md="{ span: 24 }"
        :lg="{ offset: 2, span: 20, offset: 2 }"
        :xl="{ offset: 2, span: 20, offset: 2 }"
        :xs="{ span: 24 }"
      >
        <b-skeleton
          class="mode"
          active
          is-centered
          size="is-large"
          height="250"
          count="1"
        ></b-skeleton>
      </a-col>
      <a-col
        :sm="{ span: 24 }"
        :md="{ span: 24 }"
        :lg="{ offset: 2, span: 20, offset: 2 }"
        :xl="{ offset: 2, span: 20, offset: 2 }"
        :xs="{ span: 24 }"
      >
        <b-pagination
          :total="store.bd.total"
          v-model="store.bd.currentPage"
          :range-before="3"
          :range-after="1"
          :order="store.bd.order"
          :size="store.bd.size"
          :simple="store.bd.isSimple"
          :rounded="store.bd.isRounded"
          :per-page="store.bd.results"
          :icon-prev="store.bd.prevIcon"
          :icon-next="store.bd.nextIcon"
          aria-next-label="Next page"
          aria-previous-label="Previous page"
          aria-page-label="Page"
          aria-current-label="Current page"
          :page-input="store.bd.hasInput"
          :page-input-position="store.bd.inputPosition"
          :debounce-page-input="store.bd.inputDebounce"
          @change="onPageChange"
        >
        </b-pagination>
      </a-col>
    </a-row>
    <!--<div class="d-flex flex-row" v-if="activeLoading == false">
      <v-card style="width: 400px; bottom: 70px" elevation="3" class="h-100">
        <vs-list>
          <v-card-title style="font-size: 25px" color="#24855a" class="elevation_3 mb-2">
            <a-divider>
              <b-field>
                <template #label>
                  <span style="font-size: 25px">Mes offres publiées</span>
                </template>
              </b-field>
            </a-divider></v-card-title
          >
          <v-list-item
            v-for="offre in offres"
            :key="offre.id"
            class="mon-texte"
            @click="postulerView(offre)"
            :class="{ selected: $route.params.offreId == offre.id ? true : false }"
          >
            <v-list-item-content>
              <v-list-item-title v-text="offre.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          !--<div>
              <a>
                <vs-list-item :title="offre.title" class="text-black"> </vs-list-item>
              </a>
            </div>--
        </vs-list>
      </v-card>
      <a-card
        class="border border-success card flex-shrink-1 w-100 h-100"
        style="margin-left: 400px"
      >
        !--<postulants :offreId="offreId"></postulants>--
        <div
          v-if="$route.params.offreId == null"
          class="position-relative"
          style="height: 100vh"
        >
          <div class="position-absolute start-50 top-50 translate-middle">
            <img
              src="../assets/mesoffres-1.png"
              alt=""
              height="200"
              width="300"
              class=""
            />
            <b-field class="text-center">
              <template #label>
                <span
                  style="font-size: 40px; color: black"
                  class="font-weight-black text-h6"
                  >Choisissez une offre</span
                >
              </template>
            </b-field>
          </div>
        </div>
        <router-view></router-view>
      </a-card>
    </div>
    <div v-else class="">
      <div>
        <div>
          <v-skeletopn width="700"> </v-skeletopn>
          <v-skeleton-loader
            class="mx-4 my-2"
            :flat="true"
            style="border-radius: 15px"
            width="700"
            type="card"
          ></v-skeleton-loader>
          <a-spin style="color: green; border-color: green" size="large"></a-spin>
        </div>
        !-- <b-message type="is-success " :closable="false">
            Chargement des données...
          </b-message>--
      </div>
    </div>-->
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
import noOffre1 from "./Icons/no-offre.vue";
const queryData = (params, user) => {
  return axios.get("/api/v1/offres/getOffresForUser/" + user.id, {
    params: params,
  });
};
const queryData1 = (user) => {
  return axios.get("/api/v1/offre/cache/getAllOffresCacheUser/" + user.id);
};
export default {
  components: { noOffre1 },
  data() {
    return {
      isUpdating: false,
      activeLoading: true,
      offres: [],
      offreId: "",
      visible: false,
      moment,
      searchText: "",
      moment,
      store: {
        bd: {
          data: [],
          moment,
          loading: false,
          sortField: "title",
          sortOrder: "asc",
          defaultSortOrder: "asc",
          results: 3,
          checkedRow: { id: null },
          isPaginated: true,
          isPaginationSimple: false,
          isPaginationRounded: false,
          paginationPosition: "bottom",
          defaultSortDirection: "asc",
          sortIcon: "arrow-up",
          sortIconSize: "is-small",
          currentPage: 1,
          hasInput: false,
          paginationOrder: "",
          inputPosition: "",
          inputDebounce: "",
          total: 0,
          prevIcon: "chevron-left",
          nextIcon: "chevron-right",
          order: "",
          size: "",
        },
        cache: {
          data: [],
          loading: false,
          checkedRow: { index: null },
          sortIcon: "arrow-up",
          sortIconSize: "is-small",
          total: 0,
        },
      },
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
      // offreStocke: "publierOffre/getOffre",
    }),
  },
  methods: {
    offreView(offreId) {
      this.$router.push({
        path: "/details/" + offreId,
        /* params: {
          offreId: Number(offreId),
        },*/
      });
    },
    onPageChange(page) {
      this.store.bd.currentPage = page;
      this.fetch({
        results: this.store.bd.results,
        page: this.store.bd.currentPage,
        sortField: this.store.bd.sortField,
        sortOrder: this.store.bd.sortOrder,
      });
    },
    getStatusColor(val) {
      if (val == "activate") {
        return "is-success";
      } else if (val == "desactivate") {
        return "is-danger";
      } else {
        return "is-warning";
      }
    },
    postulerView(offre) {
      this.$router.push({
        name: "postulants",
        params: {
          offreId: Number(offre.id),
        },
      });
    }, //getAllRealisationsValideSearch
    fetch(params = { results: 3, page: 1, sortField: "title", sortOrder: "asc" }) {
      this.store.bd.loading = true;
      queryData(params, this.user).then(({ data }) => {
        this.store.bd.loading = false;
        console.log(data);
        data.data.forEach((item) => {
          item.checked = false;
        });
        this.store.bd.total = data.meta.total;
        this.store.bd.data = data.data;
        this.store.bd.currentPage = data.meta.current_page;
        this.store.bd.loading = false;
        this.store.bd.results = data.meta.per_page;
        console.log("this.data1");
        console.log(this.store.bd.data);
      });
    },
    fetch1() {
      this.store.cache.loading = true;
      queryData1(this.user).then(({ data }) => {
        console.log("eeeeeeeeee");
        console.log(data);
        this.store.cache.loading = false;
        data.data.forEach((item) => {
          item.checked = false;
        });
        this.store.cache.total = data.data.length;
        this.store.cache.data = data.data;
        this.store.cache.loading = false;
        console.log("this.data2");
        console.log(this.store.cache.data);
      });
    },
    async getAllOffresValide() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getAlloffresValide")
        .then(async (response) => {
          console.log(response);
          console.log(response.data.data);

          this.offres = response.data.data;
          // await this.getVisitor();
        })
        .catch((error) => {
          console.log("error");
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },

    async getAllOffresPaginate() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getOffresPaginate")
        .then((res) => {
          console.log(res);
          console.log(res.data.data);

          this.offres = res.data.data;
          console.log("offfres");
          console.log(this.offres);
          // this.data = res.data.data;
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          //  this.currentPage = res.data.meta.currentPage;
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
    getAllOffresPaginateNext() {
      if (/*bottomOfWindow && */ this.offres.length < this.total) {
        this.loading = true;
        axios
          .get("/api/v1/offres/getOffresPaginate", {
            params: { page: this.nextPage },
          })
          .then((res) => {
            this.offres = this.offres.concat(res.data.data);
            //this.data = res.data.data;
            this.currentPage = res.data.meta.currentPage || this.currentPage;
            this.nextPage =
              this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;
            // this.activeLoading = false;
            this.loading = false;
          });
      }
      // };
    },
    confirmDelete(index) {
      this.$buefy.dialog.confirm({
        title: "Suppression",
        message: "Etes-vous sûr de vouloir supprimer ce brouillon?",
        type: "is-danger",
        hasIcon: true,
        icon: "times-circle",
        iconPack: "fa",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: async () => {
          await this.deleteOffreCache(index);
          this.fetch1();
        },
      });
    },
    confirmDeleteInBD(offreId) {
      this.$buefy.dialog.confirm({
        title: "Suppression",
        message: "Etes-vous sûr de vouloir supprimer cette offre d'emploi?",
        type: "is-danger",
        hasIcon: true,
        icon: "times-circle",
        iconPack: "fa",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: async () => {
          await this.deleteOffre(offreId);
          this.fetch();
        },
      });
    },
    getStatus(val) {
      if (val == "activate") {
        return "Activée";
      } else if (val == "desactivate") {
        return "Désactivée";
      } else {
        return "Suspendu";
      }
    },
    async updateStatus(val, offreId) {
      this.isUpdating = true; //
      console.log(this.user.user_type);
      console.log("this.user.user.id");
      console.log(this.user.user);
      await axios
        .put("/api/v1/offre/action/" + offreId, {
          status: val,
        })
        .then((res) => {
          console.log("update");
          console.log(res);
          this.isUpdating = false;
          this.fetch({
            results: this.store.bd.results,
            page: this.store.bd.currentPage,
            sortField: this.store.bd.sortField,
            sortOrder: this.store.bd.sortOrder,
          });
        })
        .catch(({ response: { data } }) => {
          console.log(data);
          this.isUpdating = false;
        })
        .finally(() => {
          this.isUpdating = false;
        });
    },
    async getOffresByUser() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/offres/getOffresForUser/" + this.user.id)
        .then((response) => {
          console.log("logtyu");
          this.offres = response.data.data;
          console.log(response.data.data);
          console.log(this.offres);
        })
        .catch((error) => {
          console.log(error.message);
        });
      this.activeLoading = false;
    },
    ///offre/delete/{id}
    async deleteOffre(offreId) {
      await axios
        .delete("/api/v1/offre/delete/" + offreId)
        .then((response) => {
          console.log(response);
          console.log("this.offre suppiler oog");
          this.$vs.notify({
            color: "success",
            title: "SUCCES DE LA SUPPRESSION",
            text: "Vous avez supprimer l'offre d'emploi avec succès",
            time: 10000,
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async deleteOffreCache(index) {
      await axios
        .post("/api/v1/offre/cache/delete/" + this.user.id, {
          index: index,
        })
        .then((response) => {
          console.log(response);
          // this.offre ;
          console.log("this.offre");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    console.log("monted");
    //this.getAllRealisationsPaginateNext();
  },
  async beforeMount() {
    this.fetch();
    this.fetch1();
    if (this.store.cache.data.length >= 3) {
      this.cacheplein = true;
    }
    //await this.getOffresByUser();
  },
};
</script>
<style scoped lang="scss">
.elem :hover {
  cursor: pointer;
}
.inform {
  border: 1px solid #24855a !important;
  background: transparent;
  color: #24855a;
  border-radius: 3px;
}
.badge-1 {
  cursor: none !important;
}
.selected {
  border: 1px solid #24855a !important;
  background: transparent;
  color: #24855a;
  //background: #46C93A//#24855a;
  // color: white !important;
}
.no-line {
  text-decoration: none !important;
}
.mode {
  height: 500px;
}
</style>
