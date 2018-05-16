function form_param(tab) {
	var str = "";
	for (var key in tab) {
  		str += key + "=" + tab[key] + "&";
	}
	return (str);
}

var full_img = {};
var page = 0;
var name_user;
var full_user;
var user;
var comment_by;

function filtre_undefind(t) {
	tab = [];

	for (var i = 0; i < t.length; i++) {
		if(t[i] != undefined)
			tab.push(t[i])
	}
	return(tab)
}

function bind_article() {
	for (var i = 0; i < document.getElementsByClassName('article').length; i++) {
		document.getElementsByClassName('article')[i].addEventListener("click", function( event ){
			var id = event.target.id;
			var img = [];
			document.getElementsByClassName('corpus')[0].innerHTML = "";
			document.getElementsByClassName('oui')[0].innerHTML = "";

			for (var i = 0; i < full_img.length; i++) {
				if(full_img[i]['id'] == id)
				{
					img = full_img[i];
				}
			} 
			var html = `<div class=page_produit>
							<img src='img/`+img['path']+`' class='img_produit'><br>`
			
			if(name_user)
			{
				var liked_by = JSON.parse( img['likedby'])
				var is_enter = 0;
				var index = -1
				for (var i = 0; i < liked_by.length; i++) {
					if(liked_by[i] == user[0].id)
					{
						//console.log(user[0].id);
						is_enter = 1;
						index = i
					}
				}
				var like = 0;
				if(is_enter == 0)
				{
					html += "like :<input type='checkbox' id='coding' name='interest' class=ckeck_like>";
				}
				else
				{
					html+="like :<input type='checkbox' id='coding' name='interest' checked  class='ckeck_like'>";
					like = 1;
				}

			}

			html += "</div>"

			comment_by = JSON.parse( img['commentby'])


			for (var i = 0; i < comment_by['comments'].length; i++) {
				html += `<div class=comment>
				<h4>comment by : `+comment_by['comments'][i]['login']+`</h4>
				<p>`+comment_by['comments'][i]['commante']+`</p>
				<hr></div>`
			}

			if(name_user)
			html += `<form class="form-comment">
					<input type="text" name="" class="input-comment">
					<input type="button" name="" class="input-button">
				</form>`
			/*<div class=comment>
					<h4>comment by : yunikki</h4>
					<p>oui</p>
					<hr>
				</div>*/
			document.getElementsByClassName('corpus')[0].innerHTML = html;

			

			if(document.getElementsByClassName('input-button')[0])
			document.getElementsByClassName('input-button')[0].addEventListener("click", function( event ) {
				var tab = {};
				tab['login'] = name_user;
				tab['commante'] = document.getElementsByClassName('input-comment')[0].value

				comment_by['comments'].push(tab);
				str = JSON.stringify(comment_by['comments'])
				str = "{" + '"comments"' + ":" + str + "}"
				tab = [];
				tab['str'] = str
				tab['id'] = img.id
				call_add_comment("http://localhost:8080/back/add_comment.php", tab, name_user, document.getElementsByClassName('input-comment')[0].value)
			})
		

		
			if(document.getElementsByClassName('ckeck_like')[0])
				document.getElementsByClassName('ckeck_like')[0].addEventListener("change", function( event ) {

					for (var i = 0; i < liked_by.length; i++) {
						if(liked_by[i] == user[0].id)
						{
							//console.log(user[0].id);
							is_enter = 1;
							index = i
						}
					}

						console.log('ok')
						if(like == 1)
						{
							delete liked_by[index];
							liked_by = filtre_undefind(liked_by);
						}
						else
						{
							liked_by.push(user[0].id);
						}
						console.log(liked_by);

						var tab = [];
						tab['id'] = img.id
						tab['str'] = JSON.stringify(liked_by)
						call_like("http://localhost:8080/back/like.php", tab)
						like == 1 ? like = 0 : like = 1;

				})
			
		});

	}
	//document.getElementsByClassName('corpus')[0].innerHTML = "";
}

