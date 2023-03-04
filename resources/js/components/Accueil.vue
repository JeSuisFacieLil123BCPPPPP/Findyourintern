<template>
  <div>
    <!-- <v-app style="height: 500px">
     <v-row>
        <v-col cols="12">
          <v-carousel cycle hide-delimiter-background :interval="3000">
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
              reverse-transition="fade-transition"
              transition="fade-transition"
              class="position-relative"
            >
              <v-row>
                <v-col offset="1"> </v-col>
                <v-col cols="10">
                  <div
                    class="position-absolute translate-middle start-50 top-50 text-center w-100 d-flex justify-content-center align-items-center"
                    style="
                      height: 200px;
                      background: black;
                      color: white;
                      background-color: rgba(0, 0, 0, 0.5);
                    "
                  >
                    <p
                      class="font-weight-black text-h4 text-center"
                      style="color: white; opacity: 1"
                    >
                      Lorem Ipsum is simply dummy text of the printing and typesetting
                      industry.
                    </p>
                  </div>
                </v-col>
                <v-col offset="1"> </v-col>
              </v-row>
            </v-carousel-item>
          </v-carousel>
        </v-col>
      </v-row>
    </v-app>-->
    <div v-if="user.user_type == ''">
      <div class="d-flex flex-row align-items-center" style="margin: 50px">
        <div style="" class="">
          <p class="font-weight-bold text-h4">
            Trouvons rapidement et facilement une offre pour vous
          </p>
          <p class="font-weight-bold text-h4">Recrutons ensemble votre talent idéal</p>
          <b-button type="is-bleue"
            ><router-link :to="{ path: '/register' }" class="" style="color: white"
              >Inscrivez-vous</router-link
            ></b-button
          >
        </div>
        <div>
          <icon-recr-1 :width="600" :height="600"></icon-recr-1>
        </div>
      </div>
      <div style="height: 100px"></div>

      <div class="d-flex flex-row align-items-center flex-wrap" style="margin: 50px">
        <a-card
          class="mx-auto my-card elevation_1"
          style="border-radius: 12px; max-width: 344px;height:250px"
        >
          <div>
            <div>1</div>
            <p class="text-h4 mon-texte font-weight-bold">Inscrivez-vous gratuitement</p>
            <div class="mon-texte">
              Vous aurez le choix entre trois types d'utilisateur : <og /> Etudiant <fg />
            </div>
          </div>
        </a-card>
        <a-card
          class="mx-auto my-card elevation_1"
          style="border-radius: 12px; max-width: 344px;height:250px"
        >
          <div>
            <div>2</div>
            <p class="text-h4 mon-texte font-weight-bold">Perfectionner votre profil</p>
            <div class="mon-texte">
              Tout ce qu'il vous faut pour créer un compte et publier votre offre
              d'emploi, c'est une adresse email.
            </div>
          </div>
        </a-card>
        <a-card
          class="mx-auto my-card elevation_1"
          style="border-radius: 12px; max-width: 344px;height:250px"
        >
          <div>
            <div>3</div>
            <p class="text-h4 mon-texte font-weight-bold">Publier vos offre</p>
            <div class="mon-texte">
              Tout ce qu'il vous faut pour créer un compte et publier votre offre
              d'emploi, c'est une adresse email.
            </div>
          </div>
        </a-card>
        <a-card
          class="mx-auto my-card elevation_1"
          style="border-radius: 12px; max-width: 344px;height:250px"
        >
          <div>
            <div>4</div>
            <p class="text-h4 mon-texte font-weight-bold">
              Recruter gratuitement 
            </p>
            <div class="mon-texte">
              Tout ce qu'il vous faut pour créer un compte et publier votre offre
              d'emploi, c'est une adresse email.
            </div>
          </div>
        </a-card>
      </div>
      <div style="height: 100px"></div>
      <a-card style="margin: 50px">
        <a-row>
          <a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 12 }"
            :xl="{ span: 12 }"
            :xs="{ span: 24 }"
          >
            <div class="d-flex bd-highlight" style="min-width: 340px">
              <div class="p-2 flex-shrink-1 bd-highlight">
                <div class="hire-features-card-header">
                  <img
                    alt="Increase visibility"
                    src="https://d34k7i5akwhqbd.cloudfront.net/allspark/static/images/visibility-aurora-01633a.svg"
                    role="presentation"
                  />
                </div>
              </div>
              <div class="p-2 w-100 bd-highlight d-flex-column">
                <p class="text-h4 font-weight-bold mon-texte">
                  Gagnez en visibilité en tant qu'étudiant
                </p>
                <p class="text-subtitle-1 font-weight-normal">
                  <span
                    ><span
                      class="label-text"
                      id="clickToSponsor"
                      href="#"
                      data-tn-element="sponsorYourJob"
                      data-shield="sponsor-your-job"
                      >Publiez votre CV,votre portfolio ou votre réalisation ou meme
                      personnaliser et rendez visible votre profil.
                    </span>
                  </span>
                  <span
                    >Nous disposons de beaucoup de services pour vous aider si vous etes
                    un étudiant</span
                  >
                </p>
              </div>
            </div>
          </a-col>
          <a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 12 }"
            :xl="{ span: 12 }"
            :xs="{ span: 24 }"
          >
            <div class="d-flex bd-highlight" style="min-width: 340px">
              <div class="p-2 flex-shrink-1 bd-highlight">
                <div class="hire-features-card-header">
                  <img
                    alt="Quality applicants"
                    src="https://d34k7i5akwhqbd.cloudfront.net/allspark/static/images/quality-aurora-6ce509.svg"
                    role="presentation"
                  />
                </div>
              </div>
              <div class="p-2 w-100 bd-highlight d-flex-column">
                <p class="text-h4 font-weight-bold mon-texte">
                  Trouvez des candidat·es de qualité en tant qu'entreprise
                </p>
                <p class="text-subtitle-1 font-weight-normal">
                  <span
                    ><span
                      id="clickToSponsor"
                      href="#"
                      class="label-text"
                      data-tn-element="sponsorYourJob"
                      data-shield="sponsor-your-job"
                      >Rechercher des profils de candidats ou publier une offre</span
                    >

                    FindYourIntern vous aide à trouver le talent idéal.Vous pouvez le
                    rechercher ou juste publier une offre
                  </span>
                </p>
              </div>
            </div>
          </a-col>
          </a-row>
          <a-row>
            <a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 12 }"
            :xl="{ span: 12 }"
            :xs="{ span: 24 }"
          >
            <div class="d-flex bd-highlight" style="min-width: 340px">
              <div class="p-2 flex-shrink-1 bd-highlight">
                <div class="hire-features-card-header">
                  <img
                  alt="Quality applicants"
                  src="https://d34k7i5akwhqbd.cloudfront.net/allspark/static/images/quality-aurora-6ce509.svg"
                  role="presentation"
                />
                </div>
              </div>
              <div class="p-2 w-100 bd-highlight d-flex-column">
                <p class="text-h4 font-weight-bold mon-texte">Echangez des messages</p>
                <p class="text-subtitle-1 font-weight-normal">
                  <span
                    >Les entreprises ont la possibilité d'engager la conversation avec un
                    profil d'étudiant qui l'intéresse si ce dernier avait activé sa
                    visibilité</span
                  >
                </p>
              </div>
            </div>
          </a-col>
          <a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 12 }"
            :xl="{ span: 12 }"
            :xs="{ span: 24 }"
          >
            <div class="d-flex bd-highlight" style="min-width: 340px">
              <div class="p-2 flex-shrink-1 bd-highlight">
                <div class="hire-features-card-header">
                  <img
                  alt="Assess candidates"
                  src="https://d34k7i5akwhqbd.cloudfront.net/allspark/static/images/find-aurora-785c22.svg"
                  role="presentation"
                />
                </div>
              </div>
              <div class="p-2 w-100 bd-highlight d-flex-column">
                <p class="text-h4 font-weight-bold mon-texte">
                  Trouvez des candidat·es de qualité en tant qu'entreprise
                </p>
                <p class="text-subtitle-1 font-weight-normal">
                  <span
                    ><span
                      id="clickToSponsor"
                      href="#"
                      class="label-text"
                      data-tn-element="sponsorYourJob"
                      data-shield="sponsor-your-job"
                      >Rechercher des profils de candidats ou publier une offre</span
                    >

                    FindYourIntern vous aide à trouver le talent idéal.Vous pouvez le
                    rechercher ou juste publier une offre
                  </span>
                </p>
              </div>
            </div>
          </a-col>
        </a-row>
          
          <!--<a-col
            :sm="{ span: 24 }"
            :md="{ span: 24 }"
            :lg="{ span: 12 }"
            :xl="{ span: 12 }"
            :xs="{ span: 24 }"
          >
            <div class="d-flex bd-highlight" style="min-width: 340px">
              <div class="p-2 flex-shrink-1 bd-highlight">
                <div class="hire-features-card-header">
                  <img
                    alt="Organize candidates"
                    src="https://d34k7i5akwhqbd.cloudfront.net/allspark/static/images/organize-aurora-dd7191.svg"
                    role="presentation"
                  />
                </div>
              </div>
              <div class="p-2 w-100 bd-highlight d-flex-column">
                <p class="text-h4 font-weight-bold mon-texte">
                  Organisez votre recrutement
                </p>
                <p class="text-subtitle-1 font-weight-normal">
                  <span
                    ><a
                      id="clickToSponsor"
                      href="#"
                      data-tn-element="sponsorYourJob"
                      data-shield="sponsor-your-job"
                      >Sponsorisez votre annonce</a
                    >
                    pour vous assurer qu'elle soit vue par les candidats les plus
                    adaptés.</span
                  >
                </p>
              </div>
            </div>
          </a-col>-->
        </a-row>
      </a-card>
      <div style="height: 100px"></div>
      <b-button type="is-bleue" style="margin-left: 100px"
        ><router-link :to="{ path: '/accueil' }" class="" style="color: white"
          >Accédez aux offres disponibles</router-link
        ></b-button
      >
      <div style="height: 100px"></div>
    </div>

    <div v-if="user.user_type == 'student' || user.user_type == 'normal'">
      <offres-c></offres-c>
    </div>
    <div v-if="user.user_type == 'company'">
      <div id="projets">
        <p
          class="font-weight-black text-h1 text-center vert"
          style="color: black; opacity: 1; margin: 20px 0px; box-sizing: content"
        >
          <b-field>
            <template #label>
              <span
                style="font-size: 40px; color: white"
                class="font-weight-black text-h4"
                >Les réalisations des étudiants</span
              >
            </template>
          </b-field>
        </p>
        <realisations-princ></realisations-princ>
      </div>

      <div
        id="portfolios"
        class="d-flex flex-column w-100"
        style="margin-bottom: 30px"
        v-if="$route.name == 'portfolioPrinc' || user.user_type == 'company'"
      >
        <p
          class="font-weight-black text-h1 text-center vert"
          style="color: black; opacity: 1; margin: 20px 0px; vertical-align: middle"
        >
          <b-field>
            <template #label>
              <span
                style="font-size: 40px; color: white"
                class="font-weight-black text-h4"
                >Portfolio de quelques étudiants</span
              >
            </template>
          </b-field>
        </p>
        <div>
          <div class="d-flex flex-row flex-wrap">
            <portfolio-c
              v-for="(item, index) in portfolios"
              :key="index"
              :portfolio="item"
            ></portfolio-c>
          </div>
          <div style="margin-top: 35px">
            <b-button
              v-if="portfolios.length < total"
              @click="getAllPortfoliosPaginateNext"
              rounded
              hovered
              type="is-bleue"
              class="translate-middle start-50 top-100"
            >
              <a-spin v-if="loading == true" />
              <span v-if="!loading">Voir plus</span>
            </b-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import test from "../components/test.vue";
