<template>
  <router-link :to="{ name: 'login' }"></router-link>
  <router-link :to="{ name: 'adminDashboard' }"></router-link>
  <router-view/>
</template>

<script>

export default {
  name: "app",
  components: {  }
}
</script>

<style>
</style>