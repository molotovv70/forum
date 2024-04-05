<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Edit",
    props: {
        theme: Object,
    },
    data() {
        return {
            title: this.theme.title,
            description: this.theme.description,
        }
    },
    components: {
        Link
    },
    methods: {
        update() {
            this.$inertia.patch(`/themes/${this.theme.id}`, {
                title: this.title,
                description: this.description,
            });
        }
    },
    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Редактировать Тему</h3>
            <Link :href="route('sections.store')" class="block px-2 py-1 w-8 bg-white border border-gray-300 rounded-lg text-center">+</Link>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" placeholder="Заголовок" v-model="title" class="border-sky-500 p-2 w-1/2">
            </div>
            <div class="mb-4">
                <textarea placeholder="Описание" v-model="description" class="border-sky-500 p-2 w-1/2">
                    {{ description }}
                </textarea>
            </div>
            <div class="">
                <a @click.prevent="update" class="block py-2 w-1/4 bg-sky-500 border border-sky-600 text-white text-center">Сохранить</a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
