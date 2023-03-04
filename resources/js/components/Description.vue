<template>
  <div>
    <vue-editor ref="editor" v-model="content" style="display: none" />
    <div v-html="content" class="ql-editor"></div>
  </div>
</template>

<script>
//import MessagerieComponent from "./Messagerie/MessagerieComponent.vue";
//import { mapGetters } from "vuex";
//import { VueEditor } from "vue2-editor";

export default {
  /* components: {
      VueEditor,
    },*/
  props: ["content"],
  data() {
    return {
      contents:
        '<p class="ql-align-justify"><img src="https://res.cloudinary.com/ddt7qfshl/image/upload/v1666810039/ressources/images/Capture_okoo6h.png" style="display: inline; margin: 0px 1em 1em 0px; float: left;" width="215"><strong>Travaillez, prenez de la peine&nbsp;:</strong></p><p class="ql-align-justify"><strong>C’est le fonds qui manque le moin</strong>s.</p><p> Un riche Laboureur, sentant sa mort prochaine,</p><p class="ql-indent-1"> Fit venir ses enfants, leur parla sans témoins.</p><ul><li class="ql-indent-4"> Gardez-vous, leur dit-il, de vendre l’héritage</li><li class="ql-indent-4"> Que nous ont laissé nos parents.</li><li class="ql-indent-4"> Un trésor est caché dedans.</li></ul><p> Je ne sais pas l’endroit&nbsp;; mais un peu de courage</p><p> Vous le fera trouver, vous en viendrez à bout.</p><p> Remuez votre champ dès qu’on aura fait l’Oût.</p><p> Creusez, fouiller, bêchez&nbsp;; ne laissez nulle place</p><p> Où la main ne passe et repasse.</p>',
    };
  },
};
</script>

<style></style>
