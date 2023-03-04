<template>
  <div class="">
    <h1>Les categories</h1>
    <component :is="component" @change-component="changeComponent"></component>
  </div>
</template>
<script>
import FormCategory from "./Categories/FormCategory.vue";
import ListCategories from "./Categories/ListCategories.vue";
import CategoryBox from "./Categories/CategoryBox.vue";
export default {
  name: "Categories",
  data() {
    return {
      componentIs: "list",
      categoryId: 0,
      formType: "",
      //msg:'nathe',
    };
  },
  mounted() {},
  provide() {
    const base = {};
    Object.defineProperty(base, "categoryId", {
      enumerable: true,
      get: () => Number(this.categoryId),
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
          return ListCategories;
          break;
        case "form":
          return FormCategory;
          break;
        case "categorybox":
          return CategoryBox;
          break;
        default:
          return ListCategories;
          break;
      }
    },
  },

  methods: {
    changeComponent(payload) {
      this.componentIs = payload.component;
      this.categoryId = payload.componentId;
      this.formType = payload.formType;
    },
  },
};
</script>
