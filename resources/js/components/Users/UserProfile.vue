<template>
  <div>
    <a-button>
      <router-link :to="{ path: 'forgot-password' }">
        <span>Changer mon mot de passe</span>
      </router-link>
    </a-button>
    <v-card color="blue-grey darken-1" dark :loading="isUpdating">
      <template v-slot:progress>
        <v-progress-linear
          absolute
          color="green lighten-3"
          height="4"
          :indeterminate="isUpdating"
        ></v-progress-linear>
      </template>
      <v-row justify="center">
        <div class="clearfix">
          <a-upload
            :multiple="false"
            :remove="deleteAvatar"
            :customRequest="updateAvatar"
            list-type="picture"
            @preview="handlePreview"
            @change="handleChange"
          >
            <div v-if="fileList.length < 8">
              <a-icon type="plus" />
              <div class="ant-upload-text">Upload</div>
            </div>
          </a-upload>
          <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel">
            <img alt="example" style="width: 100%" :src="previewImage" />
          </a-modal>
        </div>
        <!--<v-row>
            <v-col class="text-right" cols="12">
              <v-menu bottom left transition="slide-y-transition">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn icon v-bind="attrs" v-on="on">
                    <v-icon>mdi-dots-vertical</v-icon>
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item @click="isUpdating = true">
                    <v-list-item-action>
                      <v-icon>mdi-cog</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>Update</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-menu>
            </v-col>
            <v-row class="pa-4" align="center" justify="center">
              <v-col class="text-center">
                <h3 class="text-h5">
                  {{ name }}
                </h3>
                <span class="grey--text text--lighten-1">{{ title }}</span>
              </v-col>
            </v-row>
          </v-row>-->
      </v-row>
      <v-form>
        <v-container>
          <img
            v-if="user.avatar != null"
            :src="user.avatar.variants['hight'].secure_url"
            :height="user.avatar.variants['hight'].height"
            :width="user.avatar.variants['hight'].width"
          />
          <v-icon dark v-else :size="200"> mdi-account-circle </v-icon>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="user.pseudo"
                :disabled="isUpdating"
                filled
                color="blue-grey lighten-2"
                label="Pseudo"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="user.email"
                :disabled="isUpdating"
                filled
                color="blue-grey lighten-2"
                label="Adresse email"
              ></v-text-field>
            </v-col>
          </v-row>
          <div v-if="user.user_type == 'student'">
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field
                  v-model="user.user.firstname"
                  :disabled="isUpdating"
                  filled
                  color="blue-grey lighten-2"
                  label="Prénoms"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  v-model="user.user.lastname"
                  :disabled="isUpdating"
                  filled
                  color="blue-grey lighten-2"
                  label="Nom"
                ></v-text-field>
              </v-col>
            </v-row>
          </div>
        </v-container>
      </v-form>
      <v-divider></v-divider>
      <v-card-actions>
        <!--<v-switch
          v-model="autoUpdate"
          :disabled="isUpdating"
          class="mt-0"
          color="green lighten-2"
          hide-details
          label="Auto Update"
        ></v-switch>-->
        <v-spacer></v-spacer>
        <v-btn
          :disabled="false"
          :loading="isUpdating"
          color="blue-grey darken-3"
          depressed
          @click="updateprofile()"
        >
          <v-icon left> mdi-update </v-icon>
          Update Now
        </v-btn>
      </v-card-actions>
    </v-card>
    <forgot-password></forgot-password>
  </div>
