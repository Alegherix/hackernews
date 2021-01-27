require('./bootstrap');

import Vue from 'vue'
import VueResource from 'vue-resource';

window.Vue = require('vue').default;
Vue.use(VueResource);
require('vue-resource');

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
    next();
});

Vue.component('hello-world', require('./components/HelloWorld.vue').default);
Vue.component('post-comments', require('./components/PostComments.vue').default);

const app = new Vue({
	el: '#app',
	data: window.hackernews
});



// const { post } = require("jquery");

// async function enableUpvoteFunctionality() {
//     const upvoteIcon = document.querySelector(".upvoteIcon");
//     const postId = upvoteIcon.dataset.post_id;

//     if (upvoteIcon) {
//         upvoteIcon.addEventListener("click", async e => {
//             const res = await fetch("/api/posts/like", {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     "credentials": 'include'
//                 },
//                 body: JSON.stringify({ name: 'Eka', isHungry: true, "post_id": postId})
//             });
//             const data = await res.json();
//             console.log(data);
//         });
//     }
// }
// enableUpvoteFunctionality();


// function enableEditPost(){
//     document.querySelectorAll(".editComment").forEach(elem => {
//         elem.addEventListener("click", e => {
//             const container = elem.parentNode.parentNode;
//             container.querySelector(".commentParagraph").classList.toggle("hide");
//             container.querySelector(".updateCommentForm").classList.toggle("hide");
//         })
//     })
// }
// enableEditPost();
