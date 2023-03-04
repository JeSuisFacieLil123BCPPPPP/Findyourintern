<template>
  <div>
    <div class="card">
      <div class="header">Blah</div>
      <div v-if="messages.lenght != 0" class="card-body">
        <message
          v-for="message in messages"
          :key="message.id"
          :message="message"
          :user="user"
        >
        </message>
        <div class="card-footer">
          <v-textarea v-model="content"> </v-textarea>
          <v-btn @click="sendMessageFunction">Envoyer</v-btn>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import message from "./Message.vue";
export default {
  components: { message },
  data() {
    return {
      content: "",
    };
  },
  mounted() {
    this.loadMessages(this.$route.params.id);
    window.Echo.channel("private-App.User." + this.$route.params.id).listen(
      ".new.message",
      (e) => {
        // ADD_MESSAGE(state,{message,conversationId})
        console.log("je suis fatiguée oooh");
        console.log(e);
        this.$store.commit("conversation/ADD_MESSAGE", {
          message: e.message,
          conversationId: e.message.user_send_id,
        });
        this.content = "";
      }
    );
    /* window.Echo.channel("App.User." + this.$route.params.id).listen(
      ".new-message",
      (e) => {
        // ADD_MESSAGE(state,{message,conversationId})
        console.log("je suis fatiguée");
        this.$store.commit("conversation/ADD_MESSAGE", {
          message: e.message,
          conversationId: e.message.user_send_id,
        });
        this.content = "";
      }
    );*/
  },
  computed: {
    ...mapGetters({
      getMessages: "conversation/messages",
      user: "auth/getUser",
    }),

    messages() {
      if (this.$route.params.id) return this.getMessages({ id: this.$route.params.id });
    },
  },
  methods: {
    ...mapActions({
      loadMessages: "conversation/loadMessages",
      sendMessage: "conversation/sendMessage",
    }),
    sendMessageFunction() {
      // if (e.shiftKey == false) {
      this.sendMessage({ content: this.content, user_rec_id: this.$route.params.id });
      this.content = "";
    },
  },
  watch: {
    $route(to, from) {
      //console.log("to");
      //console.log(to.params.id);
      this.loadMessages(to.params.id);
    },
  },
};
</script>
<style scoped></style>
