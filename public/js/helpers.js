function getChartOptions(ctype){
	let ret = {};
	
	switch(ctype){
		case 'bar':
		  ret = {
			scales: {
				yAxes: [ {
					ticks: {
						beginAtZero: true
					}
                         } ]
			}
		}
		break;

		case 'doughnut':
		  ret = {
			responsive: true
		}
		break;
	}
	
	return ret;
}


//Serialize the data from backend
function serializeChartForm(fm){
	var ret = [];
	ret["x"] = [];
	ret["y"] = [];
	
	var els = fm.elements;
	for(var i = 0; i < els.length; i++){
		let el = els[i];
		ret["x"][i] = $(el).attr('data-x');
		ret["y"][i] = $(el).attr('data-y');
	}
	
	return ret;
}

//Toggles <select> options
function toggleOptions(selectID,optionsList,action){
	for(var i = 0; i < optionsList.length; i++){
		let selector = selectID + ' > option[value=' + optionsList[i] + ']';
		if(action == "hide") $(selector).hide();
		else if(action == "show") $(selector).show();
	}
}