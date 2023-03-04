<template>
  <div>
    <div>
      <a-row>
        <a-col
          :sm="{ span: 24 }"
          :md="{ span: 24 }"
          :lg="{ offset: 6, span: 12, offset: 6 }"
        >
          <a-card class="mx-2 my-5 elevation_0 my-card_1" style="border-radius: 12px">
            <div class="d-flex flex-row justify-content-between">
              <p
                class="font-weight-black text-h1 text-center"
                style="color: black; opacity: 1; vertical-align: middle"
              >
                <b-field>
                  <template #label>
                    <span style="font-size: 40px" class="font-weight-black text-h4"
                      >Créer une offre d'emploi
                    </span>
                  </template>
                </b-field>
              </p>
              <publier-offre-1
                width="250px"
                height="150px"
                class="d-none d-sm-block"
              ></publier-offre-1>
            </div>
          </a-card>
          <a-card class="mx-2 my-5 elevation_0" style="border-radius: 12px">
            <b-field>
              <template #label>
                <span style="font-size: 18px"
                  >Comment souhaitez-vous publier votre offre d'emploi ?</span
                >
              </template>
            </b-field>
            <!--<a-card>
                <a-radio> </a-radio>
              </a-card>-->
            <!--<div class="d-flex flex-row bd-highlight">
                <div class="p-2 flex-shrink-1 bd-highlight">
                  <vs-radio vs-name="radios1" :vs-value="true"> </vs-radio>
                </div>
                <div class="p-2 w-100 bd-highlight">Flex item</div>
              </div>-->
            <a-card
              class="d-flex my-1"
              style="border-radius: 10px"
              v-if="store.bd.data.length != 0"
            >
              <div class="d-flex flex-row">
                <div class="flex-grow-0">
                  <b-field>
                    <b-radio
                      v-model="choix"
                      size="is-medium"
                      native-value="1"
                      :disabled="cacheplein"
                    >
                    </b-radio>
                  </b-field>
                </div>
                <div class="w-100">
                  <div class="">
                    <span class="label-text" style="font-size: 18px; font-weight: 550"
                      >Prendre une offre d'emploi précédente comme modèle</span
                    >
                  </div>
                  <div class="">
                    <span
                      >Copiez une ancienne offre d'emploi et faites des modifications qui
                      s'imposent</span
                    >
                  </div>
                </div>
              </div>
            </a-card>
            <a-card class="d-flex my-1" style="border-radius: 10px">
              <div class="d-flex flex-row">
                <div class="flex-grow-0">
                  <b-field>
                    <b-radio
                      v-model="choix"
                      size="is-medium"
                      native-value="2"
                      :disabled="cacheplein"
                    >
                    </b-radio>
                  </b-field>
                </div>
                <div class="w-100">
                  <div class="">
                    <span class="label-text" style="font-size: 18px; font-weight: 550"
                      >Commencer avec une nouvelle offre</span
                    >
                  </div>
                  <div class="">
                    <span
                      >Utilisez notre outil de publication pour créer votre offre d'emploi
                    </span>
                  </div>
                </div>
              </div>
            </a-card>
            <a-card v-if="cacheplein">
              <b-message
                class="mx-2 my-5 elevation_0 my-card_1"
                title=""
                type="is-danger"
                has-icon
                icon-size="is-medium"
                role="alert"
                :closable="false"
              >
                Vous ne pouvez pas avoir plus de 3 offres d'emploi imcomplets. Vous avez
                déjà trop d'offre d'emploi imcomplet.S'il vous plait, veuillez les achever
                ou les supprimer.
              </b-message>
            </a-card>
            <a-card
              class="d-flex my-1"
              style="border-radius: 10px"
              v-if="store.cache.data.length != 0"
            >
              <div class="d-flex flex-row">
                <div class="flex-grow-0">
                  <b-field>
                    <b-radio v-model="choix" size="is-medium" native-value="3"> </b-radio>
                  </b-field>
                </div>
                <div class="w-100">
                  <div class="">
                    <span class="label-text" style="font-size: 18px; font-weight: 550"
                      >Continuer avec une offre d'emploi imcomplète</span
                    >
                  </div>
                  <div class="">
                    <span
                      >Choisissez parmi les offres imcomplètes disponibles celle que vous
                      voulez achever
                    </span>
                  </div>
                </div>
              </div>
            </a-card>
            <a-card
              v-if="choix == 1"
              class="my-5 elevation_0 my-card_1"
              style="border-radius: 10px"
            >
              <b-table
                :row-class="
                  (row, index) => {
                    return 'c-tr';
                  }
                "
                :data="store.bd.data"
                :loading="store.bd.loading"
                paginated
                backend-pagination
                :total="store.bd.total"
                :per-page="store.bd.results"
                @page-change="onPageChange"
                aria-next-label="Next page"
                aria-previous-label="Previous page"
                aria-page-label="Page"
                aria-current-label="Current page"
                backend-sorting
                :default-sort-direction="store.bd.defaultSortOrder"
                :default-sort="[store.bd.sortField, store.bd.sortOrder]"
                @sort="onSort"
                :checkable="false"
                :current-page.sync="store.bd.currentPage"
                :pagination-simple="store.bd.isPaginationSimple"
                :pagination-position="store.bd.paginationPosition"
                :pagination-rounded="store.bd.isPaginationRounded"
                :sort-icon="store.bd.sortIcon"
                :sort-icon-size="store.bd.sortIconSize"
                :page-input="store.bd.hasInput"
                :pagination-order="store.bd.paginationOrder"
                :page-input-position="store.bd.inputPosition"
                :debounce-page-input="store.bd.inputDebounce"
                :header-checkable="false"
                style="border-radius: 10px"
              >
                <b-table-column v-slot="props">
                  <b-checkbox
                    :value="store.bd.checkedRow.id == props.row.id ? true : false"
                    :native-value="true"
                    @input="ckeckLine('bd', props.row)"
                  >
                  </b-checkbox>
                </b-table-column>
                <b-table-column
                  field="title"
                  label="Titre"
                  sortable
                  v-slot="props"
                  header-class=""
                >
                  {{ props.row.title }}
                </b-table-column>

                <b-table-column field="lieu" label="Lieu" numeric sortable v-slot="props">
                  {{ props.row.lieu }}
                </b-table-column>

                <b-table-column
                  field="created_at"
                  label="Date de publication"
                  sortable
                  centered
                  v-slot="props"
                >
                  {{ moment(props.row.created_at).format("ll") }}
                </b-table-column>
              </b-table>
            </a-card>
            <a-card
              v-if="choix == 3"
              class="my-5 elevation_0 my-card_1"
              style="border-radius: 10px"
            >
              <b-table
                :data="store.cache.data"
                :loading="store.cache.loading"
                :total="store.cache.total"
                :header-checkable="false"
              >
                <b-table-column v-slot="props">
                  <b-checkbox
                    :value="
                      store.cache.checkedRow.index == props.row.index ? true : false
                    "
                    :native-value="true"
                    @input="ckeckLine('cache', props.row)"
                  >
                  </b-checkbox>
                </b-table-column>
                <b-table-column field="title" label="Titre" sortable v-slot="props">
                  {{ props.row.title.value }}
                </b-table-column>
                <b-table-column field="" label="Type" sortable v-slot="props">
                  <vs-button color="danger" type="border">Brouillon d'offre</vs-button>
                </b-table-column>
              </b-table>
            </a-card>
            <a-card class="my-5 elevation_0 my-card_1" style="border-radius: 10px">
              <div class="text-right">
                <b-button type="is-bleue" v-if="choix == 2"
                  ><router-link
                    :to="{
                      path: '/p/posting/',
                      query: { step: 'getting-started', index: shortid.generate() },
                    }"
                  >
                    <span class="text-white">Continuer</span></router-link
                  ></b-button
                >
                <b-button
                  type="is-bleue"
                  v-if="choix == 1"
                  :disabled="store.bd.checkedRow.id == null ? true : false"
                  ><router-link
                    :to="{
                      path: '/p/posting/',
                      query: {
                        step: 'getting-started',
                        index: shortid.generate(),
                        offreModele: formatOffre(store.bd.checkedRow),
                      },
                    }"
                  >
                    <span class="text-white">Continuer</span></router-link
                  ></b-button
                >
                <b-button
                  type="is-bleue"
                  v-if="choix == 3"
                  :disabled="store.cache.checkedRow.index == null ? true : false"
                  ><router-link
                    :to="{
                      path: '/p/posting/',
                      query: {
                        step: 'getting-started',
                        index: store.cache.checkedRow.index,
                      },
                    }"
                  >
                    <span class="text-white">Continuer</span></router-link
                  ></b-button
                >
              </div>
            </a-card>
          </a-card>
        </a-col>
      </a-row>
    </div>
  </div>
