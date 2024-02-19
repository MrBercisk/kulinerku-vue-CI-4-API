<template lang="">
    <div>
        <Navbar />
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col text-center">
                    <img src="../assets/images/menunggu.png"  width="300" alt="">
                    <h2><strong>Sukses!!!</strong></h2>
                    <h4>Pesanan anda sedang di proses <br>Silahkan Tunggu</h4>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
export default {
    name: "PesananSukses",
    components: {
        Navbar,
    },
}
</script>
<style lang="">
    
</style>