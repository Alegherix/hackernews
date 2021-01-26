require('./bootstrap');

import Vue from 'vue'

window.Vue = require('vue').default;

Vue.component('hello-world', require('./components/HelloWorld.vue').default);
Vue.component('post-comments', require('./components/PostComments.vue').default);

const app = new Vue({
    el: '#app',
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