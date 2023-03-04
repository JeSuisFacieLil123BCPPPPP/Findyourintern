<template>
  <a-result
    status="403"
    title="403"
    sub-title="Désolé, tu n'es pas autorisé(e) à accéder à cette page"
  >
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
