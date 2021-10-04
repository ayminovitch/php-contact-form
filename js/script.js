$(document).ready(function(){
  $(document).on('click', 'a[href^="#"]', function (event) {
      event.preventDefault();
      $('html, body').animate({
          scrollTop: $($.attr(this, 'href')).offset().top
      }, 500);
  });
  if($(".intro p:last-of-type").length){
    var text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
        i=0,
        inter = setInterval(function(){
                  $(".intro p:last-of-type")[0].innerHTML += text[i]
                  i++;
                  if(i>=text.length){
                    clearInterval(inter);
                  }
                }, 80);
  }
});
$(document).on('change','#inquiry',function(){
    if($(this).val() == 'option2'){
        $('.description').removeClass('hidden');
    }else{
        $('.description').addClass('hidden');
    }
});
