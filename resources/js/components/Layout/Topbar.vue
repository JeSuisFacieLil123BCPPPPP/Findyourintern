<template>
  <!--<b-navbar
    style="height: 82px; z-index: 500"
    :fixed-top="true"
    :spaced="true"
    :shadow="true"
    class="w-100"
    :style="{
      // top: 0,
      right: 0,
      padding: 0,
    }"
    id="topnavbar"
  >
    <template #brand>
      <router-link :to="{ path: '/' }">
        <img
          src="../../assets/logo_fyi_1.png"
          alt=""
          height="50"
          width="200"
          style="margin-left: 20px"
        />
      </router-link>
    </template>
    <template #start>
      <b-navbar-item
        style="color: black"
        key="1"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 1 ? true : false,
        }"
        class="text-black"
      >
        <router-link :to="{ name: 'accueil' }">
          <span style="color: white">Accueil</span></router-link
        ></b-navbar-item
      >
      <b-navbar-dropdown
        v-if="user.user_type == 'student'"
        label="Mes Réalisations"
        style="color: black"
        key="2"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 2 ? true : false,
        }"
        class="text-black"
      >
        <b-navbar-item>
          <router-link :to="{ path: '/create/realisations' }">
            <span style="color: black">Soumettre une réalisation</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item>
          <router-link :to="{ name: 'portfolio' }">
            <span style="color: black">Soumettre mon portfolio</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item>
          <router-link :to="{ path: '/list/realisations' }">
            <span style="color: black">Mes projets</span></router-link
          >
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-dropdown
        v-if="user.user_type == 'company'"
        label="Offre"
        style="color: black"
        key="2"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 3 ? true : false,
        }"
        class="text-black"
      >
        <b-navbar-item>
          <router-link :to="{ name: 'offres_postulants' }">
            <span style="color: black">Mes offres</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item>
          <router-link :to="{ path: '/p/posting/', query: { step: 'getting-started' } }">
            <span style="color: black">Publier une offre</span></router-link
          >
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-dropdown
        v-if="user.user_type == 'student' || user.user_type == 'company'"
        label="Entreprises"
        style="color: black"
        key="2"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 4 ? true : false,
        }"
        class="text-black"
      >
        <b-navbar-item>
          <router-link :to="{ path: '/offres/all' }">
            <span style="color: black">Offres d'emploi/stage</span></router-link
          >
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-item
        v-if="user.user_type == 'student'"
        style="color: black"
        key="5"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 5 ? true : false,
        }"
        class="text-black"
      >
        <router-link :to="{ name: 'mesdossiers' }">
          <span style="color: white">Mes dossiers</span></router-link
        ></b-navbar-item
      >
      <b-navbar-item
        v-if="user.user_type == '' || user.user_type == 'company'"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 2 ? true : false,
        }"
      >
        <router-link :to="{ name: 'realisationprinc' }">
          <span style="color: white">Réalisations</span></router-link
        >
      </b-navbar-item>
      <b-navbar-item
        v-if="user.user_type == 'student'"
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 6 ? true : false,
        }"
      >
        <router-link :to="{ name: 'realisationprinc' }">
          <span style="color: white">Réalisations</span></router-link
        >
      </b-navbar-item>
      <b-navbar-item
        v-if="
          user.user_type == '' ||
          user.user_type == 'company' ||
          user.user_type == 'student'
        "
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 7 ? true : false,
        }"
      >
        <router-link :to="{ name: 'portfolioPrinc' }">
          <span style="color: white">Porfolios des étudiants</span></router-link
        >
      </b-navbar-item>
    </template>
    <template #end>
      <slot></slot>

      <b-dropdown aria-role="list" v-if="user.user_type != ''" position="is-bottom-left">
        <template #trigger="{ active }">
          <a-tooltip placement="topLeft">
            <template slot="title">
              <vs-list-item :title="user.pseudo" :subtitle="user.email"> </vs-list-item>
            </template>
            <vs-avatar
              size="large"
              v-if="user.avatar != null"
              :src="user.avatar.variants['small'].secure_url"
            />
            <vs-avatar v-else icon="person" size="large" />
          </a-tooltip>
        </template>
        <b-dropdown-item aria-role="listitem">
          <vs-list-item :title="user.pseudo" :subtitle="user.email">
            <template slot="avatar">
              <vs-avatar
                size="large"
                v-if="user.avatar != null"
                :src="user.avatar.variants['small'].secure_url"
              />
              <vs-avatar v-else icon="person" size="large" />
            </template>
          </vs-list-item>
        </b-dropdown-item>
        <b-dropdown-item
          aria-role="listitem"
          class="d-flex flex-row justify-content-center align-items-center"
        >
          <div class="buttons button is-bleue" @click="logout">
            <b-icon icon="logout"></b-icon> <strong>Se déconnecter</strong>
          </div>
        </b-dropdown-item>
      </b-dropdown>
      <b-navbar-item tag="div" v-else>
        <div class="buttons">
          <router-link :to="{ path: '/login' }" class="button vert-b"
            ><strong class="" style="color: white">Se connecter</strong></router-link
          >
          <router-link :to="{ path: '/register' }" class="button vert-b"
            ><strong class="" style="color: white">S'inscrire</strong></router-link
          >
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>-->
  <b-navbar :fixed-top="true" :shadow="true">
    <template #brand>
      <b-navbar-item tag="router-link" :to="{ path: '/' }">
        <img src="../../assets/logo_fyi_1.png" alt="" />
      </b-navbar-item>
    </template>
    <template #start>
      <b-navbar-item
        key="1"
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 1 ? true : false,
        }"
        style=""
      >
        <router-link :to="{ name: 'accueil' }">
          <span class="text-black">Accueil</span></router-link
        >
      </b-navbar-item>
      <b-navbar-dropdown
        v-if="user.user_type == 'student'"
        key="2"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 2 ? true : false,
        }"
      >
        <template #label>
          <span class="text-black">Mes Réalisations</span>
        </template>
        <b-navbar-item class="text-black">
          <router-link :to="{ path: '/create/realisations' }">
            <span class="text-black">Soumettre une réalisation</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item class="text-black">
          <router-link :to="{ path: '/create/porfolio' }">
            <span class="text-black">Soumettre mon portfolio</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item>
          <router-link :to="{ path: '/list/realisations' }">
            <span class="text-black">Mes projets</span></router-link
          >
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-dropdown
        v-if="user.user_type == 'company' || user.user_type == 'normal'"
        key="3"
        class="text-black"
        style="color: black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 3 ? true : false,
        }"
      >
        <template #label>
          <span class="text-black">Offres</span>
        </template>
        <b-navbar-item>
          <router-link :to="{ name: 'offres_postulants' }">
            <span class="text-black">Mes offres</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item>
          <!-- <router-link
            :to="{
              path: '/p/posting/',
              query: { step: 'getting-started', index: shortid.generate() },
            }"
          >
            <span class="text-black">Publier une offre</span></router-link
          >-->
          <router-link
            :to="{
              path: '/choice/posting',
            }"
            replace
          >
            <span class="text-black">Créer une offre</span></router-link
          >
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-dropdown
        key="4"
        v-if="
          user.user_type == 'student' ||
          user.user_type == 'company' ||
          user.user_type == 'normal'
        "
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 4 ? true : false,
        }"
      >
        <template #label>
          <span class="text-black">Entreprises</span>
        </template>
        <b-navbar-item>
          <router-link :to="{ path: '/offres/all' }">
            <span class="text-black">Offres d'emploi/stage</span></router-link
          >
        </b-navbar-item>
        <b-navbar-item>
          <router-link :to="{ path: '/companies/all/' }">
            <span class="text-black">Les entreprises</span></router-link
          >
        </b-navbar-item>
      </b-navbar-dropdown>
      <b-navbar-item
        v-if="user.user_type == 'student'"
        key="5"
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 5 ? true : false,
        }"
      >
        <router-link :to="{ path: '/mesdossiers' }">
          <span class="text-black">Mes dossiers</span></router-link
        ></b-navbar-item
      >
      <b-navbar-item
        key="6"
        v-if="
          user.user_type == 'normal' ||
          user.user_type == '' ||
          user.user_type == 'company'
        "
        :class="{
          ' text-muted rounded menu-ele2 ': cle == 6 ? true : false,
        }"
        class="text-black"
      >
        <router-link :to="{ name: 'realisationprinc' }">
          <span class="text-black">Réalisations</span></router-link
        >
      </b-navbar-item>
      <b-navbar-item
        key="7"
        v-if="user.user_type == 'student' || user.user_type == 'normal'"
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 7 ? true : false,
        }"
      >
        <router-link :to="{ name: 'realisationprinc' }">
          <span class="text-black">Réalisations</span></router-link
        >
      </b-navbar-item>
      <b-navbar-item
        key="8"
        v-if="
          // user.user_type == 'normal' ||
          user.user_type == 'company' || user.user_type == 'student'
        "
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 8 ? true : false,
        }"
      >
        <router-link :to="{ name: 'portfolioPrinc' }">
          <span class="text-black">Porfolios des étudiants</span></router-link
        >
      </b-navbar-item>
      <b-navbar-item
        key="9"
        v-if="
          // user.user_type == 'normal' ||
          user.user_type == 'company' || user.user_type == 'student'
        "
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 8 ? true : false,
        }"
      >
        <router-link :to="{ name: 'rechercheProfilesStudents' }">
          <span class="text-black">Profils étudiants</span></router-link
        >
      </b-navbar-item>
      <!--<b-navbar-item
        key="9"
        class="text-black"
        :class="{
          'text-muted rounded menu-ele2 ': cle == 8 ? true : false,
        }"
      >
        <router-link :to="{ name: 'portfolioPrinc' }">
          <span class="text-black">Porfolios des étudiants</span></router-link
        >
      </b-navbar-item>-->
    </template>
    <template #end>
      <!--<slot></slot>-->
      <b-dropdown
        v-if="user.user_type != ''"
        position="is-bottom-left"
        :scrollable="isScrollable"
        :max-height="maxHeight"
        v-model="currentMenu"
        aria-role="list"
        class="me-3"
      >
        <template #trigger>
          <b-button
            :label="user.email"
            type="is-bleue"
            :icon-left="'account'"
            icon-right="menu-down"
          />
        </template>
        <v-card class="mx-auto h-100" :width="300" elevation="0" :flat="true">
          <v-list-item-group color="#24855a" @click="studentProfile">
            <v-list-item @click="studentProfile">
              <v-list-item-icon>
                <v-icon v-text="'mdi-account'"></v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title v-text="'Mon profile'"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item @click="logout">
              <v-list-item-icon>
                <v-icon v-text="'mdi-logout'"></v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title v-text="'Se déconnecter'"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-card>
        <!-- <b-dropdown-item
          aria-role="listitem"
          style="width: 300px"
          @click="studentProfile"
        >
          <div class="media">
            <b-icon icon="account" class="media-left" type="is-bleue"></b-icon>
            <div class="media-content">
              <h3>Mon profile</h3>
            </div>
          </div>
        </b-dropdown-item>
        <b-dropdown-item aria-role="listitem" style="width: 300px" @click="logout">
          <div class="media">
            <b-icon icon="logout" class="media-left" type="is-bleue"></b-icon>
            <div class="media-content">
              <h3>Se déconnecter</h3>
            </div>
          </div>
        </b-dropdown-item>-->
        <!-- <b-dropdown-item
          v-for="(menu, index) in menus"
          :key="index"
          :value="menu"
          aria-role="listitem"
          style="width: 300px"
        >
          <div class="media">
            <b-icon class="media-left" :icon="menu.icon"></b-icon>
            <div class="media-content">
              <h3>{{ menu.text }}</h3>
            </div>
          </div>
        </b-dropdown-item>-->
      </b-dropdown>
      <!--<b-dropdown aria-role="list" v-if="user.user_type != ''" position="is-bottom-left">
        <template #trigger="{ active }">
          <a-tooltip placement="topLeft">
            <template slot="title">
              <vs-list-item :title="user.pseudo" :subtitle="user.email"> </vs-list-item>
            </template>
            <vs-avatar
              size="large"
              v-if="user.avatar != null"
              :src="user.avatar.variants['small'].secure_url"
            />
            <vs-avatar v-else icon="person" size="large" />
          </a-tooltip>
        </template>
        <b-dropdown-item aria-role="listitem">
          <vs-list-item :title="user.pseudo" :subtitle="user.email">
            <template slot="avatar">
              <vs-avatar
                size="large"
                v-if="user.avatar != null"
                :src="user.avatar.variants['small'].secure_url"
              />
              <vs-avatar v-else icon="person" size="large" />
            </template>
          </vs-list-item>
        </b-dropdown-item>
        <b-dropdown-item
          aria-role="listitem"
          class="d-flex flex-row justify-content-center align-items-center"
        >
          <div class="buttons button is-bleue" @click="logout">
            <b-icon icon="logout"></b-icon> <strong>Se déconnecter</strong>
          </div>
        </b-dropdown-item>
      </b-dropdown>-->
      <b-navbar-item tag="div" v-else>
        <div class="buttons">
          <router-link :to="{ path: '/login' }" class="button vert-b"
            ><strong class="" style="color: white">Se connecter</strong></router-link
          >
          <router-link :to="{ path: '/register' }" class="button vert-b"
            ><strong class="" style="color: white">S'inscrire</strong></router-link
          >
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
</template>

