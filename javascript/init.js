$(document).ready(function() {
    $(".main").onepage_scroll({
       sectionContainer: "section", 
       easing: "ease",
       animationTime: 2000,
       pagination: true,
       updateURL: false
    });
});


$(function() {
    $(".dial").knob({
    	'min':0,
    	'max':100,
    	'readOnly':true,
    	'thickness':0.1,
    	'width':100,
    	'fgColor':"#00E1FF",
    	'bgColor':"#FFFFFF",
        'draw' : function () { 
            $(this.i).val(this.cv + '%')
        }
    });
});

function initChart(chartValue) {
    $('#chartTemp').highcharts({
        chart: {
        	zoomType: 'x',
        	backgroundColor : ''
        },

        title: {
    		text: ''
		},

		legend: {
    		enabled: false
		},

        xAxis: {
            type: 'datetime',
            lineColor: '#000000',
            tickInterval: 9000,
            colors: '#000000'
        },

        yAxis: {
            lineColor: '#344951',
            gridLineColor: '#344951',
            title: {
                text: ''
            },

            labels: {
                color: '#344951',
                style: {
                    color: '#344951'
                }
            }
        },


        tooltip: {
            style: {
                color: '#FFFFFF'
            },
            backgroundColor: {
                linearGradient: [0, 0, 0, 60],
                stops: [
                    [0, '#0D1128'],
                    [1, '#080D2B']
                ]
            },
            borderWidth: 1,
            borderColor: '#000'
        },
        
        series: [{
            color: '#00E1FF',
        	type: 'area',
    		pointStart: Date.UTC(2013, 11, 21, 14, 30, 51),
        	name: 'Cpu Temp',
            data: chartValue
        }]
    });
};