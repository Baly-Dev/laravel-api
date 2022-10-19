<template>
    <section class="container">
        <h1 class="mb-5">Posts list</h1>

        <div class="row">
            <div class="card col-12 mb-5" v-for="(post, postIndex) in posts" :key="postIndex">
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text">{{post.content}}</p>
                    <p class="card-text">{{post.category ? post.category.name : '-'}}</p>
                    <p class="card-text">
                        <span v-for="(tag, tagIndex) in post.tag" :key="tagIndex">{{post.tag.length ? post.tag + '; ' : '-'}}</span>
                    </p>
                </div>
            </div>

            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="(currentPage == 1 ? 'disabled' : '')"><a class="page-link" href="#" @click.prevent="getPosts(currentPage - 1)">Previous</a></li>

                    <li v-for="(page, pageIndex) in pages" :key="pageIndex" 
                    class="page-item" :class="(currentPage == page) ? 'disabled' : ''">
                        <a class="page-link" href="#" @click.prevent="getPosts(page)">{{page}}</a>
                    </li>

                    <li class="page-item" :class="(currentPage == lastPage) ? 'disabled' : ''"><a class="page-link" href="#" @click.prevent="getPosts(currentPage + 1)">Next</a></li>
                </ul>
            </nav>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'TheMain',
        data() {
            return {
                posts: [],
                currentPage: 1,
                lastPage: null,
                pages: []
            }
        },
        methods: {
            getPosts(page) {
                axios.get('http://localhost:8000/api/posts', {
                    params: {
                        page: page
                    }
                })
                .then((response) => {
                    this.posts = response.data.results.data;
                    this.currentPage = response.data.results.current_page;
                    this.lastPage = response.data.results.last_page;
                    this.getPages(this.lastPage);
                });
            },
            getPages(lastPage) {
                this.pages = [];
                for (let i = 1; i <= lastPage; i++) {
                    this.pages.push(i);
                }
            }
        },
        mounted() {
            this.getPosts(1);
        }
    }
</script>

<style scoped lang="scss">

</style>