<script>
import { mapActions } from "vuex";
import shortid from "shortid";
export default {
  name: "topbar",
  // props: ["sidebarlg", "collapsed", "user", "cle"],
  props: {
    user: {
      type: Number,
      required: false,
      default: { user_type: "" },
    },
    cle: {
      type: Boolean,
      required: true,
      // default: 0,
    },
  },
  data() {
    return {
      //collapsed: false,

      isScrollable: false,
      maxHeight: 200,
      menus: [
        { icon: "account-group", text: "People" },
        { icon: "shopping-search", text: "Orders" },
        { icon: "settings", text: "Configuration" },
      ],

      items: [
        {
          icon: "mdi-wifi",
          text: "Wifi",
        },
        {
          icon: "mdi-bluetooth",
          text: "Bluetooth",
        },
        {
          icon: "mdi-chart-donut",
          text: "Data Usage",
        },
      ],
      model: 1,
      shortid,
    };
  },
  //inject: ["message"],
  inject: {
    message: {
      from: "message", // this is optional if using the same key for injection
      default: "default value",
    },
  },
  computed: {
    navbarWidth() {
      return "calc(100% - " + this.sidebarlg + " - 2px)";
    },
  },
  methods: {
    changeSidebar() {
      //this.collapsed = !this.collapsed;
      console.log("changer oooh");
      this.$emit("change-sidebar");
    },
    studentProfile() {
      this.$router.push({
        name: "studentProfile",
        params: {
          userId: this.user.id,
        },
      });
    },
    ...mapActions({
      logout: "auth/logout", // map `this.add()` to `this.$store.dispatch('increment')`
    }),
  },
};
</script>
<style lang="scss" scoped>
//@import "~bulma/sass/utilities/_all";

//$navbar-dropdown-color: black !important;
//$navbar-dropdown-active-arrow: blue !important;
$topbarcolor: rgba(240, 240, 240, 0.7);
$sidebarbgcolor: rgba(10, 10, 200, 0.7);
.text-black {
  color: #0f151a !important;
}
.menu-ele2 {
  // background: red !important;
  // color: white !important;
  //color: #0f151a !important;
  border-bottom-width: 4px;
  border-bottom-style: solid;
  border-bottom-color: #24855a;
  //border-radius: 10px;
}
.trigger {
  font-size: 18px;
  line-height: 64px;
  padding: 0 24px;
  cursor: pointer;
  transition: color 0.3s;
}
.trigger:hover {
  color: #1890ff;
}
</style>
