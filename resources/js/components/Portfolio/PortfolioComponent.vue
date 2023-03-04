<template>
  <v-app class="m-2">
    <div v-if="loading == true">
      <a-spin></a-spin>
    </div>

    <div class="d-flex flex-row" v-else>
      <div>
        <div class="p-2">
          <vs-avatar
            size="large"
            v-if="portfolio.user.avatar != null"
            :src="portfolio.user.avatar.url"
          />
          <vs-avatar size="large" v-else></vs-avatar>
        </div>
        <div class="d-flex flex-column p-2 flex-grow-1" style="max-width: 180px">
          <div class="">
            <div class="mon-texte fw-bold">{{ portfolio.user.user.firstname }}</div>
            <div class="mon-texte fw-bold">{{ portfolio.user.user.lastname }}</div>
          </div>
          <div class="">
            <div style="font-style: italic" class="text-muted mon-texte">
              {{ portfolio.metier.name }}
            </div>
          </div>
          <v-hover v-slot="{ hover }">
            <v-img :src="portfolio.poster" class="mt-2">
              <v-expand-transition>
                <div
                  v-if="hover"
                  class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal text-h2 white--text bg-white"
                  style="width: 100%; max-height: 100%"
                >
                  <div class="white d-flex flex-row flex-wrap">
                    <v-btn
                      v-for="(social, i) in socials"
                      :key="i"
                      :color="social.color"
                      class="white--text"
                      fab
                      icon
                    >
                      <v-icon :size="30">{{ social.icon }}</v-icon>
                    </v-btn>
                  </div>
                </div>
              </v-expand-transition>
            </v-img>
          </v-hover>
          <b-button type="is-bleue" class="mt-1 mb-1"
            ><a :href="portfolio.url" style="width: 100%; color: white" target="_blank"
              >PORTFOLIO</a
            ></b-button
          >
        </div>
      </div>
    </div>
    <!-- <div class="d-flex flex-column justify-content-center align-items-between">
      <div class="d-flex flex-row align-items-center">
        <div class="d-flex bd-highlight">
          <div class="align-self-start">
            <vs-avatar size="large" v-if="user.avatar != null" :src="user.avatar.url" />
            <vs-avatar size="large" v-else></vs-avatar>
          </div>
          <div class="flex-grow-1 w-100">
            <div class="">
              <b-field type="is-medium">
                <template #label>
                  {{ user.user.firstname + " " + user.user.lastname }}
                </template>
              </b-field>
            </div>
            <div class="">
              <b-field type="is-medium">
                <template #label>
                  {{ user.portfolio.metier }}
                </template>
              </b-field>
            </div>
          </div>
        </div>
      </div>
    </div>-->
  </v-app>
</template>
<script>
export default {
  data() {
    return {
      loading: true,
      portfolio: {},
      icons: [
        "mdi-facebook",
        // 'mdi-twitter',
        "mdi-linkedin",
        "mdi-instagram",
        "mdi-whatsapp",
      ],
      socials: [
        {
          icon: "mdi-facebook",
          color: "indigo",
        },
        {
          icon: "mdi-linkedin",
          color: "cyan darken-1",
        },
        {
          icon: "mdi-instagram",
          color: "red lighten-3",
        },
        {
          icon: "mdi-whatsapp",
          color: "green",
        },
      ],
    };
  },
  props: ["user"],
  methods: {
    async getPortfoliobyId() {
      this.loading = true;
      //if (this.offreId != null)
      await axios
        .get("/api/v1/portfolio/user/" + this.user.id)
        .then(async (response) => {
          this.portfolio = response.data.data[0];
          console.log("mon portfolio");
          console.log(response);
          //await this.getPostulantsbyOffre();
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
      //this.loading = false;
    },
  },
  async mounted() {
    await this.getPortfoliobyId();
  },
};
</script>
<style scoped></style>
