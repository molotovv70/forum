<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "AdminLayout",
    components: {
        Link
    }
}
</script>

<template>
    <div class="">
        <div class="bg-white border-b border-gray-300 py-4">
            <div class="w-1/2 mx-auto">
                <Link :href="route('sections.index')" class="mr-4">Форум</Link>
                <Link :href="route('users.personal')" class="mr-4">Личный Кабинет</Link>
                <Link :href="route('admin.main.index')">Админка</Link>
            </div>
        </div>
        <div class="w-1/2 flex items-start mx-auto py-4">
            <div class="w-1/5 bg-white p-4 border border-gray-300 mr-4">
                <h3 class="text-xl mr-4">Меню</h3>
                <div class="">
                    <div class="">
                        <Link class="block w-full border-b border-gray-300 mb-2" :href="route('admin.main.index')">Статистика</Link>
                    </div>
                    <div class="">
                        <Link class="block w-full border-b border-gray-300 mb-2" :href="route('admin.complaints.index')">Жалобы</Link>
                    </div>
                    <div class="">
                        <Link class="block w-full border-b border-gray-300 mb-2" :href="route('admin.roles.index')">Роли</Link>
                    </div>
                </div>
            </div>
            <div class="w-4/5 bg-white p-4 border border-gray-300">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
