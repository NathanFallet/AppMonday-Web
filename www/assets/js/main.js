// AppMonday JavaScript File

// Main variables
var loaded_apps = 0;

// Ajax Query
function ajaxPost(url, method, data, callback, progress) {
    var req = new XMLHttpRequest();
    req.open(method, url);
    req.addEventListener("load", function () {
        if (req.status >= 200 && req.status <= 400) {
            callback(req.responseText);
        } else {
            console.error(req.status + " " + req.statusText + " " + url);
        }
    });
    req.addEventListener("error", function () {
        console.error("Error fetching " + url);
    });
    if(progress !== undefined){
      req.upload.addEventListener('progress', progress);
    }
    req.setRequestHeader("Content-Type", "application/json");
    data = JSON.stringify(data);
    if(data !== undefined) {
      req.send(data);
    } else {
      req.send();
    }
}

// Form validation
document.getElementById('form').onsubmit = function(){
  var name = document.getElementById('name').value.trim();
  var user = document.getElementById('user').value.trim();
  var link = document.getElementById('link').value.trim();
  var logo = document.getElementById('logo').value.trim();
  var description = document.getElementById('description').value.trim();
  if(name !== '' && user !== '' && link !== '' && description !== '' && /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi.test(link)) {
    var data = {
      name: name,
      user: user,
      link: link,
      logo: logo,
      description: description
    }
    ajaxPost('https://api.appmonday.xyz/project/project.php', 'POST', data, function response(response) {
      var data = JSON.parse(response);
      if(data.success){
        success();
      }else{
        error('We are sorry but something went wrong... Check your filled everything correctly, or maybe your already submitted this project.');
      }
    });
  }else{
    error('Please fill all inputs with correct values!');
  }
  return false;
}

// App list
function loadApps() {
  var applist = document.getElementById('applist');
  ajaxPost('https://api.appmonday.xyz/project/project.php?start='+window.loaded_apps+'&limit=10', 'GET', undefined, function response(response) {
    var data = JSON.parse(response);
    for(var app in data) {
      applist.appendChild(createAppElement(data[app]));
      window.loaded_apps++;
    }
    if(window.loaded_apps == 0) {
      applist.innerHTML = '<p>No apps have been introduced for now, but you can already <a onclick="show(\'second\')">submit your app here</a>!</p><p>Come back on Monday, Dec 24 to see the first app.</p>';
    }
  });
}

loadApps();

// Utils
function  createAppElement(app) {
  var media = document.createElement('div');
  media.classList.add('media');
  media.classList.add('item');
  media.classList.add('mx-auto');
  var medialeft = document.createElement('div');
  medialeft.classList.add('media-left');
  var mediabody = document.createElement('div');
  mediabody.classList.add('media-body');
  var mediaheading = document.createElement('h4');
  mediaheading.classList.add('media-heading');
  mediaheading.innerHTML = '<a href="'+app.link+'">'+app.name+'</a>';
  var mediap = document.createElement('p');
  mediap.classList.add('media-p');
  mediap.innerHTML = app.description;
  var mediap2 = document.createElement('p');
  mediap2.classList.add('media-p');
  mediap2.innerHTML = 'Submitted by <a href="https://instagram.com/'+app.user+'">'+app.user+'</a>';
  var mediaimg = document.createElement('img');
  mediaimg.classList.add('media-object');
  mediaimg.src = app.logo !== '' ? app.logo : 'https://www.appmonday.xyz/assets/images/NoLogo.png';
  mediaimg.style.width = '70px';
  medialeft.appendChild(mediaimg);
  mediabody.appendChild(mediaheading);
  mediabody.appendChild(mediap);
  mediabody.appendChild(mediap2);
  media.appendChild(medialeft);
  media.appendChild(mediabody);
  return media;
}

function clear() {
  var status = document.getElementsByClassName('status');
  while(status[0]) {
    status[0].parentNode.removeChild(status[0]);
  }
}

function success() {
  clear();
  var contentbox = document.getElementById('error-space');
  var success = document.createElement('div');
  success.classList.add('status');
  success.classList.add('alert');
  success.classList.add('alert-success');
  success.innerHTML = 'Your app has been submitted! Follow us on Instragram to see it in our story.';
  contentbox.prepend(success);
}

function error(message) {
  clear();
  var contentbox = document.getElementById('error-space');
  var error = document.createElement('div');
  error.classList.add('status');
  error.classList.add('alert');
  error.classList.add('alert-danger');
  error.innerHTML = 'An error occurred: '+message;
  contentbox.prepend(error);
}

// Template script

$(document).ready(function() {

    /* ======= Fixed header when scrolled ======= */

    $(window).bind('scroll', function() {
         if ($(window).scrollTop() > 0) {
             $('#header').addClass('header-scrolled');
         }
         else {
             $('#header').removeClass('header-scrolled');
         }
    });

    /* ======= Scrollspy ======= */
    $('body').scrollspy({ target: '#header', offset: 100});

    /* ======= ScrollTo ======= */
    $('a.scrollto').on('click', function(e){

        //store hash
        var target = this.hash;

        e.preventDefault();

		$('body').scrollTo(target, 800, {offset: -50, 'axis':'y'});
        //Collapse mobile menu after clicking
		if ($('.navbar-collapse').hasClass('show')){
			$('.navbar-collapse').removeClass('show');
		}

	});

});
