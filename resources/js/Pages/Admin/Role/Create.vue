<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",

    props: {
        sections: Array,
    },
    data() {
        return {
            title: '',
            section_id: null,
            branch_id: null,
            branches: [],
        }
    },

    components: {
        Link
    },

    methods: {
        store() {
            this.$inertia.post('/admin/roles', {
                title: this.title,
                section_id: this.section_id,
                branch_id: this.branch_id,
            })
        },
        getBranches() {
            this.branch_id = null;
            axios.get(`/sections/${this.section_id}/branches`)
                .then(res => {
                    this.branches = res.data;
                });
        }
    },

    layout: AdminLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-8">
            <h3 class="text-xl mr-4">Добавить роль</h3>
        </div>
        <div>
            <div class="border border-gray-100 rounded-lg">
                <div>
                    <div class="mb-4" v-if="sections.length > 0">
                        <select @change="getBranches" class="border-sky-500 p-2 w-1/4" v-model="section_id">
                            <option value="null" selected disabled>Выберете раздел</option>
                            <option v-for="section in sections" :value="section.id">{{ section.title }}</option>
                        </select>
                        <div v-if="this.$page.props.errors.section_id" class="text-sm text-red-600">
                            {{ this.$page.props.errors.section_id }}
                        </div>
                    </div>
                    <div class="mb-4" v-if="branches.length > 0">
                        <select class="border-sky-500 p-2 w-1/4" v-model="branch_id">
                            <option value="null" selected disabled>Ветки этого раздела</option>
                            <option v-for="branch in branches" :value="branch.id">{{ branch.title }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <input type="text" placeholder="Заголовок" v-model="title" class="border-sky-500 p-2 w-1/4">
                        <div v-if="this.$page.props.errors.title" class="text-sm text-red-600">
                            {{ this.$page.props.errors.title }}
                        </div>
                    </div>
                    <div class="">
                        <a @click.prevent="store" class="block py-2 w-1/4 bg-sky-500 border border-sky-600 text-white text-center">Добавить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
