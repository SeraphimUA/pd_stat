let pubdomName = document.querySelector("#pubdom_name").innerHTML;
//let pubdomName = selPubdomName.innerText;

//const selPd = document.querySelector('#selPD option[selected="selected"]')
//let pubdomName = selPubdomName.innerText;

//const selAll = document.getElementById("selPD");

//console.log(selPd);
console.log(pubdomName);
//console.log(selAll);

//const button1 = document.getElementById('select_all');
//const button2 = document.getElementById('select_5');
//const button3 = document.getElementById('select_1');

let datastat = [];

getRequest();

/*selAll.addEventListener('change', () => { 
	pubdomName = selAll.value;
	selPubdomName.innerText = pubdomName;
	getRequest(pubdomName) ;
});*/


function getRequest() {
    const requestJSON = 'http://stats.test/pubdomCapacity/'+ pubdomName;
    console.log("requestJSON: " + requestJSON);
    const request = new XMLHttpRequest();

    if (request) {
	request.open('GET', requestJSON, true);
        request.responseType = 'json';
        request.send();

	request.onload = function() { 
	    datastat = request.response;
	    getStats(0); 
	}

	/*button1.onclick = function () { getStats(0); };
	button2.onclick = function () { getStats(5); };
	button3.onclick = function () { getStats(1); };*/
    }
}

//function onPdChange {
//	console.log('ch1:'+pubdomName);
//	pubdomName = selPd.innerText;
//	selPubdomName.innerText = pubdomName;
//	getRequest(pubdomName) ;
//}

function getStats(k) {
    var stat = [['Date', 'Domains']];

    tmp = datastat["stat"];

    /*if (k == 5) {
         temp_stats = tmp.slice(-60);
    } else if (k == 1) {
         temp_stats = tmp.slice(-12);
    } else {
         temp_stats = tmp;
    }*/

    tmp.forEach(element => {
        time = element["d_measure"].split("-");
        date = [parseInt(time[0]), parseInt(time[1])-1, parseInt(time[2])];
        stat.push([new Date(date[0], date[1], date[2]), element["capacity"]]);
    });
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(stat);
    
    var options = {
        title: 'Кількість доменів у ' + pubdomName,
        legend: 'none',
        chartArea:{bottom:100},
        hAxis: {format: 'yyyy-MM',
            slantedText:true, slantedTextAngle:80
        },
        vAxis: {minValue: 0},
        explorer: { 
            actions: ['dragToZoom', 'rightClickToReset'],
            axis: 'horizontal',
            keepInBounds: true,
            maxZoomIn: 8.0
        },
        colors: ['#D44E41'],
        animation:{
			duration: 500,
			easing: 'linear',
			startup: true
		  }
    };
    
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
}

function setPubdom(newDom) {
    document.querySelector("#pubdom_name").innerHTML = newDom;
    pubdomName = newDom;
    getRequest();
}
