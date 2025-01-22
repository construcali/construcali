$(function() {
  var button = $('.clickme')
      , box = $('.box')
  ;
  
  button.on('click', function() { 
    box.removeClass('box');
    $(document).trigger('buttonClick');
  });
            
  $(document).on('buttonClick', function() {
    box.text('Clicked!');
  });
});

.box { background-color: red; }