import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Foods from '../views/Foods.vue'
import FoodDetail from '../views/FoodDetail.vue'
import Keranjang from '../views/Keranjang.vue'
import PesananSukses from '../views/PesananSukses.vue'
import Login from '../views/Login.vue'
import Daftar from '../views/Daftar.vue'
import SyaratKetentuan from '../views/SyaratKetentuan.vue'
import Kebijakan from '../views/Kebijakan.vue'
import TambahProduct from '../views/Product/TambahProduct.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/foods',
      name: 'Foods',
      component: Foods
    },
    {
      path: '/foods/:id',
      name: 'FoodDetail',
      component: FoodDetail
    },
    {
      path: '/keranjang/',
      name: 'Keranjang',
      component: Keranjang
    },
    {
      path: '/pesanan-sukses/',
      name: 'PesananSukses',
      component: PesananSukses
    },
    {
      path: '/login/',
      name: 'Login',
      component: Login
    },
    {
      path: '/daftar/',
      name: 'Daftar',
      component: Daftar
    },
    {
      path: '/privacy-policy/',
      name: 'Kebijakan',
      component: Kebijakan
    },
    {
      path: '/terms-and-conditions/',
      name: 'SyaratKetentuan',
      component: SyaratKetentuan
    },
    {
      path: '/tambah-product/',
      name: 'TambahProduct',
      component: TambahProduct
    },
  ]
});

export default router;
