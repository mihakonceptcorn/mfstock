<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="/">
                    MfStock
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    Menu
                    <svg class="svg-inline--fa fa-bars fa-w-14 ml-1" aria-hidden="true" focusable="false"
                         data-prefix="fas"
                         data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                         data-fa-i2svg=""><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163
                         16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0
                         160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0
                         8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837
                         0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
                    </svg>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav text-uppercase ml-auto" v-if="name">
                        <li class="nav-item" v-for="link in links">
                            <router-link class="nav-link js-scroll-trigger" :to="link.href">{{ link.title }}</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="/admin">{{ name }}</a>
                        </li>
                        <li class="nav-item">
                            <button type="submit" class="nav-link js-scroll-trigger btn btn-link text-uppercase"
                                    v-on:click="handleLogout()">
                                Logout
                            </button>
                        </li>
                    </ul>
                    <ul class="navbar-nav text-uppercase ml-auto" v-else>
                        <li class="nav-item" v-for="link in links">
                            <router-link class="nav-link js-scroll-trigger" :to="link.href">{{ link.title }}</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To MfStock!</div>
                <div class="row justify-content-center">
                    <form class="d-flex col-md-5">
                        <input class="form-control me-2 mr-1" type="search" placeholder="Search images" aria-label="Search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </header>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                links: [
                    {
                        title: 'Home',
                        href: '/'
                    },
                ],
                name: false
            }
        },
        mounted() {
            this.setName();
        },
        methods: {
            setName() {
                if (null != this.$userName)
                {
                    this.name = this.$userName;
                }
            },
            handleLogout() {
                axios.post('/logout')
                    .then(() => location.href = '/')
            }
        }
    }
</script>

<style scoped>

</style>
