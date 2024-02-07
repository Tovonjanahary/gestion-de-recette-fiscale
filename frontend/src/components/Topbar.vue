<template>
    <div class="topbar">
      <div class="logo">recette fiscale</div>
      <!-- <button class="deconnexion" ><a href="/">se deconnecter</a></button> -->
      <div class="profile">
        {{ userInfo.nom }}
        <button class="deconnexion" @click="logout">Deconnexion</button>
      </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  computed:{
    ...mapState(['userInfo'])
  },
  methods: {
    logout() {
      this.$store.commit('logout');
      this.$router.push("/");
    }
  }
}
</script>

<style>
.topbar {
  height: 50px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 12px 0 15px;
  position: sticky;
  top: 0;
  z-index: 999;
  background: white;

}
.logo {
    font-weight: 600;
    font-size: 30px;
}
.deconnexion {
  padding: 8px;
  border-style: none;
  outline: none;
  background: crimson;
  color: #fff;
  border-radius: 5px;
  font-size: 12px;
}
.deconnexion a{
  color: #fff;
}
</style>