<template>
  <div>
    <div class="d-flex bd-highlight">
      <div class="align-self-start">
        <!--<vs-avatar size="large" v-if="img != null" :src="img" />-->
        <vs-avatar
          size="large"
          :src="'https://shop.cellublue.com/media/cpci/832x1040/cba2f3a9ce6599b1806096e984b653a2/0/1/01challengeantivergetures_6.webp'"
        />
      </div>
      <div class="flex-grow-1 w-100">
        <div class="">
          <b-field type="is-medium">
            <template #label>
              <span style="font-size: 20px">{{ title }}</span>
            </template>
          </b-field>
        </div>
        <div class="">
          <b-field type="is-medium">
            <template #label>
              {{ text }}
            </template>
          </b-field>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["img", "title", "text"],
};
</script>
