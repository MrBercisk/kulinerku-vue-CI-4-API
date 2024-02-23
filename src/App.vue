<script setup>
import 'bootstrap/dist/css/bootstrap.min.css'

</script>

<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>

import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
export default {


}

</script>

