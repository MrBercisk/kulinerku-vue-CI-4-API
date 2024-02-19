<template>
  <div class="home">
    <Navbar />
    <div class="container">
      <Hero />
      <div class="row mt-4">
        <div class="col">
          <h2>Best <strong>Foods</strong></h2>
        </div>
        <div class="col">
          <router-link to="/foods" class="btn btn-md-success  float-right"><font-awesome-icon icon="eye" /> Lihat
            Semua</router-link>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-4 mt-4" v-for="product in products" :key="product.id">
          <CardProduct  :product="product"/>
        </div>

      </div>
    </div>
    <div class="container mt-5">
      <About />
    </div>
    <div class="container mt-5">
      <Services />
    </div>
  </div>
  <Footer />
</template>
<script>

import Navbar from '@/components/Navbar.vue';
import Hero from '@/components/Hero.vue';
import About from '@/components/About.vue';
import CardProduct from '@/components/CardProduct.vue';
import Services from '@/components/Services.vue';
import Footer from "@/components/Footer.vue"
import axios from 'axios';

export default {
  name: 'Home',
  components: {
    Navbar,
    Hero,
    About,
    CardProduct,
    Services,
    Footer
  },
  data() {
    return {
      products: [],
    };
  },
  methods: {
    setProducts(data) {
      this.products = data
    },
  },
  /* Ketika halaman home dipasang maka mounted akan berjalan */
  mounted() {
    axios
      .get("http://localhost:8080/api/products")
      .then((response) => this.setProducts(response.data))
      .catch((error) => console.log(error))
  },
};
</script>


