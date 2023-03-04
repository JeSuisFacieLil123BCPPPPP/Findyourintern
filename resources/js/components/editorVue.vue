<template>
  <div class="w-100">
    <vue-editor
      v-model="description"
      ref="editor"
      placeholder="Décrivez votre projet/réalisation"
      useCustomImageHandler
      @image-added="handleImageAdded"
      @image-removed="handleImageRemoved"
      :editorToolbar="customToolbar"
      :editorOptions="editorSettings"
    />
  </div>
</template>
<script>
import { VueEditor, Quill } from "vue2-editor";
//import { ImageDrop } from "quill-image-drop-module";
//import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import ImageResize from "quill-image-resize-vue";
Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);
export default {
  name: "App",
  data() {
    return {
      data: null,
      editor: null,

      customToolbar: [
        [{ font: [] }],

        [{ header: [false, 1, 2, 3, 4, 5, 6] }],

        [{ size: ["small", false, "large", "huge"] }],

        ["bold", "italic", "underline", "strike"],

        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],

        [{ header: 1 }, { header: 2 }],

        ["blockquote", "code-block"],

        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],

        [{ script: "sub" }, { script: "super" }],

        [{ indent: "-1" }, { indent: "+1" }],

        [{ color: [] }, { background: [] }],

        ["link", "image", "formula"],

        [{ direction: "rtl" }],
        ["clean"],
      ],

      editorSettings: {
        modules: {
          imageDrop: true,
          imageResize: {},
        },
      },
    };
  },

  methods: {
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
          await this.formDataDeletedFile(index)
        )
        .then((res) => {
          console.log("nathe");
          console.log(res.data.result);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
    },
    async formDataDeletedFile(index) {
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
/* tile uploaded pictures */
.pointer {
  cursor: pointer;
}
/*.upload-list-inline :deep(.ant-upload-list-item) {
    float: left;
    width: 200px;
    margin-right: 8px;
  }
  .upload-list-inline [class*="-upload-list-rtl"] :deep(.ant-upload-list-item) {
    float: right;
  }
  .editor {
    margin-left: 0px !important;
    padding: 0px !important;
  }
  .cdx-settings-button {
    color: red;
    background: greenyellow;
  }*/
/*.ce-block__content,
  .ce-toolbar__content {
    max-width: unset;
    background: green !important;
  }*/
</style>
