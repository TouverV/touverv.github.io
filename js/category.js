// Путь к регистрации

function redirectToRegistration() {
  window.location.href = 'auth.php';
}

// Выпадающее меню профиля 

var userBtn = document.getElementById('user-btn');
var userMenu = document.getElementById('user-menu');

document.addEventListener('click', function (event) {
  var targetElement = event.target;
  
  if (!userBtn.contains(targetElement) && !userMenu.contains(targetElement)) {
    userMenu.classList.add('hidden');
  }
});

userBtn.addEventListener('click', function () {
  userMenu.classList.toggle('hidden');
});

// Обработка лайков

document.getElementById('posts-container').addEventListener('click', function (event) {
  const target = event.target;

  // Проверяем, был ли клик выполнен внутри .poster-likes
  if (target.closest('.poster-likes')) {
    const likesDiv = target.closest('.poster-likes');
    const postId = likesDiv.dataset.postId;
    const likeCountElement = likesDiv.querySelector('.like-count');
    const isLiked = likesDiv.dataset.liked === 'true';
    if (isLiked) {
      // Если уже лайкнуто, уменьшаем количество лайков и устанавливаем data-liked в false
      target.closest('.poster-likes').classList.remove("active");
      updateLikes(postId, false)
        .then(newLikes => {
          likeCountElement.textContent = newLikes;
          likesDiv.dataset.liked = 'false';
        })
        .catch(error => {
          console.error('Error updating likes:', error);
        });
    } else {
      // Если не лайкнуто, увеличиваем количество лайков и устанавливаем data-liked в true
      target.closest('.poster-likes').classList.add("active");
      updateLikes(postId, true)
        .then(newLikes => {
          likeCountElement.textContent = newLikes;
          likesDiv.dataset.liked = 'true';
        })
        .catch(error => {
          console.error('Error updating likes:', error);
        });
    }
  }
});

function updateLikes(postId, like) {
  // Возвращает Promise, который разрешается с новым количеством лайков после обновления на сервере
  return new Promise((resolve, reject) => {
    fetch('../api/update_likes.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        post_id: postId,
        like: like,
      }),
    })
      .then(response => response.json())
      .then(data => {
        // Предполагая, что сервер возвращает новое количество лайков
        resolve(data.new_likes);
      })
      .catch(error => {
        // Если произошла ошибка при обновлении лайков на сервере
        reject(error);
      });
  });
}

// Добавление комментариев

document.getElementById('posts-container').addEventListener('click', function (event) {
  const target = event.target;

  if (target.closest('.poster-inputBox')) {
      const commentBox = target.closest('.poster-inputBox');
      const postId = commentBox.dataset.postId;
      const input = commentBox.querySelector('.poster-input');
      // const sendButton = commentBox.querySelector('.send-comment');
      const commentText = input.value;

      // Проверяем, был ли клик выполнен внутри .send-comment
      if (target.closest('.send-comment')){
        if (commentText !== '') {
          input.value = '';
          // Отправляем комментарий на сервер
          addComment(postId, commentText)
          // displayComments(postId, commentText);
      }}
  }
});

function addComment(postId, commentText) {
    fetch('./api/add_comments.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        post_id: postId,
        commentText: commentText,
      }),
    })}

// Переключение темы

const ThemeButton = document.querySelector('.theme-button');

const theme = localStorage.getItem('theme');

if (theme) {
  document.body.classList.add('dark-mode');
  document.getElementById("ThemeButtonId").textContent="☀️"; 
}

ThemeButton.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  if (document.body.classList.contains('dark-mode')) {
    localStorage.setItem('theme', 'dark-mode');
    document.getElementById("ThemeButtonId").textContent="☀️"; 
  }
  else {
    localStorage.removeItem('theme');
    document.getElementById("ThemeButtonId").textContent="🌑";
  }
});