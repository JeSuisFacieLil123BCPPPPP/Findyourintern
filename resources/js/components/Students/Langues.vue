<template>
  <div class="d-flex flex-row flex-wrap">
    <div v-for="(item, i) in langues" :key="i">
      <v-list-item-content>
        <v-list-item-title>
          <span
            style="font-size: 15px; line-height: 20px; color: #191f25; font-weight: 600"
          >
            {{ item.name_langue }}</span
          ></v-list-item-title
        >
        <span
          style="font-size: 14px; line-height: 20px; color: #191f25; font-weight: 500"
        >
          {{ "(" + getNiveau(item.niveau) + ")" }}</span
        >
      </v-list-item-content>
    </div>
    <!-- <div
      style=""
      :key="comp.id"
      @click="deleteCompetence(comp)"
      v-for="comp in competences"
      :closable="closable"
      close-icon="delete"
      color="#effbf5"
    >
      <span style="font-size: 15px; line-height: 40px; color: #191f25; font-weight: 600">
        {{ comp.description }}</span
      >
    </div>-->
  </div>
</template>
<script>
export default {
  props: {
    langues: {
      type: Array,
      required: true,
      default: [],
    },
  },
  data() {
    return {};
  },
  methods: {
    getNiveau(niveau) {
      if (niveau == 1) {
        return "Faible";
      } else if (niveau == 2) {
        return "Moyen";
      } else if (niveau == 3) {
        return "Excellent";
      }
    },
    async deleteCompetence(comp) {
      await axios
        .delete("/api/v1/competences/" + comp.id)
        .then((response) => {
          console.log("res");
          console.log(response);
          this.$emit("delete-competence", comp);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
  },
};
</script>
