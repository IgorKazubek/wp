jQuery(function($){

    $('#true_loadmore').click(function(){
        $(this).text('Loading...');
        var data = {
            'action': 'loadmore',
            'query': true_posts,
            'page' : current_page
        };
        $.ajax({
            url:ajaxurl, // обработчик
            data:data, // данные
            type:'POST', // тип запроса
            success:function(data){
                if( data ) {
                    $('.single_post').remove();
                    $('.all_posts').append(data);
                    $('#true_loadmore').text('Next');

                    current_page++;

                    if (current_page > 1){
                        $('#loadPrev').show();
                    }
                    if (current_page == max_pages)
                        $("#true_loadmore").hide();
                }
                else
                    $('#true_loadmore').hide();
            }
        });
    });

    $('#loadPrev').click(function () {
        $(this).text('Loading...');

        var data = {
            'action': 'loadprev',
            'query': true_posts,
            'page' : current_page
        };
        $.ajax({
            url:ajaxurl,
            data:data,
            type:'POST',
            success:function(data){
                if( data ) {
                    $('.single_post').remove();
                    $('.all_posts').append(data);
                    $('#loadPrev').text('Previous');
                    current_page--;
                    if (current_page != max_pages){
                        $('#true_loadmore').show();
                    }
                    if (current_page < 2)
                        $('#loadPrev').hide();
                }
            }
        });
    });
});