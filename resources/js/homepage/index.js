class Homepage {
    constructor() {
        this.initObject();
        this.initTimer();
    }

    initObject() {
        this.$beijingTimer = $('.js-beijing-time');
        this.$moscowTimer = $('.js-moscow-time');
        this.$newyorkTimer = $('.js-newyork-time');
    }

    initTimer() {
        setInterval(() => {
            this.setHomepageDate();
        }, 1000);
    }

    setHomepageDate() {
        this.$beijingTimer.html(this.getLocaleTime(8));
        this.$moscowTimer.html(this.getLocaleTime(3));
        this.$newyorkTimer.html(this.getLocaleTime(-5));
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
