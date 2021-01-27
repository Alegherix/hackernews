<template>
	<div v-if="comments">
		<p>hello hello hello</p>
		<ul class="">
            <li v-for="comment in comments" :key="comment.id" class="bg-gray-200 my-4 px-2 border dark:bg-transparent dark:border-solid dark:border-white border-opacity-20">
				<p>hello</p>
			</li>
		</ul>
	</div>
</template>

<script>
export default {
	data() {
		return{
			comments: [],
		}
	},
	props: {
        postId: null,
	},
	methods: {
        getComments() {
            this.$http.get(`/posts/${this.postId}/comments`).then(response => {
                this.comments = response.body.data;
            });
        },
	},
	mounted() {
		console.log('hello hello yess');
		this.getComments();
	}
}
</script>
