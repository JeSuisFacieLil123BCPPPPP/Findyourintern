<template>
  <div class="">
    <div class="card m-3 w-60">
      <div class="card-header">
        Subcatégories
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
            <p class="fw-bold">{{ subcategory.name_subcat }}</p>
            <p class="fw-bold text-muted">{{ subcategory.description }}</p>
          </div>
          <div>
            <p class="fw-bold">{{ subcategory.category.name_cat }}</p>
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
  name: "subcategoryBox",

  data() {
    return {
      subcategory: {},
    };
  },
  inject: ["subcategoryId"],
  async beforeMount() {
    await this.getSubcategorybyId();
  },
  mixins: [changeComponent],
  methods: {
    async getSubcategorybyId() {
      await axios
        .get("/api/v1/subcategories/" + this.subcategoryId)
        .then((response) => {
          this.subcategory = response.data.data;
          console.log("youmi   " + this.subcategory.category.name_cat);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style></style>
