<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">Reset Password</div>
          <div class="card-body">
            <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
              <span v-if="result != ''">{{ result }}</span>
              <div class="form-group">
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
              <button type="submit" class="btn btn-primary">
                Send Password Reset Link
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
  name: "ForgotPassword",
  data() {
    return {
      email: null,
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
    async requestResetPassword() {
      await axios
        .post("/api/forgot-password ", this.user)
        .then((result) => {
          //  this.response = result.data;
          this.result = result.data.message;
          console.log(result);
          console.log(result.data.message);
          //   console.log(result);
        })
        .catch(({ response: { data } }) => {
          console.log("non !");
          console.log(data);
        });
      /* axios.post("/auth/reset-password", email: this.email).then(result =>
                this.response = result.data;
                console.log(result.data);
            , error =>
                console.error(error);
            )*/
    },
  },
};
</script>
