<!--<template>
  <div
    v-infinite-scroll="handleInfiniteOnLoad"
    class="demo-infinite-container"
    :infinite-scroll-disabled="busy"
    :infinite-scroll-distance="10"
  >
    <a-list :data-source="data">
      <a-list-item slot="renderItem" slot-scope="item, index">
        <a-list-item-meta :description="item.user.email">
          <a slot="title" :href="item.user.pseudo">{{ item.user.pseudo }}</a>
          <a-avatar
            slot="avatar"
            :src="item.user.avatar.url"
            v-if="item.user.avatar != null"
          />
          <vs-avatar v-else />
        </a-list-item-meta>
        <div>{{ item.body }}</div>
      </a-list-item>
      <div v-if="loading && !busy" class="demo-loading-container">
        <a-spin />
      </div>
    </a-list>
  </div>
</template>
<script>
import reqwest from "reqwest";
import infiniteScroll from "vue-infinite-scroll";
const queryData = (params) => {
  return axios.get("/api/v1/realisations/" + 151 + "/commentsPaginate", {
    params: params,
  });
};
//const fakeDataUrl =
//"https://randomuser.me/api/?results=5&inc=name,gender,email,nat&noinfo";
export default {
  directives: { infiniteScroll },
  data() {
    return {
      data: [],
      loading: false,
      busy: false,

      loading: false,
      seyd: [],
      currentPage: 1,
      total: 0,
    };
  },
  beforeMount() {
    this.fetchData((res) => {
      console.log("resultats");
      console.log(res);
      this.data = res.data;
    });
    /*  this.queryData({ page: 1 }).then((res) => {
      console.log("feme");
      console.log(res);
    });*/
    //this.fetch();
    /*this.fetchData((res) => {
      console.log("resultats");
      console.log(res);
      this.data = res.data;
      console.log(this.data);
    });*/
  },
  methods: {
    /*  fetchData(callback) {
      reqwest({
        url: fakeDataUrl,
        type: "json",
        method: "get",
        contentType: "application/json",
        success: (res) => {
          callback(res);
        },
      });
    },*/
    fetchData(callback) {
      // console.log(callback);
      reqwest({
        url: "/api/v1/realisations/" + 151 + "/commentsPaginate",
        type: "json",
        method: "get",
        contentType: "application/json",
        params: { page: this.currentPage },
        success: (res) => {
          callback(res);
        },
      });
    },
    handleInfiniteOnLoad() {
      const data = this.data;
      this.loading = true;
      if (data.length > 14) {
        this.$message.warning("Infinite List loaded all");
        this.busy = true;
        this.loading = false;
        return;
      }
      // this.fetch({ page: this.currentPage });
      this.fetchData((res) => {
        /*  console.log("resoum");
        console.log(res);
        this.data = data.concat(res.data);
        this.loading = false;
        this.currentPage = this.currentPage + 1;*/
        this.data = data.concat(res.data);
        this.loading = false;
        this.currentPage = this.currentPage + 1;
      });
    },
    fetch(params = { page: 1 }) {
      this.loading = true;
      queryData(params).then(({ data }) => {
        // const pagination = { ...this.pagination };
        //const sorter = { ...this.sorter };
        // Read total count from server

        console.log("res");
        console.log(data);
        const val = [...this.data];
        this.data = val.concat(data.data);
        //  this.currentPage = data.meta.current_page;
        this.loading = false;
        this.total = data.meta.total;
        /* pagination.pageSize = Number(data.meta.per_page);
        this.loading = false;
        console.log(data.data);
        console.log("trie");
        this.data = data.data;
        this.pagination = pagination;
        this.seyd = val.concat(data.data);
        console.log("seyd");
        console.log(this.seyd);
        this.sorter = sorter;
        this.currentPage = params.page;*/
      });
    },

    /* handleInfiniteOnLoad() {
      const data = this.data;
      console.log("data1");
      console.log(this.data);
      this.loading = true;
      if (data.length > this.total) {
        this.$message.warning("Infinite List loaded all");
        this.busy = true;
        this.loading = false;
        return;
      }
      this.currentPage = this.currentPage + 1;
      console.log("currpage");
      console.log(this.currentPage);
      this.fetch({ page: this.currentPage });

      /*
      this.fetchData((res) => {
        this.data = data.concat(res.results);
        this.loading = false;
      });*
    },*/
  },
};
</script>
<style>
.demo-infinite-container {
  border: 1px solid #e8e8e8;
  border-radius: 4px;
  overflow: auto;
  padding: 8px 24px;
  height: 300px;
}
.demo-loading-container {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}
</style>
<template>
  <a-list>
    <RecycleScroller
      v-infinite-scroll="handleInfiniteOnLoad"
      style="height: 400px"
      :items="data"
      :item-size="12"
      key-field="id"
      :infinite-scroll-disabled="busy"
      :infinite-scroll-distance="2"
    >
      <a-list-item slot-scope="{ item }">
        <a-list-item-meta :description="item.user.email">
          <a slot="title" :href="item.user.pseudo">{{ item.user.pseudo }}</a>
          <a-avatar
            slot="avatar"
            :src="item.user.avatar.url"
            v-if="item.user.avatar != null"
          />
          <vs-avatar v-else />
        </a-list-item-meta>
        <div>Content {{ item.index }}</div>
      </a-list-item>
    </RecycleScroller>
    <a-spin v-if="loading" class="demo-loading" />
  </a-list>