</template>

<script>
import publierOffre1 from "../Icons/publier-offre-1.vue";
import shortid from "shortid";
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
import { Switch } from "ant-design-vue";
import { tupleExpression } from "@babel/types";
const queryData = (params, user) => {
  return axios.get("/api/v1/offres/getOffresForUser/" + user.id, {
    params: params,
  });
};
const queryData1 = (user) => {
  return axios.get("/api/v1/offre/cache/getAllOffresCacheUser/" + user.id);
};
export default {
  components: {
    publierOffre1,
  },
  data() {
    return {
      cacheplein: false,
      choix: 2,
      radios: null,
      shortid,
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
    }),
  },
  methods: {
    /*
     * Load async data
     */
    ckeckLine(type, row) {
      if (type == "bd") {
        if (row.id == this.store.bd.checkedRow.id) {
          this.store.bd.checkedRow = { id: null };
        } else this.store.bd.checkedRow = row;
      } else if (type == "cache") {
        if (row.index == this.store.cache.checkedRow.index) {
          this.store.cache.checkedRow = { index: null };
        } else this.store.cache.checkedRow = row;
      }
      // console.log(row.id);
    },
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
    /* loadAsyncData() {
      const params = [

        `sort_by=${this.sortField}.${this.sortOrder}`,
        `page=${this.page}`,
        `results=${this.results}`,
      ].join("&");

      this.loading = true;
      this.$http
        .get(`/api/v1/offres/getOffresForUser/17?${params}`)
        .then(({ data }) => {
          // api.themoviedb.org manage max 1000 pages
          console.log(" data page");
          console.log(data);
          this.data = [];
          let currentTotal = data.total_results;
          if (data.total_results / this.results > 1000) {
            currentTotal = this.results * 1000;
          }
          this.total = currentTotal;
          data.results.forEach((item) => {
            this.data.push(item);
          });
          this.loading = false;
        })
        .catch((error) => {
          this.data = [];
          this.total = 0;
          this.loading = false;
          throw error;
        });
    },*/
    /*
     * Handle page-change event
     */
    onPageChange(page) {
      this.store.bd.currentPage = page;
      this.fetch({
        results: this.store.bd.results,
        page: this.store.bd.currentPage,
        sortField: this.store.bd.sortField,
        sortOrder: this.store.bd.sortOrder,
      });
    },
    /*
     * Handle sort event
     */
    onSort(field, order) {
      //if(type=='bd'){
      this.store.bd.sortField = field;
      this.store.bd.sortOrder = order;
      this.fetch({
        results: this.store.bd.results,
        page: this.store.bd.currentPage,
        sortField: this.store.bd.sortField,
        sortOrder: this.store.bd.sortOrder,
      });
    },
    telephoneFormat(row) {
      let phone_number = "";
      let indic_tel = "";

      if (row.telephone) {
        if (row.telephone.phone_number) {
          phone_number = row.telephone.phone_number;
        }
        if (row.telephone.indic_tel) {
          indic_tel = row.telephone.indic_tel;
        }
      }
      return {
        phone_number,
        indic_tel,
      };
    },
    formatHoraire(row) {
      let horaires = [];
      if (row.horaire) {
        horaires = JSON.parse(row.horaires);
      }
      return horaires;
    },
    formatDuree(row) {
      let duree = {
        nbrTime: 0,
        time: "Jour(s)",
      };
      if (row.duree) {
        duree.nbrTime = JSON.parse(row.duree).nbrTime;
        duree.time = JSON.parse(row.duree).time;
      }
      console.log("yeah");
      return duree;
    },
    formatSalaire(row) {
      let salaire = {
        devise: "F",
        montant: 0,
        frequence: "par jour",
      };
      if (row.salaire) {
        salaire.devise = row.salaire.devise;
        salaire.montant = row.salaire.montant;
        salaire.frequence = row.salaire.frequence;
      }
      return salaire;
    },
    formatOffre(row) {
      if (row.id != null) {
        return {
          title: {
            value: row.title || "",
          },
          type: {
            value: row.type || "",
            required: true,
          },
          lieu: {
            value: row.lieu || "",
            required: true,
          },
          secteur: {
            value: row.secteur || "",
            required: true,
          },
          description: {
            value: row.description || "",
            required: true,
          },
          exigences: {
            value: row.exigences || "",
            required: false,
          },
          auto_convers: {
            value: row.auto_convers || false,
            required: true,
          },
          telephone: {
            value: {
              contact: {
                value: this.telephoneFormat(row),
              },
              //candidature: [],
            },
            required: false,
          },
          autoriseMail: {
            value: row.autoriseMail,
            required: true,
          },
          isSwitched: {
            value: row.reject == null ? false : true,
            required: true,
          },
          zone: {
            value: row.zone || "",
            required: "",
          },
          date_limite: {
            value: row.date_limite ? row.date_limite : null,
            type: "date",
            valide: (v) => {},
          },
          date_deb: {
            value: row.date_deb ? row.date_deb : null,
            required: false,
            type: "date",
          },
          nbr: {
            value: row.nbr || 0,
            required: false,
          },
          duree: {
            value: this.formatDuree(row),
            required: false,
          },
          salaire: {
            value: this.formatSalaire(row),
            required: false,
          },
          urgence: {
            value: row.urgence || "",
            required: true,
          },
          emails: {
            value: JSON.parse(row.emails) || {},
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
            value: JSON.parse(row.moyens) || [],
            required: true,
          },
          docs: {
            value: JSON.parse(row.docs) || [],
            required: true,
          },
          horaires: {
            value: this.formatHoraire(row.horaires),
            required: true,
          },
          dated: row.date_deb ? true : false,
          datef: row.date_limite ? true : false,
          niveau_exp: {
            value: row.niveau_exp,
            required: false,
          },
          niveau_std: {
            value: JSON.parse(row.niveau_std) || [],
            required: false,
          },
          candidature: {
            value: JSON.parse(row.candidature) || {
              emails: [],
              phones: [],
              lieu: [],
            },
            required: false,
          },
          reject: {
            value: row.reject,
            required: false,
          },
        };
      } else return null;
    },
  },
  mounted() {
    this.fetch();
    this.fetch1();
    if (this.store.cache.data.length >= 3) {
      this.cacheplein = true;
    }
  },
};
</script>
<style scoped lang="scss">
.c-tr {
  min-height: 70px !important;
  //border-bottom: 5em solid white;
}
.c-table {
  border-radius: 10px !important;
}
table {
  border-radius: 10px !important;
  background-color: transparent;
}
.t1 {
  color: rgb(45, 45, 45);
  font-weight: 700;
  font-family: "Noto Sans", "Helvetica Neue", "Helvetica", "Arial", "Liberation Sans",
    "Roboto", "Noto", sans-serif;
  font-size: 1.75rem;
  line-height: 1.25;
  margin: 0px;
  max-width: 350px;
  overflow-wrap: break-word;
  word-break: break-word;
}
</style>
