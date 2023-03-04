<template>
  <div class="w-100 h-100">
    <a-card style="margin: 50px">
      <a-row>
        <a-col :md="{ offset: 2, span: 20, offset: 2 }" :xs="{ span: 24 }">
          <div>
            <p
              class="font-weight-black text-h1 text-center vert-b"
              style="color: black; opacity: 1; margin: 20px 0px; box-sizing: content"
            >
              <b-field>
                <template #label>
                  <span
                    style="font-size: 40px; color: white"
                    class="font-weight-black text-h4"
                    >Trouvez des entreprises</span
                  >
                </template>
              </b-field>
            </p>
          </div>
          <div>
            <b-field label="">
              <b-input
                placeholder="Rechercher par nom de l'entreprise"
                type="search"
                icon-pack="fas"
                icon="search"
                expanded
                v-model="searchText"
                icon-right="close-circle"
                icon-right-clickable
                @icon-right-click="
                  searchText = '';
                  searchBy();
                "
              >
              </b-input>
              <p class="control">
                <b-button type="is-bleue" @click="searchBy()"
                  >Trouver l'entreprise</b-button
                >
              </p>
            </b-field>
          </div>
          <div>
            <div
              class="d-flex flex-row flex-wrap justify-content-between align-items-center"
              v-if="store.bd.data.length != 0"
            >
              <company-box
                class="mx-2 my-2 pointer-c"
                style="border-radius: 12px"
                v-for="company in store.bd.data"
                :key="company.id"
                :company="company"
              >
              </company-box>
            </div>
            <div
              v-else-if="store.bd.data.length == 0 && store.bd.loading == false"
              class="d-flex flex-column justify-content-center align-items-center"
            >
              <no-data-1 height="300px" width="300px"></no-data-1>
              <b-field>
                <div>Aucun résultat pour cette recherche</div>
              </b-field>
            </div>
            <b-skeleton
              v-if="store.bd.loading == true"
              class="mode"
              active
              is-centered
              size="is-large"
              height="250"
              count="1"
            ></b-skeleton>

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
          </div>
        </a-col>
      </a-row>
    </a-card>
  </div>
</template>
<script>
import CompanyBox from "./CompanyBox.vue";
import noData1 from "../Icons/no-data-1.vue";
const queryData = (params) => {
  return axios.get("/api/v1/companies/", {
    params: params,
  });
};
export default {
  components: { CompanyBox, noData1 },
  data() {
    return {
      searchText: "",
      store: {
        bd: {
          data: [],
          loading: false,
          sortField: "id",
          sortOrder: "asc",
          defaultSortOrder: "asc",
          results: 12,
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
          search: "",
        },
      },
    };
  },
  methods: {
    fetch(
      params = { results: 12, page: 1, sortField: "id", sortOrder: "asc", search: "" }
    ) {
      console.log("this.store");
      console.log(this.store);
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
    searchBy() {
      this.store.bd.search = this.searchText;
      this.fetch({
        results: this.store.bd.results,
        page: this.store.bd.currentPage,
        sortField: this.store.bd.sortField,
        sortOrder: this.store.bd.sortOrder,
        search: this.store.bd.search,
      });
    },
    onPageChange(page) {
      this.store.bd.currentPage = page;
      this.fetch({
        results: this.store.bd.results,
        page: this.store.bd.currentPage,
        sortField: this.store.bd.sortField,
        sortOrder: this.store.bd.sortOrder,
        search: this.store.bd.search,
      });
    },
  },
  async beforeMount() {
    this.fetch();
  },
  mounted() {},
};
</script>
<style scoped>
.pointer-c {
  cursor: pointer;
}
</style>
