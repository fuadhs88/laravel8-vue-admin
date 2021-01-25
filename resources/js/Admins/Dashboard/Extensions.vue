<template>
    <div :class="'card card-' + $page.props.color + ' card-outline'">
        <div class="card-header">
            <h3 class="card-title">Available extensions</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <ul class="products-list product-list-in-card">
                <li class="item" v-for="(extension, i) in data.extensions" :key="i">
                    <div class="product-img">
                        <i :class="extension.icon" class="fa fa-2x ext-icon"></i>
                    </div>
                    <div class="product-info">
                        <a :href="extension.link" target="_blank" class="product-title">
                            {{ extension.name }}
                        </a>
                        <span class="float-right installed" v-if="extension.installed"><i class="fa fa-check"></i></span>
                    </div>
                </li>
                <!-- /.item -->
            </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
            <a href="https://github.com/laravel-admin-extensions" target="_blank" class="uppercase">View All Extensions</a>
        </div>
        <!-- /.card-footer -->
    </div>
</template>

<script>
    export default {
        name: "Extensions",

        props: ['data'],
    }
</script>

<style scoped>

</style>
