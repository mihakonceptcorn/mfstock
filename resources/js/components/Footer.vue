<template>
    <div>
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Team</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <a target="_blank" href="https://www.linkedin.com/in/mihailfedorenko/">
                                <img class="mx-auto rounded-circle" :src="'/assets/img/team/MikhailFedorenko.jpg'" alt="">
                            </a>
                            <h4 class="text-primary">Mikhail Fedorenko</h4>
                            <p class="text-light">PHP developer</p>
                            <a class="btn btn-dark btn-social mx-2" target="_blank"
                               href="https://www.linkedin.com/in/mihailfedorenko/">
                                <svg class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" focusable="false"
                                     data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0
                                    83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9
                                    448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69
                                    76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28
                                    61.9 111.28 142.3V448z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4">Copyright © MfStock 2021</div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: "Footer"
    }
</script>

<style scoped>

</style>
