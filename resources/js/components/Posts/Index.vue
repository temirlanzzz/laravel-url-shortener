<template>
    <div class="discord-card">
        <div class="discord-card-header">Short Link Generator</div>
        <div class="discord-card-content">
            <form @submit.prevent="generateShortLink">
                <div class="discord-form-group">
                    <input type="text" v-model="link" class="discord-form-control" placeholder="Enter URL">
                    <button class="discord-button discord-button-success" type="submit">Generate Shorten Link</button>
                </div>
            </form>
            <div class="discord-table-container">
                <table class="discord-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="row in shortLinks" :key="row.id">
                        <td>{{ row.id }}</td>
                        <td><a :href="getShortLink(row.code)" target="_blank">{{ getShortLink(row.code) }}</a></td>
                        <td>{{ row.link }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style>
.discord-card {
    background-color: #36393f;
    color: #fff;
    border-radius: 8px;
    box-shadow: 0 1px 0 rgba(0,0,0,.05);
    margin-bottom: 10px;
}

.discord-card-header {
    background-color: #2f3136;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    font-weight: bold;
    padding: 10px;
}

.discord-card-content {
    padding: 10px;
}

.discord-form-group {
    display: flex;
    align-items: center;
}

.discord-form-control {
    background-color: #40444b;
    border: none;
    border-radius: 3px;
    color: #fff;
    font-size: 16px;
    height: 36px;
    padding: 0 10px;
}

.discord-button {
    background-color: #4f545c;
    border: none;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
    height: 36px;
    margin-left: 10px;
    padding: 0 16px;
}

.discord-button-success {
    background-color: #43b581;
}

.discord-table-container {
    overflow-x: auto;
}

.discord-table {
    border-collapse: collapse;
    width: 100%;
}

.discord-table th,
.discord-table td {
    padding: 8px;
    text-align: left;
}

.discord-table th {
    background-color: #2f3136;
    font-weight: bold;
}

.discord-table tbody tr:nth-child(odd) {
    background-color: #40444b;
}

.discord-table tbody tr:hover {
    background-color: #5c5f66;
}
</style>

<script>
export default {
    data() {
        return {
            link: '',
            shortLinks: []
        }
    },

    methods: {
        generateShortLink() {
            axios.post('/generate-shorten-link-json', {
                link: this.link
            }).then(response => {
                this.shortLinks.unshift(response.data);
                this.link = '';
            }).catch(error => {
                console.log(error);
            });
        },

        getShortLink(code) {
            return window.location.origin + '/' + code;
        },

        fetchShortLinks() {
            axios.get('/generate-shorten-link-json').then(response => {
                this.shortLinks = response.data;
            }).catch(error => {
                console.log(error);
            });
        }
    },

    mounted() {
        this.fetchShortLinks();
    }
}
</script>
