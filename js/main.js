// Смена текста в статистике

const StatInfoMoto = document.querySelector('.statbtn.moto');
const StatInfoCar = document.querySelector('.statbtn.car');
const StatInfoTruck = document.querySelector('.statbtn.truck');

StatInfoMoto.addEventListener('click', () => {
  document.getElementById("stat-info-text").textContent="Изучите мир мотоциклов и получите навыки, необходимые для безопасного и уверенного управления на двух колесах. Наши курсы помогут вам освоить основные техники вождения, совершенствовать свои навыки и обеспечивать безопасность на дороге."; 
});

StatInfoCar.addEventListener('click', () => {
  document.getElementById("stat-info-text").textContent="Изучите правила дорожного движения и приобретите навыки управления легковым транспортом. Наши курсы помогут вам освоить основные маневры, разобраться с дорожными знаками и сигналами, а также научат вас соблюдать безопасность на дороге."; 
});

StatInfoTruck.addEventListener('click', () => {
  document.getElementById("stat-info-text").textContent="Приготовьтесь к управлению грузовым транспортом с нашими специализированными курсами. Получите знания о правильной загрузке и разгрузке грузовых автомобилей, управлении длинными и тяжелыми транспортными средствами."; 
});

// Статистика, смена кнопок

const btnmoto = document.querySelector(".statbtn.moto"),
      btncar = document.querySelector(".statbtn.car"),
      btntruck = document.querySelector(".statbtn.truck")

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

// Вывод числа зарегестрированных пользователей

document.getElementById("UsersCount").textContent = totalUsers;

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