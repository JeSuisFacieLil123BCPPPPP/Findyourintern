<template>
  <div>
    <div></div>
    <div class="mt-3 m-2">
      <div class="d-flex justify-content-center flex-row">
        <div class="p-2">
          <vs-card actionable>
            <div slot="header">
              <vs-list-header
                v-html="realisation.title"
                style="font-size: 20px; color: black"
              ></vs-list-header>
            </div>
            <div slot="media" class="w-100" v-if="realisation.video != null">
              <div v-if="realisation.video != null && realisation.video.variants != null">
                <my-video
                  v-if="realisation.poster != null"
                  class="position-relative"
                  :sources="[
                    {
                      src: realisation.video.variants['hight'][0].secure_url,
                      type: 'video/mp4',
                    },
                    {
                      src: realisation.video.variants['hight'][1].secure_url,
                      type: 'video/webm',
                    },
                  ]"
                  :options="{
                    autoplay: false,
                    volume: 0.6,
                    poster: realisation.poster.variants['hight'].secure_url,
                    controls: true,
                  }"
                ></my-video>
                <my-video
                  v-else
                  class="position-relative"
                  :sources="[
                    {
                      src: realisation.video.variants['hight'][0].secure_url,
                      type: 'video/mp4',
                    },
                    {
                      src: realisation.video.variants['hight'][1].secure_url,
                      type: 'video/webm',
                    },
                  ]"
                  :options="{
                    autoplay: false,
                    volume: 0.6,
                    controls: true,
                  }"
                ></my-video>
              </div>
            </div>
            <div v-else>
              <description
                :content="realisation.description"
                style="max-width: 950px; line-height: 100px"
                class="overflow-auto"
              ></description>
            </div>
          </vs-card>
        </div>
      </div>
      <a-col>
        <a-row vs-w="12">
          <a-col vs-w="10"> </a-col>
          <a-col>
            <a-card class="">
              <div class="d-flex flex-row align-items-center">
                <div class="d-flex bd-highlight">
                  <div class="align-self-start">
                    <vs-avatar
                      size="large"
                      v-if="realisation.user.avatar != null"
                      :src="realisation.user.avatar.url"
                    />
                    <vs-avatar size="large" v-else></vs-avatar>
                  </div>
                  <div class="flex-grow-1 w-100">
                    <div class="">
                      <b-field type="is-medium">
                        <template #label>
                          <span style="font-size: 20px">{{
                            realisation.user.pseudo
                          }}</span>
                        </template>
                      </b-field>
                    </div>
                    <div class="">
                      <b-field type="is-medium">
                        <template #label>
                          {{
                            realisation.user.user.firstname +
                            " " +
                            realisation.user.user.lastname
                          }}
                        </template>
                      </b-field>
                    </div>
                  </div>
                </div>
                <div class="ms-3">
                  {{ realisation.nbrVue }}
                  <like
                    :back="true"
                    :likeTrue="proplike(realisation)"
                    :dislikeTrue="propdislike(realisation)"
                    :nbrLikes="realisation.nbrLikes"
                    :nbrdisLikes="realisation.nbrdisLikes"
                    @like-click="like"
                    @dislike-click="dislike"
                    @unlike-click="unlike"
                    @undislike-click="undislike"
                    taille="medium"
                  >
                  </like>
                </div>
              </div>
              <a-divider type="vertical"></a-divider>
              <div class="d-flex flex-row justify-content-start align-items-center">
                <span class="me-3">{{ moment(realisation.created_at).fromNow() }}</span>
                <b-button
                  v-if="realisation.documents.length != 0"
                  outlined
                  rounded
                  type="is-bleue"
                  class="mt-2 ms-3"
                  @click="docV = !docV"
                  ><v-icon>mdi-link</v-icon></b-button
                >
              </div>
              <div v-if="docV == true">
                <v-list-item :key="item.id" v-for="item in realisation.documents">
                  <v-list-item-content>
                    <a
                      slot="title"
                      :href="item.secure_url"
                      style="color: #42a5f5; text-decoration: underline"
                      >{{ item.name_file + "." + item.format }}</a
                    >
                  </v-list-item-content>
                </v-list-item>
                <a-divider />
              </div>
              <div class="">
                <v-chip
                  class="me-2"
                  style="color: white"
                  v-for="item in realisation.tags"
                  :key="item.id"
                >
                  <span style="color: black"> {{ item.name }}</span>
                </v-chip>
              </div>
              <a-divider />
              <div v-if="realisation.video != null">
                <b-button type="is-bleue" outlined rounded @click="desc = !desc"
                  ><span v-if="desc == false">Détails</span
                  ><span v-else>Cacher les détails</span></b-button
                >
                <div v-if="desc == true">
                  <description
                    :content="realisation.description"
                    style="max-width: 950px; line-height: 100px"
                    class="overflow-auto"
                  ></description>
                </div>
              </div>
            </a-card>
          </a-col>
          <a-col>
            <a-row type="flex" :gutter="[16, 16]">
              <a-col :md="{ span: 12, order: 1 }">
                <comments
                  class="m-3 element1"
                  style="box-sizing: border-box"
                  :realisationId="realisationId"
                  :nbrComments="realisation.nbrComments"
                ></comments>
              </a-col>
              <a-col :md="{ span: 12, order: 2 }">
                <a-card
                  class="m-3 element1"
                  :loading="loading1"
                  v-if="realisationForUser.length != 0"
                >
                  <template slot="title">
                    <b-field>
                      <template #label>
                        <span class="font-weight-black text-h6">Du meme auteur</span>
                      </template>
                    </b-field>
                  </template>
                  <a-card v-for="(item, index) in realisationForUser" :key="index">
                    <div class="d-flex" v-if="item.user.id != user.id">
                      <div class="d-flex">
                        <img
                          class=""
                          style="position: static"
                          v-if="item.poster != null"
                          :src="item.poster.variants['small'].secure_url"
                        />
                        <img
                          style="position: static"
                          v-else
                          :src="'https://res.cloudinary.com//ddt7qfshl//image//upload//h_125,w_200//v1665848191//ressources//images//img3_rkj3ly.jpg'"
                        />
                        <div class="flex-grow-1 ms-2 mon-texte">
                          <div
                            class="mon-texte text-capitalize fw-bold text-h6"
                            style="font-width: 25px"
                          >
                            {{ item.title }}
                          </div>
                          <div style="font-width: 25px"></div>
                        </div>
                      </div>
                    </div>
                  </a-card>
                </a-card>
                <a-card
                  class="mb-2"
                  v-if="realisationbyTags.length != 0"
                  :loading="loading2"
                >
                  <template slot="title">
                    <b-field>
                      <template #label>
                        <span class="font-weight-black text-h6"
                          >Intéressant pour vous
                        </span>
                      </template>
                    </b-field>
                  </template>
                  <a-card v-for="(item, index) in realisationbyTags" :key="index">
                    <div class="d-flex" v-if="item.user.id != user.id">
                      <div class="d-flex">
                        <img
                          class=""
                          style="position: static"
                          v-if="item.poster != null"
                          :src="item.poster.variants['small'].secure_url"
                        />
                        <img
                          style="position: static"
                          v-else
                          :src="'https://res.cloudinary.com//ddt7qfshl//image//upload//h_125,w_200//v1665848191//ressources//images//img3_rkj3ly.jpg'"
                        />
                        <div
                          class="flex-grow-1 ms-2 mon-texte mon-texte text-capitalize text-center"
                        >
                          <b-field>
                            <template #label>
                              <span class=""> {{ item.title }}</span>
                            </template>
                          </b-field>
                        </div>
                      </div>
                    </div>
                  </a-card>
                </a-card>
              </a-col>
            </a-row>
          </a-col>
        </a-row>
      </a-col>
    </div>
  </div>
