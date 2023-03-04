<template>
  <div
    :style="{
      minHeight: '100vh',
    }"
  >
    <a-row type="flex" justify="center" align="middle">
      <a-col class="">
        <a-card
          style="width: 400px"
          :style="{
            top: '100px',
            // minHeight: '100vh',
          }"
        >
          <div class="d-flex flex-column justify-content-center align-items-center">
            <b-notification
              type="is-success is-light"
              has-icon
              aria-close-label="Close notification"
              :closable="false"
              icon-pack="mdi"
              icon="check-circle"
              icon-size="is-large"
            >
              <b-field>
                <template #label>
                  <span class="label-text">
                    Super ! Vous venez de postuler à une offre d'emploi avec succès</span
                  >
                </template>
              </b-field>
            </b-notification>
            <success-offre-1 width="100%" height="200px"> </success-offre-1>
            <b-button type="is-bleue" class="m-2 w-100" hovered>
              <router-link :to="{ path: '/' }">
                <span class="text-white"> Continuer vers l'accueil</span></router-link
              >
            </b-button>
            <!--<b-button type="is-bleue" class="m-2 w-100" hovered>
                <router-link :to="{ path: '/choice/posting' }">
                  <span class="text-white">
                    Créer une nouvelle offre d'emploi</span
                  ></router-link
                >
              </b-button>-->
            <!--<infos-base-1 width="200px" height="100px"> </infos-base-1>-->
          </div>
        </a-card></a-col
      >
    </a-row>
  </div>
</template>
<script>
import successOffre1 from "../Icons/success-offre-1.vue";
import infosBase1 from "../Icons/infos-base-1.vue";
export default {
  components: { successOffre1, infosBase1 },
};
</script>
<style scoped></style>
