<template>
  <div class="sidebar">
      <h3 class="adminTitle">administration</h3>
      <ul class="navigation">
          <li> 
              <router-link to="/adminDashboard">
                accueil
              </router-link>            
          </li>
          <li>
              <router-link to="/adminDashboard/impot">
                impot
              </router-link>
          </li>
          <li>
              <router-link to="/adminDashboard/nif">
                nif stat
              </router-link>
          </li>
          <li>
              <router-link to="/adminDashboard/declaration">
                declaration
              </router-link>
          </li>
          <li>
              <router-link to="/adminDashboard/utilisateur">
                utilisateur
              </router-link>
          </li>
      </ul>
  </div>
</template>

<script>
export default {

}
</script>

<style>
.sidebar {
    flex: 1;
    padding: 10px;
}
.navigation {
    display: flex;
    flex-direction: column;
    /* justify-content: center; */
}
li {
    margin-top: 12px;
    padding-top: 15px;
    list-style: none;
    font-size: 17px;
    margin-left: 12px;
    cursor: pointer;
}
.adminTitle {
    background: #777;
    color: #fff;
    border-radius: 5px;
    padding: 5px;
    font-size: 24px;
}
a {
  text-decoration: none;
  color: #222;
}
a:hover {
  color: #222;
}
.router-link-exact-active {
  background: rgb(124, 123, 123);
  padding: 7px;
  border-radius: 5px;
  color: #fff;
  width: 1;
}
</style>