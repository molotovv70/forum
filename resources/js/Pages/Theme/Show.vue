<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Show",
    props: {
        theme: Object,
    },
    data() {
        return {
            content: '',
        }
    },
    components: {
        Link
    },

    methods: {
        store() {
            axios.post('/messages', {
                content: this.$refs.editor.innerText,
                theme_id: this.theme.id,
            }).then(res => {
                this.$refs.editor.innerText = '';
            })
        },
    },

    layout: MainLayout
}
</script>

<template>
    <div class="">
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">{{ theme.title }}</h3>
        </div>
        <div v-if="theme.messages.length">
            <div v-for="message in theme.messages" class="flex bg-white border-gray-300">
                <div class="p-4 w-1/6 border border-gray-300">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mx-auto mb-2">

                    </div>
                    <div class="text-center">
                        <h3>{{ message.user.name }}</h3>
                    </div>
                </div>
                <div class="p-4 w-5/6">
                    <div class="mb-2">
                        <p class="text-sm italic" v-html="message.time"></p>
                    </div>
                    <div class="">
                        <p v-html="message.content"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-300 p-4">
            <div class="mb-4">
                <h3 class="text-xl mr-4">Добавить сообщение</h3>
            </div>
            <div class="">
                <div ref="editor" class="w-full border border-gray-300 p-2 mb-4" contenteditable="true">
                </div>
                <div class="">
                    <a @click.prevent="store" class="block w-1/4 p-2 bg-sky-600 text-white text-center border border-sky-700" href="#">Опубликовать</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
