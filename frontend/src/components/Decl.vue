<template>
<h2 class="text-danger">Recepice</h2>
<div class="details shadow-lg mb-5">
    <p>Date: {{ datas.date }}</p>
    <p>code du recepice: {{ datas.code_recepice }}</p>
    <p>numero de l'impot: {{ datas.num_impot }}</p>
    <p>périodicité: {{ datas.périodicité }}</p>
</div>
<table class="table">
  <tr class="tr">
    <th class="th">Nif</th>
    <th class="th">Nom </th>
    <th class="th">raison</th>
    <th class="th">adresse</th>
    <th class="th">chiffre d'affaire</th>
    <th class="th">montant</th>
    <th class="th">montVers</th>
    <th class="th">reste</th>
    <th class="th">payement</th>
    <th class="th">banque</th>
    <th class="th">bordereau</th>
  </tr>
  <tr class="tr">
    <td class="td">{{ datas.num_nif }}</td>
    <td class="td">{{ datas.nomCom }}</td>
    <td class="td">{{ datas.raisCom }}</td>
    <td class="td">{{ datas.adresse }}</td>
    <td class="td">{{ datas.chiffreAff }}</td>
    <td class="td">{{ datas.montPay }}</td>
    <td class="td">{{ datas.montVers }}</td>
    <td class="td">{{ datas.reste }}</td>
    <td class="td">{{ datas.modeP }}</td>
    <td class="td">{{ datas.banque }}</td>
    <td class="td">{{ datas.bordereau }}</td>
  </tr>
</table>
<button class="btn-impression" @click="impression">votre impression</button>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            id: this.$route.params.id,
            datas: {}
        }
    },
    methods: {
        async fetchDeclaration() {
            const { data } = await axios.get(`http://localhost:80/recette_fiscale/afficherSaisie/${this.id}`)
            this.datas = data[0];
        },
        impression() {
            window.print();
        }
    },
    mounted() {
        this.fetchDeclaration();
    }
}
</script>

<style>
.details {
    font-size: 12px;
    padding: 13px;
    border-radius: 7px;
}
table {
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
.btn-impression {
  padding: 8px;
  border-style: none;
  outline: none;
  background: crimson;
  color: #fff;
  border-radius: 5px;
  font-size: 12px;
}
</style>