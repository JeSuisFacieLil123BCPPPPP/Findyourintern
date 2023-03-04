<template>
  <div>
    <v-row class="ms-2">
      <v-col cols="4">
        <div class="input-group md-form form-sm mt-2 pl-0">
          <input
            class="form-control form-control-min my-0 py-1 amber-border"
            v-model="searchtext"
            type="search"
            placeholder="Search here..."
            aria-label="Search"
          />
          <div class="input-group-append" @click="searchtext = ''">
            <span
              class="input-group-text c-pointer py-2 px-3"
              id="basic-text1"
              style="color: #24855a"
            >
              <v-icon>mdi-magnify</v-icon>
            </span>
          </div>
        </div>
      </v-col>
    </v-row>
    <a-table
      style=""
      class="table12 m-2"
      :columns="columns"
      :row-key="(record) => record.id"
      :data-source="data"
      :pagination="pagination"
      :loading="loading"
      @change="handleTableChange"
      :rowClassName="
        (record, index) => {
          return 'elevation_1 table-tr';
        }
      "
    >
      <!-- <template slot="id" slot-scope="id"
        >{{ id }}
        !-- <span class="bg-danger" v-if="user.is_locked == true">Bloqué(e)</span>
        <span class="bg-success" v-else>Activé(e)</span>--</template>-->
      <template slot="data_res" slot-scope="title, realis">
        <div class="d-flex bd-highlight">
          <div class="p-2 bd-highlight">
            <a-avatar
              class="min-width:50px"
              shape="square"
              :size="50"
              v-if="realis.poster != null"
              :src="realis.poster.variants['small'].secure_url"
            />
            <a-avatar shape="square" :size="50" icon="user" v-else />
          </div>
          <div class="p-2 flex-grow-1 bd-highlight">
            <span class="d-block">{{ realis.title || "" }} </span>
            <span
              v-html="realis.description"
              class="d-inline-block description"
              style="max-width: 200px; max-height: 40px"
            >
            </span>
          </div>
        </div>
      </template>
      <template slot="date" slot-scope="date, realis">
        <span v-if="user.created_at != null">{{
          moment(realis.created_at).format("LLLL")
        }}</span>
        <span v-else>{{ "-" }}</span></template
      >
      <template slot="valide" slot-scope="valide, realis">
        <span v-if="realis.valide == 1"
          ><vs-button color="success" type="border">Validé</vs-button></span
        >
        <span v-else
          ><vs-button color="danger" type="border">En attente</vs-button></span
        ></template
      >
      <template slot="operation" slot-scope="value, realis">
        <v-btn @click="dialogDelete(realis)" class="mx-2" fab danger small color="red">
          <v-icon color="white darken-2" :size="25"> mdi-delete </v-icon>
        </v-btn>
      </template>
    </a-table>
  </div>
</template>
<script>
//import axios from "axios";

import { mapGetters, mapActions } from "vuex";
import { Switch } from "ant-design-vue";
import moment from "moment";
const queryData = (params, user) => {
  return axios.get("/api/v1/realisations/getRealisationsForUser/" + user.id, {
    params: params,
  });
  /* .then((response) => {
      console.log(response);
    })
    .catch((error) => {
      console.log(error);
      //this.errored = true
    });*/
  //.finally(() => this.loading = false);
};
const columns = [
  /* {
    title: "Id",
    dataIndex: "id",
    sorter: false,
    // width: "20%",
    scopedSlots: { customRender: "id" },
  },*/
  {
    title: "Données de la realisation",
    dataIndex: "title",
    sorter: false,
    //width: "350px",
    scopedSlots: { customRender: "data_res" },
  },
  {
    title: "Date",
    dataIndex: "created_at",
    sorter: true,
    scopedSlots: { customRender: "date" },
  },
  {
    title: "Etat",
    dataIndex: "valide",
    sorter: false,
    scopedSlots: { customRender: "valide" },
  },
  {
    title: "Actions",
    //dataIndex: "user_type",
    //sorter: true,
    scopedSlots: { customRender: "operation" },
  },
];