import IconRecr1 from "./Icons/icon-recr-1.vue";
import RealisationsPrinc from "./Realisations/RealisationsPrinc.vue";
import iconRecr1 from "./Icons/icon-recr-1.vue";
import InfosBase1 from "./Icons/infos-base-1.vue";
const baseUrl =
  "https://raw.githubusercontent.com/vueComponent/ant-design-vue/master/components/vc-slick/assets/img/react-slick/";
export default {
  components: { test, RealisationsPrinc, iconRecr1, InfosBase1 },
  data() {
    return {
      loading: true,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      portfolios: [],
    };
  },

  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  async beforeMount() {
    await this.getAllRealisationsValide();
    await this.getAllPortfolios();
  },
  methods: {
    getImgUrl(i) {
      return `${baseUrl}abstract0${i + 1}.jpg`;
    },
    serchValueChnage(val) {
      //console.log("value");
      //console.log(val);
      this.search = val;
    },
    ...mapActions({
      logout: "auth/logout", // map `this.add()` to `this.$store.dispatch('increment')`
    }),
    realisView(realisationId) {
      this.$router.push({
        path: "contact",
        params: {
          realisationId: realisationId,
        },
      });
    },
    async getAllRealisationsValide() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/getAllRealisationsValide")
        .then((response) => {
          console.log(response);
          console.log(response.data.data);

          this.realisations = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    async getAllPortfolios() {
      this.loading = true;
      await axios
        .get(
          "/api/v1/portfolios/getAllPortfolios" /*,{
          params:{metier:this.portfolio.metier},
        }*/
        )
        .then((res) => {
          console.log("logine");
          console.log(res);
          this.portfolios = res.data.data;
          this.total = res.data.meta.total;
          this.lastPage = res.data.meta.last_page;
          this.nextPage = this.nextPage < this.lastPage ? 2 : this.lastPage;
          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
        });
    },
    getAllPortfoliosPaginateNext() {
      if (this.portfolios.length < this.total) {
        this.loading = true;
        axios
          .get("/api/v1/portfolios/getAllPortfolios", {
            params: { page: this.nextPage },
          })
          .then((res) => {
            this.portfolios = this.portfolios.concat(res.data.data);
            this.currentPage = res.data.meta.currentPage || this.currentPage;
            this.nextPage =
              this.nextPage < this.lastPage ? this.nextPage + 1 : this.lastPage;
            this.loading = false;
          });
      }
      // };
    },
    handleScroll(event) {
      console.log("scroller");
    },
  },
};
</script>
<style scoped lang="css">
.menu-ele2 {
  background: red !important;
  color: white !important;
  border-radius: 10px;
}
.vert {
  background: #24855a;
}
/*
.odx-m2 .bumblebee .hire-hero-card {
  border: 1px solid #e4e2e0;
  border-radius: 1rem;
  padding-bottom: 2rem;
}
.css-14wtlt6 {
  box-sizing: border-box;
  min-width: 0px;
  border: 1px solid rgb(228, 226, 224);
  border-radius: 1rem;
  padding: 2rem;
  margin: 1rem 1rem 1.5rem;
}
.hire-hero-card {
  position: relative;
  border: 2px solid #ececec;
  border-radius: 5px;
  padding: 2rem 1.5rem 2.5rem;
  margin-bottom: 1.5rem;
}
@media (min-width: 48em) {
  .hire-hero-card-wrapper > * {
    flex: 1 1 0%;
    margin: 1rem;
  }
  * {
    font-family: Noto Sans, Helvetica Neue, Helvetica, Arial, Liberation Sans, Roboto,
      Noto, sans-serif !important;
  }
}*/
</style>
