// 'use strict';

// function showSection(section) {
//     // Скрываем все секции
//     const postList = document.getElementById('с_post_list');
//     const feedbackList = document.getElementById('с_otz_list');
//     const newsList = document.getElementById('с_news_list');
//     const userTable = document.getElementById('table_user');
//     const sobList = document.getElementById('sob_list');
//     const postTab = document.getElementById('post_tab');
//     const feedbackTab = document.getElementById('feedback_tab');
//     const newTab = document.getElementById('news_tab');
//     const userTab = document.getElementById('user_tab');
//     const sobTab = document.getElementById('sob_tab');

//     postList.style.display = 'none'; 
//     feedbackList.style.display = 'none'; 
//     newsList.style.display = 'none'; 
//     userTable.style.display = 'none';
//     sobList.style.display = 'none';  

    
//     switch (section) {
//         case 'posts':
//             postList.style.display = 'flex';
//             postTab.classList.add('activee');

//             feedbackTab.classList.remove('activee');
//             sobTab.classList.remove('activee');
//             newTab.classList.remove('activee');
//             userTab.classList.remove('activee');
//             break;
//         case 'feedbacks':
//             feedbackList.style.display = 'flex';
//             feedbackTab.classList.add('activee');

//             postTab.classList.remove('activee');
//             sobTab.classList.remove('activee');
//             newTab.classList.remove('activee');
//             userTab.classList.remove('activee');
            
//             break;
//         case 'news':
//             newsList.style.display = 'flex';
//             newTab.classList.add('activee');

//             feedbackTab.classList.remove('activee');
//             postTab.classList.remove('activee');
//             userTab.classList.remove('activee');
//             sobTab.classList.remove('activee');
//             break;
//         case 'user':
//             userTable.style.display = 'block';
//             userTab.classList.add('activee');

//             feedbackTab.classList.remove('activee');
//             postTab.classList.remove('activee');
//             newTab.classList.remove('activee');
//             sobTab.classList.remove('activee');

//             break;

//         case 'sob':
//             sobList.style.display = 'flex';
//             feedbackTab.classList.remove('activee');
//             postTab.classList.remove('activee');
//             newTab.classList.remove('activee');
//             userTab.classList.remove('activee');
//             sobTab.classList.add('activee');

//             break;
//         default:
//             break;
//     }
// }

// window.onload = function() {
 
//     showSection('posts');
// };
