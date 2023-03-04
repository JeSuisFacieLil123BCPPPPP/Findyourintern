<template>
  <div class="">
    <div class="card m-3 w-60">
      <div class="card-header">
        <vs-button
          @click="changeComponent('list', 0)"
          color="danger"
          type="gradient"
          icon="delete"
          size="small"
          >Retour
        </vs-button>
      </div>
      <div class="col m-3">
        <div class="d-flex flex-row">
          <img
            src="../../assets/img1.jpg"
            alt=""
            width="100"
            height="100"
            class="align-self-start mx-3 rounded-circle"
          />
          <div>
            <p class="fw-bold">{{ category.name_cat }}</p>
            <p class="fw-bold text-muted">{{ category.description }}</p>
          </div>
        </div>
        <hr />
      </div>
    </div>
  </div>
</template>
<script>
import changeComponent from "../../mixin/changeComponent";
export default {
  name: "CategoryBox",

  data() {
    return {
      category: {},
    };
  },
  inject: ["categoryId"],
  async beforeMount() {
    await this.getCategorybyId();
  },
  mixins: [changeComponent],
  methods: {
    async getCategorybyId() {
      await axios
        .get("/api/v1/categories/" + this.categoryId)
        .then((response) => {
          this.category = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style></style>
