document.addEventListener("DOMContentLoaded", function () {

    // Извлекаем значение параметра category из URL
    const urlParams = new URLSearchParams(window.location.search);
    let currentCategory = urlParams.get('category') || localStorage.getItem('currentCategory') || 'moto';
    localStorage.setItem('currentCategory', currentCategory);

    // Переключение кнопок категорий
    const btnmoto = document.querySelector(".nav-item.moto"),
    btncar = document.querySelector(".nav-item.car"),
    btntruck = document.querySelector(".nav-item.truck")
  
    btnmoto.addEventListener("click", ()=>{
    btnmoto.classList.add("active");
    btncar.classList.remove("active");
    btntruck.classList.remove("active");
    });
  
    btncar.addEventListener("click", ()=>{
    btnmoto.classList.remove("active");
    btncar.classList.add("active");
    btntruck.classList.remove("active");
    });
  
    btntruck.addEventListener("click", ()=>{
    btnmoto.classList.remove("active");
    btncar.classList.remove("active");
    btntruck.classList.add("active");
    });

    if (currentCategory == 'moto'){
        btnmoto.classList.add("active");
        btncar.classList.remove("active");
        btntruck.classList.remove("active");
      } else if (currentCategory == 'car'){
        btnmoto.classList.remove("active");
        btncar.classList.add("active");
        btntruck.classList.remove("active");
      } else if (currentCategory == 'truck'){
        btnmoto.classList.remove("active");
        btncar.classList.remove("active");
        btntruck.classList.add("active");
      }

    // Запрашиваем данные для выбранной категории
    fetchPosts(currentCategory);

    // Обработчики событий для кнопок категорий
    document.getElementById('btnMoto').addEventListener('click', function () {
        currentCategory = 'moto';
        updateAndFetchPosts(currentCategory);
    });

    document.getElementById('btnCar').addEventListener('click', function () {
        currentCategory = 'car';
        updateAndFetchPosts(currentCategory);
    });

    document.getElementById('btnTruck').addEventListener('click', function () {
        currentCategory = 'truck';
        updateAndFetchPosts(currentCategory);
    });

    function updateAndFetchPosts(currentCategory) {
        // Обновляем значение в localStorage
        
        // Удаляем параметр из URL
        history.replaceState({}, document.title, window.location.pathname);
        // Запрашиваем данные для выбранной категории
        fetchPosts(currentCategory);
    }
});

function fetchPosts(currentCategory) {
    // Очищаем содержимое контейнера перед запросом новых постов
    const postsContainer = document.getElementById('posts-container');
    postsContainer.innerHTML = '<div style="height: 100vh;"></div>';

    fetch(`api/get_posts.php?category=${currentCategory}`)
        .then(response => response.json())
        .then(posts => displayPosts(posts, currentCategory));
}

function displayPosts(posts, currentCategory) {
    const postsContainer = document.getElementById('posts-container');
    postsContainer.innerHTML = '';
    posts.forEach(post => {
        const posterElement = createPosterElement(post, currentCategory);
        postsContainer.appendChild(posterElement);
    });
}

function createPosterElement(post, currentCategory) {
    const poster = document.createElement('div');
    poster.classList.add('poster');

    // Создаем div-контейнер для изображения
    const imageContainer = document.createElement('div');
    imageContainer.classList.add('poster-img');
    imageContainer.style.backgroundRepeat = 'space';
    imageContainer.style.backgroundSize = '300px 45%'
    imageContainer.style.backgroundPosition = 'center';

    if (currentCategory == 'moto') {
        imageContainer.classList.add('moto');
    } else if (currentCategory == 'car') {
        imageContainer.classList.add('car');
    } else if (currentCategory == 'truck') {
        imageContainer.classList.add('truck');
    }
    
    const mainDiv = document.createElement('div');
    mainDiv.classList.add('poster-main');

    const titleDiv = document.createElement('div');
    titleDiv.classList.add('poster-title');
    const titleP = document.createElement('p');
    titleP.textContent = post.title;
    titleDiv.appendChild(titleP);

    const image = document.createElement('img');
    image.classList.add('poster-main-img');
    image.src = post.image_url;
    image.alt = "";

    const textDiv = document.createElement('div');
    textDiv.classList.add('poster-text');
    const textP = document.createElement('p');
    textP.innerHTML = post.text;
    textDiv.appendChild(textP);

    const likesDiv = document.createElement('div');
    likesDiv.classList.add('poster-likes');
    likesDiv.dataset.postId = post.id;
    likesDiv.dataset.liked = post.liked;
    const likesImage = document.createElement('img');
    likesImage.src = "images/Likes.svg";
    likesImage.alt = "";
    const likeCount = document.createElement('span');
    likeCount.classList.add('like-count');
    likeCount.textContent = post.likes;
    likesDiv.appendChild(likesImage);
    likesDiv.appendChild(likeCount);

    mainDiv.appendChild(titleDiv);
    mainDiv.appendChild(image);
    mainDiv.appendChild(textDiv);
    mainDiv.appendChild(likesDiv);

    const commentsBoxDiv = document.createElement('div');
    commentsBoxDiv.classList.add('poster-comments-box');

    const commentsTitleP = document.createElement('p');
    commentsTitleP.classList.add('comments-title');
    commentsTitleP.textContent = "Комментарии";

    const commentsDiv = document.createElement('div');
    commentsDiv.classList.add('poster-comments');
    post.comments.forEach(comment => {
        const commentP = document.createElement('p');
        commentP.innerHTML = `<b id="user-name">${comment.user_name}</b>: ${comment.text}`;
        commentsDiv.appendChild(commentP);
    });

    const inputBoxDiv = document.createElement('div');
    inputBoxDiv.classList.add('poster-inputBox');
    inputBoxDiv.dataset.postId = post.id;
    const input = document.createElement('input');
    input.classList.add('poster-input');
    input.type = "text";
    input.placeholder = "Написать комментарий...";
    const sendImage = document.createElement('img');
    sendImage.classList.add('send-comment');
    sendImage.src = "images/Send.svg";
    sendImage.alt = "";
    inputBoxDiv.appendChild(input);
    inputBoxDiv.appendChild(sendImage);

    commentsBoxDiv.appendChild(commentsTitleP);
    commentsBoxDiv.appendChild(commentsDiv);
    commentsBoxDiv.appendChild(inputBoxDiv);

    poster.appendChild(mainDiv);
    poster.appendChild(commentsBoxDiv);
    poster.appendChild(imageContainer);

    return poster;
}