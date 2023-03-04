<template>
  <div>
    <a-card>
      <a-comment v-if="showForm == true" :bordered="false">
        <a-avatar
          slot="avatar"
          src="https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png"
          alt="Han Solo"
        />
        <div slot="content">
          <v-text-field v-model="value" solo label="Solo" clearable></v-text-field>
          <a-form-item>
            <a-button @click="showForm = false" class="mx-2"> Annuler</a-button>
            <a-button
              class="mx-2"
              html-type="submit"
              :loading="submitting"
              type="primary"
              @click="addComment"
            >
              Add Comment
            </a-button>
          </a-form-item>
        </div>
      </a-comment>
      <a-comment
        style="word-break: break-word"
        :author="comment.user.pseudo"
        :avatar="'https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png'"
        :content="comment.body"
        :datetime="moment(comment.datetime).fromNow()"
        :bordered="false"
      >
        <like
          :likeTrue="proplike(comment)"
          :dislikeTrue="propdislike(comment)"
          :nbrLikes="comment.nbrLikes"
          :nbrdisLikes="comment.nbrdisLikes"
          @like-click="reactionlike($event, comment)"
          @dislike-click="reactiondislike($event, comment)"
          ><a-button v-if="showForm == false" @click="showForm = !showForm" class="ms-2"
            >Répondre</a-button
          ></like
        >
      </a-comment>
    </a-card>
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
      type: Number,
      required: false,
      default: null,
    },
  },
  //props: ["realisationId", "commentId"],
  data() {
    return {
      comment: this.item,
      submitting: false,
      value: "@" + this.item.user.pseudo,
      moment,
      activeLoading: true,
      showButton: false,
      showComments: false,
      showForm: false,
      comments: this.item.comments,
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
            this.item.realisationId +
            "/users/" +
            this.user.id +
            "/comments",
          { body: this.value, comment_id: this.commentId }
        )
        .then(async (response) => {
          //this.comment.comment = response.data.comment;
          console.log(response.data.message);
          this.$emit("get-all-comments", this.commentId);
          // await this.getAllcomments(this.item.id);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        })
        .finally(async () => {
          this.submitting = false;
          this.value = null;
        });
      // this.$emit("add-comment");
      // this.changeComponent("list", 0);
    },
    async reactionlike(reaction, comment) {
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
    },
  },
};
</script>
