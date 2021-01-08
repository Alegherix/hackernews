const { default: Axios } = require("axios");

async function enableUpvoteFunctionality(id) {
    const upvoteIcon = document.querySelector(".upvoteIcon");
    if (upvoteIcon) {
        upvoteIcon.addEventListener("click", async e => {
            const id = e.target.dataset.post_id;
            const res = await fetch(`api/posts/upvote`, {
                method: "POST"
                // headers: {
                //     "Content-Type": "application/json"
                // },
                // body: {
                //     id
                // }
            });
        });
    }
}