function call_like(url, tab)
{
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	        //var rep = JSON.parse(http.responseText);
	        console.log(http.responseText)
	       
	    }
	}
	http.send(params);
	return(http.responseText);
}

function call_add_comment(url, tab, login, comment) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	        var rep = JSON.parse(http.responseText);
	        
	        document.getElementsByClassName('form-comment')[0].remove();

	        

	      

	        var html = ""
			
				html += `<div class=comment>
				<h4>comment by : `+login+`</h4>
				<p>`+comment+`</p>
				<hr></div>`
			

			if(name_user)
			html += `<form class="form-comment">
					<input type="text" name="" class="input-comment">
					<input type="button" name="" class="input-button">
				</form>`

				document.getElementsByClassName('corpus')[0].innerHTML += html;


			if(document.getElementsByClassName('input-button')[0])
			document.getElementsByClassName('input-button')[0].addEventListener("click", function( event ) {
				var tab = {};
				tab['login'] = name_user;
				tab['commante'] = document.getElementsByClassName('input-comment')[0].value

				comment_by['comments'].push(tab);
				str = JSON.stringify(comment_by['comments'])
				str = "{" + '"comments"' + ":" + str + "}"
				tab = [];
				tab['str'] = str
				tab['id'] = img.id
				call_add_comment("http://localhost:8080/back/add_comment.php", tab, name_user, document.getElementsByClassName('input-comment')[0].value)
			})

	        //document.getElementsByClassName('corpus')[0].innerHTML = "";
	    }
	}
	http.send(params);
	return(http.responseText);
}

function call_img(tab, url) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	        var img = JSON.parse(http.responseText);

	        img = img.result.img;
	        full_img = img;
	        var html = ""
	        var length = img.length > 5 ? 5 : img.length
	        for (var i = 0; i < length; i++) {
				html += "<div class=article id="+img[i]['id']+"><img src='img/" + img[i]['path'] + "' id="+img[i]['id']+"><a href='#' class=article_title id="+img[i]['id']+">"+img[i]['path']+"</a><br></div>"
	        }
	        if(document.getElementsByClassName('corpus')[0])
	        	document.getElementsByClassName('corpus')[0].innerHTML = html;

	         if(document.getElementsByClassName('corpus')[0])
	        document.getElementsByClassName('flech_droit')[0].addEventListener("click", function( event ) {
	        	if(!img[(page + 1) * 5])
	        		return;
				document.getElementsByClassName('corpus')[0].innerHTML = "";
				html = "";
				page++;
				for (var i = page * 5; i < (page + 1) * 5; i++) {
					if(img[i])
					{
						html += "<div class=article id="+img[i]['id']+"><img src='img/" + img[i]['path'] + "' id="+img[i]['id']+"><a href='#' class=article_title id="+img[i]['id']+">"+img[i]['path']+"</a><br></div>"

					}
				}
				document.getElementsByClassName('corpus')[0].innerHTML = html;
				bind_article();
			});

	    	 if(document.getElementsByClassName('flech_gauche')[0])
			document.getElementsByClassName('flech_gauche')[0].addEventListener("click", function( event ) {
				if(page <= 0)
					return;
				document.getElementsByClassName('corpus')[0].innerHTML = "";
				html = "";
				page--;
				for (var i = page * 5; i < (page + 1) * 5; i++) {
					if(img[i])
					{
						html += "<div class=article id="+img[i]['id']+"><img src='img/" + img[i]['path'] + "' id="+img[i]['id']+"><a href='#' class=article_title id="+img[i]['id']+">"+img[i]['path']+"</a><br></div>"
					}
				}
				document.getElementsByClassName('corpus')[0].innerHTML = html;
				bind_article();
			});
			bind_article();
	        //document.getElementsByClassName('corpus')[0].innerHTML = "";
	    }
	}
	http.send(params);
	return(http.responseText);
}



function call_users(tab, url) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	        var img = JSON.parse(http.responseText);
	        name_user = img['loged'];
	        img = img.result.user;

	        full_user = img;

	        tab = [];
	        tab['login'] = name_user;
	        call_user(tab, "http://localhost:8080/back/aff_user.php");

	        //document.getElementsByClassName('corpus')[0].innerHTML = "";
	    }
	}
	http.send(params);
	return(http.responseText);
}

