document.addEventListener("DOMContentLoaded", function(){
    document.querySelector('.mainstripe_photos_name'),
    document.querySelector('.mainstripe_photos_backb'),
    document.querySelector('.info_sendmes'),
    document.querySelector('.post_edit_form_all'),
    document.querySelector('#send').style.display = 'none';
    let wallSettingsButton = document.querySelectorAll('.wall_post_settings p');
    for(const wsbcount of wallSettingsButton){wsbcount.style.display = 'none';}
    //elementsToHide.style.display = 'none';
    const headerMenuUser = document.querySelector('.header_menu_user');
    headerMenuUser.addEventListener('click', () =>{
        document.querySelector('.header_menu_showed').classList.toggle('showed');
        document.querySelector('.header_menu_user_button').classList.toggle('clicked');
    });
    let photoShowImg = document.querySelector('.photo_show_img');
    let get_ava = photoShowImg.getAttribute('src');
    let get_avaid = photoShowImg.getAttribute('firstid');
    let get_owner = photoShowImg.getAttribute('owner');
    let photosListImages = document.querySelectorAll('.photos_list > img');
    for(const pli of photosListImages){
        pli.addEventListener('click', () =>{
            //only for acc.php
            if(window.innerWidth < 1800){window.scrollTo({top: 0,left: 0,behavior: 'smooth'});}
            let get_id=pli.getAttribute('data-photoid');
            photoShowImg.setAttribute('src', '/user/photos/'+get_id);
            //
            let process=get_id.replace('.jpg','');
            let process_2=process.replace(get_owner+'/','');
            photoShowImg.setAttribute('object_id', process_2);
            photoShowImg.setAttribute('type','2');
            //
            document.querySelector('.photo_settings_saveb').setAttribute('href','/user/photos/'+get_id);
            //check likes in photo
            $.ajax({
                url: "/settings/checklike.php?owner="+get_owner,
                type:"POST",
                data:({ type: 2, object_id: process_2 }),
                dataType: "html",
                success: function (data) {
                    if(data=='is'){
                        document.querySelector('.photo_info_liketext').textContent = 'Liked';
                        document.querySelector('.photo_info_avatar_likes').classList.add('liked');
                    }
                    else{
                        document.querySelector('.photo_info_liketext').textContent = 'Like';
                        document.querySelector('.photo_info_avatar_likes').classList.remove('liked');
                    }
                }
            });
            //
            $.ajax({
                url: "/settings/getlikes.php?owner="+get_owner,
                type:"POST",
                data:({ type: 2, object_id: process_2 }),
                dataType: "html",
                success: function (data) {
                    document.querySelector('.photo_info_getlike').innerHTML = data;
                }
            });
            //
            document.querySelector('.mainstripe_name').style.display = 'none'; document.querySelector('.mainstripe_online').style.display = 'none';
            document.querySelector('.mainstripe_photos_name').style.display = '';document.querySelector('.mainstripe_photos_backb').style.display = '';
            photoShowImg.classList.add('changed');
            setTimeout(function(){
                photoShowImg.classList.remove('changed');
            }, 2000);
        });
    }
    document.querySelector('.mainstripe_photos_backb').addEventListener('click', () =>{
        photoShowImg.setAttribute('src', get_ava);
        document.querySelector('.photo_settings_saveb').setAttribute('href', get_ava);
        //
        photoShowImg.setAttribute('object_id', get_avaid);
        photoShowImg.setAttribute('type', '1');
        //
        document.querySelector('.mainstripe_name').style.display = ''; document.querySelector('.mainstripe_online').style.display = '';
        document.querySelector('.mainstripe_photos_name').style.display = 'none';document.querySelector('.mainstripe_photos_backb').style.display = 'none';
        photoShowImg.classList.remove('changed');
        let get_photosposy=document.querySelector('#photos').offsetTop;
        let get_photosposy_1=get_photosposy-100;
        if(window.innerWidth < 1800){window.scrollTo({top: get_photosposy_1,left: 0,behavior: 'smooth'});}
        //
        $.ajax({
            url: "/settings/checklike.php?owner="+get_owner,
            type:"POST",
            data:({ type: 1, object_id: photoShowImg.getAttribute('object_id') }),
            dataType: "html",
            success: function (data) {
                if(data=='is'){
                    document.querySelector('.photo_info_liketext').textContent = 'Liked';
                    document.querySelector('.photo_info_avatar_likes').classList.add('liked');
                }
                else{
                    document.querySelector('.photo_info_liketext').textContent = 'Like';
                    document.querySelector('.photo_info_avatar_likes').classList.remove('liked');
                }
            }
        });
        //
        $.ajax({
            url: "/settings/getlikes.php?owner="+get_owner,
            type:"POST",
            data:({ type: 1, object_id: photoShowImg.getAttribute('object_id') }),
            dataType: "html",
            success: function (data) {
                document.querySelector('.photo_info_getlike').innerHTML = data;
            }
        });
    });
    try{document.querySelector('.info_left_msg').addEventListener('click', () =>{
        document.querySelector('.info_sendmes').style.display = '';
        document.querySelector('.info_left').style.display = 'none'; document.querySelector('.info_right').style.display = 'none';
    });}catch(er){console.log(er);}
    document.querySelector('.info_sendmes_close').addEventListener('click', () =>{
        document.querySelector('.info_sendmes').style.display = 'none';
        document.querySelector('.info_left').style.display = '';document.querySelector('.info_right').style.display = '';
    });
    document.querySelector('.header_logo_link svg').addEventListener('click', () =>{
        window.scrollTo({top: 0,behavior: 'smooth'});
    });
    // send message panel
    friendsListFrMsgButton=document.querySelectorAll('.friends_list_fr_msgb');
    for(const flfmb of friendsListFrMsgButton){
        flfmb.addEventListener('click', () =>{
            let getid=flfmb.getAttribute('friendid');
            let getava=flfmb.getAttribute('avatar');
            let getname=flfmb.getAttribute('name');
            let getn=flfmb.getAttribute('n');
            document.querySelector('#send').style.display = '';
            document.querySelector('.send-panel p span').textContent = getname;
            document.querySelector('.block-button span').textContent = getname;
            document.querySelector('.send-panel img').setAttribute('src',getava);
        });
    }
    document.querySelector('.send-cover').addEventListener('click', () =>{
        document.querySelector('#send').style.display = 'none';
        document.querySelector('.send-panel textarea').value = '';
    });
});
