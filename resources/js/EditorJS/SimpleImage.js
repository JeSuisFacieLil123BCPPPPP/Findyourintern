import ImageTool from "@editorjs/image";
 class SimpleImage extends ImageTool {
    onUpload(response) {
      if (response.success && response.file) {
        this.image = response.file;
      } else {
        this.uploadingFailed("incorrect response: " + JSON.stringify(response));
      }
    }
    uploadingFailed(errorText) {
      console.log(this.api);
      console.log("Image Tool: uploading failed because of", errorText);
  
      console.log(this.api);
      this.ui.hidePreloader();
      this.api.notifier.show({
        message: this.api.i18n.t("Couldn’t upload image. Please try another."),
        style: "error",
        class: "position-absolute zindex-tooltip",
      });
    }
    async destroy(id) {
      console.log("seyd");
      console.log(id);
      console.log(this.data);
      await axios
        .post(
          "https://api.cloudinary.com/v1_1/ddt7qfshl/image/destroy",
          await this.formDataDeleted(this.data.file.public_id)
        )
        .then((res) => {
          console.log("nathe");
          console.log(res.data.result);
        })
        .catch(({ response: { data } }) => {
          console.log(data.message);
        });
      // this.destroy();
      console.log(Vuesax.Vue);
      /*Vuesax.notify({
        title: 'title',
        text: 'string',
        color: 'primary'
      });*/
    }
    async formDataDeleted() {
      const timestamp = new Date().getTime();
      const api_key = "721474231639524";
      const string1 =
        "public_id=" +
        this.data.file.public_id +
        "&timestamp=" +
        timestamp +
        "tKW-g80_eRQbtSHSjwQHbfNzwDc";
      const signature = await sha1(string1);
      let formData = new FormData();
      formData.append("public_id", this.data.file.public_id);
      formData.append("signature", signature);
      formData.append("timestamp", timestamp);
      formData.append("api_key", api_key);
      return formData;
    }
  }
  module.exports.SimpleImage=SimpleImage