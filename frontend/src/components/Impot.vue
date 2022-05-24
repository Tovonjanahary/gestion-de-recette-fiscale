<template>
  <h3 class="titre mt-5">Liste des impots</h3>
  <section class="impots mt-3">
    <div class="impot shadow-lg" v-for="data in datas" :key="data.num_impot">
      <div class="data">
        <h5><span class="desc">code recepice: </span> {{ data.code_recepice }}</h5>
        <p><span class="desc">numero de l'impot: </span>{{ data.num_impot }}</p>
        <p><span class="desc">périodicité: </span>{{ data.périodicité }}</p>
        <p><span class="desc">nom: </span>{{ data.nom_impot }}</p>
        <p><span class="desc">nom du budget: </span>{{ data.nom_budget }}</p>
      </div>
    </div>
  </section>
  
</template>

<script>
export default {
  data() {
    return {
      datas: []
    }
  },
    computed: {
    },
    mounted() {
        fetch('http://localhost:80/recette_fiscale/afficherImpot')
        .then(res => res.json())
        .then((data => this.datas = data))
    },
}
</script>

<style>
.titre {
  margin-left: 40px;
  color: crimson;
  font-size: 23px;
}
.impots {
  display: flex;
  margin-left: 40px;
}
.impot:not(:first-child) {
  margin-left: 35px;
}
.impot {
  padding: 12px;
  border-radius: 7px;
}
.desc {
  font-weight: 600;
}
.data p {
  font-size: 12px;
}
</style>