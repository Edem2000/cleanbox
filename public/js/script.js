$(document).ready(function() {
  // console.log('click');
  // $('#apply .submit').click(function () {
  // });
  // $('#apply').click(function () {
  // });
    //SCRIPTS IN HEADER
    $('.burger-btn').click(function(){
        $('.burger-btn').toggleClass('active');
        $('.mobile-menu-container').toggleClass('active');
        $('.mobile-menu').toggleClass('active');
        $('body, html').toggleClass('scrollable').toggleClass('lock');
    });
    $('.main').click(function(){
        if($('.burger-btn').hasClass('active')){
            $('.burger-btn').removeClass('active');
            $('.mobile-menu-container').removeClass('active');
            $('.mobile-menu').removeClass('active');
            $('body, html').addClass('scrollable').removeClass('lock');
        }
    });
    $('.mobile-menu a').click(function(){
        if($('.burger-btn').hasClass('active')){
            $('.burger-btn').removeClass('active');
            $('.mobile-menu-container').removeClass('active');
            $('.mobile-menu').removeClass('active');
            $('body, html').addClass('scrollable').removeClass('lock');
        }
    });
    //ON LOAD CHECK
    if($(document).scrollTop()>50){
        $('header').addClass('scrolled');
    }
    else if($(document).scrollTop()<=50){
        $('header').removeClass('scrolled');
    }
    //END ON LOAD CHECK
    //ON SCROLL CHECK
    $(window).scroll(function(){
        if($(document).scrollTop()>50){
            $('header').addClass('scrolled');
        }
        else if($(document).scrollTop()<=50){
            $('header').removeClass('scrolled');
        }
    });
    //END ON SCROLL CHECK

    //END OF SCRIPTS IN HEADER


    //SCRIPTS IN FORMS
    $('.placeholder').click(function() {
        $(this).siblings('input').focus();
    });
    $('.input').blur(function() {
        var input = $(this);
        if (input.val().length == 0) {
            input.siblings('.placeholder').show();
        }
    });
    $('.input').on('input', function() {
        var input = $(this);
        if (input.val().length == 0){
            input.siblings('.placeholder').show();
        }
        else{
            input.siblings('.placeholder').hide();
        }
    });
    $('.input').blur();
    //END OF SCRIPTS IN FORMS

  $('.modal-overlay').click(function () {
    hideContactSuccess();
  });
  $('#content-success').click(function () {
    hideContactSuccess();
  });

  $('.diplomas-block .img').click(function () {
    $('body, html').addClass('lock').removeClass('scrollable');
    $('.diploma-modal-overlay').show();
    const url = $(this).attr('src');
    $('.diploma-modal .modal-diploma-img').attr('src', url);
    $('.diploma-modal').addClass('active');
  });

  $('.diploma-modal-overlay, .diploma-modal').click(function () {
    $('body, html').removeClass('lock').addClass('scrollable');
    $('.diploma-modal-overlay').hide();
    $('.diploma-modal').removeClass('active');
  });
});

function sendContactForm(){
  $.ajax({
    type:'POST',
    url:'/send-contact',
    data: $('#apply').serialize(),
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success:function(data) {
      showContactSuccess(data);
      $('#apply').trigger("reset");
    },
    error:function () {

    }
  });
}
function updateShares(id){
  $.ajax({
    type:'POST',
    url:'/blog/article/'+id+'/shares/update',
    data: {
      id: id,
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success:function(data) {
    },
    error:function () {

    }
  });
}
function showContactSuccess(data){
  $('.modal-overlay').show();
  $('#content-success').show();
  $('body').toggleClass('scrollable').toggleClass('lock');
  $('#content-success .name').text(data.name);
}
function hideContactSuccess(data){
  $('.modal-overlay').hide();
  $('#content-success').hide();
  $('body').toggleClass('scrollable').toggleClass('lock');
}
function animateValue(id, start, end, duration) {
    if (start === end) return;
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);



    /*=========================================================================
        Navbar ScrollSpy
    =========================================================================*/
    $(window).scroll(function () {
        var scrollPos = $(document).scrollTop(),
            nav_height = $('header').outerHeight();

        $('.nav-item').each(function () {
            var currLink = $(this),
                refElement = $(currLink.attr('href'));
            if( refElement.length > 0 ){
                if ( ( refElement.position().top - nav_height ) <= scrollPos ) {
                    $('.nav-item').removeClass('active');
                    currLink.addClass('active');
                }else{
                    currLink.removeClass('active');
                }
            }
        });
    });
}


async function typeSentence(sentence, eleRef, delay = 200) {
  const letters = sentence.split("");
  let i = 0;
  while(i < letters.length) {
    await waitForMs(delay);
    $(eleRef).append(letters[i]);
    i++
  }
  return;
}

async function deleteSentence(eleRef) {
  const sentence = $(eleRef).html();
  const letters = sentence.split("");
  let i = 0;
  while(letters.length > 0) {
    await waitForMs(100);
    letters.pop();
    $(eleRef).html(letters.join(""));
  }
}

async function carousel(sentence, eleRef) {
  // var i = 0;
  // while(true) {
    // updateFontColor(eleRef, carouselList[i].color)
  await waitForMs(1500);
    await typeSentence(sentence, eleRef);
  await waitForMs(10000);
  $('#input_cusor').remove();
    // await deleteSentence(eleRef);
    // await waitForMs(500);
  //   i++
  //   if(i >= carouselList.length) {i = 0;}
  // }
}

function updateFontColor(eleRef, color) {
  $(eleRef).css('color', color);
}

function waitForMs(ms) {
  return new Promise(resolve => setTimeout(resolve, ms))
}

function showDiploma(){

  $('.modal-overlay').show();
}
