<template>
  <h2>user</h2>
  <form action="" class="shadow-lg" >
    <div class="nif-form">
      <section class="section1">
        <div class="text-danger lead">ajouter un utilisateur</div>
        <div class="form-group">
          <label for="activite">Nom</label>
          <input
            type="text"
            name="activite"
            v-model="activite"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="adresse">Prenom</label>
          <input
            type="text"
            name="adresse"
            v-model="adresse"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="capital">adresse</label>
          <input
            type="number"
            name="capital"
            v-model="capital"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="nbrSal">email</label>
          <input
            type="number"
            name="nbrSal"
            v-model="nbrSal"
            class="form-control"
          />
        </div>
      </section>
      <section class="section2">
        <div class="form-group">
          <label for="nomCom">mot de passe</label>
          <input
            type="text"
            name="nomCom"
            v-model="nomCom"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="raisCom">confirmation du mot de passe</label>
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
        <button type="submit" class="ajouter-nif mt-4">S'inscrire</button>
      </section>
    </div>
  </form>
</template>

<script>
export default {};
</script>

<style>
</style>