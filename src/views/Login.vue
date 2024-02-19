<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="login-form">
                    <h2 class="text-success mb-4">Masuk</h2>
                    <form @submit.prevent="login">
                        <div class="form-group">
                            <label for="email">Email Anda</label>
                            <input type="email" v-model="email" class="form-control" placeholder="Masukkan email Anda">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Anda</label>
                            <input type="password" v-model="password" class="form-control"
                                placeholder="Masukkan password Anda">
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-3">Lanjutkan</button>
                    </form>
                    <p class="mt-3 text-muted small"><font-awesome-icon icon="lock" /> Data Anda akan aman dan tidak akan
                        dishare atau dibagikan kepada
                        siapapun. Saat menggunakan layanan Kulinerku, Kami menganggap bahwa Anda telah menyetujui
                        <router-link class="text-success" to="/terms-and-conditions"><strong>Syarat dan
                                Ketentuan</strong></router-link> dan
                        <router-link class="text-success" to="/privacy-policy"><strong>Kebijakan
                                Privasi</strong></router-link>kami.
                    </p>
                </div>
                <div class="lainnya col-md-8 text-center mx-auto">
                    <p class="mt-3">Kembali ke <router-link class="text-success" to="/"><strong> Halaman
                                Utama</strong>
                        </router-link></p>
                    <p class="mt-3">Belum punya akun? <router-link class="text-success" to="/daftar"><strong> Daftar
                                Sekarang</strong>
                        </router-link></p>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    name: 'Login',
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login() {
            axios
                .post('http://localhost:8080/api/user', {
                    email: this.email,
                    password: this.password
                })
                .then(() => {
                    this.$router.push({ path: "/" });
                    this.$toast.success('Berhasil Login', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                })

        }
    }
}
</script>
  
<style scoped></style>
  