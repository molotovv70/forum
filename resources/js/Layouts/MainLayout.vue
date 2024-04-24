<script>
import {Link} from "@inertiajs/vue3";
import axios from "axios";

export default {
    name: "MainLayout",
    created() {
        Echo.channel('test-name').listen('.test', res => {
            console.log(res)
        })
    },
    components: {
        Link
    },
    data() {
        return {
            isOpen: false,
        }
    },
    methods: {
        openNotification() {
            this.isOpen = !this.isOpen
            let ids = this.$page.props.auth.notifications.map(notification => {
                return notification.id
            })
            axios.patch('/notifications/update_collection', {
                ids: ids
            }).then(res => {
                this.$page.props.auth.notification_count = res.data.count
            })
        }
    },
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
                <div class="w-1/4 text-right">
                    <div class="relative">
                        <a @click.prevent="openNotification" href="#" >
                            <span class="mr-2">Оповещения</span>
                            <span>{{ this.$page.props.auth.notification_count }}</span>
                        </a>
                        <div v-if="this.$page.props.auth.notifications.length && isOpen" class="absolute w-full">
                            <div v-for="notification in this.$page.props.auth.notifications" class="p-4 border border-b border-gray-300 bg-white text-right">
                                <p>{{ notification.title }}</p>
                                <Link :href="notification.url" class="text-sky-500">Перейти</Link>
                            </div>
                        </div>
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
