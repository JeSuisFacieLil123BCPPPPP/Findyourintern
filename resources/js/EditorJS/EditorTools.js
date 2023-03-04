import EditorJS from "@editorjs/editorjs";
const Header = require("@editorjs/header");
import ImageTool from "@editorjs/image";
const LinkTool = require("@editorjs/link");
const RawTool = require("@editorjs/raw");
const Quote = require("@editorjs/quote");
import TextVariantTune from "@editorjs/text-variant-tune";
//import Embed from "@editorjs/embed";
//const SimpleImage = require("@editorjs/simple-image");
import Warning from "@editorjs/warning";
import List from "@editorjs/list";
import Checklist from "@editorjs/checklist";
import AttachesTool from "@editorjs/attaches";
//const emoji = require('@groupher/editor-emoji');
import Tooltip from "editorjs-tooltip";
const Paragraph = require("@editorjs/paragraph");
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
      console.log(Vuesax.Vue);
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

export const EDITOR_JS_TOOLS = {
    paragraph: {
      class: Paragraph,
      inlineToolbar: true,
      toolbox: {
        title: "Texte",
        icon: '<span class="material-icons">text_fields</span>',
      },
    },
    textVariant: TextVariantTune,
    tooltip: {
      class: Tooltip,
      config: {
        location: "left",
        highlightColor: "#FFEFD5",
        underline: true,
        backgroundColor: "green",
        textColor: "#FDFEFE",
        holder: "editorId",
      },
    },
    header: {
      class: Header,
      inlineToolbar: true,
      config: {
        placeholder: "Veuillez entrer votre entete",
        levels: [2, 3, 4],
        defaultLevel: 2,
      },
      toolbox: {
        title: "Entête",
        icon: '<span class="material-icons">title</span>',
      },
    },
    //defaultBlock: "text",
    //image: SimpleImage,
    image: {
      class: SimpleImage,
      toolbox: {
        title: "Image",
        icon: '<span class="material-icons">image</span>',
      },
      config: {
        actions: [],
        buttonContent:
          // '<div class="file is-large is-boxed has-name"><label class="file-label"><input class="file-input" type="file" name="resume"><span class="file-cta"><span class="file-icon"> <i class="fas fa-upload"></i></span><span class="file-label">Large file…</span></span><span class="file-name">Screen Shot 2017-07-29 at 15.54.25.png</span></label></div>',
          //  '<div class="field"> <label class="label is-medium">Medium input</label><div class="control has-icons-left has-icons-right"> <input class="input is-medium" type="email" placeholder="Extra small"><span class="icon is-small is-left"><i class="fas fa-envelope fa-xs"></i> </span><span class="icon is-small is-right"><i class="fas fa-check fa-xs"></i></span></div></div>',
          '<div class="w-100 h-100" style="border-style: dashed;border-color:#BDBDBD;border-width: 2px;"><button class="bttn-bordered.bttn-lg" style="height:250px;width:250px;background:#F8F8F8;margin:3px;"><div class="d-flex flex-column justify-content-center align-items-center"><span class="material-icons" style="font-size:100px;color:#BDBDBD;">cloud_upload</span><span>Choisissez votre image</span></div></button></div>',
        uploader: {
          async uploadByFile(file) {
            // your own uploading logic here
            const CLOUDINARY_UPLOAD_PRESET = "ml_default";
            let formData = new FormData();
            formData.append("upload_preset", CLOUDINARY_UPLOAD_PRESET);
            formData.append("folder", "ressources/images");
            formData.append("file", file);
            console.log("sass");
            console.log(file);
            return await axios
              .post(
                "https://api.cloudinary.com/v1_1/ddt7qfshl/image/upload",
                formData
              )
              .then((response) => {
                console.log(response);
                return {
                  success: true,
                  file: {
                    url: response.data.url,
                    public_id: response.data.public_id,
                  },
                };
              })
              .catch(({ response: { data } }) => {
                console.log(data);

                return data.error.message;
              });
          },
        },
      },
    },
    linkTool: {
      class: LinkTool,
      config: {
        endpoint: "http://localhost:8008/fetchUrl", // Your backend endpoint for url data fetching,
      },
      toolbox: {
        title: "Lien",
        icon: '<span class="material-icons">link</span>',
      },
    },
    raw: {
      class: RawTool,
      toolbox: {
        title: "Code HTML",
        icon: "<span class='material-icons'>code</span>",
      },
    },
    quote: {
      class: Quote,
      inlineToolbar: true,
      shortcut: "CMD+SHIFT+O",
      config: {
        quotePlaceholder: "Entrez la citation de l'auteur",
        captionPlaceholder: "Auteur de la citation",
      },
      toolbox: {
        title: "Citation",
        icon: '<span class="material-icons">format_quote</span>',
      },
    },
    embed: {
      class: Embed,
      config: {
        services: {
          youtube: true,
          coub: true,
          codepen: {
            regex: /https?:\/\/codepen.io\/([^\/\?\&]*)\/pen\/([^\/\?\&]*)/,
            embedUrl:
              "https://codepen.io/<%= remote_id %>?height=300&theme-id=0&default-tab=css,result&embed-version=2",
            html:
              "<iframe height='300' scrolling='no' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%;'></iframe>",
            height: 300,
            width: 600,
            id: (groups) => groups.join("/embed/"),
          },
        },
      },
    },
    checklist: {
      class: Checklist,
      inlineToolbar: true,
      toolbox: {
        title: "Checklist",
        icon: '<span class="material-icons">checklist</span>',
      },
    },
    list: {
      class: List,
      inlineToolbar: true,
      config: {
        defaultStyle: "unordered",
      },
      toolbox: {
        title: "Liste",
        icon: '<span class="material-icons">format_list_bulleted</span>',
      },
    }
};