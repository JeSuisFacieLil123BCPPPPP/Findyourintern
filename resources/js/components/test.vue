<template>
  <v-card>
    <a-button @click="test">Testons l'nvoi de mail</a-button>
  </v-card>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "realisationPrinc",
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    async test() {
      console.log(this.user);
      await axios
        .post("/api/v1/test/" + this.user.id)
        .then((response) => {
          console.log(response.data.message);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
      // .finally(() => ());
    },
  },
  /*async beforeMount() {
      await this.getAllRealisationsValide();
    },*/
};
</script>
<style scoped></style>
