jQuery(document).ready(function($){
    $('.ajax-search-btn').on('click', function(e){
        e.preventDefault();
        

        $.ajax({
            url: multistep_ajax_script.ajaxurl,
            type: 'post',
            data: {
                'action': 'get_products_info',
                'product_id': product_id,
        
                },
                success: function(response){

                }
                
        })
    });
})