function call_check_mail(url, tab) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	        var img = JSON.parse(http.responseText);
	       	user[0].mail == "1" ? user[0].mail = "0" : user[0].mail = "1";

	        //document.getElementsByClassName('corpus')[0].innerHTML = "";
	    }
	}
	http.send(params);
	return(http.responseText);
}

function call_user(tab, url) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	        var img = JSON.parse(http.responseText);
	        name_user = img['loged'];
	        img = img.result.user;

	        user = img;

	        if(document.getElementsByClassName('param-checkbox')[0])
	        {
	        	if(user[0].mail == "1")
	        		document.getElementsByClassName('param-checkbox')[0].innerHTML = "resevoir un mail quand un commentaire est poser <input type='checkbox' name='' class='param_ch' checked>"
	        	else
	        		document.getElementsByClassName('param-checkbox')[0].innerHTML = "resevoir un mail quand un commentaire est poser <input type='checkbox' name='' class='param_ch'>"

	        	document.getElementsByClassName('param_ch')[0].addEventListener("change", function( event ) {
	        		var tab = [];
	        		tab['check'] = user[0].mail
	        		call_check_mail("http://localhost:8080/back/check_mail.php", tab)
	        	})
	        }
	        
	        //document.getElementsByClassName('corpus')[0].innerHTML = "";
	    }
	}
	http.send(params);
	return(http.responseText);
}

function get_img() {
	var elem = document.getElementsByClassName('text_in');
	var tab = [];

	tab['value'] = elem[0].value
	
	call_post(tab, "http://localhost:8080/back/test.php");
}

var elem = document.getElementsByClassName('corpus');


	var img = call_img([], "http://localhost:8080/back/get_img.php");
	var tab = [];
	//tab['login'] = name_user; 
	call_users(tab, "http://localhost:8080/back/aff_user.php");
	




function call_newpass(url, tab) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        var img = JSON.parse(http.responseText);
	        
	    }

	}
	http.send(params);
	return(http.responseText);
}

function call_newemail(url, tab) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	       var img = JSON.parse(http.responseText);
	        
	    }
	}
	http.send(params);
	return(http.responseText);
}

function call_newlogin(url, tab) {
	var http = new XMLHttpRequest();
	var params = form_param(tab);
	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {//Call a function when the state changes.
	    if(http.readyState == 4 && http.status == 200) {
	        //return(http.responseText);
	       var img = JSON.parse(http.responseText);
	        
	    }
	}
	http.send(params);
	return(http.responseText);
}




setTimeout(function() {
	if(document.getElementsByClassName('param-btn-mdp')[0])
		document.getElementsByClassName('param-btn-mdp')[0].addEventListener("click", function( event ) {
			var tab = [];
			tab['passwd'] = document.getElementsByClassName('param-new-pass')[0].value
			tab['oldpasswd'] = document.getElementsByClassName('param-mdp')[0].value
			call_newpass("http://localhost:8080/back/new_passwd.php", tab);
		})

	if(document.getElementsByClassName('param-btn-mail')[0])
		document.getElementsByClassName('param-btn-mail')[0].addEventListener("click", function( event ) {
			var tab = [];
			tab['email'] = document.getElementsByClassName('param-new-mail')[0].value
			call_newemail("http://localhost:8080/back/reset_email.php", tab);
		})


	if(document.getElementsByClassName('param-btn-login')[0])
		document.getElementsByClassName('param-btn-login')[0].addEventListener("click", function( event ) {
			var tab = [];
			tab['login'] = document.getElementsByClassName('param-new-login')[0].value
			call_newlogin("http://localhost:8080/back/reset_login.php", tab);
		})
	if(document.getElementById('video'))
	{
		video();
	}

},100);


function video() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 500,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    console.log(data);
    photo.setAttribute('src', data);
    //sand data in hidden input
    //explod  -> ;
    //decode base 64
    // write img;
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);
}