//Menu responsive
$(".menu-toggle-btn").click(() => {
    $(".menu-toggle-btn").toggleClass("fa-times");
    $(".menu-toggle-btn").toggleClass("fa-bars");
    $(".navigation-menu").toggleClass("active");
})
//load more products main
$(document).ready(() => {
    let minProducts = 4;
    let long = $(".products-images").length;
    $(".products-images").slice(0,minProducts).fadeIn();
    $(".load-more").click(()=>{       
        minProducts +=4;
        $(".products-images").slice(0,minProducts).fadeIn();
        if(minProducts >= long) $(".load-more").fadeOut(); 
    })
});

//Whatsapp Button
let locRegex = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)\//gi
let myUrl = location.href.match(locRegex);
$(function () {
    $('#myButton').floatingWhatsApp({
        phone: '573158957774',
        popupMessage: 'Hola, ¿Como podemos ayudarte?',
        message: "Me gustaría ordenar un producto de ustedes",
        showPopup: true,
        showOnIE: true,
        headerTitle: 'David!',
        headerColor: '#25D366',
        backgroundColor: '#25D366',
        buttonImage: `<img src="${myUrl}assets/img/whatsapp.svg" />`
    });
});

//top Button
$(window).scroll(function(){
    if($(this).scrollTop() > 150){
        $(".gotopbtn").addClass("active");
    }else{
        $(".gotopbtn").removeClass("active");
    }
})
$(".gotopbtn").click(function(){
    $("html, body").animate({scrollTop:0})
});

//gallery
$(".gallery").magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery:{
        enabled: true
    }
})
//sweet alert

window.addEventListener('message', event => {
    if(event.detail){
        Swal.fire({
            position: 'top-end',
            icon: event.detail.type,
            title: event.detail.text,
            showConfirmButton: false,
            timer: 1500
        })
    }    
});

window.addEventListener('close-profile-modal', event =>{
    if($('#updateProfile')){
        $('#updateProfile').modal('hide');
    }
})

// slide accesories
$(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        auto:true,
        pauseOnHover: true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
    
    
});
//Modal sale
const modalSale = document.querySelector('.modal-sale-container');
const closeModal = () => {
    modalSale.classList.remove("show-modal");
    modalSale.classList.add("hide-modal");
    document.body.style.overflowY = "visible";
}
if(modalSale){
    if(modalSale.classList.contains("show-modal")){
        document.body.style.overflowY = "hidden";
    };
}

//cookies
const btnCookies = document.getElementById('btn-allow-cookies');
const cookiesAdvice = document.getElementById('cookies-alert');
const cookiesBackground = document.getElementById('background-cookies-alert');

//Google tagManager
dataLayer = [];

if(!localStorage.getItem('agreed-cookies')){
    cookiesBackground.classList.remove('d-none');
    cookiesAdvice.classList.add('cookie-active');
    cookiesBackground.classList.add('cookie-active');
}else{
    dataLayer.push({'event': 'cookies-aceptadas'});
}

if(btnCookies){
    btnCookies.addEventListener('click', () => {
        cookiesAdvice.classList.remove('cookie-active');
        cookiesBackground.classList.remove('cookie-active');
        cookiesBackground.classList.add("hide-modal");
        document.body.style.overflowY = "visible";
        localStorage.setItem('agreed-cookies', true);
        dataLayer.push({'event': 'cookies-aceptadas'});
    });
}

if(cookiesAdvice){
    if(cookiesAdvice.classList.contains('cookie-active')){
        document.body.style.overflowY = "hidden";
    }
}