</template>
<script>
const shortNum = require("number-shortener");
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
//import { ImageDrop } from "quill-image-drop-module";
let sha1 = require("js-sha1");
//import ImageResize from "quill-image-resize-vue";
export default {
  // props: ["realisationId"],
  props: {
    realisationId: {
      type: [Number, String],
      required: false,
      default: null,
    },
  },
  data() {
    return {
      docV: false,
      desc: false,
      moment,
      nbrlikes: 0,
      nbrdislikes: 0,
      actions: null,
      realisation: {},
      realisationUser: {},
      show: false,
      model: 0,
      realisationForUser: [],
      realisationbyTags: [],
      hover: "",
      content:
        '<p class="ql-align-justify"><img src="https://res.cloudinary.com/ddt7qfshl/image/upload/v1666810039/ressources/images/Capture_okoo6h.png" style="display: inline; margin: 0px 1em 1em 0px; float: left;" width="215"><strong>Travaillez, prenez de la peine&nbsp;:</strong></p><p class="ql-align-justify"><strong>C’est le fonds qui manque le moin</strong>s.</p><p> Un riche Laboureur, sentant sa mort prochaine,</p><p class="ql-indent-1"> Fit venir ses enfants, leur parla sans témoins.</p><ul><li class="ql-indent-4"> Gardez-vous, leur dit-il, de vendre l’héritage</li><li class="ql-indent-4"> Que nous ont laissé nos parents.</li><li class="ql-indent-4"> Un trésor est caché dedans.</li></ul><p> Je ne sais pas l’endroit&nbsp;; mais un peu de courage</p><p> Vous le fera trouver, vous en viendrez à bout.</p><p> Remuez votre champ dès qu’on aura fait l’Oût.</p><p> Creusez, fouiller, bêchez&nbsp;; ne laissez nulle place</p><p> Où la main ne passe et repasse.</p>',
      /* hovers: [
        { text: "Default", value: "default" },
        { text: "Blur", value: "blur" },
        { text: "Zoom", value: "zoom" },
        { text: "Dark", value: "dark" },
        { text: "Scale", value: "scale" },
        { text: "Curtain", value: "curtain" },
      ],*/
      // editor: null,
      loading1: false,
      loading2: false,
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
  },
  methods: {
    realisationIndex(realisation) {
      return realisation.reaction.findIndex((element) => (element.id = this.user.id));
    },
    proplike(realisation) {
      if (realisation.reaction.length == 0) {
        return false;
      } else {
        const index = this.realisationIndex(realisation);
        if (index != -1) {
          return Boolean(realisation.reaction[index].pivot.like);
        } else return false;
      }
    },
    propdislike(realisation) {
      if (realisation.reaction.length == 0) {
        return false;
      } else {
        const index = this.realisationIndex(realisation);
        if (index != -1) {
          return Boolean(realisation.reaction[index].pivot.dislike);
        } else return false;
      }
    },
    nbrVue(nbr) {
      return shortNum(nbr);
    },
    async getRealisationbyId() {
      await axios
        .get("/api/v1/realisations/" + this.realisationId)
        .then((response) => {
          this.realisation = response.data.data;
          console.log(this.realisation.user);
          console.log(this.realisation.video);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    publish_at(date) {
      let dat = new Date(date);
      return "Publié le " + dat.toLocaleDateString("fr");
    },
    async like() {
      await axios
        .post(
          "/api/v1/realisation/" + this.realisationId + "/user/" + this.user.id + "/like"
        )
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async dislike() {
      await axios
        .post(
          "/api/v1/realisation/" +
            this.realisationId +
            "/user/" +
            this.user.id +
            "/dislike"
        )
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async unlike() {
      await axios
        .post(
          "/api/v1/realisation/" +
            this.realisationId +
            "/user/" +
            this.user.id +
            "/unlike"
        )
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async undislike() {
      await axios
        .post(
          "/api/v1/realisation/" +
            this.realisationId +
            "/user/" +
            this.user.id +
            "/undislike"
        )
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    }, //realisationForSubcategory
    async getRealisationsByUser() {
      this.loading1 = true;
      await axios
        .get("/api/v1/realisations/getRealisationsByUser/" + this.realisation.user.id)
        .then((response) => {
          // console.log(response);
          console.log("logtyu");
          this.realisationForUser = response.data.data;
          console.log(this.realisationForUser);
          console.log(this.realisationForUser);
          this.loading1 = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading1 = false;
        });
    },
    async getRealisationsByTagFirsts() {
      this.loading2 = true;
      await axios
        .get("/api/v1/realisations/getRealisationsByTagFirsts/" + this.realisation.id)
        .then((response) => {
          console.log(response);
          this.realisationbyTags = response.data.data;
          console.log(this.realisationbyTags.length);
          this.loading2 = false;
          // console.log(this.realisationForSubcategory);
        })
        .catch((error) => {
          console.log(error);
          this.loading2 = false;
        });
    },
    ///realisations/getAllRealisationsValideSearch/
  },
  async mounted() {
    await this.getRealisationbyId();
    await this.getRealisationsByUser();
    await this.getRealisationsByTagFirsts();
    //console.log("description");
    //console.log(this.realisation.description);
  },
};
</script>
<style lang="scss" scoped>
.desc1 :deep(img) {
  height: 15px;
  width: 15px;
}
.desc1 :deep(p) {
  line-height: 15px;
}
@media screen and (min-width: 800px) {
  .element1 {
    max-width: 750px;
  }
  .element2 {
    // max-width: 750px;
  }
}
@media screen and (max-width: 800px) {
  .element1 {
    max-width: 100%;
  }
  .element2 {
    max-width: 100%;
  }
}
/*.desc {
  width: 850px;
  &:hover {
    cursor: normal;
  }
  img {
    &:hover {
      width: 100px !important;
      height: 200px !important;
    }
  }
}*/
/*.is-active .al img {
  border: 1px solid #fff;
  filter: grayscale(0%);
}
.al img {
  border: 1px solid transparent;
  filter: grayscale(100%);
}
ant-carousel :deep(.slick-slide) {
  text-align: center;
  height: 160px;
  line-height: 160px;
  background: #364d79;
  overflow: hidden;
}*/
/*.desc {
  font-size: 16px;
  color: green;
}
p img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}*/
</style>

<!--<style lang="scss" scoped>
.is-active .al img {
  border: 1px solid #fff;
  filter: grayscale(0%);
}
.al img {
  border: 1px solid transparent;
  filter: grayscale(100%);
}
ant-carousel :deep(.slick-slide) {
  text-align: center;
  height: 160px;
  line-height: 160px;
  background: #364d79;
  overflow: hidden;
}

/*.ant-carousel :deep(.slick-slide h3) {
  color: green;
}
.vs-img {
  position: static !important;
}*/
/*.description > {
  img {
    list-style-type: none;
}
}*/

.description > p {
  color: red;
  // … etc.
}
.description {
  &:hover {
    color: red;
  }
  p {
    &:hover {
      color: red;
    }
    img {
      display: none;
      &:hover {
        background: black;
        color: black;
      }
    }
  }
}

/*.description {
  font-size: 15px;
  height: 100px;
  widows: 100px;
  /* p {
    font-family: "Arial";
    font-size: 16px;
    font-weight: bolder;
  }*/
/* p {
    img {
      width: 50% !important;
      height: 50% !important;
    }
  }
  img {
    width: 50% !important;
    height: 50% !important;
  }*/
//}
</style>-->
