<template>
  <div>
    <div class="row">
      <div :class="cls">
        <p>
          <strong> {{ username }}</strong
          ><br />
          {{ message.body }}
        </p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["message", "user"],
  computed: {
    cls() {
      let cls = ["col-md-10"];
      if (this.message.user_send_id == this.user.id) {
        cls.push("offset-md-2 text-right");
      }
      return cls;
    },
    username() {
      if (this.message.user_send_id == this.user.id) {
        return "Moi";
      }
      return this.user.pseudo;
    },
  },
  mounted() {
    /*window.Echo.channel("private-App.User." + this.$route.params.id).listen(
      ".new.message",
      (e) => {
        // ADD_MESSAGE(state,{message,conversationId})
        console.log("je suis fatiguée");
        console.log(e);
        this.$store.commit("conversation/ADD_MESSAGE", {
          message: e.message,
          conversationId: e.message.user_send_id,
        });
        this.content = "";
      }
    );*/
  },
};
</script>
<style scoped></style>