</template>
<script>
import reqwest from "reqwest";
import infiniteScroll from "vue-infinite-scroll";
import { RecycleScroller } from "vue-virtual-scroller";
import "vue-virtual-scroller/dist/vue-virtual-scroller.css";
const fakeDataUrl =
  "https://randomuser.me/api/?results=10&inc=name,gender,email,nat&noinfo";
export default {
  directives: { infiniteScroll },
  components: {
    RecycleScroller,
  },
  data() {
    return {
      data: [],
      loading: false,
      busy: false,
    };
  },
  beforeMount() {
    this.fetchData((res) => {
      console.log("com");
      console.log(res);
      this.data = res.data.map((item, index) => ({ ...item, index }));
    });
  },
  methods: {
    fetchData(callback) {
      reqwest({
        url: "/api/v1/realisations/" + 151 + "/commentsPaginate",
        type: "json",
        params: { page: this.currentPage },
        method: "get",
        contentType: "application/json",
        success: (res) => {
          callback(res);
        },
      });
    },
    handleInfiniteOnLoad() {
      const data = this.data;
      this.loading = true;
      if (data.length > 20) {
        this.$message.warning("Infinite List loaded all");
        this.busy = true;
        this.loading = false;
        return;
      }
      this.fetchData((res) => {
        console.log("res");
        console.log(res);
        this.data = data.concat(res.data).map((item, index) => ({ ...item, index }));
        this.loading = false;
      });
    },
  },
};
</script>
<style>
.demo-loading {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}
</style>lop
<template>
  <div
    v-infinite-scroll="handleInfiniteOnLoad"
    class="demo-infinite-container"
    :infinite-scroll-disabled="busy"
    :infinite-scroll-distance="2"
  >
    <a-list :data-source="data">
      <a-list-item slot="renderItem" slot-scope="item, index">
        <a-list-item-meta :description="item.user.email">
          <a slot="title" :href="item.user.pseudo">{{ item.user.pseudo }}</a>
          <a-avatar
            slot="avatar"
            :src="item.user.avatar.url"
            v-if="item.user.avatar != null"
          />
          <vs-avatar v-else />
        </a-list-item-meta>
        <div>{{ item.body }}</div>
      </a-list-item>
      <div v-if="loading && !busy" class="demo-loading-container">
        <a-spin />
      </div>
    </a-list>
  </div>
</template>
<script>
import reqwest from "reqwest";
import infiniteScroll from "vue-infinite-scroll";
const fakeDataUrl =
  "https://randomuser.me/api/?results=5&inc=name,gender,email,nat&noinfo";
export default {
  directives: { infiniteScroll },
  data() {
    return {
      data: [],
      loading: false,
      busy: false,
      seyd: [],
      currentPage: 1,
      total: 0,
    };
  },
  beforeMount() {
    this.fetchData((res) => {
      console.log(res);
      this.data = res.data;
      this.currentPage = this.currentPage + 1;
      this.total = res.meta.total;
    });
  },
  methods: {
    fetchData(callback) {
      reqwest({
        url: "/api/v1/realisations/" + 151 + "/commentsPaginate",
        type: "json",
        data: { page: this.currentPage },
        method: "get",
        contentType: "application/json",
        success: (res) => {
          callback(res);
        },
      });
    },
    handleInfiniteOnLoad() {
      const data = this.data;
      this.loading = true;
      if (data.length > this.total) {
        this.$message.warning("Infinite List loaded all");
        this.busy = true;
        this.loading = false;
        return;
      }
      this.fetchData((res) => {
        this.data = data.concat(res.data);
        this.currentPage = this.currentPage + 1;
        this.loading = false;
      });
    },
  },
};
</script>
<style>
.demo-infinite-container {
  border: 1px solid #e8e8e8;
  border-radius: 4px;
  overflow: auto;
  padding: 8px 24px;
  height: 100px;
}
.demo-loading-container {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}
</style>
  v-infinite-scroll="handleInfiniteOnLoad"
      style="height: 300px"
       :infinite-scroll-disabled="busy"
