<template>
    <div>
        <div class="text-center">
            <h2 class="section-heading text-uppercase">{{ contributor.name }}'s images</h2>
        </div>
        <spin v-if="loading"></spin>
        <div class="row" v-else>
            <stock-image v-for="stock_image in contributor.images" :title="stock_image.title" :imagePath="stock_image.path"
                         :key="stock_image.id" :id="stock_image.id"/>
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from "axios";
    import StockImage from "../components/StockImage";
    export default {
        components: {
            Spin,
            StockImage
        },
        data() {
            return {
                loading: true,
                not_found: false,
                contributor: [],
            }
        },
        mounted() {
            this.loadImagesByContributorId(this.$route.params.id);
        },
        methods: {
            loadImagesByContributorId(id) {
                axios.get('/api/contributor/' + id)
                    .then(response => {
                        this.contributor = response.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.not_found = true;
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
