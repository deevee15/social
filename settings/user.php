<?
    function actionUser() {
        $this->title = "Профиль пользователя";
        $this->meta_desc = "Профиль пользователя";
        $this->meta_key = "Профиль пользователя";
        
        $content = $this->view->render("user", array(), true);
        
        $this->render($content);
    }
?>