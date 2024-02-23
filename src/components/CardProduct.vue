<template>
    <div class="card shadow">
        <img v-if="product.gambar" :src="'http://localhost:8080/upload/' + product.gambar" class="card-img-top">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ product.nama }}</h5>
            <p class="card-text flex-grow-1">Harga : <strong>Rp. {{ product.harga }}</strong></p>
            <router-link class="btn btn-success" :to="'/foods/' + product.id"><font-awesome-icon icon="shopping-cart" />
                Pesan</router-link>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CardProduct',
    props: ['product'],
}
</script>
<style lang="">

    </style>yle>
