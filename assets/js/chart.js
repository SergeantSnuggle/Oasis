$(document).ready(function(){
	$.ajax({
		url: "data.php",
		method: "GET",
		success: function(data) {
			function getCol(matrix, col){
				var column = [];
				for(var i=0; i<matrix.length; i++){
					column.push(matrix[i][col]);
				}
				return column;
			}

			var ctx = $("#login-chart");
			ctx.height = 120;
			function formatDate(date){

				var dd = date.getDate();
				var mm = date.getMonth()+1;
				var yyyy = date.getFullYear();
				if(dd<10) {
					dd='0'+dd
				}
				if(mm<10) {
					mm='0'+mm
				}
				date = dd+'-'+mm+'-'+yyyy;
				return date
			}
			function Last7Days () {
				var result = [];
				for (var i=0; i<7; i++) {
					var d = new Date();
					d.setDate(d.getDate() - i);
					result[i] = ( formatDate(d) )
				}

				return(result);
			}
			var lastDays = Last7Days();

			var barGraph = new Chart(ctx, {
				type: 'line',
				data: {
					labels: [ lastDays[6], lastDays[5], lastDays[4], lastDays[3], lastDays[2], lastDays[1], lastDays[0] ],
					type: 'line',
					datasets: [ {
						data: [data[0], data[1], data[2], data[3], data[4], data[5], data[6]],
						label: "Amount",
						backgroundColor: 'rgba(0,103,255,.15)',
						borderColor: 'rgba(0,103,255,0.5)',
						borderWidth: 3.5,
						pointStyle: 'circle',
						pointRadius: 5,
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'rgba(0,103,255,0.5)',
					}, ]
				},
				options: {
					responsive: true,
					tooltips: {
						mode: 'index',
						titleFontSize: 12,
						titleFontColor: '#000',
						bodyFontColor: '#000',
						backgroundColor: '#fff',
						titleFontFamily: 'Montserrat',
						bodyFontFamily: 'Montserrat',
						cornerRadius: 3,
						intersect: false,
					},
					legend: {
						display: false,
						position: 'top',
						labels: {
							usePointStyle: true,
							fontFamily: 'Montserrat',
						},


					},
					scales: {
						xAxes: [ {
							display: true,
							gridLines: {
								display: false,
								drawBorder: false
							},
							scaleLabel: {
								display: true,
								labelString: 'Dagen'
							}
						} ],
						yAxes: [ {
							display: true,
							gridLines: {
								display: true,
								drawBorder: false
							},
							scaleLabel: {
								display: true,
								labelString: 'Hoeveelheid logins'
							}
						} ]
					},
					title: {
						display: false,
					}
				}
			} );

		},
		error: function(data) {
			console.log(data);
		}
	});
});