<template>
    <div class="card shadow">
        <img v-if="best_product.gambar" :src="'http://localhost:8080/upload/' + best_product.gambar" class="card-img-top">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ best_product.nama }}</h5>
            <p class="card-text flex-grow-1">Harga : <strong>Rp. {{ best_product.harga }}</strong></p>
            <router-link class="btn btn-success" :to="'/foods/' + best_product.id"><font-awesome-icon icon="shopping-cart" />
                Pesan</router-link>
        </div>
    </div>
</template>
<script>
export default {
    name: 'CardBest',
    props: ['best_product'],
}
</script>
<style lang="">

    </style>yle>
