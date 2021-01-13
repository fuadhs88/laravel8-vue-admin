<template>
    <div :class="'card card-' + this.GLOBAL.color + ' card-outline'">
        <div class="card-header">
            <h3 class="card-title">Environment</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                    <tr v-for="(env, i) in data.envs" :key="i">
                        <td width="120px">{{ env.name }}</td>
                        <td>{{ env.value }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
    </div>
</template>

<script>
    export default {
        name: "Environment",

        props: ['data'],
    }
</script>

<style scoped>

</style>