--
<template>
  <a-list>
    <RecycleScroller
      :items="data"
      :item-size="73"
      key-field="id"
      :infinite-scroll-distance="2"
    >
      <a-list-item slot-scope="{ item }">
        <a-list-item-meta :description="item.user.email">
          <a slot="title" :href="item.user.pseudo">{{ item.user.pseudo }}</a>
          <a-avatar
            slot="avatar"
            :src="item.user.avatar.url"
            v-if="item.user.avatar != null"
          />
          <vs-avatar v-else />
        </a-list-item-meta>
        <div>Content {{ item.body }}</div>
      </a-list-item>
    </RecycleScroller>
    <a-spin v-if="loading" class="demo-loading" />
  </a-list>
</template>
<script>
import reqwest from "reqwest";
import infiniteScroll from "vue-infinite-scroll";
import { RecycleScroller } from "vue-virtual-scroller";
import "vue-virtual-scroller/dist/vue-virtual-scroller.css";
const fakeDataUrl =
  "https://randomuser.me/api/?results=10&inc=name,gender,email,nat&noinfo";
export default {
  directives: { infiniteScroll },
  components: {
    RecycleScroller,
  },
  data() {
    return {
      data: [],
      loading: false,
      busy: false,
      currentPage: 0,
      total: 0,
      lastPage: 0,
    };
  },
  beforeMount() {
    this.fetchData((res) => {
      this.data = res.data.map((item, index) => ({ ...item, index }));
      this.total = res.meta.total;
      this.lastPage = res.meta.last_page;
      console.log(this.data);
    });
  },
  methods: {
    fetchData(callback) {
      reqwest({
        url: "/api/v1/realisations/" + 151 + "/commentsPaginate",
        type: "json",
        data: { page: this.currentPage == 0 ? 1 : this.currentPage },
        method: "get",
        contentType: "application/json",
        success: (res) => {
          callback(res);
        },
      });
    },
    handleInfiniteOnLoad() {
      const data = this.data;
      this.loading = true;
      console.log("total");
      console.log(this.total);
      if (data.length > this.total) {
        this.$message.warning("Infinite List loaded all");
        this.busy = true;
        this.loading = false;
        return;
      }
      /* this.fetchData((res) => {
        this.data = data.concat(res.data);
        this.currentPage = this.currentPage + 1;
        this.loading = false;
      });*/
      this.fetchData((res) => {
        console.log("tire");
        console.log(res);
        this.data = data.concat(res.data).map((item, index) => ({ ...item, index }));
        this.currentPage =
          this.currentPage < this.lastPage ? this.currentPage + 1 : this.currentPage;
        this.loading = false;
      });
    },
    handleScroll(event) {
      if (this.data.length < 10) {
        console.log("scroller");
        if(window.height)
        this.handleInfiniteOnLoad();
      }
    },
  },
  created() {
    window.addEventListener("scroll", this.handleScroll);
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  },
};
</script>
<style>
.demo-loading {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}
</style>
-->
<template>
  <div class="">
    <!-- <div class="position-relative" id="celine">
      <h1>Random User</h1>
      <div class="user" v-for="item in data" :key="item.id">
        <div class="user-avatar">
          <img :src="item.user.avatar.url" v-if="item.user.avatar != null" />
          <vs-avatar v-else />
        </div>
        <div class="user-details">
          <h2 class="user-name">
            {{ item.pseudo }}
            {{ item.body }}
          </h2>
          !-- <ul>
            <li><strong>Birthday:</strong> {{ formatDate(user.dob.date) }}</li>
            <li>
              <strong>Location:</strong> {{ user.location.city }}, {{ user.location.state }}
            </li>
          </ul>--
        </div>
      </div>
      <a-spin v-if="loading" class="demo-loading" />
    </div>-->
    <div>
      <a-list :data-source="data">
        <a-list-item slot="renderItem" slot-scope="item">
          <a-list-item-meta :description="item.user.email">
            <a slot="title" :href="item.user.pseudo">{{ item.user.pseudo }}</a>
            <a-avatar
              slot="avatar"
              :src="item.user.avatar.url"
              v-if="item.user.avatar != null"
            />
            <vs-avatar v-else />
          </a-list-item-meta>
          <div>{{ item.body }}</div>
        </a-list-item>
        <div v-if="loading && !busy" class="demo-loading-container">
          <a-spin />
        </div>
      </a-list>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      users: [],
      data: [],
      loading: false,
      busy: false,
      // firstPage: 1,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false,
    };
  },
  methods: {
    getInitialUsers() {
      this.loading = true;
      axios
        .get("/api/v1/realisations/" + 151 + "/commentsPaginate", {
          params: { page: 1 },
        })
        .then((res) => {
          console.log("res");
          console.log(res.data.data);
          this.data = res.data.data;
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          //  this.currentPage = res.data.meta.currentPage;
          this.nextPage = this.nextPage < this.lastPage ? 2 : this.lastPage;
          this.loading = false;
          // this.users = response.data.results;
        });
    },
    getNextUser() {
      window.onscroll = () => {
        //console.log(document.documentElement.scrollTop);
        //console.log(window.innerHeight);
        // console.log(document.documentElement.offsetHeight);
        console.log(document.documentElement);
        console.log("window.innerHeight");
        console.log(window.innerHeight);
        console.log("srolltop");
        console.log(document.documentElement.scrollTop);
        console.log("srollheight");
        console.log(document.documentElement.scrollHeight);
        console.log("offsetHeight");
        console.log(document.documentElement.offsetHeight); //
        console.log("somme"); // console.log("celine");
        console.log(
          document.documentElement.scrollTop + document.documentElement.offsetHeight
        );
        //  console.log(Number(document.getElementById("celine").style.height));
        // console.log(document.getElementById("celine").style.height);
        /* let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.documentElement.scrollHeight;*/
        /* let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.getElementById("celine").style.height;*/
        /* let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.documentElement.scrollHeight; */ let bottomOfWindow =
          document.documentElement.scrollTop + document.documentElement.offsetHeight ===
          document.documentElement.scrollHeight;
        if (this.data.length >= this.total) {
          // this.$message.warning("Infinite List loaded all");
          this.loading = false;
          this.fini = true;
          return;
        }
        console.log("bootomW");
        console.log(bottomOfWindow);
        if (bottomOfWindow && this.fini == false) {
          this.loading = true;
          axios
            .get("/api/v1/realisations/" + 151 + "/commentsPaginate", {
              params: { page: this.nextPage },
            })
            .then((res) => {
              this.data = this.data.concat(res.data.data);
              //this.data = res.data.data;
              this.currentPage = res.data.meta.currentPage || this.currentPage;
              this.nextPage =
                this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;
              this.loading = false;
            });
        }
      };
    },
  },
  mounted() {
    console.log("monted");
    this.getNextUser();
    console.log(window.Echo);
    window.Echo.channel("realisation").listen(".realisation.created", (e) => {
      // this.addTodo(e.task);
      //this.$store.commit("task/ADD_TODO", e.task);
      // this.newTodo.title = "";
      console.log(e);
      console.log("real ajouter avec succès");
    });
    window.Echo.channel("realisation").listen("realisation.created", (e) => {
      // this.addTodo(e.task);
      //this.$store.commit("task/ADD_TODO", e.task);
      // this.newTodo.title = "";
      console.log(e);
      console.log("real ajouter avec succès");
    });
  },
  beforeMount() {
    console.log("befmonted");
    this.getInitialUsers();
  },
};
</script>
<style>
.user {
  display: flex;
  background: #ccc;
  border-radius: 1em;
  margin: 1em auto;
}

.user-avatar {
  padding: 1em;
}

.user-avatar img {
  display: block;
  width: 100%;
  min-width: 64px;
  height: auto;
  border-radius: 50%;
}

.user-details {
  padding: 1em;
}

.user-name {
  margin: 0;
  padding: 0;
  font-size: 2rem;
  font-weight: 900;
}

.demo-loading {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}

.demo-infinite-container {
  border: 1px solid #e8e8e8;
  border-radius: 4px;
  overflow: auto;
  padding: 8px 24px;
  height: 300px;
}
.demo-loading-container {
  position: absolute;
  bottom: 40px;
  width: 100%;
  text-align: center;
}
</style>
