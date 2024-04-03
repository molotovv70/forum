<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Index",
    props: {
        branch: Object,
    },
    components: {
        Link
    },
    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center">
            <h3 class="text-xl mr-4">{{ branch.title }}</h3>
        </div>
    </div>
</template>

<style scoped>

</style>
