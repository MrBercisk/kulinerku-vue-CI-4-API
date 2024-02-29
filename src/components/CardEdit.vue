<template>
    <div class="card shadow">
        <img v-if="product.gambar" :src="'http://localhost:8080/upload/' + product.gambar" class="card-img-top">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ product.nama }}</h5>
            <p class="card-text flex-grow-1">Harga : <strong>Rp. {{ product.harga }}</strong></p>
            <div class="aksi">
                <button class="btn btn-primary mr-2" @click="showEditModal(product.id)">
                    <font-awesome-icon icon="pencil" />
                    Edit
                </button>
                <button class="btn btn-danger" @click="hapusProduct">
                    <font-awesome-icon icon="trash" /> Hapus
                </button>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal" :id="'editModal-' + product.id" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateProduct(product.id)">
                            <input type="text" v-model="editedProduct.id" name="id" class="form-control">
                            <div class="form-group">
                                <label for="kode">Kode Product</label>
                                <input type="text" v-model="editedProduct.kode" name="kode" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Product</label>
                                <input type="text" v-model="editedProduct.nama" name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" v-model="editedProduct.harga" name="harga" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Product</label>
                                <input type="file" @change="onFileChange" accept="image/jpeg" name="gambar"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="hidden" v-model="editedProduct.is_ready" class="form-control float-left">
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
            selectedFile: null,
            editedProduct: {
                id: '',
                kode: '',
                nama: '',
                harga: '',
                gambar: null, // Tambahkan properti gambar di sini
                is_ready: 1
            },
        };
    },
    methods: {
        onFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        showEditModal(id) {
            axios
                .get(`http://localhost:8080/api/products/${id}`)
                .then((response) => {
                    this.editedProduct = response.data;
                    $(`#editModal-${id}`).modal('show');
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateProduct(id) {
            this.product.id = id;

            this.editedProduct.is_ready = this.editedProduct.is_ready ? 1 : 0;

            // Buat objek FormData untuk mengirimkan data form, termasuk file gambar
            let formData = new FormData();
            formData.append('id', this.editedProduct.id);
            formData.append('kode', this.editedProduct.kode);
            formData.append('nama', this.editedProduct.nama);
            formData.append('harga', this.editedProduct.harga);
            formData.append('gambar', this.selectedFile);
            formData.append('is_ready', this.editedProduct.is_ready);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            axios
                .put(`http://localhost:8080/api/products/${id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    console.log(response);
                    this.$toast.success('Berhasil update product', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                    // Muat ulang produk setelah pembaruan berhasil
                    this.getProducts();
                })
                .catch(() => {
                    this.$toast.error('Gagal update data', {
                        type: 'error',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                });
        },
        hapusProduct() {
            axios
                .delete(`http://localhost:8080/api/products/${this.product.id}`)
                .then(() => {
                    this.$router.push({ path: "/" });
                    this.$toast.success('Berhasil hapus product', {
                        type: 'success',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                    // Muat ulang produk setelah penghapusan berhasil
                    this.getProducts();
                })
                .catch(() => {
                    this.$toast.error('Gagal hapus data', {
                        type: 'error',
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    });
                });
        },
        getProducts() {
            axios
                .get("http://localhost:8080/api/products")
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        // Panggil metode untuk memuat produk saat komponen dimuat
        this.getProducts();
    },
}
</script>
<style lang="">
</style>
