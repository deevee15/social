idleTimer = null;
idleState = false;
idleWait = 3000; // задаём время ожидания бездействия

(function ($) {
    $(document).ready(function () {
        $('*').bind('mousemove keydown scroll', function () {
            clearTimeout(idleTimer);
            if (idleState == true) {

                // Что делаем, когда пользователь активировался
                $("body").append("aktiv");
                // Что делаем, когда пользователь активировался

            }

            idleState = false;
            idleTimer = setTimeout(function () {

                // Что делаем при бездействии юзера больше указанного времени
                $("body").append("jopa ti neaktiv");
                // Что делаем при бездействии юзера больше указанного времени

                idleState = true;
            }, idleWait);
        });

        // Инициализация
        $("body").trigger("mousemove");

    });
})(jQuery)