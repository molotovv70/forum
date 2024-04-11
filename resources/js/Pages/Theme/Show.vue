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
                content: this.$refs.editor.innerHTML,
                theme_id: this.theme.id,
            }).then(res => {
                this.$refs.editor.innerHTML = '';
                this.theme.messages.push(res.data);
            })
        },
        toggleLike(message) {
            axios.post(`/messages/${message.id}/likes`)
                .then(res => {
                    message.is_liked ? message.likes-- : message.likes++;
                    message.is_liked = !message.is_liked
                })
        },
        quote(content) {

            if (window.getSelection().toString()) {
                content = window.getSelection().toString();
            }

            const editor = this.$refs.editor;
            const oldText = editor.innerHTML;

            const quote = `${oldText} </br> <blockquote >${content}</blockquote> </br>`
            editor.innerHTML = quote;
        },
        answer(message) {
            const title = `<div class="w-full bg-gray-100 border border-gray-200 p-2">Ответ пользователю @${message.user.id} ${message.user.name} от ${message.time}</div>`

            const editor = this.$refs.editor;
            const oldText = editor.innerHTML;

            editor.innerHTML = `${oldText} ${title}<blockquote >${message.content}</blockquote> </br>`
        },

        openComplaint(message) {
            message.body = '';
            message.is_complaint = !message.is_complaint;
        },

        complaint(message) {
            axios.post(`/messages/${message.id}/complaints`, {
                body: message.body,
                theme_id: message.theme_id,
            }).then(res => {
                message.is_not_solved_complaint = res.data.is_not_solved_complaint;
            });
        },

        storeImage(e) {
            const file = e.target.files[0];
            const formData = new FormData();
            formData.append('image', file)

            axios.post('/images', formData)
                .then(res => {
                    const image = `<span hidden>img_id=${res.data.id}</span> <img src="${res.data.url}" />`
                    const editor = this.$refs.editor;
                    const oldText = editor.innerHTML;
                    editor.innerHTML = `${oldText}<br> ${image}<br>`
                })
        },
        strong() {
            if (!window.getSelection().toString()) return

            let selection = window.getSelection();
            let range = selection.getRangeAt(0);

            let strong = document.createElement('strong');
            strong.className = 'some-class'

            range.surroundContents(strong);
        }
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
                    <div class="overflow-hidden w-24 h-24 bg-gray-300 rounded-full mx-auto mb-2">
                        <img class="w-24 h-24" v-if="message.user.avatar_url" :src="message.user.avatar_url" alt="User avatar">
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
                        <div class="mb-4" v-if="message.is_not_solved_complaint">
                            <p class="w-full bg-red-100 border border-red-200 p-2">Ваша жалоба в рассмотрении</p>
                        </div>
                        <p class="mb-4" v-html="message.content"></p>

                        <div class="flex items-center justify-end w-full mb-4">

                            <div class="mr-4">
                                <a @click.prevent="quote(message.content)" href="#" class="inline-block text-sm rounded-lg block bg-sky-600 border border-sky-700 py-2 px-3 text-center text-white">Цитировать</a>
                            </div>
                            <div class="mr-4">
                                <a @click.prevent="answer(message)" href="#" class="inline-block text-sm rounded-lg block bg-indigo-600 border border-indigo-700 py-2 px-3 text-center text-white">Ответить</a>
                            </div>
                            <div class="mr-4">
                                <a @click.prevent="openComplaint(message)" href="#" class="inline-block text-sm rounded-lg block bg-white border border-red-700 py-2 px-3 text-center text-red-600">Пожаловаться</a>
                            </div>
                            <span class="mr-2">
                                {{ message.likes }}
                            </span>
                            <a @click.prevent="toggleLike(message)" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor"
                                     :class="[message.is_liked ? 'fill-sky-600' : '', 'stroke-sky-600 w-6 h-6']"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="flex" v-if="message.is_complaint">
                            <input v-model="message.body" class="p-2 w-5/6 rounded-lg rounded-r-none border border-gray-300" type="text" placeholder="Ваша жалоба">
                            <a @click.prevent="complaint(message)" class="w-1/5 block text-center rounded-l-none bg-red-700 text-white p-2 rounded-lg" href="#">Отправить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-300 p-4">
            <div class="mb-4">
                <h3 class="text-xl mr-4">Добавить сообщение</h3>
            </div>
            <div class="mb-4">
                <div class="bg-gray-50 border border-gray-100 p-2 w-full flex items-center">
                    <div class="mr-2">
                        <a @click="this.$refs.image.click()" class="block w-6" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </a>
                        <input @change="storeImage" ref="image" type="file" hidden="true">
                    </div>
                    <div class="">
                        <a @click.prevent="strong" href="#"><strong>B</strong></a>
                    </div>
                </div>
                <div ref="editor" class="w-full border border-gray-300 p-2 mb-4" contenteditable="true">
                </div>
                <div class="">
                    <a @click.prevent="store" class="block w-1/4 p-2 bg-sky-600 text-white text-center border border-sky-700" href="#">Опубликовать</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="css">


blockquote {
    display: block;
    padding: 4px;
    border-left: 4px solid #2563eb;
    background-color: #f6f6f6;
}

</style>
