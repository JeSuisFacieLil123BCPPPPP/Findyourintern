<template>
  <div>
    <vs-card style="margin: 20px">
      <vs-row>
        <div class="d-flex flex-row">
          <h3>Les Categories</h3>
          <vs-button
            color="success"
            type="gradient"
            icon="add"
            size="small"
            @click="changeComponent('form', 0, 'create')"
          />
        </div>
      </vs-row>
      <vs-row>
        <vs-col vs-type="flex" vs-justify="left" vs-align="left" vs-w="12">
          <!-- <vs-table
            :data="categriesList"
            search
            :stripe="false"
            pagination
            :max-items="maxiteme"
            v-model="selected"
            miltiple
            class="w-100 position-relative"
            style="z-index: 0"
          >
            <template slot="thead" style="">
              <vs-th sort-key="id"> # </vs-th>
              <vs-th sort-key="id"> Id</vs-th>
              <vs-th sort-key="name_cat"> Nom de la catégorie</vs-th>
              <vs-th sort-key="description"> Description </vs-th>
              <vs-th sort-key="active"> Etat</vs-th>
              <vs-th> Actions </vs-th>
            </template>
            <template slot-scope="{ data }">
              <vs-tr
                :key="index"
                v-for="(tr, index) in data"
                :class="{ activeLoading: activeLoading } + 'loading-default'"
                class="vs-con-loading__container loading-example"
                id=""
              >
                <vs-td :data="data[index].id">
                  {{ data[index].id }}
                </vs-td>
                <vs-td :data="data[index].name_cat">
                  {{ data[index].name_cat }}
                </vs-td>
                <vs-td :data="data[index].description">
                  {{ data[index].description }}
                </vs-td>
                <vs-td :data="data[index].active">
                  <span v-if="data[index].active == true" class="bg-success">
                    {{ "Active" }}</span
                  >
                  <span v-else class="bg-danger"> {{ "Desactive" }}</span>
                </vs-td>
                <vs-td :data="data[index].id">
                  <vs-button
                    color="primary"
                    type="filled"
                    icon="remove_red_eye"
                    size="small"
                    @click="changeComponent('categorybox', data[index].id)"
                  />
                  <vs-button
                    color="success"
                    type="filled"
                    icon="edit"
                    size="small"
                    @click="changeComponent('form', data[index].id, 'edit')"
                  />
                  <vs-button color="success" type="fab" icon="delete" size="small">
                  </vs-button>
                </vs-td>
              </vs-tr>
            </template>
          </vs-table>-->
          <table class="table table-responsive overflow-auto">
            <thead>
              <th>Id</th>
              <th>Nom de la catégorie</th>
              <th>Description</th>
              <th>Etat</th>
              <th>Actions</th>
            </thead>
            <tbody>
              <tr
                v-for="(category, index) in categriesList"
                :key="index"
                scope="row"
                class="elevation_1"
              >
                <td>
                  {{ category.id }}
                </td>
                <td>
                  {{ category.name_cat }}
                </td>
                <td>
                  {{ category.description }}
                </td>
                <td>
                  <vs-button disabled type="border">
                    <span v-if="category.active == true"> {{ "Active" }}</span>
                    <span v-else> {{ "Desactive" }}</span>
                  </vs-button>
                </td>
                <td>
                  <vs-button
                    color="primary"
                    type="gradient"
                    icon="remove_red_eye"
                    size="small"
                    @click="changeComponent('categorybox', category.id)"
                  />
                  <vs-button
                    color="success"
                    type="gradient"
                    icon="edit"
                    size="small"
                    @click="changeComponent('form', category.id, 'edit')"
                  />
                  <vs-button
                    color="danger"
                    type="gradient"
                    icon="delete"
                    size="small"
                    @click="confirmDelete(category)"
                  />
                </td>
              </tr>
            </tbody>
          </table>
        </vs-col>
      </vs-row>
    </vs-card>
  </div>
</template>
<script>
import changeComponent from "../../mixin/changeComponent";

export default {
  name: "listCategories",
  data() {
    return {
      categriesList: [],
      activeConfirm: false,
      maxiteme: 5,
      selected: [],
      activeLoading: false,
    };
  },
  mixins: [changeComponent],
  async beforeMount() {
    await this.getAllCategories();
  },

  methods: {
    async getAllCategories() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/categories")
        .then((response) => {
          console.log(response.data.data);
          this.categriesList = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    confirmDelete(category) {
      this.$buefy.dialog.confirm({
        title: "Suppression d'une catégorie",
        message:
          "Est-tu sûr de vouloir supprimer la catégorie " + category.name_cat + " ?",
        confirmText: "Supprimer la catégorie",
        type: "is-danger",
        hasIcon: true,
        icon: "times-circle",
        iconPack: "fa",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: async () => {
          await this.deleteCategory(category);
          return this.$vs.notify({
            color: "success",
            title: "SUCCES DE L'OPERATION",
            text: "CATEGORIE SUPPRIMEE AVEC SUCCES!",
          });
        },
      });
    },
    async deleteCategory(category) {
      await axios
        .delete("/api/v1/categories/" + category.id)
        .then((response) => {
          console.log(response.data.message);
        })
        .catch(function (error) {
          console.log(error);
        });
      await this.getAllCategories();
    },
  },
};
</script>
<style lang="scss" scoped>
.elevation_1 {
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2), 0 1px 1px rgba(0, 0, 0, 0.14),
    0 2px 1px -1px rgba(0, 0, 0, 0.12);
  margin: 4px;
}
</style>
