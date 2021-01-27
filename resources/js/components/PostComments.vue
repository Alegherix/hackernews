<template>
    <div v-if="comments">
        <p class="mt-4">{{ comments.length }} comments</p>

        <!-- Checking if user is logged in by accessing 'root' instance data, i.e 'new Vue' in app.js  -->
        <div class="mb-4" v-if="$root.user.authenticated">
            <div>
                <label for="comment-body" id="comment-body" class="sr-only">Post comment</label>
                <textarea name="comment-body" v-model="body"
                class="bg-gray-100 border border-solid border-gray-300 w-full mt-2 p-2 rounded-sm dark:border-gray-400 dark:bg-transparent" placeholder="Add a comment"></textarea>
            </div>

            <div>
                <button aria-label="Submit" type="submit" @click.prevent="createComment" class="commentBtn text-sm text-white text-semibold py-1 mt-2 rounded-sm w-1/4 opacity-90">Post comment</button>
            </div>

            <div class="text-red-500">
                {{errors ? errors[0] : ''}}
            </div>
        </div>

        <ul class="">
            <li v-for="comment in comments" :key="comment.id" class="bg-gray-200 my-4 px-2 border dark:bg-transparent dark:border-solid dark:border-white border-opacity-20">
                <div>
                    <!-- Comments content start -->
                    <div>
                        <a :href="'/users/' + comment.user.data.username + '/posts'">
                            <img :src="comment.user.data.avatar" v-bind:alt="comment.user.data.username + ' avatar'" class="w-16 h-auto max-h-16">
                        </a>
                    </div>
                    <div>
                        <a :href="'/users/' + comment.user.data.username + '/posts'" class="text-blue-500">{{ comment.user.data.username }}</a>
                        {{ comment.created_at_human }}
                        <span> : last update {{ comment.updated_at_human }} </span>
                        <!-- <p class="text-xs text-gray-500 text-opacity-50">CREATED: {{ comment.created_at }} | UPDATED: {{ comment.updated_at }}</p> -->
                        <p>{{ comment.body}}</p>
                    </div>
                    <!-- END -->

                    <!-- Comment reply form & delete start -->
                    <div>
                        <ul class="text-sm">
                            <li v-if="$root.user.authenticated" class="text-blue-500">
                                <a href="#" @click.prevent="toggleReplyForm(comment.id)">{{ replyFormVisible === comment.id ? 'Cancel' : 'Reply' }}</a>
                            </li>
                            <li class="text-red-500">
                                <a href="#" v-if="$root.user.id === parseInt(comment.user_id)" @click.prevent="deleteComment(comment.id)">Delete</a>
                            </li>
                        </ul>

                        <div v-if="replyFormVisible === comment.id">
                            <textarea name="comment-reply-body" v-model="replyBody"
                            class="bg-gray-100 border border-solid border-gray-300 w-full mt-2 p-2 rounded-sm dark:border-gray-400 dark:bg-transparent" placeholder="Add a reply"></textarea>
                                <button aria-label="Submit" type="submit" @click.prevent="createReply(comment.id)" class="bg-hacker-orange text-sm text-white text-semibold py-1 mt-2 rounded-sm w-1/4 opacity-90">Post reply</button>
                        </div>
                    </div>
                    <!-- END -->

                    <!-- Comment edit form start -->
                    <div>
                        <ul class="text-sm">
                            <li v-if="$root.user.authenticated" class="text-green-500">
                                <a href="#" @click.prevent="toggleEditForm(comment.id)">{{ editFormVisible === comment.id ? 'Cancel' : 'Edit' }}</a>
                            </li>
                        </ul>

                        <div v-if="editFormVisible === comment.id">
                            <textarea name="comment-edit-body" v-model="editBody"
                            class="bg-gray-100 border border-solid border-gray-300 w-full mt-2 p-2 rounded-sm dark:border-gray-400 dark:bg-transparent" v-bind:placeholder="comment.body"></textarea>
                                <button aria-label="Submit" type="submit" @click.prevent="createEdit(comment.id)" class="bg-hacker-orange text-sm text-white text-semibold py-1 mt-2 rounded-sm w-1/4 opacity-90">Post edit</button>
                        </div>
                    </div>
                    <!-- END -->

                    <!-- Comment replies content start -->
                    <li v-for="reply in comment.replies.data" :key="reply.id" class="ml-8 bg-gray-200 my-4 pl-4 border-l-2 border-red-500 dark:bg-transparent dark:border-solid border-opacity-50">
                        <div>
                            <a :href="'/users/' + reply.user.data.username + '/posts'">
                                <img :src="reply.user.data.avatar" v-bind:alt="reply.user.data.username + ' avatar'" class="w-16 h-auto max-h-16">
                            </a>
                        </div>

                        <div>
                            <a :href="'/users/' + reply.user.data.username + '/posts'" class="text-blue-500">{{ comment.user.data.username }}</a>
                            {{ reply.created_at_human }}
                            <span> : last update {{ reply.updated_at_human }} </span>
                            <p>{{ reply.body}}</p>
                            <!-- <p class="text-xs text-gray-500 text-opacity-50">CREATED: {{ reply.created_at }} | UPDATED: {{ reply.updated_at }}</p> -->
                        </div>
                        <!-- END -->

                        <!-- Comment reply delete & edit form start -->
                        <div class="">
                            <ul class="text-sm">
                                <li class="text-red-500">
                                    <a href="#" v-if="$root.user.id === parseInt(reply.user_id)" @click.prevent="deleteComment(reply.id)">Delete</a>
                                </li>
                            </ul>

                            <ul class="text-sm">
                                <li v-if="$root.user.authenticated" class="text-green-500">
                                    <a href="#" @click.prevent="toggleEditForm(reply.id)">{{ editFormVisible === reply.id ? 'Cancel' : 'Edit' }}</a>
                                </li>
                            </ul>

                            <div v-if="editFormVisible === reply.id">
                                <textarea name="comment-edit-body" v-model="editBody"
                                class="bg-gray-100 border border-solid border-gray-300 w-full mt-2 p-2 rounded-sm dark:border-gray-400 dark:bg-transparent" v-bind:placeholder="reply.body"></textarea>
                                    <button aria-label="Submit" type="submit" @click.prevent="createEdit(reply.id)" class="bg-hacker-orange text-sm text-white text-semibold py-1 mt-2 rounded-sm w-1/4 opacity-90">Post edit</button>
                            </div>
                        </div>
                        <!-- END -->
                    </li>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
	data() {
		return{
            comments: [], // Will store comments of instance
            body: null, // Post comment body
            replyBody: null,
            editBody: null,
            replyFormVisible: null,
            errors: [], // Will store validation errors
            editFormVisible: null,
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
        createComment () {
            this.$http.post(`/posts/${this.postId}/comments`, {
                body: this.body
            }).then(response => {
                this.comments.unshift(response.data.data);
                this.body = null; // Clear comment content from input field
                this.errors = null; // Clear error message
            }, response => {
                console.log('NOPE');
            });
		},
        createReply (commentId) {
            console.log(commentId)
            this.$http.post(`/posts/${this.postId}/comments`, {
                body: this.replyBody,
                reply_id: commentId
            }).then(response => {
                this.comments.map((comment, index) => {
                    if (comment.id === commentId) {
                        this.comments[index].replies.data.push(response.data.data);
                    }
                });
                this.replyBody = null;
                this.replyFormVisible = null; // Close reply window
                this.errors = null;
            }, response => {
                this.errors = response.body.errors.body
            });
        },
        toggleReplyForm (commentId) {
            this.replyBody = null;
            // Check if selected form is the current open and close if true
            // Others handled by v-if in template: line 44
            if (this.replyFormVisible === commentId) {
                this.replyFormVisible = null;
                return;
            };

            this.replyFormVisible = commentId;
        },
        deleteComment (commentId) {
            if (!confirm('You sure about that?')) {
                return;
            }

            this.deleteById(commentId);
            this.$http.delete(`${this.postId}/comments/${commentId}`)
		},
        deleteById (commentId) {
            this.comments.map((comment, index) => {
                    if (comment.id === commentId) {
                        this.comments.splice(index, 1);
                        return;
                    }

            comment.replies.data.map((reply, replyIndex) => {
                    if (reply.id === commentId) {
                        this.comments[index].replies.data.splice(replyIndex, 1);
                        return;
                    }
                })
            });
		},

		// Yes, these should be refactored.
        createEdit (commentId) {
            this.$http.patch(`${this.postId}/comments/${commentId}`, {
                body: this.editBody
            }).then(response => {
                console.log(response)
                this.editById(commentId, response);
                this.editBody = null;
                this.editFormVisible = null;
            }, response => {
                console.log('OH NO');
                // this.errors = response.body.errors.body
            });
        },
        editById (commentId, response) {
            this.comments.map((comment, index) => {
                    if (comment.id === commentId) {
                        console.log('Before edit')
                        console.log(this.comments)

                        this.comments[index].body = response.body.body;
                        this.comments[index].updated_at = response.body.updated_at;
                        this.comments[index].updated_at_human = '< 1 minute ago';

                        console.log('After edit')
                        console.log(this.comments)
                        return;
                    }

            comment.replies.data.map((reply, replyIndex) => {
                    if (reply.id === commentId) {

                        console.log(response.body.body)
                        console.log(reply.body)
                        console.log(this.comments[index].replies.data[replyIndex].body)

                        this.comments[index].replies.data[replyIndex].body = response.body.body;
                        this.comments[index].replies.data[replyIndex].updated_at = response.body.updated_at;
                        this.comments[index].replies.data[replyIndex].updated_at_human = '< 1 minute ago';
                        return;
                    }
                })
            });
        },
        toggleEditForm (commentId) {
            this.editBody = null;
            // Check if selected form is the current open and close if true
            // Others handled by v-if in template: line 44
            if (this.editFormVisible === commentId) {
                this.editFormVisible = null;
                return;
            };

            this.editFormVisible = commentId;
        },
	},
	mounted() {
		console.log('hello hello yess');
		this.getComments();
	}
}
</script>
