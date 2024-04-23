<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "MainLayout",
    created() {
        Echo.channel('test-name').listen('.test', res => {
            console.log(res)
        })
    },
    components: {
        Link
    }
}
</script>

<template>
    <div class="">
        <div class="bg-white border-b border-gray-300 py-4">
            <div class="w-1/2 mx-auto flex items-center justify-between">
                <div class="">
                    <Link :href="route('sections.index')" class="mr-4">Форум</Link>
                    <Link :href="route('users.personal')" class="mr-4">Личный Кабинет</Link>
                    <Link :href="route('admin.main.index')">Админка</Link>
                </div>
                <div class="">
                    <div class="">
                        <a href="#" class="flex items-center">
                            <p class="mr-2">Оповещения</p>
                            <span>0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2 mx-auto py-4">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
