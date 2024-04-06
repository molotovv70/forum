<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Personal",

    props: [
        'user'
    ],

    data() {
        return {
            content: '',
        }
    },
    components: {
        Link
    },

    methods: {
        storeAvatar(e) {
            let file = e.target.files[0];
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_method', 'patch');

            axios.post('/users/personal', formData)
                .then(res => {
                    this.user.avatar_url = res.data.avatar_url
                })
        }
    },

    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Личный кабинет</h3>
        </div>
        <div class="bg-white border border-gray-300 p-4">
            <div class="mb-4">
                <p class="mb-2">
                    Приветствую, {{ user.name }}
                </p>
                <p class="mb-2">
                    Сменить аватар
                </p>
                <a href="#" @click.prevent="this.$refs.avatar_load.click()" class="block w-24 h-24 rounded-full bg-gray-300">
                    <img v-if="user.avatar_url" :src="user.avatar_url" :alt="user.name">
                </a>
                <div hidden class="">
                    <input @change="storeAvatar" ref="avatar_load" type="file">
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
