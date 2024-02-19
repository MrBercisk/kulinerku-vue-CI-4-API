<template>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#">Kulinerku</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/foods">Foods</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-5">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login"> Login
                            <font-awesome-icon class="text-muted" icon="user" />
                        </router-link>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/keranjang">Keranjang
                            <font-awesome-icon class="text-muted" icon="shopping-bag" />
                            <span class="badge badge-success ml-2">{{ updateKeranjang ? updateKeranjang.length :
                                jumlah_pesanans.length }}</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>

import axios from 'axios';

export default {
    name: 'Navbar',

    data() {
        return {
            jumlah_pesanans: []
        }
    },
    methods: {
        setJumlah(data) {
            this.jumlah_pesanans = data
        }
    },
    props: ['updateKeranjang'],
    mounted() {
        axios
            .get("http://localhost:3000/keranjangs")
            .then((response) => this.setJumlah(response.data))
            .catch((error) => console.log(error))
    },
}
</script>