<!--<template>
  <div id="app">
    <vue-editor
      ref="editor"
      v-model="content"
      useCustomImageHandler
      @image-added="handleImageAdded"
      @image-removed="handleImageRemoved"
      @selection-change="indexer"
    />
    <div v-html="content" class="ql-editor"></div>
  </div>
</template>

<script>
import { VueEditor, Quill } from "vue2-editor";
import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-module";
Quill.register("modules/imageDrop", ImageDrop);
//Quill.register("modules/imageResize", ImageResize);
export default {
  name: "editor-customer",
  data() {
    return {
      images: [],
      customToolbar: [
        [{ header: [false, 1, 2, 3, 4, 5, 6] }],
        ["bold", "italic", "underline", "strike"], // toggled buttons
        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
        ["blockquote", "code-block"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        ["link", "image"],
        ["clean"],
        ["checklist", "warning"],
      ],
      /*editorSettings: {
        modules: {
          imageDrop: true,
          imageResize: {},
        },
      },*/
      index: null,
      content: "ertyui",
      // '<p class="ql-align-justify"><img src="https://res.cloudinary.com/ddt7qfshl/image/upload/v1666810039/ressources/images/Capture_okoo6h.png" style="display: inline; margin: 0px 1em 1em 0px; float: left;" width="215"><strong>Travaillez, prenez de la peine&nbsp;:</strong></p><p class="ql-align-justify"><strong>C’est le fonds qui manque le moin</strong>s.</p><p> Un riche Laboureur, sentant sa mort prochaine,</p><p class="ql-indent-1"> Fit venir ses enfants, leur parla sans témoins.</p><ul><li class="ql-indent-4"> Gardez-vous, leur dit-il, de vendre l’héritage</li><li class="ql-indent-4"> Que nous ont laissé nos parents.</li><li class="ql-indent-4"> Un trésor est caché dedans.</li></ul><p> Je ne sais pas l’endroit&nbsp;; mais un peu de courage</p><p> Vous le fera trouver, vous en viendrez à bout.</p><p> Remuez votre champ dès qu’on aura fait l’Oût.</p><p> Creusez, fouiller, bêchez&nbsp;; ne laissez nulle place</p><p> Où la main ne passe et repasse.</p>',
    };
  },
  methods: {
    indexer(a, b, c) {
      console.log(a);
      console.log(b);
      console.log(c);
      this.index = a;
    },
    onInitialized(editor) {
      console.log(editor);
    },
    async handleImageAdded(file, Editor, cursorLocation, resetUploader) {
      const CLOUDINARY_UPLOAD_PRESET = "ml_default";
      let formData = new FormData();
      formData.append("upload_preset", CLOUDINARY_UPLOAD_PRESET);
      formData.append("folder", "ressources/images");
      formData.append("file", file);
      console.log("sass");
      console.log(cursorLocation);
      console.log(resetUploader);
      // console.log(a);
      await axios
        .post("https://api.cloudinary.com/v1_1/ddt7qfshl/image/upload", formData)
        .then((response) => {
          console.log(response);
          this.images.push(response.data);
          console.log(Editor);
          Editor.insertEmbed(
            cursorLocation,
            "image",
            response.data.secure_url
            //response.data.public_id
          );
          resetUploader();
        })
        .catch(({ response: { data } }) => {
          console.log(data);
        });
    },
    async handleImageRemoved(file, Editor, cursorLocation) {
      console.log("seyd");
      console.log(file);
      console.log(Editor);
      console.log(cursorLocation);
      var index = this.images.findIndex(function (ele) {
        console.log("file");
        console.log(file);
        return ele.secure_url == file;
      });
      await axios
        .post(
          "https://api.cloudinary.com/v1_1/ddt7qfshl/image/destroy",
          await this.formDataDeleted(index)
        )
        .then((res) => {
          console.log("nathe");
          console.log(res.data.result);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    async formDataDeleted(index) {
      const timestamp = new Date().getTime();
      const api_key = "721474231639524";
      const string1 =
        "public_id=" +
        this.images[index].public_id +
        "&timestamp=" +
        timestamp +
        "tKW-g80_eRQbtSHSjwQHbfNzwDc";
      const signature = await sha1(string1);
      let formData = new FormData();
      formData.append("public_id", this.images[index].public_id);
      formData.append("signature", signature);
      formData.append("timestamp", timestamp);
      formData.append("api_key", api_key);
      return formData;
    },
  },
};
</script>

<style scoped>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /* text-align: center; */
  color: #2c3e50;
  margin-top: 60px;
}
</style>
-->
<template>
  <div>
    <!-- <vue-editor ref="editor" v-model="content" style="display: none" />
    <div v-html="content" class="ql-editor"></div>-->
    <messagerie-component :user="user.id" class=""></messagerie-component>
  </div>
</template>

<script>
import MessagerieComponent from "./Messagerie/MessagerieComponent.vue";
import { mapGetters } from "vuex";
//import { VueEditor } from "vue2-editor";

export default {
  components: { MessagerieComponent },
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
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  mounted() {
    console.log("monte0");
    /*  window.Echo.channel("private-App.User." + this.$route.params.id).listen(
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
    /* window.Echo.private("App.User." + this.$route.params.id)
      .listen("newMessage", (e) => {
        console.log("message de la conversations");
        console.log(e);
      })
      .error((error) => {
        console.log("errorrrrrr");
        console.error(error);
      });*/
  },
};
</script>

<style></style>
