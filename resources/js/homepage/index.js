class Homepage {
    constructor() {
        this.initObject();
        this.initTimer();
        this.initChart();
    }

    initObject() {
        this.$beijingTimer = $('.js-beijing-time');
        this.$moscowTimer = $('.js-moscow-time');
        this.$USATimer = $('.js-usa-time');
        this.$todayRateChat = $('#chart-today-rate');
        this.$sevenDayRate = $('#chart-seven-day-rate');
    }

    initTimer() {
        setInterval(() => {
            this.setHomepageDate();
        }, 1000);
    }

    initChart() {
        let $todayRateChart = new Chart(this.$todayRateChat, {
            type: 'bar',
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            let label = data.datasets[item.datasetIndex].label || '';
                            let yLabel = item.yLabel;
                            let content = '';

                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }

                            content += '<span class="popover-body-value">' + yLabel + '</span>';

                            return content;
                        }
                    }
                }
            },
            data: {
                labels: this.$todayRateChat.data('xAxis'),
                datasets: [{
                    label: 'Sales',
                    data: this.$todayRateChat.data('yAxis')
                }]
            }
        });

        this.$todayRateChat.data('chart', $todayRateChart);

        let $sevenDayChart = new Chart(this.$sevenDayRate, {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return '$' + value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            let label = data.datasets[item.datasetIndex].label || '';
                            let yLabel = item.yLabel;
                            let content = '';

                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }

                            content += '<span class="popover-body-value">$' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
            data: {
                labels: this.$sevenDayRate.data('xAxis'),
                datasets: [{
                    label: 'Performance',
                    data: this.$sevenDayRate.data('yAxis')
                }]
            }
        });

        this.$sevenDayRate.data('chart', $sevenDayChart);
    }

    setHomepageDate() {
        this.$beijingTimer.html(this.getLocaleTime(8));
        this.$moscowTimer.html(this.getLocaleTime(3));
        this.$USATimer.html(this.getLocaleTime(-8));
    }

    getLocaleTime(index) {
        let $date = new Date();
        let len = $date.getTime();
        let offset = $date.getTimezoneOffset() * 60000;
        let UTCTime = len + offset;

        return this.transformTime('MM-dd hh:mm:ss', UTCTime + 3600000 * index);
    }

    transformTime(format, date) {
        let $date = new Date(date);
        let $format = {
            "M+" : $date.getMonth()+1,
            "d+" : $date.getDate(),
            "h+" : $date.getHours(),
            "m+" : $date.getMinutes(),
            "s+" : $date.getSeconds(),
            "q+" : Math.floor(($date.getMonth()+3)/3),
            "S"  : $date.getMilliseconds()
        };

        if(/(y+)/.test(format))
            format = format.replace(RegExp.$1, ($date.getFullYear()+"").substr(4 - RegExp.$1.length));
        for(let index in $format)
            if(new RegExp("("+ index +")").test(format))
                format = format.replace(RegExp.$1, (RegExp.$1.length === 1) ? ($format[index]) : (("00"+ $format[index]).substr((""+ $format[index]).length)));
        return format;
    }
}

new Homepage();
