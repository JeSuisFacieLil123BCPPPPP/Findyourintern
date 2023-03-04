<template>
  <div>
    <vs-chip
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
    </vs-chip>
  </div>
</template>
<script>
export default {
  props: {
    competences: {
      type: Array,
      required: true,
      default: [],
    },
    closable: {
      type: Boolean,
      required: false,
      default: true,
    },
  },
  data() {
    return {};
  },
  methods: {
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
