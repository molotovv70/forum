<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: "MainLayout",
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
        <div class="w-1/2 mx-auto py-4">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
