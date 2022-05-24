<template>
  <h3 class="nif-title">Liste des nif</h3>
  <section v-if="datas.length">
    <table class="table">
      <thead>
        <tr class="tr">
          <th class="th">numero</th>
          <th class="th">activite</th>
          <th class="th">adresse</th>
          <th class="th">capital</th>
          <th class="th">nombre de salarier</th>
          <th class="th">nom commerciale</th>
          <th class="th">raison commerciale</th>
          <th class="th">telephone</th>
          <th class="th">date d'exercice</th>
          <th class="th">debut d'exercice</th>
          <th class="th">fin d'exercice</th>
          <th class="th">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="data in datas" :key="data.num_nif" class="tr">
          <td class="td">{{ data.num_nif }}</td>
          <td class="td">{{ data.activite }}</td>
          <td class="td">{{ data.adresse }}</td>
          <td class="td">{{ data.capital }}</td>
          <td class="td">{{ data.nbrSal }}</td>
          <td class="td">{{ data.nomCom }}</td>
          <td class="td">{{ data.raisCom }}</td>
          <td class="td">{{ data.telephone }}</td>
          <td class="td">{{ data.dateExer }}</td>
          <td class="td">{{ data.debutExer }}</td>
          <td class="td">{{ data.finExer }}</td>
          <td class="td">
            <div class="action">
              <button class="supprimer" @click="supprimer(data.num_nif)">supprimer</button>
              <button class="modifier">modifier</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
  <div class="loading" v-else>loading...</div>
  <AjouterNif/>
</template>

<script>
import axios from 'axios';
import AjouterNif from './AjouterNif.vue';
export default {
  data() {
    return {
      datas: [],
    }
  },
  mounted() {
    this.fetch();
  },
  methods: {
    async fetch() {
      const { data } = await axios.get("http://localhost:80/recette_fiscale/nif");
      this.datas = data;
      this.num_niff = data.num_nif;
    },
    async supprimer(id) {
      const { data } = await axios.delete(`http://localhost:80/recette_fiscale/supprimerNif/${id}`);
      console.log(data);
      this.fetch();
    }
  },
  components: { AjouterNif }
}
</script>

<style>
.nif-title {
  color: crimson;
  font-size: 24px;
}
.table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

.td, .th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.tr:nth-child(even) {
  background-color: #dddddd;
}
.supprimer {
  padding: 8px;
  border-style: none;
  outline: none;
  border: 1px solid crimson;
  background: #fff;
  border-radius: 5px;
  font-size: 12px;
  color: #000;
  margin-right: 3px;
}
.action {
  display: flex;
}
.modifier {
  padding: 5px;
  border-style: none;
  outline: none;
  background: crimson;
  border-radius: 5px;
  font-size: 12px;
  color: #fff;
}
</style>