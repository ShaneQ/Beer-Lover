
function checkForm(formName){
	var form = $('#'+formName);
	var missing = false;
	var emailFormat = false;
	var passwordFormat = false;
	var regexFail = false;
	var patt = new RegExp("[<>;:\"`/]");
	var i = 0;
	form.find('.has-error').removeClass('has-error');
	form.find('.required').each(function()
	{
		if(this.type ==='email'){
			if(this.value.length < 1){
				missing = true;
				i++;
			}else if(!validateEmail(this.value)){
				emailFormat = true;
				i++;
			}
		}else if(this.type ==='password'){
			if(this.value.length < 1){
				missing = true;
				i++;
			}else if(this.value.length < 7){
				passwordFormat = true;
				i++;
			}

		}else if(this.type ==='text'){
			if(this.value.length < 1){
				missing = true;
				i++;
			}else if(patt.test(this.value)){
				regexFail = true;
				i++;
			}

		}

	});

	return i;
}

function checkEmailMatch(formName){

	var form = $('#'+formName);
	var email = '';
	var count = 0;
	var emails = 0;
	form.find('input[type=email]').each(function()
	{
		emails++;
		if(email === ''){
			email = $(this).val();
			count++;
		}else{
			if(email === $(this).val()){
				count++;
			}
		}
	});
	if(emails === count){
		return true;
	}else{
		return false;
	}
}

function validateEmail(email){
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
		return true;
	}else{
		return false;
	}
}



function validateForm(formName){
	var form = $('#'+formName);
	var missing = false;
	var emailFormat = false;
	var passwordFormat = false;
	var regexFail = false;
	var patt = new RegExp("[<>;:\"`/]");
	var i = 0;
	form.find('.has-error').removeClass('has-error');
	form.find('.required').each(function()
	{
		if(this.type ==='email'){
			if(this.value.length < 1){
				missing = true;
				highlightInput(this);
				i++;
			}else if(!validateEmail(this.value)){
				emailFormat = true;
				i++;
				highlightInput(this);
			}
		}else if(this.type ==='password'){
			if(this.value.length < 1){
				missing = true;
				i++;
				highlightInput(this);
			}else if(this.value.length < 8){
				passwordFormat = true;
				i++;
				highlightInput(this);
			}else if(this.value.length > 12){
			passwordFormat = true;
			i++;
			highlightInput(this);
		}

		}else if(this.type ==='text'){
			if(this.value.length < 1){
				missing = true;
				i++;
				highlightInput(this);
			}else if(patt.test(this.value)){
				regexFail = true;
				i++;
				highlightInput(this);
			}
		}

	});
	if(missing){
		swal("Problems!", "Some items need to be filled in", "warning");
	}
	if(emailFormat){
		swal("Problems!", "Email Format is incorrect", "warning");
	}
	if(passwordFormat){
		swal("Problems!", "Password must be atleast 8 characters and not more than 12", "warning");
	}
	if(regexFail){
		swal("Problems!", "An input contains an special character that is not allowed", "warning");
	}
	return i;
}

function highlightInput(elm){
	$(elm).closest('.form-group').addClass('has-error');
}