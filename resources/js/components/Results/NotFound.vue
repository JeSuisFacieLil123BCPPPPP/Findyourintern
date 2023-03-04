<template>
  <a-result status="404" title="404" sub-title="Désolé,cette page n'existe pas">
    <template #extra>
      <router-link :to="{ path: '/realisationsStudents' }">
        <a-button type="primary"> Retourner à l'accueil </a-button>
      </router-link>
    </template>
  </a-result>
</template>
<script>
export default {
  data() {
    return {};
  },
};
</script>
