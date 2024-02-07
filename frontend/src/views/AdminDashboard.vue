<template>
  <Topbar/>
  <div class="container1">
    <Sidebar/>
    <div class="other">
      <router-view/>
    </div>
  </div>
</template>

<script>
import Topbar from '../components/Topbar.vue';
import Sidebar from '../components/Sidebar.vue';

export default {
  data() {
    return {
      // userInfo: {}
    }
  },
  components: { Topbar, Sidebar },
  mounted() {
    // console.log(this.$store.state.userInfo);
    if(!this.$store.state.userInfo) {
      this.$router.push("/")
    }
  }
}
</script>

<style>
.container1 {
  display: flex;
  padding-top: 20px;
  height: calc(100vh - 50px);
}
.other {
  flex: 4;
  padding-left: 10px;
}
</style>