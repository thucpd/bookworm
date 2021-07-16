<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BOOKWORM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="[{active: $route.name === 'index'}]"
                    :to="{name: 'index'}"
                >
                    Home
                </router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="[{active: $route.name === 'shop'}]"
                    :to="{name: 'shop'}"
                >
                    Shop
                </router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="[{active: $route.name === 'about'}]"
                    :to="{name: 'about'}"
                >
                    About
                </router-link>
            </li>
        </ul>
    </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            
        },
        name : 'Header'
    }
</script>