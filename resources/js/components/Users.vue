<template>
  <v-app>
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
              class="input-group-text c-pointer blue lighten-3 py-2 px-3"
              id="basic-text1"
            >
              <v-icon>mdi-magnify</v-icon>
            </span>
          </div>
        </div>
      </v-col>
    </v-row>
    <a-table
      style="min-width: 500px"
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
      <template slot="id" slot-scope="id">{{ id }} </template>
      <template slot="email" slot-scope="email, user">
        <v-row vs-align="center" vs-justify="left" class="">
          <v-col cols="2">
            <a-badge :dot="true">
              <a-avatar
                class="min-width:50px"
                shape="square"
                :size="50"
                v-if="user.avatar != null"
                :src="user.avatar.variants['small'].secure_url"
              />
              <a-avatar shape="square" :size="50" icon="user" v-else />
            </a-badge>
          </v-col>
          <v-col cols="10" style="word-break: normal; min-width: 300px">
            <span class="d-block">{{ user.email || "" }} </span>
            <span class="d-block">{{ user.pseudo || "" }} </span>
          </v-col>
        </v-row>
      </template>
      <template slot="phone" slot-scope="phone, user">
        <span v-if="user.phone != null">{{ user.phone.phone_number || "-" }}</span>
        <span v-else>{{ "-" }}</span></template
      >
      <template slot="user_type" slot-scope="user_type, user">
        <vs-button disabled type="border">
          {{ user.user_type || "-" }}</vs-button
        ></template
      >
      <template slot="operation" slot-scope="value, user">
        <v-btn @click="dialogLocked(user)" class="mx-2" fab danger small color="primary">
          <v-icon color="blue lighten-5" :size="25" v-if="user.is_locked == true">
            mdi-lock-open
          </v-icon>
          <v-icon color="blue lighten-5" v-else :size="25"> mdi-lock </v-icon>
        </v-btn>
      </template>
    </a-table>
  </v-app>
</template>
<script>
//import axios from "axios";

import { Switch } from "ant-design-vue";

const queryData = (params) => {
  return axios.get("/api/v1/users/list", { params: params });
};
const columns = [
  {
    title: "Id",
    dataIndex: "id",
    sorter: true,
    // width: "20%",
    scopedSlots: { customRender: "id" },
  },
  {
    title: "UserInfo",
    dataIndex: "email",
    sorter: true,
    //width: "20%",
    scopedSlots: { customRender: "email" },
  },
  {
    title: "Phone",
    dataIndex: "phone.phone_number",
    //width: "20%",
    sorter: false,
    scopedSlots: { customRender: "phone" },
  },
  {
    title: "Type de user",
    dataIndex: "user_type",
    sorter: true,
    scopedSlots: { customRender: "user_type" },
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
      results: 6,
      loading: false,
      columns,
      currentPage: 0,
      searchtext: "",
    };
  },
  mounted() {
    this.fetch();
    // this.getAllUsers();
  },
  /* async beforeMount() {
    await this.getAllUsers();
  },*/
  methods: {
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
      const pager = { ...this.pagination };
      pager.current = pagination.current;
      this.pagination = pager;
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
      queryData(params).then(({ data }) => {
        const pagination = { ...this.pagination };
        const sorter = { ...this.sorter };
        pagination.total = data.meta.total;
        pagination.pageSize = Number(data.meta.per_page);
        sorter.field = params.sortField;
        sorter.order = params.sortOrder;
        this.loading = false;
        console.log(data);
        console.log("trie");
        console.log(sorter);
        this.data = data.data;
        this.pagination = pagination;
        this.sorter = sorter;
        this.currentPage = params.page;
        this.results = params.results;
      });
    },
    async bannedUser(user) {
      await axios
        .put("/api/v1/users/edit/" + user.id, { is_locked: !user.is_locked })
        .then((response) => {
          alert(response.data.message);
        })
        .catch(({ response: { data } }) => {
          alert(data.message);
        });
      this.handleTableChange(this.pagination, null, this.sorter);
      // await this.getAllUsers();
    },
    dialogLocked(user) {
      this.$buefy.dialog.confirm({
        title: "Deleting account",
        message: "Are you sure you want to locked the user" + user.pseudo + " ?",
        confirmText: "Locked Account",
        type: "is-danger",
        hasIcon: true,
        onConfirm: async () => {
          await this.bannedUser(user);
          return this.$buefy.toast.open("Account locked!");
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
.table12 {
  border-collapse: separate;
  border-spacing: 0px 12px;
}
</style>
