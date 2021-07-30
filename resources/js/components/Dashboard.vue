<template>
    <div class="container mt-5">
        <h1>Welcome to Dashboard</h1>
        <button @click="logout" class="btn btn-danger">Logout</button>
    </div>
</template>
 
<script>
export default {
    mounted() {
        if(this.$store.state.token !== '') {
            this.axios.post('http://localhost:8000/api/auth/checkToken', { token : this.$store.state.token } )
                      .then( res => {
 
                      })
                      .catch( err => {
                          this.$store.commit('clearToken');
                          this.$router.push('/');
                      })
        } else {
            this.$router.push('/');
        }
    },
    methods : {
        logout() {
            this.axios.post('http://localhost:8000/api/auth/logout', { 
                token : this.$store.state.token 
            })
            .then( res => {
                this.$store.commit('clearToken');
                this.$router.push('/');
            })
        }
    }
}
</script>
 
<style scoped>
    .container {
        height: 50px;
    }
</style>
