const wishList = ()=>{
    jQuery(document).ready(function ($) {
       $('body').on('click','.gifts__image .favorites',function (e){
           e.preventDefault();
           e.stopPropagation();

           let productId = $(this).closest('.gifts__image').data('id'),
               flag = $(this).hasClass('active'),
               btn = $(this),
               data = {
                   action: "wishlist",
                   id: productId,
                   add: !flag
               };


           $.ajax({
               url: themeVars.ajaxUrl,
               data: data,
               type: "POST",
               beforeSend: () => {
                    btn.addClass('waiting');
               },
               success: (data) =>{
                   if(!flag){
                       btn.addClass('active');
                   }else{
                       btn.removeClass('active');
                   }
                   btn.removeClass('waiting');
               }
           })

       })
    });
}
export  default wishList;