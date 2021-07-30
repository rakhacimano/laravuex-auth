<template>
    <div class="form-login">        
        <form @submit.prevent="login">
            <h2>Login</h2>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" v-model="account.email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" v-model="account.password">
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
        <div style="margin-top:10px">
            <router-link to="/register" style="text-decoration:underline">Register</router-link>            
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            account : {
                email : '',
                password : ''
            }
        }
    },
    mounted() {
        if(this.$store.state.token !== '') {
            this.axios.post('http://localhost:8000/api/auth/checkToken', { 
                token : this.$store.state.token 
            })
            .then( res => {
                if (res) {
                    this.$router.push('/dashboard');
                }
            })
            .catch (err => {
                this.$store.commit('clearToken');
            })
        } else {
            this.loading = false;
        }
    },
    methods : {
        login() {
            this.axios.post('http://localhost:8000/api/auth/login', 
            this.account)
            .then(res => {
                if(res.data.success) {
                    this.$store.commit('setToken', res.data.token);
                    this.$router.push('/dashboard');
                }
            })
            .catch(err => {
                console.log(err);
            })
        }
    }
}
</script>
 
<style scoped>
    .form-login {
        background: white;
        width: 400px;
        padding: 30px 10px;
        margin: 10px auto 0 auto;
    }
</style>
