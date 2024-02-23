<template>
    <div class="card shadow">
        <img v-if="product.gambar" :src="'http://localhost:8080/upload/' + product.gambar" class="card-img-top">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ product.nama }}</h5>
            <p class="card-text flex-grow-1">Harga : <strong>Rp. {{ product.harga }}</strong></p>
            <div class="aksi">
                <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#editModal"><font-awesome-icon
                        icon="pencil" />
                    Edit</button>
                <button class="btn btn-danger"><font-awesome-icon icon="trash" />
                    Hapus</button>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editProduct">
                            <input type="hidden" v-model="product.id" class="form-control float-left">

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

                            <button type="submit" class="btn btn-primary float-right">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'CardEdit',
    props: ['product'],
    data() {
        return {
            selectedFile: null
        };
    },
    methods: {
        setProducts(data) {
            this.products = data;
        },
        onFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        editProduct() {
            this.product.is_ready = this.product.is_ready ? 1 : 0;

            // Buat objek FormData untuk mengirimkan data form, termasuk file gambar
            let formData = new FormData();
            formData.append('id', this.product.id);
            formData.append('kode', this.product.kode);
            formData.append('nama', this.product.nama);
            formData.append('harga', this.product.harga);
            formData.append('gambar', this.selectedFile);
            formData.append('is_ready', this.product.is_ready);

            axios.put(`http://localhost:8080/api/products/${this.product.id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })

                .then(() => {
                    this.$router.push({ path: "/" })
                    this.$toast.success('Berhasil update product', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                    // Setelah berhasil mengupdate produk, perbarui daftar produk
                    this.loadProducts();
                })
                .catch(() => this.$toast.error('Gagal update data', {
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
    mounted() {
        this.loadProducts()
    },
}
</script>
<style lang="">
</style>
