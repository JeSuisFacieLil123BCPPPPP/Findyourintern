<template>
  <div class="d-flex flex-row">
    <div>
      <vs-list>
        <vs-list-header title="Users" color="danger"></vs-list-header>
        <div v-for="conversation in conversations" :key="conversation.id" class="liste">
          <router-link :to="{ name: 'conversation', params: { id: conversation.id } }">
            <vs-list-item
              :title="conversation.pseudo"
              :subtitle="conversation.email"
              class="text-black"
            >
              <template slot="avatar">
                <vs-avatar
                  size="large"
                  v-if="conversation.avatar != null"
                  :src="conversation.avatar.variants['small'].secure_url"
                />
                <vs-avatar v-else icon="person" size="large" />
              </template>
            </vs-list-item>
          </router-link>
        </div>
      </vs-list>
    </div>
    <div class="border border-primary card flex-shrink-1 w-100">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
  props: {
    user: Number,
  },
  mounted() {
    this.loadConversations();
    /*window.Echo.channel("private-App.User." + this.$route.params.id).listen(
      ".new.message",
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
    //this.setUser(this.user);
  },
  computed: {
    ...mapGetters({
      conversations: "conversation/conversations",
      user: "auth/getUser",
    }),
  },
  methods: {
    ...mapActions({
      loadConversations: "conversation/loadConversations",
      // setUser:"conversation/setUser",
    }),
    ...mapMutations({
      addMessage: "conversation/ADD_MESSAGE", // map `this.add()` to `this.$store.commit('increment')`
    }),
  },
};
</script>
<style scoped>
.liste {
  min-width: 336px !important;
}
</style>
