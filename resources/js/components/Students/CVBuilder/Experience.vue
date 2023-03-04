<template>
  <div class="p-2">
    <div class="d-flex flex-row justify-content-between align-items-center">
      <div class="flex-grow-1 row">
        <div class="col-3 align-items-start">
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{ moment(experience.date_deb).format("MMMM YYYY") + "-" }}
          </span>
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{ moment(experience.date_fin).format("MMMM YYYY") }}
          </span>
        </div>
        <div class="col-9 row">
          <div
            class="h-100 col-1 d-none d-md-block"
            style="
              border-left-style: solid;
              border-left-width: 6px;
              border-left-color: #0f151a;
            "
          ></div>
          <div class="col-11">
            <div class="">
              <span
                style="color: #0f151a; font-weight: bold; font-size: 16px"
                class="label"
              >
                {{ experience.poste }}
              </span>
            </div>
            <div>
              <span
                style="color: #0f151a; font-weight: normal; font-size: 14px"
                class="label"
              >
                {{ experience.company_name }}
              </span>
            </div>
          </div>
        </div>
        <!--<div class="col-3">
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{
              moment(experience.date_deb).format("MMMM") +
              "-" +
              moment(experience.date_fin).format("YYYY")
            }}
          </span>
        </div>
        <a-divider type="vertical"></a-divider>
        <a-divider type="vertical"></a-divider>
        <div class="col-9">
          <span style="color: #0f151a; font-weight: bold; font-size: 16px" class="label">
            {{ experience.poste }}
          </span>
        </div>
        <div>
          <span
            style="color: #0f151a; font-weight: normal; font-size: 14px"
            class="label"
          >
            {{ experience.company_name }}
          </span>
        </div>-->
      </div>
      <div class="">
        <v-btn
          @click="showModal('experiences')"
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
          @click="confirmDelete(exp)"
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
        <!--<v-btn @click="showModal('experiences')" color="#24855a" elevation="0" outlined>
            <span class="" style="color: #24855a">Modifier</span>
            <v-icon right light color="#24855a"> mdi-pencil </v-icon>
          </v-btn>-->

        <!--<dialog-modifier
          @handle-cancel="handleCancel"
          @update-experience="updateExperience"
          section="experiences"
          action="update"
          :initVisible="initVisible"
          :obj="{ experience: experience }"
        >
        </dialog-modifier>-->
      </div>
    </div>
    <a-divider></a-divider>
  </div>
</template>
<script>
import moment from "moment";
export default {
  props: ["experience", "studentId", "index"],
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
    updateExperience(experience) {
      this.$emit("update-experience", experience);
    },
    async deleteExperience() {
      await axios
        .post("/api/v1/cvbuilder/deleteWorkExperience", {
          id: this.studentId,
          index: this.index,
        })
        .then((response) => {
          console.log("res");
          console.log(response);
          this.$vs.notify({
            time: 6000,
            color: "success",
            title: "SUCCES DE L'OPERATION",
            text: "Expérience supprimée avec succès",
          });
          this.$emit("delete-experience", response.data.experiences);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    confirmDelete() {
      this.$buefy.dialog.confirm({
        title: "Suppression d'une expérience",
        message: "Est-tu sûr de vouloir supprimer cette expérience?",
        type: "is-danger",
        hasIcon: true,
        icon: "times-circle",
        iconPack: "fa",
        ariaRole: "alertdialog",
        ariaModal: true,
        confirmText: "Oui",
        cancelText: "Non",
        onConfirm: async () => {
          this.deleteExperience();
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
