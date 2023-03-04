<template>
  <div>
    <div class="d-flex flex-row elevation_1">
      <div class="p-2">
        <vs-avatar
          size="large"
          v-if="comment.user.avatar != null"
          :src="comment.user.avatar.variants['small'].secure_url"
          color="#80d8ff"
        />
        <vs-avatar v-else icon="person" size="medium" />
      </div>
      <div class="p-2 flex-grow-1">
        <div class="d-flex flex-row">
          <h1 class="card-title align-self-center me-auto">
            <span>{{ comment.user.pseudo }} </span><a-divider type="vertical" /><span
              class="text-muted ms-2 fw-normal"
            >
              {{ moment(comment.datetime).fromNow() }}</span
            >
          </h1>
        </div>
        <div
          class="card-header"
          v-if="comment.userTo != null && comment.user.id != comment.userTo.id"
        >
          Réponse à <span>&nbsp;</span>
          <a v-if="comment.userTo != null" style="color: #1e88e5">{{
            comment.userTo.pseudo
          }}</a>
        </div>
        <div class="mt-3 me-3">
          {{ comment.body }}
        </div>
        <div v-if="showForm == true">
          <v-row>
            <v-col cols="12">
              <v-row>
                <v-col cols="1">
                  <vs-avatar
                    v-if="comment.user.avatar != null"
                    :src="comment.user.avatar.variants['small'].secure_url"
                    color="#80d8ff"
                  />
                  <vs-avatar slot="avatar" v-else icon="person" color="#80d8ff" />
                </v-col>
                <v-col cols="11">
                  <div>
                    <v-container fluid>
                      <v-textarea
                        :value="value"
                        @change="fieldValue"
                        solo
                        auto-grow
                        clearable
                        :rows="1"
                      ></v-textarea>
                    </v-container>
                    <a-form-item>
                      <a-button @click="showForm = false" class="mx-2"> Annuler</a-button>
                      <a-button
                        class="mx-2"
                        html-type="submit"
                        :loading="submitting"
                        type="primary"
                        @click="addComment"
                      >
                        Ajouter
                      </a-button>
                    </a-form-item>
                  </div>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </div>
        <div
          class="card-footer border-custom d-flex flex-row align-items-center justify-content-between"
        >
          <like
            :likeTrue="proplike(comment)"
            :dislikeTrue="propdislike(comment)"
            :nbrLikes="comment.nbrLikes"
            :nbrdisLikes="comment.nbrdisLikes"
            @like-click="like"
            @dislike-click="dislike"
            @unlike-click="unlike"
            @undislike-click="undislike"
          >
            <v-icon @click="showForm = !showForm" small style="color: #24855a">
              mdi-comment</v-icon
            >
          </like>
          <b-dropdown aria-role="list" class="align-self-center">
            <template #trigger="{ active }">
              <v-icon small color="green-grey lighten-1"
                >fa-solid fa-ellipsis-vertical
              </v-icon>
            </template>

            <b-dropdown-item
              aria-role="listitem"
              v-if="comment.user.id === user.id"
              @click="remove(comment.id)"
              >Supprimer</b-dropdown-item
            >
            <b-dropdown-item aria-role="listitem">Signaler</b-dropdown-item>
          </b-dropdown>
        </div>
        <div class="card-footer" v-if="comments.length != 0">
          <div class="w-100">
            <a-button @click="showComments = !showComments && comments.length > 0">{{
              comments.length + " Réponses"
            }}</a-button>
            <a-list
              v-if="comments.length && showComments == true"
              :data-source="comments"
              :header="`${comments.length} ${
                comments.length > 1 ? 'commentaires' : 'commentaire'
              }`"
              item-layout="horizontal"
              class="w-100"
            >
              <a-list-item slot="renderItem" slot-scope="item" class="w-100">
                <comment
                  class="w-100"
                  :item="item"
                  :commentId="comment.id"
                  @get-all-comments="getAllcomments"
                  @get-all-comments-remove="getAllcommentsRemove"
                ></comment>
              </a-list-item>
            </a-list>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import fr_FR from "ant-design-vue/lib/locale-provider/fr_FR";
import moment from "moment";
import "moment/locale/fr";
export default {
  name: "comments",
  props: {
    item: {
      type: Object,
      required: false,
      default: null,
    },
    commentId: {
      type: [Number, String],
      required: false,
      default: null,
    },
    parentP: {
      type: [Boolean],
      required: false,
      default: false,
    },
  },
  // props: ["realisationId", "commentId"],
  data() {
    return {
      comment: this.item,
      submitting: false,
      value: "",
      moment,
      activeLoading: true,
      showButton: false,
      showComments: false,
      showForm: false,
      comments: this.item.comments,
      show: false,
      userTo: null,
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
    /*themeL(index){
        this.actions[index] === 'liked' ? 'filled' : 'outlined'
      }*/
  },
  /* watch: {
      async actions(){
       await this.getAllcomments();
      }
    },*/

  methods: {
    fieldValue(value) {
      this.value = value;
      if (this.parentP == false) this.userTo = this.comment.user.id;
    },
    commentIndex(comment) {
      return comment.reaction.findIndex((element) => (element.id = this.user.id));
    },
    proplike(comment) {
      if (comment.reaction.length == 0) {
        return false;
      } else {
        const index = this.commentIndex(comment);
        if (index != -1) {
          return Boolean(comment.reaction[index].pivot.like);
        } else return false;
      }
    },
    propdislike(comment) {
      if (comment.reaction.length == 0) {
        return false;
      } else {
        const index = this.commentIndex(comment);
        if (index != -1) {
          return Boolean(comment.reaction[index].pivot.dislike);
        } else return false;
      }
    },
    async addComment() {
      if (!this.value) {
        return;
      }
      this.submitting = true;
      await axios
        .post(
          "/api/v1/realisations/" +
            this.comment.realisationId +
            "/users/" +
            this.user.id +
            "/comments",
          { body: this.value, comment_id: this.commentId, comment_user: this.userTo }
        )
        .then(async (response) => {
          //this.comment.comment = response.data.comment;
          console.log(response.data.message);
          if (this.parentP != true) {
            console.log("enfant");
            console.log(this.comment.id);
            console.log(this.comment.comment_id);
            console.log(this.commentId);
            this.$emit("get-all-comments", {
              commentId: this.commentId,
              nbr: 1,
            });
          } else {
            // this.$emit("get-all-comments", { commentId: this.commentId, nbr: 1 });
            console.log("parent");
            await this.getAllcomments({ commentId: this.commentId, nbr: 1 });
          }
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        })
        .finally(async () => {
          this.submitting = false;
          this.value = null;
          /*this.$buefy.notification.open({
            message: `I can show you a little progress bar displaying the remaining time!`,
            duration: 5000,
            progressBar: true,
            type: "is-primary",
            pauseOnHover: true,
          });*/
        });
      // this.$emit("add-comment");
      // this.changeComponent("list", 0);
    },
    /* async reactionlike(reaction, comment) {
      console.log(comment);
      console.log(reaction);
      await axios
        .post(
          "/api/v1/comment/" + comment.id + "/user/" + this.user.id + "/like",
          reaction
        )
        .then((response) => {
          console.log(response.data);
          console.log("yoyo");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async reactiondislike(reaction, comment) {
      console.log(comment);
      console.log(reaction);
      await axios
        .post(
          "/api/v1/comment/" + comment.id + "/user/" + this.user.id + "/like",
          reaction
        )
        .then((response) => {
          console.log("yoyo");
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },*/

    async like() {
      await axios
        .post("/api/v1/comment/" + this.comment.id + "/user/" + this.user.id + "/like")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async dislike() {
      await axios
        .post("/api/v1/comment/" + this.comment.id + "/user/" + this.user.id + "/dislike")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async unlike() {
      await axios
        .post("/api/v1/comment/" + this.comment.id + "/user/" + this.user.id + "/unlike")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async undislike() {
      await axios
        .post(
          "/api/v1/comment/" + this.comment.id + "/user/" + this.user.id + "/undislike"
        )
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async getAllcomments(obj) {
      //this.$emit("get-all-comments");
      this.activeLoading = true;
      console.log("moi");
      console.log(obj);
      await axios
        .get(
          "/api/v1/realisations/" +
            this.comment.realisationId +
            "/comments/" +
            obj.commentId
        )
        .then((response) => {
          console.log(response);
          this.comments = response.data.data.comments;
          this.$emit("nbrs-comment", 1);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    async getAllcommentsRemove(obj) {
      //this.$emit("get-all-comments");
      this.activeLoading = true;
      console.log("moi");
      console.log(obj.nbr);
      await axios
        .get(
          "/api/v1/realisations/" +
            this.comment.realisationId +
            "/comments/" +
            obj.commentId
        )
        .then((response) => {
          console.log(response);
          this.comments = response.data.data.comments;
          this.$emit("nbrs-comment", obj.nbr);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    async remove(commentId) {
      //this.$emit("get-all-comments");
      //this.activeLoading = true;
      await axios
        .delete("/api/v1/comment/" + commentId)
        .then(async (response) => {
          console.log(response);
          if (this.parentP != true) {
            console.log("1");
            this.$emit("get-all-comments-remove", { commentId: this.commentId, nbr: -1 });
            //this.$emit("reloading", { commentId: this.commentId, nbr: -1 });
          } else {
            console.log("2");
            this.$emit("reloading", { commentId: this.commentId, nbr: -1 });
            //await this.getAllcomments({ commentId: this.comment.id, nbr: -1 });
          }
        })
        .catch((error) => {
          console.log(error);
        });
      /* .finally(() =>
          /*this.$buefy.notification.open({
            message: `I can show you a little progress bar displaying the remaining time!`,
            duration: 5000,
            progressBar: true,
            type: "is-primary",
            pauseOnHover: true,
          })
        );*/
    },
    async reloading(obj) {
      console.log("12");
      await this.getAllcomments();
      this.commentNbrsFunction(obj);
    },
  },
};
</script>
<style scoped>
.border-custom {
  border-style: none;
}
.cm-body {
  font-family: "Arial";
  margin-right: 60px;
  margin-left: 0px !important;
}
</style>
