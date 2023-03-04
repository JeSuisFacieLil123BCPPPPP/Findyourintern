<template>
  <div>
    <div>
      <div style="">
        <div style="background: #ffffff" class="p-3 d-flex flex-row align-items-center">
          <a-row class="w-100">
            <a-col
              :xs="{ offset: 1, span: 22, offset: 1 }"
              :lg="{ offset: 1, span: 10, offset: 1 }"
            >
              <b-field label="Métier, domaine ou filière" class="">
                <b-input name="name" placeholder="" expanded></b-input>
              </b-field>
            </a-col>
            <a-col
              :xs="{ offset: 1, span: 22, offset: 1 }"
              :lg="{ offset: 1, span: 10, offset: 1 }"
            >
              <b-field label="Location" class="">
                <b-input name="name" placeholder="location" expanded></b-input>
              </b-field>
            </a-col>
            <a-col
              :xs="{ offset: 1, span: 22, offset: 1 }"
              :lg="{ offset: 1, span: 10, offset: 1 }"
            >
              <b-field label="Compétences" class="">
                <b-input name="name" placeholder="location" expanded></b-input>
              </b-field>
            </a-col>
          </a-row>
        </div>
        <div class="m-3">
          <a-row>
            <a-col :xs="{ span: 24 }" :lg="{ offset: 2, span: 20, offset: 2 }">
              <a-row type="flex" :gutter="[20, 20]" justify="flex-between" align="middle">
                <a-col v-for="std in students" :key="std.id">
                  <router-link
                    :to="{
                      path: 'recherche/student/profile/' + std.user_id,
                    }"
                  >
                    <v-sheet elevation="2" rounded="lg" class="my-1" style="width: 300px">
                      <div class="d-flex flex-column bd-highlight">
                        <div class="p-4 bd-highlight">
                          <span
                            style="color: #0f151a; font-weight: normal; font-size: 20px"
                            class="label"
                          >
                            {{ std.firstname + " " + std.lastname }}
                          </span>
                          <span
                            style="
                              color: #0f151a;
                              font-weight: normal;
                              font-size: 16px;
                              font-style: italic;
                            "
                            class="label"
                          >
                            <v-icon v-text="'mdi-email'"></v-icon>

                            <a :href="`mailto:${std.email}`" class="text-black">
                              {{ std.email }}
                            </a>
                          </span>
                        </div>
                        <div class="text-right">
                          <b-button class="m-1" type="is-success is-light" outlined
                            >Voir les détails</b-button
                          >
                        </div>
                      </div>
                    </v-sheet>
                    <!--<a-card hoverable style="width: 250px" class="">
                      <vs-avatar
                        size="70px"
                        style="font-size: 30px; font-weight: bold"
                        color="#24855a"
                        :text="std.firstname + ' ' + std.lastname"
                      />
                      !--<img
                        v-if="std.avatar"
                        slot="cover"
                        alt="example"
                        :src="std.avatar"
                      />
                      <img
                        v-else
                        slot="cover"
                        alt="example"
                        src=""
                      />--
                      <template slot="actions" class="ant-card-actions"> </template>
                      <a-card-meta :title="std.firstname" :description="std.lastname">
                        <vs-avatar
                          size="70px"
                          style="font-size: 30px; font-weight: bold"
                          color="#24855a"
                          :text="std.firstname + ' ' + std.lastname"
                        />
                      </a-card-meta>
                    </a-card>-->
                  </router-link>
                </a-col>
              </a-row>
            </a-col>
          </a-row>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import noData1 from "../Icons/no-data-1.vue";
const queryData = (params) => {
  return axios.get("/api/v1/students/", {
    params: params,
  });
};
export default {
  components: { noData1 },
  data() {
    return {
      students: [],
    };
  },
  methods: {
    async getStudentsProfiles() {
      await axios
        .get("/api/v1/students/")
        .then((response) => {
          console.log("response");
          console.log(response.data);
          this.students = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
  },
  async beforeMount() {
    await this.getStudentsProfiles();
  },
};
</script>
<style scoped></style>
