<template>
  <div>
    <a-card>
      <a-row justify="flex-between" align="center" type="flex">
        <a-col :lg="{ offset: 0, span: 24, offset: 0 }" :xs="{ span: 24 }">
          <v-card>
            <v-img
              v-if="company.logo == null"
              src="https://picsum.photos/600/400"
              class="w-100"
              style="border-radius: 8px; margin-right: 10px; height: 300px"
            ></v-img>
            <v-img
              v-else
              :src="company.logo"
              class="w-100"
              style="border-radius: 8px; margin-right: 10px; height: 300px"
            ></v-img>
          </v-card>
          <v-card-title class="text-h6 text-black">
            {{ company.company_name }}</v-card-title
          >
          <div>
            {{ company.company_name }}
          </div>
          <div v-if="company.description.length != 0">
            <a-divider></a-divider>
            <div>
              <b-field>
                <template #label>
                  <span style="font-size: 20px"> Description de l'entreprise</span>
                </template>
              </b-field>
            </div>
            <description
              :content="company.description"
              style="max-width: 950px; line-height: 100px"
              class="overflow-auto"
            ></description>
          </div>
        </a-col>
      </a-row>
    </a-card>
  </div>
</template>
<script>
export default {
  props: ["company"],
};
</script>
<style scoped></style>
