<template>
  <h3 class="nif-title">ajouter un nif</h3>
  <form action="" class="shadow-lg" @submit.prevent="handleSubmit">
    <div class="alert alert-danger" v-if="error">{{ error }}</div>
    <div class="nif-form">
      <section class="section1">
        <div class="form-group">
          <label for="activite">activite</label>
          <input
            type="text"
            name="activite"
            v-model="activite"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="adresse">adresse</label>
          <input
            type="text"
            name="adresse"
            v-model="adresse"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="capital">capital</label>
          <input
            type="number"
            name="capital"
            v-model="capital"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="nbrSal">nbrSal</label>
          <input
            type="number"
            name="nbrSal"
            v-model="nbrSal"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="nomCom">nomCom</label>
          <input
            type="text"
            name="nomCom"
            v-model="nomCom"
            class="form-control"
          />
        </div>
      </section>
      <section class="section2">
        <div class="form-group">
          <label for="raisCom">raisCom</label>
          <input
            type="text"
            name="raisCom"
            v-model="raisCom"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="telephone">telephone</label>
          <input
            type="number"
            name="telephone"
            v-model="telephone"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="dateExer">dateExer</label>
          <input
            type="date"
            name="dateExer"
            v-model="dateExer"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="debutExer">debutExer</label>
          <input
            type="date"
            name="debutExer"
            v-model="debutExer"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="finExer">finExer</label>
          <input
            type="date"
            name="finExer"
            v-model="finExer"
            class="form-control"
          />
        </div>
        <button type="submit" class="ajouter-nif mt-4">ajouter</button>
      </section>
    </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      activite: "",
      adresse: "",
      capital: "",
      nbrSal: "",
      nomCom: "",
      raisCom: "",
      telephone: "",
      dateExer: "",
      debutExer: "",
      finExer: "",
      error: "",
    };
  },
  methods: {
    async handleSubmit(e) {
      e.preventDefault();
      const { data } = await axios.post(
        "http://localhost:80/recette_fiscale/ajouterNif",
        {
          activite: this.activite,
          adresse: this.adresse,
          capital: this.capital,
          nbrSal: this.nbrSal,
          nomCom: this.nomCom,
          raisCom: this.raisCom,
          telephone: this.telephone,
          dateExer: this.dateExer,
          debutExer: this.debutExer,
          finExer: this.finExer,
        }
      );
      // console.log(data);
      if (data.message.error) {
        this.error = data.message.error;
      }
    },
  },
};
</script>

<style>
.nif-form {
  width: 100%;
  display: flex;
  padding: 20px;
  justify-content: center;
  font-size: 12px;
}
.section1 {
  /* width: 50%; */
}
.section2 {
  margin-left: 20px;
  /* width: 50%; */
}
.ajouter-nif {
  padding: 8px;
  border-style: none;
  outline: none;
  background: crimson;
  color: #fff;
  border-radius: 5px;
}
</style>