<template>
    <div>
        <div class="keranjang">
            <Navbar :updateKeranjang="keranjangs" />
            <div class="container">
                <div class="row mt-4">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link class="breadcrumb-item" aria-current="page" to="/">Home</router-link>
                                </li>
                                <li class="breadcrumb-item">
                                    <router-link class="breadcrumb-item" aria-current="page" to="/foods">Foods</router-link>
                                </li>

                                <li aria-current="page" class="breadcrumb-item active">Keranjang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>Keranjang <strong>Saya</strong></h2>
                        <div class="table-responsive mt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Makanan</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(keranjangs, index) in keranjang" :key="keranjangs.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <img v-if="keranjangs.gambar"
                                                :src="'http://localhost:8080/upload/' + keranjangs.gambar" width="300px">


                                        </td>
                                        <td>{{ keranjangs.nama }}</td>
                                        <td>{{ keranjangs.keterangan ? keranjangs.keterangan : "-" }}</td>
                                        <td>{{ keranjangs.jumlah_pesan }}</td>
                                        <td align="right">{{ keranjangs.harga }}</td>
                                        <td align="right">{{ keranjangs.harga * keranjangs.jumlah_pesan }}</td>

                                        <td align="center">
                                            <button type="button" class="btn btn-danger"
                                                @click="hapusKeranjang(keranjangs.id)"><font-awesome-icon
                                                    icon="trash" /></button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6" align="right"><strong>Total Harga :</strong></td>
                                        <td align="right">
                                            <strong>Rp. {{ totalHarga }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <form class="mt-3" @submit.prevent="checkout">
                            <!-- Masukkan input untuk keranjang_id -->
                            <input type="hidden" name="keranjang_id" class="form-control" v-model="pesanan.keranjang_id">
                            <div class="form-group">
                                <label for="nama">Nama :</label>
                                <input type="text" name="nama" class="form-control" v-model="pesanan.nama">
                            </div>
                            <div class="form-group">
                                <label for="no_meja">Nomor Meja :</label>
                                <input type="text" name="no_meja" class="form-control" v-model="pesanan.no_meja">
                            </div>
                            <button type="submit" class="btn btn-success float-right">
                                <font-awesome-icon icon="shopping-cart" /> Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
    name: "Keranjang",
    components: {
        Navbar,
    },
    data() {
        return {
            keranjang: [],
            pesanan: {
                nama: '',
                no_meja: '',
                totalHarga: ''
            },
        }
    },
    methods: {
        setKeranjang(data) {
            this.keranjang = data;
        },

        checkout() {
            if (this.pesanan.nama && this.pesanan.no_meja && this.keranjang.length > 0) {
                const requests = this.keranjang.map(item => {
                    return axios.post("http://localhost:8080/api/pesanan", {
                        keranjang_id: item.id,
                        nama: this.pesanan.nama,
                        no_meja: this.pesanan.no_meja,
                        totalHarga: this.totalHarga
                    });
                });

                // Menggunakan Promise.all untuk menunggu semua permintaan selesai sebelum melanjutkan
                Promise.all(requests)
                    .then(() => {

                        this.$router.push({ path: "/pesanan-sukses" });

                        this.$toast.success('Sukses Dipesan', {
                            type: 'success',
                            position: 'top-right',
                            duration: 3000,
                            dismissible: true,
                        });
                    })
                    .catch(error => console.log(error));
            } else {
                this.$toast.error('Nama dan Nomor Meja Harus Diisi, dan Keranjang tidak boleh kosong', {
                    type: 'error',
                    position: 'top-right',
                    duration: 3000,
                    dismissible: true,
                });
            }
        },
       
        getKeranjang() {
            axios
                .get("http://localhost:8080/api/keranjang")
                .then((response) => {
                    this.setKeranjang(response.data);
                    this.updateTotalHarga();
                })
                .catch((error) => console.log(error));
        },
        updateTotalHarga() {
            this.pesanan.totalHarga = this.totalHarga;
        }
    },
    mounted() {
        this.getKeranjang();
    },
    computed: {
        totalHarga() {
            return this.keranjang.reduce((total, keranjangs) => {
                return total + keranjangs.harga * keranjangs.jumlah_pesan;
            }, 0);
        }
    }
}

</script>

<style scoped>
/* CSS styling */
</style>
