<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Show",
    props: {
        theme: Object,
    },
    data() {

    },
    components: {
        Link
    },

    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">{{ theme.title }}</h3>
        </div>
        <div>
        </div>
    </div>
</template>

<style scoped>

</style>
