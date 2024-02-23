<template lang="">
    <div>
        <Navbar />
        <div class="food-detail">
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
                                                      
                                <li aria-current="page" class="breadcrumb-item active">Food Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <img v-if="product.gambar" :src="'http://localhost:8080/upload/' + product.gambar" class="card-img-top">
                    </div>
                    <div class="col-md-6 mt-2">
                        <h2><strong>{{product.nama}}</strong></h2>
                        <hr>
                        <h5>Harga : <strong>Rp. {{product.harga}}</strong></h5>
                        <!-- v on prevent agar tidak reload saat submit -->
                        <form class="mt-3" v-on:submit.prevent>
                            <div class="form-group">
                                <input type="hidden" class="form-control"name="product_id" v-model="pesan.product_id">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pesan">Jumlah Pesan</label>
                                <input type="number" class="form-control" name="jumlah_pesan" v-model="pesan.jumlah_pesan">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">keterangan</label>
                                <textarea name="keterangan" v-model="pesan.keterangan" id="keterangan" class="form-control" placeholder="Pedas, Setengah Porsi ..." cols="30" rows="3"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-success float-right" @click="pemesanan"><font-awesome-icon icon="shopping-cart" /> Pesan</button>
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
    name: "FoodDetail",
    components: {
        Navbar,
    },
    data() {
        return {
            product: {},
            pesan: {
                product_id: '',
                jumlah_pesan: '',
                keterangan: ''
            }
        }
    },
    methods: {
        setProduct(data) {
            this.product = data
        },
        pemesanan() {
            const keranjang = {
                product_id: this.product.id,
                jumlah_pesan: this.pesan.jumlah_pesan,
                keterangan: this.pesan.keterangan
            };
            axios.post(`http://localhost:8080/api/keranjang`, keranjang)
                .then(() => {
                    this.$router.push({ path: "/" })
                    this.$toast.success('Sukses Masuk Keranjang', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    })
                })
                .catch(() => this.$toast.error('Gagal tambah data', {
                    type: 'error',
                    position: 'top-right',
                    duration: 3000,
                    dismissible: true,
                }));
        }
    },
    mounted() {
        axios
            .get("http://localhost:8080/api/products/" + this.$route.params.id)
            .then((response) => this.setProduct(response.data))
            .catch((error) => console.log(error))


    },
}
</script>
<style lang="">
    
</style>