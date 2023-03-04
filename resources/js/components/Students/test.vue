<template>
  <div>
    <a-divider class="label-text font-weight-bold text-lg-h6 text-h6"
      >Détails dme conçernant</a-divider
    >
    <b-field grouped>
      <b-field custom-class="is-medium" expanded>
        <template #label>
          <span style="color: red">* </span><span style="font-size: 16px">Prénoms</span>
        </template>
        <b-input
          :value="userInfos.user.firstname"
          @input="valide('firstname')"
          type="text"
          size="is-medium"
        >
        </b-input>
      </b-field>
      <b-field custom-class="is-medium" expanded>
        <template #label>
          <span style="color: red">*</span><span style="font-size: 16px">Nom</span>
        </template>
        <b-input
          :value="userInfos.user.lastname"
          @input="valide('lastname')"
          type="text"
          size="is-medium"
        >
        </b-input>
      </b-field>
    </b-field>
    <b-field grouped>
      <b-field>
        <template #label> Adresse email </template>
        <b-input
          :value="userInfos.user.email"
          @input="valide('email')"
          type="email"
          size="is-medium"
        >
        </b-input>
      </b-field>
    </b-field>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
  methods: {

    test(){
      let newInfosSupp = null;
      this.isLoading = true;
      await axios
        .post("/api/v1/infosSupp/updateOrCreate", {
          ...{ ...this.userInfos.infosSupp},
          ...{ student_id: this.user.user.id },
        })
        .then((response) => {
          console.log("response");
          console.log(response);
          this.isLoading = false;
          newInfosSupp = response.data.InfosSupp;
        })
        .catch((error) => {
          console.log("erroreeeeeeeeeee");
          console.log(error.message);
          this.isLoading = false;
        });
      return newInfosSupp;
    }
  },
};
</script>
