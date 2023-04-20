<?php
    function checkFavoriteProduct($idProduct, $user_id){
        if ($user_id){

          //  $user_id = get_current_user_id();
            $arr_wish = get_user_meta($user_id, 'wish_list', true);

            if (is_array($arr_wish) && $arr_wish){
                if(array_search($idProduct, $arr_wish) !== false){
                    return 'active';
                }else{
                    return '';
                }
            }
        }else{
            return '';
        }

    }