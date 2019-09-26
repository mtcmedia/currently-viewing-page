<template>
    <div class="currentlyViewingPageWrapper">
        <ul class="users list-group">
            <li v-for="user in users">
                <span>
                    {{ user.name }}
                </span>
            </li>>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                watcher: {},
                users: {},
            }
        },
        mounted() {
            this.startWatching();
        },
        methods: {
            startWatching() {
                this.watcher = setInterval(() => {
                    this.update();
                }, 60000); // 60 seconds
            },
            update() {
                axios.post('/api/currently-viewing-page')
                    .then((response) => {
                        this.users = response.data;
                    });
            }
        }

    }
</script>
<style>
    .currentlyViewingPageWrapper {

    }
</style>