<template>
  <a-card :loading="activeLoading" class="w-100" style="border-radius: 5px">
    <template slot="title">
      <b-field>
        <template #label>
          <span class="font-weight-black text-h6">Commentaires </span>
        </template>
      </b-field>
    </template>
    <b-button @click="showAllcomments = !showAllcomments" v-if="comments.length > 0"
      ><span v-if="showAllcomments == false">
        <span>{{ nbrCommentM }}</span
        ><span v-if="nbrCommentM == 0">{{ "commentaire" }}</span
        ><span v-else>{{ "commentaires" }}</span>
      </span>
      <span v-else>Cacher les commentaires </span>
    </b-button>
    <a-card :bordered="false" v-else class=""
      ><b-message outlined rounded type="is-info">
        <b-field label="Aucun commentaire disponible"></b-field></b-message
    ></a-card>
    <a-list
      v-if="comments.length && showAllcomments == true"
      :data-source="comments"
      :header="`${nbrCommentM} ${nbrCommentM > 1 ? 'Commentaires' : 'commentaire'}`"
      item-layout="horizontal"
      class="w-100"
      :bordered="false"
    >
      <a-list-item
        slot="renderItem"
        slot-scope="item"
        :bordered="false"
        class="border-custom"
      >
        <comment
          class="w-100"
          :item="item"
          :commentId="Number(item.id)"
          :parentP="true"
          @nbrs-comment="commentNbrsFunction"
          @reloading="reloading"
        ></comment>
      </a-list-item>
    </a-list>
    <div style="margin-top: 3px">
      <b-button v-if="showForm == false" @click="showForm = !showForm" type="is-bleue"
        >Ajouter un commentaire</b-button
      >
      <div>
        <b-field>
          <template #label>
            <span style="margin-bottom: 25px">Ajouter un commentaire</span>
          </template>
          <p class="control me-2">
            <a-avatar
              slot="avatar"
              :src="user.avatar.url"
              alt="Han Solo"
              v-if="user.avatar != null"
            />
            <vs-avatar v-else />
          </p>
          <!-- <v-textarea
            v-model="value"
            solo
            name="input-7-1"
            auto-grow
            clearable
            :rows="1"
            class="w-100"
          ></v-textarea>-->
          <div class="w-100">
            <b-input
              v-model="value"
              type="textarea"
              rounded
              clearable
              class="w-100 barre"
              :rows="1"
            ></b-input>
            <b-button
              class="mt-3"
              label="Envoyer"
              :loading="submitting"
              @click="addComment"
              type="is-bleue"
            />
          </div>
        </b-field>

        <div>
          <!--<b-button class="" type="is-white" @click="showForm = false">Annuler</b-button>-->
        </div>
      </div>
      <!--<a-comment v-if="showForm == true">
        <a-avatar
          slot="avatar"
          src="https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png"
          alt="Han Solo"
        />
        <div slot="content">
          <v-container fluid>
            <v-textarea
              v-model="value"
              solo
              name="input-7-1"
              filled
              label="Label"
              auto-grow
              clearable
              :rows="1"
            ></v-textarea>
          </v-container>
          <a-form-item>
            <b-button class="me-2" type="is-white" @click="showForm = false"
              >Annuler</b-button
            >
            <b-button
              class="ms-2"
              :loading="submitting"
              @click="addComment"
              type="is-bleue"
              >Ajouter</b-button
            >
          </a-form-item>
        </div>
      </a-comment>-->
    </div>
  </a-card>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "comments",
  props: {
    realisationId: {
      type: Number,
      required: false,
      default: null,
    },
    nbrComments: {
      type: Number,
      required: false,
      default: 0,
    },
  },
  data() {
    return {
      comments: [],
      activeLoading: true,
      submitting: false,
      value: "",
      showAllcomments: true,
      showForm: true,
      nbrCommentM: this.nbrComments,
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    commentNbrsFunction(nbr = 0) {
      this.nbrCommentM = this.nbrCommentM + nbr;
      return this.nbrCommentM;
    },
    async addComment() {
      if (!this.value) {
        return;
      }
      this.submitting = true;
      await axios
        .post(
          "/api/v1/realisations/" +
            this.realisationId +
            "/users/" +
            this.user.id +
            "/comments",
          { body: this.value, comment_id: null }
        )
        .then(async (response) => {
          this.commentNbrsFunction(1);
          await this.getAllcomments();
          console.log(response.data.message);
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
    async getAllcomments() {
      this.activeLoading = true;
      await axios
        .get("/api/v1/realisations/" + this.realisationId + "/comments")
        .then((response) => {
          console.log(response.data.data);
          this.comments = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.activeLoading = false));
    },
    async reloading(obj) {
      console.log("12");
      await this.getAllcomments();
      this.commentNbrsFunction(obj.nbr);
    },
  },
  async beforeMount() {
    this.commentNbrsFunction();
    await this.getAllcomments();
  },
};
</script>
<style scoped lang="scss">
.border-custom {
  border-style: none;
}
.animate__flipInX .animate__animated.animate__bounce {
  --animate-duration: 6s;
}
.barre::-webkit-scrollbar {
  width: 10px; /* width of the entire scrollbar */
}

.barre::-webkit-scrollbar-track {
  background: #f5f5f5; /* color of the tracking area */
}

.barre::-webkit-scrollbar-thumb {
  background-color: #e0e0e0; /* color of the scroll thumb */
  border-radius: 20px; /* roundness of the scroll thumb */
  border: 3px solid #f5f5f5; /* creates padding around scroll thumb */
}
.barre {
  scrollbar-width: thin; /* "auto" or "thin" */
  scrollbar-color: #e0e0e0 #f5f5f5; /* scroll thumb and track */
}
</style>
