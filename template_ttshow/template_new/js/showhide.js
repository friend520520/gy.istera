
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
		return "";
	}

	/*
	function delCookie() {
		var expires = new Date();
		expires.setTime(expires.getTime()-1);
		document.cookie = "adsCount=; expires=" + expires.toGMTString();
	}
	*/	
	
	var key = "adsCount";
	var value = getCookie(key);
	var res;
	var windW = $(window).width();
	value = parseInt(value);
	
	
	if(windW >= 728) //show
	{
		if(isNaN(value))
		{
			document.cookie = "adsCount=2";
			value = getCookie(key);
			$(".adsClose").show();
		}
		else
		{
			res = value % 2;
			if(res == 0)
			{
				$(".adsClose").hide();
			}
			else
			{
				$(".adsClose").show();
			}
			value = value + 1;
			document.cookie = "adsCount=" + value;
		}
	}
	else	//hide
	{
		$(".adsClose").hide();
	}
	
	//delCookie();
	