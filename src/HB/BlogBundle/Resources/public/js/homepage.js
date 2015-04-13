$(function(){
    $(".article").hover(
            function () {
                $(this).animate({
                    backgroundColor: 'green',
                    borderWidth: '10px'
                }, 500);
            },
            function () {
                $(this).animate({
                    backgroundColor: 'B74C2B',
                    borderWidth: '1px'
                }, 500);

            }
    );


});
        /*$(".article").hover(function(){
         $(this).animate({fontSize: "22"}, 300)
         }, function() {
         $(this).animate({fontSize: "16"}, 300)  
         })*/
