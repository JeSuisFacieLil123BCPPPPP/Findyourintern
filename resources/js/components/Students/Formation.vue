<template>
  <div class="m-2">
    <div class="d-flex flex-row justify-content-between align-items-center">
      <div class="flex-grow-1">
        <div>
          <span style="color: #0f151a; font-weight: bold; font-size: 16px" class="label">
            {{ formation.diplome }}
          </span>
        </div>
        <div v-if="formation.type == 'universitaire'">
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{ formation.institution }}
          </span>
        </div>
        <div v-if="formation.type == 'specifique'">
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{ formation.theme }}
          </span>
        </div>
        <div>
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{
              moment(formation.date_deb).format("ll") +
              " au " +
              moment(formation.date_fin).format("ll")
            }}
          </span>
        </div>
      </div>
      <div class="">
        <v-btn
          @click="showModal('formations')"
          color="#24855a"
          elevation="1"
          outlined
          class="mx-2"
          fab
          dark
          small
        >
          <v-icon dark> mdi-pencil </v-icon>
        </v-btn>
        <v-btn
          @click="confirmDelete"
          color="red"
          elevation="1"
          outlined
          class="mx-2"
          fab
          dark
          small
        >
          <v-icon dark> mdi-delete</v-icon>
        </v-btn>
        <!--<v-btn @click="showModal('formations')" color="#24855a" elevation="0" outlined>
            <span class="" style="color: #24855a">Modifier</span>
            <v-icon right light color="#24855a"> mdi-pencil </v-icon>
          </v-btn>-->

        <dialog-modifier
          @handle-cancel="handleCancel"
          @update-formation="updateformation"
          section="formations"
          action="update"
          :initVisible="initVisible"
          :obj="{ formation: formation }"
        >
        </dialog-modifier>
      </div>
    </div>
    <a-divider></a-divider>
  </div>
</template>
<script>
import moment from "moment";
import dialogModifier from "./DialogModifier.vue";
export default {
  components: { dialogModifier },
  props: ["formation"],
  data() {
    return {
      moment,
      initVisible: false,
    };
  },
  methods: {
    showModal(key) {
      this.initVisible = !this.initVisible;
    },
    updateformation(formation) {
      this.$emit("update-formation", formation);
    },
    async deleteformation() {
      await axios
        .delete("/api/v1/formations/" + this.formation.id)
        .then((response) => {
          console.log("res");
          console.log(response);
          this.$vs.notify({
            time: 6000,
            color: "success",
            title: "SUCCES DE L'OPERATION",
            text: "Expérience supprimée avec succès",
          });
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    confirmDelete() {
      this.$buefy.dialog.confirm({
        title: "Suppression d'une réalisation",
        message: "Est-tu sûr de vouloir supprimer cette formation",
        type: "is-danger",
        hasIcon: true,
        icon: "times-circle",
        iconPack: "fa",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: async () => {
          this.deleteformation();
          this.$emit("delete-formation", this.formation);
        },
      });
    },
    handleCancel(e) {
      console.log("Clicked cancel button");
      this.initVisible = false;
      //this.userInfos = null;
      this.$emit("handle-cancel", this.section);
    },
  },
};
</script>
<style scoped></style>
