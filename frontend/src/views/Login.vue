<template>
    <div class="login">
        <div class="login-form">
            <h3 class="connecter">se connecter !!!</h3>
            <div class="alert alert-danger" v-if="error">{{ error }}</div>
            <form action="" class="form" @submit.prevent="login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" v-model="email" placeholder="ex:tovonjanahary@gmail.com" class="input-auth">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe </label>
                    <input type="password" name="password" v-model="password" class="input-auth">
                </div>
                <button class="btn-login" type="submit">se connecter</button>
                <p class="information">accessible au personnel de l'impot <span>&#128578;</span></p>
            </form>
        </div>
        <img src="guide.svg" alt="guide">
    </div>
</template>

<script>
export default {
    data() { 
        return {
        email: '',
        password: '',
        error: ''
        }
    },
    computed: {
        
    },
    mounted() {
        if(this.$store.state.userInfo) {
            this.$router.push("/adminDashboard")
        }
    },
    methods: {
        login(e) {
            e.preventDefault();
            this.$store.dispatch('login', {
                email:this.email, 
                password: this.password 
                })
            .then((res) => {
                this.$store.dispatch('userInfo', res.data.data);
                this.$router.push("/adminDashboard")
            })
            .catch(err => this.error = err.response.data.messages.error)
        }
    }
}
</script>

<style>
.login {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: rgb(252, 248, 248);
    color: #222;
}
.connecter {
    font-weight: 800;
    font-size: 30px;
}
.login-form {
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
    padding: 15px;
    border-radius: 10px;
    width: 500px;
    display: flex;
    align-items: center;
    flex-direction: column;
    background: #fff;
}

.form-group:not(:first-child) {
    margin-top: 20px;
}
.btn-login {
    margin-top: 10px;
    outline: none;
    padding: 10px;
    border-style: none;
    border-radius: 5px;
    background: crimson;
    color: #f2f2f2;
}
.input-auth {
    height: 30px;
    border: 1px solid #ddd;
    outline: none;
    padding-left: 10px;
    width: 100%;
}
.form label {
    margin-bottom: 20px;
}
.information {
    margin: 10px 10px;
    font-size: 12px;
    font-weight: 300;
    color: rgb(240, 57, 93);
}
.error {
    color: crimson;
    margin: 10px 10px;
    font-size: 12px;
}
</style>