<template>
  <v-container class="container h-100 elevation_5 container-m mt-3 mb-3">
    <a-row type="flex" align="start" justify="center" class="height-80">
      <a-col :sm="{ span: 0 }" :md="{ span: 12 }" cols="0" class="d-none d-md-block">
        <div
          class="h-100 w-100 bttn-float bttn-success d-flex justify-content-center align-items-center"
        >
          <inscrire-employeur-1
            style="width: 250px; height: 250px"
          ></inscrire-employeur-1>
        </div>
      </a-col>
      <a-col :sm="{ span: 24 }" :md="{ span: 12 }">
        <div>
          <a-card>
            <a-row>
              <a-col>
                <h1 class="login-title my-2">Se connecter</h1>
              </a-col>
              <a-col>
                <span
                  >Bienvenue toi ! Connecte-toi à ton compte avant de continuer</span
                ></a-col
              >
              <a-col>
                <b-message type="is-danger" has-icon v-if="error" size="is-small">
                  <span style="font-size: 12px"
                    >Vous n'avez pas pu vous connecter. Vérifiez votre adresse mail et
                    votre mot de passe.</span
                  >
                </b-message>
              </a-col>
              <a-col>
                <b-field label="Email" :type="typeEmail">
                  <template #message>
                    <span
                      style="
                        display: block;
                        height: 12px;
                        color: #f14668;
                        font-size: 0.75rem;
                      "
                      >{{ messageEmail }}</span
                    >
                  </template>
                  <b-input
                    :value="auth.email"
                    @input="valideEmail"
                    type="email"
                    size="is-medium"
                    icon-pack="mdi"
                    icon="email"
                  >
                  </b-input>
                </b-field>
              </a-col>
              <a-col>
                <b-field label="Mot de passe" :type="typePassword">
                  <template #message>
                    <span
                      style="
                        display: block;
                        height: 12px;
                        color: #f14668;
                        font-size: 0.75rem;
                      "
                      >{{ messagePassword }}</span
                    >
                  </template>
                  <b-input
                    :value="auth.password"
                    @input="validePassword"
                    icon-pack="mdi"
                    icon="lock"
                    size="is-medium"
                    :password-reveal="true"
                  >
                  </b-input>
                </b-field>
              </a-col>
              <a-col>
                <a-row justify="flex-between" type="flex" align="middle">
                  <a-col :span="12">
                    <b-checkbox :value="true" type="is-bleue" class="m-2">
                      Rester connecter
                    </b-checkbox>
                  </a-col>
                  <a-col :span="12">
                    <a href="" style="color: green" class="m-2"> Mot de passe oublié ?</a>
                  </a-col>
                </a-row>
              </a-col>
              <a-col>
                <b-button
                  class="w-100 fw-bold is-bleue m-2"
                  :disabled="processing"
                  @click="login"
                  >Se connecter</b-button
                >
              </a-col>
              <a-col class="my-2">
                Nouveau ?
                <a href="/register" class="" style="color: green">Inscrivez-vous !</a>
              </a-col>
            </a-row>
          </a-card>
        </div>
      </a-col>
    </a-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import inscrireEmployeur1 from "./Icons/inscrire-employeur-1.vue";
//import
export default {
  components: { inscrireEmployeur1 },
  name: "login",
  data() {
    return {
      auth: {},
      processing: false,
      view: true,
      type: "text",
      typeEmail: "",
      messageEmail: "",
      typePassword: "",
      messagePassword: "",
      error: false,
    };
  },
  methods: {
    valideEmail(value = "") {
      this.auth.email = value;
      console.log(value);
      if (this.auth.email.length == 0) {
        this.typeEmail = "is-danger";
        this.messageEmail = "Veuillez renseigner votre adresse email";
      } else if (/.+@.+\..+/.test(this.auth.email) == false) {
        this.typeEmail = "is-danger";
        this.messageEmail = "L'email entré n'est pas valide";
      } else if (/.+@.+\..+/.test(this.auth.email) == true) {
        this.typeEmail = "";
        this.messageEmail = "";
      }
    },
    validePassword(value = "") {
      console.log(value);
      this.auth.password = value;
      if (this.auth.password.length == 0) {
        this.typePassword = "is-danger";
        this.messagePassword = "Veuillez renseigner votre mot de passe";
      } else {
        /* else if (this.auth.password.length < 8) {
        this.typePassword = "is-warning";
        this.messagePassword = "Au moins 8 caractère";
      } else /*if (this.auth.password != null)*/
        this.typePassword = "";
        this.messagePassword = "";
      }
    },
    viewIconClick() {
      this.view = !this.view;
      if (this.view == true) {
        this.type = "text";
      } else {
        this.type = "password";
      }
    },
    /* ...mapActions({
            signIn:'auth/login'
        }),*/
    ...mapActions({
      signIn: "auth/login",
    }),
    async login() {
      if (
        this.auth.email != null &&
        this.auth.email.length != 0 &&
        this.messageEmail == "" &&
        this.auth.password != null &&
        this.messagePassword == "" &&
        this.auth.password.length != 0
      ) {
        this.processing = true;
        await axios.get("/sanctum/csrf-cookie");
        await axios
          .post("/api/login", this.auth)
          .then(({ data }) => {
            this.signIn();
            this.error = false;
          })
          .catch(({ response: { data } }) => {
            this.error = true;
            // alert(data.message + " ah bon !");
          })
          .finally(() => {
            this.processing = false;
          });
      } else {
        this.valideEmail(this.auth.email);
        this.validePassword(this.auth.password);
      }
    },
  },
};
</script>
