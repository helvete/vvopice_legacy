<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
	<head>
		<link rel="stylesheet" href="vvopdev.css" type="text/css"  media="screen" />
		<meta http-equiv="content-type" content="html/css; charset=utf-8" />
		<meta name="author" content="codeall: ht" />
		<meta name="copyright" content="ht" />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="language" content="czech" />
		<meta name="country" content="cz" />
		<meta http-equiv="content-language" content="cs" />
		<meta http-equiv="cache-control" content="public" />
		<meta name="description" content="VVopice php forum" />
		<meta name="keywords" content="vvopice" />
		<link rel="alternate" type="application/rss+xml" title="vvopicarna" href="http://vv.bahno.net/?rss=1">
		<link rel="shortcut icon" type="image/x-icon" href="icon.ico" />
		<title>VVopice php-sql forum</title>
		<script type='text/javascript'>
			function cd() {
				document.mainform.jmeno.focus();
			}
			/**
			 * Writes cookies
			 * @param {string} name Cookie name
			 * @param {string} value Cookie value
			 * @param {number} days Cookie expire time in days
			 */
			function writeCookie(name,value,days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
				}
				else var expires = "";
				document.cookie = name+"="+value+expires+"; path=/";
			}

			/**
			 * Retrieves a cookie
			 * @param {string} name Cookie name
			 * @returns {?string} Cookie value
			 */
			function getCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
				}
				return null;
			}
			/*
				var colourTrs = document.getElementsByClassName('posts');
			 //alert(colourTrs);
			 for each (eleme in colourTrs) {
				alert(eleme.getElementsByClassName('st'));
			 }
				var timestamp = getCookie('lastSeen');
				if(timestmap){
			 var colourTrs = document.getElementsByClassName('posts');
			 alert(colourTrs);
				}
			 */
		</script>
	</head>
	<body>
		<div style="position:absolute; top: 25px; right: 25px; width: 30px; height: 30px;">
			<a href="/?rss=1" title="vvopici RSS feed">
				<img src="./rss.png" style="max-width: 100%; max-height: 100%;"/>
			</a>
		</div>
		<div id="hull">
			<a name="start"></a>
			<table class="cent">
				<tr>
					<td>
						<a href="<?php echo $_SERVER['SCRIPT_URI']; ?>"
							title="vvopici logo;-) (prenacist stranku)"
							class="piclin">
							<div id="logo"></div>
						</a>
						<br />
						<span class="logotext" >logo bylo možné udělat díky
							<a href="http://creativecommons.org/licenses/by-nc/3.0/">CC</a>
							licenci a kreslíři komixů
							<a href="http://jjrowland.com/">Jeffrey Rowlandovi</a></span>
					</td>
					<?php include 'news.html';?>
				</tr>
			</table>
