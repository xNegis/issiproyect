function popup(n) {
	var popup = document.getElementsByClassName("popuptext")[n];
	var th = document.getElementsByTagName("th")[n];
	var offset = $(th).offset();
	event.stopPropagation();
	var topOf = offset.top;
	var leftOf = offset.left;
	$(popup).offset({
		top : topOf - 60,
		left : leftOf
	});
	popup.classList.toggle("show");
}

function popupPrimero(n) {
	var popup = document.getElementsByClassName("popuptext")[n];
	var th = document.getElementsByTagName("th")[n];
	var offset = $(th).offset();
	event.stopPropagation();
	var topOf = offset.top;
	var leftOf = offset.left - 70;
	$(popup).offset({
		top : topOf - 60,
		left : leftOf
	});
	popup.classList.toggle("show");
}

function popupUltimo(n) {
	var popup = document.getElementsByClassName("popuptext")[n];
	var th = document.getElementsByTagName("th")[n];
	var offset = $(th).offset();
	event.stopPropagation();
	var topOf = offset.top;
	var leftOf = offset.left + 70;
	$(popup).offset({
		top : topOf - 60,
		left : leftOf
	});
	popup.classList.toggle("show");
}