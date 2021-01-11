const { post } = require("jquery");

async function enableUpvoteFunctionality() {
    const upvoteIcon = document.querySelector(".upvoteIcon");
    const postId = upvoteIcon.dataset.post_id;

    if (upvoteIcon) {
        upvoteIcon.addEventListener("click", async e => {     
            const res = await fetch("/api/posts/like", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    credentials: 'include'
                },
                body: JSON.stringify({ name: 'Eka', isHungry: true, "post_id": postId})
            });
            const data = await res.json();
            console.log(data);
        });
    }
}
enableUpvoteFunctionality();

  