export default {
  data() {
    return {
      data: [],
      pagination: {},
      sorter: {},
      results: 5,
      loading: false,
      columns,
      currentPage: 0,
      searchtext: "",
      moment,
      seyd: [],
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  mounted() {
    this.fetch();
    // this.getRealisationsForUser();
  },
  /* async beforeMount() {
    await this.getRealisationsForUser();
  },*/
  methods: {
    /* async getRealisationsForUser(result,page,sortFiled,sortOrder) {
      await axios
        .get("/api/v1/realisations/getRealisationsForUser"+user.id, {
          params: { results: 2, page: 3, sortField: "created_at", sortOrder: "asc" },
        })
        .then((response) => {
         // console.log("yeahhhhhhhhhhhhhhhhhhh");
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
          //this.errored = true
        });
      //.finally(() => this.loading = false)
    },*/
    sortFunction(sorter) {
      if (sorter != null) {
        if (sorter.order == "ascend") return "asc";
        else if (sorter.order == "descend") return "desc";
        //else return "normal";
      } else {
        return this.sorter.order;
      }
    },
    handleTableChange(pagination, filters, sorter) {
      //console.log(pagination);
      //console.log(filters);
      //console.log(sorter);
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
      //console.log(pager.current);
      console.log("sorter");
      console.log(sorter);
      this.fetch({
        results: pagination.pageSize || this.results,
        page: pagination.current || this.currentPage,
        sortField: sorter.field || this.sorter.field,
        sortOrder: this.sortFunction(sorter),
        //...filters,
      });
    },
    fetch(params = { results: 6, page: 1, sortField: "id", sortOrder: "asc" }) {
      this.loading = true;
      queryData(params, this.user).then(({ data }) => {
        const pagination = { ...this.pagination };
        const sorter = { ...this.sorter };
        // Read total count from server
        pagination.total = data.meta.total;
        pagination.pageSize = Number(data.meta.per_page);
        sorter.field = params.sortField;
        sorter.order = params.sortOrder;
        this.loading = false;
        console.log(data.data);
        console.log("trie");
        console.log(sorter);
        this.data = data.data;
        this.pagination = pagination;
        const val = [...this.seyd];
        this.seyd = val.concat(data.data);
        console.log("seyd");
        console.log(this.seyd);
        this.sorter = sorter;
        this.currentPage = params.page;
        this.results = params.results;
      });
    },
    deleteRealis(realis) {
      return axios.delete("/api/v1/realisation/delete/" + realis.id);

      // await this.getAllUsers();
    },
    dialogDelete(realis) {
      this.$buefy.dialog.confirm({
        title: "Suppression d'une réalisation",
        message: "Est-tu sûr de vouloir supprimer cette réalisation/projet ?",
        type: "is-danger",
        hasIcon: true,
        icon: "times-circle",
        iconPack: "fa",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: async () => {
          await this.deleteRealis(realis)
            .then((response) => {
              console.log("res");
              console.log(response);
              this.$vs.notify({
                time: 6000,
                color: "success",
                title: "SUCCES DE L'OPERATION",
                text: "REALISATION SUPPRIMEE AVEC SUCCES!",
              });
            })
            .catch(({ response: { data } }) => {
              alert(data.message);
            });
          this.handleTableChange(this.pagination, null, this.sorter);
        },
      });
    },
  },
};
</script>
<style lang="scss" scoped>
$color1: rgb(71, 218, 135);
$color2: rgb(94, 150, 239);
$color3: rgb(192, 195, 200);
input[type="search"] {
  border-radius: 4px;
}
.table-tr {
  background: blue;
  border-radius: 10px;
  border-color: chartreuse;
  border-width: 3px;
  border-style: solid;
  /*box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2), 0 3px 4px rgba(0, 0, 0, 0.14),
    0 3px 3px -2px rgba(0, 0, 0, 0.12);*/
}

.description {
  max-height: 50px !important;
  overflow: hidden;
  display: inline-block;
  :deep(img) {
    display: none !important;
  }
  &:after {
    content: "...";
  }
}

.table12 {
  border-collapse: separate;
  border-spacing: 0px 12px;
}
</style>
