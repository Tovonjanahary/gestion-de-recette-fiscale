<template>
  <h2 class="decl-title">Declaration</h2>
  <div class="alert alert-danger" v-if="error">{{ error }}</div>
  <form action="" @submit.prevent="saisie" class="declaration row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="date">date:</label>
        <input type="date" name="date" v-model="date" class="form-control" />
      </div>
      <div class="form-group">
        <label for="num_impot">numero de I:</label>
        <select
          name="num_impot"
          id="num_impot"
          v-model="num_impot"
          @keypress.enter="fetchImpot"
          class="form-control"
        >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <div class="description mt-3 shadow-sm">
          <div class="">
            <p>code de recepice: <span class="attribut">{{ impot.code_recepice }}</span></p>
            <p>périodicité: <span class="attribut">{{ impot.périodicité }}</span></p>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="num_nif">numero de nif</label>
        <input
          type="number"
          name="num_nif"
          v-model="num_nif"
          class="form-control"
        />
      </div>        
      <div class="error" v-if="nifError" >{{ nifError }}</div>
      <div class="description mt-3 shadow-sm">
        <div class="">
          <p>nom commerciale: <span class="attribut">{{ nif.nomCom }}</span></p>
          <p>raison commerciale: <span class="attribut">{{ nif.raisCom }}</span></p>
          <p>lieu de travail: <span class="attribut">{{ nif.adresse }}</span></p>
        </div>
      </div>
      <div class="form-group">
        <label for="chiffreAff">chiffreAff</label>
        <input
          type="number"
          name="chiffreAff"
          v-model="chiffreAff"
          class="form-control"
        />
      </div>
      <div class="form-group">
        <label for="montPay">montPay</label>
        <input
          type="number"
          name="montPay"
          v-model="montPay"
          class="form-control"
        />
      </div>
    </div>

    <div class="col-sm-6">
      <div class="checkbox">
        <input type="checkbox" v-model="totalite" class="input-checkbox" /><br/>
        <label for="totalite">payer en totalite</label>
      </div>
      <div class="form-group">
        <label for="montVers">montant a verser</label>
        <input
          type="number"
          name="montVers"
          v-model="montVers"
          class="form-control"
        />
      </div>
      <div class="form-group">
        <label for="reste">reste</label>
        <input
          type="number"
          name="reste"
          v-model="reste"
          class="form-control"
        />
      </div>
      <div class="form-group">
        <select name="modeP" id="modeP" v-model="modeP" class="form-control">
          <option value="virement">virement</option>
          <option value="cheque">cheque</option>
          <option value="en espece">en espece</option>
          <option value="depot">depot</option>
          <option value="autre">autre</option>
        </select>
      </div>
      <div class="form-group">
        <label for="banque">banque</label>
        <input
          type="text"
          name="banque"
          v-model="banque"
          class="form-control"
        />
      </div>
      <div class="form-group">
        <label for="bordereau">bordereau</label>
        <input
          type="number"
          name="bordereau"
          v-model="bordereau"
          class="form-control"
        />
      </div>
      <button type="submit" class="btn-sasie mt-4">
      valider
    </button>
    </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      date: "",
      num_impot: "",
      num_nif: "",
      chiffreAff: "",
      montPay: "",
      montVers: "",
      reste: "",
      modeP: "",
      banque: "",
      bordereau: "",
      impot: [],
      nif: [],
      totalite: false,
      id_saisie: 0,
      error: '',
      nifError: ''
    };
  },
  methods: {
    async saisie(e) {
      e.preventDefault();
      const { data } = await axios.post(
        "http://localhost:80/recette_fiscale/faireSaisie",
        {
          date: this.date,
          num_impot: this.num_impot,
          num_nif: this.num_nif,
          chiffreAff: this.chiffreAff,
          montPay: this.montPay,
          montVers: this.montVers,
          reste: this.reste,
          modeP: this.modeP,
          banque: this.banque,
          bordereau: this.bordereau,
        }
      );
      if (data.messages.error == null) {
        this.id_saisie = data.data.id_saisie;
        this.$router.push(`/adminDashboard/decl/${this.id_saisie}`);
      } else {
        this.error = data.messages.error;
      }
    },
    async fetchImpot() {
      const { data } = await axios.get(
        `http://localhost:80/recette_fiscale/afficherUnImpot/${this.num_impot}`
      );
      this.impot = data;
    },
    async fetchNif() {
      try {
        const { data } = await axios.get(
        `http://localhost:80/recette_fiscale/afficherNif/${this.num_nif}`
        );
        this.nif = data;
        this.nifError = '';
      } catch (error) {
        this.nifError = error.response.data.messages.error;
        this.nif = [];
      }
    },
  },
  watch: {
    num_impot() {
      this.fetchImpot();
    },
    num_nif() {
      this.fetchNif();
    },
    chiffreAff() {
      this.montPay = this.chiffreAff / 10;
    },
    totalite() {
      if (this.totalite) {
        this.montVers = this.montPay;
        this.reste = 0;
      } else {
        this.reste = "";
        this.montVers = "";
      }
    },
    montVers() {
      // this.totalite = false;
      this.reste = Math.round(this.montPay - this.montVers);
      // this.totalite = false;
      if (this.montVers > this.montPay) {
        this.reste = 0;
      }
    },
  },
};
</script>

<style>
.declaration {
  font-size: 12px;
  width: 100%;
}
.checkbox {
  align-items: center;
}
.checkbox label {
  margin-right: 10px;
}
.btn-sasie {
  padding: 8px;
  border-style: none;
  outline: none;
  background: crimson;
  color: #fff;
  border-radius: 5px;
}
.description {
  padding: 5px;
  border-radius: 5px;
}
.attribut {
  font-weight: 600;
  color: crimson;
}
.decl-title {
  font-size: 24px;
  color: crimson;
}
</style>