</template>
<script>
import _ from "lodash";
let sha1 = require("js-sha1");
import { mapGetters, mapMutations } from "vuex";
function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}
export default {
  data() {
    return {
      autoUpdate: true,
      isUpdating: false,
      user: {},
      title: "The summer breeze",
      showP: false,
      fileList: [],
      previewVisible: false,
      previewImage: "",
      cloudName: "ddt7qfshl",
      public_id: null,
      etat: 0,
      file: null,
    };
  },

  methods: {
    ...mapMutations(["auth/SET_USER"]),
    async updateAvatar({ onSuccess, onError, file, onProgress }) {
      const CLOUDINARY_UPLOAD_PRESET = "ml_default";
      const config = {
        headers: { "content-type": "multipart/form-data" },
        onUploadProgress: (event) => {
          console.log((event.loaded / event.total) * 100);
          this.etat = (event.loaded / event.total) * 100;
          onProgress({ percent: (event.loaded / event.total) * 100 }, file);
        },
      };
      let formData = new FormData();
      formData.append("upload_preset", "ml_default");
      formData.append("folder", "ressources/avatars");
      formData.append("file", file);
      await axios
        .post(
          "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/upload",
          formData,
          config
        )
        .then((res) => {
          onSuccess(true, file);
          //console.log("nathe");
          //console.log(res);
          this.public_id = res.data.public_id; //this.fileList.push(file);
          this.file = file;
          // console.log(this.fileList[0]);
        })
        .catch(({ response: { data } }) => {
          alert(data);
        })
        .finally(() => {});
      /* .then((res) => {
          //console.log(res);
          this.public_id = res.data.public_id; //this.fileList.push(file);
          // console.log(this.fileList[0]);
        })
        .catch(({ response: { data } }) => {
          alert(data);
        })
        .finally(() => {});*/
      /*await this.$refs.images.upload(
            "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/upload",
            this.uploadHeaders,
            this.imagesRecordsForUpload,*/
      //  this.formDataUpload(fileRecord, "ressources/images")
    },
    async formDataDeleted(public_id) {
      const timestamp = new Date().getTime();
      const api_key = "721474231639524";
      const string1 =
        "public_id=" +
        public_id +
        "&timestamp=" +
        timestamp +
        "tKW-g80_eRQbtSHSjwQHbfNzwDc";
      const signature = await sha1(string1);
      let formData = new FormData();
      formData.append("public_id", public_id);
      formData.append("signature", signature);
      formData.append("timestamp", timestamp);
      formData.append("api_key", api_key);
      return formData;
    },
    async deleteAvatar(file) {
      await axios
        .post(
          "https://api.cloudinary.com/v1_1/" + this.cloudName + "/image/destroy",
          await this.formDataDeleted(this.public_id)
        )
        .then((res) => {
          this.public_id = null;
          this.fileList = [];
          this.file = null;
          console.log("nathe");
          console.log(res.data.result);
        });
    },
    async updateprofile() {
      /*  const config = {
        headers: { "content-type": "multipart/form-data" },
        onUploadProgress: (event) => {
          console.log((event.loaded / event.total) * 100);
          this.etat2 = (event.loaded / event.total) * 100;
          onProgress({ percent: (event.loaded / event.total) * 100 }, file);
        },
      };*/
      let formData = new FormData();
      //  formData.append("avatar", this.file.name);
      // formData.append("avatarR", this.public_id);
      this.isUpdating = true; //
      console.log(this.user.user_type);
      console.log("this.user.user.id");
      console.log(this.user.user);
      await axios
        .put(
          // this.public_id != null
          //"/api/v1/users/edit/" + this.user.id + "/" + formData
          "/api/v1/users/edit/" + this.user.id,
          {
            user: this.user,
            public_id: this.public_id,
            filename: this.file != null ? this.file.name : null,
            user_type: this.user.user_type,
            user_id: this.user_type != "normal" ? this.user.user.id : null,
            userU: this.user_type != "normal" ? this.user.user : null,
            //company: this.user_type === "company" ? this.user.user : null,
          }
        )
        .then((res) => {
          //onSuccess(true, "joge");
          console.log("nathe");
          console.log(res);
          console.log(res.data.message);
          this.isUpdating = false;
          this.$store.commit("auth/SET_USER", res.data.user);
          // this.SET_USER(res.data.user);
          //console.log(res);
          // this.public_id = res.data.public_id; //this.fileList.push(file);
          // console.log(this.fileList[0]);
        })
        .catch(({ response: { data } }) => {
          console.log(data);
          this.isUpdating = false;
        })
        .finally(() => {
          this.isUpdating = false;
        });
    },

    handleCancel() {
      this.previewVisible = false;
    },
    async handlePreview(file) {
      if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
      }
      this.previewImage = file.url || file.preview;
      this.previewVisible = true;
    },
    handleChange(info) {
      // console.log("info");
      //console.log(info);
      const status = info.file.status;
      if (status !== "uploading") {
        console.log(info.file, info.fileList);
      }
      if (status === "done") {
        this.$message.success(`${info.file.name} file uploaded successfully.`);
      } else if (status === "error") {
        this.$message.error(`${info.file.name} file upload failed.`);
      }
    },
    async getUser() {
      await axios
        .get("/api/user")
        .then(({ data }) => {
          this.user = data.data;
          console.log(this.user);
        })
        .catch(({ response: { data } }) => {
          console.log("non !");
          console.log(response);
        });
    },
  },

  async beforeMount() {
    //const user = this.$store.state.user;
    //this.user = user;
    await this.getUser();
  },
  computed: {
    ...mapGetters({
      useractuel: "auth/getUser",
    }),
  },
};
</script>

<style>
.ant-upload-select-picture-card i {
  font-size: 32px;
  color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
  margin-top: 8px;
  color: #666;
}
</style>
