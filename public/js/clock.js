$(document).ready(function() {
    var monthNames = [ "Января", "Февраля", "Марта", "Апреля",
        "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря" ];
    var dayNames= ["Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье"];

    var newDate = new Date();
    newDate.setDate(newDate.getDate());

    $('#Date').html("<b>" + dayNames[newDate.getDay()] + "<br> " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ', ' + newDate.getFullYear()+"</b>");

    setInterval( function() {
        var seconds = new Date().getSeconds();
        $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
    },1000);

    setInterval( function() {
        var minutes = new Date().getMinutes();
        $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);

    setInterval( function() {
        var hours = new Date().getHours();
        $("#hrs").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);


    $(".night").click(function() {
        $(".clock").css("background-color", "rgba(0,0,0, .9)");
        $("ul, #Date").css("color", "#b1d4d4");
    });

    $(".day").click(function() {
        $(".clock").css("background-color", "rgba(0,0,0, .1)");
        $("ul, #Date").css("color", "#000");
    });
});