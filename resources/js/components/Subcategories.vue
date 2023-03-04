<template>
  <div class="">
    <h1>Les categories</h1>
    <component :is="component" @change-component="changeComponent"></component>
  </div>
</template>
<script>
import FormSubcategory from "./Subcategories/FormSubcategory.vue";
import ListSubcategories from "./Subcategories/ListSubcategories.vue";
import SubcategoryBox from "./Subcategories/SubcategoryBox.vue";
export default {
  name: "Subcategories",
  data() {
    return {
      componentIs: "list",
      subcategoryId: 0,
      formType: "",
      //msg:'nathe',
    };
  },
  mounted() {},
  provide() {
    const base = {};
    Object.defineProperty(base, "subcategoryId", {
      enumerable: true,
      get: () => Number(this.subcategoryId),
    });
    Object.defineProperty(base, "formType", {
      enumerable: true,
      get: () => this.formType,
    });
    return base;
  },

  computed: {
    //  ...mapGetters([]),

    component() {
      switch (this.componentIs) {
        case "list":
          return ListSubcategories;
          break;
        case "form":
          return FormSubcategory;
          break;
        case "subcategorybox":
          return SubcategoryBox;
          break;
        default:
          return ListSubcategories;
          break;
      }
    },
  },

  methods: {
    changeComponent(payload) {
      this.componentIs = payload.component;
      this.subcategoryId = payload.componentId;
      this.formType = payload.formType;
    },
  },
};
</script>
