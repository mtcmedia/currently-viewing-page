<template>
    <div class="currentlyViewingPageWrapper">
        <ul class="users list-group">
            <li class="list-group-item" v-for="user in users">
                <span>
                    {{ user.name }}
                </span>
            </li>
        </ul>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        props: {
            url: {
                type: String,
                required: false,
            }
        },
        data() {
            return {
                watcher: {},
                users: {},
                view_url: '',
            }
        },
        mounted() {
            this.view_url = this.url ? this.url : window.location.href;
            this.update();
            this.startWatching();
        },
        methods: {
            startWatching() {
                this.watcher = setInterval(() => {
                    this.update();
                }, 60000); // 60 seconds
            },
            update() {
                axios.post('/api/currently-viewing-page', { url: this.view_url })
                    .then((response) => {
                        this.users = response.data.data;
                    });
            }
        }

    }
</script>
<style>
    .currentlyViewingPageWrapper {
        position: fixed;
        bottom: 10px;
        right: 20px;
        box-shadow: 4px 10px 26px -10px rgba(0,0,0,0.5)
    }
</style>