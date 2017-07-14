$(document).ready(function(){

	$.ajaxSetup({ cache: false });
	
	function getRequest(url, callback) {
		$.get(url, function(data) {
			data = $.parseJSON(data);
			callback(data);
		});
	}


	function generatePie(idDiv, data, title){
	  	Highcharts.chart(idDiv, {
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie'
		    },
		    credits: {
     	 		enabled: false
  			},
		    title: {
		        text: title
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: true,
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                style: {
		                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                }
		            }
		        }
		    },
		    series: [{
		        name: 'Pourcentage',
		        colorByPoint: true,
		        data: data
		    }]
		});
	}

	function generateLine(idDiv, data, title) {
		
		Highcharts.chart(idDiv, {
		    chart: {
		        type: 'line'
		    },
		    credits: {
     	 		enabled: false
  			},
		    title: {
		        text: title
		    },
		    xAxis: {
		        categories: data[1]
		    },
		    yAxis: {
		        title: {
		            text: 'Utilisateurs'
		        }
		    },
		    plotOptions: {
		        line: {
		            dataLabels: {
		                enabled: true
		            },
		            enableMouseTracking: false
		        }
		    },
		    series: [{
		        name: 'Nombre d\'utilisateur',
		        data: data[0]
		    }]
		});
	}

	function generateBar(idDiv, data, title) {
		Highcharts.chart(idDiv, {
		    chart: {
		        type: 'column'
		    },
			credits: {
		    	enabled: false
		  	},
		    title: {
		        text: title
		    },
		    xAxis: {
		        categories: data[0],
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Utilisateur'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: [{
		        name: 'Nombre moyen d\'utilisateur',
		        data: data[1]
			}],
			legend: {
		        shadow: false
		    },
		});
	}

	function generateArea(idDiv, data, title) {
		Highcharts.chart(idDiv, {
		    chart: {
		        type: 'area'
		    },
		    title: {
		        text: title
		    },
		    xAxis: {
		        categories: data[0],
		        tickmarkPlacement: 'on',
		        title: {
		            enabled: false
		        }
		    },
		    yAxis: {
		        title: {
		            text: 'Oeuvre'
		        }
		    },
		    tooltip: {
		        split: true
		    },
		    plotOptions: {
		        area: {
		            stacking: 'normal',
		            lineColor: '#666666',
		            lineWidth: 1,
		            marker: {
		                lineWidth: 1,
		                lineColor: '#666666'
		            }
		        }
		    },
		    series: [{
		        name: 'Nombre d\'oeuvre',
		        data: data[1]
		    }]
		});
	}



	getRequest("webservices/element_by_category.php", function(data) {
		generatePie("element_by_category", data, 'Nombre d\'oeuvre par catégorie');
	});

	getRequest("webservices/room_by_category.php", function(data) {
		generatePie("room_by_category", data, 'Nombre de salons par catégorie');
	});

	getRequest("webservices/evolution_nbr_user.php", function(data) {
		generateLine("evolution_nbr_user", data, 'Evolution du nombre d\'utilisateur');
	});

	getRequest('webservices/user_room_by_month.php', function(data) {
		generateBar('user_room_by_month', data, 'Nombre moyen d\'utilisateur par salon par mois');
	});

	getRequest('webservices/nbr_suggest.php', function(data) {
		generateArea('nbr_suggest', data, 'Nombre d\'oeuvres suggérées par mois');
	});

	getRequest("webservices/nbr_message_by_room.php", function(data) {
		$('#nbr_message_by_room').append(data);
	});

});