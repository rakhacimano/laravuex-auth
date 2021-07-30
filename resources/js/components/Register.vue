<template>
    <div class="form-register">
        <form @submit.prevent="register">
            <h2>Register</h2>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" v-model="account.name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" v-model="account.email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" v-model="account.password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password Confirmation" v-model="account.password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            account : {
                name : '',
                email : '',
                password : '',
                password_confirmation : ''
            }
        }
    },
    methods : {
        register() {
            this.axios.post('http://localhost:8000/api/auth/register', this.account)
            .then( res => {
                this.$router.push('/');
            })
            .catch( err => {
                console.log(err)
            });
        }
    }
}
</script>
 
<style scoped>
    .form-register {
        background: white;
        width: 400px;
        padding: 30px 10px;
        margin: 10px auto 0 auto;
    }
</style>
