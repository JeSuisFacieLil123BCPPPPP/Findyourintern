<template>
  <div>
    <v-card class="overflow-hidden m-2">
      <v-row class="m-2" justify="center" align="start">
        <v-col cols="4">
          <v-card class="overflow-auto" no-gutters>
            <v-list three-line>
              <template v-for="(item, index) in items">
                <v-subheader
                  v-if="item.header"
                  :key="item.header"
                  v-text="item.header"
                ></v-subheader>

                <v-divider
                  v-else-if="item.divider"
                  :key="index"
                  :inset="item.inset"
                ></v-divider>

                <v-list-item v-else :key="item.title">
                  <v-list-item-avatar>
                    <v-img :src="item.avatar"></v-img>
                  </v-list-item-avatar>

                  <v-list-item-content>
                    <v-list-item-title v-html="item.title"></v-list-item-title>
                    <v-list-item-subtitle v-html="item.subtitle"></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </template> </v-list
          ></v-card>
        </v-col>
        <v-col cols="8" class="">
          <div class="d-flex flex-column align-items-around" style="height: 100%">
            <div class="">
              <v-list>
                <v-list-item>
                  <v-list-item-avatar>
                    <v-img
                      :src="userRec.avatar.secure_url"
                      v-if="userRec.avatar != null"
                    ></v-img>
                    <v-icon :size="40" v-else> mdi-account-circle </v-icon>
                  </v-list-item-avatar>
                  <v-list-item-title>
                    {{ userRec.pseudo }}
                  </v-list-item-title>
                </v-list-item>
              </v-list>
            </div>
            <v-card class="h-100">
              <div class="d-flex flex-column overflow-auto">
                <div
                  v-for="(item, index) in messages"
                  :key="index"
                  class=""
                  style="display: inline-block"
                >
                  <span
                    v-if="item.user_send_id == user.id"
                    class="align-self-end d-inline bg-primary ms-2 my-3"
                    >{{ item.body }}</span
                  >
                  <span v-else class="align-self-start bg-success me-2 my-3">{{
                    item.body
                  }}</span>
                </div>
              </div>
            </v-card>
            <div class="w-100">
              <v-row>
                <v-col cols="10">
                  <v-textarea
                    v-model="message"
                    class="w-100"
                    label="prepend-icon"
                    rows="1"
                    prepend-icon="mdi-comment"
                  ></v-textarea
                ></v-col>
                <v-col cols="2">
                  <v-btn @click="sendMessage">
                    <v-icon dark small>folder_open</v-icon></v-btn
                  >
                </v-col>
              </v-row>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-card>

    <!-- <v-card class="align-self-start w-100" :no-gutters="true">
      <v-list-item>
        <v-list-item-avatar>
          <v-img :src="userRec.avatar.secure_url" v-if="userRec.avatar != null"></v-img>
          <v-icon :size="40" v-else> mdi-account-circle </v-icon>
        </v-list-item-avatar>
        <v-list-item-title>
          {{ userRec.pseudo }}
        </v-list-item-title>
      </v-list-item>
    </v-card>
    <div class="align-self-end w-100">
      <v-row>
        <v-col cols="12" sm="6">
          <v-textarea
            class="mx-2"
            label="prepend-icon"
            rows="1"
            prepend-icon="mdi-comment"
          ></v-textarea>
        </v-col>
      </v-row>
    </div>-->
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: ["userRecId"],
  data() {
    return {
      userRec: {},
      message: "",
      messages: [],
      items: [
        { header: "Today" },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
          title: "Brunch this weekend?",
          subtitle: `<span class="text--primary">Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?`,
        },
        { divider: true, inset: true },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
          title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
          subtitle: `<span class="text--primary">to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.`,
        },
        { divider: true, inset: true },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
          title: "Oui oui",
          subtitle:
            '<span class="text--primary">Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?',
        },
        { divider: true, inset: true },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
          title: "Birthday gift",
          subtitle:
            '<span class="text--primary">Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?',
        },
        { divider: true, inset: true },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/5.jpg",
          title: "Recipe to try",
          subtitle:
            '<span class="text--primary">Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.',
        },
      ],
    };
  },
  async beforeMount() {
    await this.getUserRecbyId();
    await this.getMessageFrom();
  },
  methods: {
    async sendMessage() {
      console.log(this.user.id);
      console.log(this.userRecId);
      console.log(this.message);
      /*  await axios
        .post("/api/v1/users/message/", {
          userSendId: this.user.id,
          userRecId: this.userRecId,
          body: this.message,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });*/
      await axios
        .post("/api/v1/users/message", {
          userSendId: this.user.id,
          userRecId: this.userRecId,
          body: this.message,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getUserRecbyId() {
      await axios
        .get("/api/v1/users/show/" + this.userRecId)
        .then((response) => {
          this.userRec = response.data.user;
          console.log(response.data.message);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getMessageFrom() {
      await axios
        .get(
          "/api/v1/users/messages/user/" + this.user.id + "/userRecId/" + this.userRecId
        )
        .then((response) => {
          this.messages = response.data.messages;
          console.log("errrrrrrrrr");

          console.log(response.data.messages);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
};
</script>
<style scoped></style>
