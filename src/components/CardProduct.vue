<template>
    <div class="card shadow" style="border-radius: 20px;">
        <img v-if="product.gambar" :src="getImgUrl(product.gambar)" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ product.nama }}</h5>
            <p class="card-text">Harga : <strong>Rp. {{ product.harga }}</strong></p>
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
    
</style>