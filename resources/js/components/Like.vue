<template>
  <div>
    <a-tooltip title="J'aime ">
      <button class="bttn-pill bttn-md vert-b" v-if="back == true" style="color: white">
        <span>{{ nbrA }}</span>
        <v-icon
          :small="taille == 'small' ? true : false"
          :mdeium="taille == 'medium' ? true : false"
          :large="taille == 'large' ? true : false"
          style="color: white"
          @click="liked()"
        >
          {{ getLike() }}
        </v-icon>
      </button>
      <span v-else>
        <span>{{ nbrA }}</span>
        <v-icon
          :small="taille == 'small' ? true : false"
          :mdeium="taille == 'medium' ? true : false"
          :large="taille == 'large' ? true : false"
          color="#24855a"
          @click="liked()"
        >
          {{ getLike() }}
        </v-icon>
      </span>
    </a-tooltip>
    <v-divider class="mx-1" vertical></v-divider>
    <a-tooltip title="Je n'aime pas">
      <button class="bttn-pill bttn-md vert-b" v-if="back == true" style="color: white">
        <span>{{ nbrB }}</span>
        <v-icon
          :small="taille == 'small' ? true : false"
          :mdeium="taille == 'medium' ? true : false"
          :large="taille == 'large' ? true : false"
          style="color: white"
          @click="disliked()"
        >
          {{ getdisLike() }}
        </v-icon>
      </button>
      <span v-else>
        <span>{{ nbrB }}</span>
        <v-icon
          :small="taille == 'small' ? true : false"
          :mdeium="taille == 'medium' ? true : false"
          :large="taille == 'large' ? true : false"
          color="#24855a"
          @click="disliked()"
        >
          {{ getdisLike() }}
        </v-icon>
      </span>
    </a-tooltip>
    <v-divider class="mx-1" vertical></v-divider>
    <slot></slot>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  //props:['likeTrue','unlikeTrue','nbrLikes','nbrunLikes'],
  props: {
    likeTrue: {
      type: Boolean,
      required: true,
      default: false,
    },
    nbrLikes: {
      type: Number,
      required: true,
      default: 0,
    },
    dislikeTrue: {
      type: Boolean,
      required: true,
      default: false,
    },
    nbrdisLikes: {
      type: Number,
      required: true,
      default: 0,
    },
    taille: {
      type: String,
      required: false,
      default: "small",
    },
    back: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  data() {
    return {
      like: this.likeTrue,
      dislike: this.dislikeTrue,
      nbrA: this.nbrLikes || 0,
      nbrB: this.nbrdisLikes || 0,
      actuel: this.etat(),
    };
  },
  computed: {
    getNbrLikes() {
      if (this.like == true) {
        return this.nbrA;
      } else if (this.like == false) {
        return this.nbrA;
      }
    },
    getNbrdisLikes() {
      if (this.dislike == true) {
        return this.nbrB;
      } else if (this.dislike == false) {
        return this.nbrB;
      }
    },
    ...mapGetters({
      user: "auth/getUser",
    }),
  },

  methods: {
    etat() {
      if (this.likeTrue == true) return "liked";
      else if (this.dislikeTrue == true) return "disliked";
      else return "nothing";
    },
    getLike() {
      if (this.like == true) {
        return "mdi-thumb-up";
      } else return " mdi-thumb-up-outline";
    },
    getdisLike() {
      if (this.dislike == true) {
        return "mdi-thumb-down";
      } else return " mdi-thumb-down-outline";
    },

    liked() {
      if (this.user.user_type != "") {
        if (this.actuel == "liked") {
          this.nbrA = this.nbrA - 1;
          this.like = false;
          this.actuel = "nothing";
          this.$emit("unlike-click");
        } else if (this.actuel == "disliked") {
          this.nbrA = this.nbrA + 1;
          this.nbrB = this.nbrB - 1;
          this.like = true;
          this.dislike = false;
          this.actuel = "liked";
          this.$emit("undislike-click");
          this.$emit("like-click");
        } else {
          this.nbrA = this.nbrA + 1;
          this.like = true;
          this.actuel = "liked";
          this.$emit("like-click");
        }
      }
    },
    disliked() {
      if (this.user.user_type != "") {
        if (this.actuel == "disliked") {
          this.nbrB = this.nbrB - 1;
          this.dislike = false;
          this.actuel = "nothing";
          this.$emit("undislike-click");
        } else if (this.actuel == "liked") {
          this.nbrB = this.nbrB + 1;
          this.nbrA = this.nbrA - 1;
          this.dislike = true;
          this.like = false;
          this.actuel = "disliked";
          this.$emit("unlike-click");
          this.$emit("dislike-click");
        } else {
          this.nbrB = this.nbrB + 1;
          this.dislike = true;
          this.actuel = "disliked";
          this.$emit("dislike-click");
        }
      }
    },
  },
  beforeMount() {
    console.log(this.actuel);
  },
};
</script>
<style scoped></style>
