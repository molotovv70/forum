<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",

    props: {
        roles: Array,
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
            <h3 class="text-xl mr-4">Роли</h3>
                <Link :href="route('admin.roles.create')" class="block mr-4 px-2 py-1 w-1/6 bg-white border border-gray-300 rounded-lg text-center">+ Роль</Link>
        </div>
        <div>
            <div class="border border-gray-100 rounded-lg">
                <table class="text-center w-full text-medium">
                    <thead class="w-full bg-gray-100">
                    <tr>
                        <th class="p-4 text-gray-700">ID</th>
                        <th class="p-4 text-gray-700">Название</th>
                        <th class="p-4 text-gray-700">Код</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="role in roles">
                        <td class="p-4">{{ role.id }}</td>
                        <td class="p-4">{{ role.title }}</td>
                        <td class="p-4">{{ role.code }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
