'use strict';
function showSection(section) {
    const postList = document.getElementById('z_post_list');
    const feedbackList = document.getElementById('z_otz_list');
    const postTab = document.getElementById('post_tab');
    const feedbackTab = document.getElementById('feedback_tab');

    if (section === 'posts') {
        postList.classList.remove('hidden');
        feedbackList.classList.add('hidden');
        postTab.classList.add('activee');
        feedbackTab.classList.remove('activee');
    } else {
        postList.classList.add('hidden');
        feedbackList.classList.remove('hidden');
        postTab.classList.remove('activee');
        feedbackTab.classList.add('activee');
    }
}

window.onload = function() {
 
    showSection('posts');
};




