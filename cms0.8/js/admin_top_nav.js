window.onload = function() {
//导航栏的选择
	var ul = document.getElementsByTagName('ul');
	var a = ul[0].getElementsByTagName('a');
	var nav_selected = document.getElementById("nav_selected").value;
	for(i=0; i<a.length; i++) {
		a[i].className = null;
		if(nav_selected == i) {
			a[i].className = 'selected';
		}
	}
//等级选择
	var level = document.getElementById('level');
	var options = document.getElementsByTagName('option');
	if(level) {
		for(i=0; i<options.length; i++) {
			if(options[i].value == level.value) {
				options[i].setAttribute('selected', 'selected');
			}
		}
	}

//操作的选择
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');
	var title = document.getElementById('title');
	for(i=0; i<a.length; i++) {
			a[i].className = '';
		if(title.innerHTML == a[i].innerHTML) {
			a[i].className = 'selected';
		}
	}
};
