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
                <Link :href="route('users.personal')">Личный Кабинет</Link>
            </div>
        </div>
        <div class="w-1/2 flex mx-auto py-4">
            <div class="w-1/4 bg-white p-4 border border-gray-300 mr-4">
                <h3 class="text-xl mr-4">Меню</h3>
            </div>
            <div class="w-3/4 bg-white p-4 border border-gray-300">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
