var ipAddress = "";

function getIP(json){
  $('#ip-address').val(json.ip);
}

// Then call '<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>' in file
