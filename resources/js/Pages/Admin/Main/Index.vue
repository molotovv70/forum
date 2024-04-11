<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",

    props: {
        stats: Object
    },

    components: {
        Link
    },
    layout: AdminLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-8">
            <h3 class="text-xl mr-4">Статистика</h3>
        </div>
        <div>
            <div v-if="stats" class="flex justify-between text-center ">
                <div v-for="stat in stats" class="">
                    <h3>{{ stat.title }}</h3>
                    <p>{{ stat.count }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
