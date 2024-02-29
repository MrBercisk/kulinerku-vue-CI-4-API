<template>
    <div>
        <Navbar />
        <div class="container">
            <div class="row">
                <div class="col mt-4">
                    <h2>Tambah <strong>Product</strong></h2>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <form class="mt-3" @submit.prevent="tambahProduct">
                        <div class="form-group">
                            <label for="kode">Kode Product</label>
                            <input type="text" v-model="product.kode" name="kode" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Product</label>
                            <input type="text" v-model="product.nama" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" v-model="product.harga" name="harga" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Product</label>
                            <input type="file" @change="onFileChange" accept="image/jpeg" name="gambar"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="hidden" v-model="product.is_ready" class="form-control float-left">
                        </div>

                        <button type="submit" class="btn btn-success float-right">
                            <font-awesome-icon icon="plus" /> Tambah
                        </button>
                    </form>

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 mt-4" v-for="product in products" :key="product.id">
                    <CardEdit :product="product" />
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import Footer from "@/components/Footer.vue"
import Navbar from '@/components/Navbar.vue';
import CardEdit from '@/components/CardEdit.vue';
import axios from 'axios';

export default {
    name: 'ManageProduct',
    components: {
        Navbar,
        CardEdit,
        Footer
    },
    data() {
        return {
            products: [],
            search: '',
            product: {
                kode: '',
                nama: '',
                harga: '',
                gambar: null, // Tambahkan properti gambar di sini
                is_ready: 1
            },
            selectedFile: null,
        };
    },
    methods: {
        setProducts(data) {
            this.products = data;
        },
        onFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        tambahProduct() {
            this.product.is_ready = this.product.is_ready ? 1 : 0;

            // Buat objek FormData untuk mengirimkan data form, termasuk file gambar
            let formData = new FormData();
            formData.append('kode', this.product.kode);
            formData.append('nama', this.product.nama);
            formData.append('harga', this.product.harga);
            formData.append('gambar', this.selectedFile); 
            formData.append('is_ready', this.product.is_ready); 
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            axios
                .post("http://localhost:8080/api/products", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' 
                    }
                })
                .then(() => {
                    this.$router.push({ path: "/manageProduct" })
                    this.$toast.success('Berhasil tambah product', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                    // Kosongkan input otomatis
                    this.product = {
                        kode: '',
                        nama: '',
                        harga: '',
                        gambar: null, 
                        is_ready: 1
                    };
                    // Setelah berhasil menambahkan produk, perbarui daftar produk
                    this.loadProducts();
                })
                .catch(() => this.$toast.error('Gagal tambah data', {
                    type: 'error',
                    position: 'top-right',
                    duration: 3000,
                    dismissible: true,
                }));
        },
        loadProducts() {
            axios
                .get("http://localhost:8080/api/products")
                .then((response) => this.setProducts(response.data))
                .catch((error) => console.log(error));
        },
    },

    /* Ketika halaman home dipasang maka mounted akan berjalan */
    mounted() {
        this.loadProducts();
    },
}
</script>

<style lang="">
    
</style>
