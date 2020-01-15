(function() {
  var $imgs = $('#gallery img'); //vse slike k so v gallery image
  var $buttons = $('#buttons'); //vsi gumbi
  var tagged = {}; //tagi k jih dobi iz njih

  $imgs.each(function() { //funkcija k dobi use tage iz image http://api.jquery.com/jquery.each/
    let img = this;
    let tags = $(this).data('tags');

    if (tags) {
      tags.split(',').forEach(function(tagName) {
        if (tagged[tagName] == null) {
          tagged[tagName] = [];
        }
        tagged[tagName].push(img); // in jih pusha notr v tagged
      })
    }
  })

  $('<button/>', { //tuki sestavmo gumbe in jih damo v buttons https://stackoverflow.com/questions/6205258/jquery-dynamically-create-button-and-attach-event-handler in 
    text: 'Show All',
    class: 'active',
    click: function() {
      $(this)
        .addClass('active')
        .siblings()
        .removeClass('active');
      $imgs.show();
    }
  }).appendTo($buttons);

  $.each(tagged, function(tagName) { //pol pa za vsak tagged prestejemo stevilo slik n in ga izpisemo na gumb
    let $n = $(tagged[tagName]).length;
    $('<button/>', {
      text: tagName + ' (' + $n + ')',
      click: function() {
        $(this)
          .addClass('active')
          .siblings()
          .removeClass('active');
        $imgs
          .hide()
          .filter(tagged[tagName])
          .show();
      }
    }).appendTo($buttons);
  });
  var $imgs = $('#gallery img'); //se vec spremenljivk \o/ pogchamp
  var $search = $('#filter-search'); //input za besedilo
  var cache = [];

  $imgs.each(function() {
    cache.push({
      element: this,
      text: this.alt.trim().toLowerCase() //damo besedilo na lowercase da dobimo neglede na velikost
    })
  })

  function filter() { //filtriramo po vnesenem textu na input in keyup https://api.jquery.com/keyup/
    let pictures = this.value.trim().toLowerCase(); 
    cache.forEach(function(img) {
      let i = 0;
      if (pictures) {
        i = img.text.indexOf(pictures);
      }
      img.element.style.display = i === -1 ? 'none' : '';
    })
  }
  if ('oninput' in $search[0]) {
    $search.on('input', filter);
  } else {
    $search.on('keyup', filter);
  }
}())
