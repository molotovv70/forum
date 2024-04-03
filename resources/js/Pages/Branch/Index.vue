<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Index",
    components: {
        Link
    },
    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center">
            <h3 class="text-xl mr-4">Разделы</h3>
            <Link :href="route('sections.create')" class="block mr-4 px-2 py-1 w-1/6 bg-white border border-gray-300 rounded-lg text-center">+ Раздел</Link>
            <Link :href="route('sections.create')" class="block mr-4 px-2 py-1 w-1/6 bg-white border border-gray-300 rounded-lg text-center">+ Ветка</Link>
        </div>
    </div>
</template>

<style scoped>

</style>
