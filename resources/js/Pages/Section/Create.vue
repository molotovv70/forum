<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Create",
    data() {
        return {
            title: '',
        }
    },
    components: {
        Link
    },
    methods: {
        store() {
            this.$inertia.post('/sections', {title: this.title});
        }
    },
    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Добавить Раздел</h3>
            <Link :href="route('sections.store')" class="block px-2 py-1 w-8 bg-white border border-gray-300 rounded-lg text-center">+</Link>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" placeholder="Заголовок" v-model="title" class="border-sky-500 p-2 w-1/4">
            </div>
            <div class="">
                <a @click.prevent="store" class="block py-2 w-1/4 bg-sky-500 border border-sky-600 text-white text-center">Добавить</a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
