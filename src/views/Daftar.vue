<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="login-form">
                    <h2 class="text-success mb-4">Daftar</h2>
                    <form @submit.prevent="register">
                        <div class="form-group">
                            <label for="nama">Nama Anda</label>
                            <input type="text" v-model="nama" class="form-control" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Anda</label>
                            <input type="email" v-model="email" class="form-control" placeholder="Masukkan email Anda">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Anda</label>
                            <input type="password" v-model="password" class="form-control"
                                placeholder="Masukkan password Anda">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password Anda</label>
                            <input type="password" v-model="confirmPassword" class="form-control"
                                placeholder="Masukkan konfirmasi password Anda">
                        </div>
                        <input type="hidden" v-model="role_id" value="2">
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
                    <p class="mt-3">Sudah punya akun? <router-link class="text-success" to="/login"><strong> Masuk
                                Sekarang</strong>
                        </router-link></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Daftar',
    data() {
        return {
            nama: '',
            email: '',
            password: '',
            role_id: 2,
            confirmPassword: ''
        };
    },
    methods: {
        register() {
            if (this.password !== this.confirmPassword) {
                this.$toast.error('Konfirmasi password tidak cocok dengan password', {
                    type: 'error',
                    position: 'top-right',
                    duration: 3000,
                    dismissible: true,
                });
                return;
            }

            axios
                .post('http://localhost:8080/api/user', {
                    nama: this.nama,
                    email: this.email,
                    password: this.password,
                    role_id: this.role_id
                })

                .then(() => {
                    this.$router.push({ path: "/login" });
                    this.$toast.success('Berhasil Daftar', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                })
        },
    }
};

</script>

<style></style>
