<template>
    <div>
        <spin v-if="loading"></spin>
        <div class="row" v-else>
            <div class="col-md-5">
                <img class="img-fluid" :src="getImageSrc(image_single.path)" alt="">
            </div>
            <div class="col-md-7">
                <div class="sidebar-widget">
                    <h2>{{ image_single.title }}</h2>
                </div>
                <div class="sidebar-widget">
                    <h5 class="widget-title">Author</h5>
                    <div class="widget-content">
                        <p>
                            <router-link class="text-info" data-toggle="modal"
                                :to="getContributorUrl(image_single.user.id)">
                                {{ image_single.user.name }}
                            </router-link>
                        </p>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h5 class="widget-title">Description</h5>
                    <div class="widget-content">
                        <p>{{ image_single.description }}</p>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <h5 class="widget-title">Keywords</h5>
                    <div class="widget-content">
                        <p>{{ image_single.keywords }}</p>
                    </div>
                </div>
                <div class="sidebar-widget">
                    <form action="" v-if="isCustomer">
                        <input type="hidden" ref="image_id" :value="image_single.id">
                        <button type="submit" class="btn btn-primary btn-xl text-uppercase" @click.prevent="buyImage">
                            Buy Image
                        </button>
                    </form>
                    <div v-else>
                        <button class="btn btn-primary btn-xl text-uppercase" disabled>
                            Buy Image
                        </button>
                        <p>Only logged in customers can buy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import Spin from "../components/Spin";

    export default {
        components: {
            Spin,
        },
        data() {
            return {
                loading: true,
                isCustomer: false,
                not_found: false,
                userId: null,
                userRoles: null,
                image_single: [],
            }
        },
        mounted() {
            this.userId = this.$userId;
            this.userRoles = this.$userRoles;
            this.loadImageById();
            this.checkCustomerUser();
        },
        methods: {
            checkCustomerUser() {
                if (null != this.userId  && this.userId.length) {
                    if (this.userRoles.includes('customer')) {
                        this.isCustomer = true;
                    }
                }
            },
            loadImageById() {
                axios.get('/api/image/' + this.$route.params.id)
                    .then(response => {
                        this.image_single = response.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.not_found = true;
                        this.loading = false;
                    });
            },
            getImageSrc(imagePath) {
                return "/storage/" + imagePath;
            },
            getContributorUrl(id) {
                return "/contributor/" + id;
            },
            buyImage() {
                axios.post('/api/buy', {imageId: this.$refs.image_id.value, userId: this.userId})
                .then(response => {
                    window.location.href = window.location.protocol + '//' + window.location.hostname + '/admin';
                })
            }
        }
    }
</script>

<style scoped>

</style>
