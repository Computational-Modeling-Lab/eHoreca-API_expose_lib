function httpRequest(_url, _data, _method="post") {
	var result;
	if (_method=="post") {
		jQuery.ajax({
			type: 'POST',
			url: _url,
			data: _data,
			success:function(dataReceived) {
						result = dataReceived;
					},
			async:false
		});
	} else if (_method=="get") {
		jQuery.ajax({
			url: _url,
			type: 'GET',
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Authorization', 'Bearer '+_data['token']);
			},
			success:function(dataReceived) {
						result = dataReceived;
					},
			async:false
		});
	}
		
	return result;
}

class eHoreca {
	constructor(_apiURL) {
		this.userId = null;
		this.apiURL = _apiURL;
		this.token = null;
	}
	
	connect(_email, _password) {
		var reply = httpRequest(this.apiURL+"login", {"email": _email, "password": _password});
		this.token = reply.token;
		this.userId = reply.id;
	}
	
	printAllVars() {
		var result = "";
		var keys = Object.keys(this);
		var _this = this;
		
		keys.forEach(function(currVal){
			result += currVal + ": " + _this[currVal] + "<br/>";
		});

		return result;
	}
	
	getEndPoint(_endPoint, _inputData=[]) {
		_inputData["token"] = this.token;
		
		if (this.token !== null)
			return httpRequest(this.apiURL + _endPoint,  _inputData, "get");
		else
			return false;
	}
	
}