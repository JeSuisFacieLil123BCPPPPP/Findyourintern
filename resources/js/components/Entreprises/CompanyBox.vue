<template>
  <!--<router-link
    :to="{
      path: 'companies/details/',
      query: { company: this.company },
    }"
  >-->
  <div @click="detailsCompany">
    <a-card class="elevation-1" style="max-width: 380px" height="200">
      <div class="d-flex bd-highlight">
        <div class="flex-shrink-1 bd-highlight">
          <v-img
            v-if="company.logo == null"
            src="https://picsum.photos/600/400"
            class=""
            width="48"
            height="48"
            style="border-radius: 8px; margin-right: 10px"
          ></v-img>
          <v-img
            v-else
            :src="company.logo"
            class=""
            width="48"
            height="48"
            style="border-radius: 8px; margin-right: 10px"
          ></v-img>
        </div>
        <div class="p-2 w-100 bd-highlight">
          <div>
            <b-field class="">
              <template #label>
                <span style="font-size: 12px"> {{ company.company_name }}</span>
              </template>
            </b-field>
          </div>

          <div>
            <b-field class="">
              <template #label>
                <span style="font-size: 12px; font-weight: bold" class="m-1"></span>
              </template>
            </b-field>
          </div>
        </div>
      </div>
      <v-card-actions class="pa-4">
        Noter l'entreprise
        <v-spacer></v-spacer>
        <span class="grey--text text--lighten-2 text-caption mr-2"> ({{ rating }}) </span>
        <v-rating
          v-model="rating"
          background-color="white"
          color="yellow accent-4"
          dense
          half-increments
          hover
          size="18"
        ></v-rating>
      </v-card-actions>
    </a-card>
  </div>
  <!-- </router-link>-->
</template>
<script>
export default {
  props: ["company"],
  data() {
    return {
      rating: 4.3,
    };
  },
  methods: {
    detailsCompany() {
      //this.$router.replace({ path: "" });
      this.$router.push({
        path: "/companies/details/",
        query: { company: this.company },
      });
    },
  },
};
</script>
<style scoped></style>
