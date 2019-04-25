( function ( $ ) {
	"use strict";

    
	 //LinqTest Chart
	 var ctxLinqTest = document.getElementById("linqtest-chart");
     let lcs = document.getElementById('c-s');
     let ctype = ctxLinqTest.getAttribute('data-ctype');
	 let chartLabel = "";
	 
	 let cd = serializeChartForm(lcs);
	 /*console.log(cd.x);
	 console.log(cd.y);
	 */
	 console.log(ctype);
	 /*
	 console.log(ctxLinqTest);
     */
	 
	 var chartData = {
		 labels: cd.x,
		 data: {
			 d: cd.y,
			 l: chartLabel,
			 ctype: ctype
		 }
	 };
	 
	 let chartConfig = {};
	 
	 switch(ctype){
	  case "bar": // single bar chart
	   chartConfig = {
		   type: 'bar',
		    data: {
			  labels: cd.x,
			datasets: [
				{
					label: "My First dataset",
					data: cd.y,
					borderColor: "rgba(0, 123, 255, 0.9)",
					borderWidth: "0",
					backgroundColor: "rgba(0, 123, 255, 0.5)"
                }
                        ]
		},
		options: {
			scales: {
				yAxes: [ {
					ticks: {
						beginAtZero: true
					}
                                } ]
			}
		}
	};
	  break;
	  
	  case "line":
	  chartConfig = {
		type: 'line',
		data: {
			labels: cd.x,
			//labels: spendMonth["month"],
			//labels: ,
			type: 'line',
			defaultFontFamily: 'Montserrat',
			datasets: [ {
				data: cd.y,
			//data: spendMonth["spend"],
				label: "Spend(N)",
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
						display: false,
						labelString: 'Month'
					}
                        } ],
				yAxes: [ {
					display: true,
					gridLines: {
						display: false,
						drawBorder: false
					},
					scaleLabel: {
						display: true,
						labelString: 'Spend(N)'
					}
                        } ]
			},
			title: {
				display: false,
			}
		}
	}
	  break;
	  
	  case "pie":
	  chartConfig = {
		type: 'pie',
		data: {
			datasets: [ {
				data: cd.y,
				backgroundColor: [
                                    "rgba(0, 240, 12,0.9)",
                                    "rgba(220, 220, 0,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(255,0,0,0.07)"
                                ],
				hoverBackgroundColor: [
                                    "rgba(0, 240, 12,0.9)",
                                    "rgba(220, 220, 0,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(255,0,0,0.07)"
                                ]

                            } ],
			labels: cd.x
		},
		options: {
			responsive: true
		}
	}
	  break;
	  
	  case "doughnut":
	   chartConfig = {
		type: 'doughnut',
		data: {
			datasets: [ {
				data: cd.y,
				backgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(0, 123, 255,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ],
				hoverBackgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(0, 123, 255,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            } ],
			labels: cd.x
		},
		options: {
			responsive: true
		}
	}
	  break;
  }
	 
	 console.log(chartConfig); 
	
	  var myChart = new Chart(ctxLinqTest, chartConfig);
     
} )( jQuery );	 
	 
	
