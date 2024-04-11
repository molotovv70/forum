<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",

    props: {
        complaints: Array
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
            <h3 class="text-xl mr-4">Жалобы</h3>
        </div>
        <div>
            <div class="border border-gray-100 rounded-lg">
                <table class="text-center text-medium">
                    <thead class="w-full bg-gray-100">
                        <tr>
                            <th class="p-4 text-gray-700">ID</th>
                            <th class="p-4 text-gray-700">Текст</th>
                            <th class="p-4 text-gray-700">Пользователь</th>
                            <th class="p-4 text-gray-700">Ссылка(Сообщение)</th>
                            <th class="p-4 text-gray-700">Статус</th>
                            <th class="p-4 text-gray-700">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="complaint in complaints">
                            <td class="p-4">{{ complaint.id }}</td>
                            <td class="p-4">{{ complaint.body }}</td>
                            <td class="p-4">{{ complaint.user.name }}</td>
                            <td class="p-4">
                                <Link :href="route('themes.show', complaint.theme_id) + `#${complaint.message_id}`">Ссылка</Link>
                            </td>
                            <td class="p-4">{{ complaint.is_solved }}</td>
                            <td class="p-4">
                                <a href="#" class="block w-6 h-6 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
