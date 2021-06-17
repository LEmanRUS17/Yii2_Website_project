$.backstretch(["/web/images/art/bg6.jpg"]);

jQuery(function(){
    $("#input__file").change(function(){ // событие выбора файла
        $("#input__avatar").submit(); // отправка формы
    });
});


