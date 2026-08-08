let nextButton = document.getElementById('next');
let prevButton = document.getElementById('prev');
let backButton = document.getElementById('back');
let seeMoreButtons = document.querySelectorAll('.seeMore');
let carousel = document.querySelector('.carousel');
let listHTML = document.querySelector('.carousel .list');

nextButton.onclick = function(){
    showSlider('next');
}
prevButton.onclick = function(){
    showSlider('prev');
}
let unacceptclick;
const showSlider = (type) => {
    nextButton.style.pointerEvents = 'none';
    prevButton.style.pointerEvents = 'none';

    carousel.classList.remove('prev', 'next')
    let items = document.querySelectorAll('.carousel .list .item');
    if (type === 'next') {
        listHTML.appendChild(items[0]);
        carousel.classList.add('next')
    }else{
        let positionLast = items.length -1;
        listHTML.prepend(items[positionLast]);
        carousel.classList.add('prev');
    }

    clearTimeout(unacceptclick);
    unacceptclick = setTimeout(() =>{
        nextButton.style.pointerEvents = 'auto';
        prevButton.style.pointerEvents = 'auto';
    },2000);
}

seeMoreButtons.forEach(button =>{
    button.onclick = function(){
        carousel.classList.add('showdetail')
    }
})

backButton.onclick = function(){
    carousel.classList.remove('showdetail');
}

























// js/index.js

document.addEventListener('DOMContentLoaded', () => {
    // 选择所有具有类名 'btn-03' 的按钮
    const buttons = document.querySelectorAll('button.btn-03');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // 获取当前按钮的 data-audio-id 属性值
            const audioId = button.getAttribute('data-audio-id');

            if (audioId) {
                // 构建跳转URL，包含音频ID作为查询参数
                const targetUrl = `questionnaire.html?audio=${encodeURIComponent(audioId)}`;
                window.location.href = targetUrl;
            } else {
                alert('无法识别音频ID,请重试。');
            }
        });
    });
});

document.getElementById("dataForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const data = new FormData(e.target);
    const response = await fetch("http://8.134.237.125/submit.php", {
        method: "POST",
        body: data,  // 直接传递 FormData 对象
    });
    if (response.ok) {
        alert("Data submitted successfully");
    } else {
        alert("Error submitting data");
    }
});

