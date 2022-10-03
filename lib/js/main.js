document.addEventListener("DOMContentLoaded", function () {
    var header = document.querySelector('.header');
    var l = document.querySelectorAll('.effect');
    var menu = document.querySelector('.menu-toggle');
    var main = document.querySelector('.main');
    var ct = document.querySelectorAll('.content');
    var body = document.querySelectorAll('.c-body');
    var readmore = document.querySelectorAll('.read-more');
    var likeBtn = document.querySelectorAll('.like');
    var like = document.querySelectorAll('.count-like');
    var heartFill = document.querySelectorAll('.fa-heart');
    var modal = document.querySelector(".modal-reg");
    var modalLog = document.querySelector(".modal-login");
    var span = document.querySelectorAll(".close");
    var btn = document.querySelectorAll(".open-reg");
    var btnLog = document.querySelectorAll('.open-login');
    var fullMenu = document.querySelector('.full-s-menu');
    var data = localStorage.getItem('userID');
    if (btn.length > 0 && btnLog.length > 0 && span.length > 0) {
        btnLog[0].onclick = function () {
            modal.style.display = "none";
            modalLog.style.display = "flex";
            main.classList.add('blur');
            header.classList.add('blur')
        }
        btn[0].onclick = function () {
            modalLog.style.display = "none";
            modal.style.display = "flex";
            main.classList.add('blur');
            header.classList.add('blur')
        }
        span[0].onclick = function () {
            if (fullMenu.classList.contains('show')) {
                modal.style.display = "none";
            } else {
                modal.style.display = "none";
                main.classList.remove('blur');
                header.classList.remove('blur')
            }
        }
        span[1].onclick = function () {
            if (fullMenu.classList.contains('show')) {
                modalLog.style.display = "none";
            } else {
                modalLog.style.display = "none";
                main.classList.remove('blur');
                header.classList.remove('blur')
            }
        }
        btnLog[1].onclick = function () {
            modal.style.display = "none";
            modalLog.style.display = "flex";
        }

        btn[1].onclick = function () {
            modalLog.style.display = "none";
            modal.style.display = "flex";
        }

        window.onclick = function (event) {
            if (event.target == modal || event.target == modalLog) {
                if (fullMenu.classList.contains('show')) {
                    modalLog.style.display = "none";
                    modal.style.display = "none";
                } else {
                    modalLog.style.display = "none";
                    modal.style.display = "none";
                    main.classList.remove('blur');
                    header.classList.remove('blur')

                }
            }

        }
    }
    window.onscroll = function () {
        if (window.pageYOffset > 1) {
            header.classList.add("sticky");
            l.forEach(function (li) {
                li.classList.remove('ef');
            });
            document.querySelector('.img').setAttribute('src', './lib/images/logo.png');
        }
        else {
            header.classList.remove("sticky");
            l.forEach(function (li) {
                li.classList.add('ef');
            });
            document.querySelector('.img').setAttribute('src', './lib/images/cdlncd.png');
        }
    }

    menu.onclick = function () {
        menu.classList.toggle("change");
        document.querySelector('#full-menu').classList.toggle("show");
        main.classList.toggle("blur");
    };

    for (let i = 0; i < body.length && i < readmore.length && i < ct.length; i++) {
        if (body[i].clientHeight > 250) {
            body[i].setAttribute('style', 'height: 250px;');
            readmore[i].innerHTML = 'Đọc thêm';
        }
        readmore[i].onclick = function () {
            if (body[i].clientHeight > 250) {
                window.scrollTo(0, ct[i].offsetTop - 70);
                body[i].setAttribute('style', 'height: 250px;');
                readmore[i].innerHTML = 'Đọc thêm';
            }
            else {
                body[i].removeAttribute('style');
                readmore[i].innerHTML = 'Thu gọn';
            }
        }
    }
    for (let i = 0; i < likeBtn.length && i < heartFill.length && i < like.length; i++) {
        likeBtn[i].onclick = function () {
            if (!heartFill[i].classList.contains('fas-liked')) {
                if (like[i].innerHTML == '') {
                    like[i].innerHTML = '1';
                } else {
                    like[i].innerHTML = `${parseInt(like[i].innerHTML) + 1}`;
                }
                heartFill[i].classList.add('fas-liked');
            }
            else {
                if (like[i].innerHTML == '1') {
                    like[i].innerHTML = '';
                } else {
                    like[i].innerHTML = `${parseInt(like[i].innerHTML) - 1}`;
                }
                heartFill[i].classList.remove('fas-liked');
            }
        }
    }
})
document.addEventListener('DOMContentLoaded', function () {
    function Er(selector_input, selector_error, char_number_min, char_number_max) {
        let name = document.querySelector(selector_input);
        if (name.value.length < char_number_min || name.value.length >= char_number_max) {
            document.querySelector(selector_error).innerHTML = `Vui lòng nhập ít nhất ${char_number_min} ký tự và không quá ${char_number_max} ký tự.`;
        }
        else
            document.querySelector(selector_error).innerHTML = '';
    };
    if (document.querySelector('#name') != null) {

        document.querySelector('#name').onchange = function () {
            Er('#name', '#err', 8, 50);
        };
        document.querySelector('#user-name').onchange = function () {
            Er('#user-name', '#err1', 8, 20);
        }

        document.querySelector('#user-name-log').onchange = function () {
            Er('#user-name-log', '#err1', 8, 20);
        }
        let pass = document.querySelector('#pwd'), rpass = document.querySelector('#rpwd');
        let passLog = document.querySelector('#pwd-log');
        passLog.onchange = function () {
            let reg = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,15}/;
            if (reg.test(passLog.value))
                document.querySelector('#err3-log').innerHTML = '';
            else
                document.querySelector('#err3-log').innerHTML = 'Vui lòng nhập mật khẩu 6 - 15 ký tự bao gồm ít nhất 1 chữ in hoa, 1 chữ in thường và một số.';
        }
        rpass.onchange = function () {
            if (rpass.value != pass.value)
                document.querySelector('#err2').innerHTML = 'Vui lòng nhập mật khẩu trùng nhau.';
            else
                document.querySelector('#err2').innerHTML = '';
        }
        pass.onchange = function () {
            let reg = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,15}/;
            if (reg.test(pass.value))
                document.querySelector('#err3').innerHTML = '';
            else
                document.querySelector('#err3').innerHTML = 'Vui lòng nhập mật khẩu 6 - 15 ký tự bao gồm ít nhất 1 chữ in hoa, 1 chữ in thường và một số.';
        }

        document.querySelector('#tele').onchange = function () {
            let rl = /\d{10}/;
            if (rl.test(document.querySelector('#tele').value))
                document.querySelector('#err4').innerHTML = '';
            else
                document.querySelector('#err4').innerHTML = 'Vui lòng nhập đúng số điện thoại';
        }
    }
})