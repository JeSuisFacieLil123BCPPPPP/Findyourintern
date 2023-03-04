<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">New Password</div>
          <div class="card-body">
            <!-- <ul v-if="errors">
                <li v-for="error in errors" v-bind:key="error"> msg </li>
              </ul> -->
            <form autocomplete="off" @submit.prevent="resetPassword" method="post">
              <div class="form-group">
                <span v-if="result != ''">{{ result }}</span>
                <label for="email">E-mail</label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="user@example.com"
                  v-model="email"
                  required
                />
              </div>
              <div class="form-group">
                <label for="email">Password</label>
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  placeholder=""
                  v-model="password"
                  required
                />
              </div>
              <div class="form-group">
                <label for="email">Confirm Password</label>
                <input
                  type="password"
                  id="password_confirmation"
                  class="form-control"
                  placeholder=""
                  v-model="password_confirmation"
                  required
                />
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      token: null,
      email: null,
      password: null,
      password_confirmation: null,
      has_error: false,
      result: "",
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    async resetPassword() {
      ///api/v1/auth/reset-password
      await axios
        .post("/api/reset-password", {
          token: this.$route.params.token,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          // user: this.user,
        })
        .then((result) => {
          this.result = result.data.message;
          console.log(result.data.message);
        })
        .catch(({ response: { data } }) => {
          console.log("non !");
          console.log(data);
        });
    },
  },
  /* await  axios.post("/auth/reset/password/",
                token: this.$route.params.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            )
            .then(result =>
                // console.log(result.data);
                this.$router.push(name: 'login')
            , error =>
                console.error(error);
            );*/
};
</script>
